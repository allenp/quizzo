<?php global $scores_metadata; ?>

<p>
	<strong>User's Name:</strong><br/>
	<?php echo esc_html( $scores_metadata['score_user_name'][0] ); ?>
</p>

<p>
	<strong>User's E-mail:</strong><br/>
	<?php echo esc_html( $scores_metadata['score_user_email'][0] ); ?>
</p>

<p>
	<strong>User's Total Score:</strong><br/>
	<?php echo esc_html( $scores_metadata['score_total'][0] ?: 0 ); ?>
</p>

<p>
	<strong>Total Number of Questions:</strong><br/>
	<?php echo esc_html( $scores_metadata['score_total_questions'][0] ); ?>
</p>

<?php
//Loop through the questions...
foreach ( $scores_metadata as $key => $value ) {

	if ( strpos( $key, 'score_question_' ) !== false ) {
		// Get Question ID
		$question_id = explode( '_', $key )[2];

		// Reset array and variable values...
		$options      = '';
		$question     = '';
		$option_array = array(1 => 'A', 2 => 'B', 3 => 'C', 4 => 'D');

		// Get Question
		$question = sprintf(
			'<p style="color: %2$s">
				<strong>%1$s</strong><br/>
				<span class="%3$s"></span> Question\'s Answer: %4$s | User\'s Answer: %5$s
			</p>',
			esc_html( get_the_title( $question_id ) ),
			$value[0] ? 'rebeccapurple' : 'red',
			$value[0] ? 'dashicons dashicons-yes' : 'dashicons dashicons-no',
			$option_array[get_post_meta( $question_id, 'quizzo_answer', true )],
			$option_array[$scores_metadata['score_answer_' . $question_id][0]]
		);

		// Get Options
		foreach ( $option_array as $key => $value ) {
			$options .= sprintf( '<li>%1$s</li>', esc_html( get_post_meta( $question_id, 'quizzo_option_' . $key, true ) ) );
		}

		// Return all questions
		echo $question . '<ol style="margin-top: 0; margin-bottom: 20px; padding: 0;">' . $options . '</ol>';
	}
}
