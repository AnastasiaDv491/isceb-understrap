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






/* Woocommerce testing */
/* First test add field in general*/
add_action('woocommerce_product_options_pricing', 'wc_rrp_product_field');
function wc_rrp_product_field()
{
	woocommerce_wp_text_input(array('id' => 'rrp_price', 'class' => 'wc_input_price short', 'label' => __('RRP', 'woocommerce') . ' (' . get_woocommerce_currency_symbol() . ')'));
}



add_action('save_post', 'wc_rrp_save_product');
function wc_rrp_save_product($product_id)
{
	// If this is a auto save do nothing, we only save when update button is clicked
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		return;
	if (isset($_POST['rrp_price'])) {
		if (is_numeric($_POST['rrp_price']))
			update_post_meta($product_id, 'rrp_price', $_POST['rrp_price']);
	} else delete_post_meta($product_id, 'rrp_price');
}

/* Second test custom product type */
// add a product type
add_filter('product_type_selector', 'wdm_add_custom_product_type');
function wdm_add_custom_product_type($types)
{
	$types['wdm_custom_product'] = __('Wdm Product');
	return $types;
}

add_action('plugins_loaded', 'wdm_create_custom_product_type');
function wdm_create_custom_product_type()
{
	// declare the product class
	class WC_Product_Wdm extends WC_Product
	{
		public function __construct($product)
		{
			$this->product_type = 'wdm_custom_product';
			parent::__construct($product);
			// add additional functions here
		}

		// public function get_type() {
		// 	return 'simple';
		//  }
	}
}

function wh_variable_bulk_admin_custom_js()
{

	if ('product' != get_post_type()) :
		return;
	endif;

	wp_enqueue_script('WC_CUSTOM_PRODUCT_SHOW_TABS', get_template_directory_uri() . '/js/wc_custom_product.js');
}

add_action('admin_enqueue_scripts', 'wh_variable_bulk_admin_custom_js');


add_action('admin_footer', 'gift_coupon_custom_js');
/**
 * Show pricing fields for gift_coupon product.
 */
/**
 * Show pricing fields for gift_coupon product.
 */
function gift_coupon_custom_js()
{
	if ('product' != get_post_type()) :
		return;
	endif;
?><script type='text/javascript'>
		jQuery(function($) {
			//for Price tab

			$('#product-type').on('change', function($) {
				console.log(this.value);
				console.log("tesst");
				jQuery('.product_data_tabs .general_tab').addClass('show_if_variable_bulk').show();
				jQuery('#general_product_data').addClass('show_if_variable_bulk').show();
				jQuery('.show_if_simple').addClass('show_if_variable_bulk').show();
				//for Inventory tab
				jQuery('.inventory_options').addClass('show_if_variable_bulk').show();
				jQuery('#inventory_product_data ._manage_stock_field').addClass('show_if_variable_bulk').show();
				jQuery('#inventory_product_data ._sold_individually_field').parent().addClass('show_if_variable_bulk').show();
				jQuery('#inventory_product_data ._sold_individually_field').addClass('show_if_variable_bulk').show();
			});

		});
	</script><?php
			}
