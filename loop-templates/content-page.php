<?php

/**
 * Partial template for content in page.php
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

	</header><!-- .entry-header -->

	<?php echo get_the_post_thumbnail($post->ID, 'large'); ?>

	<div class="entry-content isceb-standard-page-container">
		<div class="isceb-standard-page-title-container">
			
			<?php the_title('<h1 class="entry-title isceb-standard-page-header">', '</h1>'); ?>
			
		</div>
			

		<div>
			<?php the_content(); ?>
		</div>

		<?php
			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . __('Pages:', 'understrap'),
					'after'  => '</div>',
				)
			);
			?>	

<?php edit_post_link(__('Edit', 'understrap'), '<span class="edit-link">', '</span>'); ?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">



	</footer><!-- .entry-footer -->

</article><!-- #post-## -->