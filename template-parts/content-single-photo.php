<?php
/**
 * @package MF2_S
 * Single View For the Photo Post Kind
 */

if (!has_post_thumbnail() )
    {
	get_template_part('template-parts/content-single');
    }
else {
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); mf2_s_semantics("post"); ?>>
        <?php get_template_part( 'template-parts/entry', 'header' ); ?>
	<! -- Displays the featured image sizes as a responsive image -->
	<div class="content">
	  <?php 
			resp_featured_image( get_post_thumbnail_id( $post->ID ), "75vw");
      echo apply_filters('the_content', "");
		?>
	<!-- srcset full size image -->
	</div> 
	<?php get_template_part( 'template-parts/entry', 'footer' ); ?>
</article><!-- #post-## -->
<?php } ?>
