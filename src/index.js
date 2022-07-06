const { render } = wp.element;

const App = () => {
	return (
		<div>
			<h2>Hello Raglan Football</h2>
		</div>
	);
};

if ( document.getElementById( 'rfc-schedule-app' ) ) {
	render( <App />, document.getElementById( 'rfc-schedule-app' ) );
}
