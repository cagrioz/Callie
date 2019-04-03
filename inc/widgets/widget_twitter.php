<?php
/**
 * Widget : Twitter
 *
 * @package    Callie
 * @version    1.0
 * @author     useCSS <support@devfeels.com>
 * @copyright  Copyright (c) 2019, useCSS
 * @link       https://clibrary.pro/callie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2 or later
 */

/**
 * Core class used to implement a Twitter Widget.
 *
 * @see WP_Widget
 */	
class Callie_Widget_Twitter extends WP_Widget {

    public function __construct() {
        parent::__construct( 
            'callie-widget-twitter', # Widget ID
            esc_html__('Callie: Twitter', 'callie'), # Widget Name
            array(
                'classname' => 'twitter-widget', # Widget Class
                'description' => esc_html__('A widget that displays recent tweets.', 'callie') # Widget Description
            )
        );
    }

    public function widget( $args, $instance ) {
        $output = '';
        
        extract( $args );
        
        $instance = wp_parse_args( $instance, array (
            'title'     => esc_html__( '', 'callie' ),
            'username'  => '',
            'number'    => 3
        ) );
        
        /* Our variables from the widget settings. */
 		$title = apply_filters('widget_title', $instance['title'] );
        $username = $instance['username'];
        $number = $instance['number'];
        
        $output .= $before_widget;
        
        /* Display the widget title if one was input. */
 		if ( $title )
 			$output .= $before_title . $title . $after_title;
        
        if ( function_exists('getTweets') ) {
            
            $tweets = getTweets($username, $number);
                        
            if ( is_array( $tweets ) ) {
                                                
                $output .= '<a href="'. esc_url( 'https://twitter.com/'.$username ) .'" ><i class="fa fa-twitter"></i></a>';
                
                $output .= '<div class="tweet-slider owl-carousel">';
                
                
                foreach ( $tweets as $tweet ) {

                    if ( ! empty( $tweet['text'] ) ) {
                        $created_at = new DateTime( $tweet['created_at'] );
                        
                        $output .= '<ul><li class="tweet">';
                        $output .= '<p>'. $tweet['text'] .'</p>';
                        $output .= '</li></ul>';
                    }
                    
                }
                
                $output .= '</div>';
                
            }
            
        }

        $output .= $after_widget;
        
        echo $output;
    }

    public function update( $new_instance, $old_instance ) {
        $instance 					= $old_instance;
        $instance['title'] 			= sanitize_text_field( $new_instance['title'] );
        $instance['username'] 		= sanitize_text_field( $new_instance['username'] );
        $instance['number'] 		= sanitize_text_field( $new_instance['number'] );
        return $instance;
    }

    public function form( $instance ) {        
        $instance = wp_parse_args( (array) $instance, array(
            'title'     => esc_html__( '', 'callie' ),
            'username'  => '',
            'number'    => 3
        ) );
        extract( $instance );
        
        ?>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ));?>"><?php esc_html_e( 'Title:', 'callie' );?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ));?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) );?>" value="<?php echo esc_attr( $title );?>">
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'username' ));?>"><?php esc_html_e( 'Username:', 'callie' );?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'username' ));?>" name="<?php echo esc_attr( $this->get_field_name( 'username' ) );?>" value="<?php echo esc_attr( $username );?>">

            <label class="description">

                <?php 
                    if( ! class_exists( 'StormTwitter' ) || ! function_exists( 'getTweets' ) ) {
                        printf(
                            esc_html__( 'Callie Twitter widget requires %s plugin installed for widget works, click %s to activate the plugin.', 'callie' ),
                            '<a target="_blank" href="https://vi.wordpress.org/plugins/oauth-twitter-feed-for-developers/">oAuth Twitter Feed for Developers</a>',
                            '<a href="'. esc_url( admin_url( 'themes.php?page=callie-install-plugins' ) ) .'">'. esc_html__( 'here', 'callie' ) .'</a>'
                        );
                    }
                    else{
                        printf(
                            esc_html__( 'Click %s for configure to your twitter profile.', 'callie' ),
                            '<a href="'. esc_url( admin_url( 'options-general.php?page=tdf_settings' ) ) .'">'. esc_html__( 'here', 'callie' ) .'</a>'
                        );
                    }
                ?>

            </label>

        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'number' ));?>"><?php esc_html_e( 'Number:', 'callie' );?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ));?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) );?>" value="<?php echo esc_attr( $number );?>">
        </p>	
        
        <?php
    }

}

add_action( 'widgets_init' , function() {
    register_widget('Callie_Widget_Twitter');
});

?>