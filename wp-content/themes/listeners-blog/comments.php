<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Listeners_Blog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			$listeners_blog_comment_count = get_comments_number();
			if ( '1' === $listeners_blog_comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'listeners-blog' ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			} else {
				printf(
					/* translators: 1: comment count, 2: title. */
					esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $listeners_blog_comment_count, 'comments title', 'listeners-blog' ) ),
					number_format_i18n( $listeners_blog_comment_count ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			}
			?>
		</h2>

		<?php the_comments_navigation(); ?>

		<ul class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'      => 'ul',
					'short_ping' => true,
					'avatar_size'=> 40,
				)
			);
			?>
		</ul>

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'listeners-blog' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().

	// Customize comment form arguments to match our style.css classes
	$comment_form_args = array(
		'class_form'         => 'comment-form',
		'title_reply'        => esc_html__( 'Leave a Reply', 'listeners-blog' ),
		'title_reply_to'     => esc_html__( 'Leave a Reply to %s', 'listeners-blog' ),
		'cancel_reply_link'  => esc_html__( 'Cancel Reply', 'listeners-blog' ),
		'label_submit'       => esc_html__( 'Submit Comment', 'listeners-blog' ),
		'submit_button'      => '<input name="%1$s" type="submit" id="%2$s" class="submit" value="%4$s" />',
		'submit_field'       => '<div class="form-submit">%1$s %2$s</div>',
		'comment_field'      => '<div class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun', 'listeners-blog' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" required="required"></textarea></div>',
	);

	comment_form( $comment_form_args );
	?>

</div><!-- #comments -->
