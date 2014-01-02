<?php 
	$loop = new WP_Query( array( 'post_type' => 'images', 'posts_per_page' => -1 ) );
	
	while ( $loop->have_posts() ) : $loop->the_post(); 
	$src = get_field('image');
	$ititle= get_the_title();
	if(strlen($ititle) > 25){
		$result = substr($ititle, 0, 25);
		$result .= "...";
	}else{
		$result = $ititle;
	}
?>	
	<div class="image item all <?php $tags = get_the_tags(); if($tags){foreach($tags as $tag){	echo $tag->slug . ' ';	}};?>">
		<a href="<?php echo the_permalink(); ?> ">		
			<img src="<?php echo $src['sizes']['thumbnail']; ?>" alt="<?php echo get_the_title(); ?>" title="<?php echo get_the_title(); ?>" width="300" height="200" />
		</a>
		<p>
			<span class="title"><?php echo $result; ?></span>
			<span class="like-count"><?php if( function_exists('zilla_likes') ) zilla_likes(); ?></span>
		</p>
	</div>
<?php endwhile;?>