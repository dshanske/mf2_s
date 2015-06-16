<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package MF2_S
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

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">Responses</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
      <nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
        <h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'mf2_s' ); ?></h2>
        <div class="nav-links">
          <div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'mf2_s' ) ); ?></div>
          <div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'mf2_s' ) ); ?></div>
          </div><!-- .nav-links -->
      </nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>
    <ul class="webmention-list">
      <?php
        wp_list_comments( array(
          'walker'     => new MF2Comment(),
          'style'      => 'ul',
          'short_ping' => true,
          'type' => 'webmention',
          'avatar_size' => 50  
        ) );
        wp_list_comments( array(
          'walker'     => new MF2Comment(),
          'style'      => 'ul',
          'short_ping' => true,
					'type' => 'pings',
          'avatar_size' => 50
        ) );
      ?>
    </ul><!-- .webmention-list -->
		<ul class="comment-list">
			<?php
				wp_list_comments( array(
					'walker'     => new MF2Comment(),
					'style'      => 'ul',
					'short_ping' => true,
					'avatar_size' => 50,
					'type' => 'comment'
				) );
			?>
		</ul><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
        <nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
          <h2 class="screen-reader-text"><?php _e( 'Comment navigation', '_s' ); ?></h2>
          <div class="nav-links">
            <div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', '_s' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', '_s' ) ); ?></div>
          </div><!-- .nav-links -->
        </nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'mf2_s' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>

</div><!-- #comments -->
