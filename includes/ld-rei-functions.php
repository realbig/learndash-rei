<?php
/**
 * Common, core functions.
 *
 * @since 0.1.0
 *
 * @package LD_REI
 * @subpackage LD_REI/includes
 */

defined( 'ABSPATH' ) || die();

/**
 * Gets the main instance for the main plugin class.
 *
 * @since 0.1.0
 *
 * @return LD_REI
 */
function LD_REI() {
	return LD_REI::getInstance();
}