<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://rajumandapati.com
 * @since      1.0.0
 *
 * @package    Cardamomrecipe
 * @subpackage Cardamomrecipe/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Cardamomrecipe
 * @subpackage Cardamomrecipe/includes
 * @author     Raju Mandapati <talkto@rajumandapati.com>
 */
class Cardamomrecipe_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'cardamomrecipe',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
