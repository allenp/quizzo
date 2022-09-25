<?php

namespace Quizzo;

/**
 * Register Quiz, Question and Score CPTs
 *
 * @return void
 */
function register_quizzo_cpts() {
	register_post_type( 'quiz',
		array(
			'labels'       => array(
				'name'          => __( 'Quizzes' ),
				'singular_name' => __( 'Quiz' ),
				'add_new'       => __( 'Add New', PLUGIN_DOMAIN ),
				'add_new_item'  => __( 'Add New Quiz', PLUGIN_DOMAIN ),
				'new_item'      => __( 'New Quiz', PLUGIN_DOMAIN ),
				'edit_item'     => __( 'Edit Quiz', PLUGIN_DOMAIN ),
				'view_item'     => __( 'View Quiz', PLUGIN_DOMAIN ),
				'menu_name'     => __( 'Quizzes', PLUGIN_DOMAIN ),
			),
			'public'       => true,
			'has_archive'  => true,
			'show_in_menu' => PLUGIN_SLUG,
			'supports'     => array( 'title', 'thumbnail' ),
			//'taxonomies'   => array( 'category' ),
			'show_in_rest' => false
		)
	);

	register_post_type( 'question',
		array(
			'labels'       => array(
				'name'          => __( 'Questions' ),
				'singular_name' => __( 'Question' ),
				'add_new'       => __( 'Add New', PLUGIN_DOMAIN ),
				'add_new_item'  => __( 'Add New Question', PLUGIN_DOMAIN ),
				'new_item'      => __( 'New Question', PLUGIN_DOMAIN ),
				'edit_item'     => __( 'Edit Question', PLUGIN_DOMAIN ),
				'view_item'     => __( 'View Question', PLUGIN_DOMAIN ),
			),
			'public'       => true,
			'has_archive'  => true,
			'show_in_menu' => PLUGIN_SLUG,
			'supports'     => array( 'title', 'thumbnail' ),
			//'taxonomies'   => array( 'category' ),
			'show_in_rest' => false,
		)
	);

	register_post_type( 'score',
		array(
			'labels'       => array(
				'name'          => __( 'Scores' ),
				'singular_name' => __( 'Score' ),
				'add_new'       => __( 'Add New', PLUGIN_DOMAIN ),
				'add_new_item'  => __( 'Add New Score', PLUGIN_DOMAIN ),
				'new_item'      => __( 'New Score', PLUGIN_DOMAIN ),
				'edit_item'     => __( 'Edit Score', PLUGIN_DOMAIN ),
				'view_item'     => __( 'View Score', PLUGIN_DOMAIN ),
				'menu_name'     => __( 'Scores', PLUGIN_DOMAIN ),
			),
			'public'       => true,
			'has_archive'  => true,
			'show_in_menu' => PLUGIN_SLUG,
			'supports'     => array( 'title', 'thumbnail' ),
			'show_in_rest' => false,
			'capabilities' => array(
				'create_posts' => false
			),
			'map_meta_cap' => true,
		)
	);
}
