<?php

namespace Quizzo;

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

/**
 * Dashboard Callback Method
 *
 * @return void
 */
function quizzo_dashboard_cb() {
	// Get Template part
	load_template( dirname( __DIR__ ) . '/partials/cb-dashboard.php' );
}
