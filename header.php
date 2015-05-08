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
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

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
			   if ( is_front_page() && is_home() ) : ?>
				<h1 <?php mf2_s_semantics("site-title"); ?>><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" <?php mf2_s_semantics("site-url"); ?>><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<div <?php mf2_s_semantics("site-title"); ?>><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" <?php mf2_s_semantics("site-url"); ?>><?php bloginfo( 'name' ); ?></a></div>
			<?php endif;
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
