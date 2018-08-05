<?php
// Initial setup
// Thumbnail support
//Excerpt custom
require_once( '_functions/init.php' );
// load CSS & JS scripts
require_once( '_functions/load_scripts.php' );
// Options Page from acf
require_once ('_functions/acf.php');
// Woocommerce
//require_once ('_functions/woocommerce.php');
// Mail sender
require_once ('_functions/mailsender.php');
// For variations
//require_once ('_functions/variations.php');
// Bootstrap walkers
require_once ('_functions/wp-bootstrap-navwalker.php');
// Ajaxl oadFiles On Server
//require_once ('_functions/ajaxsender.php');

// Ajaxl oadFiles On Server
//require_once ('_functions/product_search.php');

//function so_28179558_get_order_thumbnail( $order ){
//
//    if( is_numeric( $order ) ){
//        $order = wc_get_order( $order_id );
//    }
//
//    if( is_wp_error( $order ) ){
//        return;
//    }
//
//    $order_thumb = '';
//
//    $items = $order->get_items();
//    if( $items ) {
//        foreach( $items as $item ){
//            $id = isset( $item['variation_id'] ) ? $item['variation_id'] : $item['product_id'];
//            $product = wc_get_product( $id );
//            $order_thumb = $product->get_image();
//            continue;
//        }
//    }
//
//    return $order_thumb;
//}