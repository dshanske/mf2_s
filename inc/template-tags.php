<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package MF2_S
 */

if ( ! function_exists( 'mf2_s_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function mf2_s_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'mf2_s' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'mf2_s' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'mf2_s' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'mf2_s_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function mf2_s_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'mf2_s' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span>&nbsp;%title', 'Previous post link', 'mf2_s' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title&nbsp;<span class="meta-nav">&rarr;</span>', 'Next post link',     'mf2_s' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'the_archive_title' ) ) :
/**
 * Shim for `the_archive_title()`.
 *
 * Display the archive title based on the queried object.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
function the_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = sprintf( __( 'Category: %s', 'mf2_s' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( __( 'Tag: %s', 'mf2_s' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( __( 'Author: %s', 'mf2_s' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( __( 'Year: %s', 'mf2_s' ), get_the_date( _x( 'Y', 'yearly archives date format', 'mf2_s' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( __( 'Month: %s', 'mf2_s' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'mf2_s' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( __( 'Day: %s', 'mf2_s' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'mf2_s' ) ) );
	} elseif ( is_tax( 'post_format' ) ) {
                if ( is_tax( 'post_format', 'post-format-aside' ) ) {
                        $title = _x( 'Asides', 'post format archive title', 'mf2_s' );
                } elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
                        $title = _x( 'Galleries', 'post format archive title', 'mf2_s' );
                } elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
                        $title = _x( 'Images', 'post format archive title', 'mf2_s' );
                } elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
                        $title = _x( 'Videos', 'post format archive title', 'mf2_s' );
                } elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
                        $title = _x( 'Quotes', 'post format archive title', 'mf2_s' );
                } elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
                        $title = _x( 'Links', 'post format archive title', 'mf2_s' );
                } elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
                        $title = _x( 'Statuses', 'post format archive title', 'mf2_s' );
                } elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
                        $title = _x( 'Audio', 'post format archive title', 'mf2_s' );
                } elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
                        $title = _x( 'Chats', 'post format archive title', 'mf2_s' );
                }
        } elseif ( is_tax( 'kind' ) ) {
		if ( is_tax( 'kind', 'note' ) ) {
			$title = _x( 'Notes', 'kind archive title', 'mf2_s' );
		} elseif ( is_tax( 'kind', 'article' ) ) {
			$title = _x( 'Articles', 'kind archive title', 'mf2_s' );
		} elseif ( is_tax( 'kind', 'bookmark' ) ) {
			$title = _x( 'Bookmarks', 'kind archive title', 'mf2_s' );
		} elseif ( is_tax( 'kind', 'favorite' ) ) {
			$title = _x( 'Favorites', 'kind archive title', 'mf2_s' );
		} elseif ( is_tax( 'kind', 'like' ) ) {
			$title = _x( 'Likes', 'kind archive title', 'mf2_s' );
		} elseif ( is_tax( 'kind', 'photo' ) ) {
			$title = _x( 'Photos', 'kind archive title', 'mf2_s' );
		} elseif ( is_tax( 'kind', 'reply' ) ) {
			$title = _x( 'Replies', 'kind archive title', 'mf2_s' );
		} elseif ( is_tax( 'kind', 'repost' ) ) {
			$title = _x( 'Repost', 'kind archive title', 'mf2_s' );
		} elseif ( is_tax( 'kind', 'rsvp' ) ) {
			$title = _x( 'RSVP', 'kind archive title', 'mf2_s' );
		}
		  elseif ( is_tax( 'kind', 'tag' ) ) {
                        $title = _x( 'Tags', 'kind archive title', 'mf2_s' );
                }
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( __( 'Archives: %s', 'mf2_s' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( __( '%1$s: %2$s', 'mf2_s' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = __( 'Archives', 'mf2_s' );
	}

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		echo $before . $title . $after;
	}
}
endif;

if ( ! function_exists( 'the_archive_description' ) ) :
/**
 * Shim for `the_archive_description()`.
 *
 * Display category, tag, or term description.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
function the_archive_description( $before = '', $after = '' ) {
	$description = apply_filters( 'get_the_archive_description', term_description() );

	if ( ! empty( $description ) ) {
		/**
		 * Filter the archive description.
		 *
		 * @see term_description()
		 *
		 * @param string $description Archive description to be displayed.
		 */
		echo $before . $description . $after;
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function mf2_s_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'mf2_s_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'mf2_s_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so mf2_s_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so mf2_s_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in mf2_s_categorized_blog.
 */
function mf2_s_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'mf2_s_categories' );
}
add_action( 'edit_category', 'mf2_s_category_transient_flusher' );
add_action( 'save_post',     'mf2_s_category_transient_flusher' );
