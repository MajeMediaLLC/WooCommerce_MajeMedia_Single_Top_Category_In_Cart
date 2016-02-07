<?php

/*
Plugin Name: WooCommerce Single Top Level Category In Cart
Plugin URI:  https://majemedia.com/plugins/single-top-level-category-in-cart
Description: Don't allow the placement of products from multiple top level categories in the cart.
Version:     1.0.0
Author:      Maje Media LLC
Author URI:  https://majemedia.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: mmwc-single-top-cat-in-cart
*/

if ( ! defined( 'ABSPATH' ) ) {
	die();
}

/*
 * This is the free version
 * TODO: Restrict categories in cart on AJAX cart
 * TODO: Restrict categories in cart on non-AJAX cart
 * TODO: Add in actions and filters for pro plugin for configuration
 * TODO: Allow products with multiple top level categories where one of which matches to exist in cart at same time
 */

/*
 * Notes:
 * - AJAX
 *      - Filters
 *          - 'woocommerce_add_to_cart_validation': https://docs.woothemes.com/wc-apidocs/source-class-WC_AJAX.html#409
 * - Non-Ajax (Check on cart page)
 *      - Actions
 *          - 'woocommerce_before_cart'
 */

class WooCommerce_MajeMedia_Single_Top_Level_Category_Cart {

	private static $instance;

	/**
	 * @return WooCommerce_MajeMedia_Single_Top_Level_Category_Cart
	 * @since 1.0.0
	 */
	public static function get_instance() {

		if ( ! self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * WooCommerce_MajeMedia_Single_Top_Level_Category_Cart constructor.
	 * @since 1.0.0
	 */
	public function __construct() {

		require 'autoload.php';

		add_action( 'activate_plugin', array( 'WooCommerce_MajeMedia_Single_Top_Level_Category_Cart', 'activate' ) );
		add_action( 'deactivate_plugin', array( 'WooCommerce_MajeMedia_Single_Top_Level_Category_Cart', 'deactivate' ) );

		self::actions;
		self::filters;

	}

	public static function activate() {

	}

	public static function deactivate() {

	}

	public static function actions() {

	}

	public static function filters() {

	}

}

$WooCommerce_MajeMedia_Single_Top_Level_Category_Cart = WooCommerce_MajeMedia_Single_Top_Level_Category_Cart::get_instance();