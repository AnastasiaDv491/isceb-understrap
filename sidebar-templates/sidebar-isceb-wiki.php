<?php

/**
 * The sidebar for the wiki
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;


// when both sidebars turned on reduce col size to 3 from 4.
$sidebar_pos = get_theme_mod('understrap_sidebar_position');
?>

<div class="col-md-2 widget-area" id="isceb-wiki-sidebar" role="complementary">

    <?php if (is_active_sidebar('isceb_wiki_sidebar_nav')) {
        dynamic_sidebar('ISCEB Wiki sidebar');
    } else {
        echo 'No content in widget';

        //First get the programs

        $wiki_programs_args = array(
            'post_type' => 'program',
            'order' => 'ASC',
            'orderby' => 'title',
            'posts_per_page' => -1
        );


        $query = new WP_Query($wiki_programs_args);
        if ($query->have_posts()) {
            // Loop over each program
            while ($query->have_posts()) : $query->the_post();
                // if a program has phases, return them in a list 

                $get_wiki_programs = get_posts(array(
                    'post_type' => 'phase',
                    'order' => 'ASC',
                    'meta_query' => array(
                        array(
                            'key' => 'program', // name of custom field
                            'value' => '"' . $post->ID . '"', // matches exactly "123", not just 123. This prevents a match for "1234"
                            'compare' => 'LIKE'
                        )
                    )
                ));


                echo '<a href="' . get_permalink() . '"> ';

                echo '<h4 class="isceb-wiki-programs-nav-links"> ' . get_the_title() . '</h4>';

                echo '</a>';



                if ($get_wiki_programs) : ?>
                    <ul class="isceb-wiki-phase-nav-links">
                        <?php foreach ($get_wiki_programs as $get_wiki_program) : ?>
                            <li>
                                <a href=" <?php echo get_permalink($get_wiki_program->ID); ?>"> <?php echo $get_wiki_program->post_title; ?> </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
    <?php endif;

            endwhile;

            wp_reset_postdata();
        }
    }

    ?>

    <h1>Hello</h1>
</div><!-- #left-sidebar -->