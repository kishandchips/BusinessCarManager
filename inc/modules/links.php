<?php if( $category ): ?>
<div class="links">
	<?php wp_list_bookmarks( array(
		'category' => $category,
		'limit' => 4,
		'show_images' => true,
		'show_name' => true,
		'show_description' => true,
		'title_li' => false,
		'title_before' => '<header class="links-header"><h6 class="title">',
		'title_after' => '</h6></header>',
		'category_before' => '',
		'category_after' => ''
	) ); ?>
</div>
<?php endif; ?>