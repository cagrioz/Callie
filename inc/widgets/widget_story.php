<?php
/**
 * Widget : Blog Post
 *
 * @package    Callie
 * @version    1.0
 * @author     useCSS <support@devfeels.com>
 * @copyright  Copyright (c) 2019, useCSS
 * @link       https://clibrary.pro/callie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2 or later
 */

/**
 * Core class used to implement a Story Widget.
 *
 * @see WP_Widget
 */
class Callie_Widget_Story extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'story-widget', // Widget ID
			esc_html__( 'Callie: Story', 'callie' ), // Widget Name.
			array(
				'classname'   => 'story-widget', // Widget Class.
				'description' => esc_html__( 'A widget that displays a stories.', 'callie' ), // Widget Description.
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

 		/* Our variables from the widget settings. */
		$title    = esc_attr($instance['title']);
		$post_ids = esc_attr($instance['post_ids']);

		$widget_img_duration   = get_theme_mod('story_img_duration', 3);
        $widget_video_duration = get_theme_mod('story_video_duration', '');

		if ( isset($post_ids) ) {

			$id_arr = explode(",", $post_ids);

			$args = array(
				'post__in' => $id_arr,
				'ignore_sticky_posts' => 1
			);

			$query = new WP_Query($args);
		}

 		/* Before widget */
 		echo $before_widget;

 		/* Display the widget title if one was input. */
 		if ( $title )
 			echo $before_title . $title . $after_title;
 		?>

		<?php if ( $query->have_posts() ) : ?>

			<!-- Stories -->
            <div class="stories-inwidget">

                <div class="story-inner story-widget-carousel owl-carousel">

				<?php while ( $query->have_posts() ) : $query->the_post(); ?>

        			<?php $files = rwmb_meta("callie_story_media"); ?>

        			<?php if ( has_post_thumbnail() && $files ) : ?>
					<!-- Story -->
                    <div class="story-view-item" style="background-image: url( <?php esc_url( the_post_thumbnail_url('callie_story_thumb') ); ?> )">

                        <ul class="media">

							<?php foreach ( $files as $file ) :?>
								<?php if ($file['fileformat'] !== 'mp4') : ?>
				                <li data-duration="<?php echo esc_attr($widget_img_duration); ?>"><img src="<?php echo esc_url($file['url']); ?>" alt="<?php echo esc_attr($file['alt']); ?>" /></li>
				                <?php else : ?>
				                <li data-duration="<?php if ($widget_video_duration) {echo esc_attr($widget_video_duration);} else {echo esc_attr($file['length']);} ?>"><video src="<?php echo esc_url($file['url']); ?>" controls></video></li>
				            	<?php endif; ?>
			                <?php endforeach; ?>

                        </ul>
                        
                    </div>
                    <!-- Story / End -->
                    <?php endif; ?>

				<?php endwhile; wp_reset_postdata(); ?>

				</div>

			</div>
            <!-- Stories / End -->

		<?php else : ?>
			<h1>Please Enter Valid ID.</h1>
		<?php endif; ?>		

 		<?php
 		/* After widget (defined by themes). */
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
	    $instance['title']    = strip_tags( $new_instance['title'] );
	    $instance['post_ids'] = strip_tags( $new_instance['post_ids'] );

	    return $instance;
	 }

	/**
	 * Outputs the settings form for the About me widget.
	 *
	 * @param array $instance Current settings.
	 */
	 function form( $instance ) {

 		/* Set up some default widget settings. */
 		$defaults = array( 'title' => '', 'post_ids' => '' );
 		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
 		<p>
 			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e('Title:','callie');?></label>
 			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  />
 		</p>
 		<p>
 			<label for="<?php echo $this->get_field_id( 'post_ids' ); ?>"><?php esc_html_e('Post IDs:', 'callie'); ?></label>
 			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'post_ids' ); ?>" name="<?php echo $this->get_field_name( 'post_ids' ); ?>" value="<?php echo $instance['post_ids']; ?>" size="3" />
 			<label class="description">
				<?php esc_html_e( 'Type IDs of story posts and seperate it with commas. ex. 8,15,24,35,42 . Please enter more than 3 ID here for get proper results.', 'callie' );?>
			</label>
 		</p>
	<?php
	}
}

add_action( 'widgets_init' , function() {
    register_widget('Callie_Widget_Story');
});

?>