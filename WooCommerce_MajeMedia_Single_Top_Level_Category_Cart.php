<?php

/*
Plugin Name: WooCommerce Single Top Level Category In Cart
Plugin URI:  https://majemedia.com/plugins/single-top-level-category-in-cart
Description: Don't allow the placement of products from multiple top level categories in the cart.
Version:     1.0.2
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

class MMWC_STLCIC {

	private static $instance;

	/**
	 * @return MMWC_STLCIC
	 * @since 1.0.0
	 */
	public static function get_instance() {

		if ( ! self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * MMWC_STLCIC constructor.
	 * @since 1.0.0
	 */
	public function __construct() {

		require 'autoload.php';

		self::actions();
		self::filters();

	}

	public static function activate() {

	}

	public static function deactivate() {

	}

	public static function actions() {

		// Plugin Setup/Teardown
		add_action( 'activate_plugin', array( 'MMWC_STLCIC', 'activate' ) );
		add_action( 'deactivate_plugin', array( 'MMWC_STLCIC', 'deactivate' ) );

		add_action( 'woocommerce_add_to_cart', array( 'MMWC_STLCIC_Cart_Actions', 'check_added_cart_product' ), 10, 2 );

		// Test
		//add_action( 'wp_loaded', array( 'MMWC_STLCIC_Product_Information', 'get_product_top_level_categories' ) );


	}

	public static function filters() {

	}

}

$MMWC_STLCIC = MMWC_STLCIC::get_instance();