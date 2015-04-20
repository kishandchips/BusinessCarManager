<?php

define( 'THEME_NAME', 'businesscarmanager');

$template_directory = get_template_directory();

$template_directory_uri = get_template_directory_uri();

require( $template_directory . '/inc/default/functions.php' );

require( $template_directory . '/inc/default/hooks.php' );

require( $template_directory . '/inc/default/shortcodes.php' );

//require( $template_directory . '/inc/classes/primary-nav-walker.php' );

//require( $template_directory . '/inc/classes/category-dropdown-url-walker.php' );

// Custom Actions

add_action( 'after_setup_theme', 'custom_setup_theme' );

add_action( 'init', 'custom_init', 4);

add_action( 'wp', 'custom_wp');

add_action( 'widgets_init', 'custom_widgets_init' );

add_action( 'wp_enqueue_scripts', 'custom_scripts', 30);

add_action( 'wp_print_styles', 'custom_styles', 30);

add_action( 'in_widget_form', 'custom_in_widget_form', 10, 3 );

// Custom Filters

add_filter( 'comment_form_defaults', 'custom_comment_form_defaults');

add_filter( 'jpeg_quality', create_function( '', 'return 100;' ) );

add_filter( 'template_include', 'custom_template_include' );

add_filter( 'the_content_feed', 'custom_the_content_feed', 10, 2);

add_filter( 'walker_nav_menu_start_el', 'custom_walker_nav_menu_start_el', 10, 4);

add_filter( 'pre_get_posts', 'custom_pre_get_posts');

add_filter( 'nav_menu_css_class', 'custom_nav_menu_css_class', 10, 4);

add_filter('the_content', 'custom_the_content', 0);

add_filter( 'wp_setup_nav_menu_item', 'custom_wp_setup_nav_menu_item' );

add_filter('the_posts', 'custom_the_posts');

add_filter('sidebars_widgets', 'custom_sidebars_widgets', 20);

add_filter( 'pre_option_link_manager_enabled', '__return_true' );

remove_filter( 'nav_menu_description', 'strip_tags' );

//Custom shortcodes

//add_shortcode( 'phone_number', 'custom_phone_number');

add_shortcode('sidebar', 'custom_sidebar');

add_shortcode('checkout_progress', 'custom_checkout_progress');

add_shortcode('collection', 'custom_collection');

add_shortcode('social_links', 'custom_social_links');

add_shortcode('tax_links', 'custom_tax_links');

add_shortcode('dropdown_menu', 'custom_dropdown_menu');

add_shortcode('widget', 'custom_widget');

if( $shortcodes = get_field('shortcodes', 'options') ) {
	foreach( $shortcodes as $shortcode ) {
		add_shortcode( $shortcode['shortcode'], function() use ( $shortcode ) {
			return $shortcode['content'];
		});
	}
}

function custom_setup_theme() {
	
	add_theme_support( 'html5' );
	
	add_theme_support( 'caption' );
	
	add_theme_support( 'automatic-feed-links' );
	
	add_theme_support( 'post-thumbnails' );

	add_theme_support( 'editor_style' );

	add_post_type_support('page', 'excerpt');

	register_nav_menus( array(
		'primary' => __( 'Primary', 'businesscarmanager' ),
		'secondary' => __( 'Secondary', 'businesscarmanager' ),
		'tertiary' => __( 'Tertiary', 'businesscarmanager' )
	) );

	add_editor_style('css/editor-style.css');

}

function custom_init(){
	
	global $template_directory;

	require( $template_directory . '/inc/classes/otf-regenerate-thumb.php' );

	require( $template_directory . '/inc/classes/custom-post-type.php' );

	require( $template_directory . '/inc/classes/dropdown-nav-walker.php' );

	if( $hubs_page = get_field('hubs_page', 'options') ) {
		$hubs_uri = get_page_uri( $hubs_page );

		$hub = new Custom_Post_Type( 'Hub',
	 		array(
	 			'public'              => true,
				'show_ui'             => true,
				'capability_type'     => 'post',
				'map_meta_cap'        => true,
				'publicly_queryable'  => true,
				'exclude_from_search' => true,
				'hierarchical'        => false,
				'rewrite'             => array( 'slug' => $hubs_uri, 'with_front' => false ),
				'supports'            => array( 'title', 'thumbnail', 'page-attributes'  ),
				'has_archive'         => $hubs_uri,
				'show_in_nav_menus'   => true,
				'plural'			  => 'Hubs',
				'singluar'			  => 'Hub'
	   		)
	   	);

	   	$hub->register_post_type();

	   	$hub->register_taxonomy('hub_category', 
	   		array('hierarchical' => true, 'rewrite' => array( 'slug' => 'hub-category')), 
	   		array('plural' => __("Categories", 'businesscarmanager'), 'singular_name' => __("Category", 'businesscarmanager'))
	   	);
	}

	if( $suppliers_page = get_field('suppliers_page', 'options') ) {
		$suppliers_uri = get_page_uri( $suppliers_page );

		$supplier = new Custom_Post_Type( 'Supplier',
	 		array(
	 			'public'              => true,
				'show_ui'             => true,
				'capability_type'     => 'post',
				'map_meta_cap'        => true,
				'publicly_queryable'  => true,
				'exclude_from_search' => true,
				'hierarchical'        => false,
				'rewrite'             => array( 'slug' => $suppliers_uri, 'with_front' => false ),
				'supports'            => array( 'title', 'thumbnail', 'editor', 'page-attributes'  ),
				'has_archive'         => $suppliers_uri,
				'show_in_nav_menus'   => true,
				'plural'			  => 'Suppliers',
				'singluar'			  => 'Supplier',
			//	'taxonomies' 		  => array('post_tag')
	   		)
	   	);

	   	$supplier->register_post_type();

	   	$supplier->register_taxonomy('supplier_category', 
	   		array('hierarchical' => true, 'rewrite' => array( 'slug' => 'supplier-category')), 
	   		array('plural' => __("Categories", 'businesscarmanager'), 'singular_name' => __("Category", 'businesscarmanager'))
	   	);

	}

	if( function_exists('acf_add_options_page') ) acf_add_options_page();

}

function custom_template_include( $template ) {
	
	if ( is_page( array(get_field('hubs_page', 'options')) ) ) {
		$template = locate_template( 'archive-hub.php' );
	}

	if ( is_page( array(get_field('suppliers_page', 'options')) ) ) {
		$template = locate_template( 'archive-supplier.php' );
	}

	return $template;
}

function custom_wp(){
	
}

function custom_widgets_init() {
	global $template_directory;

	$primary_categories = get_field('primary_categories', 'options');

	include( $template_directory . '/inc/widgets/advert.php');

	include( $template_directory . '/inc/widgets/widgets.php');

	/********************** Sidebars ***********************/

	register_sidebar( array(
		'name' => __( 'Sidebar', 'businesscarmanager' ),
		'id' => 'sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',	
		'limit' => 1
	) );

	register_sidebar( array(
		'name' => __( 'More - Dropdown', 'businesscarmanager' ),
		'id' => 'more_dropdown',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h6 class="widget-title">',
		'after_title' => '</h6>',
	) );



	register_sidebar( array(
		'name' => __( 'Header', 'businesscarmanager' ),
		'id' => 'header',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
		'limit' => 1
	) );

	if( $primary_categories) {
		foreach( $primary_categories as $primary_category ) {
			$category = get_category($primary_category);

			register_sidebar( array(
				'name' => __( 'Category Header', 'businesscarmanager' ) . ' - ' . $category->name,
				'id' => 'category_header_'.$primary_category,
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h6 class="widget-title">',
				'after_title' => '</h6>',
			) );
		}
	}

	register_sidebar( array(
		'name' => __( 'Instances', 'businesscarmanager' ),
		'id' => 'instances',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );

}

function custom_scripts() {
	global $template_directory_uri;

	wp_enqueue_script('jquery');
	wp_enqueue_script('modernizr', $template_directory_uri.'/js/libs/modernizr.min.js');
	wp_enqueue_script('main', $template_directory_uri.'/js/main.js', array('jquery', 'modernizr'), '', true);
	wp_enqueue_script('jquery-waypoints', $template_directory_uri.'/js/plugins/jquery.waypoints.js', array('jquery'), '', true);
	wp_enqueue_script('adtech', 'http://aka-cdn-ns.adtech.de/dt/common/DAC.js', false, '', true);
	//wp_enqueue_script('waypoints-sticky', $template_directory_uri.'/js/plugins/jquery.waypoints.sticky.js', array('jquery'), '', true);

	wp_register_script('jquery-cookie', $template_directory_uri.'/js/plugins/jquery.cookie.js', array( 'jquery' ), '', true );
	wp_register_script('jquery-owlcarousel', $template_directory_uri.'/js/plugins/jquery.owlcarousel.js', array( 'jquery' ), '', true );
}


function custom_styles() {
	global $wp_styles, $template_directory_uri;

	wp_enqueue_style( 'style', $template_directory_uri . '/css/style.css' );	
	wp_enqueue_style( 'fonts', '//fast.fonts.net/cssapi/1358a503-d7aa-4ba0-a744-c0a61048f892.css' );
}

function custom_comment_form_defaults($args){
	$args['title_reply'] = '<span class="title">'.__( 'Comments' ).'</span>';
	$args['title_reply_to'] = '<span class="title">'.__( 'Comments' ).'</span>';
	$args['comment_notes_before'] = '';
	//$args['cancel_reply_link'] = __( 'Cancel reply' );
	//$args['label_submit'] = __( 'Post Comment' );
	return $args;
}

function custom_the_content_feed($content, $type){
	ob_start();
    get_template_part('inc/content');
    $content = ob_get_contents();
    ob_end_clean();

	return $content;
}

function custom_walker_nav_menu_start_el($item_output, $item, $depth, $args) {

	$atts = array();
	$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
	$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
	$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
	$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

	$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

	$attributes = '';
	foreach ( $atts as $attr => $value ) {
		if ( ! empty( $value ) ) {
			$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
			$attributes .= ' ' . $attr . '="' . $value . '"';
		}
	}

	$item_output = $args->before;
	$item_output .= '<a'. $attributes .'>';
	$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
	$item_output .= '</a>';
	if( $item->description && !empty($args->dropdown_widgets) ) {
		$item_output .= '<div class="primary-dropdown dropdown clearfix">'.do_shortcode($item->description).'</div>';
	}

	$item_output .= $args->after;

	return $item_output;
}

function custom_nav_menu_css_class($classes, $item, $args, $depth) {

	if( $item->description ) {
		$classes[] = 'menu-item-has-dropdown';
	}

	return $classes;
}

function custom_sidebar($atts) {
	extract(shortcode_atts(array(
        'id'    => '0'
    ), $atts));

    ob_start();
    dynamic_sidebar($id);
    $output = ob_get_contents();
    ob_end_clean();

	return $output;
}

function custom_pre_get_posts($query) {
	global $woocommerce;

	if ( ! $query->is_main_query() ) {
		return;
	}

	$post_type_pages = array();
	if( $hubs_page = get_field('hubs_page', 'options')) $post_type_pages[$hubs_page] = 'hub';
	if( $suppliers_page = get_field('suppliers_page', 'options'))$post_type_pages[$suppliers_page] = 'supplier';

	if ( $GLOBALS['wp_rewrite']->use_verbose_page_rules && isset( $query->queried_object_id ) ) {
		if( array_key_exists( $query->queried_object_id, $post_type_pages) ) {
			$query->set( 'post_type', $post_type_pages[$query->queried_object_id] );
			$query->set( 'page', '' );
			$query->set( 'pagename', '' );

			$query->is_archive           = true;
			$query->is_post_type_archive = true;
			$query->is_singular          = false;
			$query->is_page              = false;
		}
	}

    if( isset($_GET['view']) ){
    	switch($_GET['view']) {
    		case 'all':
		    	$query->set('posts_per_page', -1);
		    break;
	    }
	}

}

function custom_social_links() {
	ob_start();
    include_module('social-links');
    return ob_get_clean();
}

function custom_tax_links() {
	ob_start();
    include_module('tax-links');
    return ob_get_clean();
}

function custom_the_content($content) {
	// global $shortcode_tags;

	// $active_shortcodes = ( is_array($shortcode_tags) && !empty($shortcode_tags) ) ? array_keys($shortcode_tags) : array();
	
	// $hack = md5(microtime());
	// $content = str_replace("/",$hack, $content);
	
	// if(!empty($active_shortcodes)){
	// 	$keep_active = implode("|", $active_shortcodes);
	// 	$content= preg_replace( "~(?:\[/?)(?!(?:$keep_active))[^/\]]+/?\]~s", '', $content );
	// } else {
	// 	$content = preg_replace("~(?:\[/?)[^/\]]+/?\]~s", '', $content);			
	// }
	
	// $content = str_replace($hack,"/",$content);

  	return $content;
}

function get_post_sub_category($id = '') {
	global $post;

	$id = ( $id ) ? $id : $post->ID;
	
	$terms = get_the_terms($id, 'category');
	
	if( !empty($terms) ) {
		$top_term = null;
		$sub_term = current($terms);
		foreach( $terms as $term ) {
			if( $term->parent == 0) { 
				$top_term = $term; 
				continue;
			}
		}

		if( $top_term ) {
			foreach( $terms as $term ) {
				if( !empty($term->parent) && $term->parent == $top_term->term_id ) {
					$sub_term = $term;
					continue;	
				}
			}
		}

		return $sub_term;
	}

	return null;
}

function get_post_category( $id = '') {
	global $post;

	$id = ( $id ) ? $id : $post->ID;
	$categories = get_the_category( $id );

	return ( current($categories) ) ? get_top_level_category( current($categories)->term_id) : null;
}

function get_post_primary_category( $id = '') {
	global $post;

	$id = ( $id ) ? $id : $post->ID;
	$primary_categories = get_field('primary_categories', 'options');

	$categories = get_the_category( $id );
	$primary_category = array();

	if( $primary_categories ) {
		foreach( $categories as $category) {
			if( in_array($category->term_id, $primary_categories) ) {
				// if( $primary_category ) {
				// 	return false;
				// }

				$primary_category = $category;
			}
		}
	}

	if( !$primary_category ) {
		$primary_category = get_post_category( $id );
	}

	return $primary_category;
}

function get_category_primary_category( $id ) {
	$id = ( $id ) ? $id : get_query_var('cat');

	$primary_category = get_top_level_category( $id );
	// $primary_categories = get_field('primary_categories', 'options');
	// $primary_category = array();

	// if( $primary_categories ) {
	// 	foreach( $primary_categories as $category ) {
	// 		if( in_category() ) {
	// 			$category = 
	// 			continue;
	// 		}
	// 	}	
	// }
	return $primary_category;
}

function get_category_color( $category_id ) {

	$category = get_top_level_category( $category_id );
	return get_field('color', 'category_' .$category->term_id);
}

function custom_wp_setup_nav_menu_item( $menu_item ) {
     if( !empty($menu_item->description) && !empty($menu_item->post_content) ) $menu_item->description = apply_filters( 'nav_menu_description', $menu_item->post_content );
     return $menu_item;
}

function custom_the_posts( $posts ){

	if( is_category() && is_main_query() ){
			
		$sticky_posts = get_option('sticky_posts');
		$num_posts = count( $posts );
		$sticky_offset = 0;
		
		for( $i = 0; $i<$num_posts; $i++){
			if( in_array( $posts[$i]->ID, $sticky_posts ) ){
				$sticky_post = $posts[$i];
				
				array_splice( $posts, $i, 1 );
				
				array_splice( $posts, $sticky_offset, 0, array( $sticky_post ) );
				
				$sticky_offset++;
				
				$offset = array_search( $sticky_post->ID, $sticky_posts );
				unset( $sticky_posts[$offset] );
			}
		}

	}

	return $posts;

}

function custom_dropdown_menu( $atts ){

	extract(shortcode_atts(array(
        'id'    => '0',
        'label'    => '',
    ), $atts));

    ob_start();
    ?>
    <div class="dropdown-menu">
    	<?php if( $label ): ?>
    	<span class="label"><?php echo $label ?></span>
	    <?php endif; ?>
	    <?php wp_nav_menu( array(
			'menu' => $id,
			'walker'         => new Walker_Nav_Menu_Dropdown(),
			'items_wrap'     => '<select class="dropdown redirect-dropdown"><option value="">' . __("Choose", 'businesscarmanager'). '</option>%3$s</select>',
			'menu_class' => 'clearfix menu',
			'container' => 'nav',
			'container_class' => 'dropdown-navigation navigation',
		) ); ?>
	</div>
	<?php
    return ob_get_clean();
}

function custom_widget($atts){

	extract(shortcode_atts(array(
        'id'    => '0',
        'position' => 'left'
    ), $atts));

    $class = array('widget %2$s');
    $class[] = ( !empty($position) ) ? $position : '';

    ob_start();
    widget_instance($id, array('before_widget' => '<aside id="%1$s" class="'.implode(' ', $class).'">'));
    return ob_get_clean();
}

function custom_sidebars_widgets( $sidebars ) {
	global $wp_registered_sidebars;

	if( $wp_registered_sidebars && !is_admin() ) {
		foreach ( $sidebars as $sidebar_id => $widgets ) {

			$sidebar = ( !empty($wp_registered_sidebars[$sidebar_id]) ) ? $wp_registered_sidebars[$sidebar_id] : null;
			$limit = ( !empty($sidebar['limit']) ) ? $sidebar['limit'] : null;

			if( $limit ) {
				$i = 0;
				foreach ( $widgets as $widget_key => $widget_id ){
					if($i >= $limit) {
						unset($sidebars[$sidebar_id][$widget_key]);
					}
					$i++;
				}
			}
		}
	}

	return $sidebars;
}

function custom_in_widget_form( $widget, $return, $instance ) {
	echo '<p>' . __( 'Shortcode' ) . ': ' . ( ( $widget->number == '__i__' ) ? __( 'Please save this first.' ) : '<code>[widget id="'. $widget->id .'"]</code>' ) . '</p>';
}
