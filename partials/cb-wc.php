<?php global $quiz_wc_options, $quiz_wc; ?>

<select class="widefat" name="quizzo_wc" style="margin-top: 5px;">
	<?php foreach ( $quiz_wc_options as $key => $value ) : ?>
		<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $quiz_wc, esc_attr( $key ) ); ?>>
			<?php echo esc_html( $value ); ?>
		</option>
	<?php endforeach; ?>
</select>
