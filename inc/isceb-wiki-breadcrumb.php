<?php

/**
 * Declaring widgets
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;


function get_the_breadcrumb($post){
    switch ($post->post_type) {            
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
            $breadcrumb = '<a href="'.get_permalink($programs_of_phase[0]->ID).'">'.$programs_of_phase[0]->post_title.'</a> > '
            .'<span  class="isceb-wiki-last-breadcrumb">'.$post->post_title.'</span>';
            break;
        case 'course':
            $phases_of_course = get_field('phases',$post->ID);
            $programs_of_phase = get_field('program',$phases_of_course[0]->ID);
            
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
            // var_dump($programs_of_phase[0]);
            
            $breadcrumb = '<a href="'.get_permalink($programs_of_phase[0]->ID).'">'. $programs_of_phase[0]->post_title.'</a>  > '.
            '<a href="'.get_permalink($phases_of_course[0]->ID).'">'.$phases_of_course[0]->post_title .  '</a> > '
            .'<span  class="isceb-wiki-last-breadcrumb">'.$post->post_title.'</span>';
            break;
    }

    return '<div>'.$breadcrumb .'</div>';
}