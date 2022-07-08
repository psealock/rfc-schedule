import Schedule from './schedule';
import Controls from './controls';

export default function App( { fixtures } ) {
	return (
		<>
			<Controls />
			<Schedule fixtures={ fixtures } />
		</>
	);
}
