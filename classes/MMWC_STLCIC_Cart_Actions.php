<?php

if ( ! defined( 'ABSPATH' ) ) {
	die();
}

/*
 * 
 */

class MMWC_STLCIC_Cart_Actions {

	public function __construct() {

	}

	public static function check_cart_on_display() {

	}

	public static function check_added_cart_product( $cart_item_key, $product_id ) {

		$cart_unique_information = MMWC_STLCIC_Cart_Information::cart_information();

		$product_in_same_tlc = TRUE;

		if ( key( $cart_unique_information[ 'unique_cart_array' ] ) !== $cart_item_key ) {

			$new_product_tlc = MMWC_STLCIC_Product_Information::get_product_top_level_categories( $product_id );

			foreach ( $new_product_tlc as $product_tlc ) {

				if ( in_array( $product_tlc, $cart_unique_information[ 'cart_first_item_tlc' ] ) ) {

					// Very important return statement
					return;

				} else {

					$product_in_same_tlc = FALSE;

				}

			}

		}

		if ( $product_in_same_tlc === FALSE ) {

			$product_info = get_post( $product_id );
			$product_title = $product_info->post_title;

			throw new Exception( sprintf( __( 'Could not add %s to the cart. Items in cart must be from the same main category.', 'mmwc-single-top-cat-in-cart' ), $product_title ) );

		}

	}

}