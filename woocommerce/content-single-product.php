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
// var_dump(wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) )[0]);
// get_the_post_thumbnail_url($product->get_id(),'large');
?>


<?php if (isset($post_meta['_isceb_event']) && $post_meta['_isceb_event'][0] === 'yes') : ?>
	<div id="product-<?php the_ID(); ?>" <?php wc_product_class('isceb-event-hero-banner-wrapper', $product); ?>>
		<div class="isceb-event-hero-banner" style="
				background-image: url(<?php echo wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), "largest ")[0]; ?> );
				opacity:0.4;
				">

		</div>
		<div class="isceb-event-hero-banner-text"><?php echo $product->get_name(); ?></div>
	</div>

	<div class="isceb-event-detail-box-container">
		<div class="isceb-event-detail-box"><i class="far fa-calendar-alt fa-lg"></i>12th of October</div>
		<div class="isceb-event-detail-box"><i class="far fa-clock fa-lg"></i>12:00</div>
		<div class="isceb-event-detail-box"><i class="fas fa-map-marker-alt fa-lg"></i>KU Leuven Campus Brussel</div>
		<div class="isceb-event-detail-box"><i class="fas fa-user-alt fa-lg"></i>200 seats available</div>
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