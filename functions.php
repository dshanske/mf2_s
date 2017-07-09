<?php
/**
 * MF2_S functions and definitions
 *
 * @package MF2_S
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'mf2_s_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function mf2_s_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on MF2_S, use a find and replace
	 * to change 'mf2_s' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'mf2_s', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
        /*
         * Declare the theme supports microformats2 so any plugin that marks up content will be aware
         * 
         */

	add_theme_support( 'microformats2' ); 

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'mf2_s' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption','widgets'
	) );

	/*
	 * Enable support for Post Formats only if the Indieweb Post Kind plugin is not enabled
	 * See http://codex.wordpress.org/Post_Formats
	 */
		if (!function_exists('get_post_kind'))
		   {
			add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
		        ) );
		   }
		else {
	//		add_theme_support( 'post-kinds');
	     }

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'mf2_s_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

}
endif; // mf2_s_setup
add_action( 'after_setup_theme', 'mf2_s_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function mf2_s_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'mf2_s' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'mf2_s_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function mf2_s_scripts() {

 	// Add HTML5 support to older versions of IE
	if ( isset( $_SERVER['HTTP_USER_AGENT'] ) && ( false !== strpos( $_SERVER['HTTP_USER_AGENT'], 'MSIE' ) ) && ( false === strpos( $_SERVER['HTTP_USER_AGENT'], 'MSIE 9' ) ) ) {
		wp_enqueue_script('html5', get_template_directory_uri() . '/js/html5shiv.min.js', false, '3.7.2');
	    } 
	// Minified CSS
	wp_enqueue_style( 'mf2_s-style', get_template_directory_uri() . '/site.min.css' );

	wp_enqueue_script( 'mf2_s-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );


	wp_enqueue_script( 'mf2_s-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'mf2_s_scripts' );

/**
 * Adds a notice about missing dependent plugins
 */
function mf2_s_plugin_notice() {
    if (!function_exists("send_webmention"))
	{
	    echo '<div class="error"><p>';
           _e( 'This Theme Requires Webmention Support', 'mf2_s' );
	    echo '</p></div>';
	}
    if (!class_exists("Semantic_Linkbacks_Plugin")) 
	{
	    echo '<div class="error"><p>';
           _e( 'This Theme requires the Semantic Linkbacks Plugin', 'mf2_s' );
	    echo '</p></div>';
	}
}
add_action( 'admin_notices', 'mf2_s_plugin_notice' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom entry meta functions for this theme.
 */
require get_template_directory() . '/inc/entry-meta.php';

/**
 * Custom Comment Walker to Enable MF2
 */
require get_template_directory() . '/inc/class-comment-walker.php';

/**
 * Comment Functions
 */
require get_template_directory() . '/inc/comment-functions.php';


/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
