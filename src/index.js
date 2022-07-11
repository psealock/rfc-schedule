import { render } from '@wordpress/element';
import App from './App';

const rootElement = document.getElementById( 'rfc-schedule-app' );

if ( rootElement ) {
	const data = rootElement.getAttribute( 'data-fixtures' );
	render( <App data={ JSON.parse( data ) } />, rootElement );
}
