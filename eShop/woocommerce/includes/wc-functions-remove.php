<?php
if(!defined('ABSPATH')){
	exit; //if accessed directly
};

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );


/*
 * Removing sidebar to output it without hooks
 */
//remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

/*
 * Removing product summary to add it in other place
 */
//remove_all_filters('woocommerce_after_single_product_summary');
//remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
//remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
//remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

/*
 * Removing archive description
 */
remove_action('woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10);
remove_action('woocommerce_archive_description', 'woocommerce_product_archive_description', 10);

/*
 * Removing download tab from my account page
 */
add_filter('woocommerce_account_menu_items', 'eshop_remove_myaccount_tab', 10, 2);
function eshop_remove_myaccount_tab($items, $endpoints) {
	unset($items['downloads']);
	return $items;
};