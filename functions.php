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


add_filter('woocommerce_product_data_tabs', 'isceb_add_new_event_product_tab');

function isceb_add_new_event_product_tab($tabs)
{
	$tabs['isceb_event_tab'] = array(
		'label' => __('Events info', 'woocommerce'),
		'target' => 'isceb_events_tab',
		'class'    => array( 'hide_if_simple', 'hide_if_variable', 'hide_if_grouped', 'hide_if_external' ),
		'priority' => 10,
	);

	return $tabs;
}



/* Woocommerce testing */
/* First test add field in general*/
// add_action('woocommerce_product_options_general_product_data', 'isceb_create_start_date_fields');
add_action( 'woocommerce_product_data_panels', 'isceb_fill_new_events_tab' );
function isceb_fill_new_events_tab()
{

	// global $post, $product_object;

	// Dont forget to change the id in the div with your target of your product tab
	?><div id='isceb_events_tab' class='panel woocommerce_options_panel'><?php
		?><div class='options_group'><?php
		woocommerce_wp_text_input(
			array(
				'id' => 'isceb-start-of-event',
				'label' => __('Start of event', 'woocommerce'),
				'type'  => 'datetime-local'
			)
	
		);
	
		woocommerce_wp_text_input(
			array(
				'id'                => 'isceb-end-of-event',
				'label'             => __('End of event', 'woocommerce'),
				'placeholder'       => '',
				'type'              => 'datetime-local',
			)
		);
			
		?></div></div>
		<?php

	

}



// Save the start of the event date 
function isceb_save_product_custom_fields($post_id)
{
	// wp_set_object_terms( $post_id, 'isceb_event_product', 'product_type' );
	$product = wc_get_product($post_id);

	$custom_fields_event_start_date = isset($_POST['isceb-start-of-event']) ? $_POST['isceb-start-of-event'] : '';
	$product->update_meta_data('isceb-start-of-event', sanitize_text_field($custom_fields_event_start_date));

	$custom_fields_event_end_date = isset($_POST['isceb-end-of-event']) ? $_POST['isceb-end-of-event'] : '';
	$product->update_meta_data('isceb-end-of-event', sanitize_text_field($custom_fields_event_end_date));
	$product->save();

	
}
add_action('woocommerce_process_product_meta', 'isceb_save_product_custom_fields');



// add_action('save_post', 'wc_rrp_save_product');
// function wc_rrp_save_product($product_id)
// {
// 	// If this is a auto save do nothing, we only save when update button is clicked
// 	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
// 		return;
// 	if (isset($_POST['rrp_price'])) {
// 		if (is_numeric($_POST['rrp_price']))
// 			update_post_meta($product_id, 'rrp_price', $_POST['rrp_price']);

// 	} else delete_post_meta($product_id, 'rrp_price');

// 	var_dump($_POST['isceb-start-of-event']);


// 	if (isset($_POST['isceb-start-of-event'])) {
// 		if (is_numeric($_POST['isceb-start-of-event']))
// 			update_post_meta($product_id, 'isceb-start-of-event', $_POST['isceb-start-of-event']);

// 	} else delete_post_meta($product_id, 'isceb-start-of-event');
// }


/* Second test custom product type */
// add a product type
add_filter('product_type_selector', 'isceb_add_custom_product_type_event');
function isceb_add_custom_product_type_event($types)
{
	$types['isceb_event'] = __('Event');
	return $types;
}

// add_action('plugins_loaded', 'isceb_create_custom_product_type_event');
add_action('init', 'isceb_create_custom_product_type_event');
function isceb_create_custom_product_type_event()
{
	// declare the product class
	class WC_Product_isceb_event extends WC_Product
	{
		public function __construct($product)
		{
			$this->product_type = 'isceb_event';
			parent::__construct($product);
			// add additional functions here
		}

	}
}

function isceb_woocommerce_event_product_class( $classname, $product_type ) {
    if ( $product_type == 'WC_Product_Isceb_event' ) { // notice the checking here.
        $classname = 'WC_Product_isceb_event';
    }

    return $classname;
}

add_filter( 'woocommerce_product_class', 'isceb_woocommerce_event_product_class', 10, 2 );


// add_action('admin_footer', 'isceb_wc_show_tabs_on_custom_product');

/**
 * Show pricing fields for gift_coupon product.
 */
function isceb_wc_show_tabs_on_custom_product()
{
	if ('product' != get_post_type()) :
		return;
	endif;
?><script type='text/javascript'>
		jQuery(function($) {
			//for Price tab

			$('input#_downloadable, input#_virtual').on('change', function() {
				jQuery('.product_data_tabs .general_tab').addClass('show_if_variable_bulk').show();
				jQuery('#general_product_data').addClass('show_if_variable_bulk').show();
				jQuery('.show_if_simple').addClass('show_if_variable_bulk').show();
				//for Inventory tab
				jQuery('.inventory_options').addClass('show_if_variable_bulk').show();
				jQuery('#inventory_product_data ._manage_stock_field').addClass('show_if_variable_bulk').show();
				jQuery('#inventory_product_data ._sold_individually_field').parent().addClass('show_if_variable_bulk').show();
				jQuery('#inventory_product_data ._sold_individually_field').addClass('show_if_variable_bulk').show();
			});

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
