<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package MF2_S
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					if (function_exists('get_post_kind') )
						{
                                      		  /* Include the Kind-specific template for the content, for Indieweb Post Kinds
                                         	   * If you want to override this in a child theme, then include a file
                                        	   * called content-___.php (where ___ is the Post Kind name) and that will be used instead.
                                         	   */
                                       		   get_template_part( 'content', get_post_kind() );
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
					          get_template_part( 'content', $format );
					     }
				?>

			<?php endwhile; ?>

                        <?php the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
