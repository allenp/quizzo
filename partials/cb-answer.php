<?php global $quiz_options, $quiz_answer; ?>

<select class="widefat" name="quizzo_answer">
	<?php foreach ( $quiz_options as $key => $value ) : ?>
		<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $quiz_answer, esc_attr( $key ) ); ?>>
			<?php echo esc_html( $value ); ?>
		</option>
	<?php endforeach; ?>
</select>
