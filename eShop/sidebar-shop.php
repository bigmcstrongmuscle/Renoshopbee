<?php
if(!defined('ABSPATH')){
	exit; //if accessed directly
};?>

<aside id="secondary" class="widget-area leftSidebar col-lg-2 d-none d-lg-block order-1"><!-- .leftSidebar-off -->
	<?php
		if ( function_exists('dynamic_sidebar') )
			dynamic_sidebar('sidebar-shop');
	?>
	<?php //get_sidebar('sidebar-shop'); ?>
</aside><!-- .leftSidebar -->