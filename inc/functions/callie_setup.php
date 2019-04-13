<?php
/**
 * Callie Setup, Scripts and Styles
 *
 * @package    Callie
 * @version    1.0
 * @author     useCSS <cagriozarpaciii@gmail.com>
 * @copyright  Copyright (c) 2019, useCSS
 * @link       https://clibrary.pro/callie
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
		add_image_size( 'callie_story_thumb', 138, 138, true );
		add_image_size( 'callie_widget_post', 200, 200, true );
		add_image_size( 'callie_thumb', 532, 532, true );

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
		add_editor_style( array( 'assets/css/editor-style.css', callie_fonts_url() ) );
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
			$fonts[] = 'Lato:400,700';
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
if ( ! function_exists('callie_register_sidebars') ) {
	function callie_register_sidebars() {

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

			for ($i = 1; $i <= 4; $i++) {
				register_sidebar( array(
					'name'          => sprintf( esc_html__( 'Footer Column %s', 'callie' ), $i ),
					'id'            => 'footer-widget-' . $i,
					'description'   => esc_html__( 'Add widgets here.', 'callie' ),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<div class="widget-title"><h4>',
			        'after_title'   => '</h4></div>',
				) );
			}

		}

	}
}
add_action('widgets_init', 'callie_register_sidebars');

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
		wp_enqueue_style( 'callie_style', get_template_directory_uri() . '/style.css', array(), CALLIE_VERSION );
		wp_enqueue_style( 'callie_responsive', get_template_directory_uri() . '/assets/css/responsive.css', array(), CALLIE_VERSION );

		/**
		 * Load scripts
		 */
		wp_enqueue_script( 'callie_story', get_template_directory_uri() . '/assets/js/libs/callie-story.js', array('jquery'), CALLIE_VERSION, true );
		wp_enqueue_script( 'callie_magnific', get_template_directory_uri() . '/assets/js/libs/magnific-popup.min.js', array('jquery'), '1.1.0', true );
		wp_enqueue_script( 'callie_owl', get_template_directory_uri() . '/assets/js/libs/owl.carousel.min.js', array('jquery'), '2.3.4', true );
		wp_enqueue_script( 'callie_fitvids', get_template_directory_uri() . '/assets/js/libs/fitvids.js', array(), '1.1.0', true );
		wp_enqueue_script( 'masonry' );
		wp_enqueue_script( 'callie_script', get_template_directory_uri() . '/assets/js/callie.js', array('jquery', 'masonry'), CALLIE_VERSION, true );

		if ( is_singular() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	 }
endif;
add_action( 'wp_enqueue_scripts', 'callie_load_scripts' );

function callie_my_load_more_scripts() {
 
	global $wp_query; 
 
	// In most cases it is already included on the page and this line can be removed
	wp_enqueue_script('jquery');
 
	// register our main script but do not enqueue it yet
	wp_register_script( 'callie_loadmore', get_stylesheet_directory_uri() . '/callieloadmore.js', array('jquery', 'masonry') );
 
	// now the most interesting part
	// we have to pass parameters to callieloadmore.js script but we can get the parameters values only in PHP
	// you can define variables directly in your HTML but I decided that the most proper way is wp_localize_script()
	wp_localize_script( 'callie_loadmore', 'callie_loadmore_params', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
		'posts' => json_encode( $wp_query->query_vars ), // everything about your loop is here
		'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
		'max_page' => $wp_query->max_num_pages
	) );
 
 	wp_enqueue_script( 'callie_loadmore' );
}
 
add_action( 'wp_enqueue_scripts', 'callie_my_load_more_scripts' );

function callie_loadmore_ajax_handler(){
 
	// prepare our arguments for the query
	$args = json_decode( stripslashes( $_POST['query'] ), true );
	$args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
	$args['post_status'] = 'publish';
 
	// it is always better to use WP_Query but not here
	query_posts( $args );
 
	if( have_posts() ) :
 
		// run the loop
		while( have_posts() ): the_post();
 
			// look into your theme code how the posts are inserted, but you can use your own HTML of course
			// do you remember? - my example is adapted for Twenty Seventeen theme
			get_template_part( 'inc/post/content' );
			// for the test purposes comment the line above and uncomment the below one
			// the_title();
 
 
		endwhile;
 
	endif;
	die; // here we exit the script and even no wp_reset_query() required!
}
 
 
 
add_action('wp_ajax_loadmore', 'callie_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'callie_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}