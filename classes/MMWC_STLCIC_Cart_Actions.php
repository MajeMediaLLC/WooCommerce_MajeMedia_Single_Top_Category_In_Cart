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

		// TODO: Check the cart on display for existing carts when this plugin is installed

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

			$post_object = get_post( $product_id );
			$product_title = $post_object->post_title;

			/*
			 * Filter: mmwc_stlcic_could_not_add_message
			 *
			 * Allows modification of the error message displayed on the front end when a product cannot be added to the cart
			 *
			 * Only used when a product cannot be added to the cart due to no mixed categories.
			 *
			 * @param: message string that includes product name
			 * @param: product_id int Product's Post ID
			 * @param: post_object WP_Post Object from WP's get_post() method
			 *
			 */
			$message = apply_filters( 'mmwc_stlcic_could_not_add_message', sprintf( __( 'Could not add %s to the cart. Items in cart must be from the same main category.', 'mmwc-single-top-cat-in-cart' ), $product_title ), $product_id, $post_object );

			throw new Exception( $message );

		}

	}

}