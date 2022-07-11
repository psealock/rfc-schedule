import Table from './table';

const Schedule = ( { data } ) => {
	console.log( data );

	return data.map( ( gradeFixtures ) => {
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
