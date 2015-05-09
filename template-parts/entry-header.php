<?php
/**
 * @package MF2_S
 * Entry Header Separated into 
 */
?>

        <header class="entry-header">
                <div class="entry-meta">
                        <?php
				mf2_s_posted_on(); 
                        	mf2_s_posted_by(); 
				// Add a filter for plugins to hook into
				echo apply_filters( 'header_entry_meta' , ''); 
			?>
                </div><!-- .entry-meta -->
		<?php
      if (mf2_s_template_type()=='article') {
        if (is_single()) {
          the_title( '<h2 class="entry-title p-name" itemprop="name headline">', '</h2>' ); 
				}
		    else {
          the_title( sprintf( '<h2 class="p-name entry-title" itemprop="name headline"><a class ="u-url" href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
		    }
      }
		?>
        </header><!-- .entry-header -->

