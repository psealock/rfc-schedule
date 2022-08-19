import Schedule from './schedule';
import moment from 'moment';
import { useState } from '@wordpress/element';

export default function App( { data, dates } ) {
	const [ filter, setFilter ] = useState( 'all' );

	if ( data.error ) {
		return (
			<>
				<h2>Something has gone terribly wrong</h2>
				<p>{ data.error }</p>
			</>
		);
	}

	const { saturday } = dates;
	const title = moment( saturday ).format( 'dddd, MMMM Do' );
	const teams = [
		'all',
		'Te Wheke',
		'Gurnards',
		'Mussels',
		'Sea Lions',
		'Barracudas',
		'Dolphins',
		'Urchins',
		'Bull Sharks',
		'Megalodons',
		'Mako',
		'Kahawai',
		'Seahorses',
		'Paua',
		'Morays',
		'Snappers',
	];

	return (
		<>
			<h2>{ title }</h2>
			<label htmlFor="team-filter">Filter by team </label>

			<select
				value={ filter }
				name="team"
				id="team-filter"
				onChange={ ( e ) => setFilter( e.target.value ) }
			>
				{ teams.map( ( team ) => (
					<option key={ team } value={ team }>
						{ team }
					</option>
				) ) }
			</select>
			<Schedule data={ data } filter={ filter } />
		</>
	);
}
