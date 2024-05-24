<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package:   ClassicPress
 * @subpackage Harmony
 * @since      Harmony 1.0.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name   ="viewport" content="width=device-width, initial-scale=1">
	<link rel    ="profile" href="http://gmpg.org/xfn/11">
	<?php 
	if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel    ="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php 
	endif; ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?><a class="skip-link screen-reader-text" href="#main">
	<?php esc_attr_e( 'Skip to content', 'harmony' ); ?></a>

	<div class="header">
		<div id="header-menu" class="site-header-menu">
		    <?php 
			if ( has_nav_menu( 'secondary' ) ) : ?>

			<div class="nav-inside-top" aria-label="<?php esc_attr_e( 'Secondary Menu', 'harmony' ); ?>">
			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'secondary',
						'menu_class' => 'nav-inside',
					)
				);
			?>
			</div>

			<?php 
			endif; ?>

			<nav id="nav" class="navbar navigation-top" aria-label="<?php esc_attr_e( 'Primary Menu', 'harmony' ); ?>">
			
				<?php 
				if ( has_nav_menu( 'primary' ) ) : ?>

				<div class="nav-inside">
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'menu_class' => 'primary-menu',
						)
					);
				?>
				</div>
				
				<?php 
				endif; ?>
		
			</nav><!-- .main-navigation -->
		</div>  
	</div><!-- .site-header -->

		<div class="site-branding">
			
			<div class="harmony-branding-left">  
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" 
				rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<p class="site-description"><?php echo esc_html( get_bloginfo( 'description', 'display' ) ); ?></p>
			</div>

				<div class="harmony-branding-right">
					<a href="<?php 
					echo esc_url( home_url( '/' ) ); ?>" rel="bookmark"><?php 
					do_action( 'harmony_render_logo' ); ?></a>
				</div>
		</div><!-- .site-branding -->
