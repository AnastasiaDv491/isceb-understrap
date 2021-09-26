<?php
/**
 * Single post partial template
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
echo 'hello<br><br>';
global $event_template_data;
print_r($event_template_data);

$isceb_wc_event = wc_get_product( $event_template_data['event_post_id']);
var_dump(wc_get_product( $event_template_data['event_post_id']));

?>



<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<header class="entry-header">

		<h1 class="entry-title"><?php echo $isceb_wc_event->get_name()?> </h1>
		<?php echo $isceb_wc_event->get_price()?>


	</header><!-- .entry-header -->


	<div class="entry-content">

		<?php the_content(); ?>

		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
				'after'  => '</div>',
			)
		);
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
