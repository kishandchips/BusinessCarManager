<?php 

// Add actions

add_action( 'tiny_mce_before_init', 'default_tinymce_options'); 

add_action( 'gform_enqueue_scripts', 'default_gform_enqueue_scripts', 10, 2);

// Custom Filters

add_filter( 'next_posts_link_attributes', 'default_next_post_link_class');

add_filter( 'previous_posts_link_attributes', 'default_prev_post_link_class');

add_filter( 'excerpt_more', 'default_excerpt_more');

add_filter( 'post_thumbnail_html', 'default_thumbnail_html', 10, 3 );

add_filter( 'widget_text', 'do_shortcode');

add_filter( 'gform_tabindex', create_function('', 'return false;'));

add_filter( 'get_terms_orderby', 'default_get_terms_orderby', 10, 2 );

add_filter( 'post_class', 'default_post_class', 10, 3);

add_filter( 'akismet_debug_log', '__return_false' );

add_filter( 'nav_menu_css_class', 'default_nav_menu_css_class', 10, 4 );

//add_filter('jpeg_quality', create_function('', 'return 100;'));

function default_get_terms_orderby( $orderby, $args ) {
  if ( isset( $args['orderby'] ) && 'include' == $args['orderby'] ) {
        $include = implode(',', array_map( 'absint', $args['include'] ));
        $orderby = "FIELD( t.term_id, $include )";
    }
    return $orderby;
}


function default_next_post_link_class() {
	return 'class="next-btn"';
} 


function default_prev_post_link_class() {
	return 'class="prev-btn"';
}


function default_excerpt_more($more) {
	return '...';
}

function default_thumbnail_html( $html, $post_id, $post_image_id ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}



function default_gform_enqueue_scripts($form, $is_ajax=false){
    wp_dequeue_script('gforms_datepicker');
    wp_dequeue_style('gforms_datepicker_css');
    wp_dequeue_style('gforms_formsmain_css');
}

function default_tinymce_options($init){ 
	$init['apply_source_formatting'] = true; 
	return $init; 
} 

function default_post_class($classes, $class, $post_id) {

    if( is_single() && ! is_admin() && is_main_query() ) {
        $post = get_post($post_id);
        $classes[] = 'single-'.$post->post_type;
    }

    return $classes;
}

function default_nav_menu_css_class($classes, $item, $args, $depth ) {
    $classes[] = 'menu-item-depth-'.$depth;
    return $classes;
}