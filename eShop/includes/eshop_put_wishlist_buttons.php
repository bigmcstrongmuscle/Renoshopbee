<?php
/*
 * TI WooCommerce Wishlist allows to generate add-to-wishlist button via shortcodes
 * but it requires product id AND variation id
 * so i fetch all id's and generate buttons with it
 * then just switch buttons with js when user does choose variation
 */
function echop_put_wishlist_buttons() {
	global $product;
	if(!$product->is_type( 'variable' )){
		$shortcode_str = '[ti_wishlists_addtowishlist product_id="'.$product->get_id().'" variation_id="0"]';
		echo do_shortcode($shortcode_str);
	} else {
		$prod_vars = $product->get_available_variations();
		$eshop_counter = 0;
		foreach($prod_vars as $key => $single_var) {
			$shortcode_str = '[ti_wishlists_addtowishlist product_id="'.$product->get_id().'" variation_id="'.$single_var['variation_id'].'"]';
			echo '<div class="single_wishlist_button" data-id="'.$eshop_counter.'"'.eshop_generate_data_attribute($single_var['attributes']).'>';
			echo do_shortcode($shortcode_str);
			echo '</div>';
			$eshop_counter++;
		};
	};
};

function eshop_generate_data_attribute($attr_array){
	$result = '';
	foreach($attr_array as $key => $value){
		$name = substr($key, 10); //cuttin 'attribute_' off
		$result .= 'data-'.$name.'="'.$value.'" ';
	};
	return $result;
};