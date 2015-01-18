<?php
/**
 * @package MF2_S
 */
?>

<?php 
$slug = 'templates/content-single';
if (function_exists('get_post_kind') )
	{
	/* Include the Kind-specific template for the content, for Indieweb Post Kinds
	 * If you want to override this in a child theme, then include a file
	 * called content-___.php (where ___ is the Post Kind name) and that will be used instead.
	 */
		get_template_part( $slug , get_post_kind_slug() );
     }
else {
		/* If the Post Kind plugin is disabled, include the Post-Format-specific template for the content.
		 * If you want to override this in a child theme, then include a file
		 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
		 */
			$format = get_post_format();
			if ( false === $format ) {
				$format = 'standard';
				}
		get_template_part( $slug, $format );
	}
	
	
?>
