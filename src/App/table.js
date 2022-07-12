import moment from 'moment';

const Table = ( { fixtures, title } ) => {
	return (
		<div>
			<h3>{ title }</h3>
			<table>
				<thead>
					<tr>
						<th>Time</th>
						<th>Home Team</th>
						<th></th>
						<th>Away Team</th>
					</tr>
				</thead>
				<tbody>
					{ fixtures.map( ( fixture ) => {
						const date = moment( fixture.Date );
						const teamStyles = {
							display: 'flex',
							'flex-direction': 'column',
							'align-items': 'center',
						};
						return (
							<tr key={ fixture.Id }>
								<td>
									<span>{ date.format( 'h:mm a' ) }</span>
									<br />
									<span>{ fixture.VenueName }</span>
								</td>
								<td style={ teamStyles }>
									<img
										height="60px"
										width="60px"
										alt={ fixture.AwayTeamName }
										src={ fixture.AwayOrganisationLogo }
									/>
									<span>{ fixture.AwayTeamName }</span>
								</td>
								<td>vs</td>
								<td style={ teamStyles }>
									<img
										height="30px"
										width="30px"
										alt={ fixture.HomeTeamName }
										src={ fixture.HomeOrganisationLogo }
									/>
									<span>{ fixture.HomeTeamName }</span>
								</td>
							</tr>
						);
					} ) }
				</tbody>
			</table>
		</div>
	);
};

export default Table;
