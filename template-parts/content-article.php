<?php
/**
 * @package MF2_S
 * Article Template for Post Kinds
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); mf2_s_semantics("post"); ?>>
        <?php get_template_part( 'template-parts/entry', 'header' ); ?>
	<?php
		echo '<div class="content entry-summary p-summary" itemprop="description">';
          $arg = array (
                'class' => 'photo u-photo'
                );
		the_post_thumbnail( 'thumbnail', $arg );
		the_excerpt();
		echo '<a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __('Read More', 'mf2_s') . '</a>';
		echo '</div><!-- .entry-summary -->';
	?>
	<?php get_template_part( 'template-parts/entry', 'footer' ); ?>
</article><!-- #post-## -->
