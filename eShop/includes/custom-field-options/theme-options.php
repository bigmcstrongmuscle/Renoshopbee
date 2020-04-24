<?php
if(!defined('ABSPATH')){
	exit; //if accessed directly
};

use Carbon_Fields\Container;
use Carbon_Fields\Field;

// Default options page
$basic_options_container = Container::make( 'theme_options', __( 'Theme Options' ) )
	->set_icon( 'dashicons-carrot' )
    ->add_tab( __( 'Header' ), array(
         Field::make( 'image', 'eshop_header_logo', 'Logo' )
		  ->set_width( 100 )
    ) )
    ->add_tab( __( 'contacts' ), array(
		 Field::make( 'text', 'eshop_contacts_address', 'Address in real world' ),
         Field::make( 'text', 'eshop_contacts_phone', 'Phone number' ),
		 Field::make( 'text', 'eshop_contacts_mail', 'Email address' )
    ) );

// Add second options page under 'Basic Options'
/*Container::make( 'theme_options', __( 'Social Links' ) )
    ->set_page_parent( $basic_options_container ) // reference to a top level container
    ->add_fields( array(
        Field::make( 'text', 'crb_facebook_link', __( 'Facebook Link' ) ),
        Field::make( 'text', 'crb_twitter_link', __( 'Twitter Link' ) ),
    ) );*/

// 404 Options
Container::make( 'theme_options', __( 'Page 404' ) )
    ->set_page_parent( $basic_options_container ) // identificator of the "Appearance" admin section
    ->add_fields( array(
        Field::make( 'text', 'eshop_404_response', __( 'Сообщение' ) ),
		Field::make( 'radio', 'eshop_404_radio', __( 'Включить/выключить виджет' ) )
			->set_options( array(
				 'off' => __('Выключен'),
				 'on' => __('Включен')
			))
    ) );