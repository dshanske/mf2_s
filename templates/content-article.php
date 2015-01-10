<?php
/**
 * @package MF2_S
 * Article Template for Post Kinds
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); mf2_s_semantics("post"); ?>>
        <?php get_template_part( 'templates/entry', 'header' ); ?>
	<?php
	if (is_search() || !is_singular() ) {
		echo '<div class="entry-summary p-summary" itemprop="description">';
		the_excerpt();
		echo '<a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __('Read More', 'mf2_s') . '</a>';
		echo '</div><!-- .entry-summary -->';
	     }
	else {
		echo '<div class="entry-content e-content" itemprop="description articleBody">';
		the_content();
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'mf2_s' ),
			'after'  => '</div>',
		) );
	      
		echo '</div><!-- .entry-content -->';
	     }

	?>
	<?php get_template_part( 'templates/entry', 'footer' ); ?>
</article><!-- #post-## -->
