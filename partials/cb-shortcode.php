<?php

// Options
$question_options = array(1 => 'A', 2 => 'B', 3 => 'C', 4 => 'D');

// If not set, start with first question
$question_counter = $_SESSION['question_counter'] ?: 0;
$question_id = $_SESSION['questions_ids'][$question_counter];

?>

<section class="quizzo_shortcode" id="<?php echo $question_id; ?>">
	<div>
		<div id="status">You haven't picked an answer yet...</div>

		<?php if ( $_SESSION['question_counter'] < count( $_SESSION['questions_ids'] ) ) : ?>

		<div id="question">
			<h2><?php echo esc_html( get_the_title( $question_id ) ); ?></h2>
			<ol>
				<?php foreach ( $question_options as $key => $value ) : ?>
				<li>
					<input type="radio" name="user_answer_<?php echo $question_id; ?>" value="<?php echo $key; ?>">
					<p><span><?php echo ucwords( esc_html( $value ) ); ?>.</span><?php echo esc_html( get_post_meta( $question_id, 'quizzo_option_' . $key, true ) ); ?></p>
				</li>
				<?php endforeach; ?>
			</ol>
			<span id="overlay"></span>
		</div>
		<button type="button" id="answer">Submit Answer</button>

		<?php else: ?>

		<h2>Quiz Completed!<br/>Your total score is 38%.</h2>
		<a href="<?php echo home_url(); ?>">Close Quiz Window</a>
		<?php $_SESSION['question_counter'] = ''; ?>

		<?php endif; ?>
	</div>
</section>
