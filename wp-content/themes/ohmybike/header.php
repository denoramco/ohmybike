<?php
	session_start();
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="google-site-verification" content="hvb3loZT5TGOtaMoIkSiaaxG2vNdy3BmXw2whYItZ7A" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/img/favicon.png" />
<link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto+Slab:700" media="all">
<link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Raleway:900" media="all">
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/colorbox.css">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
</head>
<body <?php body_class($class); ?>> 
	<header id="main-menu">
		
		<nav role="navigation">
			<h2 class="hidden" role="heading" aria-level="2">Main navigation</h2>
			<?php
					$walker = new My_Walker;
					wp_nav_menu(array(
							'echo' => true,
							'container' => '',
							'theme_location' => 'primary',
							'depth' => 1,
							'walker' => $walker
					));
				?>
				<form action="" id="mobile-nav">
					<label for="pages">Select a page : </label>
					<select name="pages" id="pages">
						<?php 
							$page_id = get_the_ID(); 
							$page = get_post($page_id);
							$slug = $page->post_name;
							echo $slug;
						?>
						<?php if($slug == "your-new-home"): ?>
						<option value="<?php echo bloginfo('url'); ?>/your-new-home" selected="selected">Home</option>
						<?php else: ?>
						<option value="<?php echo bloginfo('url'); ?>/your-new-home">Home</option>
						<?php endif; ?>
						
						<?php if($slug == "learn-with-tips-tricks"): ?>
						<option value="<?php echo bloginfo('url'); ?>/learn-with-tips-and-tricks" selected="selected">Tips & Tricks</option>
						<?php else: ?>
						<option value="<?php echo bloginfo('url'); ?>/learn-with-tips-and-tricks">Tips & Tricks</option>
						<?php endif; ?>
						
						<?php if($slug == "find-a-good-shop"): ?>
						<option value="<?php echo bloginfo('url'); ?>/find-a-good-shop" selected="selected">Good Shop</option>
						<?php else: ?>
						<option value="<?php echo bloginfo('url'); ?>/find-a-good-shop">Good Shop</option>
						<?php endif; ?>
						
						<?php if($slug == "find-a-good-spot"): ?>
						<option value="<?php echo bloginfo('url'); ?>/find-a-good-spot" selected="selected">Good Spot</option>						
						<?php else: ?>
						<option value="<?php echo bloginfo('url'); ?>/find-a-good-spot">Good Spot</option>
						<?php endif; ?>
						
						<?php if($slug == "all-events"): ?>
						<option class="mobile-events" value="<?php echo bloginfo('url'); ?>/all-events" selected="selected">Next events</option>						
						<?php else: ?>
						<option class="mobile-events" value="<?php echo bloginfo('url'); ?>/all-events">Next events</option>
						<?php endif; ?>
					</select>
				</form>				
		</nav>
			<?php
				if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Header Widget Area')) :
				endif;	
			?>
			
	</header>