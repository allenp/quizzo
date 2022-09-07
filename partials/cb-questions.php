<div>
	<a href="<?php echo home_url(); ?>/wp-admin/post-new.php?post_type=question&quiz_id=<?php echo $post->ID; ?>" class="button button-primary button-large" style="margin-top: 5px;">Add New Question</a>
</div>

<ul>
<?php global $questions; ?>
<?php foreach ( $questions as $question ) : ?>
	<li class="quizzo_admin_question">
		<a href="<?php echo home_url(); ?>/wp-admin/post.php?post=<?php echo $question->ID; ?>&action=edit">
			<h2>
				<strong><?php echo esc_html( $question->post_title ); ?></strong>
				<span class="dashicons dashicons-edit" style="float: right;"></span>
			</h2>
			<ol>
				<li><?php echo esc_html( get_post_meta( $question->ID, 'quizzo_option_1', true ) ); ?></li>
				<li><?php echo esc_html( get_post_meta( $question->ID, 'quizzo_option_2', true ) ); ?></li>
				<li><?php echo esc_html( get_post_meta( $question->ID, 'quizzo_option_3', true ) ); ?></li>
				<li><?php echo esc_html( get_post_meta( $question->ID, 'quizzo_option_4', true ) ); ?></li>
			</ol>
		</a>
	</li>
<?php endforeach; ?>
</ul>

<?php return ob_get_clean(); ?>
