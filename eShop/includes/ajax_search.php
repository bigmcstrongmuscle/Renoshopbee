<?php
if(!defined('ABSPATH')){
	exit; //if accessed directly
};

add_action( 'wp_ajax_eShop_search', 'eShop_search_answer' );
add_action('wp_ajax_nopriv_eShop_search', 'eShop_search_answer');

function eShop_search_answer () {

	if(!wp_verify_nonce($_POST['nonce'], 'localize_nonce')) {
		wp_die('Левые полключения');
	};

	$arg = array(
		'post_type' => array('post', 'product'),
		'post_status' => 'publish',
		's' => esc_sql($_POST['s'])
	);
	
	$query = new WP_Query($arg);
	$result = array();
	foreach($query->posts as $key => $content) {
		if(strlen($content->post_title) > 30) {
			$title = mb_substr($content->post_title, 0, 30).'...';
		} else {
			$title = $content->post_title;
		};
		$result[] = array($content->guid, $title);
	};
	wp_send_json($result);
	wp_reset_query();
	wp_die();
};