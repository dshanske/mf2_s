<?php
/**
 * @package MF2_S
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php get_template_part( 'templates/entry', 'header' ); ?>
	<?php if (function_exists('response_display')) { response_display(); } ?>
	<div class="entry-content e-content" itemprop="description articleBody">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'mf2_s' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php get_template_part( 'templates/entry', 'footer' ); ?>
</article><!-- #post-## -->
