<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package MF2_S
 */

/**
 * Adds classes to body
 *
 * @package MF2_S
 */
function mf2_s_body_classes( $classes ) {
	// Adds a class of single-author to blogs with only 1 published author
	if ( ! is_multi_author() ) {
		$classes[] = 'single-author';
	  }
	if (!is_singular()) {
		$classes[] = "hfeed";
		$classes[] = "h-feed";
		$classes[] = "feed";
	  } else {
		// Adds a class for microformats v2
		$classes[] = 'h-entry';
		// add hentry to the same tag as h-entry
		$classes[] = 'hentry';
		}
	return $classes;
}
add_filter( 'body_class', 'mf2_s_body_classes' );

/**
* Adds custom classes to the array of post classes.
*
*/
function mf2_s_post_classes( $classes ) {
	$classes = array_diff($classes, array('hentry'));
	$classes[] = 'entry';
	if (!is_singular()) {
	   // Adds a class for microformats v2
	   $classes[] = 'h-entry';
	   // add hentry to the same tag as h-entry
	   $classes[] = 'hentry';
	   // adds microformats 2 activity-stream support
	   // for pages and articles
	   if ( get_post_type() == "page" ) {
		  $classes[] = "h-as-page";
	 	} 
	   }
	return $classes;
     }

add_filter( 'post_class', 'mf2_s_post_classes', 99 );

/**
* Wraps the_excerpt in p-summary
*
*/
function mf2_s_the_excerpt( $content ) {
   if (mf2_s_template_type()=='article') {
			$wrap = '<div class="entry-summary p-summary" itemprop="description">';
	 }
	 else {
			$wrap = '<div class="entry-summary p-summary p-name" itemprop="description">';
	 }
   if ($content!="") {
			return $wrap . $content . '</div>';
	 }
	return $content;
}
add_filter( 'the_excerpt', 'mf2_s_the_excerpt', 1 );


/**  
* Wraps the_content in e-content
*
*/
function mf2_s_the_content( $content ) {
   if ((mf2_s_template_type()=='article')||(is_page())) {
      $wrap = '<div class="entry-content e-content" itemprop="description">';
   }
   else {
      $wrap = '<div class="entry-content e-content p-name" itemprop="description">';
   }
   if ($content!="") {
      return $wrap . $content . "\n" . '</div>' . '<!-- .entry-content -->';
   }
  return $content;
}
add_filter( 'the_content', 'mf2_s_the_content', 1 );




/**
* add semantics
* credit to SemPress
* @param string $id the class identifier
* @return array
*/
function mf2_s_get_semantics($id = null) {
	$classes = array();
	// add default values
	switch ($id) {
	case "body":
	    if (!is_singular()) {
		$classes['itemscope'] = array('');
		$classes['itemtype'] = array('http://schema.org/Blog');
		} elseif (is_single()) {
		$classes['itemscope'] = array('');
		$classes['itemtype'] = array('http://schema.org/BlogPosting');
		} elseif (is_page()) {
		$classes['itemscope'] = array('');
		$classes['itemtype'] = array('http://schema.org/WebPage');
	     }
	    break;
	case "site-title":
	    if (!is_singular()) {
		$classes['itemprop'] = array('name');
		$classes['class'] = array('p-name', 'site-title');
		}
	    break;
	case "site-description":
	    if (!is_singular()) {
		$classes['itemprop'] = array('description');
		$classes['class'] = array('p-summary', 'e-content');
	       }
	    break;
	case "site-url":
	    if (!is_singular()) {
		$classes['itemprop'] = array('url');
		$classes['class'] = array('u-url', 'url');
		}
	    break;
	case "post":
	    if (!is_singular()) {
		$classes['itemprop'] = array('blogPost');
		$classes['itemscope'] = array('');
		$classes['itemtype'] = array('http://schema.org/BlogPosting');
		}
	    break;
	}
	$classes = apply_filters( "mf2_s_semantics", $classes, $id );
	$classes = apply_filters( "mf2_s_semantics_{$id}", $classes, $id );
	return $classes;
	}
/**
* echos the semantic classes added via
* the "mf2_s_semantics" filters
*
* @param string $id the class identifier
*/
function mf2_s_semantics($id, $echo=true) {
	$classes = mf2_s_get_semantics($id);
	$output = "";
	if (!$classes) {
	return;
		}
	foreach ( $classes as $key => $value ) {
		$output .= ' ' . esc_attr( $key ) . '="' . esc_attr( join( ' ', $value ) ) . '"';
	}
	if($echo) { echo $output; }
	else { return $output; }
}
/**
* retrieves the post kind or post slug and returns it
* based on whether the post kinds is enabled
* and to reduce the number of templates
* maps several post format to post kind templates
*/
function mf2_s_template_type()  {
	if (function_exists('get_post_kind') )  
        	{  
    	     /* Use kinds for specific templates  
         */  
               $name = get_post_kind_slug();  
     		}  
	else {  
        /* Otherwise use post formats for templates  
         * For those post formats that have post kind  
         * analogues - use the closest equivalent  
         * comment out if needed  
         */  
		$name = get_post_format();  
                if ( false === $name ) {  
                    $name = 'article';  
                   }  
                else{  
                   switch($name)  
                     {  
                       case 'image':  
                          $name = 'photo';  
                          break;  
                       case 'aside':  
                          $name = 'note';  
                          break;  
                       case 'status':  
                          $name = 'note';  
                          break;  
                       case 'link':  
                          $name = 'bookmark';  
                          break;  
                      }  
        	   }  
	   }
	return $name;
}


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
