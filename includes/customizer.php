<?php
/**
 * Customization management.
 *
 * @see {@link https://codex.wordpress.org/Theme_Customization_API}
 *
 * @package Aletheia_Child_Theme
 * @since   1.0
 */

if ( ! function_exists( 'aletheia_customize_register' ) ) :
add_action( 'customize_register', 'aletheia_customize_register' );
/**
 * Remove customizations we don't want for this child theme.
 *
 * @param $wp_customize WP_Customize instance.
 *
 * @return void
 * @since  1.0
 */
function aletheia_customize_register( $wp_customize ) {
	$wp_customize->remove_setting( 'primary_sidebar_background_color' );
	$wp_customize->remove_control( 'primary_sidebar_background_color' );
}
endif;
