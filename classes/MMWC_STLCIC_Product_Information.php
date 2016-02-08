<?php

if ( ! defined( 'ABSPATH' ) ) {
	die();
}

/*
 * 
 */

class MMWC_STLCIC_Product_Information {

	public static $woocommerce_category_identifier = 'product_cat';

	/**
	 * MMWC_STLCIC_Product_Information constructor.
	 * @since 1.0
	 */
	public function __construct() {

	}

	/**
	 * @param $product_id int post_type product id to find top level parents of
	 *
	 * @return array Unique array of top level parents that the product belongs to
	 *
	 * @since 1.0
	 *
	 */
	public static function get_product_top_level_categories( $product_id ) {

		$post_terms = wp_get_post_terms( $product_id, self::$woocommerce_category_identifier );

		$term_top_level_parents = array();

		foreach ( $post_terms as $term ) {

			if ( $term->parent === 0 ) {

				$term_top_level_parents[] = (int) $term->term_id;

				if ( gettype( $term->term_id ) !== 'integer' ) {

					error_log( 'WooCommerce_MajeMedia_Single_Top_Level_Category_Cart: ' . __FUNCTION__ . ': WP_Term Object is no longer returning integers for $term->term_id' );

				}

			} else {

				$term_top_level_parents[] = (int) self::get_top_level_product_category( $term->term_id );

			}

		}

		$term_top_level_parents = array_unique( $term_top_level_parents );

		return $term_top_level_parents;

	}

	/**
	 * @param $cat_id int product_cat term_id to find the top level parents of
	 *
	 * @return int top level parent term of submitted term
	 *
	 * @since 1.0
	 */
	private static function get_top_level_product_category( $cat_id ) {

		$ancestors = get_ancestors( $cat_id, self::$woocommerce_category_identifier, 'taxonomy' );

		if ( empty( $ancestors ) ) {

			return (int) $cat_id;

		} else {

			$top_level_ancestor = end( $ancestors );

			if ( gettype( $top_level_ancestor ) !== 'integer' ) {

				error_log( 'WooCommerce_MajeMedia_Single_Top_Level_Category_Cart: ' . __FUNCTION__ . ': WP_Term Object is no longer returning integers for $term->term_id' );

			}

			return (int) end( $ancestors );

		}

	}

}