<?php global $questions; $question_options = array( 1, 2, 3, 4 ); ?>

<form method="POST" action="./">
    <ul>
        <?php foreach ( $questions as $question ) : ?>
        <li>
            <h2><?php echo esc_html( $question->post_title ); ?></h2>
            <ol>
                <?php foreach ( $question_options as $key => $value ) : ?>
                <li>
                    <input type="radio" name="user_answer_<?php echo $question->ID; ?>" value="<?php echo $value; ?>">
                    <?php echo esc_html( get_post_meta( $question->ID, 'quizzo_option_' . $value, true ) ); ?>
                </li>
                <?php endforeach; ?>
            </ol>
        </li>
        <?php endforeach; ?>
    </ul>
    <button type="submit" name="submit" class="quizzo_submit">Finish Test</button>
</form>
