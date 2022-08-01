<?php

namespace Quizzo;

/**
 * Quizzo Shortcode
 *
 * @param array $atts
 * @return void
 */
function quizzo_shortcode( $atts ) {
	//Global questions
	global $questions;

	// Get All Questions
	$questions = get_posts( array(
		'post_type'      => 'question',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'meta_key'       => 'quizzo_quiz_id',
		'meta_value'     => 8,
		'order'          => 'ASC'
	) );

	// Make sure user is logged in
	if ( ! is_user_logged_in() ) wp_loginout();

	// Get user
	global $current_user; wp_get_current_user();
	$user = $current_user->display_name ?: $current_user->user_login;

	if ( ! isset( $_POST['submit'] ) ) {
		//Output headers
		ob_start();

		// Get Template part
		load_template( dirname( __DIR__ ) . '/partials/cb-shortcode.php' );

		//Return clean headers
		return ob_get_clean();
	} else {
		// User score
		$score = 0;

		// Save Score
		$score_id = wp_insert_post( array(
			'post_type'   => 'score',
			'post_status' => 'publish',
			'post_title'  =>  $user . ' - ' . get_the_title(8)
		) );

		// Update Score information
		update_post_meta( $score_id, 'score_quiz', get_the_title(8) );
		update_post_meta( $score_id, 'score_author', $user );

		// Calculate Scores
		foreach ( $questions as $question ) {
			$answer = 'user_answer_' . $question->ID;
			update_post_meta( $score_id, 'score_user_answer_' . $question->ID, $_POST[$answer] );
			if ( get_post_meta( $question->ID, 'quizzo_answer', true ) === $_POST[$answer] ) {
				$score++;
				update_post_meta( $score_id, 'score_question_' . $question->ID, 'Passed' );
			} else {
				update_post_meta( $score_id, 'score_question_' . $question->ID, 'Failed' );
			}
		}

		update_post_meta( $score_id, 'score_value', $score );
		update_post_meta( $score_id, 'score_percentage', $score );

		// Display result
		echo '<h2 style="background: #fafafa; padding: 1em; margin-top: 0; text-align: center; color: rebeccapurple;">' . 'Congratulations! <span style="color: #000; ">You have scored a total value of </span>' . number_format( ( $score / count ( $questions ) ) * 100, 2) . '%' . '</h2>';
	}
}
