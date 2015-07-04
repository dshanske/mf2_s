<?php
/**
 * Entry Meta functions for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package MF2_S
 */

if ( ! function_exists( 'mf2_s_get_posted_on' ) ) :
/**
 * Returns HTML with meta information for the current post-date/time.
 */
function mf2_s_get_posted_on() {
	$time_string = '<time class="entry-date published updated dt-published dt-updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published dt-published" datetime="%1$s">%2$s</time><time class="updated dt-updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( DATE_ISO8601 ) ),
		esc_html( get_the_time() . ' ' . get_the_date() ),
		esc_attr( get_the_modified_date( DATE_ISO8601 ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', 'mf2_s' ),
		'<a class ="u-url" href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);
	return '<span class="posted-on">' . $posted_on . '</span>';
}
endif;

if ( ! function_exists( 'mf2_s_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time.
 */
function mf2_s_posted_on() {
	echo mf2_s_get_posted_on();
}
endif;


if ( ! function_exists( 'mf2_s_get_posted_by' ) ) :
/**
 * Returns HTML with meta information for the current author.
 */
function mf2_s_get_posted_by() {
	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'mf2_s' ),
		'<span class="author vcard p-author h-card"><a class="url u-url fn n" href="' . esc_url( get_the_author_meta( 'url' ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);
	return '<span class="byline"> ' . $byline . '</span>';

}
endif;

if ( ! function_exists( 'mf2_s_posted_by' ) ) :
/**
 * Prints HTML with meta information for the current author.
 */
function mf2_s_posted_by() {
	echo mf2_s_get_posted_by();
}
endif;

if ( ! function_exists( 'mf2_s_get_posted_by_pic' ) ) :
/**
 * Return HTML for picture for the current author.
 */
function mf2_s_get_posted_by_pic() {
        $c = sprintf( '<span class="p-author h-card vcard author-pic"><a class="url fn n" href="%1$s" rel="author">%2$s</a></span>',
                esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                get_avatar( get_the_author_meta( 'ID' ), 48 )
        );
        return $c;
}
endif;

if ( ! function_exists( 'mf2_s_posted_by_pic' ) ) :
/**
 * echo HTML for picture for the current author.
 */
function mf2_s_posted_by_pic() {
	echo mf2_s_get_posted_by_pic();
}
endif;

if ( ! function_exists( 'mf2_s_get_responses' ) ) :
/**
 * Return Responses
 */
function mf2_s_get_responses() {
	$c = "";
	if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		// Comment Count 
		$comments = get_comments_count();
		if ($comments!=0)
			{
				$c = '<span class="comments-count">';
				$c .= $comments;
				if ($comments==1)
				    {
					$c .= ' ' . esc_html__( 'comment', 'mf2_s' ) . ' ';
				    }
				else {
					$c .= ' ' . esc_html__( 'comments', 'mf2_s' ) . ' ';
				     }
				$c .= '</span> ';
			}
		// Webmentions Count
	//	$webmentions = get_webmentions_number();
	//	if ($webmentions!=0)
	//	    {
	//		$c .= '<span class="webmentions-count">';
	//		$c .= $webmentions;
        //              if ($webmentions==1)
        //                     {
        //                        $c .= ' ' . esc_html__( 'mention', 'mf2_s' ) . ' ';
        //                     }
        //              else {
        //                      $c .= ' ' . esc_html__( 'mentions', 'mf2_s' ) . ' ';
        //                   }
	//
	//		$c .= '</span>';
	//	    }
		// Semantic Count
		$c .= '<span class="mentions-count">';
		$likes = get_linkbacks_number('like');		
		if($likes!=0)
		     {	
			$c .= '<span class="like-count">';
			$c .= $likes;
                        if ($likes==1)
                             {
                                $c .= ' ' . esc_html__( 'like', 'mf2_s' ) . ' ';
                             }
                        else {
                                $c .= ' ' . esc_html__( 'likes', 'mf2_s' ) . ' ';
                             }
			$c .= '</span>';
		     }
                $favorites = get_linkbacks_number('favorite');
		if($favorites!=0)
		     {
            		$c .= '<span class="favorite-count">';
			$c .= $favorites;
                        if ($favorites==1)
                             {
                                $c .= ' ' . esc_html__( 'favorite', 'mf2_s' ) . ' ';
                             }
                        else {
                                $c .= ' ' . esc_html__( 'favorites', 'mf2_s' ) . ' ';
                             }

               		$c .= '</span>';
		     }
                $repost = get_linkbacks_number('repost');
 	       	if($repost!=0)
		     {
	                $c .= '<span class="repost-count">';
        	        $c .= $repost;
                        if ($repost==1)
                             {
                                $c .= ' ' . esc_html__( 'repost', 'mf2_s' ) . ' ';
                             }
                        else {
                                $c .= ' ' . esc_html__( 'reposts', 'mf2_s' ) . ' ';
                             }

			$c .= '</span>';
		     }
 		$c .= '</span>';
	}
        return $c;
}
endif;

if ( ! function_exists( 'mf2_s_reponses' ) ) :
/**
 * Echo Responses
 */
function mf2_s_responses() {
	echo mf2_s_get_responses();
}
endif;

if (!function_exists('get_comments_count')) :
/**
* Return the Number of Comments that are not Mentions
*
* @param int $post_id The post ID (optional)
*
* @return int the number of WebMentions for one Post
*/
function get_comments_count($post_id = 0) {
	$post = get_post($post_id);
	// change this if your theme can't handle the WebMentions comment type
	$args = array(
		'post_id' => $post->ID,
		'type' => 'comment',
		'count' => true,
		'status' => 'approve'
	);
	$comments_query = new WP_Comment_Query;
	return $comments_query->query($args);
    }
endif;


if ( ! function_exists( 'mf2_s_get_post_tags' ) ) :
/**
 * Returns HTML for tags for the current post.
 */
function mf2_s_get_post_tags () {
        /* translators: used between list items, there is a space after the comma */
        $tags_list = get_the_tag_list( '<span class="p-category">', '</span> <span class="p-category">', '</span>' );
        $c = "";
        if ( $tags_list )
              {
                   $c .= sprintf( __( '<span class="tags-links">%1$s</span>', 'mf2_s' ), $tags_list );
              }
        return $c;

}
endif;

if ( ! function_exists( 'mf2_s_post_tags' ) ) :
/**
 * Echos tags for the current post.
 */
function mf2_s_post_tags () {
	echo mf2_s_get_post_tags();
}
endif;


if ( ! function_exists( 'mf2_s_get_post_categories' ) ) :
/**
 * Return HTML for categories for the current post.
 */
function mf2_s_get_post_categories () {
        $cat ="";
        $c = "";
        // $categories_list = get_the_category_list( esc_html__( ', ', 'mf2_s' ) );
         foreach((get_the_category()) as $category) {
                   if ($category->cat_name != 'Uncategorized') {
                        $cat .= '<a class="p-category" href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( esc_html__( "View all posts in %s" ), $category->name ) . '" ' . '>' . $category->name.'</a> ';
}
}
        if ($cat != "")
           {
                $c .= '<span class="cat-links">' . $cat . '</span>';
           }
        return $c;
}
endif;

if ( ! function_exists( 'mf2_s_post_categories' ) ) :
/**
 * echo HTML for categories for the current post.
 */
function mf2_s_post_categories() {
	echo mf2_s_get_post_categories();
}
endif;

if ( ! function_exists( 'mf2_s_get_post_format' ) ) :
/**
 * Return HTML for the post format of the current post.
 */
function mf2_s_get_post_format ($nm = false) {
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

if ( ! function_exists( 'mf2_s_post_format' ) ) :
/**
 * Echo HTML for the post format of the current post.
 */
function mf2_s_post_format ($nm = false) {
	echo mf2_s_get_post_format($nm);
}
endif;

if ( ! function_exists( 'mf2_s_get_post_kind' ) ) :
/**
 * Return HTML for the post format of the current post.
 */
function mf2_s_get_post_kind ($nm = false) {
        $c = "";
	if(!function_exists('get_post_kind'))
		{
			return false;
		}
        $kind = get_post_kind();
        $c .= '<span class="entry-kind"><a class="' . strtolower(get_post_kind($kind)) . '" ';
        $c .= 'href="' . get_post_kind_link( $kind ) . ' ">';
        if ($nm == true)
              {
                 $c .= get_post_kind( $kind );
              }
        $c .= '</a></span>';
        return $c;
        }
endif;

if ( ! function_exists( 'mf2_s_post_kind' ) ) :
/**
 * Echo HTML for the post kind of the current post.
 */
function mf2_s_post_kind ($nm = false) {
        echo mf2_s_get_post_kind($nm);
}
endif;
