<div>
	<a href="<?php echo home_url(); ?>/wp-admin/post.php?post=<?php echo esc_html( $quiz_id ); ?>&action=edit" class="button button-primary button-large" style="margin-top: 5px;">Go Back To Quiz</a>
</div>

<p><label for="option1">Option 1</label><br/>
<input type="text" class="quizzo_textfield" name="quizzo_option_1" value="<?php echo esc_html( $quiz_option_1 ); ?>"></p>

<p><label for="option2">Option 2</label><br/>
<input type="text" class="quizzo_textfield" name="quizzo_option_2" value="<?php echo esc_html( $quiz_option_2 ); ?>"></p>

<p><label for="option3">Option 3</label><br/>
<input type="text" class="quizzo_textfield" name="quizzo_option_3" value="<?php echo esc_html( $quiz_option_3 ); ?>"></p>

<p><label for="option4">Option 4</label><br/>
<input type="text" class="quizzo_textfield" name="quizzo_option_4" value="<?php echo esc_html( $quiz_option_4 ); ?>"></p>

<input type="hidden" name="quizzo_quiz_id" value="<?php echo esc_html( $quiz_id ); ?>"/>
