<?php
/**
 * @package MF2_S
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('h-entry'); ?>>
	<header class="entry-header">
		<div class="entry-meta">
			<?php mf2_s_posted_on(); ?>
                        <?php mf2_s_posted_by(); ?>
		</div><!-- .entry-meta -->
		<?php the_title( sprintf( '<h1 class="p-name entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<?php endif; ?>
	</header><!-- .entry-header -->
	<?php if (function_exists('response_display')) { response_display(); } ?>
	<div class="entry-content e-content">
		<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'mf2_s' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
		?>

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
