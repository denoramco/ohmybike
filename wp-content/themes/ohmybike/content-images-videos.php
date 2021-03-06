<?php 
	$loop = new WP_Query( array( 'post_type' => array( 'images' , 'videos' ) , 'posts_per_page' => -1 ) );
	
	while ( $loop->have_posts() ) : $loop->the_post(); 
	$src = get_field('image');
	$ititle= get_the_title();
	if(strlen($ititle) > 25){
		$result = substr($ititle, 0, 25);
		$result .= "...";
	}else{
		$result = $ititle;		
	}
	$vtitle= get_the_title();
	if(strlen($vtitle) > 25){
		$result = substr($vtitle, 0, 25);
		$result .= "...";
	}else{
		$result = $vtitle;
	}
	if($src):
?>	
	<div class="image item all <?php $tags = get_the_tags(); if($tags){foreach($tags as $tag){	echo $tag->slug . ' ';	}};?>">
		<a href="<?php echo the_permalink(); ?> " title="See it in bigger size">		
			<img src="<?php echo $src['sizes']['thumbnail']; ?>" alt="<?php echo get_the_title(); ?>" width="300" height="200" />
		</a>
		<p>
			<span class="title"><?php echo $result; ?></span>
			<span class="like-count"><?php if( function_exists('zilla_likes') ) zilla_likes(); ?></span>
		</p>
	</div>
<?php else: ?>
	<div class="video item">
		<a href="<?php echo the_permalink(); ?> " title="Go to the video" class="play">
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
<?php endif;endwhile;?>