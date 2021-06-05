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

		if(isset($_POST['username']) & validate_username($_POST['username'])){
			
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
		}
		else{
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
// The filter callback function.
function example_callback( $string) {
    // (maybe) modify $string.
	// var_dump($string);
	// error_log( print_r($string,true));
	// echo("hell");


	$string['Order'] = 
	
		["title" => 'Orders',
		 'icon' => 'fas fa-sign-out-alt'];
		// 'link' => 'http://localhost/www/my-account/orders/'];

	// var_dump($string);
    return $string;
}
add_filter( 'uwp_profile_tab_settings', 'example_callback', 10, 3 );

add_filter( 'uwp_account_all_tabs', 'example_callback', 10, 3 );

/* Add the following ot class-account.php*/
/*if($type == "Order"){
            // echo do_shortcode('[woocommerce_order_tracking]');
            woocommerce_account_orders( 1);
        }*/

/* Maybe even better, remove  add_action( 'uwp_account_form_display', array($this, 'display_form'), 10, 1 );
and then add function here (best in seperate plugin)*/

// remove_action('uwp_account_menu_display','uwp_add_account_menu_links');