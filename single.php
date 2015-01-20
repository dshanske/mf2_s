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
                                        $slug = 'templates/content-single';
                                        $name = mf2_s_template_type();
                                        get_template_part ($slug, $name);


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
