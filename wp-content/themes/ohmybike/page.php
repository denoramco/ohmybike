<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>
<div id="main-content">
	<aside id="sidebar">
		<h2 class="hidden">Events, News & Comments</h2>
		<?php get_template_part('content-events'); ?>	
		<?php get_template_part('latest-news'); ?>
		<?php get_template_part('recent-comments'); ?> 
	</aside>
	<?php while ( have_posts() ) : the_post(); ?>
	
		<?php get_template_part( 'content', 'page' ); ?>
		
	<?php endwhile; // end of the loop. ?>
	
<?php get_footer(); ?>