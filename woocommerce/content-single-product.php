<?php

/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
$post_meta = get_post_meta($product->get_id());
$event_seats = $product->get_stock_quantity();


function get_stock_variations_from_product()
{
	global $product;
	$post_meta = get_post_meta($product->get_id());
	$total_stock =0;
	switch ($product->get_type()) {
		case 'variable':
			if ($post_meta['_manage_stock'][0] === 'yes') {
				$total_stock = $product->get_stock_quantity();
			}
		
			else{
				$variations = $product->get_available_variations();

				foreach ($variations as $variation) {
					$variation_id = $variation['variation_id'];
					$variation_obj = new WC_Product_variation($variation_id);
					$total_stock += $variation_obj->get_stock_quantity();
				}
			}
			break;

		default:		
			$total_stock = $product->get_stock_quantity();
			break;
	}
	
	return $total_stock;
}

$event_location = $post_meta['isceb-location-of-event'][0];
$post_thumbnail_id = get_post_thumbnail_id($post->ID);
$event_time_obj_start = false;

if (!empty($post_meta['isceb-start-of-event'][0])) {
	$event_time_obj_start = strtotime($post_meta['isceb-start-of-event'][0]);
	//Check if we have a valid start time
	if ($event_time_obj_start) {
		//Check if we have end time
		if (!empty($post_meta['isceb-end-of-event'][0])) {
			//Check if we have a valid end time
			$event_time_obj_end = strtotime($post_meta['isceb-end-of-event'][0]);
			if ($event_time_obj_end) {
				//End time is valid
				//Check if the same month
				$event_month_start = date('F', $event_time_obj_start);
				$event_month_end = date('F', $event_time_obj_end);
				$event_month = '';
				if ($event_month_start !== $event_month_end) {
					$event_month = date('M', $event_time_obj_start) . ' - ' . date('M', $event_time_obj_end);
				} else {
					$event_month = 	$event_month_start;
				}

				//Check if the same day
				$event_day_start = date('j', $event_time_obj_start);
				$event_day_end = date('j', $event_time_obj_end);
				$event_day = '';
				if ($event_day_start !== $event_day_end) {
					$event_day = $event_day_start . ' - ' . $event_day_end;
				} else {
					$event_day = $event_day_start;
				}

				//get the start and end time
				$event_time_start = date('H:i', $event_time_obj_start);
				$event_time_end = date('H:i', $event_time_obj_end);
				$event_time = '';

				// Times are different and on different days
				if ($event_time_start !== $event_time_end) {
					$event_time = $event_time_start . ' - ' . $event_time_end;
				} elseif ($event_time_start === $event_time_end && $event_day_start !== $event_day_end) {
					$event_time = $event_time_start . ' - ' . $event_time_end;
				}
				// times are the same on the same day
				else {
					$event_time = $event_time_start;
				}

				$event_date_text = $event_day . ', ' . $event_month;
				$event_time_text = $event_time;
			} else {
				//End time is invalid only use start time
				$event_date_text = date('j F', $event_time_obj_start);
				$event_time_text = date('H:i', $event_time_obj_start);
			}
		} else {
			//We don't have and end time only use start time
			$event_date_text = date('j F', $event_time_obj_start);
			$event_time_text = date('H:i', $event_time_obj_start);
		}
	}
}

?>


<?php if (isset($post_meta['_isceb_event']) && $post_meta['_isceb_event'][0] === 'yes') :

?>
	<div id="product-<?php the_ID(); ?>" <?php wc_product_class('isceb-event-hero-banner-wrapper', $product); ?>>
		<div class="isceb-event-hero-banner" style="
		         opacity:0.4;
				<?php if ($post_thumbnail_id != 0) : ?>
				background-image: url(<?php echo wp_get_attachment_image_src($post_thumbnail_id, "largest ")[0]; ?> );
				<?php else : ?>
				background-image: linear-gradient(160deg, #0093E9 0%, #80D0C7 100%);

				<?php endif; ?>
				
				">

		</div>
		<div class="isceb-event-hero-banner-text"><?php echo $product->get_name(); ?></div>
	</div>

	<div class="isceb-event-detail-box-container">
		<?php if ($event_time_obj_start) : ?>
			<div class="isceb-event-detail-box"><i class="far fa-calendar-alt fa-lg"></i><?php echo $event_date_text ?></div>
			<div class="isceb-event-detail-box"><i class="far fa-clock fa-lg"></i><?php echo $event_time_text ?></div>
		<?php endif; ?>

		<?php if ($event_location !== '') : ?>
			<div class="isceb-event-detail-box"><i class="fas fa-map-marker-alt fa-lg"></i><?php echo $event_location; ?></div>
		<?php endif; ?>

		<?php if (get_stock_variations_from_product() !== null) :?>
		<div class="isceb-event-detail-box"><i class="fas fa-user-alt fa-lg"></i><?php echo get_stock_variations_from_product() ?> seats available</div>
		<?php endif; ?>
	</div>
	<div class="isceb-event-page-content-wrap">
		<div class="isceb-event-page-description">
			<?php echo $product->get_description(); ?>
		</div>
		<div class="isceb-event-page-tickets-wrap">
			<p>
				Tickets
			</p>
			<p></p>
		</div>
	</div>

<?php else : ?>

	<div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>

		<?php
		/**
		 * Hook: woocommerce_before_single_product_summary.
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */

		do_action('woocommerce_before_single_product_summary');
		?>

		<div class="summary entry-summary">
			<?php
			/**
			 * Hook: woocommerce_single_product_summary.
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 * @hooked WC_Structured_Data::generate_product_data() - 60
			 */
			do_action('woocommerce_single_product_summary');
			?>
		</div>

		<?php
		/**
		 * Hook: woocommerce_after_single_product_summary.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action('woocommerce_after_single_product_summary');
		// 
		?>
	</div>

	<?php do_action('woocommerce_after_single_product'); ?>


<?php endif; ?>