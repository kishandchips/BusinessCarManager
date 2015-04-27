<?php get_header(); ?>
<?php 
	$category = get_post_primary_category();
	$sub_category = get_post_sub_category();
	$primary_categories = get_field('primary_categories', 'options');
	$tag_ids = wp_get_post_tags( get_the_ID(), array( 'fields' => 'ids' ) );
	$hubs = get_posts(array(
		'post_type' => 'hub', 
		'meta_query' => array(
			array(
				'key' => 'post_tag',
				'value'    => $tag_ids,
				'operator' => 'IN'
			)
		)
	));
	$page_id = get_field('suppliers_page', 'options');
?>
<section id="single-supplier">
	<?php include_module('page-header', array(
		'title' => get_the_title($page_id)
	)); ?>
	<div class="supplier-header container">
		<h1 class="supplier-title title"><?php the_title(); ?></h1>
	</div>

	<div class="sidebar-container container">
		<div class="sidebar-content">
			<div class="single-supplier">
				
				<div class="supplier-info">
					<figure class="supplier-image">
						<?php the_post_thumbnail(); ?>
					</figure>
					<div class="supplier-address">
						<div class="address"><?php the_field('address'); ?></div>
					</div>
					<div class="supplier-contact">
						<?php if( $phone_number = get_field('phone_number') ) : ?>
						<div class="phone-number"><b>T:</b> <?php echo $phone_number; ?></div>
						<?php endif; ?>
						<?php if( $email_address = get_field('email_address') ) : ?>
						<div class="email-address"><b>E:</b> <a href="mailto:<?php echo $email_address; ?>"> <?php echo $email_address; ?></a></div>
						<?php endif; ?>
						<?php if( $website_url = get_field('website_url') ) : ?>
						<div class="website" ><a href="<?php echo $website_url; ?>" target="_blank"> <?php echo preg_replace('#^https?://#', '', $website_url); ?></a></div>
						<?php endif; ?>
					</div>
					<div class="supplier-share">
						<?php if( $facebook_url = get_field('facebook_url') ) : ?>
						<div class="facebook" ><a href="<?php echo $facebook_url; ?>" target="_blank"><i class="icon-facebook"></i><?php _e("Find us on Facebook", 'businesscarmanager');?></a></div>
						<?php endif; ?>
						<?php if( $linkedin_url = get_field('linkedin_url') ) : ?>
						<div class="linkedin" ><a href="<?php echo $linkedin_url; ?>" target="_blank"><i class="icon-linkedin"></i><?php _e("Find us on LinkedIn", 'businesscarmanager');?></a></div>
						<?php endif; ?>
						<?php if( $twitter_url = get_field('twitter_url') ) : ?>
						<div class="twitter" ><a href="<?php echo $twitter_url; ?>" target="_blank"><i class="icon-twitter"></i><?php _e("Follow us on Twitter", 'businesscarmanager');?></a></div>
						<?php endif; ?>
					</div>
				</div>
				<div class="post-content">

					<?php the_content(); ?>
				</div>

				<?php if( has_tag() ) : ?>
				<div class="supplier-tags">
					<h6 class="title"><?php _e("More Reading", 'businesscarmanager'); ?></h6>
					<?php the_tags( '<ul class="tags"><li>', '</li><li>', '</li></ul>' ); ?>
				</div>
				<?php endif; ?>

			</div>
		</div>
		<?php get_sidebar(); ?>
	</div>
	
	
	<?php include_module('newsletter'); ?>
</section>

<?php get_footer(); ?>