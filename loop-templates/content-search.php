<?php

/**
 * Search results partial template
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

$topic = '';
$color_topic = '';
$title_wiki_phases = [];
$title_wiki_programs = [];
$title_wiki_courses = [];
$wiki_url = '';

switch (get_post_type()) {
	case 'product':
		$topic = 'Event';
		$color_topic = '#f0e7ff';
		break;
	case 'program':
		$topic = 'Program';
		break;
	case 'phase':
		$topic = 'Phase';
		$color_topic = '#99aee1';

		$wiki_programs = get_field('program', get_the_ID());
		$title_wiki_programs[] = ((!empty($wiki_programs)) ? $wiki_programs[0]->post_title : '');
		break;
	case 'course':
		$topic = 'Course';
		$color_topic = '#d2f6ee';

		if (get_field('phases', get_the_ID())) {

			$wiki_phases = get_field('phases', get_the_ID());
			for ($i = 0; $i < count($wiki_phases); $i++) {
				$wiki_programs = get_field('program', $wiki_phases[$i]->ID);
				$title_wiki_programs[] = ((!empty($wiki_programs)) ? $wiki_programs[0]->post_title : '');
				$title_wiki_phases[] = $wiki_phases[$i]->post_title;
			}
		}
		break;
	case 'wiki-file':
		$topic = (!empty(get_the_terms(get_the_ID(), 'wiki_file_category'))) ? get_the_terms(get_the_ID(), 'wiki_file_category')[0]->name : '';
		$color_topic = '#ffccbb';

		if (get_field('course', get_the_ID())) {
			$wiki_file_courses = get_field('course', get_the_ID());
			//Max Three courses displayed
			for ($courses_i = 0; $courses_i < min(count($wiki_file_courses), 3); $courses_i++) {
				$wiki_url = get_permalink($wiki_file_courses[$courses_i]->ID);

				$title_wiki_courses[] =  $wiki_file_courses[$courses_i]->post_title;

				$wiki_phases = get_field('phases', $wiki_file_courses[$courses_i]->ID);
				for ($i = 0; $i < count($wiki_phases); $i++) {
					$wiki_programs = get_field('program', $wiki_phases[$i]->ID);
					$title_wiki_programs[] = ((!empty($wiki_programs)) ? $wiki_programs[0]->post_title : '');
					$title_wiki_phases[] = $wiki_phases[$i]->post_title;
				}
			}
		}
		break;
}

?>

<article <?php post_class('isceb-search-article'); ?> id="post-<?php the_ID(); ?>">
	<a class="isceb-search-article-href" href="<?php echo ($wiki_url !== '')?$wiki_url:esc_url(get_permalink()); ?>">
		<header class="entry-header isceb-entry-header">

			<?php
			the_title(
				sprintf('<h2 class="entry-title isceb-search-entry-title">'),
				'</h2>'
			);
			?>

			<?php echo get_post_type();	?>

			<?php if (get_post_type() === 'phase') : ?>
				<div>Program(s): <b><?php echo implode(', ', array_unique($title_wiki_programs)); ?></b></div>
			<?php endif; ?>

			<?php if (get_post_type() === 'course') : ?>
				<div>Program(s): <b><?php echo implode(', ', array_unique($title_wiki_programs)); ?></b> - Phase(s): <b><?php echo implode(', ', array_unique($title_wiki_phases)); ?></b></div>
			<?php endif; ?>

			<?php if (get_post_type() === 'wiki-file') : ?>
				<div>
					Program(s): <b><?php echo implode(', ', array_unique($title_wiki_programs)); ?></b> - Phase(s): <b><?php echo implode(', ', array_unique($title_wiki_phases)); ?></b> - Course(s): <b><?php echo implode(', ', array_unique($title_wiki_courses)); ?></b>
				</div>
			<?php endif; ?>


			<?php if ('post' === get_post_type()) : ?>

				<div class="entry-meta">

					<!-- <?php understrap_posted_on(); ?> -->

				</div>

			<?php endif; ?>

			<?php if ($topic != '') : ?>

				<div class="isceb-search-result-topic" style="background-color:<?php echo esc_attr($color_topic); ?>;"><?php esc_html_e($topic) ?></div>
			<?php endif; ?>
		</header>

		<div class="entry-summary">

			<?php the_excerpt(); ?>


		</div>

		<footer class="entry-footer">

			<!-- <?php understrap_entry_footer(); ?> -->

		</footer>
	</a>
</article>