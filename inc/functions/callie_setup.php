<?php
/**
 * Callie Setup, Scripts and Styles
 *
 * @package    Callie
 * @version    1.0
 * @author     CreativeLibrary <creativelibraryemail>
 * @copyright  Copyright (c) 2018, CreativeLibrary
 * @link       demolinkhere
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2 or later
 */

if ( ! function_exists( 'callie_setup' ) ) :
	/**
	 * Callie setup
	 */
	function callie_setup() {

		load_theme_textdomain( 'callie', get_template_directory() . '/languages' );

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/**
		 * Register Menus
		 */
		register_nav_menus( array(
			'main-menu' => esc_html__( 'Main Menu', 'callie' )
 		) );

		/**
		 * Add post type
		 */
		add_theme_support( 'post-formats', array( 'gallery', 'video' ) );

		/**
		 * Add post thumbnail support
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Add image size
		 */
		add_image_size( 'callie_story_thumb', 69, 69, true );
		add_image_size( 'callie_widget_post', 200, 200, true );
		add_image_size( 'callie_thumb', 500, 500, true );

		/**
		 * Custom Backgrounds
		 */
		$args = array(
			'default-color' => 'ffffff',
		);
	    add_theme_support( 'custom-background', $args );

	    /**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		/**
		 * Custom Header
		 */
	    $defaults = array(
			'width'                  => 1920,
			'height'                 => 520,
			'flex-height'            => false,
			'flex-width'             => false,
			'header-text'            => false,
		);
	    add_theme_support( 'custom-header', $defaults );

		/**
		 * Add feed links
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Add title tag
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Add Editor Style
		 */

	}
endif;
add_action( 'after_setup_theme', 'callie_setup' );

/**
 * Register Google Fonts
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'callie_fonts_url' ) ) :
	function callie_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		/* translators: If there are characters in your language that are not supported by Dosis, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Lora font: on or off', 'callie' ) ) {
			$fonts[] = 'Dosis:300,400';
		}

		/* translators: If there are characters in your language that are not supported by Lato, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Lato font: on or off', 'callie' ) ) {
			$fonts[] = 'Lato:700';
		}

		/* translators: If there are characters in your language that are not supported by Playfair Display, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Playfair Display font: on or off', 'callie' ) ) {
			$fonts[] = 'Playfair+Display:400,700';
		}

		if ( $fonts ) {
			$fonts_url = add_query_arg( array(
				'family' => urlencode( implode( '|', $fonts ) ),
				'subset' => urlencode( $subsets ),
			), 'https://fonts.googleapis.com/css' );
		}

		return $fonts_url;
	}
endif;

/**
 * Register Sidebars
 *
 * @since 1.0
 */
if ( function_exists('register_sidebar') ) {

	register_sidebar(array(
		'name'          => esc_html__( 'Sidebar', 'callie' ),
		'id'            => 'sidebar-primary',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'callie' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title"><h4>',
		'after_title'   => '</h4></div>',
	));

	register_sidebar(array(
		'name'          => esc_html__( 'Page Sidebar', 'callie' ),
		'id'            => 'sidebar-pages',
		'description'   => esc_html__( 'Add widgets here to appear in your page sidebar.', 'callie' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title"><h4>',
		'after_title'   => '</h4></div>',
	));

}

if ( ! function_exists( 'callie_load_scripts' ) ) :
	/**
	 * Register and enqueue styles/scripts
	 */
	function callie_load_scripts() {

		/**
		 * Load Fonts
		 */
		wp_enqueue_style( 'callie-fonts', callie_fonts_url(), array(), null );

		/**
		 * Load styles
		 */
		wp_enqueue_style( 'callie_animate', get_template_directory_uri() . '/assets/css/animate.min.css', array(), '3.7.0' );
		wp_enqueue_style( 'callie_story', get_template_directory_uri() . '/assets/css/callie-story.css', array(), CALLIE_VERSION );
		wp_enqueue_style( 'callie_font_awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '4.7.0' );
		wp_enqueue_style( 'callie_owl', get_template_directory_uri() . '/assets/css/owl.carousel.min.css', array(), '2.3.4' );
		wp_enqueue_style( 'callie_magnific', get_template_directory_uri() . '/assets/css/magnific-popup.min.css', array(), '1.1.0' );
		wp_enqueue_style( 'callie_responsive', get_template_directory_uri() . '/assets/css/responsive.css', array(), CALLIE_VERSION );
		wp_enqueue_style( 'callie_style', get_template_directory_uri() . '/style.css', array(), CALLIE_VERSION );

		/**
		 * Load scripts
		 */
		wp_enqueue_script( 'callie_story', get_template_directory_uri() . '/assets/js/libs/callie-story.js', array('jquery'), CALLIE_VERSION, true );
		wp_enqueue_script( 'callie_magnific', get_template_directory_uri() . '/assets/js/libs/magnific-popup.min.js', array('jquery'), '1.1.0', true );
		wp_enqueue_script( 'callie_owl', get_template_directory_uri() . '/assets/js/libs/owl.carousel.min.js', array('jquery'), '2.3.4', true );
		wp_enqueue_script( 'callie_fitvids', get_template_directory_uri() . '/assets/js/libs/fitvids.js', array(), '1.1.0', true );
		wp_enqueue_script( 'masonry' );
		wp_enqueue_script( 'callie_script', get_template_directory_uri() . '/assets/js/callie.js', array('jquery'), CALLIE_VERSION, true );

		if ( is_singular() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	 }
endif;
add_action( 'wp_enqueue_scripts', 'callie_load_scripts' );