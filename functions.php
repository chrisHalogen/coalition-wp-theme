<?php
/**
 * CT Custom functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package CT_Custom
 */

if ( ! function_exists( 'ct_custom_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function ct_custom_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on CT Custom, use a find and replace
		 * to change 'ct-custom' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'ct-custom', get_template_directory() . '/languages' );

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
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'ct-custom' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'ct_custom_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'ct_custom_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ct_custom_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'ct_custom_content_width', 640 );
}
add_action( 'after_setup_theme', 'ct_custom_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ct_custom_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'ct-custom' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'ct-custom' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'ct_custom_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ct_custom_scripts() {
	wp_enqueue_style( 'ct-custom-style', get_stylesheet_uri() );

	wp_enqueue_script( 'ct-custom-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'ct-custom-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ct_custom_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

// Theme Options
function addThemeOptions(){

    add_menu_page('Theme Options', 
        'Theme Options', 
        'manage_options', 
		'ct-theme-options', 
        'ct_custom_theme_options', 
        'dashicons-admin-site-alt', 
        10 , // Position
    );

}
add_action('admin_menu', 'addThemeOptions');

// Load media files in the admin dashboard
function ct_theme_load_media_files() {
    wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'ct_theme_load_media_files' );

// Register admin JS
function ct_theme_register_admin_script(){
    wp_enqueue_script( 'ct-admin-script', get_template_directory_uri() . '/js/admin.js', array('jquery','media-upload'), time() );

}
add_action( 'admin_enqueue_scripts', 'ct_theme_register_admin_script' );

// Register guest JS
function ct_theme_register_guest_script(){
    wp_enqueue_script( 'ct-guest-js', get_template_directory_uri() . '/js/guest.js', array('jquery'), time() );
}
add_action( 'wp_enqueue_scripts', 'ct_theme_register_guest_script' );

// Echo debug log
if ( ! function_exists('write_log')) {
    function write_log ( $log )  {
        if ( is_array( $log ) || is_object( $log ) ) {
            error_log( print_r( $log, true ) );
        } else {
            error_log( $log );
        }
    }
}

// User Area Scripts
function ct_theme_register_guest_css() {
    
    wp_register_style( 'ct-theme-guest-css', get_template_directory_uri() . '/homepage-style/home.css', array(), time() );
    wp_enqueue_style('ct-theme-guest-css');

}

add_action( 'wp_enqueue_scripts', 'ct_theme_register_guest_css' );

// Get Theme Options data
function ct_theme_update_wp_option( $option_key, $option_value ){

    if (! update_option( $option_key, $option_value) ){
        add_option( $option_key, $option_value );
    }

}

// Get Logo
function ct_get_theme_logo(){
	$logo_url = "";

	try {
		if (wp_get_attachment_url( get_option('ct-theme-logo-id') )){
			$logo_url = wp_get_attachment_url( get_option('ct-theme-logo-id') );
		}
	
	} catch (\Throwable $th) {
		write_log( $th);
	}

	return $logo_url;

}

// Get Phone
function ct_get_phone(){
	// Get Phone
	$data = "385.154.11.28.38";
	if (get_option('ct-theme-phone')){
		$temp = get_option('ct-theme-phone');
		$data = esc_html($temp);
	}

	return $data;

}


// Get Contact Page Data
function ct_get_page_data(){
	$data = array();

	try {

		// Get the Logo URL
		$data["logo_url"] = "";

		if (wp_get_attachment_url( get_option('ct-theme-logo-id') )){
			$temp = wp_get_attachment_url( get_option('ct-theme-logo-id') );

			$data["logo_url"] = esc_url($temp);
		}

		// Get Page content
		$data["content"] = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam posuere ipsum nec velit mattis elementum. Cum sociis natoque 
		penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas eu placerat metus, eget placerat libero. ";
		if (get_option('ct-theme-page-content')){
			$temp = get_option('ct-theme-page-content');
			$data["content"] = nl2br(htmlentities(esc_textarea($temp)));
		}
		
		// Get Address
		$data["address"] = "Coalition Skills Test<br>535 La Plata Street<br>4200 Argentina";
		if (get_option('ct-theme-address')){
			$temp = get_option('ct-theme-address');
			$data["address"] = nl2br(htmlentities(esc_textarea($temp)));
		}

		// Get Phone
		$data["phone"] = ct_get_phone();

		// Get Fax
		$data["fax"] = "385.154.35.66.78";
		if (get_option('ct-theme-fax')){
			$temp = get_option('ct-theme-fax');
			$data["fax"] = esc_html($temp);
		}

		// Get Facebook URL
		$data["fb-url"] = "https://";
		if (get_option('ct-theme-facebook-url')){
			$temp = get_option('ct-theme-facebook-url');
			$data["fb-url"] = esc_url($temp);
		}

		// Get Twitter URL
		$data["tw-url"] = "https://";
		if (get_option('ct-theme-twitter-url')){
			$temp = get_option('ct-theme-twitter-url');
			$data["tw-url"] = esc_url($temp);
		}

		// Get Linkedin URL
		$data["ln-url"] = "https://";
		if (get_option('ct-theme-linkedin-url')){
			$temp = get_option('ct-theme-linkedin-url');
			$data["ln-url"] = esc_url($temp);
		}

		// Get Linkedin URL
		$data["pin-url"] = "https://";
		if (get_option('ct-theme-pinterest-url')){
			$temp = get_option('ct-theme-pinterest-url');
			$data["pin-url"] = esc_url($temp);
		}

		return $data;

	} catch (\Throwable $th) {
		write_log($th);
	}
}

// Import Theme Options File
require_once( dirname(__FILE__) . '/theme_settings.php' );

