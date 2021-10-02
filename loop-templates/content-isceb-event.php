<?php

/**
 * Single post partial template
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

global $event_template_data;
// print_r($event_template_data);

$isceb_wc_event = wc_get_product($event_template_data['event_post_id']);
// var_dump(wc_get_product($event_template_data['event_post_id']));

?>


<div class="card-media">
	<!-- media container -->

	<!-- body container -->
	<div class="card-media-body">
		<div class="card-media-body-top">
			<h3 class="isceb-event-body-top"><?php echo $isceb_wc_event->get_name() ?></h3>
			<!-- <div class="isceb-card-media-title"> </div> -->
		</div>

		<div class="card-media-body-middle">
			<div>
				<div class="card-media-body-supporting-bottom-text subtle description"><?php echo $isceb_wc_event->get_description(); ?></div>
			</div>

		</div>
		<div class="card-event-meta">
			<span class="subtle"><i class="far fa-calendar-alt"></i>Mon, APR 09</span>
			<span class="subtle"><i class="far fa-clock"></i>23:59</span>
			<span class="card-media-body-supporting-bottom-text subtle"><i class="fas fa-ticket-alt"></i>Free &ndash; $30</span>
		</div>
		<div class="card-media-body-bottom">
			<span class="card-media-body-bottom-text">Read more</span>
			<button class="card-media-body-bottom-button">Sold out</button>
		</div>
	</div>

	<div class="card-media-object-container">
		<div class="card-media-object" style="
				background-image: url(<?php echo get_the_post_thumbnail_url($event_template_data['event_post_id'], 'large'); ?> );
				opacity: 0.2;
				"></div>
		<!-- <span class="card-media-object-tag subtle">Selling Fast</span> -->
		<div class="card-media-countdown-container">
			<span class="card-media-object-tag-countdown-number subtle">3</span>
			<span class="card-media-object-tag-countdown-text subtle">days left to register</span>


		</div>
	</div>
</div>