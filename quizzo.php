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

if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PLUGIN_SLUG', 'quizzo' );
define( 'PLUGIN_ROLE', 'manage_options' );
define( 'PLUGIN_DOMAIN', 'quizzo' );

/**
 * WP Action Hook
 * admin_enqueue_scripts | register_quizzo_css
 */
add_action( 'admin_enqueue_scripts', 'register_quizzo_css' );

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
