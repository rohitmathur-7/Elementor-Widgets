<?php
/**
 * Plugin Name: Custom
 * Text Domain: elementor-list-widget
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
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


function register_widgets_scripts() {
	// echo __FILE__ . '</br>';
	// echo plugins_url( '/assets/js/widget-script-1.js', __FILE__ );
	// $path = wp_normalize_path( '/assets/js/widget-script-1.js' );
	// echo $path;
	// echo WPMU_PLUGIN_DIR . '</br>';
	// $mu_plugin_dir = wp_normalize_path( WPMU_PLUGIN_DIR );
	// echo $mu_plugin_dir;
	wp_register_script( 'widget-script-1', plugins_url( '/assets/js/widget-script-1.js', __FILE__ ) );
	wp_register_style( 'widget-style-1', plugins_url( '/assets/css/widget-style-1.css', __FILE__ ) );
}

add_action( 'wp_enqueue_scripts', 'register_widgets_scripts' );
