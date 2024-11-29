<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://mill3.studio
 * @since      1.0.0
 *
 * @package    Ecoles_Creatives_Banner
 * @subpackage Ecoles_Creatives_Banner/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Ecoles_Creatives_Banner
 * @subpackage Ecoles_Creatives_Banner/includes
 * @author     MILL3 Studio <antoine@mill3.studio>
 */
class Ecoles_Creatives_Banner_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'ecoles-creatives-banner',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
