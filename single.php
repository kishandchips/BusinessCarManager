<?php get_header(); ?>
<?php 
	$category = get_post_primary_category();
	$sub_category = get_post_sub_category();
	$color = ( !empty($category) ) ? get_category_color( $category->term_id ) : null;
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

	$restricted = ( get_post_meta( $post->ID, '_field_select__1', true) == 'yes' || get_field('restricted') ) && !is_user_logged_in();
?>
<section id="single">
	<?php include_module('page-header', array(
		'title' => $category->name,
		'color' => $color,
		'sidebar' => 'category_header_'.$category->term_id
	)); ?>
	<div class="post-header container">
		<h1 class="post-title title"><?php the_title(); ?></h1>
	</div>

	<div class="sidebar-container container">
		<div class="sidebar-content">
			<div class="single-post">
				<?php if( has_post_thumbnail() ) : ?>
				<figure class="wp-caption post-image thumbnail" >
					<?php the_post_thumbnail(); ?>
					<?php if( $caption = get_post( get_post_thumbnail_id($post->ID) )->post_excerpt ) : ?>
					<figcation class="wp-caption-text"><?php echo $caption; ?></figcation>
					<?php endif; ?>
				</figure>
				<?php endif; ?>
				<?php 
				$class = array('post-info');
				$class[] = $color;
				?>
				<div class="<?php echo implode(' ', $class); ?>">
					<?php include_module('post-category', array(
						'url' => get_term_link($sub_category),
						'name' => $sub_category->name
					)); ?>
					<div class="post-date">
						<span class="label"><?php _e("Posted", 'businesscarmanager'); ?></span>
						<span class="date value"><?php the_date(); ?></span>
					</div>
					<div class="post-author">
						<span class="label"><?php _e("Article By", 'businesscarmanager'); ?></span>
						<span class="author value">
							<?php 
							if( $author = get_field('author') ) :
								echo $author;
							else:
								the_author();
							endif;
							?>
						</span>
					</div>
					<div class="post-share">
						<?php include_module('share-links', array(
							'title' => get_the_title(),
							'url' => get_permalink(),
							'excerpt' => get_the_excerpt()
						)); ?>
					</div>
				</div>
				<div class="post-content">

					<?php if( $restricted ) : ?>
						<?php $content_array = get_extended($post->post_content); ?>

						<?php if($post->post_content!= $content_array['main']) : ?>
							<?php echo apply_filters('the_content', $content_array['main']); ?>
						<?php else: ?>
							<?php the_excerpt(); ?>
						<?php endif; ?>
						<div class="message">
							<p>The rest of this content is restricted to logged-in users. Please <a class="login-btn tertiary-btn" href="<?php echo site_url('login'); ?>">login</a> to continue reading. Can't log in to read the content? Don't panic! Our guys Will and Dario will sort you out. Email <a href="mailto:SFLFadmin@businesscarmanager.co.uk">SFLFadmin@businesscarmanager.co.uk</a>.</p>
						</div>
					<?php else: ?>

					<?php if( $verdict = get_field('verdict') ) : ?>
					<div class="verdict message"><?php echo $verdict; ?></div>
					<?php endif; ?>


					<?php the_content(); ?>
					<?php endif; ?>
				</div>

				<div class="post-misc">
					<?php if( !$restricted ) : ?>
					<?php wp_link_pages( array(
						'before' => '<div class="post-pagination"><span class="label">' . __( 'Continue Reading:' ) . '</span>',
						'after' => '</div>',
						'link_before' => '<span class="page-number">',
						'link_after'  => '</span>',
					)); ?> 
					<?php endif; ?>
					
					<?php include_module('share-links', array(
						'title' => get_the_title(),
						'url' => get_permalink(),
						'excerpt' => get_the_excerpt()
					)); ?>
				</div>
				<?php if( !$restricted ) : ?>
				<div class="post-comments">
					<?php comments_template(); ?>
				</div>
				<?php endif; ?>
				
				<?php if( has_tag() ) : ?>
				<div class="post-tags">
					<h6 class="title"><?php _e("More Reading", 'businesscarmanager'); ?></h6>
					<?php the_tags( '<ul class="tags"><li>', '</li><li>', '</li></ul>' ); ?>
				</div>
				<?php endif; ?>

				<?php if( $hubs ) : ?>
					<div class="post-hubs">
						<ul class="hubs-list">
							<?php foreach( $hubs as $hub ) : ?>
							<li>
								<a href="<?php echo get_permalink($hub->ID); ?>" class="primary-btn"><?php echo get_the_title($hub->ID); ?></a>
							</li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>

			</div>

			<div class="related-posts">
				<?php
				if( $related_posts = get_field('related_posts') ) :
					$posts = array();
					foreach( $related_posts as $_post) :
						setup_postdata($post);
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
					endforeach;

					wp_reset_postdata();

					include_module('category-posts', array(
						'name'  =>  __("Related Posts", 'businesscarmanager'),
						'color' => $color,
						'posts' => $posts
					));
				elseif( $primary_categories ) :

					foreach( $primary_categories as $primary_category ):
						if( in_category( $primary_category ) ) :
							$category = get_category( $primary_category );
							$related_posts = get_related_tag_posts_ids($post->ID, 3, $primary_category); 
							$color = get_category_color( $category->term_id);
							$query = new WP_Query( array('post__in' => $related_posts) );
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
						endif;
					endforeach; 
				endif;
				?>
			</div>
		</div>
		<?php get_sidebar(); ?>
	</div>
	<?php if( $hubs ) : ?>
	<div id="links" class="related-hub-links">
		<div class="inner container">
			<?php foreach( $hubs as $hub ) : ?>
			<?php include_module('links', array(
				'category' => get_field('primary_link_category', $hub->ID)
			)); ?>
			<?php endforeach; ?>
		</div>
	</div>
	<?php endif; ?>
	
	<?php include_module('newsletter'); ?>
</section>

<?php get_footer(); ?>