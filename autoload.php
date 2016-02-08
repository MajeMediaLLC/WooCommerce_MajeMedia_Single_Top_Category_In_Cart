<?php

if ( ! defined( 'ABSPATH' ) ) {
	die();
}

// Slash in front
$files_to_load = array(
	'/classes/MMWC_STLCIC_Cart_Actions.php',
	'/classes/MMWC_STLCIC_Cart_Information.php',
	'/classes/MMWC_STLCIC_Product_Information.php',
);

foreach ( $files_to_load as $file ) {
	require realpath( dirname( __FILE__ ) ) . $file;
}