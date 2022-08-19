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
	 * Raglan's orgId
	 */
	const RAGLAN_ORG_ID = '45003';
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
			'2103020716', // Waikato Junior 7th Grade Silver 2022 R1.
			'2102990542', // Waikato Junior 8th Grade Platinum 2022 R1.
		);
	}

	/**
	 * Build requests for each competition.
	 */
	protected function create_requests() {
		$requests = array();
		$url      = self::API_URL;
		$dates    = $this->get_next_dates();

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
						'orgIds'        => self::RAGLAN_ORG_ID,
						'from'          => $dates['saturday'],
						'to'            => $dates['sunday'],
					)
				),
			);
		}

		return $requests;
	}

	/**
	 * Determine the following Saturday.
	 */
	public function get_next_dates() {
		if ( 'Sat' === gmdate( 'D' ) ) {
			return array(
				'saturday' => gmdate( 'Y-m-d\TH:i:s.000\Z', strtotime( 'today' ) ),
				'sunday'   => gmdate( 'Y-m-d\TH:i:s.000\Z', strtotime( 'tomorrow' ) ),
			);
		}
		return array(
			'saturday' => gmdate( 'Y-m-d\TH:i:s.000\Z', strtotime( 'next Saturday' ) ),
			'sunday'   => gmdate( 'Y-m-d\TH:i:s.000\Z', strtotime( 'next Sunday' ) ),
		);
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
				$body = json_decode( $response->body, true );
				return array(
					'error' => esc_html( $body['Message'] ),
				);
			}

			$body       = json_decode( $response->body, true );
			$fixtures[] = $body;
		}

		return $fixtures;
	}
}
