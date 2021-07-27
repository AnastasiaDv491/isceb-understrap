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

	<div class="container-fluid" id="content">
		<div class="mainMessage">
			<h1>Welcome to ISCEB </h1>
			<p>
				Hello idth: 1200px;
				It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. e
			</p>
		</div>
		<section class="homepage-banners">
			<div class="container-banners">
				<div class="item">
					<div class="bannerCardImage" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.5)),url(http://localhost:8080/wpISCEB2/wp-content/uploads/2021/02/67676-scaled.jpg);">
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
					<div class="bannerCardImage" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.5)),url(http://localhost:8080/wpISCEB2/wp-content/uploads/2021/02/67676-scaled.jpg);">
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
					<div class="bannerCardImage" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.5)),url(http://localhost:8080/wpISCEB2/wp-content/uploads/2021/02/67676-scaled.jpg);">
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
					<div class="bannerCardImage" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.5)),url(http://localhost:8080/wpISCEB2/wp-content/uploads/2021/02/67676-scaled.jpg);">
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


		<section class="homepage-about">
			<div class="container-about">
				<h2>
					International Student Council of Economics and Business
				</h2>
				<p class="paragraph-about">
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam tristique tincidunt lorem non feugiat. Curabitur lobortis suscipit ligula, rutrum sollicitudin diam porta ut. Sed egestas vitae neque et volutpat. Cras in elit sed mi placerat rutrum a ut ex
				</p>
			</div>
			<div class="flex-container">
				<div class="item-about">
					<i class="fa fa-comment-o" aria-hidden="true" stye=""></i>
					<h2>What?</h2>
					<p class="paragraph-item-about">"Colour is a dance between your brain and the world. Every colour is a universe of its own, it unfolds differently and it evokes different feelings and emotions within us.”</p>
				</div>
				<div class="item-about">
					<i class="fa fa-comment-o" aria-hidden="true"></i>
					<h2>Why?</h2>

					<p class="paragraph-item-about">"Colour is a dance between your brain and the world. Every colour is a universe of its own, it unfolds differently and it evokes different feelings and emotions within us.”</p>
				</div>
				<div class="item-about">
					<i class="fa fa-comment-o" aria-hidden="true"></i>
					<h2>How?</h2>

					<p class="paragraph-item-about">"Colour is a dance between your brain and the world. Every colour is a universe of its own, it unfolds differently and it evokes different feelings and emotions within us.”</p>
				</div>
			</div>
		</section>

		<!-- <section class="homepage-meet-reps">
			<div class="container-meet-reps">
				<div class="container-image-meet-reps">
					<img class="image-meet-reps" src="http://localhost:8080/wpISCEB2/wp-content/uploads/2021/02/67676-scaled.jpg">
					<div class="list-meet-reps">
						<div class="list-meet-reps-item">Meet</div>
						<div class="list-meet-reps-item">Your</div>
						<div class="list-meet-reps-item">Student representatives</div>
					</div>
				</div>

			</div>
		</section>  -->


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
