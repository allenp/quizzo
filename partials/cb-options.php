<?php global $quiz_options, $quiz_id; ?>

<div>
	<a href="<?php echo home_url(); ?>/wp-admin/post.php?post=<?php echo esc_html( $quiz_id ); ?>&action=edit" class="button button-primary button-large" style="margin-top: 5px;">Go Back To Quiz</a>
</div>

<?php foreach( $quiz_options as $key => $value ): ?>

<p>
	<label for="option<?php echo $key; ?>">Option <?php echo $key; ?></label><br/>
	<input
		type="text"
		class="quizzo_textfield"
		name="quizzo_option_<?php echo $key; ?>"
		value="<?php echo esc_html( $value ); ?>"
	/>
</p>

<?php endforeach; ?>

<input type="hidden" name="quizzo_quiz_id" value="<?php echo esc_html( $quiz_id ); ?>"/>
