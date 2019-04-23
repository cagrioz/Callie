<?php
/**
 * Callie Post Format meta boxes
 *
 * @package    Callie
 * @version    1.0
 * @author     useCSS <cagriozarpaciii@gmail.com>
 * @copyright  Copyright (c) 2019, useCSS
 * @link       https://clibrary.pro/callie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2 or later
 */

/**
 * Register and load admin javascript
 */
function callie_admin_js($hook) {
	if ($hook == 'post.php' || $hook == 'post-new.php') {
		wp_enqueue_script( 'callie-metabox', get_template_directory_uri() . '/inc/metabox/js/metabox.js', array('jquery'), CALLIE_VERSION, true );

	}
}
add_action('admin_enqueue_scripts','callie_admin_js',10,1);

/**
 * Registering meta boxes
 *
 */

add_filter( 'rwmb_meta_boxes', 'Callie_Metaboxes' );

/** Register meta boxes **/
function Callie_Metaboxes( $meta_boxes ) {

	// Better has an underscore as last sign
	$prefix = 'callie_';

	/* -------------------------
	 ----- Post Formats / Start
	------------------------- */

	// Gallery Format Metabox
	$meta_boxes[] = array(
		'id'         => 'callie_gallery_format_metabox',
		'title'      => esc_html__( 'Gallery Format Options', 'callie' ),
		'post_types' => array( 'post' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'autosave'   => true,
		'fields'     => array(
			// IMAGE ADVANCED (WP 3.5+)
			array(
				'name'             => esc_html__( 'Upload Gallery Images', 'callie' ),
				'id'               => "{$prefix}gallery_format",
				'type'             => 'image_advanced',
				'max_file_uploads' => 10,
			)
		)
	);

	// Video Format Metabox
	$meta_boxes[] = array(
		'id'         => 'callie_video_format_metabox',
		'title'      => esc_html__( 'Video Format Options', 'callie' ),
		'post_types' => array( 'post' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'autosave'   => true,
		'fields'     => array(
			// TEXTAREA
			array(
				'name' => esc_html__( 'Video URL Without Protocol (HTTPS OR HTTP)', 'callie' ),
				'id'   => "{$prefix}video_format",
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 1,
			),
		)
	);

	/* -------------------------
	 ----- Post Formats / End
	------------------------- */

	/*
	 ----- Post Options / Start
	------------------------- */

	// Hide Excerpt Metabox
	$meta_boxes[] = array(
		'id'         => 'callie_hide_excerpt_metabox',
		'title'      => esc_html__( 'Hide Post Excerpt', 'callie' ),
		'post_types' => array( 'post' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'autosave'   => false,
		'fields'     => array(
			// CHECKBOX
			array(
				'name' => esc_html__( 'Checkbox', 'callie' ),
				'id'   => "{$prefix}hide_excerpt",
				'desc' => esc_html__( 'Hide post excerpt on homepage/category/author pages for only this post.', 'callie' ),
				'type' => 'checkbox'
			)
		)
	);

	// Story Checkbox
	$meta_boxes[] = array(
		'id'         => 'callie_story_metabox',
		'title'      => esc_html__( 'Callie Story', 'callie' ),
		'post_types' => array( 'post' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'autosave'   => false,
		'fields'     => array(
			// CHECKBOX
			array(
				'name' => esc_html__( 'Mark This Post As A Story', 'callie' ),
				'id'   => "{$prefix}story",
				'desc' => esc_html__( 'Stories displays on header. It\'s permanent until you unmark.', 'callie' ),
				'type' => 'checkbox'
			),
			// IMAGE ADVANCED (WP 3.5+)
			array(
				'name'             => esc_html__( '** Upload Story Media Items', 'callie' ),
				'id'               => "{$prefix}story_media",
				'type'             => 'file_advanced',
				'max_file_uploads' => 15,
			)
		)
	);

	/* -------------------------
	 ----- Post Options / End
	------------------------- */

	return $meta_boxes;
}
