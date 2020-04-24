<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package eShop
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area leftSidebar col-lg-2 d-none d-lg-block"><!-- .leftSidebar-off -->
	<?php
		if ( function_exists('dynamic_sidebar') )
			dynamic_sidebar('sidebar-1');
	?>
	<?php //get_sidebar('sidebar-1'); ?>
</aside><!-- .leftSidebar -->