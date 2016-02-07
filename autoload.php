<?php

if ( ! defined( 'ABSPATH' ) ) {
	die();
}

// Slash in front
$files_to_load = array(
	'/classes/MMWC_Single_Top_Level_Category_In_Cart_Product_Information.php',
);

foreach ( $files_to_load as $file ) {
	require realpath( dirname( __FILE__ ) ) . $file;
}