<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package eShop
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer footer">
		<div class="social">
			<p class="social__text">
				We’re confident we’ve provided all the best for you. Stay connect with us
			</p>
			<div class="social__links">
				<?php wp_nav_menu( array('container' => '', 'theme_location' => 'social'));?>
			</div>
		</div><!-- .social -->
		
		<div class="botMenus">
			<div class="information">
				<p class="information__text">information</p>
				<?php wp_nav_menu( array('container' => '', 'theme_location' => 'info'));?>
			</div><!-- .information -->
			<div class="account">
				<p class="account__text">My Account</p>
				<?php wp_nav_menu( array('container' => '', 'theme_location' => 'acc'));?>
			</div><!-- .account -->
			
			<div class="help">
				<p class="help__text">help</p>
				<?php wp_nav_menu( array('container' => '', 'theme_location' => 'help'));?>
			</div><!-- .help -->
			
			<address class="botAddress">
				<p class="botAddress__title">contact info</p>
				<p><i class="fas fa-globe"></i><?php echo esc_html(carbon_get_theme_option('eshop_contacts_address'));?></p>
				<p><i class="fas fa-phone-alt"></i><?php echo esc_html(carbon_get_theme_option('eshop_contacts_phone'));?></p>
				<p><i class="fas fa-envelope"></i><a href="mailto:<?php echo esc_html(carbon_get_theme_option('eshop_contacts_mail'));?>"><?php echo esc_html(carbon_get_theme_option('eshop_contacts_mail'));?></a></p>
			</address><!-- .botAddress -->
		</div><!-- .botmenus -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
