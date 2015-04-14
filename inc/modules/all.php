<h1>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do</h1>
<h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do</h2>
<h3>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do</h3>
<h4>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do</h4>
<h5>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do</h5>
<h6>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do</h6>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
<hr />
<p>
	<a class="primary-btn">Primary Button</a>
	<button class="primary-btn">Primary Button</button>
</p>
<p>
	<a class="secondary-btn">Secondary Button</a>
	<button class="secondary-btn">Secondary Button</button>
</p>
<p>
	<a class="tertiary-btn">Tertiary Button</a>
	<button class="tertiary-btn">Tertiary Button</button>
</p>

<input type="text" value="This is a value" />
<input type="text" placeholder="This is a placeholder" />
<textarea placeholder="This is a placeholder"></textarea>
<select>
	<option>Lorem ipsum dolor sit amet</options>
	<option>Lorem ipsum dolor sit amet</options>
	<option>Lorem ipsum dolor sit amet</options>
	<option>Lorem ipsum dolor sit amet</options>
	<option>Lorem ipsum dolor sit amet</options>
	<option>Lorem ipsum dolor sit amet</options>
</select>
<?php get_search_form(); ?>
<?php include_module('social-links'); ?>

<div class="advert">
	<img src="http://lorempixel.com/300/250" />
</div>
<?php include_module('post-item', array(
	'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor',
	'url' => '#',
	'image_url' => 'http://lorempixel.com/300/250',
	'category' => array(
		'name' => 'Category',
		'url' => '#'
	),
	'date' => 'hello',
	'color' => 'purple'
)); ?>
<br />
<br />
<?php include_module('category-posts', array(
	'name'  => 'Namesdfsdf',
	'url' => '#',
	'color' => 'purple'
)); ?>

<a class="cta-btn orange" style="width: 320px;" >
	<h5 class="label">Excepteur sint</h5>
	<span class="description">Excepteur sint occaecat cupidatat non proident</span>
</a>
<a class="cta-btn yellow" style="width: 320px;">
	<h5 class="label">A label</h5>
	<span class="description">Excepteur sint occaecat cupidatat non </span>
</a>
<a class="cta-btn green" style="width: 320px;">
	<h5 class="label">A label</h5>
	<span class="description">Excepteur sint occaecat cupidatat non </span>
</a>
<a class="cta-btn" style="width: 320px;">
	<h5 class="label">A label</h5>
	<span class="description">Excepteur sint occaecat cupidatat non </span>
</a>

<div class="widget_image_button" style="width: 300px;">
	<a href="#" class="image-btn">
		<div class="image" >
			<img src="http://lorempixel.com/300/250" />
		</div>
		<h6 class="title">Lorem ipsum dolor sit amet, consectetur adipisicing</h6>
		<span class="label">this is the <b>button label</b></span>
	</a>
</div>

<div class="widget_newsletter" style="width: 300px;">
	<div class="newsletter">

		<h5 class="description"><?php _e('Get the latest from Business Car Manager, all <b>free</b> and delivered to your inbox.', 'businesscarmanager'); ?></h5>

		<ul class="tick-list key-points">
			<li><?php _e("Company Car News", 'businesscarmanager'); ?></li>
			<li><?php _e("Car Reviews", 'businesscarmanager'); ?></li>
			<li><?php _e("Tax information", 'businesscarmanager'); ?></li>
			<li><?php _e("Small Fleet Management Updates", 'businesscarmanager'); ?></li>
		</ul>
		<a class="secondary-btn signup-btn" href="<?php echo get_permalink(get_field('newsletter_page', 'options')); ?>"><?php _e("Sign Up", 'businesscarmanager'); ?></a>
		<span class="image"></span>
	</div>
</div>
<div class="widget_links" style="width: 300px;">
	<div class="links">
		<?php wp_list_bookmarks( array('
			category' => 2,
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
</div>


<div class="post-tags">
	<h6 class="title"><?php _e("More Reading", 'businesscarmanager'); ?></h6>
	<?php the_tags( '<ul class="tags"><li>', '</li><li>', '</li></ul>' ); ?>
</div>

<div id="attachment_48345" style="width: 610px" class="wp-caption aligncenter">
	<a href="http://www.businesscarmanager.co.uk/wp-content/uploads/2015/03/Hyundai-Tucson.jpeg">
		<img class="wp-image-48345 size-large" src="http://www.businesscarmanager.co.uk/wp-content/uploads/2015/03/Hyundai-Tucson-600x450.jpeg" alt="Hyundai Tucson" width="600" height="450">
	</a>
	<p class="wp-caption-text">The Hyundai Tucson at the UK preview&nbsp;prior to its worldwide public debut at the 2015 Geneva Motor Show</p>
</div>

<div class="post-info">
	<?php include_module('post-category', array(
		'url' => '#',
		'name' => 'helloo'
	)); ?>
	<div class="post-date">
		<span class="label"><?php _e("Posted", 'businesscarmanager'); ?></span>
		<span class="date value">25 Feburary 2015</span>
	</div>
	<div class="post-author">
		<span class="label"><?php _e("Article By", 'businesscarmanager'); ?></span>
		<span class="author value">Name</span>
	</div>
	<div class="post-share">
		<?php include_module('share-links', array(
			'title' => 'Pos title',
			'url' => '#',
			'excerpt' => 'this post excerpt'
		)); ?>
	</div>
</div>