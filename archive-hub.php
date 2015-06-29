<?php get_header(); ?>
<?php 
$page_id = get_field('hubs_page', 'options'); 
$title = ( is_tax('hub_category') ) ? single_cat_title('', false) : get_the_title($page_id);
?>
<section id="archive-hub">
	<?php include_module('page-header', array(
		'title' => $title
	)); ?>
	<?php if( have_posts() ) : ?>
	<div class="container">
		<div class="hubs">
			
			<?php $i = 0; ?>
			<?php while( have_posts() ) : the_post(); ?>
			
			<div class="hub">
				<?php include_module('hub-item', array(
					'title' => get_the_title(),
					'url' => get_permalink(),
					'image_url' => get_image(get_post_thumbnail_id(), array(450, 300)),
					'logo_url' => get_image( get_field('logo'), array(85, 85))
				)); ?>
			</div>
			<?php $i++; ?>
			<?php endwhile; ?>
		</div>
	
		<?php include_module('pagination'); ?>
	</div>
	<?php endif; ?>
	<?php include_module('newsletter'); ?>
</section><!-- #index -->
<?php get_footer(); ?>