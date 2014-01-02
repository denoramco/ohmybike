<?php
/**
 * The Template for displaying all single posts.
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
	<div id="sub-content">
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', get_post_format() ); ?>			

		<?php endwhile; ?>
	</div>
<?php get_footer(); ?>