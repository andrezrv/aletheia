<?php
/**
 * Implementation of the Custom Header feature.
 *
 * {@link http://codex.wordpress.org/Custom_Headers}
 *
 * @package Aletheia_Child_Theme
 * @since   1.0
 */

/**
 * Nuke follet_custom_header_setup(), so it doesn't get executed at parent
 * theme's level and we can use our custom header setup.
 *
 * @return void
 * @since  1.0
 */
function follet_custom_header_setup() {
	return;
}

if ( ! function_exists( 'aletheia_default_headers' ) ) :
	add_action( 'after_setup_theme', 'aletheia_default_headers', 1 );
	/**
	 * Set our own default headers.
	 *
	 * @return void
	 * @since  1.0
	 */
	function aletheia_default_headers() {
		add_theme_support( 'custom-header', apply_filters( 'follet_custom_header_args', array(
			'default-image'          => get_stylesheet_directory_uri() . '/images/bg-writer.jpg',
			'default-text-color'     => 'FFFFFF',
			'header-text'            => true,
			'width'                  => 1000,
			'height'                 => 250,
			'flex-height'            => true,
			'wp-head-callback'       => 'follet_header_style',
			'admin-head-callback'    => 'follet_admin_header_style',
			'admin-preview-callback' => 'follet_admin_header_image',
		) ) );
		register_default_headers( array(
			'writer' => array(
				'url'           => '%2$s/images/bg-writer.jpg',
				'thumbnail_url' => '%2$s/images/bg-writer-thumbnail.png',
				'description'   => __( 'Writer', 'aletheia_theme' )
			)
		) );
	}
endif;
