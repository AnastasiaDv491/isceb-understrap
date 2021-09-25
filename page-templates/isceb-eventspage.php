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
                    <h2>

                    </h2>
                    <?php

                    while (have_posts()) {
                        the_post();
                        get_template_part('loop-templates/content', 'page');

                        // 	// If comments are open or we have at least one comment, load up the comment template.
                        // 	if ( comments_open() || get_comments_number() ) {
                        // 		comments_template();
                        // 	}
                    }

                    foreach ($product_posts as $product_post) {
                        # code...
                        // var_dump($product_post);
                        $post_meta = get_post_meta($product_post->ID);
                        print_r(get_post_meta($product_post->ID));

                        // var_dump(wc_get_product($product_post->ID)->get_available_variations());

                        $event_template_data = array(
                            'name_event' => $product_post->post_title,
                            'start_event' => ['isceb-start-of-event'],
                            'end_event' => ['isceb-end-of-event'],
                            'location_event' => ['isceb-location-of-event'],


                        );

                        get_template_part('loop-templates/content', 'isceb-event', $event_template_data);
                    }


                    ?>



                </main><!-- #main -->

            </div><!-- #primary -->

        </div><!-- .row end -->

    </div><!-- #content -->

</div><!-- #full-width-page-wrapper -->

<?php
get_footer();