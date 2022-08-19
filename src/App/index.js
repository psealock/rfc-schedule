import Schedule from './schedule';
import moment from 'moment';

export default function App( { data, dates } ) {
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

	return (
		<>
			<h2>{ title }</h2>
			<Schedule data={ data } />
		</>
	);
}
