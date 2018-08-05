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
    <div class="container">

        <header id="header" class="header">

                <div class="row">
                    <div class="col-xs-12 col-md-12 col-lg-4 ">
                        <a href="/"><div class="logo"> </div></a>
                    </div>
                    <!-- Start of menu -->
                    <div class="col-xs-12 col-md-12 col-lg-8 ">
                        <?php wp_nav_menu( array (
                                'menu'              => 'primary',
                                'theme_location'    => 'primary',
                                'depth'             => 2,
                                'container'         => 'div',
                                'container_class'   => 'collapse navbar-collapse pcMenu',
                                'container_id'      => 'bs-example-navbar-collapse-1',
                                'menu_class'        => 'nav navbar-nav',
                                'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                                //'walker'            => new WP_Bootstrap_Navwalker())
                        ));?>
                    </div>

                    <!-- end of menu -->

                </div>
            </div>
        </header>

