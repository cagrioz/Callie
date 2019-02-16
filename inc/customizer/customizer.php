<?php
/**
 * Callie Customizer
 *
 * @package    Callie
 * @version    1.0
 * @author     CreativeLibrary <creativelibraryemail>
 * @copyright  Copyright (c) 2018, CreativeLibrary
 * @link       demolinkhere
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2 or later
 */

function callie_customize_register( $wp_customize ) {

	// Remove Sections
    $wp_customize->get_setting('blogname')->transport         = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
    $wp_customize->remove_section("colors");
    $wp_customize->remove_section("static_front_page");
    $wp_customize->remove_section("header_image");
    $wp_customize->remove_section("background_image");

	/* ------------------------------------------------ */
	/* THEME OPTIONS PANEL
	/* ------------------------------------------------ */

	// Theme Options Panel
	$wp_customize->add_panel( 'theme_options', array(
	    'priority' 	  =>	10,
	    'capability'  =>	'edit_theme_options',
	    'title' 	  =>	esc_html__( 'Theme Options', 'callie' ),
	) );

    // Social Media Panel
    $wp_customize->add_panel( 'social_media', array(
        'priority'    =>    20,
        'capability'  =>    'edit_theme_options',
        'title'       =>    esc_html__( 'Social Media', 'callie' )
    ) );

	/* ------------------------------------------------ */
	/* CUSTOM SECTIONS
	/* ------------------------------------------------ */

	// Layout Options Section
	$wp_customize->add_section( 'layout', array(
		'priority'    => 10,
		'title'       => esc_html__( 'Layout Options', 'callie' ),
		'panel'       => 'theme_options',
	) );

    // Story Settings Section
    $wp_customize->add_section( 'story', array(
        'priority'    => 20,
        'title'       => esc_html__( 'Story Settings', 'callie' ),
        'panel'       => 'theme_options',
    ) );

	// Post Settings Section
	$wp_customize->add_section( 'post', array(
		'priority'    => 30,
		'title'       => esc_html__( 'Post Settings', 'callie' ),
		'panel'       => 'theme_options',
	) );

    // Social Profiles Section
    $wp_customize->add_section( 'social_profiles', array(
        'priority'    => 10,
        'title'       => esc_html__( 'Social Profiles', 'callie' ),
        'panel'       => 'social_media',
    ) );

    // Share Links Section
    $wp_customize->add_section( 'share_links', array(
        'priority'    => 20,
        'title'       => esc_html__( 'Share Links', 'callie' ),
        'panel'       => 'social_media',
    ) );

	/* ------------------------------------------------ */
	/* LAYOUT OPTIONS SETTINGS
	/* ------------------------------------------------ */

	// Homepage Sidebar Layout
    $wp_customize->add_setting( 'home_sidebar', array(
        'sanitize_callback' => 'callie_sanitize_select',
        'type'              => 'theme_mod',
        'default'           => 'r_sidebar'
    ) );

    // Single Post Layout
    $wp_customize->add_setting( 'single_sidebar', array(
        'sanitize_callback' => 'callie_sanitize_select',
        'type'              => 'theme_mod',
        'default'           => 'r_sidebar'
    ) );

    // Archive Page Layout
    $wp_customize->add_setting( 'archive_sidebar', array(
        'sanitize_callback' => 'callie_sanitize_select',
        'type'              => 'theme_mod',
        'default'           => 'r_sidebar'
    ) );

	/* ------------------------------------------------ */
	/* LAYOUT OPTIONS CONTROLS
	/* ------------------------------------------------ */

    // Homepage Sidebar Layout
    $wp_customize->add_control('home_sidebar', array(
        'settings'    => 'home_sidebar',
        'priority'    => 10,
        'section'     => 'layout',
        'label'       => esc_html__( 'Homepage Layout', 'callie' ),
        'type'        => 'select',
        'choices'     => array(
            'r_sidebar'    => esc_html__( 'Right Sidebar', 'callie' ),
            'l_sidebar'    => esc_html__( 'Left Sidebar', 'callie' ),
            'no_sidebar'   => esc_html__( 'Full Width (No sidebar)', 'callie' )
        )
    ) );

    // Single Post Layout
    $wp_customize->add_control('single_sidebar', array(
        'settings'    => 'single_sidebar',
        'priority'    => 30,
        'section'     => 'layout',
        'label'       => esc_html__( 'Single Post Layout', 'callie' ),
        'type'        => 'select',
        'choices'     => array(
            'r_sidebar'    => esc_html__( 'Right Sidebar', 'callie' ),
            'l_sidebar'    => esc_html__( 'Left Sidebar', 'callie' ),
            'no_sidebar'   => esc_html__( 'Full Width (No sidebar)', 'callie' )
        )
    ) );

    // Archive Page Layout
    $wp_customize->add_control('archive_sidebar', array(
        'settings'    => 'archive_sidebar',
        'priority'    => 50,
        'section'     => 'layout',
        'label'       => esc_html__( 'Archive Sidebar Layout', 'callie' ),
        'type'        => 'select',
        'choices'     => array(
            'r_sidebar'    => esc_html__( 'Right Sidebar', 'callie' ),
            'l_sidebar'    => esc_html__( 'Left Sidebar', 'callie' ),
            'no_sidebar'   => esc_html__( 'Full Width (No sidebar)', 'callie' )
        )
    ) );

    /* ------------------------------------------------ */
    /* STORY SETTINGS SECTION SETTINGS
    /* ------------------------------------------------ */

    $wp_customize->add_setting( 'hide_story', array(
        'sanitize_callback' => 'callie_sanitize_callback',
        'type'              => 'theme_mod',
        'default'           => false
    ) );

    /* ------------------------------------------------ */
    /* STORY SETTINGS SECTION CONTROLS
    /* ------------------------------------------------ */

    /* ------------------------------------------------ */
    /* POST SETTINGS SECTION SETTINGS
    /* ------------------------------------------------ */


    /* ------------------------------------------------ */
    /* POST SETTINGS SECTION CONTROLS
    /* ------------------------------------------------ */




    /* ------------------------------------------------ */
    /* SOCIAL PROFILES SECTION SETTINGS & CONTROLS
    /* ------------------------------------------------ */
    $socials = array(
        'facebook'     => 'Facebook',
        'twitter'      => 'Twitter',
        'instagram'    => 'Instagram',
        'pinterest'    => 'Pinterest',
        'google-plus'  => 'Google Plus',
        'tumblr'       => 'Tumblr',
        'youtube-play' => 'Youtube',
        'vimeo'        => 'Vimeo',
        'dribbble'     => 'Dribbble',
        'linkedin'     => 'Linkedin',
        'rss'          => 'RSS'
    );

    $priority1 = 10;

    // Social Medias
    foreach ( $socials as $social => $social_name ) {
        $wp_customize->add_setting( 'social_' . $social, array(
            'sanitize_callback' => 'callie_sanitize_callback',
            'type'              => 'theme_mod',
            'default'           => ''
        ) );

        $wp_customize->add_control( 'social_' . $social, array(
            'settings'    => 'social_' . $social,
            'priority'    => $priority,
            'section'     => 'social_profiles',
            'label'       => $social_name,
            'type'        => 'text'
        ) );

        $priority1 += 10;
    }

    /* ------------------------------------------------ */
    /* SHARE LINKS SECTION SETTINGS & CONTROLS
    /* ------------------------------------------------ */
    $shares = array(
        'facebook'   => 'Facebook',
        'twitter'     => 'Twitter',
        'pinterest'   => 'Pinterest',
        'google-plus' => 'Google Plus',
        'linkedin'    => 'Linkedin',
        'reddit'      => 'Reddit',
        'tumblr'      => 'Tumblr'
    );

    $priority2 = 10;
    foreach ( $shares as $share => $social_name ) {
        $wp_customize->add_setting( 'share_' . $share, array(
            'sanitize_callback' => 'callie_sanitize_callback',
            'type'              => 'theme_mod',
            'default'           => false
        ) );

        $wp_customize->add_control( 'share_' . $share, array(
            'settings'    => 'share_' . $share,
            'priority'    => $priority,
            'section'     => 'share_links',
            'label'       => $social_name,
            'type'        => 'checkbox'
        ) );

        $priority2 += 10;
    }

}
add_action( 'customize_register', 'callie_customize_register' );


/* Sanitize nonnegative integer */
function callie_sanitize_number( $value ) {
	$value = absint( $value );
	if ( ! $value )
		$value = '';
	return $value;
}

/* Sanitize the checkbox */
function callie_sanitize_checkbox( $value ) {
	if ( 0 == $value )
		return false;
	else
		return true;
}

/* Sanitize the Callback */
function callie_sanitize_callback( $value ) {
	return $value;
}

/* Sanitize the Select */
function callie_sanitize_select( $input, $setting ) {
  // Ensure input is a slug.
  $input = sanitize_key( $input );
  // Get list of choices from the control associated with the setting.
  $choices = $setting->manager->get_control( $setting->id )->choices;
  // If the input is a valid key, return it; otherwise, return the default.
  return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}
