<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

/**
 * custom 'carbon fields'
 */

add_action( 'after_setup_theme', 'crb_load' );
function crb_load() {
    require_once( get_template_directory().'/includes/carbon-fields/vendor/autoload.php' );
    \Carbon_Fields\Carbon_Fields::boot();
}


/*function crbn_load() {
	loadtemplate(get_template_directory().'/includes/carbon-fields/vendor/autoload.php');
};
add_action('after_setup_theme', 'crbn_load');*/

/**
 * custom fields metaboxes and theme-options
 */
function eshop_register_custom_fields() {
	require get_template_directory() . '/includes/custom-field-options/metaboxs.php';
	require get_template_directory() . '/includes/custom-field-options/theme-options.php';
};
add_action('carbon_fields_register_fields', 'eshop_register_custom_fields');

/**
 * eShop functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package eShop
 */


/*
 * Add dynamic login link into menu
 */
function eShop_login_in_menu($items, $args) { 
    if ($args->theme_location == 'acc') {
        $loginoutlink = wp_loginout('index.php', false); 
        $items = '<li>'. $loginoutlink .'</li>'.$items; 
    }
    return $items; 
};
add_filter('wp_nav_menu_items', 'eShop_login_in_menu', 10, 2);

/*
 * Custom image sizes
 */
add_theme_support( 'post-thumbnails' );
add_image_size( 'eshop_related_gallery', 270, 300, true );

/**
 * Auxiliary functions.
 */
require get_template_directory() . '/includes/helpers.php';

/**
 * TGM plugin activation.
 */
require get_template_directory() . '/includes/eshop_required_plugins.php';

/**
 * Wishlist buttons in single product page
 */
require get_template_directory() . '/includes/eshop_put_wishlist_buttons.php';

/**
 * Adding product to cart with ajax.
 */
require get_template_directory() . '/includes/eshop_add_to_cart_single.php';

/**
 * Search with ajax.
 */
require get_template_directory() . '/includes/ajax_search.php';

/**
 * Header menu.
 */
require get_template_directory() . '/includes/eShop_custom_menus.php';

/**
 * Load theme-settings.
 */
require get_template_directory() . '/includes/theme-settings.php';

/**
 * Load widjets.
 */
require get_template_directory() . '/includes/widget-areas.php';

/**
 * Load scripts and styles.
 */
require get_template_directory() . '/includes/enqueue-script-style.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/includes/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/includes/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/includes/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/includes/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/includes/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/includes/woocommerce.php';
	require get_template_directory() . '/woocommerce/includes/wc-functions-remove.php';
	require get_template_directory() . '/woocommerce/includes/wc-functions.php';
};


/*
 * Setting a variables up
 */
require get_template_directory() . '/includes/vars.php';