import { useState } from '@wordpress/element';
import { SelectControl } from '@wordpress/components';

const Controls = () => {
	const orgId = 45003;
	const competitionIds = [ 2103020716, 2102990542 ];
	const [ size, setSize ] = useState( '50%' );

	return (
		<SelectControl
			label="Size"
			value={ size }
			options={ [
				{ label: 'Big', value: '100%' },
				{ label: 'Medium', value: '50%' },
				{ label: 'Small', value: '25%' },
			] }
			onChange={ ( newSize ) => setSize( newSize ) }
			__nextHasNoMarginBottom
		/>
	);
};

export default Controls;
