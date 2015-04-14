<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package businesscarmanager
 * @since businesscarmanager 1.0
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html xmlns:fb="http://ogp.me/ns/fb#" class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html xmlns:fb="http://ogp.me/ns/fb#" class="no-js lt-ie10 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html xmlns:fb="http://ogp.me/ns/fb#" class="no-js lt-ie10 lt-ie9"> <![endif]-->
<!--[if IE 9]>         <html xmlns:fb="http://ogp.me/ns/fb#" class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 9]><!--> <html xmlns:fb="http://ogp.me/ns/fb#" class="no-js"> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="x-ua-compatible" content="ie=edge,chrome=1" />

	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link href="<?php echo get_stylesheet_directory_uri(); ?>/images/misc/favicon.png" rel="shortcut icon" type="image/x-icon">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="tortilla">
	<header id="header" role="banner">
		<div class="container inner">
			<div class="widgets">
                <?php dynamic_sidebar('header');  ?>
            </div>
			<div class="logo-container" itemscope itemtype="http://schema.org/Organization">
				<a itemprop="url" class="logo" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				<span class="tagline"><?php bloginfo('description'); ?></span>
			</div>
			<button class="menu-btn"></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'clearfix menu', 'container' => 'nav', 'container_class' => 'primary-navigation navigation', 'depth' => 2, 'container_id' => 'header-navigation', 'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul><a class="close-btn"></a>', 'dropdown_widgets' => true )); ?>
			<?php get_search_form(); ?>
		</div>
	</header><!-- #header -->
	<div id="main" class="site-main" role="main">
