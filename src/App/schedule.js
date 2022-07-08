const Schedule = ( { fixtures } ) => {
	console.log( fixtures );

	return (
		<div>
			<table>
				<thead>
					<tr>
						<th>Home Team</th>
						<th>Away Team</th>
						<th>Location</th>
						<th>Time</th>
					</tr>
				</thead>
				<tbody>
					{ fixtures.map( ( fixture ) => {
						return (
							<tr key={ fixture.Id }>
								<td>{ fixture.HomeTeamName }</td>
								<td>{ fixture.AwayTeamName }</td>
								<td>{ fixture.VenueName }</td>
								<td>{ fixture.Date }</td>
							</tr>
						);
					} ) }
				</tbody>
			</table>
		</div>
	);
};

export default Schedule;
