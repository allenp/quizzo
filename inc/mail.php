<?php

namespace Quizzo;

function attach_quizzo_link_to_wc_email( $order, $sent_to_admin, $plain_text, $email ) {
	foreach ( $order->get_items() as $item ) {
		// Get product details
		$product    = $item->get_product();
		$product_id = $item->get_product_id();

		// Get quiz id and shortcode
		$quiz_id        = get_post_meta( $product_id, 'quizzo_id', true );
		$quiz_shortcode = '[quizzo id=' . $quiz_id . ']';

		// Get Quiz page ID, Quiz link
		global $wp, $wpdb;
		$sql = 'SELECT ID FROM '. $wpdb->posts. ' WHERE post_content LIKE "%' . $quiz_shortcode . '%"';
		$page_id   = $wpdb->get_var( $sql );
		$quiz_link = get_permalink( $page_id );

		// Attach if it is a Quizzo product
		if ( $product->is_type('quizzo') ) {
			$quiz_message = sprintf(
				'<p>You can take your test quiz, %2$s, %3$s, %4$s, %5$s <a href="%1$s">here</a>.</p>',
				$quiz_link,
				$quiz_id,
				$quiz_shortcode,
				$sql,
				$page_id
			);
			$plain_text .= $quiz_message;
        }
	}
	echo $plain_text;
}

function get_shortcode_pages_ids( $shortcode ) {
	// Prepare ID array
	$page_ids = [];

	// Get Query
	$query = new WP_Query( array(
		's' => $shortcode
	) );

	// Get the IDs
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$page_ids[] = get_the_ID();
		}
	}

	return $page_ids[0];
}
