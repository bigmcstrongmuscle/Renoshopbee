<?php
if(!defined('ABSPATH')){
	exit; //if accessed directly
};

/*
 * Adding archive opening and ending tags
 */
add_action('woocommerce_before_main_content', 'eshop_add_custom_archive_opening_tags', 45);

add_action('woocommerce_after_main_content', 'eshop_add_custom_archive_ending_tags', 5);

function eshop_add_custom_archive_opening_tags(){
	if(is_product()) return;
	echo '<div class="col-12 col-lg-9 offset-lg-1 order-2">';
};

function eshop_add_custom_archive_ending_tags() {
	if(is_product()) return;
	echo '</div>';
};

add_action('woocommerce_after_main_content', 'woocommerce_get_sidebar', 5);

/*
 * Hiding title on shop page
 */
//add_filter('woocommerce_show_page_title', 'eshop_hide_shop_title');

function eshop_hide_shop_title($show) {
	if(is_shop()) {
		$show = false;
	};
	return $show;
};

/*
 * Removing categories and subcategories from general product list
 */
remove_filter('woocommerce_product_loop_start', 'woocommerce_maybe_show_product_subcategories');

/*
 * And adding them before product list (inside their own list)
 */
add_filter('woocommerce_before_shop_loop', 'eshop_display_cats', 40);

function eshop_display_cats () {
	$cat_output = woocommerce_output_product_categories(array(
		'before' => '<ul class="row" style="list-style: none; padding: 0;">',
		'after' => '</ul>',
		'parent_id' => is_product_category() ? get_queried_object_id() : 0
	));
};

/*
 * In the end just adding bootstrap classes to cat items
 */
add_filter('product_cat_class', 'eshop_add_cat_classes');

function eshop_add_cat_classes($classes) {
	$classes[] = 'col-12 col-md-4';
	return $classes;
};

/*
 * Adding our own classes to product card
 */
add_filter('post_class', 'eshop_add_classes_to_product_card', );

function eshop_add_classes_to_product_card($classes) {
	if(is_shop() || is_product_taxonomy()) {
	$classes[] = 'card productSingle';
	};
	return $classes;
};