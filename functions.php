<?php
/**
 * Functions and definitions
 *
 * @package Harmony
 * https://medium.com/@bluznierca1/understanding-php-namespaces-organising-your-code-ba2590c5e529
 */

namespace Harmony;

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
define( 'HARMONY_THEME', 'harmony' );
define( 'HARMONY_VERSION', time() );
define( 'HARMONY_DIR', rtrim( get_template_directory(), '/' ) );
define( 'HARMONY_URL', rtrim( get_template_directory_uri(), '/' ) );

/**
 * Theme setup.
 *
 * @since 1.0.0
 */
add_action(
	'after_setup_theme',
	function () {
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
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Enqueue editor styles.
		add_editor_style();
		
		/*
		 * Enable support for custom logo.
		 *
		 *  @since April 1.2
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 150,
				'width'       => 9999,
				'flex-height' => true,
			)
		);

		// add primary menu
		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', HARMONY_THEME ),
			)
		);
	}
);

/**
 * Enqueue scripts and styles.
 *
 * @since 1.0.0
 */
add_action(
	'wp_enqueue_scripts',
	function () {
		wp_enqueue_style( 'harmony-style', 
			HARMONY_URL . '/style.css', 
			array(), 
			HARMONY_VERSION 
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
);

/** #A4
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since themename 1.0
 */
add_action( 
	'widgets_init',
	function(){
	register_sidebar(
		array(
			'name'          => __( 'Primary Sidebar', HARMONY_THEME ),
			'id'            => 'sidebar-primary',
			'description'   => __( 'Appears in section', HARMONY_THEME ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
			)
		);
	} 
);

require( HARMONY_DIR . '/includes/customizer.php' );
require( HARMONY_DIR . '/includes/theme-admin-menu.php' );

//use function Harmony\Customizer\register_theme_customizer;
