import App from './App';
const { render } = wp.element;

const rootElement = document.getElementById( 'rfc-schedule-app' );
const data = rootElement.getAttribute( 'data-fixtures' );
const fixtures = JSON.parse( data );

if ( rootElement ) {
	render( <App fixtures={ fixtures } />, rootElement );
}
