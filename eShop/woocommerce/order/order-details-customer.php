<?php
/**
 * Order Customer Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.4
 */

defined( 'ABSPATH' ) || exit;

$show_shipping = ! wc_ship_to_billing_address_only() && $order->needs_shipping_address();
?>
<section class="woocommerce-customer-details list-group my-4">

	<?php if ( $show_shipping ) : ?>

	<section class="woocommerce-columns woocommerce-columns--2 woocommerce-columns--addresses col2-set addresses">
		<div class="woocommerce-column woocommerce-column--1 woocommerce-column--billing-address">

	<?php endif; ?>

	<h2 class="woocommerce-column__title my-4"><?php esc_html_e( 'Billing address', 'woocommerce' ); ?></h2>

	<address class="my-2 list-group list-group-flush">
		
			<?php if($order->get_billing_first_name() && $order->get_billing_last_name()) ?>
				<p class="list-group-item"><?php echo wp_kses_post( $order->get_billing_first_name( esc_html__( 'N/A', 'woocommerce' ) ).' '.$order->get_billing_last_name( esc_html__( 'N/A', 'woocommerce' ) ) );?></p>
			<?php if($order->get_billing_company()):?>
				<p class="list-group-item"><?php echo wp_kses_post( $order->get_billing_company( esc_html__( 'N/A', 'woocommerce' ))); ?></p>
			<?php endif;?>
			<?php if(wp_kses_post( $order->get_billing_state())):?>
				<p class="list-group-item"><?php echo wp_kses_post( $order->get_billing_state( esc_html__( 'N/A', 'woocommerce' ))); ?></p>
			<?php endif;?>
			<?php if($order->get_billing_country()):?>
				<p class="list-group-item"><?php echo wp_kses_post( $order->get_billing_country( esc_html__( 'N/A', 'woocommerce' ))); ?></p>
			<?php endif;?>
			<?php if($order->get_billing_city()):?>
				<p class="list-group-item"><?php echo wp_kses_post( $order->get_billing_city( esc_html__( 'N/A', 'woocommerce' ))); ?></p>
			<?php endif;?>
			<?php if($order->get_billing_address_1()):?>
				<p class="list-group-item"><?php echo wp_kses_post( $order->get_billing_address_1( esc_html__( 'N/A', 'woocommerce' ))); ?></p>
			<?php endif;?>
			<?php if($order->get_billing_address_2()):?>
				<p class="list-group-item"><?php echo wp_kses_post( $order->get_billing_address_2( esc_html__( 'N/A', 'woocommerce' ))); ?></p>
			<?php endif;?>
			<?php if($order->get_billing_postcode()):?>
				<p class="list-group-item"><?php echo wp_kses_post( $order->get_billing_postcode( esc_html__( 'N/A', 'woocommerce' ))); ?></p>
			<?php endif;?>
			<?php if ( $order->get_billing_phone() ) : ?>
				<p class="woocommerce-customer-details--phone list-group-item"><?php echo esc_html( $order->get_billing_phone() ); ?></p>
			<?php endif; ?>

			<?php if ( $order->get_billing_email() ) : ?>
				<p class="woocommerce-customer-details--email list-group-item"><?php echo esc_html( $order->get_billing_email() ); ?></p>
			<?php endif; ?>
	</address>

	<?php if ( $show_shipping ) : ?>

		</div><!-- /.col-1 -->

		<div class="woocommerce-column woocommerce-column--2 woocommerce-column--shipping-address">
			<h2 class="woocommerce-column__title"><?php esc_html_e( 'Shipping address', 'woocommerce' ); ?></h2>
			<address class="my-2">
				<?php echo wp_kses_post( $order->get_formatted_shipping_address( esc_html__( 'N/A', 'woocommerce' ) ) ); ?>
			</address>
		</div><!-- /.col-2 -->

	</section><!-- /.col2-set -->

	<?php endif; ?>

	<?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>

</section>
