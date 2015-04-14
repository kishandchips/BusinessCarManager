<?php 
$class = array('page-header');
$class[] = ( !empty($color) ) ? $color : '';
$class[] = ( !empty($dropdown) ) ? 'has-dropdown' : 'no-dropdown';
?>
<header id="page-header" class="<?php echo implode(' ', $class); ?>">
	<div class="inner container">

		<?php if( !empty($label) ) : ?>
		<h6 class="label page-label"><?php echo $label; ?></h6>
		<?php endif; ?>
		
		<?php if( !empty($title) ) : ?>
		<h2 class="title page-title"><?php echo $title; ?></h2>
		<?php endif; ?>
		<?php if( !empty($dropdown) ) : ?>
		<a class="primary-btn dropdown-btn"><?php _e("View Sections", 'businesscarmanager'); ?></a>
		<div class="dropdown"><?php dynamic_sidebar('page_header'); ?></div>
		<?php endif; ?>
	</div>
</header>