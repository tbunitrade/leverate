<?php /**
Template Name: Page - sample
 **/ ?>
<?php get_header(); ?>

<div id="primary" class="content-area contacts">
    <main id="main" class="site-main" role="main">

        <div class="container">



                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                    <?php the_content(); ?>

                <?php endwhile; endif; ?>

        </div>
    </main>
</div>




<?php get_footer();?>
