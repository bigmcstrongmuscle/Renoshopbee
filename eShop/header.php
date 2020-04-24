<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package eShop
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> id="body">
<div id="page" class="site">
	<!--<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'eshop' ); ?></a>-->
	<div class="shortScreen d-none" id="shortScreen"><!-- menu for small screens -->
		<nav class="shortScreen__menu d-none" id="shortScreen__menu">
			<?php eShop_show_menu();?>
		</nav>
	</div><!-- .shortScreen -->
	
	<header id="masthead" class="header">
		<div class="topline">
			<address>
				<div><i class="fas fa-phone-alt"></i><?php echo esc_html(carbon_get_theme_option('eshop_contacts_phone'));?></div>
				<i class="topline-delimiter">|</i>
				<div><i class="fas fa-envelope"></i><a href="mailto:<?php echo esc_html(carbon_get_theme_option('eshop_contacts_phone'));?>"><?php echo esc_html(carbon_get_theme_option('eshop_contacts_mail'));?></a></div>
			</address>
			<div class="social">
				<?php wp_nav_menu( array('container' => '', 'theme_location' => 'social'));?>
			</div><!-- .social -->
		</div><!-- .topline -->
		<div class="mainMenu">
			<?php 
			$site_logo_id = carbon_get_theme_option('eshop_header_logo');
			if($site_logo_id) {
			$site_logo = wp_get_attachment_image_src($site_logo_id, array(36, 166));
			?>
			<div class="logo"><a href="<?php echo home_url('/');?>"><img src="<?php echo $site_logo[0];?>" alt="logo"></a></div>
			<?php } else {?>
			<div class="logo"><a href="<?php echo home_url('/');?>"><span>renoshop</span>bee</a></div>
			<?php };?>
			<nav class="mainMenu__mainNav">
				<?php eShop_show_menu();?>
				<button class="mainMenu__button" id="menuExpander"><i class="fas fa-bars"></i></button>
			</nav><!-- .mainNav -->
			<div class="mainMenu__side">
			<?php
				if(is_user_logged_in() && !is_cart()) {
					$eShop_cart_counter = wp_kses_data(WC()->cart->get_cart_contents_count());
			?>
				<a href="<?php echo esc_url(wc_get_cart_url());?>" class="cart-icon"><i class="fas fa-shopping-cart"></i>
			<?php 	if($eShop_cart_counter > 0) {
						echo '<span id="eShop_cart_content">'.$eShop_cart_counter.'</span>';
					} else {
						echo '<span id="eShop_cart_content" class="d-none">'.$eShop_cart_counter.'</span>';
					};?>
				</a>
			<?php
				} elseif(is_user_logged_in() && is_cart()){
					//nothing
				}else {
			?>
				<a href="<?php echo wp_login_url(); ?>" class="cart"><i class="fas fa-sign-in-alt"></i></a>
			<?php
				};
			?>
				<div class="search" id="siteSearchButton">
					<i class="fas fa-search"></i>
					<div class="siteSearch d-none" id="siteSearch">
						<div class="siteSearch__bg">
							<form method="GET"  action="<?php echo home_url('/');?>" class="siteSearch__form">
								<input placeholder="..." name="s" id="siteSearchInput" value="<?php get_search_query();?>">
								<button type="submit" id="siteSearchSubmit"><i class="fas fa-search"></i></button>
							</form>
						</div><!-- .search__bg -->
					</div><!-- .search -->
				</div>
				<button class="popUpMenu"><i class="fas fa-bars"></i></button>
			</div>
		</div><!-- .mainmenu -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">