<?php
/**
 * @package MF2_S
 * Entry Header Separated into 
 */
?>

        <header class="entry-header">
                <div class="entry-meta">
                        <?php mf2_s_posted_on(); ?>
                        <?php mf2_s_posted_by(); ?>
                </div><!-- .entry-meta -->
		<?php if (is_single()) {
                 the_title( '<h1 class="entry-title p-name">', '</h1>' ); 
				 }
		else {
                 the_title( sprintf( '<h1 class="p-name entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' );
		     }
		?>
        </header><!-- .entry-header -->

