<?php 
	$loop = new WP_Query( array( 'post_type' => 'videos', 'posts_per_page' => -1 ) ); 
	
	while ( $loop->have_posts() ) : $loop->the_post(); 
	$vtitle= get_the_title();
	if(strlen($vtitle) > 25){
		$result = substr($vtitle, 0, 25);
		$result .= "...";
	}else{
		$result = $vtitle;
	}
?>
	<div class="video item">
		<a href="<?php echo the_permalink(); ?> " class="play">
			<?php 
				$video_thumbnail_src = get_video_thumbnail(); 
				$new_thumbnail = str_replace('.jpg' , '-300x200.jpg' , $video_thumbnail_src);
			?>
			<?php if($video_thumbnail_src): ?>
				<img src="<?php echo $new_thumbnail; ?>" width="300" height="200" />
			<?php else: ?>
				<img src="<?php bloginfo( 'template_url' ); ?>/img/video_thumbnail.jpg" width="300" height="200" />
			<?php endif; ?>
			<div class="play-button">
			</div>
		</a>
		<p>
			<span class="title"><?php echo $result; ?></span>
			<span class="like-count"><?php if( function_exists('zilla_likes') ) zilla_likes(); ?></span>
		</p>
	</div>
<?php endwhile;?>

