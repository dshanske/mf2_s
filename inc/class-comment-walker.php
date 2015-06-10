<?php 
/** MF2Comment is a webmention enhanced version of Walker_Comment
*/
class MF2Comment extends Walker_Comment {
	/**
	 * What the class handles.
	 *
	 * @see Walker::$tree_type
	 *
	 * @since 2.7.0
	 * @var string
	 */
	public $tree_type = 'comment';

	/**
	 * DB fields to use.
	 *
	 * @see Walker::$db_fields
	 *
	 * @since 2.7.0
	 * @var array
	 */
	public $db_fields = array ('parent' => 'comment_parent', 'id' => 'comment_ID');

	/**
	 * Start the element output.
	 *
	 * @since 2.7.0
	 *
	 * @see Walker::start_el()
	 * @see wp_list_comments()
	 *
	 * @param string $output  Passed by reference. Used to append additional content.
	 * @param object $comment Comment data object.
	 * @param int    $depth   Depth of comment in reference to parents.
	 * @param array  $args    An array of arguments.
	 */
	public function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {
		$depth++;
		$GLOBALS['comment_depth'] = $depth;
		$GLOBALS['comment'] = $comment;

		if ( !empty( $args['callback'] ) ) {
			ob_start();
			call_user_func( $args['callback'], $comment, $args, $depth );
			$output .= ob_get_clean();
			return;
		}

		if ( ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type || 'webmention' == $comment->comment_type ) && $args['short_ping'] ) {
			ob_start();
			$this->ping( $comment, $depth, $args );
			$output .= ob_get_clean();
		} elseif ( 'html5' === $args['format'] ) {
			ob_start();
			$this->html5_comment( $comment, $depth, $args );
			$output .= ob_get_clean();
		} else {
			ob_start();
			$this->comment( $comment, $depth, $args );
			$output .= ob_get_clean();
		}
	}

	/**
	 * Ends the element output, if needed.
	 *
	 * @since 2.7.0
	 *
	 * @see Walker::end_el()
	 * @see wp_list_comments()
	 *
	 * @param string $output  Passed by reference. Used to append additional content.
	 * @param object $comment The comment object. Default current comment.
	 * @param int    $depth   Depth of comment.
	 * @param array  $args    An array of arguments.
	 */
	public function end_el( &$output, $comment, $depth = 0, $args = array() ) {
		if ( !empty( $args['end-callback'] ) ) {
			ob_start();
			call_user_func( $args['end-callback'], $comment, $args, $depth );
			$output .= ob_get_clean();
			return;
		}
		if ( 'div' == $args['style'] )
			$output .= "</div><!-- #comment-## -->\n";
		else
			$output .= "</li><!-- #comment-## -->\n";
	}

	/**
	 * Output a pingback comment.
	 *
	 * @access protected
	 * @since 3.6.0
	 *
	 * @see wp_list_comments()
	 *
	 * @param object $comment The comment object.
	 * @param int    $depth   Depth of comment.
	 * @param array  $args    An array of arguments.
	 */
	protected function ping( $comment, $depth, $args ) {
		$tag = ( 'div' == $args['style'] ) ? 'div' : 'li';
 		$author = get_comment_author();
  		$url    = get_comment_author_url();
		$wm_type = get_comment_meta( $comment->comment_ID, 'semantic_linkbacks_type', true);
                $face   = get_avatar( $comment, $args['avatar_size'], '', $author, $wm_type );
		$wm = "";
		$c_url = get_comment_meta( $comment->comment_ID, 'semantic_linkbacks_canonical', true);
		$host = parse_url($c_url, PHP_URL_HOST);
  		$host = preg_replace("/^www\./", "", $host);
 		switch ($wm_type) {    
  		   case "like": 
			$wm = '<a href="" class="u-in-like-of"></a>';
		  	$wm .= '<a class="action u-like" title="Liked on ' . $host . '" href="'. esc_url( $c_url ) . '" >Like</a>';
  			break;
   		   case "repost":
			$wm =  '<a href="" class="u-repost-of"></a>';
        		$wm .=  '<a class="action u-repost" title="Reposted on  ' . $host . '" href="'. esc_url( $c_url ) . '"></a>';
     			break;
     		   case "favorite":
			$wm = '<a href="" class="u-in-like-of"></a>';
        		$wm .=  '<a class="action u-like u-favorite" title="Favorited on ' . $host . '" href="'. esc_url( $c_url ) . '"></a>';
     			break;
     		   case "rsvp":
        		$wm =  '<a class="action in-reply-to" title="Reply ' . $host . '" href="'. esc_url( $c_url ) . '"></a>';
     			break;
     		   case "reply":
        		$wm = '<a class="action in-reply-to" title="Reply ' . $host . '" href="'. esc_url( $c_url ) . '"></a>';
     			break;	
     		   default:
        		$wm = '<a class="action" title="Mentioned on ' . $host . '" href="'. esc_url( $c_url ) . '">Mention</a>';
    }

?>
		<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class('p-comment h-cite'); ?>>
			<div class="comment-body">
				<?php echo '<a href="' . $url . '" title="' . $wm_type . '">' . $face . '</a>' . $wm; ?>
				<?php edit_comment_link( __( 'Edit' ), '<span class="edit-link">', '</span>' ); ?>
			</div>
<?php
	}

	/**
	 * Output a single comment.
	 *
	 * @access protected
	 * @since 3.6.0
	 *
	 * @see wp_list_comments()
	 *
	 * @param object $comment Comment to display.
	 * @param int    $depth   Depth of comment.
	 * @param array  $args    An array of arguments.
	 */
	protected function comment( $comment, $depth, $args ) {
		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}
?>
		<<?php echo $tag; ?> <?php comment_class( $this->has_children ? 'parent p-comment h-cite' : 'p-comment h-cite' ); ?> id="comment-<?php comment_ID(); ?>">
		<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
		<?php endif; ?>
		<div class="comment-author p-author vcard h-card">
			<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
			<?php printf( __( '<cite class="fn u-url">%s</cite> <span class="says">says:</span>' ), get_comment_author_link() ); ?>
		</div>
		<?php if ( '0' == $comment->comment_approved ) : ?>
		<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ) ?></em>
		<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID, $args ) ); ?>">
			<a href="" class="in-reply-to"></a>
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)' ), '&nbsp;&nbsp;', '' );
			?>
		</div>

		<span class="p-summary"><?php comment_text( get_comment_id(), array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></span>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div>
		<?php if ( 'div' != $args['style'] ) : ?>
		</div>
		<?php endif; ?>
<?php
	}

	/**
	 * Output a comment in the HTML5 format.
	 *
	 * @access protected
	 * @since 3.6.0
	 *
	 * @see wp_list_comments()
	 *
	 * @param object $comment Comment to display.
	 * @param int    $depth   Depth of comment.
	 * @param array  $args    An array of arguments.
	 */
	protected function html5_comment( $comment, $depth, $args ) {
		$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
?>
		<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent p-comment h-cite' : 'p-comment h-cite' ); ?>>
			<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
				<footer class="comment-meta">
					<div class="comment-author vcard h-card p-author">
						<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
						<?php printf( __( '%s <span class="says">says:</span>' ), sprintf( '<b class="fn">%s</b>', get_comment_author_link() ) ); ?>
					</div><!-- .comment-author -->

					<div class="comment-metadata">
						<a href="" class="in-reply-to"></a>
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID, $args ) ); ?>">
							<time datetime="<?php comment_time( 'c' ); ?>">
								<?php printf( _x( '%1$s at %2$s', '1: date, 2: time' ), get_comment_date(), get_comment_time() ); ?>
							</time>
						</a>
						<?php edit_comment_link( __( 'Edit' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .comment-metadata -->

					<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></p>
					<?php endif; ?>
				</footer><!-- .comment-meta -->

				<div class="comment-content p-summary">
					<?php comment_text(); ?>
				</div><!-- .comment-content -->

				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div><!-- .reply -->
			</article><!-- .comment-body -->
<?php
	}
}

