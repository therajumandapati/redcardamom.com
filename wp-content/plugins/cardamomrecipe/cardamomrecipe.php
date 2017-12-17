<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://rajumandapati.com
 * @since             1.0.0
 * @package           Cardamomrecipe
 *
 * @wordpress-plugin
 * Plugin Name:       Cardamom Recipe
 * Plugin URI:        https://redcardamom.com
 * Description:       This plugin adds a JSON-LD markup for a recipe to the regular post type if all the details are added.
 * Version:           1.0.0
 * Author:            Raju Mandapati
 * Author URI:        https://rajumandapati.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cardamomrecipe
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently pligin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );
define( 'MY_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-cardamomrecipe-activator.php
 */
function activate_cardamomrecipe() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cardamomrecipe-activator.php';
	Cardamomrecipe_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-cardamomrecipe-deactivator.php
 */
function deactivate_cardamomrecipe() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cardamomrecipe-deactivator.php';
	Cardamomrecipe_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_cardamomrecipe' );
register_deactivation_hook( __FILE__, 'deactivate_cardamomrecipe' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-cardamomrecipe.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_cardamomrecipe() {

	$plugin = new Cardamomrecipe();
	$plugin->run();

}
run_cardamomrecipe();
