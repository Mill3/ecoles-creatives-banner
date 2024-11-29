<?php

require __DIR__ . '/vendor/autoload.php';

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://mill3.studio
 * @since             0.0.2
 * @package           Ecoles_Creatives_Banner
 *
 * @wordpress-plugin
 * Plugin Name:       Les Écoles Créatives - bannière
 * Plugin URI:        https://mill3.studio
 * Description:       Insère le logo Écoles Créatives en haut de chaque page du site.
 * Version:           0.0.2
 * Author:            MILL3 Studio
 * Author URI:        https://mill3.studio/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ecoles-creatives-banner
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 0.0.1 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'ECOLES_CREATIVES_BANNER_VERSION', '0.0.2' );


/**
 * Plugins update server endpoint
 */

 define( 'ECOLE_CREATIVE_BANNER_PLUGINS_API', 'https://github.com/Mill3/ecoles-creatives-banner');

 /**
	* The plugin slug, should represent the plugin directory name.
	*/
 define( 'ECOLE_CREATIVE_BANNER_PLUGIN_SLUG', 'ecoles-creatives-banner' );

 /**
	* The name of the plugin directory (expected value).
	*/
 define( 'ECOLE_CREATIVE_BANNER_PLUGIN_DIR_NAME', ECOLE_CREATIVE_BANNER_PLUGIN_SLUG );


/**
 * The path of this installed plugin.
 */
define( 'ECOLE_CREATIVE_BANNER_PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));

/**
 * The name of the plugin file, ie : mill3-wp-utils.php
 */
define( 'ECOLE_CREATIVE_BANNER_PLUGIN_FILE_NAME', basename(__FILE__) );

/**
 * The name of the plugin file using expected directory structure, should be : mill3-wp-utils-plugin/mill3-wp-utils.php
 */
// define( 'ECOLE_CREATIVE_BANNER_PLUGIN_FILE', join("/", [ECOLE_CREATIVE_BANNER_PLUGIN_DIR_NAME, ECOLE_CREATIVE_BANNER_PLUGIN_FILE_NAME]));
define( 'ECOLE_CREATIVE_BANNER_PLUGIN_FILE', join("/", [__DIR__, ECOLE_CREATIVE_BANNER_PLUGIN_FILE_NAME]));

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-ecoles-creatives-banner-activator.php
 */
function activate_ecoles_creatives_banner() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ecoles-creatives-banner-activator.php';
	Ecoles_Creatives_Banner_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-ecoles-creatives-banner-deactivator.php
 */
function deactivate_ecoles_creatives_banner() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ecoles-creatives-banner-deactivator.php';
	Ecoles_Creatives_Banner_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_ecoles_creatives_banner' );
register_deactivation_hook( __FILE__, 'deactivate_ecoles_creatives_banner' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-ecoles-creatives-banner.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_ecoles_creatives_banner() {
	$plugin = new Ecoles_Creatives_Banner();
	$plugin->run();
}

run_ecoles_creatives_banner();

// register theme function
if ( ! function_exists( 'ecoles_creatives_banner' ) ) {
	/**
	 * Display the banner
	 *
	 * @since 1.0.0
	 */
	function ecoles_creatives_banner($theme = 'dark', $slogan = true) {
		return Ecoles_Creatives_Banner::display($theme, $slogan);
	}
}
