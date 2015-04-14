<?php 
$class = array('cta-btn'); 
$class[] = ( !empty($description)) ? 'has-description' : 'no-description';
$class[] = ( !empty($color)) ? $color : '';
?>

<a href="<?php echo $url; ?>" class="<?php echo implode( ' ', $class); ?>">
	<h5 class="label"><?php echo $label; ?></h5>
	<?php if( !empty($description) ): ?>
	<span class="description"><?php echo $description; ?></span>
	<?php endif; ?>
</a>