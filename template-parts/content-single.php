<?php
/**
 * @package MF2_S
 * Generic Single Display
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); mf2_s_semantics("post"); ?>>
        <?php get_template_part( 'template-parts/entry', 'header' ); ?>
	<?php
		if (is_search() ) {
			echo '<div class="content">';
			the_excerpt();
		echo '</div><!-- .content -->';
		}
		else {
			echo '<div class="content">';
			the_content();
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'mf2_s' ),
				'after'  => '</div>',
			) );      
			echo '</div><!-- .content -->';
    }
	?>
	<?php get_template_part( 'template-parts/entry', 'footer' ); ?>
</article><!-- #post-## -->
