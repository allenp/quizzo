<?php

/**
 * Register Quizzo product type
 *
 * @return void
 */
function register_quizzo_product_type() {
	if ( class_exists( 'WooCommerce' ) ) {
		class WC_Product_Quizzo extends WC_Product {
			public function __construct( $product ) {
				$this->product_type = 'quizzo';
				parent::__construct( $product );
			}
		}
	}
}

/**
 * Add to list of product types
 *
 * @param array $types
 * @return void
 */
function add_quizzo_product_type( $types ) {
	if ( class_exists( 'WooCommerce' ) ) {
		$types[ 'quizzo' ] = __( 'Quizzo product', 'quizzo_product' );
		return $types;
	}
}

/**
 * Enable add to cart button on Quizzo Product page
 *
 * @return void
 */
function add_to_cart_button() {
    do_action( 'woocommerce_simple_add_to_cart' );
}


