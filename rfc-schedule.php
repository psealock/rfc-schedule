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
function rcf_schedule_renderapp() {
	$url             = 'https://www.waibopfootball.co.nz/api/1.0/competition/cometwidget/filteredfixtures';
	$competition_ids = array(
		'2103020716',
		'2102990542',
	);

	$requests = array();

	foreach ( $competition_ids as $competition_id ) {
		$requests[] = array(
			'url'     => $url,
			'headers' => array(
				'Content-Type' => 'application/json',
			),
			'type'    => 'POST',
			'data'    => wp_json_encode(
				array(
					'competitionId' => $competition_id,
					'orgIds'        => '45003',
					'from'          => '2022-07-30T00:00:00.000Z',
					'to'            => '2022-08-05T00:00:00.000Z',
				)
			),
		);
	}

	$responses = Requests::request_multiple( $requests );

	$fixtures = array();

	foreach ( $responses as $response ) {
		if ( 200 !== $response->status_code ) {
			print_r( 'error' );
		}
		$body       = json_decode( $response->body, true );
		$fixtures[] = $body;
	}

	// $args = array(
	// 'headers' => array(
	// 'Content-Type' => 'application/json',
	// ),
	// 'body'    => wp_json_encode(
	// array(
	// 'competitionId' => '2103020716',
	// 'competitionId' => '2102990542',
	// 'orgIds'        => '45003',
	// 'from'          => '2022-07-30T00:00:00.000Z',
	// 'to'            => '2022-08-05T00:00:00.000Z',
	// )
	// ),
	// );

	// $response = wp_remote_post( $url, $args );

	// if ( is_wp_error( $response ) ) {
	// $error_message = $response->get_error_message();
	// return "Something went wrong: $error_message";
	// }

	// $body     = wp_remote_retrieve_body( $response );
	// $data     = json_decode( $body, true );
	// $fixtures = $data['fixtures'];

	return '<div data-fixtures=\'' . wp_json_encode( $fixtures ) . '\' id="rfc-schedule-app"></div>';
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
