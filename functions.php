<?php

/**
 * UnderStrap functions and definitions
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

// UnderStrap's includes directory.
$understrap_inc_dir = get_template_directory() . '/inc';

// Array of files to include.
$understrap_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker. Trying to get deeper navigation? Check out: https://github.com/understrap/understrap/issues/567.
	'/editor.php',                          // Load Editor functions.
	'/deprecated.php',                      // Load deprecated functions.
	'/gutenberg.php',
);

// Load WooCommerce functions if WooCommerce is activated.
if (class_exists('WooCommerce')) {
	$understrap_includes[] = '/woocommerce.php';
}

// Load Jetpack compatibility file if Jetpack is activiated.
if (class_exists('Jetpack')) {
	$understrap_includes[] = '/jetpack.php';
}

// Include files.
foreach ($understrap_includes as $file) {
	require_once $understrap_inc_dir . $file;
}


/* Our own code */

remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);


//Update shopping cart amount automatically
add_filter('woocommerce_add_to_cart_fragments', 'iconic_cart_count_fragments', 10, 1);
function iconic_cart_count_fragments($fragments)
{
	$fragments['span.shoppingCartCount'] = '<span class="shoppingCartCount">' . WC()->cart->get_cart_contents_count() . '</span>';
	return $fragments;
}



//There is probably a better way but i can't find it
add_action('woocommerce_single_product_summary', 'action_woocommerce_single_product_summary', 10, 2);
// define the woocommerce_single_product_summary callback 
function action_woocommerce_single_product_summary($array)
{
	global $product;
	wc_display_product_attributes($product);
};



add_filter('woocommerce_get_breadcrumb', 'isceb_wc_remove_uncategorized_from_breadcrumb');
/**
 * Remove uncategorized from the WooCommerce breadcrumb.
 * 
 * @param  Array $crumbs    Breadcrumb crumbs for WooCommerce breadcrumb.
 * @return Array   WooCommerce Breadcrumb crumbs with default category removed.
 */
function isceb_wc_remove_uncategorized_from_breadcrumb($crumbs)
{
	$category 	= get_option('default_product_cat');
	$caregory_link 	= get_category_link($category);

	foreach ($crumbs as $key => $crumb) {
		if (in_array($caregory_link, $crumb)) {
			unset($crumbs[$key]);
		}
	}

	return array_values($crumbs);
}

//Only show the woocommerce stuff we need on the single product page
// remove_all_actions("woocommerce_after_single_product_summary");
// remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);


add_theme_support('align-wide');




function woocommerce_custom_fields_display()
{
	global $product;
	// $product = wc_get_product($post->ID);
	// $custom_fields_woocommerce_start_title = $product->get_meta('isceb-start-of-event');

	// $custom_fields_woocommerce_end_title = $product->get_meta('isceb-end-of-event');
	// if ($custom_fields_woocommerce_title) {
	// 	printf(
	// 		'<div id="isceb-start-of-event"><label>%s</label></div>',
	// 		'<div id="isceb-end-of-event"><label>%s</label></div>',
	// 		esc_html($custom_fields_woocommerce_start_title),
	// 		esc_html($custom_fields_woocommerce_end_title)
	// 	);
	// }

	$custom_field = get_post_meta($product->get_id(), 'isceb-start-of-event', true);
	if (!empty($custom_field))
		$exampleDate = strtotime($custom_field);
	$newDate = date('l jS \of F Y h:i A', $exampleDate);
	$newDate2 = date('l jS \of F Y h:i A', $exampleDate);

	echo  '<strong>Start of the event: <p id="isceb-start-of-event" class="isceb-event-date">' . $newDate . '</p></strong>';

	$custom_field2 = get_post_meta($product->get_id(), 'isceb-end-of-event', true);
	if (!empty($custom_field2))
		echo '<strong>End of the event: <p id="isceb-end-of-event" class="isceb-event-date">' . $newDate2 . '</p></strong>';
}

add_action('woocommerce_single_product_summary', 'woocommerce_custom_fields_display');
