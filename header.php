<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package MF2_S
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="profile" href="http://microformats.org/profile/specs" />
<link rel="profile" href="http://microformats.org/profile/hatom" />
<?php wp_head(); ?>
</head>

<body <?php body_class(); mf2_s_semantics("body"); ?> >
<div id="page" class="site">
	<?php if (!is_singular() ) 
            {
		// H-Feed P-Name
		echo '<span class="p-name hfeedname">';
		echo wp_title();
		echo ' - Feed</span>';
	    }
	?>
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'mf2_s' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<?php
        $title = mf2_s_semantics("site-title", false) . '><a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" rel="home" ' . mf2_s_semantics("site-url", false) . '>' . get_bloginfo( 'name' ) . '</a>';
				if ( get_header_image() ) { ?>
    			<span class="custom-header">
    			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" <?php mf2_s_semantics("site-url"); ?> rel="home">
    			<img src="<?php header_image(); ?>" width="100%" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt=<?php echo esc_attr( get_bloginfo( 'name', 'display') );?>>
    			</a>
  				</span>
  		<?php } // End header image check. 
			  else {
					if ( is_front_page() && is_home() ) {
						echo '<h1 ' . $title . '</h1>';
				  } 
					else { 
						echo '<h2 ' . $title . '</h2>';				
					}
				}
			$description = get_bloginfo( 'description' );
			if ( ! empty( $description ) ) : ?>
				<div class="site-description" <?php mf2_s_semantics("site-description"); ?>><?php echo esc_html( $description ); ?></div>
			<?php endif;
			?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"></button>
		<?php
			$args = array(
				'theme_location'  => 'primary',
        'menu_id' => 'primary-menu'
);
			wp_nav_menu( $args ); 
		?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
