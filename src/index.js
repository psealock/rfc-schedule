import { render } from '@wordpress/element';
import App from './App';

const rootElement = document.getElementById( 'rfc-schedule-app' );

if ( rootElement ) {
	const data = rootElement.getAttribute( 'data-fixtures' );
	const fixtures = JSON.parse( data );
	render( <App fixtures={ fixtures } />, rootElement );
}
