<?php
/**
 * Aletheia's custom functions and definitions.
 *
 * @package Aletheia_Child_Theme
 * @since   1.0
 */

/**
 * Add a hook for custom actions before loading this file.
 */
do_action( 'aletheia_before_functions' );

/**
 * Set $stylesheet_directory to avoid calling get_template_directory() all the time.
 */
$stylesheet_directory = get_stylesheet_directory();

/**
 * Custom setup for this child theme.
 */
require $stylesheet_directory . '/includes/custom-setup.php';

/**
 * Custom header implementation.
 */
require $stylesheet_directory . '/includes/custom-header.php';

/**
 * Customizer additions.
 */
require $stylesheet_directory . '/includes/customizer.php';

/**
 * Add a hook for custom actions after loading this file.
 */
do_action( 'aletheia_after_functions' );
