<?php
/**
 * Plugin Name: Quizzo
 * Plugin URI:  https://github.com/chigozieorunta/quizzo
 * Description: A simple plugin to help you set up Quizzes behind a Woocommerce (WC) PayWall.
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
add_action( 'init', 'register_quizzo_product_type' );
add_filter( 'product_type_selector', 'add_quizzo_product_type' );
add_action( 'woocommerce_quizzo_add_to_cart', 'add_to_cart_button' );

add_action( 'init', __NAMESPACE__ . '\register_quizzo_cpts' );
add_action( 'init', __NAMESPACE__ . '\register_user_session' );

add_action( 'admin_menu', __NAMESPACE__ . '\register_quizzo_menu', 9 );
add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\register_quizzo_admin_css' );
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\register_quizzo_shortcode_css' );

add_action( 'add_meta_boxes', __NAMESPACE__ . '\register_quizzo_meta_boxes' );
add_action( 'publish_quiz', __NAMESPACE__ . '\register_quizzo_quiz_save_meta_box' );
add_action( 'publish_question', __NAMESPACE__ . '\register_quizzo_question_save_meta_box' );

add_filter( 'manage_quiz_posts_columns', __NAMESPACE__ . '\register_quiz_columns' );
add_action( 'manage_quiz_posts_custom_column' , __NAMESPACE__ . '\register_quiz_column_data', 10, 2 );
add_filter( 'manage_score_posts_columns', __NAMESPACE__ . '\register_score_columns' );
add_action( 'manage_score_posts_custom_column' , __NAMESPACE__ . '\register_score_column_data', 10, 2 );
add_filter( 'manage_question_posts_columns', __NAMESPACE__ . '\register_question_columns' );
add_action( 'manage_question_posts_custom_column' , __NAMESPACE__ . '\register_question_column_data', 10, 2 );

add_action( 'wp_ajax_nopriv_save_user_answer', __NAMESPACE__ . '\save_user_answer' );
add_action( 'wp_ajax_save_user_answer', __NAMESPACE__ . '\save_user_answer' );

// Plugin shortcode
add_shortcode( 'quizzo', __NAMESPACE__ . '\quizzo_shortcode' );

// Rewrite flush
register_activation_hook( __FILE__, __NAMESPACE__ . '\quizzo_rewrite_flush' );
