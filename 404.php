<?php get_header(); ?>

<section id="error">

	<div class="inner container">
		<div class="post-content">
			<h4 class="uppercase text-center"><?php _e("404 error - Page not found", 'businesscarmanager'); ?></h4>
			<h2 class="uppercase text-center"><?php _e("You appear to have taken a wrong turn...", 'businesscarmanager'); ?></h2>
			<p class=" text-center"><?php _e("The page you are looking for is not here. It may have been deleted, or the address might have been miss-typed. Either way, let’s get you back on track...", 'businesscarmanager'); ?></p>
			<p class=" text-center"><?php _e("You can use the navigation bar above, or:", 'businesscarmanager'); ?></p>
			<p class=" text-center">
				<a class="primary-btn" href="<?php bloginfo('url') ?>"><?php _e("Go to the Homepage", 'businesscarmanager'); ?> </a>
			</p>
		</div>
	</div>
</section>

<?php get_footer(); ?>