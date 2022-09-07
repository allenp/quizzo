<?php

namespace Quizzo;

/**
 * Register Meta boxes for Quizzo
 *
 * @return void
 */
function register_quizzo_meta_boxes() {
    /*add_meta_box(
        'quizzo_quiz_id',
        __( 'Quiz', PLUGIN_DOMAIN ),
        'quiz_metabox_quiz_id',
        'question'
    );*/

    add_meta_box(
        'quizzo_options',
        __( 'Options', PLUGIN_DOMAIN ),
        'quiz_metabox_options',
        'question'
    );

    add_meta_box(
        'quizzo_answer',
        __( 'Answer', PLUGIN_DOMAIN ),
        'quiz_metabox_answer',
        'question'
    );

    add_meta_box(
        'quizzo_questions',
        __( 'Questions', PLUGIN_DOMAIN ),
        'quiz_metabox_questions',
        'quiz'
    );

    add_meta_box(
        'quizzo_scores',
        __( 'Scores', PLUGIN_DOMAIN ),
        'quiz_metabox_scores',
        'score'
    );
}
