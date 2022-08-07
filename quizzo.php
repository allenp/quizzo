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

// Plugin hooks
add_action( 'init', __NAMESPACE__ . '\register_quizzo_cpts' );
add_action( 'admin_menu', __NAMESPACE__ . '\register_quizzo_menu', 9 );
add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\register_quizzo_css' );
add_action( 'add_meta_boxes', __NAMESPACE__ . '\register_quizzo_meta_boxes' );
add_action( 'publish_question', __NAMESPACE__ . '\register_quizzo_save_meta_box' );

add_filter( 'manage_quiz_posts_columns', __NAMESPACE__ . '\register_quiz_columns' );
add_action( 'manage_quiz_posts_custom_column' , __NAMESPACE__ . '\register_quiz_questions_column', 10, 2 );

// Plugin shortcode
add_shortcode( 'quizzo', __NAMESPACE__ . '\quizzo_shortcode' );

// Rewrite flush
register_activation_hook( __FILE__, __NAMESPACE__ . '\quizzo_rewrite_flush' );
