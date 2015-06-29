<?php 
$sflf_category = get_field('sflf_category', 'options'); 
$is_sflf_category = is_sflf_category();
$class = array('newsletter');
$class[] = ($is_sflf_category) ? 'sflf-category' : '';
?>
		
<div id="newsletter" class="<?php echo implode( ' ', $class); ?>">
	<div class="inner container">
		<header class="newsletter-header">
			<h6 class="title"><?php _e("Newsletter", 'businesscarmanager'); ?></h6>
		</header>		
		<div class="content">
			<h4 class="description">
				<?php if( $is_sflf_category ) : ?>
				<?php echo sprintf( __('Get the latest from %s, delivered to your inbox.', 'businesscarmanager'), get_cat_name($sflf_category) ); ?>
				<?php else: ?>
				<?php echo sprintf( __('Get the latest from %s, all <b>free</b> and delivered to your inbox.', 'businesscarmanager'), get_bloginfo( 'name' ) ); ?>
				<?php endif; ?>
			</h4>

			<ul class="tick-list key-points">
				<li><?php _e("Company Car News", 'businesscarmanager'); ?></li>
				<li><?php _e("Car Reviews", 'businesscarmanager'); ?></li>
				<li><?php _e("Tax information", 'businesscarmanager'); ?></li>
				<li><?php _e("Small Fleet Management Updates", 'businesscarmanager'); ?></li>
			</ul>
			<a class="secondary-btn signup-btn" href="<?php echo get_permalink(get_field('subscribe_page', 'options')); ?>"><?php _e("Sign Up", 'businesscarmanager'); ?></a>
		</div>
		<span class="image"></span>
	</div>
</div>