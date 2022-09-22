<?php

namespace Quizzo;

/**
 * Register Meta boxes for Quizzo
 *
 * @return void
 */
function register_quizzo_meta_boxes() {
	/*add_meta_box(
		'quizzo_quiz_id',
		__( 'Quiz', PLUGIN_DOMAIN ),
		'quiz_metabox_quiz_id',
		'question'
	);*/

	add_meta_box(
		'quizzo_options',
		__( 'Options', PLUGIN_DOMAIN ),
		__NAMESPACE__ . '\quiz_metabox_options_cb',
		'question'
	);

	add_meta_box(
		'quizzo_answer',
		__( 'Answer', PLUGIN_DOMAIN ),
		__NAMESPACE__ . '\quiz_metabox_answer_cb',
		'question'
	);

	add_meta_box(
		'quizzo_questions',
		__( 'Quiz Questions', PLUGIN_DOMAIN ),
		__NAMESPACE__ . '\quiz_metabox_questions_cb',
		'quiz'
	);

	add_meta_box(
		'quizzo_shortcode',
		__( 'Quiz Shortcode', PLUGIN_DOMAIN ),
		__NAMESPACE__ . '\quiz_metabox_shortcode_cb',
		'quiz',
		'side'
	);

	add_meta_box(
		'quizzo_scores',
		__( 'User\'s Quiz Performance', PLUGIN_DOMAIN ),
		__NAMESPACE__ . '\quiz_metabox_scores_cb',
		'score'
	);
}

/**
 * Shortcode Callback Method
 *
 * @param object $post
 * @return void
 */
function quiz_metabox_shortcode_cb( $post ) {
	echo '<h2 style="padding-left: 0; padding-bottom: 0;">[quizzo id=' . $post->ID. ']</h2>';
}

/**
 * Answer Callback Method
 *
 * @param object $post
 * @return void
 */
function quiz_metabox_answer_cb( $post ) {
	// CB global options
	global $answers, $quiz_answer;

	// Get ID of field
	$quiz_answer = get_post_meta( $post->ID, 'quizzo_answer', true );

	// Get All Quiz titles...
	$answers = array( 1 => 'A', 2 => 'B', 3 => 'C', 4 => 'D' );

	// Get Template part
	load_template( dirname( __DIR__ ) . '/partials/cb-answer.php' );
}

/**
 * Options Callback Method
 *
 * @param object $post
 * @return void
 */
function quiz_metabox_options_cb( $post ) {
	// CB global options
	global $quiz_options, $quiz_id;

	// Get Options for answers
	$quiz_options[1] = get_post_meta( $post->ID, 'quizzo_option_1', true );
	$quiz_options[2] = get_post_meta( $post->ID, 'quizzo_option_2', true );
	$quiz_options[3] = get_post_meta( $post->ID, 'quizzo_option_3', true );
	$quiz_options[4] = get_post_meta( $post->ID, 'quizzo_option_4', true );

	// Get Quiz ID
	$quiz_id = $_GET['quiz_id'] ?: get_post_meta( $post->ID, 'quizzo_quiz_id', true );

	// Get Template part
	load_template( dirname( __DIR__ ) . '/partials/cb-options.php' );
}

/**
 * Questions Callback Method
 *
 * @param object $post
 * @return void
 */
function quiz_metabox_questions_cb( $post ) {
	// Get All Questions
	global $questions;
	$questions = get_posts( array(
		'post_type'      => 'question',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'meta_key'       => 'quizzo_quiz_id',
		'meta_value'     => $post->ID,
		'order'          => 'ASC'
	) );

	// Get Template part
	load_template( dirname( __DIR__ ) . '/partials/cb-questions.php' );
}

/**
 * Scores Callback Method
 *
 * @param object $post.
 * @return void
 */
function quiz_metabox_scores_cb( $post ) {
	// Get all scores
	$scores_metadata = get_post_meta( $post->ID );

	// Get User
	echo sprintf( '<h2><strong>User:</strong><br/>%1$s</h2>', esc_html( $scores_metadata['score_author'][0] ) );

	// Get Total Score
	echo sprintf( '<h2><strong>Total Score:</strong><br/>%1$s</h2>', esc_html( $scores_metadata['score_value'][0] ) );

	// Loop through scores meta data
	foreach ( $scores_metadata as $key => $value ) {
		//echo $key . ' : ' . $value[0];

		if ( strpos( $key, 'score_question_' ) !== false ) {
			// Get Question ID
			$question_id = explode( '_', $key )[2];

			// Reset array and variable values...
			$option_array = array(1, 2, 3, 4);
			$options = ''; $question = '';

			// Get Score Icon class
			$score_icon_class = $value[0] === 'Passed' ? 'dashicons dashicons-yes' : 'dashicons dashicons-no';

			// Get Score Color class
			$score_color_class = $value[0] === 'Passed' ? 'rebeccapurple' : 'red';

			// Get Question
			$question = sprintf(
				'<h2 style="color: %3$s">
					<strong>%1$s</strong><br/>
					(%4$s) <span class="%2$s"></span> -
					Question\'s Answer: %5$s | User\'s Answer: %6$s
				</h2>',
				esc_html( get_the_title( $question_id ) ),
				$score_icon_class,
				$score_color_class,
				$value[0],
				get_answer_option( get_post_meta( $question_id, 'quizzo_answer', true ) ),
				get_answer_option( get_post_meta( $post->ID, 'score_user_answer_' . $question_id, true ) )
			);

			// Get Options
			foreach ( $option_array as $key => $value ) {
				$options .= sprintf( '<li>%1$s</li>', esc_html( get_post_meta( $question_id, 'quizzo_option_' . $value, true ) ) );
			}

			// Return all questions
			echo $question . '<ol style="margin-top: 0; padding: 0;">' . $options . '</ol>';
		}
	}
}

function get_answer_option( $answer ) {
	// Define compare array
	$answer_compare = array(
		1 => 'A',
		2 => 'B',
		3 => 'C',
		4 => 'D'
	);

	// Safely typecast int
	$answer = intval( $answer );

	return $answer_compare[$answer];
}
