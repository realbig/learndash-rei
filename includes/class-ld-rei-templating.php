<?php
/**
 * Overrides some LD templates.
 *
 * @since 0.1.0
 *
 * @package learndash-rei
 * @subpackage learndash-rei/includes
 */

defined( 'ABSPATH' ) || die();

/**
 * class LD_REI_Templating
 *
 * Overrides some LD templates.
 *
 * @since 0.1.0
 *
 * @package learndash-rei
 * @subpackage learndash-rei/includes
 */
class LD_REI_Templating {

	/**
	 * LD_REI_Templating constructor.
	 *
	 * @since 0.1.0
	 */
	function __construct() {

		add_filter( 'learndash_template', array( $this, 'filter_templates' ), 10, 5 );
	}

	/**
	 * Filters LD templates.
	 *
	 * @since 0.1.0
	 * @access private
	 */
	function filter_templates( $filepath, $name, $args, $echo, $return_file_path ) {

		$new_filepath = LD_REI_DIR . "/templates/$name.php";

		if ( file_exists( $new_filepath ) ) {
			$filepath = $new_filepath;
		}

		return $filepath;
	}
}