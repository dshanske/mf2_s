<?php
/**
 * @package MF2_S
 * For the Photo Post Kind
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); mf2_s_semantics("post"); ?>>
        <?php get_template_part( 'templates/entry', 'header' ); ?>
	<?php
	    // If the photo has a featured image, display a summary with the post thumbnail
	    if ( has_post_thumbnail() && !is_singular() ) {
		echo '<div class="entry-summary p-summary" itemprop="description">';
		echo '<figure class="entry-media">';
		echo '<a href="' . get_the_permalink() . '" title="' . esc_attr(strip_tags(get_the_title() ) ) . '">';   
         	$arg = array (
			'class' => 'photo u-photo'
			);
		the_post_thumbnail( 'medium', $arg );         
		echo '</a><figcaption>' . get_post(get_post_thumbnail_id())->post_excerpt . '</figcaption></figure>';
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
