<?php
if(!defined('ABSPATH')){
	exit; //if accessed directly
};

/**
 * Enqueue scripts .
 */
function eshop_enqueue_scripts() {
	//deregister old jquery
	//wp_deregister_script( 'jquery' );
	//register and enqueue new one
	//wp_register_script('jquery', get_template_directory_uri() . '/assets/js/jquery331.js', array(), '3.3.1', true);
	//wp_enqueue_script('jquery', get_template_directory_uri() . '/assets/js/jquery331.js', array(), '3.3.1', true);
	
	//deregister flex slider cuz i use slick slider
	//wp_deregister('flexskider');

	
	wp_enqueue_script('popper', get_template_directory_uri() . '/assets/js/popper1147.js', array('jquery'), '1.14.7', true);
	wp_enqueue_script( 'eshop-bootstrap.js', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery', 'popper'), '', true );
	wp_enqueue_script( 'eshop-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'eshop-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array('jquery'), '20151215', true );
	//wp_enqueue_script( 'eshop-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array('jquery'), '', true );
	//wp_enqueue_script( 'eshop-multirange', get_template_directory_uri() . '/assets/js/multirange.js', array(), '', true );
	//wp_enqueue_script( 'eshop-nouislider.js', get_template_directory_uri() . '/assets/js/nouislider.min.js', array('jquery'), '', true );
	wp_enqueue_script( 'eshop-slick.js', get_template_directory_uri() . '/assets/js/slick.min.js', array('jquery'), '', true );
	wp_enqueue_script( 'echop_ajax_add_to_cart', get_template_directory_uri() . '/assets/js/eshop_ajax_add_to_cart.js', array(), '', true);
	
	wp_enqueue_script( 'eshop_ajax_search', get_template_directory_uri() . '/assets/js/eshop_ajax_search.js', array('jquery'), '', true );
	wp_localize_script('eshop_ajax_search', 'eshop_ajax_localize', array(
		'url' => admin_url('admin-ajax.php'),
		'nonce' => wp_create_nonce('localize_nonce')
	));
	wp_enqueue_script( 'eshop-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery', 'eshop_ajax_search', 'eshop-slick.js'), '', true );//, 'eshop-nouislider.js'

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	};
};
add_action( 'wp_enqueue_scripts', 'eshop_enqueue_scripts' );

/**
 * Enqueue styles.
 */
function eshop_enqueue_styles() {
	//wp_enqueue_style( 'eshop_bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '1', 'all');
	wp_enqueue_style( 'eshop_fonts_roboto', 'https://fonts.googleapis.com/css?family=Roboto&display=swap', array(), '1', 'all');
	wp_enqueue_style( 'eshop_fonts_poppins', 'https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap&subset=latin-ext', array(), '1', 'all');
	//wp_enqueue_style( 'eshop-fontawesome', get_template_directory_uri() . '/assets/css/fontawesome.min.css', array(), '1', 'all');
	//wp_enqueue_style( 'eshop-fontawesome-all', get_template_directory_uri() . '/assets/css/all.min.css', array(), '1', 'all');
	//wp_enqueue_style( 'eshop-multirange', get_template_directory_uri() . '/assets/css/multirange.css');
	//wp_enqueue_style( 'eshop-nouislider', get_template_directory_uri() . '/assets/css/nouislider.min.css', array(), '1', 'all');
	//wp_enqueue_style( 'eshop-slick', get_template_directory_uri() . '/assets/css/slick.css', array(), '1', 'all');
	//wp_enqueue_style( 'eshop-slick-theme', get_template_directory_uri() . '/assets/css/slick-theme.css', array(), '1', 'all');
	wp_enqueue_style( 'concatted-styles', get_template_directory_uri() . '/assets/css/concatted-styles.css', array(), '1', 'all');
	wp_enqueue_style( 'eshop-style', get_stylesheet_uri(), array('eshop_fonts_poppins', 'eshop_fonts_roboto', 'concatted-styles'), '1', 'all');//, 'eshop-nouislider'
};
add_action( 'wp_enqueue_scripts', 'eshop_enqueue_styles' );