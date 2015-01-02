<?php
/**
 * Entry Meta functions for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package MF2_S
 */

if ( ! function_exists( 'mf2_s_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time.
 */
function mf2_s_posted_on() {
	$time_string = '<time class="entry-date published updated dt-published dt-updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published dt-published" datetime="%1$s">%2$s</time><time class="updated dt-updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date('F j, Y g:iA T') ),
		esc_attr( get_the_modified_date( DATE_W3C ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		_x( '%s', 'post date', 'mf2_s' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);
	echo '<span class="posted-on">' . $posted_on . '</span>';
}
endif;

if ( ! function_exists( 'mf2_s_posted_by' ) ) :
/**
 * Prints HTML with meta information for the current author.
 */
function mf2_s_posted_by() {
	$byline = sprintf(
		_x( 'by %s', 'post author', 'mf2_s' ),
		'<span class="author vcard p-author h-card"><a class="url u-url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);
	echo '<span class="byline"> ' . $byline . '</span>';

}
endif;



if ( ! function_exists( 'mf2_s_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function mf2_s_entry_footer() {
	edit_post_link( __( 'Edit', 'mf2_s') , '<span class="edit-link">', '</span>' );
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		  echo mf2_s_post_categories(); 
		  echo mf2_s_post_tags();
	}
}
endif;

if ( ! function_exists( 'mf2_s_posted_by_pic' ) ) :
/**
 * Return HTML for picture for the current author.
 */
function mf2_s_posted_by_pic() {
        $c = sprintf( '<span class="p-author h-card vcard author-pic"><a class="url fn n" href="%1$s" rel="author">%2$s</a></span>',
                esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                get_avatar( get_the_author_meta( 'ID' ), 48 )
        );
        return $c;
}
endif;

if ( ! function_exists( 'mf2_s_comments_link' ) ) :
/**
 * Return Comment Link
 */
function mf2_s_comment_link() {
	$c = "";
	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		$c = '<span class="comments-link"> ';
	//	comments_popup_link( __( 'Leave a comment', 'mf2_s' ), __( '1 Comment', 'mf2_s' ), __( '% Comments', 'mf2_s' ) );
		$c .= '</span>';
	}
        return $c;
}
endif;


if ( ! function_exists( 'mf2_s_post_tags' ) ) :
/**
 * Returns HTML for tags for the current post.
 */
function mf2_s_post_tags () {
        /* translators: used between list items, there is a space after the comma */
        $tags_list = get_the_tag_list( '<span class="p-category">', __( '</span> <span class="p-category">',  'mf2_s' ), '</span>' );
        $c = "";
        if ( $tags_list )
              {
                   $c .= sprintf( __( '<span class="tags-links">%1$s</span>', 'mf2_s' ), $tags_list );
              }
        return $c;

}
endif;

if ( ! function_exists( 'mf2_s_post_categories' ) ) :
/**
 * Return HTML for categories for the current post.
 */
function mf2_s_post_categories () {
        $cat ="";
        $c = "";
        // $categories_list = get_the_category_list( __( ', ', 'mf2_s' ) );
         foreach((get_the_category()) as $category) {
                   if ($category->cat_name != 'Uncategorized') {
                        $cat .= '<a class="p-category" href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . '>' . $category->name.'</a> ';
}
}
        if ($cat != "")
           {
                $c .= '<span class="cat-links">' . $cat . '</span>';
           }
        return $c;
}
endif;

if ( ! function_exists( 'mf2_s_post_format' ) ) :
/**
 * Return HTML for the post format of the current post.
 */
function mf2_s_post_format ($nm = false) {
        $c = "";
        $format = get_post_format();
        if (false!=$format)
                {
                        $c .= '<span class="entry-format"><a class="' . strtolower(get_post_format_string($format)) . '" ';
                        $c .= 'href="' . get_post_format_link( $format ) . ' ">';
                        if ($nm == true)
                           {
                        $c .= get_post_format_string( $format );
                           }
                        $c .= '</a></span>';
                }
        else {
                        $c .= '<span class="entry-format"><a class="standard" href="' . home_url() . '/type/standard/">';
                        if ($nm == true)
                           {
                                $c .= 'ARTICLE';
                           }
                        $c .= '</a></span>';
             }
        return $c;
        }
endif;

