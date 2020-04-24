<?php
if(!defined('ABSPATH')){
	exit; //if accessed directly
};
//main menu in header
register_nav_menu('header', 'Header menu');

function eShop_show_menu() {
	wp_nav_menu( array( 
		'container' => '',
		'theme_location' => 'header',
		'fallback_cb'     => '',)
	);
};

function eShop_show_fallback () {
	echo '<ul class="menu">';
	wp_list_pages( array('depth' => 1, 'title_li' => '' ));
	echo '</ul>';
};

//social links
register_nav_menu('social', 'Socilal links');

//FOOTER
//footer information menu
register_nav_menu('info', 'Footer information');

//footer account menu
register_nav_menu('acc', 'Footer account');

//footer help menu
register_nav_menu('help', 'Footer help');

//SIDEBAR
//sidebar categories menu
//register_nav_menu('categories', 'Categories');