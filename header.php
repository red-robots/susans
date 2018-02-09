<?php
/**
 * The header for theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ACStarter
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
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'acstarter' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="wrapper cap">
			<?php if(is_home()) { ?>
	            <h1 class="logo col-1">
	            <a href="<?php bloginfo('url'); ?>"><img src="<?php echo get_template_directory_uri()."/images/logo.png";?>" alt="<?php bloginfo('name'); ?>"></a>
	            </h1>
	        <?php } else { ?>
	            <div class="logo col-2">
	            <a href="<?php bloginfo('url'); ?>"><img src="<?php echo get_template_directory_uri()."/images/logo.png";?>" alt="<?php bloginfo('name'); ?>"></a>
	            </div>
	        <?php } ?>
			<div class="col-2">
				<?php $facebook_link = get_field("facebook_link");
				$linkedin_link = get_field("linkedin_link");
				$instagram_link = get_field("instagram_link");
				if($facebook_link||$instagram_link||$linkedin_link):?>
					<div class="row-1 social">
						<?php if($instagram_link):?>
							<a href="<?php echo $instagram_link;?>"><i class="fa fa-instagram"></i></a>
						<?php endif;?>
						<?php if($linkedin_link):?>
							<a href="<?php echo $linkedin_link;?>"><i class="fa fa-linkedin"></i></a>
						<?php endif;?>
						<?php if($facebook_link):?>
							<a href="<?php echo $facebook_link;?>"><i class="fa fa-facebook"></i></a>
						<?php endif;?>
					</div><!--.row-1-->
				<?php endif;?>
				<nav id="site-navigation" class="main-navigation row-2" role="navigation">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'MENU', 'acstarter' ); ?></button>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
				</nav><!-- #site-navigation -->
			</div><!--col-2-->
	</div><!-- wrapper -->
	</header><!-- #masthead -->

	<div id="content" class="site-content wrapper">
