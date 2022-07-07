import { QueryClient, QueryClientProvider } from 'react-query';
import Schedule from './schedule';

const queryClient = new QueryClient();

export default function App() {
	return (
		<QueryClientProvider client={ queryClient }>
			<h3>Hello Paul</h3>
		</QueryClientProvider>
	);
}
