<?php 
$class = array('hub-item');
?>
<div class="<?php echo implode(' ', $class); ?>">
	<a href="<?php echo $url; ?>" class="btn" >
		<?php if( !empty($image_url)) : ?>
		<figure class="hub-image image">
			<img src="<?php echo $image_url; ?>" />
		</figure>
		<?php endif; ?>
		<header class="header">
			<h5 class="hub-title title"><?php echo $title; ?></h5>				
			<div class="logo">
				<img src="<?php echo $logo_url; ?>" />
			</div>
		</header>
	</a>
</div>