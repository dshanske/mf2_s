<?php
/**
 * @package MF2_S
 * Generic Single Display
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); mf2_s_semantics("post"); ?>>
        <?php get_template_part( 'template-parts/entry', 'header' ); ?>
	<?php
	if (function_exists('kind_response_display')) { kind_response_display(); }
	$name = mf2_s_template_type();
	$responseonly = array( "like", "favorite");
	// Omit displaying content if no content is to be displayed
	if (!in_array($name, $responseonly)) {
		if (is_search() ) {
		//	echo '<div class="entry-summary p-summary" itemprop="description">';
			the_excerpt();
	//		echo '</div><!-- .entry-summary -->';
		     }
		else {
	//		echo '<div class="entry-content e-content" itemprop="description articleBody">';
			the_content();
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'mf2_s' ),
				'after'  => '</div>',
			) );
		      
	//		echo '</div><!-- .entry-content -->';
		     }
	}
	?>
	<?php get_template_part( 'template-parts/entry', 'footer' ); ?>
</article><!-- #post-## -->
