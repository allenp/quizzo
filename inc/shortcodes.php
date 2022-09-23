<?php

namespace Quizzo;

/**
 * Quizzo Shortcode
 *
 * @param array $atts
 * @return void
 */
function quizzo_shortcode( $atts ) {
	$quiz_id = $atts['id']; if ( ! $quiz_id ) return '';

	// Authenticate User
	if ( ! is_user_logged_in() ) return '<center>You are not logged in. <a href="' . wp_login_url() . '">Login Here</a></center>' ;

	// Authenticate WC Paywall, if user specifies so
	if ( get_post_meta( $quiz_id, 'quizzo_wc', true ) ) {
		// Get product ID into an array
		$product_id = get_post_meta( $quiz_id, 'quizzo_wc_product', true );
		$prod_arr[] = $product_id;

		// Check to see it is purchased
		if ( ! is_quiz_purchased( $prod_arr ) ) {
			return '<center>You have not paid for this Quiz. <a href="' . $url = get_permalink( $product_id ) . '">Pay Here</a></center>' ;
		}
	}

	// Display Shortcode
	return get_shortcode( $quiz_id, get_questions_ids( $quiz_id ) );
}

/**
 * Get Questions & their IDs
 *
 * @param int $id
 * @return array
 */
function get_questions_ids( $id ) {
	// Get All Questions
	$questions = get_posts( array(
		'post_type'      => 'question',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'meta_key'       => 'quizzo_quiz_id',
		'meta_value'     => $id,
		'order'          => 'ASC'
	) );

	// Get quesetion IDs
	return wp_list_pluck( $questions, 'ID' );
}


function get_shortcode( $quiz_id, $questions_ids ) {
	// Don't display, if no questions are available
	if ( ! count( $questions_ids ) ) return '';

	// If it's a new test...
	if ( ! isset( $_SESSION['questions_ids'] ) ) {
		$_SESSION['quiz_id']          = $quiz_id;
		$_SESSION['questions_ids']    = $questions_ids;
		$_SESSION['question_counter'] = '';
	} else {
		// If the user has switched to a different test
		if ( $_SESSION['questions_ids'] !== $questions_ids ) {
			$_SESSION['quiz_id']          = $quiz_id;
			$_SESSION['questions_ids']    = $questions_ids;
			$_SESSION['question_counter'] = '';
		}
	}

	// Output header buffers
	ob_start();

	// Load shortcode template
	load_template( dirname( __DIR__ ) . '/partials/cb-shortcode.php' );

	// Clean Header buffers
	return ob_get_clean();
}

/**
 * Check to see quiz was purchased
 *
 * @param array $prod_arr
 * @return boolean
 */
function is_quiz_purchased( $prod_arr ) {

	// Get all customer orders
	$customer_orders = get_posts( array(
		'numberposts' => -1,
		'meta_key'    => '_customer_user',
		'meta_value'  => get_current_user_id(),
		'post_type'   => 'shop_order',
		'post_status' => 'wc-completed'
	) );

	foreach ( $customer_orders as $customer_order ) {
		// WC 3+ compatibility
		$order_id = method_exists( $order, 'get_id' ) ? $order->get_id() : $order->id;
		$order = wc_get_order( $customer_order );

		// Iterating through each current customer products bought in the order
		foreach ($order->get_items() as $item) {
			// WC 3+ compatibility
			if ( version_compare( WC_VERSION, '3.0', '<' ) )
				$product_id = $item['product_id'];
			else
				$product_id = $item->get_product_id();

			if ( in_array( $product_id, $prod_arr ) ) return true;
		}
	}

	return false;
}
