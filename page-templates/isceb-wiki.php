<?php

/**
 * Template Name: ISCEB WIKI Home
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
$container = get_theme_mod('understrap_container_type');

if (is_front_page()) {
    get_template_part('global-templates/hero');
}
?>

<div class="wrapper" id="full-width-page-wrapper">

    <div class="container-fluid">


        <header class="isceb-wiki-home-header">
            <h1 id="isceb-wiki-home-search-headerText">Welcome to ISCEB WIKI! </h1>

            <div id="isceb-wiki-home-search-wrap">
                <input type="text" id="isceb-wiki-home-search-field" name="searchText" placeholder=" What are you looking for?">
                <button type="button" id="isceb-wiki-home-search-button" class="btn btn-secondary">Search</button>
            </div>
        </header>

        <main class="site-main" id="main" role="main">

            <div class="isceb-grid-container">

            </div>

        </main><!-- #main -->




    </div>
</div><!-- #full-width-page-wrapper -->

<?php
get_footer();
