<?php

namespace Quizzo;

/**
 * Register Quizzo menu
 *
 * @return void
 */
function register_quizzo_menu() {
	add_menu_page(
		__( 'Quizzo', PLUGIN_DOMAIN ),
		'Quizzo',
		PLUGIN_ROLE,
		PLUGIN_SLUG,
		false,
		'dashicons-edit-page',
		''
	);

	add_submenu_page(
		PLUGIN_SLUG,
		'Quizzo',
		'Dashboard',
		PLUGIN_ROLE,
		PLUGIN_SLUG,
		'quizzo_plugin_page',
	);
}
