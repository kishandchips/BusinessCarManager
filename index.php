<?php get_header(); ?>
<?php 
$title = __("Archive", 'businesscaramanager');

if( is_search() ) {
	$title = __("Search results for: ", 'businesscaramanager') . get_search_query();
} elseif ( is_tag() ) {
	$title = single_tag_title('', false);
}
?>
<section id="index">
	<?php include_module('page-header', array(
		'title' => $title
	)); ?>

	<div class="sidebar-container container">
		<div class="sidebar-content">
			
			<?php if( have_posts() ) : ?>
			<div class="posts">
				<?php $i = 0; ?>
				<?php while( have_posts() ) : the_post(); ?>
				<?php 
				$image_url = get_image(get_post_thumbnail_id(), array(500, 500));
				$category = get_post_primary_category();
				$color = get_category_color($category->term_id);
				$category_data = array();
				if( $category ) :
					$category_data = array(
						'name' => $category->name,
						'url' => get_term_link( $category )
					);
				endif;
				?>
				<div class="post">
					<?php include_module('post-item', array(
						'title' => get_the_title(),
						'url' => get_permalink(),
						'image_url' => $image_url,
						'category' => $category_data,
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
</section><!-- #index -->
<?php get_footer(); ?>