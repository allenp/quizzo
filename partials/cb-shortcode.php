<?php

// Options
$question_options = array( 1 => 'A', 2 => 'B', 3 => 'C', 4 => 'D');

// If not set, start with first question
$question_counter = $_SESSION['question_counter'] ?: $_SESSION['questions_ids'][0];

?>

<section class="quizzo_shortcode" id="<?php echo $question_counter; ?>">
	<div>
		<div id="status">You haven't picked an answer yet...</div>
		<div id="question">
			<h2><?php echo esc_html( get_the_title( $question_counter ) ); ?></h2>
			<ol>
				<?php foreach ( $question_options as $key => $value ) : ?>
				<li>
					<input type="radio" name="user_answer_<?php echo $question_counter; ?>" value="<?php echo $key; ?>">
					<p><span><?php echo ucwords( esc_html( $value ) ); ?>.</span><?php echo esc_html( get_post_meta( $question_counter, 'quizzo_option_' . $key, true ) ); ?></p>
				</li>
				<?php endforeach; ?>
			</ol>
			<span id="overlay"></span>
		</div>
		<button type="button" id="answer">Submit Answer</button>
	</div>
</section>
