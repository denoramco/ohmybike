<?php
/*
 * Template Name: SPOT

 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 */
get_header(); ?>
<div id="main-content">
	<aside id="sidebar">
		<h2 class="hidden">Events, News & Comments</h2>
		<?php get_template_part('content','events'); ?>
		<?php get_template_part('latest','news'); ?>
		<?php get_template_part('recent','comments'); ?> 
	</aside>
	<header class="banner" role="banner">
		<p  id="logo"><a href="<?php echo bloginfo('url'); ?>" title="home" alt="home">home</a></p>
		<h1>Find a good spot</h1>
		<h2>Spots list</h2>
	</header>
	<?php get_template_part('content','spots'); ?>
<?php get_footer(); ?>