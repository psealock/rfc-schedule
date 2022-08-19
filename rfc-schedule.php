<?php
/**
 * Plugin Name: RFC-Schedule
 * Plugin URI: https://github.com/psealock/rfc-schedule
 * Description: Raglan football schedule
 * Version: 1.0.0
 * Author: psealock
 * Requires at least: 5.8
 * Requires PHP: 7.2
 *
 * @package RFCSchedule
 */

defined( 'ABSPATH' ) || exit;

require_once 'includes/class-rfc-schedule.php';

/**
 * Short code output.
 */
function rcf_schedule_renderapp() {
	$schedule = new RFC_Schedule();
	$fixtures = wp_json_encode( $schedule->get_fixtures() );
	$dates    = wp_json_encode( $schedule->get_next_dates() );

	return '<div data-dates=\'' . $dates . '\' data-fixtures=\'' . $fixtures . '\' id="rfc-schedule-app"></div>';
}

/**
 * Make the JS magic happen.`
 */
function rcf_schedule_enq_react() {

	$script_path       = '/build/index.js';
	$script_asset_path = dirname( __FILE__ ) . '/build/index.asset.php';
	$script_asset      = file_exists( $script_asset_path )
		? require $script_asset_path
		: array(
			'dependencies' => array(),
			'version'      => filemtime( $script_path ),
		);
	$script_url        = plugins_url( $script_path, __FILE__ );

	wp_register_script(
		'rfc-schedule',
		$script_url,
		$script_asset['dependencies'],
		$script_asset['version'],
		true
	);

	wp_enqueue_script( 'rfc-schedule' );
}

add_shortcode( 'rfc-schedule', 'rcf_schedule_renderapp' );
add_action( 'wp_enqueue_scripts', 'rcf_schedule_enq_react' );
