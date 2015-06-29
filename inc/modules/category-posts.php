<?php 
$class = array('category-posts');
$class[] = ( !empty($color) ) ? $color : '';
?>
<div class="<?php echo implode(' ', $class); ?>">
	<div class="inner">
		<header class="header category-posts-header">
			<h6 class="title"><a href="<?php echo $url; ?>"><?php echo $name; ?></a></h6>
			<a href="<?php echo $url; ?>" class="secondary-btn btn"><?php echo sprintf(__("More %s", 'businesscarmanager'), $name); ?></a>
		</header>
		<div class="posts">
			<ul class="post-list">
				<?php foreach( $posts as $post_data ) : ?>
				<li class="post">
					<?php include_module('post-item', $post_data); ?>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</div>