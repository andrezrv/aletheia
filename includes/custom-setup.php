<?php
/**
 * Theme setup. All the functions included here are pluggable.
 *
 * @package Aletheia_Child_Theme
 * @since   1.0
 */

/**
 * Add a hook for custom actions before loading this file.
 */
do_action( 'aletheia_before_setup' );

if ( ! function_exists( 'aletheia_register_options' ) ) :
add_action( 'follet_options_register', 'aletheia_register_options' );
/**
 * Set internal options for this child theme before parent ones.
 *
 * @return void
 * since   1.0
 */
function aletheia_register_options() {

	do_action( 'aletheia_options_register' );

	$options = array(
		'top_navigation_style'             => 'navbar-inverse',
		'primary_color'                    => '#D9534F',
		'secondary_color'                  => '#DD3333',
		'header_background_color'          => '#D9534F',
		'primary_sidebar_background_color' => '#FFFFFF',
		'parallax_header'                  => true,
	);
	foreach ( $options as $name => $default ) {
		if ( ! follet_option_exists( $name ) ) {
			follet_register_option(
				$name,
				$default,
				get_theme_mod( $name, $default )
			);
		}
	}
}
endif;

if ( ! function_exists( 'aletheia_enqueue_scripts' ) ) :
add_action( 'wp_enqueue_scripts', 'aletheia_enqueue_scripts', 20 );
/**
 * Dequeue styles that we're not gonna use and replace them with our own.
 *
 * @return void
 * @since  1.0
 */
function aletheia_enqueue_scripts() {

	$stylesheet_directory_uri = get_stylesheet_directory_uri();

	wp_dequeue_style( 'follet-fonts' );
	wp_enqueue_style(
		'aletheia-fonts',
		$stylesheet_directory_uri . '/css/fonts.css',
		false,
		follet()->theme_version
	);

	wp_dequeue_style( 'follet-general-colors' );
	wp_enqueue_style(
		'aletheia-general-colors',
		$stylesheet_directory_uri . '/css/general-colors.css',
		false,
		follet()->theme_version
	);

	wp_dequeue_style( 'follet-primary-color' );
	wp_enqueue_style(
		'aletheia-primary-color',
		$stylesheet_directory_uri . '/css/primary-color.css',
		false,
		follet()->theme_version
	);

	wp_dequeue_style( 'follet-secondary-color' );
	wp_enqueue_style(
		'aletheia-secondary-color',
		$stylesheet_directory_uri . '/css/secondary-color.css',
		false,
		follet()->theme_version
	);

	wp_dequeue_style( 'follet-primary-sidebar-color' );

	wp_dequeue_style( 'follet-icons' );
	wp_enqueue_style(
		'aletheia-icons',
		$stylesheet_directory_uri . '/css/icons.css',
		false,
		follet()->theme_version
	);

	if ( follet_get_current( 'parallax_header' ) ) {
		wp_enqueue_script(
			'aletheia-parallax',
			$stylesheet_directory_uri . '/js/min/parallax.min.js',
			array( 'jquery' ),
			follet()->theme_version,
			true
		);
	}

}
endif;

if ( ! function_exists( 'aletheia_add_editor_styles' ) ) :
add_action( 'init', 'aletheia_add_editor_styles', 11 );
/**
 * Add our own styles for post editor.
 *
 * @return void
 * @since  1.0
 */
function aletheia_add_editor_styles() {

	// Remove previously loaded editor styles.
	remove_editor_styles();

	$stylesheet_directory_uri = get_stylesheet_directory_uri();
	add_editor_style( $stylesheet_directory_uri . '/style.css' );
	add_editor_style( $stylesheet_directory_uri . '/fonts/genericons/genericons.css' );
	add_editor_style( $stylesheet_directory_uri . '/css/fonts.css' );
	add_editor_style( $stylesheet_directory_uri . '/css/icons.css' );
	add_editor_style( $stylesheet_directory_uri . '/css/general-colors.css' );
	add_editor_style( $stylesheet_directory_uri . '/css/primary-color.css' );
	add_editor_style( $stylesheet_directory_uri . '/css/secondary-color.css' );

}
endif;

if ( ! function_exists( 'follet_primary_color' ) ) :
/**
 * Nuke follet_primary_color(), so we can use our own primary color.
 *
 * @return void
 * @since  1.0
 */
function follet_primary_color() {
	return;
}
endif;

if ( ! function_exists( 'aletheia_primary_color' ) ) :
add_action( 'wp_enqueue_scripts', 'aletheia_primary_color', 20 );
/**
 * Add styles when a primary color is set.
 *
 * @return void
 * @since  1.0
 */
function aletheia_primary_color() {
	$primary_color_style = follet_override_stylesheet_colors(
		follet_get_current( 'primary_color' ),
		get_stylesheet_directory() . '/css/primary-color.css',
		follet_get_default( 'primary_color' ),
		array( follet_get_default( 'primary_color' ) )
	);
	if ( $primary_color_style ) {
		wp_add_inline_style( 'aletheia-primary-color', $primary_color_style );
	}
}
endif;

if ( ! function_exists( 'follet_secondary_color' ) ) :
/**
 * Nuke follet_secondary_color(), so we can use our own secondary color.
 *
 * @return void
 * @since  1.0
 */
function follet_secondary_color() {
	return;
}
endif;

if ( ! function_exists( 'aletheia_secondary_color' ) ) :
add_action( 'wp_enqueue_scripts', 'aletheia_secondary_color', 21 );
/**
 * Add styles when a secondary color is set.
 *
 * @return void
 * @since  1.0
 */
function aletheia_secondary_color() {
	$secondary_color_style = follet_override_stylesheet_colors(
		follet_get_current( 'secondary_color' ),
		get_stylesheet_directory() . '/css/secondary-color.css',
		follet_get_default( 'secondary_color' ),
		array( follet_get_default( 'secondary_color' ) )
	);
	if ( $secondary_color_style ) {
		wp_add_inline_style( 'aletheia-secondary-color', $secondary_color_style );
	}
}
endif;

if ( ! function_exists( 'follet_primary_sidebar_background_color' ) ) :
/**
 * We don't need a custom color for sidebar background.
 *
 * @return void
 * @since  1.0
 */
function follet_primary_sidebar_background_color() {
	return;
}
endif;

if ( ! function_exists( 'aletheia_custom_background_args' ) ) :
add_filter( 'follet_custom_background_args', 'aletheia_custom_background_args' );
/**
 * Modify default arguments for custom background support.
 *
 * @return array
 * @since  1.0
 */
function aletheia_custom_background_args() {
	$args = array(
		'default-color' => 'EDEDED',
		'default-image' => '',
	);
	return $args;
}
endif;

if ( ! function_exists( 'aletheia_credits' ) ) :
add_filter( 'follet_footer_credits', 'aletheia_credits' );
/**
 * Credits for this child theme.
 *
 * @return string
 * @since  1.0
 */
function aletheia_credits() {
	$credits = sprintf( __( 'Copyright %s', 'follet_theme' ), '&copy; ' . date( 'Y' ) . ' <a href="' . home_url() . '">' . get_bloginfo( 'name' ) . '</a>. ' ) . sprintf( __( 'Powered by %s', 'follet_theme' ), '<a href="http://www.wordpress.org/" class="wp-url">WordPress</a> ' . __( 'and', 'aletheia_theme' ) . ' <a href="http://github.com/andrezrv/aletheia" class="theme-url">Al&eacute;theia</a>.' );
	return $credits;
}
endif;

/**
 * Add a hook for custom actions after loading this file.
 */
do_action( 'aletheia_after_setup' );
