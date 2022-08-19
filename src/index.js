import { render } from '@wordpress/element';
import App from './App';

const rootElement = document.getElementById( 'rfc-schedule-app' );

if ( rootElement ) {
	const data = rootElement.getAttribute( 'data-fixtures' );
	const dates = rootElement.getAttribute( 'data-dates' );
	render(
		<App dates={ JSON.parse( dates ) } data={ JSON.parse( data ) } />,
		rootElement
	);
}
