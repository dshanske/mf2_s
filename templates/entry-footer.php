<?php
/**
 * @package MF2_S
 * Entry Footer Separated into 
 */
?>
	<footer class="entry-footer">
	<?php
        
	edit_post_link( __( 'Edit', 'mf2_s') , ' <span class="edit-link">', '</span> ' );
	if (function_exists('get_post_kind'))
		{
			echo 'Kind: ';
			mf2_s_post_kind(true);
		}
	else{
			echo 'Format: ';
			mf2_s_post_format(true);
	    }
	echo ' ';
        // Hide category and tag text for pages.
        if ( 'post' == get_post_type() ) {
		  echo 'Tags: ';
                  mf2_s_post_categories();
		  echo ' ';
                  mf2_s_post_tags() . ' ';
                  if (!is_single()) {
			echo ' ';
                        mf2_s_responses();
                                    }
        }
        // If the Syndication Links Plugin is installed, display links
        if (function_exists('get_syndication_links'))
                {
                   echo get_syndication_links();
                }
        // Defines a simple function to retrieve location, for use/future use by Simple Location
        if (function_exists('get_simple_location'))
                {
                   echo get_simple_location();
                }
	echo apply_filters( 'footer_entry_meta' , ''); 
	?>
	</footer><!-- .entry-footer -->
