<?php

/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

$container = get_theme_mod('understrap_container_type');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php understrap_body_attributes(); ?>>
	<?php do_action('wp_body_open'); ?>
	<div class="site" id="page">

		<!-- ******************* The Navbar Area ******************* -->
		<div id="wrapper-navbar">

			<a class="skip-link sr-only sr-only-focusable" href="#content"><?php esc_html_e('Skip to content', 'understrap'); ?></a>

			<nav id="main-nav" class="navbar navbar-expand-md navbar-light bg-primary shadow p-3 bg-white rounded font-weight-bold mr-auto" aria-labelledby="main-nav-label">


				<h2 id="main-nav-label" class="sr-only">
					<?php esc_html_e('Main Navigation', 'understrap'); ?>
				</h2>


				<div class="container-fluid">


					<!-- Your site title as branding in the menu -->
					<?php if (!has_custom_logo()) { ?>

						<?php if (is_front_page() && is_home()) : ?>

							<h1 class="navbar-brand mb-0"><a rel="home" href="<?php echo esc_url(home_url('/')); ?>" itemprop="url"><?php bloginfo('name'); ?></a></h1>

						<?php else : ?>

							<a class="navbar-brand" rel="home" href="<?php echo esc_url(home_url('/')); ?>" itemprop="url"><?php bloginfo('name'); ?></a>

						<?php endif; ?>

					<?php
					} else {
						the_custom_logo();
					}
					?>
					<!-- end custom logo -->

					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'understrap'); ?>">
						<span class="navbar-toggler-icon"></span>
					</button>

					<!-- The WordPress Menu goes here -->
					<?php
					wp_nav_menu(
						array(
							'theme_location'  => 'primary',
							'container_class' => 'collapse navbar-collapse',
							'container_id'    => 'navbarNavDropdown',
							'menu_class'      => 'navbar-nav mr-auto',
							'fallback_cb'     => '',
							'menu_id'         => 'main-menu',
							'depth'           => 2,
							'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
						)
					);
					?>
					<?php if ('container' === $container) : ?>
						<!-- .container -->
					<?php endif; ?>
					<?php if (function_exists("is_account_page") && is_user_logged_in()) : ?>
						<a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" class="MyAccountHeaderLink">
							<div class="MyAccountHeader">


								<div class="myAccountTextHeader">
									<?php
									$user_info = get_userdata(get_current_user_id());
									$first_name = $user_info->first_name;
									if ($first_name != '') {
										esc_html_e("Hi " . $first_name);
									}
									?>
								</div>
								<i class="fa fa-user-circle fa-2x"></i>
							</div>
						</a>
					<?php endif; ?>
					<?php if (function_exists("is_account_page") && !is_user_logged_in()) : ?>
						<a href="">Login</a>
					<?php endif; ?>
					<?php if (function_exists("is_shop") && is_shop()) : ?>
						<a href="<?php echo wc_get_cart_url(); ?>" class="shoppingCartHeaderLink">
							<div class="shoppingCartHeader">
								<i class="fa fa-shopping-cart fa-2x"></i>
								<span class="shoppingCartCount">
									<?php echo (WC()->cart->get_cart_contents_count()); ?>
								</span>
							</div>
						</a>
					<?php endif; ?>

					<form data-toggle="dropdown" role="search" method="get" id="searchform" class="searchform form-inline my-2 my-lg-0 " action="<?php echo home_url('/'); ?>">
						<input class="form-control mr-sm-2" type="search" name="s" id="s" placeholder="Search" style="width: 80%;" aria-label="Search">
						<button class="btn  my-2 my-sm-0" id="searchsubmit" type="button" form="searchform">
							<i class="fa fa-search" aria-hidden="true"></i>
						</button>
					</form>

				</div>


		</div><!-- #wrapper-navbar end -->