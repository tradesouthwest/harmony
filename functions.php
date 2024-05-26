<?php
/**
 * Functions and definitions
 *
 * @package Harmony
 * @since 1.0.0
 */

namespace Harmony;

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

/* /////////////////////// Update Version Here. //////////////////// */
define( 'HARMONY_VERSION', '1.0.1' );
define( 'HARMONY_THEME', 'harmony' );
define( 'HARMONY_DIR', rtrim( get_template_directory(), '/' ) );
define( 'HARMONY_URL', rtrim( get_template_directory_uri(), '/' ) );

/**
 * Theme setup.
 *
 * @since 1.0.0
 */
add_action(	'after_setup_theme', __NAMESPACE__.'\setup_theme' );
	function setup_theme() 
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentysixteen
		 * If you're building a theme based on harmony, use a find and replace
		 * to change 'harmony' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'harmony', 
			get_template_directory_uri() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails.
		add_theme_support( 'post-thumbnails' );

		// Admin editor styles.
		add_theme_support( 'editor-styles' );

		// Add support for responsive embeds.
		//add_theme_support( 'responsive-embeds' );

		// Add theme support for selective refresh for widgets.
		//add_theme_support( 'customize-selective-refresh-widgets' );

		// Enqueue editor styles.
		add_editor_style();
		
		/*
		 * Enable support for custom logo.
		 *
		 *  @since Harmony 1.2
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 420,
				'width'       => 680,
				'flex-height' => true,
			)
		);

		// add primary menu
		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', HARMONY_THEME ),
				'secondary' => __( 'Very Top Menu', HARMONY_THEME ),
			)
		);
	}

/**
 * Enqueue scripts and styles.
 *
 * @since 1.0.0
 */
add_action(
	'wp_enqueue_scripts', __NAMESPACE__.'\enqueue_scripts' );
	function enqueue_scripts() 
	{
		wp_enqueue_style( 'harmony-style', 
			HARMONY_URL . '/style.css', 
			array(), 
			HARMONY_VERSION 
		);
		wp_enqueue_script( 'harmony-theme-script', 
			HARMONY_URL . '/includes/harmony-theme.js', 
			array( 'jquery' ), 
			HARMONY_VERSION, 
			false
		);
		// rtl style
		wp_style_add_data( 'harmony-style', 
			'rtl', 
			'replace' 
		);
		// comment scripts
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 
				'comment-reply' 
			);
		}
	}

/** #A4
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since themename 1.0
 */
add_action( 
	'widgets_init', __NAMESPACE__.'\load_widgets' );
	function load_widgets()
	{
	register_sidebar(
		array(
			'name'          => __( 'Primary Sidebar', HARMONY_THEME ),
			'id'            => 'sidebar-primary',
			'description'   => __( 'Appears before the footer section', HARMONY_THEME ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
			)
		);
	} 

/**
 * Returns a custom logo, linked to home 
 * 
 * @since 1.0.1
 */
add_action(
	'harmony_render_logo', __NAMESPACE__.'\render_logo' );
	function render_logo()
	{
		if( has_custom_logo() ) : 
		$logourl = esc_url( wp_get_attachment_url( get_theme_mod( 'custom_logo' ) ) );

		echo '<img src="'. esc_url( $logourl ) .'" 
		alt="'. get_bloginfo( 'name' ) .'" class="harmony-logo"/>';
		endif;
	}

/**
 * Return post thumbnail on excerpts
 * 
 * @since 1.0.1
 * @return Boolean
 */
add_action( 'harmony_thumbnail', __NAMESPACE__.'\render_thumbnail' );
	function render_thumbnail()
	{
		// If there are images
		if ( has_post_thumbnail() ) {
			echo '<figure class="harmony-has-thumbnail">';
				the_post_thumbnail();
			echo '</figure>';
		} else {
			echo '<span class="harmony-not-thumbnail"></span>';
		}
	}

/**
 * Include helper files
 * 
 * @since 1.0.0
 */
require(     HARMONY_DIR . '/includes/customizer.php' ); 

if ( is_admin() ) : 
	require( HARMONY_DIR . '/includes/theme-admin-menu.php' );
endif;

