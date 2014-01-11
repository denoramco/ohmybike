<?php
/**
 * The template for displaying 404 pages (Not Found).
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
		<header class="banner" role="banner">
			<p  id="logo"><a href="<?php echo bloginfo('url'); ?>" title="home" alt="home">home</a></p>
			<h1>Learn with tips & tricks</h1>
			<h2>All forums</h2>
		</header>
		<?php 
			$previous = $_SERVER['HTTP_REFERER'];
			$replace1 = str_replace('http://www.ohmywebstudio.be/pfe/' , '', $previous);
			$replace2 = str_replace('-' , ' ', $replace1);
			$backlinkname = explode("/", $replace2);
			if(isset($previous) && $previous !=''):
		?>
		<div class="content-menu single">
			<ul>
				<li>	
					<a href="<?php echo $previous; ?>" id="back">Go back to 
					<?php 
						if($backlinkname[0] == '' || $backlinkname[0] == 'images' || $backlinkname[0] == 'videos'){ 
							echo "home"; 
						}elseif($backlinkname[0] == 'category'){
							echo "learn with tips and tricks"; 
						}else{ 
							echo $backlinkname[0]; 
						}; 				
					?>
					</a>					
				</li>
			</ul>
		</div>
		<?php endif; ?>
		<article id="post-0" class="post error404 no-results not-found">
			<header class="entry-header">
				<h3 class="entry-title">You've simply done something wrong, try again</h3>
			</header>			
		</article>
	</div><!-- #content -->

<?php get_footer(); ?>