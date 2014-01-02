<section id="latest-news">
<h2 role="heading" aria-level="2">Latest news</h2>
<?php
	$news_args = array( 'numberposts' => '3');
	$latest_posts = wp_get_recent_posts( $news_args );
	foreach( $latest_posts as $latest_post ):
?>
		<div class="news" >
			<p class="date">
				<span class="day">
				<?php					
					$news_source = $latest_post['post_date'];
					$news_date = new DateTime($news_source);
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
					if(strlen($post_title) > 22){
						$result = substr($post_title, 0, 22);
						$result .= "...";
					}else{
						$result = $post_title;
					}
					echo $result;
				?>
				</a>
			</h3>
			<p class="content">
			<?php 
				$post_content = $latest_post['post_content']; 
				if(strlen($post_content) > 60){
					$result = substr($post_content, 0, 60);
					$result .= "...";
				}else{
					$result = $post_content;
				}
				echo $result;
			?>
			</p>
		</div>
	<?php endforeach; ?>
</section>