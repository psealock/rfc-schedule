import Table from './table';

const filterData = ( data, filter ) => {
	const filteredFixtures = data.map( ( gradeFixtures ) => {
		// Create a new grade fixture to not overwrite data.
		const nextGradeFixture = {
			roundInfo: [
				{ description: gradeFixtures.roundInfo[ 0 ].description },
			],
		};
		nextGradeFixture.fixtures = gradeFixtures.fixtures.filter(
			( fixture ) => {
				return (
					fixture.AwayTeamName.toLowerCase().includes(
						filter.toLowerCase()
					) ||
					fixture.HomeTeamName.toLowerCase().includes(
						filter.toLowerCase()
					)
				);
			}
		);

		return nextGradeFixture;
	} );

	// Return only the gradeFixtures with results.
	return filteredFixtures.filter(
		( gradeFixtures ) => gradeFixtures.fixtures.length
	);
};

const Schedule = ( { data, filter } ) => {
	const filteredData = filter === 'all' ? data : filterData( data, filter );

	return filteredData.map( ( gradeFixtures ) => {
		const title = gradeFixtures.roundInfo[ 0 ].description;
		return (
			<Table
				key={ title }
				title={ title }
				fixtures={ gradeFixtures.fixtures }
			/>
		);
	} );
};

export default Schedule;
