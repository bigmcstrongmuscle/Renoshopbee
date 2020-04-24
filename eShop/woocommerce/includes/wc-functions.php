<?php
if(!defined('ABSPATH')){
	exit; //if accessed directly
};

/*
 * Modifying single product page
 */
require get_template_directory().'/woocommerce/includes/echop_single_product_page_modifications.php';

/*
 * Modifying archive page
 */
require get_template_directory().'/woocommerce/includes/echop_archive_page_modifications.php';

/*
 * Turning off sidebar on all product pages
 */
add_action('woocommerce_sidebar', 'echop_add_product_sidebar', 10);

function echop_add_product_sidebar() {
	if( !is_product() ) {
		woocommerce_get_sidebar();
	};
};

/*
 * Adding wrapper for woocommerce_result_count and woocommerce_catalog_ordering to align them
 */
add_action('woocommerce_before_shop_loop', 'eshop_add_result_ordering_wrapper_opener', 15);
add_action('woocommerce_before_shop_loop', 'eshop_add_result_ordering_wrapper_finisher', 35);

function eshop_add_result_ordering_wrapper_opener() {
	echo '<div class="result_ordering_wrapper">';
};

function eshop_add_result_ordering_wrapper_finisher() {
	echo '</div>';
};

/*
 * Right image size for related products
 */
add_filter('single_product_archive_thumbnail_size', 'eshop_change_thumbnail_size');

function eshop_change_thumbnail_size($arg) {
	if($GLOBALS['eshop_is_related_products']){
		return  'eshop_related_gallery';
	};
	
	return $arg;
};

/*
 * Modifying billing field wrappers' classes
 */
add_filter( 'woocommerce_form_field_args', 'eshop_mod_billing_wrap_classes', 10, 3 );
function eshop_mod_billing_wrap_classes( $args, $key, $value ){
	$args['class'][] = 'billing_field_aliegner';
	
	switch ($key) {
		case 'billing_first_name': $args['class'][] = 'col-12 col-md-6 p-0 m-0 pr-1';
		break;
		
		case 'billing_last_name': $args['class'][] = 'col-12 col-md-6 p-0 m-0 pl-1';
		break;
		
		case 'billing_phone': $args['class'][] = 'col-12 col-md-6 p-0 m-0 pr-1';
		break;
		
		case 'billing_email': $args['class'][] = 'col-12 col-md-6 p-0 m-0 pl-1';
		break;
		
		default: $args['class'][] = 'col-12 p-0 m-0';
		break;
	}

	return $args;
};

/*
 * Adding custom classes to checkout button
 */
add_filter('woocommerce_order_button_html', 'eshop_mod_checkout_button');

function eshop_mod_checkout_button($args) {
	return str_replace('class="', 'class="order_review_button ', $args);
};

/*
 * Adding wrapper to cart table
 */
add_action('woocommerce_before_cart', 'eshop_add_cart_table_wrap_opener', 5);
add_action('woocommerce_before_cart_collaterals', 'eshop_add_cart_table_wrap_finisher', 5);

function eshop_add_cart_table_wrap_opener() {
	echo '<div class="shopcart">';
};

function eshop_add_cart_table_wrap_finisher() {
	echo '</div>';
};

/*
 * Modyfying classes of my-account page
 */
add_filter( 'post_class', 'eshop_aligne_my_account', 10, 3 );
function eshop_aligne_my_account( $classes, $class, $post_id ){
	if(is_page_template('templates/no-sidebar.php')) {
		$classes[] = 'col-md-10 mx-auto';
	};

	return $classes;
};

add_filter('woocommerce_account_menu_item_classes', 'eshop_add_nav_item_classes', 10, 2);
function eshop_add_nav_item_classes($classes, $endpoint) {
	global $wp;
	//bootstrap classes
	$classes[] = 'nav-item';
	
	// Set current item class.
	$current = isset( $wp->query_vars[ $endpoint ] );
	if ( 'dashboard' === $endpoint && ( isset( $wp->query_vars['page'] ) || empty( $wp->query_vars ) ) ) {
		$current = true; // Dashboard is not an endpoint, so needs a custom check.
	} elseif ( 'orders' === $endpoint && isset( $wp->query_vars['view-order'] ) ) {
		$current = true; // When looking at individual order, highlight Orders list item (to signify where in the menu the user currently is).
	} elseif ( 'payment-methods' === $endpoint && isset( $wp->query_vars['add-payment-method'] ) ) {
		$current = true;
	}

	if ( $current ) {
		$classes[] = 'active'; //bootstrap class too
}
	
	return $classes;
};

/*
 * Turning off wishlist plugin title
 */
add_filter('tinvwl_wishlist_header_title', 'eshop_remove_wishlist_title', 10, 2);
function eshop_remove_wishlist_title($title, $wishlist) {
	if($title) {
		$title = '';
	};
	return $title;
};


/*
 * Attributes in product titles in cart
 */
//add_filter('woocommerce_product_variation_title_include_attributes', '__return_true');
add_filter('woocommerce_product_variation_title_include_attributes', '__return_false');