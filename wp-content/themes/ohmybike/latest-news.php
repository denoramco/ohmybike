<section id="latest-news">
<h2 role="heading" aria-level="2">Latest news</h2>
<?php
	$news_args = array( 'numberposts' => 3);
	$latest_posts = wp_get_recent_posts( $news_args );
	foreach( $latest_posts as $latest_post ):
		//var_dump($latest_post);
		$news_source = $latest_post['post_date'];
		$news_date = new DateTime($news_source);
?>
		<div class="news" >
			<p class="date">
				<span class="day">
				<?php 
					echo $news_date->format('d');
				?>
				</span>
				<span class="month">
				<?php 
					echo $news_date->format('M');
				?>
				</span>
			</p>
			<h3 role="heading" aria-level="3">				
				<a href="<?php echo bloginfo('url'); ?>/<?php echo $latest_post['post_name']; ?>">
				<?php 
					$post_title = $latest_post['post_title']; 
					if(strlen($post_title) > 28){
						$result = substr($post_title, 0, 28);
						$result .= "...";
					}else{
						$result = $post_title;
					}
					echo $result;
				?>
				</a>
			</h3>
			<p class="extra">
				<span class="icon-clock hour"> <?php echo $news_date->format('H:i'); ?></span>
				<span>by</span>
				<span class="news-author"><?php echo get_the_author_meta( 'user_login' , $latest_post['post_author'] ); ?></span>
			<p>	
		</div>
	<?php endforeach; ?>
</section>