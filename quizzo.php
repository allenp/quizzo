<?php
/**
 * Plugin Name: Quizzo
 * Plugin URI:  https://github.com/chigozieorunta/quizzo
 * Description: A simple plugin to help you set up Quizzes behind a PayWall.
 * Version:     1.0.0
 * Author:      Chigozie Orunta
 * Author URI:  https://chigozieorunta.com
 * License:     GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: quizzo
 * Domain Path: /languages
 */

namespace Quizzo;

if ( ! defined( 'WPINC' ) ) {
	die;
}

// Define constants
define( 'PLUGIN_SLUG', 'quizzo' );
define( 'PLUGIN_ROLE', 'manage_options' );
define( 'PLUGIN_DOMAIN', 'quizzo' );

// Get all files
foreach( glob( __DIR__ . "/inc/*.php" ) as $file ) {
	require $file;
}

// Applied hooks
add_action( 'init', __NAMESPACE__ . '\register_quizzo_cpts' );
add_action( 'admin_menu', __NAMESPACE__ . '\register_quizzo_menu', 9 );
add_action( 'add_meta_boxes', __NAMESPACE__ . '\register_quizzo_meta_boxes' );
add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\register_quizzo_css' );

/**
 * Enqueue Quizzo Plugin CSS file
 *
 * @return void
 */
function register_quizzo_css() {
	wp_enqueue_style(
		PLUGIN_SLUG,
		plugin_dir_url( __FILE__ ) . './assets/css/dist/quizzo.css'
	);
}


