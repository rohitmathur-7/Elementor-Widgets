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

function register_new_widgets( $widgets_manager ) {

	require_once( __DIR__ . '/widgets/widget1/widget1.php' );
	require_once( __DIR__ . '/widgets/widget2/widget2.php' );
	require_once( __DIR__ . '/widgets/widget3/widget3.php' );

	$widgets_manager->register( new \Widget_1() );
	$widgets_manager->register( new \Widget_2() );
	$widgets_manager->register( new \Widget_3 );

}
add_action( 'elementor/widgets/register', 'register_new_widgets' );


// function register_widgets_scripts() {
// 	wp_register_script( 'widget-script-1', plugins_url( '/assets/build/js/bundle.min.js', __FILE__ ), [ 'elementor-frontend' ], false, true );

// 	wp_register_style( 'widget-style-1', plugins_url( '/assets/src/css/widget-style-1.css', __FILE__ ) );
// }

// add_action( 'wp_enqueue_scripts', 'register_widgets_scripts' );

