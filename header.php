<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MyLCCC_Theme
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'mylccc-theme' ); ?></a>

	<header id="masthead" class="site-header" role="banner">			
		<div class="row show-for-medium-up header-row">
		<div class="medium-12 large-9 columns site-branding">
			<?php
			$url = home_url();
			?>
			<a href="<?php echo esc_url( $url ); ?>">
			<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="Logo" />
			</a>		
			</div><!-- .site-branding -->
			</div>
<div class="medium-black-bg show-for-medium">
    <div class="row">
      <div class="large-12 columns">
        <nav class="menu-centered">
									<?php
          wp_nav_menu(array(
											'container' => false,
											'menu' => __( 'Primary', 'textdomain' ),
											'menu_class' => 'dropdown menu',
											'theme_location' => 'primary',
											'items_wrap'      => '<ul id="%1$s" class="%2$s" role="menubar" data-dropdown-menu>%3$s</ul>',
											//Recommend setting this to false, but if you need a fallback...
											'fallback_cb' => 'lc_topbar_menu_fallback',
											'walker' => new lc_top_bar_menu_walker,
												));
											?>
        </nav>
      </div>
    </div>
  </div>
  <div class="row show-for-small-only mobile-nav-bar">
    <div class="small-8 columns">&nbsp;</div>
    <div class="small-2 columns clearfix" style="color:#fff; text-align: right;font-size: 1.4rem;margin-top: -0.2rem;">Menu</div>
    <div class="small-2 columns"><span data-responsive-toggle="responsive-menu" data-hide-for="medium">
      <button class="menu-icon" type="button" data-toggle></button>
      </span> </div>
  </div>

  <div class="show-for-small-only">
			  <nav role="navigation" aria-label="<?php _e( 'Mobile Main Menu', 'lorainccc' );?>">
    <ul id="responsive-menu"  class="vertical menu" data-drilldown data-parent-link="true">
					<?php 	wp_nav_menu(array(
													'container' => false,
													'menu' => __( 'Drill Menu', 'textdomain' ),
													'menu_class' => 'vertical menu',
													'theme_location' => 'primary',
													'menu_id' => 'mobile-primary-menu',
														//Recommend setting this to false, but if you need a fallback...
													'fallback_cb' => 'lc_drill_menu_fallback',
													'walker' => new lc_drill_menu_walker(),
												));
     ?>
    </ul>
			</nav>
  </div>
	</header><!-- #masthead -->
	<div class="row main">
	<div id="content" class="site-content">
		<!--	<div class="small-12 columns hide-for-medium mobile-title">
					  <h2><a href="#">	<img src="<?php  /*echo get_theme_mod( 'custom_logo' );*/ ?>"alt="mobile-Logo" /></a></h2>
		</div>-->
