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
	require_once( __DIR__ . '/widgets/accordion/accordion1.php' );
	require_once( __DIR__ . '/widgets/testimonial-widget/testimonial.php' );

	$widgets_manager->register( new \Widget_1() );
	$widgets_manager->register( new \Widget_2() );
	$widgets_manager->register( new \Widget_3() );
	$widgets_manager->register( new \Widget_4() );
	$widgets_manager->register( new \Accordion1() );
	$widgets_manager->register( new \Testimonial_Widget() );

}
add_action( 'elementor/widgets/register', 'register_new_widgets' );


function register_slick_scripts() {
	// wp_enqueue_script( 'slick', plugins_url( '/assets/src/js/slick.js', __FILE__ ), [ 'jquery' ] );
	wp_enqueue_script( 'slick.min', plugins_url( '/assets/src/js/slick.min.js', __FILE__ ), [ 'jquery' ] );
	wp_enqueue_style( 'main', plugins_url( '/assets/src/css/main.scss', __FILE__ ) );
	wp_enqueue_style( 'slick', plugins_url( '/assets/src/css/slick.css', __FILE__ ) );
	wp_enqueue_style( 'slick', plugins_url( '/assets/src/css/slick-theme.css', __FILE__ ) );
	// wp_enqueue_style( 'slick-theme', plugins_url( '/assets/src/css/slick-theme.css', __FILE__ ) );
	// wp_enqueue_style( 'slick-theme', plugins_url( '/assets/src/css/slick-theme.scss', __FILE__ ) );


}

add_action( 'wp_enqueue_scripts', 'register_slick_scripts' );

