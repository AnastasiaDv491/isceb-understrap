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
remove_all_actions("woocommerce_after_single_product_summary");
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

add_theme_support('align-wide');

/* Not really the place, move to plugin */

add_action('admin_post_nopriv_isceb_new_user_registration', 'isceb_new_user_registration');
add_action('admin_post_isceb_new_user_registration', 'isceb_new_user_registration');
function isceb_new_user_registration()
{

	if (isset($_POST['isceb_csrf']) && wp_verify_nonce($_POST['isceb_csrf'], 'isceb-csrf')) {
		echo "hello";
		var_dump($_POST);

		$text_field_names = ['first_name', 'last_name', 'rnumber', 'email', 'phone'];

		if (isset($_POST['username']) & validate_username($_POST['username'])) {

			foreach ($text_field_names as $field_name) {
				$field_name = null;
				if (isset($field_name)) {
					echo ($field_name . ' is emtpy ');
				} else {
					wp_die(
						"Something went wrong during registration",
						"Error during registration",
						array(
							'response' 	=> 403,
						)
					);
				}
			}
		} else {
			wp_die(
				"Username for registration is invalid",
				"Error during registration",
				array(
					'response' 	=> 403,
				)
			);
		}
	}
}

/*UserWP test extension*/

/**
 * Usable hooks
 * ‘uwp_before_validate’ => Triggers before fields validation
 * ‘uwp_validate_result’ => Filter for additional validations
 * ‘uwp_after_validate’ => Triggers after validation
 * ‘uwp_before_extra_fields_save’ => Filter for modifying custom fields before save
 * ‘uwp_after_extra_fields_save’ => Filter for modifying custom fields after save
 * ‘uwp_after_custom_fields_save’ => Triggers after custom fields saved
 * ‘uwp_after_process_register’ => Triggers after registration is complete which
 */

/**
 * Add tab to edit account page
 * uwp_account_all_tabs
 */
add_filter('uwp_account_available_tabs', 'add_extra_tab_to_edit_account_page', 10, 3);
function add_extra_tab_to_edit_account_page($tabs)
{

	// 	["title" => 'Orders',
	// 	 'icon' => 'fas fa-sign-out-alt'];
	// 	// 'link' => 'http://localhost/www/my-account/orders/'];

	$new_tab = array('Order' => ["title" => 'Orders',	 'icon' => 'fas fa-sign-out-alt']);

	//Remove notifcations tab
	unset($new_tab["Notifications"]);

	

	$new_tabs = insertInArrayAfterPosition($tabs, $new_tab, 3);
	unset($new_tabs['notifications']);



	return $new_tabs;
}

function insertInArrayAfterPosition($array, $toInsertValue, $position)
{
	return array_slice($array, 0, $position, true) + $toInsertValue +  array_slice($array, $position, count($array) - 3, true);
}


add_filter('uwp_account_page_title', 'isceb_account_page_title_cb', 10, 2);
function isceb_account_page_title_cb($title, $type){
	if ( $type == 'Order' ) {
		$title = __( 'Your orders', 'uwp-messaging' );
	}

	return $title;
}





add_action('uwp_account_form_display', 'isceb_display_form', 20, 1);

/**
 * Extends the displays account form
 *
 * @since       1.0.0
 *
 * @param array $type Type of the form
 *
 */
function isceb_display_form($type)
{
	if ($type == "Order") {
		// echo do_shortcode('[woocommerce_order_tracking]');
		// woocommerce_account_orders( 1);
		woocommerce_account_orders(1);
	}
}

//

add_action('uwp_after_process_account','isceb_after_custom_field_save',30,1);
function isceb_after_custom_field_save($data){
	// error_log("hello");
	// error_log(print_r($action,true));
	// error_log(print_r($data,true));
	// error_log(print_r($result,true));
	// error_log(print_r($user_id,true));

	// var_dump($data);

}

// uwp_after_custom_fields_updated
// remove_action('uwp_account_menu_display','uwp_add_account_menu_links');