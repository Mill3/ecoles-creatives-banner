<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://mill3.studio
 * @since      1.0.0
 *
 * @package    Ecoles_Creatives_Banner
 * @subpackage Ecoles_Creatives_Banner/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Ecoles_Creatives_Banner
 * @subpackage Ecoles_Creatives_Banner/includes
 * @author     MILL3 Studio <antoine@mill3.studio>
 */
class Ecoles_Creatives_Banner {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Ecoles_Creatives_Banner_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * The plugin updater
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Ecole_Creative_Banner_Updater    $updater    The plugin updater.
	 */
	protected $updater;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'ECOLES_CREATIVES_BANNER_VERSION' ) ) {
			$this->version = ECOLES_CREATIVES_BANNER_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'ecoles-creatives-banner';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Ecoles_Creatives_Banner_Loader. Orchestrates the hooks of the plugin.
	 * - Ecoles_Creatives_Banner_i18n. Defines internationalization functionality.
	 * - Ecoles_Creatives_Banner_Admin. Defines all hooks for the admin area.
	 * - Ecoles_Creatives_Banner_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * Updater class
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-ecoles-creatives-banner-updater.php';

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-ecoles-creatives-banner-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-ecoles-creatives-banner-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-ecoles-creatives-banner-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-ecoles-creatives-banner-public.php';

		// create an instances of classes
		$this->loader = new Ecoles_Creatives_Banner_Loader();
		$this->updater = new Ecole_Creative_Banner_Updater();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Ecoles_Creatives_Banner_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Ecoles_Creatives_Banner_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Ecoles_Creatives_Banner_Admin( $this->get_plugin_name(), $this->get_version() );

		// Updater
    $this->loader->add_filter('pre_set_site_transient_update_plugins', $this->updater, 'check_for_update');

		// Admin styles and scripts
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Ecoles_Creatives_Banner_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Ecoles_Creatives_Banner_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	// Display the banner
	public static function display($theme = 'dark', $slogan = true) {
		$logo = "images/ecoles-creatives-logo-{$theme}.png"

		?>

			<div class="ecoles-creatives-banner --theme-<?php echo $theme ?>">
				<a href="https://www.ecolescreatives.com/" target="_blank" class="ecoles-creatives-banner__logo">
					<img src="<?php echo Ecoles_Creatives_Banner_Public::public_path() . $logo ?>" alt="Les Écoles Créatives" />
				</a>
				<?php if ( $slogan == true ): ?>
					<span class="ecoles-creatives-banner__slogan">Membre du réseau pédagogique des Écoles Créatives</span>
				<?php endif; ?>
			</div>

		<?php
	}

}
