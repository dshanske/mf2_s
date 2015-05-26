<?php
/**
 * @package MF2_S
 * Article Template for Post Kinds
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); mf2_s_semantics("post"); ?>>
        <?php get_template_part( 'template-parts/entry', 'header' ); ?>
	<?php
		echo '<div class="content">';
		the_content();
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'mf2_s' ),
			'after'  => '</div>',
		) );
	      
		echo '</div><!-- .content -->';

	?>
	<?php get_template_part( 'template-parts/entry', 'footer' ); ?>
</article><!-- #post-## -->
