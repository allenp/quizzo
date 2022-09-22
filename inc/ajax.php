<?php

namespace Quizzo;

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
		$index = $index + 1;
		$_SESSION['question_counter'] = $_SESSION['questions_ids'][$index];
	}

	//Prepare result
	$result['status']   = $compare;
	$result['question'] = $answer;
	$result['index']    = $index;
	$result['counter']  = $_SESSION['question_counter'];

	//Encode and send
	$result = json_encode($result);
	echo $result;

	die();
}
