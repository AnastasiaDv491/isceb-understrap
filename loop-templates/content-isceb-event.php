<?php

/**
 * Single post partial template
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

global $event_template_data;

$isceb_wc_event = wc_get_product($event_template_data['event_post_id']);

$event_start_day_text = '';
$event_start_time_text = '';
$event_time_obj = false;

if (!empty($event_template_data['start_event'][0])) {
	$event_time_obj = strtotime($event_template_data['start_event'][0]);
	if ($event_time_obj) {
		$event_start_day_text = date('j M', $event_time_obj);
		$event_start_time_text = date('H:i', $event_time_obj);
	}
}

$price_event = isceb_get_price_html_zero_free($isceb_wc_event);

$event_descriptions_without_tags = strip_tags($isceb_wc_event->get_description());
$isceb_event_description_trimmed = strlen($event_descriptions_without_tags) > 50 ?  substr($event_descriptions_without_tags, 0, 50) . "..." : $event_descriptions_without_tags;

$isceb_event_location_without_tags = strip_tags($event_template_data['location_event'][0]);
$isceb_event_location_trimmed = strlen($isceb_event_location_without_tags) > 35 ?  substr($isceb_event_location_without_tags, 0, 35) . "..." : $isceb_event_location_without_tags;
// var_dump($event_template_data['end_event']);

$isceb_event_current_date = new DateTime('now');
$isceb_event_start_date = new DateTime($event_template_data['start_event'][0]);

$isceb_event_countdown = date_diff($isceb_event_current_date, $isceb_event_start_date);

// var_dump($isceb_event_countdown->d);
var_dump($isceb_event_countdown);
?>

<a class="isceb-event-card-link" href="<?php esc_html_e($isceb_wc_event->get_permalink()); ?>">
	<div class="isceb-event-card">
		<div class="isceb-event-img-container" style="
			<?php if (has_post_thumbnail($event_template_data['event_post_id'])) : ?>
			background-image: url(<?php esc_attr_e(get_the_post_thumbnail_url($event_template_data['event_post_id'])) ?>);
			<?php else : ?>
			background-image: linear-gradient(160deg, #0093E9 0%, #80D0C7 100%);

			<?php endif; ?>
			">
		</div>
		<div class="isceb-event-message-box">
			<?php if ($isceb_event_countdown->invert == 0) : ?> 
				<?php if($isceb_event_countdown->d < 5) : ?>
					<h6 style="color: pink"><?php esc_html_e($isceb_event_countdown->d) ?> Days left</h6>
				<?php endif;?>
			<?php else : ?>
				<h6>Event has passed</h6>
			<?php endif; ?>
		</div>
		<div class="isceb-event-title">
			<h4><?php esc_html_e($isceb_wc_event->get_name()); ?></h4>
			<!-- <p><?php esc_html_e($isceb_event_description_trimmed) ?></p> -->
		</div>

		<div class="isceb-event-card-metadata">


			<?php if ($event_time_obj) : ?>
				<div class="isceb-event-card-date-time">
					<div class="isceb-event-card-date">
						<i class="far fa-calendar-alt"></i><?php esc_html_e($event_start_day_text) ?>
					</div>
					<div>
						<i class="far fa-clock"></i><?php esc_html_e($event_start_time_text) ?>
					</div>
				</div>
			<?php endif; ?>

			<?php if ($event_template_data['location_event'] && $event_template_data['location_event'][0] !== '') : ?>
				<i class="fas fa-map-marker-alt"></i><?php esc_html_e($isceb_event_location_trimmed) ?>
			<?php endif; ?>


			<?php if ($price_event != '') : ?>
				<div>
					<i class="fas fa-ticket-alt"></i><?php echo (isceb_get_price_html_zero_free($isceb_wc_event)) ?>
				</div>

			<?php endif; ?>
		</div>

		<div class="isceb-event-card-order-button">
			<p>Order</p>
			<i class="fa far fa-chevron-right isceb-event-card-arrow"></i>
		</div>
	</div>

</a>