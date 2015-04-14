<?php
/**
 * The template for displaying the sidebar.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package businesscarmanager
 * @since businesscarmanager 1.0
 */
?>

<div id="sidebar" class="sidebar" role="complementary">
	<div class="inner">
		<?php dynamic_sidebar( 'sidebar' ); ?>
	</div>
</div><!-- #sidebar -->