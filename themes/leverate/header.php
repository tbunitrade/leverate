<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 *
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri() ?>/app/dist/img/favicon/favicon.png" />


<?php wp_head(); ?>
</head>

<body id="body">
    <div class="container-fluid">

        <header id="header" class="headerForSearch" >
            <div class="navbar  header-menu">
                <div class="row containerForFixedHeader">
                    <div class="col-xs-12 col-md-12 col-lg-4 firstXs">
                        <a href="/"><div class="logo"> </div></a>
                    </div>
                    <!-- Start of menu -->
                    <div class="col-xs-12 col-md-12 col-lg-8 secondXs">
                        <?php wp_nav_menu( $args);?>
                    </div>

                    <!-- end of menu -->

                </div>
            </div>
        </header>

