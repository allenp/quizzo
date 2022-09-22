<?php

namespace Quizzo;

/**
 * Quizzo Shortcode
 *
 * @param array $atts
 * @return void
 */
function quizzo_shortcode( $atts ) {
	$id = $atts['id'] ?: 0;

	// Get All Questions
	$questions = get_posts( array(
		'post_type'      => 'question',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'meta_key'       => 'quizzo_quiz_id',
		'meta_value'     => $id,
		'order'          => 'ASC'
	) );

	// Get quesetion IDs
	$questions_ids = wp_list_pluck( $questions, 'ID' );

	// Set session for counter
	if ( ! isset( $_SESSION['questions_ids'] ) ) {
		$_SESSION['questions_ids'] = $questions_ids;
		$_SESSION['question_counter'] = '';
	}

	// Make sure user is logged in
	if ( is_user_logged_in() ) {
		// Get user
		global $current_user; wp_get_current_user();
		$user = $current_user->display_name ?: $current_user->user_login;

		//Output headers
		ob_start();

		// Get Template part
		load_template( dirname( __DIR__ ) . '/partials/cb-shortcode.php' );

		//Return clean headers
		return ob_get_clean();
	}
}
