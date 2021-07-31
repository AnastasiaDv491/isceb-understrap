<?php

/**
 * The template for displaying a single phase on the wiki
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
$container = get_theme_mod('understrap_container_type');
?>

<div class="wrapper h-100" id="single-wrapper">

    <div class="container-fluid" id="content" tabindex="-1">

        <div class="row">

            <!-- Do the left sidebar check -->
            <?php get_template_part('sidebar-templates/sidebar', 'isceb-wiki'); ?>

            <main class="isceb-wiki-site-main col-md-6" id="main">
                <div id="isceb-wiki-breadcrumb"><?php echo get_the_breadcrumb($post) ?></div>


                <?php


                while (have_posts()) {
                    the_post();
                    get_template_part('loop-templates/content', 'isceb-wiki');
                }
                ?>

            </main><!-- #main -->

            <!-- Do the right sidebar check -->
            <?php get_template_part('global-templates/right-sidebar-check'); ?>

        </div><!-- .row -->

    </div><!-- #content -->

</div><!-- #single-wrapper -->

<?php
get_footer();
