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


        <h4><i class="fa fa-home" aria-hidden="true"></i>ISCEB Wiki</h4>

    </div>

    <?php if (is_active_sidebar('isceb_wiki_sidebar_nav')) {
        dynamic_sidebar('ISCEB Wiki sidebar');
    } else {
        

        //First get the programs

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

    ?>
        <h4 class="isceb-nav-program-name"> <?php echo get_the_title() ?></h4>
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


                    <a href="<?php echo get_permalink($phase->ID); ?>" class="isceb-wiki-nav-phase"> <?php echo $phase->post_title; ?> </a>
                    <hr class="isceb-wiki-nav-phase-line">

                    <ul class="isceb-wiki-courses-per-phase">
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

