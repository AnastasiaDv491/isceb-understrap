<?php

/**
 * Template Name: ISCEB Events Page
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
$container = get_theme_mod('understrap_container_type');

if (is_front_page()) {
    get_template_part('global-templates/hero');
}

$args = array(
    'post_type' => 'product',
    'meta_query' => array(
        array(
            'key' => '_isceb_event',
            'value'    => 'yes',
        ),
    ),
);
$product_posts = get_posts($args);


?>

<div class="wrapper" id="full-width-page-wrapper">

    <div class="container-fluid" id="content">

        <div class="row">

            <div class="col-md-12 content-area" id="primary">

                <main class="site-main" id="main" role="main">
               
                    <?php

                    while (have_posts()) {
                        the_post();
                        get_template_part('loop-templates/content', 'page');

                    }
                    ?>
                    <div class="isceb-events-container">

                    <?php

                    foreach ($product_posts as $product_post) {
                        # code...
                        // var_dump($product_post);
                        $post_meta = get_post_meta($product_post->ID);
                        // print_r(get_post_meta($product_post->ID));

                        

                        $event_template_data = array(
                            'event_post_id' => $product_post->ID,
                            'start_event' =>  $post_meta['isceb-start-of-event'],
                            'end_event' =>  $post_meta['isceb-end-of-event'],
                            'location_event' =>  $post_meta['isceb-location-of-event'],
                        );

                        get_template_part('loop-templates/content', 'isceb-event', $event_template_data);
                    }


                    ?>


                </div>
                </main><!-- #main -->

            </div><!-- #primary -->

        </div><!-- .row end -->

    </div><!-- #content -->

</div><!-- #full-width-page-wrapper -->

<?php
get_footer();
