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
 * Core class used to implement a Blog Post Widget.
 *
 * @see WP_Widget
 */
class Callie_Widget_Blog_Post extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'post-widget', // Widget ID
			esc_html__( 'Callie: Blog Post', 'callie' ), // Widget Name.
			array(
				'classname'   => 'post-widget', // Widget Class.
				'description' => esc_html__( 'A widget that displays a blog post.', 'callie' ), // Widget Description.
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
		$title      = esc_attr($instance['title']);
		$post_id    = esc_attr($instance['post_id']);
		$hide_thumb = $instance['hide_thumb'] ? 'on' : 'off';

		if ( $post_id ) {

			$args = array(
				'p'		    => $post_id,
				'post_type' => 'any'
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

			<?php while ( $query->have_posts() ) : $query->the_post(); ?>
		
				<div class="post-title">
	                <h1><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h1>
	            </div>

	            <?php if ( $hide_thumb == 'off' ) : ?>
	            <div class="post-thumbnail">
	                <a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_post_thumbnail('callie_widget_post'); ?></a>
	            </div>
				<?php endif; ?>

			<?php endwhile; wp_reset_postdata(); ?>

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
	    $instance['title']      = strip_tags( $new_instance['title'] );
	    $instance['post_id']    = strip_tags( $new_instance['post_id'] );
	    $instance['hide_thumb'] = $new_instance['hide_thumb'];

	    return $instance;
	 }

	/**
	 * Outputs the settings form for the About me widget.
	 *
	 * @param array $instance Current settings.
	 */
	 function form( $instance ) {

 		/* Set up some default widget settings. */
 		$defaults = array( 'title' => '', 'post_id' => '', 'hide_thumb' => 'off' );
 		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
 		<p>
 			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e('Title:','callie');?></label>
 			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  />
 		</p>
 		<p>
 			<label for="<?php echo $this->get_field_id( 'post_id' ); ?>"><?php esc_html_e('Post ID:', 'callie'); ?></label>
 			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'post_id' ); ?>" name="<?php echo $this->get_field_name( 'post_id' ); ?>" value="<?php echo $instance['post_id']; ?>" size="3" />
 			<label class="description">
				<?php esc_html_e( 'You can learn it on edit post page\'s URL for ex. post.php?post=42 . 42 is the ID in that case.', 'callie' );?>
			</label>
 		</p>
 		<p>
 			<label for="<?php echo $this->get_field_id( 'hide_thumb' ); ?>"><?php esc_html_e('Hide Thumbnail Image:', 'callie'); ?></label>
 			<input type="checkbox" class="checkbox" <?php checked( $instance[ 'hide_thumb' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'hide_thumb' ); ?>" name="<?php echo $this->get_field_name( 'hide_thumb' ); ?>" value="off" size="3" />
 		</p>
	<?php
	}
}

add_action( 'widgets_init' , function() {
    register_widget('Callie_Widget_Blog_Post');
});

?>