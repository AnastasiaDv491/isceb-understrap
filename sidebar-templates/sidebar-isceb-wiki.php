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

    <div class="isceb-nav-header">


        <h4><a href="<?php echo (get_site_url() . '/wiki') ?>" id="isceb-wiki-nav-header-text"><i class="fa fa-home" aria-hidden="true"></i>ISCEB Wiki</a></h4>

    </div>

    <?php if (is_active_sidebar('isceb_wiki_sidebar_nav')) {
        dynamic_sidebar('ISCEB Wiki sidebar');
    } else {

        switch (get_post_type()) {
            case 'program':
                $wiki_phases = get_posts(array(
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
                $title_of_page = get_the_title();
                break;
            case 'phase':
                $programs_of_phase = get_field('program');
                $wiki_phases = get_posts(array(
                    'post_type' => 'phase',
                    'order' => 'ASC',
                    'meta_query' => array(
                        array(
                            'key' => 'program', // name of custom field
                            'value' => '"' . $programs_of_phase[0]->ID . '"', // matches exactly "123", not just 123. This prevents a match for "1234"
                            'compare' => 'LIKE'
                        )
                    )
                ));
                $title_of_page = $programs_of_phase[0]->post_title;
                break;
            case 'course':
                $phases_of_course = get_field('phases', $post->ID);
                $programs_of_phase = get_field('program', $phases_of_course[0]->ID);

                $wiki_phases = get_posts(array(
                    'post_type' => 'phase',
                    'order' => 'ASC',
                    'meta_query' => array(
                        array(
                            'key' => 'program', // name of custom field
                            'value' => '"' . $programs_of_phase[0]->ID . '"', // matches exactly "123", not just 123. This prevents a match for "1234"
                            'compare' => 'LIKE'
                        )
                    )
                ));
                $title_of_page = $programs_of_phase[0]->post_title;
                break;
        }



    ?>

        <h4 class="isceb-nav-program-name"> <?php echo $title_of_page ?></h4>
        <?php
        if ($wiki_phases) : ?>

            <div id="isceb-wiki-nav-container">
                <?php foreach ($wiki_phases  as $phase) :
                    //Get all the courses for a certain phase
                    $wiki_courses = get_posts(array(
                        'post_type' => 'course',
                        'meta_query' => array(
                            array(
                                'key' => 'phases', // name of custom field
                                'value' => '"' . $phase->ID . '"', // matches exactly "123", not just 123. This prevents a match for "1234"
                                'compare' => 'LIKE'
                            )
                        )
                    ));
                ?>

                    <div>
                        <i class="fa fa-sort-desc" aria-hidden="true"
                        id="isceb-wiki-toggle<?php echo $phase->post_title?>"
                        onclick="isceb_wiki_sidebar_toggle_function('<?php echo ('isceb-wiki-courses-per-phase-' . $phase->post_title) ?>',this)"
                        ></i>
                        <a href="<?php echo get_permalink($phase->ID); ?>" class="isceb-wiki-nav-phase" > <?php echo $phase->post_title; ?> </a>

                    </div>
                    <hr class="isceb-wiki-nav-phase-line">

                    <ul class="isceb-wiki-courses-per-phase" id="<?php echo ('isceb-wiki-courses-per-phase-' . $phase->post_title) ?>" style="display: block;">
                        <?php foreach ($wiki_courses  as $course) :
                        ?>
                            <li>
                                <a href="<?php echo get_permalink($course->ID); ?>" class="isceb-wiki-nav-course"> <?php echo $course->post_title; ?> </a>
                            </li>


                        <?php endforeach; ?>
                    </ul>
                <?php endforeach; ?>
            </div>
    <?php endif;
    }
    ?>
    <button class="isceb-wiki-button-not-gb" id="isceb-wiki-nav-upload-btn"> Upload files </button>
</div>

<script>
    function isceb_wiki_sidebar_toggle_function(elementId,dropdownId) {
        console.log(dropdownId);
        
        console.log(elementId);
        var x = document.getElementById(elementId);
        if (x.style.display === "block") {
            x.style.display = "none";
            dropdownId.classList.add("fa-rotate-270");
        } else {
            x.style.display = "block";
            dropdownId.classList.remove("fa-rotate-270");
        }
    }
</script>