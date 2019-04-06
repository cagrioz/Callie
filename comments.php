<?php
/**
 * The template for displaying comments.
 *
 * @package    Callie
 * @version    1.0
 * @author     useCSS <cagriozarpaciii@gmail.com>
 * @copyright  Copyright (c) 2019, useCSS
 * @link       https://clibrary.pro/callie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2 or later
 */

 /*
  * If the current post is protected by a password and
  * the visitor has not yet entered the password we will
  * return early without loading the comments.
  */
 if ( post_password_required() ) {
 	return;
 }
 ?>

 <div class="post-comments">

    <div class="comment-title">
    	<h3><?php comments_number(esc_html__('No Comments Found','callie'), esc_html__('1 Comment','callie'), '% ' . esc_html__('Comments','callie') ); ?></h3>
	</div>

 	<?php
 	// You can start editing here -- including this comment!
	if ( have_comments() || comments_open() ) : ?>

 		<ul class="comments-list">
 			<?php
			wp_list_comments( array(
				'avatar_size'	=> 80,
				'max_depth'		=> 5,
				'short_ping'    => true,
				'style'			=> 'ul',
				'callback'		=> 'callie_comments',
				'type'			=> 'all'
			) );
 			?>
 		</ul>

 		<?php the_comments_navigation();

	  $args = array(
		'id_form'              => 'comment-form',
		'class_form'           => 'comment-form',
		'title_reply'          => esc_html__( 'Leave a Reply' ,'callie'),
		'title_reply_to'       => esc_html__( 'Leave a Comment to %s'  ,'callie'),
		'cancel_reply_link'    => esc_html__( 'Cancel Comment'  ,'callie'),
		'must_log_in'          => '<p class="must-log-in">' .  wp_kses_post(sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ,'callie' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) )) . '</p>',
		'logged_in_as'         => '<p class="logged-in-as">' . wp_kses_post(sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>'  ,'callie'), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) ). '</p>',
		'comment_notes_before' => '',
		'comment_notes_after'  => '',
        'comment_field' => '
			<div class="col12 formitem">
        		<textarea name="comment" placeholder="'.esc_html__('Comment','callie').'"  id="text" class="form-control" rows="10"  maxlength="400" aria-required="true"></textarea>
        	</div>',
		'fields' => apply_filters( 'comment_form_default_fields',
		  array(
			'author' => '
				<div class="col6 formitem">
					<input type="text" placeholder="'.esc_html__('Name','callie').'" name="author" id="name" class="form-control" maxlength="100" aria-required="true">
				</div>',

			'email' => '
				<div class="col6 formitem">
					<input type="email" placeholder="'.esc_html__('Email','callie').'" name="email" id="email" class="form-control" maxlength="100" aria-required="true">
				</div>'
		  )
		)
	  );

 	comment_form($args);

 	else : // Check for have_comments() ?>
       
        <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'callie' ); ?></p>

    <?php endif; ?>

 </div><!-- #comments -->