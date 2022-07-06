import { useQuery } from 'react-query';

async function postData( url = '', data = {} ) {
	// Default options are marked with *
	const response = await fetch( url, {
		method: 'POST',
		// mode: 'no-cors',
		headers: { 'Content-Type': 'application/json' },
		body: JSON.stringify( data ),
	} );
	return response.json();
}

const Schedule = () => {
	const { isLoading, error, data } = useQuery( 'repoData', () =>
		postData(
			'https://www.waibopfootball.co.nz/api/1.0/competition/cometwidget/filteredfixtures',
			{
				competitionId: '2102990542',
				orgIds: '45003',
				from: '2022-07-09T00:00:00.000Z',
				to: '2022-07-15T00:00:00.000Z',
				sportId: '1',
				seasonId: '2022',
				gradeIds: 'U_8',
				gradeId: '',
				organisationId: '',
				roundId: null,
				roundsOn: false,
				matchDay: null,
				phaseId: null,
			}
		)
	);

	if ( isLoading ) return 'Loading...';

	if ( error ) return 'An error has occurred: ' + error.message;

	console.log( data );

	return (
		<div>
			<h1>The data is here</h1>
		</div>
	);
};

export default Schedule;
