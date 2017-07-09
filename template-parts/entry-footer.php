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

	// add a filter to add additional footer_entry_meta as needed
	echo apply_filters( 'footer_entry_meta' , ''); 
	?>
	</footer><!-- .entry-footer -->
