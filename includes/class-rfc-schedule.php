<?php
/**
 * Schedule class
 *
 * @package RFCSchedule
 */

/**
 * Schedule class
 */
class RFC_Schedule {
	/**
	 * Waibop api url.
	 */
	const API_URL = 'https://www.waibopfootball.co.nz/api/1.0/competition/cometwidget/filteredfixtures';
	/**
	 * Competition ids.
	 *
	 * @var array
	 */
	protected $competition_ids;

	/**
	 * Initilization.
	 */
	public function __construct() {
		$this->competition_ids = array(
			'2103020716',
			'2102990542',
		);
	}

	/**
	 * Build requests for each competition.
	 */
	protected function create_requests() {
		$requests = array();
		$url      = self::API_URL;

		foreach ( $this->competition_ids as $competition_id ) {
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
						'from'          => '2022-08-20T00:00:00.000Z',
						'to'            => '2022-08-21T00:00:00.000Z',
					)
				),
			);
		}

		return $requests;
	}

	/**
	 * Make multiple requests to get all fixtures.
	 */
	public function get_fixtures() {
		$requests  = $this->create_requests();
		$responses = Requests::request_multiple( $requests );

		$fixtures = array();

		foreach ( $responses as $response ) {
			if ( 200 !== $response->status_code ) {
				print_r( 'error' );
			}
			$body       = json_decode( $response->body, true );
			$fixtures[] = $body;
		}

		return $fixtures;
	}
}
