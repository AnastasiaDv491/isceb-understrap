<?php

/**
 * Template Name: ISCEB Homepage
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
$container = get_theme_mod('understrap_container_type');


?>

<div class="wrapper" id="full-width-page-wrapper">

	<div class="<?php echo esc_attr($container); ?>" id="content">
		<div class="mainMessage">
			<h1>Welcome to ISCEB </h1>
			<p>
				Hello idth: 1200px;
				It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. e
			</p>
		</div>
		<section class="homepage-banners">
			<div class="container-banners">
				<!-- <div class="item">
					<div class="bannerCardText">
						<h2>Welcome! </h2>
						<p>
							Hello idth: 1200px;
							It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. e
						</p>
					</div>
				</div> -->
				<div class="item">
					<div class="bannerCardImage" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.5)),url(http://localhost:8080/wpISCEB2/wp-content/uploads/2021/02/67677-7-scaled.jpg);">
					</div>
					<div class="bannerCardTag">
						<p class="banerTagText">Education</p>
					</div>
					<div class="bannerCardContent">
							<h3 class="bannerCardTitle">Event 1</h3>
							<p class="bannerCardDescription">It is a long established fact that</p>
							<button class="bannerCardButton">More Info</button>
					</div>						
				</div>
				<div class="item">
					<div class="bannerCardImage" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.5)),url(http://localhost:8080/wpISCEB2/wp-content/uploads/2021/02/67677-7-scaled.jpg);">
					</div>
					<div class="bannerCardTag">
						<p class="banerTagText">Diversity</p>
					</div>
					<div class="bannerCardContent">
							<h3 class="bannerCardTitle">Event 2</h3>
							<p class="bannerCardDescription">It is a long established fact that</p>
							<button class="bannerCardButton">More Info</button>
					</div>
				</div>
				<div class="item">
					<div class="bannerCardImage" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.5)),url(http://localhost:8080/wpISCEB2/wp-content/uploads/2021/02/67677-7-scaled.jpg);">
					</div>
					<div class="bannerCardTag">
						<p class="banerTagText">Development</p>
					</div>
					<div class="bannerCardContent">
							<h3 class="bannerCardTitle">Event 3</h3>
							<p class="bannerCardDescription">It is a long established fact that</p>
							<button class="bannerCardButton">More Info</button>
					</div>
				</div>
				<div class="item">
					<div class="bannerCardImage" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.5)),url(http://localhost:8080/wpISCEB2/wp-content/uploads/2021/02/67677-7-scaled.jpg);">
					</div>
					<div class="bannerCardTag">
						<p class="banerTagText">Incoming</p>
					</div>
					<div class="bannerCardContent">
							<h3 class="bannerCardTitle">Event 4</h3>
							<p class="bannerCardDescription">It is a long established fact that</p>
							<button class="bannerCardButton">More Info</button>
					</div>
				</div>
			</div>

		</section>

		<section class="homepage-help-bar">
			<div class="container-help">
				<div class="wrapper-help-button">
					<button class="help-button">
						<h2 class="help-button-text">
							Do you need our help? Click here to contact us!
						</h2>
					</button>
				</div>
			</div>
		</section>


		<div class="row">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main" role="main">

					<?php
					while (have_posts()) {
						the_post();
						get_template_part('loop-templates/content', 'page');

						// If comments are open or we have at least one comment, load up the comment template.
						if (comments_open() || get_comments_number()) {
							comments_template();
						}
					}
					?>

				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row end -->

	</div><!-- #content -->

</div><!-- #full-width-page-wrapper -->

<?php
get_footer();
