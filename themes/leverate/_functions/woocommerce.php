<?php

// initial functions to functions.php
//
// ===================================================
// ==== Woocommerce support ==========================
// ===================================================


add_theme_support( 'woocommerce' );
//add_theme_support( 'post-thumbnails', array('post','page','product' ));
/**
 * Remove product data tabs
 */
//add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
//
//function woo_remove_product_tabs( $tabs ) {
//
//    unset( $tabs['description'] );      	// Remove the description tab
//    unset( $tabs['reviews'] ); 			// Remove the reviews tab
//    unset( $tabs['additional_information'] );  	// Remove the additional information tab
//
//    return $tabs;
//}

/**
 * Rename product data tabs
 */
add_filter( 'woocommerce_product_tabs', 'woo_rename_tabs', 98 );
function woo_rename_tabs( $tabs ) {

    $tabs['description']['title'] = __( 'Features' );		// Rename the description tab
    $tabs['additional_information']['title'] = __( 'Technical information' );				// Rename the reviews tab
    $tabs['reviews']['title'] = __( 'Instructions' );	// Rename the additional information tab

    return $tabs;

}

//add_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );




//WooCommerce - Sort products by SKU
add_filter('woocommerce_get_catalog_ordering_args', 'custom_woocommerce_catalog_orderby');
function custom_woocommerce_catalog_orderby( $args ) {
    $args['meta_key'] = '_sku';
    $args['orderby'] = 'meta_value';
    $args['order'] = 'asc';
    return $args;
}


//Attach our function to the filter hook:
add_filter('woocommerce_get_catalog_ordering_args', 'custom_catalog_ordering_args');

//Function to handle choices
function custom_catalog_ordering_args($args) {
    global $wp_query;
    // Changed the $_SESSION to $_GET
    if ($_GET['orderby'] == "designer_asc") {
        $args['meta_key'] = 'designer';
        $args['orderby'] = 'meta_value';
        $args['order'] = "ASC";
    } else if ($_GET['orderby'] == "designer_desc") {
        $args['meta_key'] = 'designer';
        $args['orderby'] = 'meta_value';
        $args['order'] = "DESC";
    }
    return $args;
}



//function starplast_add_woocommerce_support() {
//
//    add_theme_support( 'woocommerce', array(
//        'thumbnail_image_width' => 150,
//        'single_image_width'    => 300,
//
//        'product_grid'          => array(
//            'default_rows'    => 3,
//            'min_rows'        => 2,
//            'max_rows'        => 12,
//            'default_columns' => 3,
//            'min_columns'     => 2,
//            'max_columns'     => 5,
//        ),
//    ) );
//}
//add_action( 'after_setup_theme', 'starplast_add_woocommerce_support' );
//
//add_action( 'init', 'custom_fix_thumbnail' );
//
//function custom_fix_thumbnail() {
//    add_filter('woocommerce_placeholder_img_src', 'custom_woocommerce_placeholder_img_src');
//
//    function custom_woocommerce_placeholder_img_src( $src ) {
//        $upload_dir = wp_upload_dir();
//        $uploads = untrailingslashit( $upload_dir['baseurl'] );
//        $src = $uploads . '/2018/05/default-image.png';
//
//        return $src;
//    }
//}

//add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
//
//function special_nav_class ($classes, $item) {
//    if (in_array('current-post-ancestor', $classes) || in_array('current-page-ancestor', $classes) || in_array('current-menu-item', $classes) ){
//        $classes[] = 'activeme ';
//    }
//    return $classes;
//}

// Customize Woocommerce Related Products Output
//function woocommerce_output_related_products() {
//    woocommerce_related_products(4,4);   // Display 4 products in 4 columns
//}

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
function woocommerce_output_related_products(){
    $args = array(
        'posts_per_page' => 12,
        'columns' => 3,
        'orderby' => 'rand'
    );
    woocommerce_related_products( apply_filters( 'woocommerce_output_related_products_args', $args ) );
}