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

/**
 * Short code output.
 */
function renderapp() {
	$url  = 'https://www.waibopfootball.co.nz/api/1.0/competition/cometwidget/filteredfixtures';
	$args = array(
		'headers' => array(
			'Content-Type' => 'application/json',
		),
		'body'    => wp_json_encode(
			array(
				'competitionId'  => '2102990542',
				'orgIds'         => '45003',
				'from'           => '2022-07-09T00:00:00.000Z',
				'to'             => '2022-07-15T00:00:00.000Z',
				'sportId'        => '1',
				'seasonId'       => '2022',
				'gradeIds'       => 'U_8',
				'gradeId'        => '',
				'organisationId' => '',
				'roundId'        => null,
				'roundsOn'       => false,
				'matchDay'       => null,
				'phaseId'        => null,
			)
		),
	);

	$response = wp_remote_post( $url, $args );

	if ( is_wp_error( $response ) ) {
		$error_message = $response->get_error_message();
		return "Something went wrong: $error_message";
	}

	$body     = wp_remote_retrieve_body( $response );
	$data     = json_decode( $body, true );
	$fixtures = $data['fixtures'];

	return '<div data-fixtures=\'' . wp_json_encode( $fixtures ) . '\' id="rfc-schedule-app"></div>';
}

/**
 * Make the JS magic happen.`
 */
function enq_react() {

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

add_shortcode( 'rfc-schedule', 'renderapp' );
add_action( 'wp_enqueue_scripts', 'enq_react' );
