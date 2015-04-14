<?php get_header(); ?>

<section id="page">
	<?php include_module('page-header', array(
		'title' => get_the_title()
	)); ?>
	
	<div class="sidebar-container container">
		<div class="sidebar-content">
			<div class="single-page">
				
				<div class="post-content">
					<?php the_content(); ?>
				</div>

			</div>

		</div>
		<?php get_sidebar(); ?>
	</div>
	
	<?php include_module('newsletter'); ?>
</section>

<?php get_footer(); ?>