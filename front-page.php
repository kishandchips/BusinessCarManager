<?php get_header(); ?>
<?php 
$primary_categories = get_field('primary_categories'); 
$secondary_categories = get_field('secondary_categories'); 
$template_directory_uri = get_template_directory_uri();
?>
<section id="front-page">
	<div class="sidebar-container container">
		<div class="sidebar-content">
			<?php if( $primary_categories ) : ?>
			<div class="primary-categories">
				<?php $i = 0; ?>
				<?php foreach( $primary_categories as $primary_category ) : ?>

				<?php if($i == 2) : ?>
				<ul class="cta-list">
					<li>
						<?php include_module('cta-btn', array(
							'label' => '<img src="'.$template_directory_uri.'/images/icons/mileage.png" /><br />'.__("Check you are paying the right business mileage", 'businesscarmanager'),
							'url' => 'http://www.businesscarmanager.co.uk/category/company-car-tax/business-mileage-advice/',
							'color' => 'dark-blue'
						)); ?>
					</li>
					<li>
						<?php include_module('cta-btn', array(
							'label' => '<img src="'.$template_directory_uri.'/images/icons/price.png" /><br />'.__("Get the Best Lease Price", 'businesscarmanager'),
							'url' => 'http://www.businesscarmanager.co.uk/car-leasing-prices/',
							'color' => 'dark-blue'
						)); ?>
					</li>
					<li>
						<?php include_module('cta-btn', array(
							'label' => '<img src="'.$template_directory_uri.'/images/icons/tax.png" /><br />'.__("Check out your Car Tax", 'businesscarmanager'),
							'url' => 'http://www.businesscarmanager.co.uk/company-car-tax-calculator/',
							'color' => 'dark-blue'
						)); ?>
					</li>
				</ul>
				<?php endif; ?>
				<?php 
				$category = get_category($primary_category); 
				$color = get_category_color($primary_category);
				$description = get_field('homepage_description', 'category_'.$category->term_id);

				if( strlen($description) > 140 ) {
					$description = substr($description, 0, 140).'...';
				}
				?>
				<div class="category">
					<?php include_module('category-item', array(
						'url' => get_term_link( $category ),
						'title' => $category->name, 
						'color' => $color,
						'description' => $description,
						'image_url' => get_image(get_field('homepage_image', 'category_'.$category->term_id), array(500, 250))
					)); ?>
				</div>
				<?php $i++; ?>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>

			<?php if( $secondary_categories ) : ?>
			<div class="secondary-categories">
				<?php foreach( $secondary_categories as $secondary_category ) : ?>
					<?php $category = get_category($secondary_category); ?>
					<?php $query = new WP_query( array('cat' => $secondary_category, 'posts_per_page' => 3) ); ?>
					<?php $posts = array(); ?>
					<?php while( $query->have_posts() ) :
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
							'date' => get_the_date()
						);
					endwhile;

					include_module('category-posts', array(
						'name'  =>  __("Latest", 'businesscarmanager').' '.$category->name,
						'url' => get_term_link( $category ),
						'posts' => $posts
					)); ?>

				<?php endforeach; ?>
			</div>
			<?php endif; ?>
		</div>
		<?php get_sidebar(); ?>
	</div>

	<?php include_module('newsletter'); ?>
</section><!-- #front-page -->
<?php get_footer(); ?>