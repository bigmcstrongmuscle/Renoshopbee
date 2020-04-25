<?php
if(!defined('ABSPATH')){
	exit; //if accessed directly
};

add_action( 'wp_ajax_eshop_addtocart', 'eschop_do_ajax' );
add_action('wp_ajax_nopriv_eshop_addtocart', 'eschop_do_ajax');

function eschop_do_ajax () {
	$message = ''; //var for containing output message
	$prodid = absint($_POST['prodid']);
	$product = wc_get_product( absint($prodid) );
	$quantity = absint($_POST['quantity']);
	if(!wp_verify_nonce($_POST['nonce'], 'localize_nonce')) {
		wp_die('Левые полключения');
	};
	
	if(!empty($_POST['attributes'])){
		$attributes = $_POST['attributes'];
	};
	
	//is variable prodact?
	if($product->is_type( 'variable' ) && !empty($attributes)) {
		//variation id
		$var = get_chosen_variation($prodid, $attributes);
		//adding to cart
		if( $var[0] !== 0 && !is_string($var[0]) ) {
			WC()->cart->add_to_cart( $prodid, $quantity, $var[0] );
		} else {
			$message = $var;
		};
		
		if( $var[0] !== 0 && !is_string($var[0]) ) {
			$message = wc_print_notices( true );
		} else {
			$message = $var;
		};
	} else {
		//just adding to cart
		WC()->cart->add_to_cart( $prodid, $quantity);
		$message = wc_print_notices( true );
	};
	
	//checking out cart
	$outputting_data = array(
		'message' => $message,
		'count' => WC()->cart->get_cart_contents_count()
	);
	wp_send_json($outputting_data);
	wp_die();
};

function get_chosen_variation($prodid, $matching_attributes) {
	//getting product variation id by chosen attributes
	$current_product = wc_get_product($prodid);
	$variations = $current_product->get_available_variations();
	$result = array();
	$fixed_matching_array = array();
	
	foreach($matching_attributes as $matching_attr_name => $matching_attr_value) {
		$fixed_matching_array['attribute_'.esc_sql($matching_attr_name)] = esc_sql($matching_attr_value);
	};
	
	foreach($variations as $key => $vararray) {
		//matching attribute names and values
		$comparing_result = array();
		foreach($vararray['attributes'] as $attr_name => $attr_value) {
			//$comparing_result[$attr_name] = array($attr_value, $fixed_matching_array[$attr_name]);
			if(array_key_exists($attr_name, $fixed_matching_array) && ($attr_value === $fixed_matching_array[$attr_name])) {
				$comparing_result[] = true;
			} else {
				$comparing_result[] = false;
			};
		};
		
		//$result[] = $comparing_result;
		
		if(!in_array(false, $comparing_result)) {
			$result[] = $vararray['variation_id'];
		};
	};
	
	if(!empty($result)) {
		$var = $result;
	} else {
		$var = 'Что-то пошло не так.';
	};

	return $var;
};