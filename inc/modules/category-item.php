<?php 
$class = array('category-item');
$class[] = $color;
?>
<div class="<?php echo implode( ' ', $class); ?>">
	<a class="btn" href="<?php echo $url; ?>">
		<figure class="image">
			<img src="<?php echo $image_url; ?>" />
		</figure>
		<header class="header">
			<h5 class="title"><?php echo $title; ?></h5>
			<div class="description"><?php echo $description; ?></div>
		</header>
	</a>
</div>