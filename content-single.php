<?php
/**
 * @package MF2_S
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="entry-meta">
			<?php mf2_s_posted_on(); ?>
                        <?php mf2_s_posted_by(); ?>
		</div><!-- .entry-meta -->
		<?php the_title( '<h1 class="entry-title p-name">', '</h1>' ); ?>

	</header><!-- .entry-header -->
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

	<footer class="entry-footer">
		<?php mf2_s_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
