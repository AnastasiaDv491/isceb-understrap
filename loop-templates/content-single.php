<?php

/**
 * Single post partial template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
		<div class="entry-content">

			<?php
			understrap_link_pages();
			the_content();


			?>
			<div class="entry-meta">

				<?php understrap_posted_on(); 
				

				// var_dump(understrap_posted_on());
				?>


			</div><!-- .entry-meta -->

		</div><!-- .entry-content -->

	</header><!-- .entry-header -->

	<footer class="entry-footer">

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->