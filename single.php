<?php
/**
 * The template for displaying all single posts.
 *
 * @package MF2_S
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php 
			while ( have_posts() ) : the_post();

                                        if (function_exists('get_post_kind') )
                                                {
                                                  /* Include the Kind-specific template for the content, for Indieweb Post Kinds
                                                   * If you want to override this in a child theme, then include a file
                                                   * called content-___.php (where ___ is the Post Kind name) and that will be used instead.
                                                   */
                                                   get_template_part( 'templates/content-single', get_post_kind_slug() );
                                                }
                                        else {
                                        /* If the Post Kind plugin is disabled, include the Post-Format-specific template for the content.
                                         * If you want to override this in a child theme, then include a file
                                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                         */
                                                $format = get_post_format();
                                                if ( false === $format ) {
                                                        $format = 'standard';
                                                  }
                                                  get_template_part( 'templates/content-single', $format );
                                             }


			 the_post_navigation();

			
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
