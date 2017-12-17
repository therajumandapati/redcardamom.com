<?php
/**
 * Globally-accessible functions
 *
 * @since      1.0.0
 * @package    Cardamomrecipe
 * @subpackage Cardamomrecipe/includes
 * @author     Raju Mandapati <talkto@rajumandapati.com>
 */

/**
 * Returns the result of the get_template global function
 */

function cardamomrecipe_get_template( $name ) {
	return Cardamomrecipe_Globals::get_template( $name );
}

function cardamomrecipe_convertToHoursMins($time, $format = 'PT%02dH%02dM') {
  return Cardamomrecipe_Globals::convertToHoursMins( $time, $format );
}

class Cardamomrecipe_Globals {

	/**
	 * Returns the path to a template file
	 *
	 * Looks for the file in these directories, in this order:
	 * 		Current theme
	 * 		Parent theme
	 * 		Current theme templates folder
	 * 		Parent theme templates folder
	 * 		This plugin
	 *
	 * To use a custom list template in a theme, copy the
	 * file from public/templates into a templates folder in your
	 * theme. Customize as needed, but keep the file name as-is. The
	 * plugin will automatically use your custom template file instead
	 * of the ones included in the plugin.
	 *
	 * @param 	string 		$name 			The name of a template file
	 * @return 	string 						The path to the template
	 */
 	public static function get_template( $name ) {

 		$template = '';

    $template = MY_PLUGIN_PATH . 'public/partials/' . $name . '.php';

    print_r($template);

		return $template;

   }
   
   public static function convertToHoursMins($time, $format = 'PT%02dH%02dM') {
    if ($time < 1) {
      return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return sprintf($format, $hours, $minutes);
   }

} // class
