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
				<?php


				$args = array(
					'numberposts' => 4,
					'category' => get_cat_ID('Front Page news')
				);

				$isceb_latest_news = get_posts($args);

				foreach ($isceb_latest_news as $news_item) :

				?>
					<a href="<?php echo esc_url(get_permalink($news_item)) ?>">
						<div class="item">
							<div class="bannerCardImage" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.5)),url(<?php echo esc_url(get_the_post_thumbnail_url($news_item)); ?>);">
							</div>
							<?php if (get_the_tags($news_item)) : ?>
								<div class="bannerCardTag">
									<p class="banerTagText"><?php echo esc_html(get_the_tags($news_item)[0]->name); ?></p>
								</div>
							<?php endif; ?>
							<div class="bannerCardContent">
								<h3 class="bannerCardTitle"><?php echo esc_html($news_item->post_title); ?></h3>
								<p class="bannerCardDescription"><?php echo esc_html($news_item->post_excerpt); ?></p>

								<button class="bannerCardButton">More Info</button>


							</div>
						</div>
					</a>
				<?php endforeach; ?>

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
						get_template_part('loop-templates/content', 'home');

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
