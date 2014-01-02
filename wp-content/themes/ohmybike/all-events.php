<?php
/*
 * Template Name: EVENTS

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
<div id="main-content" class="all-events">
	<aside id="sidebar">
		<h2 class="hidden">Events, News & Comments</h2>
		<?php get_template_part('latest-news'); ?>
		<?php get_template_part('recent-comments'); ?> 
	</aside>
	<header class="banner" role="banner">
		<p  id="logo"><a href="<?php echo bloginfo('url'); ?>" title="home" alt="home">home</a></p>
		<h1>All the next events</h1>
		<h2>Events</h2>
	</header>
	<?php $loop = new WP_Query( array( 'post_type' => 'events', 'posts_per_page' => -1 ) ); 
	
		$i = 0;
		$events = array();
		
		function date_compare($a, $b){
			$t1 = strtotime($a['date']);
			$t2 = strtotime($b['date']);
			return $t1 - $t2;
		};
		
		while ( $loop->have_posts() ) : $loop->the_post(); 
		
			$events[$i]['date']= get_field('date');
			$events[$i]['name']= get_the_title();
			$events[$i]['place']= get_field('place');
			$events[$i]['url']= get_field('website_url');	
			
			$i++;		
		
		endwhile; 	
		
		usort($events, 'date_compare');			
		
		foreach($events as  $event): ?>
		<div class="event">
			<p class="date">
				<span class="day">
				<?php 
					$event_source = $event['date'];
					$event_date = new DateTime($event_source);
					echo $event_date->format('d');
				?>
				</span>
				<span class="month">
				<?php 
					echo $event_date->format('M');
				?>
				</span>
			</p>
			<h2>				
				<?php echo $event['name'] ?>
			</h2>
			<p class="place"><?php echo $event['place']; ?></p>
			<?php if($event['url']): ?>
				<a href="<?php echo $event['url']; ?>" title="external link" target="_blank">More details on the event website</a>
			<?php endif; ?>
		</div>
		<?php endforeach;?>
<?php get_footer(); ?>