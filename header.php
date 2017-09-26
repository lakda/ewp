<?php

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php 
	wp_head();

	$profilePicture = esc_attr( get_option( 'profile_picture' ) );	
	
 ?>
</head>

<body <?php body_class(); ?>>

<div class="ewp-admin-sidebar sidebar-closed">
	<div class="ewp-admin-sidebar-container">
		<a href="" class="js-toggle-sidebar admin-sidebar-close">
			<span class="dashicons dashicons-no-alt admin-sidebar-close"></span>
		</a>
		<div class="admin-sidebar-scroll">
			<?php get_sidebar( 'admin' ); ?>
		</div><!-- .admin-sidebar-scroll -->
	</div><!-- .ewp-admin-sidebar-container -->
</div><!-- .ewp-admin-sidebar -->
	
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'ewp' ); ?></a>
<!--header image-->
	<?php if ( get_header_image() && is_front_page() ) : ?>
	<figure class="header-image">
		
		<a href="" class="js-toggle-sidebar admin-sidebar-open">
			<i class="fa fa-bars fa-3x icon-grey" aria-hidden="true"></i>
		</a>
		
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
		</a>
	</figure>
	<?php endif; ?>
	
	<header id="masthead" class="site-header" role="banner">
		


		<div class="site-branding">
			
			<?php the_custom_logo();?>
			
			<?php
			if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
			endif;

			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'ewp' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
