import App from './App';

const { render } = wp.element;

if ( document.getElementById( 'rfc-schedule-app' ) ) {
	render( <App />, document.getElementById( 'rfc-schedule-app' ) );
}
