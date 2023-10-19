<?php
/**
 * Plugin Name: Custom
 * Text Domain: elementor-list-widget
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! defined( 'BASE_DIR' ) ) {
	define( 'BASE_DIR', __FILE__ );
}

function register_currency_control( $controls_manager ) {

	require_once( __DIR__ . '/controls/currency.php' );

	$controls_manager->register( new \Elementor_Currency_Control() );

}
add_action( 'elementor/controls/register', 'register_currency_control' );

function register_random_number_dynamic_tag( $dynamic_tags_manager ) {

	require_once( __DIR__ . '/dynamic-tags/random-number-dynamic-tag.php' );

	$dynamic_tags_manager->register( new \Elementor_Dynamic_Tag_Random_Number );

}
add_action( 'elementor/dynamic_tags/register', 'register_random_number_dynamic_tag' );

function register_new_widgets( $widgets_manager ) {

	require_once( __DIR__ . '/widgets/widget1/widget1.php' );
	require_once( __DIR__ . '/widgets/widget2/widget2.php' );
	require_once( __DIR__ . '/widgets/widget3/widget3.php' );
	require_once( __DIR__ . '/widgets/widget4/widget4.php' );
	require_once( __DIR__ . '/widgets/testimonial-widget/testimonial.php' );

	$widgets_manager->register( new \Widget_1() );
	$widgets_manager->register( new \Widget_2() );
	$widgets_manager->register( new \Widget_3() );
	$widgets_manager->register( new \Widget_4() );
	$widgets_manager->register( new \Testimonial_Widget() );

}
add_action( 'elementor/widgets/register', 'register_new_widgets' );


// function register_widgets_scripts() {
// 	wp_register_script( 'widget-script-1', plugins_url( '/assets/build/js/bundle.min.js', __FILE__ ), [ 'elementor-frontend' ], false, true );

// 	wp_register_style( 'widget-style-1', plugins_url( '/assets/src/css/widget-style-1.css', __FILE__ ) );
// }

// add_action( 'wp_enqueue_scripts', 'register_widgets_scripts' );

