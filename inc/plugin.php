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

/**
 * Flush Rewrite Cache
 *
 * @return void
 */
function quizzo_rewrite_flush() {
	// Register CPTs
    register_quizzo_cpts();

	// Flush Rewrite Cache
    flush_rewrite_rules();
}

/**
 * Publish Question Callback Method
 *
 * @param int $post_id
 * @return void
 */
function register_quizzo_save_meta_box( $post_id ) {
    // Check if user has permissions to save data.
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    // Check if not an autosave.
    if ( wp_is_post_autosave( $post_id ) ) {
        return;
    }

    // Check if not a revision.
    if ( wp_is_post_revision( $post_id ) ) {
        return;
    }

    // Update Quiz
    update_post_meta( $post_id, 'quizzo_quiz_id', $_POST['quizzo_quiz_id'] );

    // Update Options
    update_post_meta( $post_id, 'quizzo_option_1', $_POST['quizzo_option_1'] );
    update_post_meta( $post_id, 'quizzo_option_2', $_POST['quizzo_option_2'] );
    update_post_meta( $post_id, 'quizzo_option_3', $_POST['quizzo_option_3'] );
    update_post_meta( $post_id, 'quizzo_option_4', $_POST['quizzo_option_4'] );

    // Update Answer
    update_post_meta( $post_id, 'quizzo_answer', $_POST['quizzo_answer'] );
}
