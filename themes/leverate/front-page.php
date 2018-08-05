<?php
/**
 * Template name: Front page
 *
 *
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
        <!-- First row -->
        <div class="row">
            <div class="col-xs 12 col-md-12">
                <!-- Main page title tag -->
                <h1 class="text">For this task test - i use simple Front page</h1>
                <!-- end of title tag-->
            </div>
        </div>
        <!-- end of first row-->

        <div class="row">
            <div class="col-xs-12 col-md-6">
                <form class="myForm">
                    <fieldset>
                        <input type="text" id="login" name="name">
                        <input type="email" id="email" name="email">
                        <input type="password" name="password">
                    </fieldset>

                    <fieldset>
                        <button>
                            <input type="submit" value="Start" id="submit">
                        </button>
                    </fieldset>
                </form>
            </div>
            <div class="col-xs-12 col-md-6"></div>
        </div>



    </main><!-- #main -->
</div><!-- #primary -->
<?php get_footer();
