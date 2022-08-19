import Schedule from './schedule';

export default function App( { data } ) {
	if ( data.error || ! data.length ) {
		return (
			<>
				<h2>Something has gone terribly wrong</h2>
				<p>{ data.error }</p>
			</>
		);
	}

	return (
		<>
			<h2>Saturday, July 30th</h2>
			<Schedule data={ data } />
		</>
	);
}
