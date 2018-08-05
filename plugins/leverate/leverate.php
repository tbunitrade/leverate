<?php
/*
Plugin Name: Leverate
Plugin URI: https://www.leverate.com/
Description: Customise WordPress.
Version: 0.0.1
Author: O. Sonich
Author URI: http://Создание-сатов.укр
Copyright: Oleksandr Sonich
Text Domain: leverate
Domain Path: www.google.com.ua
*/


// Hook for adding admin menus
add_action('admin_menu', 'mt_add_pages');

// action function for above hook
function mt_add_pages() {
    // Add a new submenu under Options:
    add_options_page('Test Options', 'Test Options', 8, 'testoptions', 'mt_options_page');

    // Add a new submenu under Manage:
    add_management_page('Test Manage', 'Test Manage', 8, 'testmanage', 'mt_manage_page');

    // Add a new top-level menu (ill-advised):
    add_menu_page('Leverate', 'Leverate', 8, __FILE__, 'mt_toplevel_page');

    // Add a submenu to the custom top-level menu:
    add_submenu_page(__FILE__, 'First Sub Menu', 'First Sub Menu', 8, 'sub-page', 'mt_sublevel_page');

    // Add a second submenu to the custom top-level menu:
    add_submenu_page(__FILE__, 'Second Sub Menu', 'Second Sub Menu', 8, 'sub-page2', 'mt_sublevel_page2');
}

// mt_options_page() displays the page content for the Test Options submenu
function mt_options_page() {
    echo "<h2>Test Options</h2>";
}

// mt_manage_page() displays the page content for the Test Manage submenu
function mt_manage_page() {
    echo "<h2>Test Manage</h2>";
}

// mt_toplevel_page() displays the page content for the custom Test Toplevel menu
function mt_toplevel_page() {
    echo "<h2>Main page</h2>";
}

// mt_sublevel_page() displays the page content for the first submenu
// of the custom Test Toplevel menu
function mt_sublevel_page() {
    echo "<h2>First sub menu</h2>";
    echo "     First sub menu page should contain a table listing all the pages title and pages links that the current website has.
";
    wp_nav_menu( array (
                                'menu'              => 'secondary',
                                'theme_location'    => 'secondary',
                                'depth'             => 2,
                                'container'         => 'div',
                                'container_class'   => 'collapse navbar-collapse pcMenu',
                                'container_id'      => 'bs-example-navbar-collapse-1',
                                'menu_class'        => 'nav navbar-nav',
                                'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                                //'walker'            => new WP_Bootstrap_Navwalker())
                        ));
}

// mt_sublevel_page2() displays the page content for the second submenu
// of the custom Test Toplevel menu
function mt_sublevel_page2() {
    echo "<h2>Second sub menu</h2>";
    echo " Second sub-page menu should contain a list of information retrieved dynamically from your Data Base:";
    echo '<br>';

    global $wpdb;
    $result = $wpdb->get_results("SELECT * FROM wp_lerevate");
    //echo print_r($result);

    echo "<ul>";
    foreach ($result as $data)  {
        echo "<li> ". $data->email , $data->password."</li>";
    }
    echo "</ul>";
}

//echo 'Start page of laravel plugins';



