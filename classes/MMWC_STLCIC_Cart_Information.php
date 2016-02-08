<?php

if ( ! defined( 'ABSPATH' ) ) {
	die();
}

/*
 * 
 */

class MMWC_STLCIC_Cart_Information {

	public function __construct() {

	}

	public static function cart_information() {

		$cart_unique_items   = self::cart_unique_products();
		$cart_first_item_tlc = self::cart_first_item_top_level_terms();

		return array( 'unique_cart_array' => $cart_unique_items, 'cart_first_item_tlc' => $cart_first_item_tlc );

	}

	private static function cart_unique_products() {

		$cart_unique_products = self::get_cart_unique_products();

		return $cart_unique_products;

	}

	private static function cart_first_item_top_level_terms( ) {

		$cart_array = self::get_cart_unique_products();

		$cart_first_item = current( $cart_array );

		$product_top_level_terms = MMWC_STLCIC_Product_Information::get_product_top_level_categories( $cart_first_item[ 'product_id' ] );

		return $product_top_level_terms;

	}

	private static function cart_items() {

		return WC()->cart->get_cart();

	}

	private static function get_cart_unique_products() {

		$cart_array         = self::cart_items();
		$unique_products    = array();
		$unique_product_ids = array();

		if( count( $cart_array ) > 1 ) {

			foreach ( $cart_array as $cart_key => $data ) {

				if ( in_array( $data[ 'product_id' ], $unique_product_ids ) ) {

					continue;

				} else {

					$unique_product_ids[]         = $data[ 'product_id' ];
					$unique_products[ $cart_key ] = $data;

				}

			}

			return $unique_products;

		}

		return $cart_array;

	}

}