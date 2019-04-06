<?php
/**
 * Callie custom theme styles
 *
 * @package    Callie
 * @version    1.0
 * @author     useCSS <cagriozarpaciii@gmail.com>
 * @copyright  Copyright (c) 2019, useCSS
 * @link       https://clibrary.pro/callie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2 or later
 */

if ( ! function_exists( 'callie_custom_styles' ) ) :

	function callie_custom_styles() {

		wp_enqueue_style( 'callie-custom-style', get_template_directory_uri() . '/assets/css/custom-style.css', array(), CALLIE_VERSION );

		$custom_css = '';

		$custom_css .= '.mc4wp-form input[type="submit"].image-submit {background : url("'. get_template_directory_uri() .'/assets/icons/next.png") no-repeat center center;background-size: 21px 16px;}';

		wp_add_inline_style( 'callie-custom-style', $custom_css );

	}
endif;
add_action( 'wp_enqueue_scripts', 'callie_custom_styles' );
