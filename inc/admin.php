<?php

namespace Quizzo;

function register_quiz_columns( $columns ) {
    unset( $columns['categories'] );
    unset( $columns['date'] );

    $columns['questions']  = __( 'Questions', PLUGIN_DOMAIN );
    $columns['categories'] = __( 'Categories', PLUGIN_DOMAIN );
    $columns['date']       = __( 'Date', PLUGIN_DOMAIN );

    return $columns;
}

function register_quiz_questions_column( $column, $post_id ) {
    switch ( $column ) {
        case 'questions' :
            echo count( get_posts( array(
                        'post_type'      => 'question',
                        'post_status'    => 'publish',
                        'posts_per_page' => -1,
                        'meta_key'       => 'quizzo_quiz_id',
                        'meta_value'     => $post_id,
            ) ) );
            break;
    }
}
