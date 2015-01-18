<?php
/**
 * @package MF2_S
 * Like has no e-content
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); mf2_s_semantics("post"); ?>>
        <?php get_template_part( 'templates/entry', 'header' ); ?>
	<?php
	if (function_exists('response_display')) { response_display(); }
	?>
	<?php get_template_part( 'templates/entry', 'footer' ); ?>
</article><!-- #post-## -->
