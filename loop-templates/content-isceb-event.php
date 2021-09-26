<?php

/**
 * Single post partial template
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
echo 'hello<br><br>';
global $event_template_data;
print_r($event_template_data);

$isceb_wc_event = wc_get_product($event_template_data['event_post_id']);
var_dump(wc_get_product($event_template_data['event_post_id']));

?>



<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<header class="entry-header">

		<h1 class="entry-title"><?php echo $isceb_wc_event->get_name() ?> </h1>
		<?php echo $isceb_wc_event->get_price() ?>


	</header><!-- .entry-header -->

	<head>
		<link rel="stylesheet" href="/style.css" />
	</head>

	<div class="container">
		<div class="card-media">
			<!-- media container -->
			<div class="card-media-object-container">
				<div class="card-media-object" style="
          background-image: url(https://s9.postimg.cc/y0sfm95gv/prince_f.jpg);

          opacity: 0.2;
        "></div>
				<!-- <span class="card-media-object-tag subtle">Selling Fast</span> -->
				<div class="card-media-countdown-container">
					<span class="card-media-object-tag-countdown-number subtle">3</span>
					<span class="card-media-object-tag-countdown-text subtle">days left to register</span>
				</div>
				<span class="card-media-object-tag subtle">Pride Week </span>
			</div>
			<!-- body container -->
			<div class="card-media-body">
				<div class="card-media-body-top">
					<span class="card-media-body-supporting-bottom-text subtle description">Join us at the colorful & diverse Pride Week! Contribute to
						celebrating love across all genders</span>
					<div class="card-media-body-top-icons u-float-right"></div>
				</div>

				<div class="card-media-body-middle">
					<span class="subtle">Mon, APR 09</span>
					<span class="subtle">7:00 PM</span>
					<span class="card-media-body-supporting-bottom-text subtle u-float-right">Free &ndash; $30</span>
				</div>
				<div class="card-media-body-bottom">
					<span class="card-media-body-bottom-text">Read more</span>
					<button class="card-media-body-bottom-button">Sold out</button>
				</div>
			</div>
		</div>
	</div>

	<div class="entry-content">

		<?php the_content(); ?>

		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __('Pages:', 'understrap'),
				'after'  => '</div>',
			)
		);
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->