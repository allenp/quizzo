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
		__( 'Questions', PLUGIN_DOMAIN ),
		__NAMESPACE__ . '\quiz_metabox_questions_cb',
		'quiz'
	);

	add_meta_box(
		'quizzo_scores',
		__( 'Scores', PLUGIN_DOMAIN ),
		__NAMESPACE__ . '\quiz_metabox_scores_cb',
		'score'
	);
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

	// Loop through scores meta data
	foreach( $scores_metadata as $key => $value ) {
		echo $key . ' : ' . $value[0] . '<br/>';
	}
}
