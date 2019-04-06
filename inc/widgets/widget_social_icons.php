<?php
/**
 * Widget : Social Icons
 *
 * @package    Callie
 * @version    1.0
 * @author     useCSS <cagriozarpaciii@gmail.com>
 * @copyright  Copyright (c) 2019, useCSS
 * @link       https://clibrary.pro/callie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2 or later
 */

/**
 * Core class used to implement a About Author widget.
 *
 * @see WP_Widget
 */
class Callie_Widget_Social_Icons extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'social-icons-widget', // Widget ID
			esc_html__( 'Callie: Social Icons', 'callie' ), // Widget Name.
			array(
				'classname'   => 'widget-socials', // Widget Class.
				'description' => esc_html__( 'A widget that displays social media icons.', 'callie' ), // Widget Description.
			)
		);
	}

	/**
	 * Outputs the content for the current About me widget instance.
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Archives widget instance.
	 */
 	function widget( $args, $instance ) {
 		extract( $args );

 		$instance = wp_parse_args( $instance, array(
            'title' => esc_html__( 'Follow Me', 'callie' )
        ) );

 		/* Our variables from the widget settings. */
 		$title = apply_filters('widget_title', $instance['title'] );

 		/* Before widget */
 		echo $before_widget;

 		/* Display the widget title if one was input. */
 		if ( $title )
 			echo $before_title . $title . $after_title;
 		?>
		<ul class="social-media">
		<?php
 		// Social Icons
		echo callie_social_profiles();
		?>
		</ul>
		<?php
 		/* After widget */
 		echo $after_widget;
 	}


	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options.
	 *
	 * @param array $old_instance The previous options.
	 *
	 * @return array
	 */

	 function update( $new_instance, $old_instance ) {
	    $instance = $old_instance;

	    /* Strip tags for title and name to remove HTML (important for text inputs). */
	    $instance['title'] = strip_tags( $new_instance['title'] );

	    return $instance;
	 }

	/**
	 * Outputs the settings form for the About me widget.
	 *
	 * @param array $instance Current settings.
	 */
	 function form( $instance ) {

 		/* Set up some default widget settings. */
 		$defaults = array( 'title' => 'Follow Me' );
 		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

 		<p>
 			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html_e('Title:', 'callie'); ?></label>
 			<input  type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>"  />
 		</p>
	<?php
	}
}

add_action( 'widgets_init' , function() {
    register_widget('Callie_Widget_Social_Icons');
});
?>