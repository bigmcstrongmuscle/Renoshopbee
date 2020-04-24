<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>
<div class="container">
	<div class="breadcrumbs">
		<?php woocommerce_breadcrumb(); ?>
	</div><!-- .breadcrumbs -->
	<?php while ( have_posts() ) : the_post(); ?>

	<section class="productFull">
	<!-- slider with thumbnails -->	
		<div class="productFull__slider">
		<?php
			global $product;
			$eshop_product_gallery = $product->get_gallery_image_ids();
			if($eshop_product_gallery) :
		?>
			<div class="productFull__carousel" id="productFull__carousel">
		<?php
			foreach($eshop_product_gallery as $key => $id){
				$img_src = wp_get_attachment_image_src($id, 'full');
				echo '<img src="'.$img_src[0].'" alt="Product image '.$key.'">';
			};
		?>
			</div><!-- .productFull__carousel -->
		
			<div class="productFull__thumbnails" id="productFull__thumbnails">
		<?php
			foreach($eshop_product_gallery as $key => $id){
				$img_src = wp_get_attachment_image_src($id, 'thumbnail');
				echo '<img src="'.$img_src[0].'" alt="Product image '.$key.'">';
			};
		?>
			</div><!-- .productFull__thumbnails -->
		<?php else:?>
			<?php echo $product->get_image('full');?>
		<?php endif;?>
		</div><!-- .productFull__slider -->
		
		<div class="productFull__presentation">
			<div class="productFull__wrapper">
				<p class="productFull__title"><?php echo $product->get_name();?></p>
				<span class="productFull__price">$<?php echo $product->get_regular_price();?></span>
				<span class="productFull__rate">
				<?php
					$eshop_star_counter = $product->get_rating_count();
					for($counter = 0; $counter < 5; $counter++) {
						if($counter <= $eshop_star_counter) {
							echo '<i class="fas fa-star"></i>';
						} else {
							echo '<i class="far fa-star"></i>';
						};
					};
				?>
				</span>
				<p class="productFull__shortDescription"><?php echo $product->get_description();?></p>
			</div>
			<!-- check out -->
			<div class="productFull__formWrapper">
			<?php $eshop_prod_attributes = $product->get_attributes();?>
				<form action="<?php echo wc_get_cart_url().$product->add_to_cart_url();?>" method="POST" class="productOrdering">
				<?php

					//generating select tags
					
					foreach($eshop_prod_attributes as $key => $arr) {
						$prod_props = $arr->get_slugs();
						echo '<select name="'.$key.'" class="d-none"';
						for($counter = 0; $counter < count($prod_props); $counter++) {
							echo '<option name="'.$prod_props[$counter].'">'.$prod_props[$counter].'</option>';
						};
						echo '</select>';
					};
					?>
					<div class="productOrdering__wrapper d-none">
						<button id="productOrdering__minus"><i class="fas fa-minus"></i></button>
						<input placeholder="quantity" value="1" id="productOrdering__quantity">
						<button id="productOrdering__plus"><i class="fas fa-plus"></i></button>
					</div>
					<div>
						<button type="submit" class="card__button" data-prodid="<?php
							echo $product->get_id();
						?>" data-url="<?php
							echo $product->add_to_cart_url();
						?>"><i class="fas fa-shopping-cart"></i> add to cart</button>
						<a href="#" class="card__button"><i class="fas fa-heart"></i></a>
						<a href="#" class="card__button"><i class="fas fa-retweet"></i></a>
					</div>
				</form>
			</div>
		</div><!-- .productFull__presentation -->
	</section><!-- .productFull -->
	<?php endwhile; // end of the loop. ?>
</div><!-- .container -->
<?php get_footer( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
