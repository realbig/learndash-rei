<?php
/*
Plugin Name: Learndash REI
Description: Adds a few customizations to Learn Dash for REI.
Version: 0.1.0
Author: Real Big Marketing
Author URI: http://realbigmarketing.com
*/

defined( 'ABSPATH' ) || die();

if ( ! class_exists( 'LD_REI' ) ) {

	define( 'LD_REI_VERSION', '0.1.0' );
	define( 'LD_REI_DIR', plugin_dir_path( __FILE__ ) );
	define( 'LD_REI_URI', plugins_url( '', __FILE__ ) );

	/**
	 * Class LD_REI
	 *
	 * The main plugin class
	 *
	 * @since 0.1.0
	 *
	 * @package LD_REI
	 */
	final class LD_REI {

		/**
		 * Templating functionality.
		 *
		 * @since 0.1.0
		 *
		 * @var LD_REI_Templating
		 */
		public $templating;

		private function __clone() {
		}

		private function __wakeup() {
		}

		/**
		 * Returns the *Singleton* instance of this class.
		 *
		 * @since 0.1.0
		 *
		 * @staticvar Singleton $instance The *Singleton* instances of this class.
		 *
		 * @return LD_REI The *Singleton* instance.
		 */
		public static function getInstance() {

			static $instance = null;

			if ( null === $instance ) {
				$instance = new static();
			}

			return $instance;
		}

		/**
		 * LD_REI constructor.
		 *
		 * @since 0.1.0
		 */
		private function __construct() {

			$this->includes();
			$this->modules_init();

			add_action( 'init', array( $this, 'register_assets' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_frontend_assets' ) );
		}

		/**
		 * Adds all core files.
		 *
		 * @since 0.1.0
		 */
		private function includes() {

			require_once LD_REI_DIR . '/includes/class-ld-rei-templating.php';
		}

		/**
		 * Instantiates all modules of the plugin.
		 *
		 * @since 0.1.0
		 */
		private function modules_init() {

			$this->templating = new LD_REI_Templating();
		}

		/**
		 * Registers all plugin assets.
		 *
		 * @since 0.1.0
		 * @access private
		 */
		function register_assets() {

			wp_register_script(
				'ld-rei-front',
				LD_REI_URI . '/assets/dist/js/ld-rei-front.min.js',
				array( 'jquery' ),
				defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : LD_REI_VERSION
			);

			wp_register_style(
				'ld-rei-front',
				LD_REI_URI . '/assets/dist/css/ld-rei-front.min.css',
				array(),
				defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : LD_REI_VERSION
			);
		}

		/**
		 * Enqueue frontend assets.
		 *
		 * @since 0.1.0
		 * @access private
		 */
		function enqueue_frontend_assets() {

			wp_enqueue_script( 'ld-rei-front' );

			wp_enqueue_style( 'ld-rei-front' );
		}
	}

	// Init plugin after plugins are loaded
	add_action( 'plugins_loaded', 'ld_rei_init_plugin' );

	/**
	 * Initializes the plugin if Learn Dash has been loaded.
	 *
	 * @since 0.1.0
	 * @access private
	 */
	function ld_rei_init_plugin() {

		if ( defined( 'LEARNDASH_VERSION' ) ) {

			require_once LD_REI_DIR . '/includes/ld-rei-functions.php';
			LD_REI();
		} else {

			add_action( 'admin_notices', 'ld_rei_fail_init_notice' );
		}
	}

	/**
	 * Shows an admin notice for why the plugin could not be activated.
	 *
	 * @since 0.1.0
	 * @access private
	 */
	function ld_rei_fail_init_notice() {
		?>
		<div class="error">
			<p>
				<strong>Learn Dash REI</strong> could not be activated because <strong>Learn Dash LMS</strong> is not
				active. Please <a href="<?php echo admin_url( 'plugins.php' ); ?>">activate</a> <strong>Learn Dash
					LMS</strong> to continue using <strong>Learn Dash REI</strong>.
			</p>
		</div>
		<?php
	}
}