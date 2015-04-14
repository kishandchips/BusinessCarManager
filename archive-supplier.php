<?php get_header(); ?>
<?php $page_id = get_field('suppliers_page', 'options'); ?>
<section id="archive-supplier">
	<?php include_module('page-header', array(
		'title' => get_the_title($page_id)
	)); ?>
	<?php if( have_posts() ) : ?>
	<div class="container">
		<div class="suppliers">
			
			<div class="categories">
				<?php echo wp_list_categories(array('taxonomy' => 'supplier_category')); ?>
			</div>

			<?php $i = 0; ?>
			<?php while( have_posts() ) : the_post(); ?>
			
			<div class="supplier">
				<?php include_module('supplier-item', array(
					'title' => get_the_title(),
					'url' => get_permalink(),
					'image_url' => get_image(get_post_thumbnail_id(), array(450, 300))
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