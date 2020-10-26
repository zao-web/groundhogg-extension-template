import { addFilter } from '@wordpress/hooks';

/**
 * Handles rendering of custom component
 */
addFilter( 'groundhogg.settings.componentInputMap', 'groundhoggExtension', ( components ) => {
	components.map = ( props ) => ( <Map {...props} /> );
	return components;
} );