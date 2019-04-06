<?php
/**
 * Callie Customizer
 *
 * @package    Callie
 * @version    1.0
 * @author     useCSS <cagriozarpaciii@gmail.com>
 * @copyright  Copyright (c) 2019, useCSS
 * @link       https://clibrary.pro/callie
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
        'priority'    => 20,
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
        'priority'    => 30,
        'section'     => 'layout',
        'label'       => esc_html__( 'Archive Page Sidebar Layout', 'callie' ),
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

    // Hide Story
    $wp_customize->add_setting( 'hide_story', array(
        'sanitize_callback' => 'callie_sanitize_checkbox',
        'type'              => 'theme_mod',
        'default'           => false
    ) );

    // Story Qty
    $wp_customize->add_setting( 'story_qty', array(
        'sanitize_callback' => 'callie_sanitize_number',
        'type'              => 'theme_mod',
        'default'           => 6
    ) );

    // Story Image Duration
    $wp_customize->add_setting( 'story_img_duration', array(
        'sanitize_callback' => 'callie_sanitize_number',
        'type'              => 'theme_mod',
        'default'           => 3
    ) );

    // Story Video Duration
    $wp_customize->add_setting( 'story_video_duration', array(
        'sanitize_callback' => 'callie_sanitize_number',
        'type'              => 'theme_mod',
        'default'           => ''
    ) );

    /* ------------------------------------------------ */
    /* STORY SETTINGS SECTION CONTROLS
    /* ------------------------------------------------ */

    // Hide Story
    $wp_customize->add_control( 'hide_story', array(
        'settings'    => 'hide_story',
        'priority'    => 10,
        'section'     => 'story',
        'label'       =>  esc_html__( 'Hide Header Stories', 'callie' ),
        'type'        => 'checkbox'
    ) );

    // Story Qty
    $wp_customize->add_control( 'story_qty', array(
        'settings'    => 'story_qty',
        'priority'    => 20,
        'section'     => 'story',
        'label'       => esc_html__( 'Limit of Story Qty', 'callie' ),
        'description' => esc_html__( 'Number of stories to show on header area ( default: 6 ).', 'callie' ),
        'type'        => 'number'
    ) );

    // Story Image Duration
    $wp_customize->add_control( 'story_img_duration', array(
        'settings'    => 'story_img_duration',
        'priority'    => 30,
        'section'     => 'story',
        'label'       => esc_html__( 'Story Image Duration', 'callie' ),
        'description' => esc_html__( 'Story duration specifically for images ( default: 3 ).', 'callie' ),
        'type'        => 'number',
        'input_attrs' => array( 'min' => 1 )
    ) );

    // Story Video Duration
    $wp_customize->add_control( 'story_video_duration', array(
        'settings'    => 'story_video_duration',
        'priority'    => 40,
        'section'     => 'story',
        'label'       => esc_html__( 'Story Video Duration', 'callie' ),
        'description' => esc_html__( 'Story duration for videos ( default: unset/full ).', 'callie' ),
        'type'        => 'number',
        'input_attrs' => array( 'min' => 1 )
    ) );

    /* ------------------------------------------------ */
    /* POST SETTINGS SECTION SETTINGS
    /* ------------------------------------------------ */

    // Use Post Excerpt
    $wp_customize->add_setting( 'use_excerpt', array(
        'sanitize_callback' => 'callie_sanitize_checkbox',
        'type'              => 'theme_mod',
        'default'           => false
    ) );

    // Hide Post Images
    $wp_customize->add_setting( 'hide_post_images', array(
        'sanitize_callback' => 'callie_sanitize_checkbox',
        'type'              => 'theme_mod',
        'default'           => false
    ) );

    // Hide Post Pagination
    $wp_customize->add_setting( 'hide_post_pagination', array(
        'sanitize_callback' => 'callie_sanitize_checkbox',
        'type'              => 'theme_mod',
        'default'           => false
    ) );

    // Hide Related Posts
    $wp_customize->add_setting( 'hide_related_posts', array(
        'sanitize_callback' => 'callie_sanitize_checkbox',
        'type'              => 'theme_mod',
        'default'           => false
    ) );

    /* ------------------------------------------------ */
    /* POST SETTINGS SECTION CONTROLS
    /* ------------------------------------------------ */

    // Use Post Excerpt
    $wp_customize->add_control( 'use_excerpt', array(
        'settings'    => 'use_excerpt',
        'priority'    => 10,
        'section'     => 'post',
        'label'       =>  esc_html__( 'Use Post Excerpt', 'callie' ),
        'type'        => 'checkbox'
    ) );

    // Hide Post Images
    $wp_customize->add_control( 'hide_post_images', array(
        'settings'    => 'hide_post_images',
        'priority'    => 20,
        'section'     => 'post',
        'label'       =>  esc_html__( 'Hide All Post Images', 'callie' ),
        'type'        => 'checkbox'
    ) );

    // Hide Post Pagination
    $wp_customize->add_control( 'hide_post_pagination', array(
        'settings'    => 'hide_post_pagination',
        'priority'    => 30,
        'section'     => 'post',
        'label'       =>  esc_html__( 'Hide Post Pagination', 'callie' ),
        'type'        => 'checkbox'
    ) );

    // Hide Related Posts
    $wp_customize->add_control( 'hide_related_posts', array(
        'settings'    => 'hide_related_posts',
        'priority'    => 40,
        'section'     => 'post',
        'label'       =>  esc_html__( 'Hide Related Posts', 'callie' ),
        'type'        => 'checkbox'
    ) );


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
            'priority'    => $priority1,
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
            'sanitize_callback' => 'callie_sanitize_checkbox',
            'type'              => 'theme_mod',
            'default'           => false
        ) );

        $wp_customize->add_control( 'share_' . $share, array(
            'settings'    => 'share_' . $share,
            'priority'    => $priority2,
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
