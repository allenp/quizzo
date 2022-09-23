<?php

namespace Quizzo;

/**
 * Save User's Answer
 *
 * @return void
 */
function save_user_answer() {
	//Get IDs
	$answer_id   = $_POST['answer_id'];
	$question_id = $_POST['question_id'];

	//Let us see if the answer is correct.
	$answer  = get_post_meta( $question_id, 'quizzo_answer', true );
	$compare = $answer === $answer_id ? 1 : 0;

	//Get next question
	if ( isset( $_SESSION['questions_ids'] ) ) {
		$index = array_search( $question_id, $_SESSION['questions_ids'] );

		//Check if its the last index, if not, update.
		if ( $index < count ( $_SESSION['questions_ids'] ) ) {
			$_SESSION['question_counter'] = $index + 1;
		}
	}

	//Prepare result
	$result['status']   = $compare;
	$result['question'] = $answer;

	//Encode and send
	$result = json_encode($result);
	echo $result;

	die();
}
