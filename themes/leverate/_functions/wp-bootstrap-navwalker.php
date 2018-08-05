<?php

// initial functions to functions.php
//
// ===================================================
// ==== Bootstrap 3 walker support ==========================
// ===================================================

//https://github.com/wp-bootstrap/wp-bootstrap-navwalker/tree/v3-branch

require_once get_template_directory() . '/wp-bootstrap-navwalker.php';

// Making this Walker the Default Walker for Nav Manus
// There has been some interest in making this walker the default walker for all menus.
// That could result in some unexpected situations but it can be achieved by adding this
// function to your functions.php file.


//function prefix_modify_nav_menu_args( $args ) {
//    return array_merge( $args, array(
//        'walker' => WP_Bootstrap_Navwalker(),
//    ) );
//}
//add_filter( 'wp_nav_menu_args', 'prefix_modify_nav_menu_args' );

//End of wBootstrap 3 walker support
////



//This is for bootstrap 4

//https://github.com/wp-bootstrap/wp-bootstrap-navwalker

// Register Custom Navigation Walker
//require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';

//function prefix_modify_nav_menu_args( $args ) {
//    return array_merge( $args, array(
//        'walker' => WP_Bootstrap_Navwalker(),
//    ) );
//}
//
//add_filter( 'wp_nav_menu_args', 'prefix_modify_nav_menu_args' );

