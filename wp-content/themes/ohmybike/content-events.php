<section id="events">
	<h2 role="heading" aria-level="2">Next events</h2>
	<?php $loop = new WP_Query( array( 'post_type' => 'events', 'posts_per_page' => -1 ) ); 
	
		$i = 0;
		$j = 0;
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
			$events[$i]['permalink']= get_permalink();
			
			$i++;		
		
		endwhile; 	
		
		usort($events, 'date_compare');	
		
		foreach($events as  $event): ?>
		<?php if($j < 4): ?>
		<div class="event" itemscope itemtype="http://schema.org/Event">
			<p class="date" itemprop="startDate">
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
			<h3 role="heading" aria-level="3" itemprop="name">	
				<a href="<?php echo $event['permalink']; ?>">
				<?php echo $event['name']; ?>
				</a>
			</h3>
			<p class="place" itemprop="location"><?php echo $event['place']; ?></p>
		</div>
		<?php $j++; endif; ?>
		<?php endforeach;?>
		<div class="seemore">
			<a href="<?php bloginfo("url"); ?>/all-events">More events</a>
		</div>
</section>