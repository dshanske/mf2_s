<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package MF2_S
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); mf2_s_semantics("page"); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title p-content">', '</h1>' ); ?>
	</header><!-- .entry-header -->

<!--	<div class="entry-content e-content"> -->
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'mf2_s' ),
				'after'  => '</div>',
			) );
		?>
<!--	</div> .entry-content -->

	<footer class="entry-footer">
		<?php edit_post_link( esc_html__( 'Edit', 'mf2_s' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
