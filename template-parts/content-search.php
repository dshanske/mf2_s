<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package MF2_S
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php get_template_part( 'template-parts/entry', 'header' ); ?>

	<div class="content">
		<?php the_excerpt(); ?>
	</div><!-- .content -->
        <?php get_template_part( 'template-parts/entry', 'footer' ); ?>

</article><!-- #post-## -->
