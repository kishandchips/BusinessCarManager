<?php get_header(); ?>
<?php 
$primary_categories = get_field('primary_categories', 'options'); 
$post_tag = get_field('post_tag');
$categories = get_field('categories'); 
$primary_link_category = get_field('primary_link_category');
$logo_url = get_image( get_field('logo'), array(180, 180));
?>
<section id="single-hub" >
	
	<div class="sidebar-container container">
		<div class="sidebar-content">
			<?php 
			$class = array('single-hub');
			$class[] = ($logo_url) ? 'has-logo' : '';
			?>
			<div class="<?php echo implode( ' ', $class); ?>">
				<figure class="hub-image thumbnail" >
					<?php the_post_thumbnail(array(1000, 320)); ?>						
				</figure>
				<header class="hub-header header">
					<?php if( $logo_url ): ?>
					<div class="logo"><img src="<?php echo $logo_url; ?>" /></div>
					<?php endif; ?>
					<h4 class="title"><?php the_title(); ?></h4>
					<div class="excerpt">
						<?php the_excerpt(); ?>
					</div>
				</header>
				<?php $query = new WP_Query(array('tag__in' => get_field('post_tag'), 'posts_per_page' => 5)) ?>
				<?php if( $query ->have_posts() ) : ?>
				<div class="related-posts">
					<?php while( $query->have_posts() ) : $query->the_post(); ?>
					<?php 
					$image_url = get_image(get_post_thumbnail_id(), array(500, 500));
					$category = get_post_primary_category();
					$color = get_category_color( $category->term_id);
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
					<?php endwhile; ?>
				</div>
				<?php endif; ?>
				<?php if($categories): ?>
				<div class="related-category-posts">
					<?php
					foreach( $categories as $category_id ):
						$category = get_category( $category_id );
						$primary_category = get_top_level_category( $category_id );
						$color = get_category_color( $primary_category->term_id);
						$query = new WP_Query( array(
							'posts_per_page' => 3,
							'tax_query' => array(
								array(
									'taxonomy' => 'category',
									'field'    => 'id',
									'terms'    => array($category_id),
									'operator' => 'IN'
								)
							)
						) );
						$posts = array();

						if( $query->have_posts() ) :

							while( $query->have_posts() ) :
								$query->the_post();

								$sub_category = get_post_sub_category();

								$posts[] = array(
									'title' => get_the_title(),
									'url' => get_permalink(),
									'image_url' => get_image( get_post_thumbnail_id(), array(300, 250) ),
									'category' => array(
										'name' => $sub_category->name,
										'url' => get_term_link($sub_category)
									),
									'date' => get_the_date(),
									'color' => $color
								);
							endwhile;

							include_module('category-posts', array(
								'name'  =>  $category->name,
								'url' => get_term_link( $category ),
								'color' => $color,
								'posts' => $posts
							));

							//wp_reset_query();
							wp_reset_postdata();
						endif;
					endforeach; 
					?>
				</div>
				<?php endif; ?>
			</div>
		</div>
		<?php get_sidebar(); ?>
	</div>

	<div id="links" class="related-hub-links">
		<div class="inner container">
			<?php include_module('links', array(
				'category' => $primary_link_category
			)); ?>
		</div>
	</div>
		
	<?php include_module('newsletter'); ?>
</section>

<?php get_footer(); ?>