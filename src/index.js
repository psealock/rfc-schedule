const { render } = wp.element;

const App = () => {
	return (
		<div>
			<h2>Hello Raglan Football</h2>
		</div>
	);
};

if ( document.getElementById( 'my-react-app' ) ) {
	//check if element exists before rendering
	render( <App />, document.getElementById( 'my-react-app' ) );
}
