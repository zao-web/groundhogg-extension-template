/**
 * WordPress Dependencies
 */
import { addFilter } from '@wordpress/hooks';
import { __ } from '@wordpress/i18n';

/**
 * External dependencies
 *
 * @link: https://material-ui.com/components/material-icons/
 */
import WebIcon from '@material-ui/icons/Web';

/**
 * Internal dependencies
 */
import { Panel } from './panel'

export function addCustomPage( pages ) {

	if ( 'object' === typeof pages ) { // Note: investigate why this is necessary, pages aren't returned as initial object
		pages.push( {
			component: Panel,
			icon : WebIcon,
			label: __( 'Custom Integration' ),
			name: 'integration',
			path: '/integration',
			priority: 70
		} );
	}

	return pages;
}

addFilter(
	'groundhogg.navigation',
	'groundhoggExtension/navigation',
	addCustomPage
);