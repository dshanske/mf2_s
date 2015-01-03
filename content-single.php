<?php
/**
 * @package MF2_S
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('h-entry'); ?>>
        <?php get_template_part( 'entry', 'header' ); ?>
	<?php if (function_exists('response_display')) { response_display(); } ?>
	<div class="entry-content e-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'mf2_s' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php get_template_part( 'entry', 'footer' ); ?>
</article><!-- #post-## -->
