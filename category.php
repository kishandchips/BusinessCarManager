<?php get_header(); ?>
<?php 
$category_id = get_query_var('cat');
$color = get_category_color($category_id);

die('category_header_'.$category_id);
?>
<section id="category">
	<?php include_module('page-header', array(
		'color' => $color,
		'title' => single_cat_title('', false),
		'sidebar' => 'category_header_'.$category_id
	)); ?>

	<div class="sidebar-container container">
		<div class="sidebar-content">
			
			<?php if( $category_description = category_description() ) : ?>
			<div class="category-description">
				<?php echo do_shortcode($category_description); ?>
			</div>
			<?php endif; ?>
			<?php if( have_posts() ) : ?>
			<div class="posts">
				<?php $i = 0; ?>
				<?php while( have_posts() ) : the_post(); ?>
				<?php 
				$image_url = ( $i < 7 ) ? get_image(get_post_thumbnail_id(), array(500, 500)) : null;
				$category = get_post_sub_category();
				?>
				<div class="post">
					<?php include_module('post-item', array(
						'title' => get_the_title(),
						'url' => get_permalink(),
						'image_url' => $image_url,
						'category' => array(
							'name' => $category->name,
							'url' => get_term_link( $category )
						),
						'date' => get_the_date(),
						'color' => $color
					)); ?>
				</div>
				<?php $i++; ?>
				<?php endwhile; ?>
			</div>
			<?php include_module('pagination'); ?>
			<?php endif; ?>
		</div>
		<?php get_sidebar(); ?>
	</div>

</section>
<?php include_module('newsletter'); ?>
<?php get_footer(); ?>