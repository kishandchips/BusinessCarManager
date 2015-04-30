<?php get_header(); ?>
<?php 
$category_id = get_query_var('cat');
$primary_category = get_category_primary_category($category_id);
$color = get_category_color($primary_category->term_id);
$sidebar = ( !empty($primary_category) ) ? 'category_header_'.$primary_category->term_id : '';
$label = ( !empty($primary_category) && $category_id != $primary_category->term_id ) ? $primary_category->name : '';
$category_description = category_description();
?>

<section id="category">
	<?php include_module('page-header', array(
		'color' => $color,
		'label' => $label,
		'title' => single_cat_title('', false),
		'sidebar' => $sidebar
	)); ?>

	<div class="sidebar-container container">
		<div class="sidebar-content">
			<?php if( $category_description && strpos( $category_description, '[' ) !== false ) : ?>
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