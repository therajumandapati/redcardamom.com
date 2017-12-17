<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://rajumandapati.com
 * @since      1.0.0
 *
 * @package    Cardamomrecipe
 * @subpackage Cardamomrecipe/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Cardamomrecipe
 * @subpackage Cardamomrecipe/admin
 * @author     Raju Mandapati <talkto@rajumandapati.com>
 */
class Cardamomrecipe_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Cardamomrecipe_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cardamomrecipe_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cardamomrecipe-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Cardamomrecipe_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cardamomrecipe_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cardamomrecipe-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Adds another folder to ACF JSON load point
	 *
	 * @since     1.0.0
	 * @return    array    The updates ACF load points.
	 */
	public function add_acf_json_load_point( $paths ) {
		$paths[] = MY_PLUGIN_PATH . '/acf-load-json';
		return $paths;
	}

	/**
	 * Adds another folder to ACF JSON save point
	 *
	 * @since     1.0.0
	 * @return    array    The updates ACF save points.
	 */
	public function add_acf_json_save_point( $path ) {
		$path = MY_PLUGIN_PATH . '/acf-save-json';
		return $path;
	}

}
