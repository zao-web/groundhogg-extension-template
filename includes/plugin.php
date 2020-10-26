<?php

namespace GroundhoggExtension;

use Groundhogg\Admin\Admin_Menu;
use Groundhogg\DB\Manager;
use Groundhogg\Extension;

class Plugin extends Extension {


	/**
	 * Override the parent instance.
	 *
	 * @var Plugin
	 */
	public static $instance;

	public function get_download_id() {}
	public function includes() {}
	/**
	 * Init any components that need to be added.
	 *
	 * @return void
	 */
	public function init_components() {

		$this->installer = new Installer();
		$this->updater   = new Updater();
		$this->roles     = new Roles();
	}

	/**
	 * Extended from abstract class. Enqueues automatically on groundhogg admin react app script registration hook
	 */
	public function register_react_assets() {
		wp_register_script( 'groundhogg-extension-name-script', GROUNDHOGG_EXTENSION_ASSETS_URL . 'index.js', [ 'groundhogg-admin' ], GROUNDHOGG_EXTENSION_VERSION );

		add_action( 'groundhogg/admin/scripts', function( $handles ) {
			$handles[] = 'groundhogg-extension-name-script';
			return $handles;
		 } );
	}

	public function register_settings_tabs( $tabs ) {
		$tabs['custom_integration'] = [
			'id'    => 'custom_integration',
			'title' => _x( 'Custom Stuff', 'settings tabs', 'groundhogg-extension' ),
			'cap'   => 'manage_options'
		];

		return $tabs;
	}

	public function register_settings( $settings ) {
		$settings['gh_extension_setting_map'] = [
			'id'      => 'gh_extension_setting_map',
			'section' => 'custom_integration_section',
			'label'   => _x( 'Maybe an address picker on a Google Map?', 'settings', 'groundhogg-extension' ),
			'desc'    => _x( 'Choose a selection from this map to pick a custom location.', 'settings', 'groundhogg-extension' ),
			'type'    => 'map', // See /src examples for adding a custom component for a Map to the component mapper.
		];

		return $settings;
	}

	public function register_settings_sections( $sections ) {
		$sections['custom_integration_section'] = [
			'id'       => 'custom_integration_section',
			'title'    => _x( 'Integration Section', 'integration section', 'groundhogg-extension' ),
			'tab'      => 'custom_integration',
		];

		return $sections;
	}

	/**
	 * Get the version #
	 *
	 * @return mixed
	 */
	public function get_version() {
		return GROUNDHOGG_EXTENSION_VERSION;
	}

	/**
	 * @return string
	 */
	public function get_plugin_file() {
		return GROUNDHOGG_EXTENSION__FILE__;
	}

	/**
	 * Register autoloader.
	 *
	 * Groundhogg autoloader loads all the classes needed to run the plugin.
	 *
	 * @since 1.6.0
	 * @access private
	 */
	protected function register_autoloader() {
		require GROUNDHOGG_EXTENSION_PATH . 'includes/autoloader.php';
		Autoloader::run();
	}
}

Plugin::instance();