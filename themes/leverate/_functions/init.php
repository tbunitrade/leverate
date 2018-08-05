<?php

// initial functions to functions.php
//
// ===================================================
// ==== Clean up the <head> ==========================
// ===================================================
function removeHeadLinks() {
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
}
add_action('init', 'removeHeadLinks');
remove_action('wp_head', 'wp_generator');
// ===================================================
// ==== Declare sidebar widget zone ==================
// ===================================================
if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => 'Sidebar Widgets',
        'id'   => 'sidebar-widgets',
        'description'   => 'These are widgets for the sidebar.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>'
    ));
//    register_sidebar ( array (
//        'name' => 'Polylang menu',
//        'id' => 'menu-1',
//        'description' => 'Sidebar Menu',
//        'before_widget' => '<div class="mg1">',
//        'after_widget' => '</div>'
//    ));
//    register_sidebar ( array (
//        'name' => 'Login page',
//        'id' => 'login-page',
//        'description' => 'Area for login page',
//        'before_widget' => '<div class="login-container">',
//        'after_widget' => '</div>'
//    ));
//    register_sidebar ( array (
//        'name' => 'searchme',
//        'id' => 'searchme',
//        'description' => 'searchme',
//        'before_widget' => '<div class="searchBox">',
//        'after_widget' => '</div>'
//    ));
//    register_sidebar ( array (
//        'name' => '404 page sidebar',
//        'id' => 'sidebar404',
//        'description' => 'searchme',
//        'before_widget' => '<div class="sidebar404">',
//        'after_widget' => '</div>'
//    ));
//    register_sidebar ( array (
//        'name' => 'New Sidebar',
//        'id' => 'newsidebar',
//        'description' => 'searchme',
//        'before_widget' => '<div class="newtagCont">',
//        'after_widget' => '</div>'
//    ));
}
// ===================================================
// ==== Register Main Menu ===========================
// ===================================================
if (function_exists('register_nav_menus')) {
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'Main Menu' ),
    ) );
    register_nav_menus( array(
        'secondary' => __( 'secondary', 'Secondary Menu' ),
    ) );
//    register_nav_menus( array(
//        'third' => __( 'Third menu', 'third Menu' ),
//    ) );
//    register_nav_menus( array(
//        'fourth' => __( 'Fourth menu', 'fourth Menu' ),
//    ) );
//    register_nav_menus ( array (
//        'login' => __('login','login menu'),
//    ) );
}
// ===================================================
// ==== Add theme support ============================
// ===================================================
// move order to thumbnail.php
add_theme_support( 'title-tag' );
add_theme_support ('menus');
// ===================================================
// ==== Declare Thumbnail ============================
// ===================================================
add_theme_support( 'post-thumbnails', array ('post','product') );
// need to update code for best see in archive page when little picture
function new_excerpt_length($length) {
    //return 57;
    return 20;
}
add_filter('excerpt_length', 'new_excerpt_length');
add_filter('excerpt_more', function($more) {
    return '...';
});