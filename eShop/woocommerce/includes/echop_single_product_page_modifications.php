<?php
if(!defined('ABSPATH')){
	exit; //if accessed directly
};

/*
 * Custom opening and ending tags
 */
add_action('woocommerce_before_main_content', 'eshop_add_custom_single_opening_tags', 25);

add_action('woocommerce_after_main_content', 'eshop_add_custom_single_ending_tags', 10);

function eshop_add_custom_single_opening_tags(){
	echo '<div class="container">';
	echo '<div class="row no-gutters">';
};

function eshop_add_custom_single_ending_tags() {
	echo '<div><!-- .row.no-gutters-->';
	echo '</div><!-- .container -->';
};

/*
 * Removing breadcrumbs to add custom ones
 */
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
add_action('woocommerce_before_main_content', 'eshop_add_custom_breadcrumbs', 30);

function eshop_add_custom_breadcrumbs() {
	echo '<div class="breadcrumbs col-12 order-first">';
	woocommerce_breadcrumb();
	echo '</div><!-- .breadcrumbs -->';
};

/*
 * Custom opening and ending content tags
 */
add_action('woocommerce_before_single_product', 'eshop_add_opening_tags', 5);

function eshop_add_opening_tags() {
	echo '<section class="productFull col-12 col-lg-9 offset-lg-1 order-2">';
};

add_action('woocommerce_after_single_product', 'eshop_add_ending_tags', 25);

function eshop_add_ending_tags() {
	echo '</section><!-- .productFull -->';
};

/*
 * Custom slider
 */
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);

add_action('woocommerce_before_single_product_summary', 'eshop_add_custom_prod_carousel', 20);

function eshop_add_custom_prod_carousel() {
	global $product;
	echo '<div class="productFull__slider">';
	
	$eshop_product_gallery = $product->get_gallery_image_ids();
	if($eshop_product_gallery) {

		echo '<div class="productFull__carousel" id="productFull__carousel">';

		foreach($eshop_product_gallery as $key => $id){
			$img_src = wp_get_attachment_image_src($id, 'full');
			echo '<img src="'.$img_src[0].'" alt="Product image '.$key.'">';
		};

		echo '</div><!-- .productFull__carousel -->';
		echo '<div class="productFull__thumbnails" id="productFull__thumbnails">';

		foreach($eshop_product_gallery as $key => $id){
			$img_src = wp_get_attachment_image_src($id, 'thumbnail');
			echo '<img src="'.$img_src[0].'" alt="Product image '.$key.'">';
		};

		echo '</div><!-- .productFull__thumbnails -->';
		
	}else {
		
		echo $product->get_image('full');
	
	};
	
	echo '</div><!-- .productFull__slider -->';
};

/*
 * Custom opening and ending summary tags
 */
add_action('woocommerce_before_single_product_summary', 'eshop_add_custom_summary_opener', 25);

function eshop_add_custom_summary_opener() {
	echo '<div class="productFull__presentation">';
};

add_action('woocommerce_after_single_product_summary', 'eshop_add_custom_summary_finisher', 5);

function eshop_add_custom_summary_finisher() {
	echo '</div><!-- .productFull__presentation-->';
};

/*
 * Custom add_to_cart form
 */
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
add_action('woocommerce_single_product_summary', 'eshop_add_to_cart', 30);

function eshop_add_to_cart() {
	if(is_singular('product')) {?>
		
		<div class="productFull__formWrapper">
			<?php 
				global $product;
				$eshop_prod_attributes = $product->get_attributes();?>
				<form action="<?php echo wc_get_cart_url().$product->add_to_cart_url();?>" method="POST" class="productOrdering">
				<?php

					//generating select tags
					
					foreach($eshop_prod_attributes as $key => $arr) {
						$prod_props = $arr->get_slugs();
						echo '<label><span>'.wc_attribute_label($key).'</span>';
						echo '<select name="'.$key.'" class="d-none productOrdering_select">';
						for($counter = 0; $counter < count($prod_props); $counter++) {
							$selected = '';
							if($counter == 0) $selected = ' selected="selected"';
							echo '<option name="'.$prod_props[$counter].'"'.$selected.'>'.$prod_props[$counter].'</option>';
						};
						echo '</select>';
						echo '</label>';
					};
					?>
					<div class="productOrdering__wrapper d-none">
						<button id="productOrdering__minus"><i class="fas fa-minus"></i></button>
						<input placeholder="quantity" value="1" id="productOrdering__quantity">
						<button id="productOrdering__plus"><i class="fas fa-plus"></i></button>
					</div>
					<div class="productOrdering__wrapper">
						<button type="submit" class="card__button" data-prodid="<?php
							echo $product->get_id();
						?>" data-url="<?php
							echo $product->add_to_cart_url();
						?>"><i class="fas fa-shopping-cart"></i><span>Добавить в корзину</span></button>
						<div class="wishlist_button_wrapper">
							<?php
							//look eshop_put_wishlist_buttons.php
							echop_put_wishlist_buttons();
							?>
						</div>
						<!--<a href="#" class="card__button"><i class="fas fa-heart"></i></a>-->
					</div>
				</form>
			</div>
		
	<?php } else {
		woocommerce_template_single_add_to_cart();
	};
};

/*
 * Don't know why native WC stars don't work, but they don't
 */
remove_action('woocommerce_single_product_summary','woocommerce_template_single_rating', 10);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_price', 10);
add_action('woocommerce_single_product_summary', 'eshop_single_rating_and_price', 10);

function eshop_single_rating_and_price() {
	global $product;
	$eshop_star_counter = $product->get_rating_count();
	echo '<span class="productFull__rate">';
	for($counter = 0; $counter < 5; $counter++) {
		if($counter <= $eshop_star_counter) {
			echo '<i class="fas fa-star"></i>';
		} else {
			echo '<i class="far fa-star"></i>';
		};
	};
	echo '</span>';
	woocommerce_template_single_price();
};


/*
 * Short product description in right tags
 */
add_filter('woocommerce_short_description', 'eshop_right_excerpt', 20);

function eshop_right_excerpt($content) {
	return '<div class="productFull__shortDescription">'.$content.'</div>';
};

/*
 * Custom tabs
 */
add_filter('woocommerce_output_product_data_tabs', 'eshop_add_custom_tabs', 10);

function eshop_add_custom_tabs ($product_tabs) {
	echo '<div class="woocommerce-tabs wc-tabs-wrapper productAbout">
		<ul class="tabs wc-tabs" role="tablist">';
			foreach ( $product_tabs as $key => $product_tab ) {
				echo '<li class="'.esc_attr( $key ).'_tab" id="tab-title-'.esc_attr( $key ).'" role="tab" aria-controls="tab-'.esc_attr( $key ).'">';
					echo '<a href="#tab-'.esc_attr( $key ).'">';
						echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) );
					echo '</a>
				</li>';
			};
		echo '</ul>';
		foreach ( $product_tabs as $key => $product_tab ) {
			echo '<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--'.esc_attr( $key ),' panel entry-content wc-tab" id="tab-'.esc_attr( $key ).'" role="tabpanel" aria-labelledby="tab-title-'.esc_attr( $key ).'">';
				
				if ( isset( $product_tab['callback'] ) ) {
					call_user_func( $product_tab['callback'], $key, $product_tab );
				}
				
			echo '</div>';
		};

		do_action( 'woocommerce_product_after_tabs' );
	echo '</div>';
};

//removing headers
add_filter('woocommerce_product_description_heading', 'eshop_remove_tab_header', 25);
add_filter('woocommerce_product_additional_information_heading', 'eshop_remove_tab_header', 25);
function eshop_remove_tab_header($arg) {
	$arg = false;
	return $arg;
};

//comment avatar resize
add_filter('woocommerce_review_gravatar_size', 'eshop_comment_avatar_resize');

function eshop_comment_avatar_resize() {
	return '80';
};