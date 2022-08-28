<form method="POST" action="./">
	<ul class="quizzo_shortcode">
	<?php foreach ( $questions as $question ) : ?>
		<li>
			<h2><?php echo esc_html( $question->post_title ); ?></h2>
			<ol>
				<li>
					<input type="radio" name="user_answer_<?php echo $question->ID; ?>" value="1">
					<?php echo esc_html( get_post_meta( $question->ID, 'quizzo_option_1', true ) ); ?>
				</li>
				<li>
					<input type="radio" name="user_answer_<?php echo $question->ID; ?>" value="2">
					<?php echo esc_html( get_post_meta( $question->ID, 'quizzo_option_2', true ) ); ?>
				</li>
				<li>
					<input type="radio" name="user_answer_<?php echo $question->ID; ?>" value="3">
					<?php echo esc_html( get_post_meta( $question->ID, 'quizzo_option_3', true ) ); ?>
				</li>
				<li>
					<input type="radio" name="user_answer_<?php echo $question->ID; ?>" value="4">
					<?php echo esc_html( get_post_meta( $question->ID, 'quizzo_option_4', true ) ); ?>
				</li>
			</ol>
		</li>
	<?php endforeach; ?>
	</ul>
	<button type="submit" name="submit" class="quizzo_submit">Finish Test</button>
</form>
