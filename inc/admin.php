<?php

namespace Quizzo;

/**
 * Quiz Admin Callback Method
 *
 * @param array $columns
 * @return void
 */
function register_quiz_columns( $columns ) {
	unset( $columns['date'] );

	// Get WooCommerce currency symbol if any
	$symbol = '';
	if ( class_exists( 'WooCommerce' ) ) {
		$symbol = ' (' . get_woocommerce_currency_symbol() . ') ';
	}

	$columns['shortcode'] = __( 'Shortcode', PLUGIN_DOMAIN );
	$columns['paywall']   = __( 'WC Paywall', PLUGIN_DOMAIN );
	$columns['price']     = __( 'Price' . $symbol, PLUGIN_DOMAIN );
	$columns['questions'] = __( 'Questions', PLUGIN_DOMAIN );
	$columns['date']      = __( 'Date', PLUGIN_DOMAIN );

	return $columns;
}

/**
 * Score Admin Callback Method
 *
 * @param array $columns
 * @return void
 */
function register_score_columns( $columns ) {
	unset( $columns['date'] );

	$columns['quiz']       = __( 'Quiz', PLUGIN_DOMAIN );
	$columns['score']      = __( 'Score', PLUGIN_DOMAIN );
	$columns['total']      = __( 'Total', PLUGIN_DOMAIN );
	$columns['percentage'] = __( 'Percentage (%)', PLUGIN_DOMAIN );
	$columns['date']       = __( 'Date', PLUGIN_DOMAIN );

	return $columns;
}

/**
 * Question Admin Callback Method
 *
 * @param array $columns
 * @return void
 */
function register_question_columns( $columns ) {
	unset( $columns['date'] );

	$columns['quiz']   = __( 'Quiz', PLUGIN_DOMAIN );
	$columns['answer'] = __( 'Answer', PLUGIN_DOMAIN );
	$columns['passed'] = __( 'People Passed (%)', PLUGIN_DOMAIN );
	$columns['date']   = __( 'Date', PLUGIN_DOMAIN );

	return $columns;
}

/**
 * Quiz Action Callback Method
 *
 * @param array $column
 * @param int $post_id
 * @return void
 */
function register_quiz_column_data( $column, $post_id ) {
	switch ( $column ) {
		case 'questions' :
			echo count( get_posts( array(
						'post_type'      => 'question',
						'post_status'    => 'publish',
						'posts_per_page' => -1,
						'meta_key'       => 'quizzo_quiz_id',
						'meta_value'     => $post_id,
			) ) );
			break;

		case 'shortcode':
			echo '[quizzo id=' . $post_id . ']';
			break;

		case 'paywall':
			echo esc_html( get_post_meta( $post_id, 'quizzo_wc', true ) ? 'Yes' : 'No' );
			break;

		case 'price':
			echo esc_html( get_post_meta( $post_id, 'quizzo_price', true ) ?: 0 );
			break;
	}
}

/**
 * Score Action Callback Method
 *
 * @param array $column
 * @param int $post_id
 * @return void
 */
function register_score_column_data( $column, $post_id ) {
	// Get column data
	$quiz  = get_the_title( get_post_meta( $post_id, 'score_quiz_id', true ) ) ?: '';
	$score = get_post_meta( $post_id, 'score_total', true ) ?: 0;
	$total = get_post_meta( $post_id, 'score_total_questions', true ) ?: 0;

	// Calculate percentage
	$percentage = number_format( ($score / $total) * 100, 0 );

	switch ( $column ) {
		case 'quiz' :
			echo esc_html( $quiz );
			break;

		case 'score' :
			echo esc_html( $score );
			break;

		case 'total' :
			echo esc_html( $total );
			break;

		case 'percentage' :
			echo esc_html( $percentage );
			break;
	}
}

/**
 * Question Action Callback Method
 *
 * @param array $column
 * @param int $post_id
 * @return void
 */
function register_question_column_data( $column, $post_id ) {
	// Get column data
	$quiz   = get_the_title( get_post_meta( $post_id, 'quizzo_quiz_id', true ) ?: '' );
	$answer = get_post_meta( $post_id, 'quizzo_answer', true ) ?: '';

	// Answer array
	$answer_array = array(1 => 'A', 2 => 'B', 3 => 'C', 4 => 'D');

	switch ( $column ) {
		case 'quiz' :
			echo esc_html( $quiz );
			break;

		case 'answer' :
			echo esc_html( $answer_array[$answer] );
			break;

		case 'passed' :
			$failed = get_posts( array(
				'numberposts' => -1,
				'post_type'   => 'score',
				'meta_key'    => 'score_question_' . $post_id,
				'meta_value'  => '0'
			) );

			$passed = get_posts( array(
				'numberposts' => -1,
				'post_type'   => 'score',
				'meta_key'    => 'score_question_' . $post_id,
				'meta_value'  => '1'
			) );

			$total = count( $passed ) + count( $failed );
			$percentage = $total > 0 ? number_format( ( count( $passed ) / $total ) * 100, 0 ) : 'N/A';
			echo $percentage;
			break;
	}
}
