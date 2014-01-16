<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
	<header class="banner" role="banner">
		<p  id="logo"><a href="<?php echo bloginfo('url'); ?>" title="home" alt="home">home</a></p>
		<h1 role="heading" aria-level="1"><?php echo get_post_type(); ?></h1>
		<h2 role="heading" aria-level="2"><?php the_title(); ?></h2>
	</header>
	<?php 
		$post_type = get_post_type();
		$post_category = get_the_category();
		$previous = $_SERVER['HTTP_REFERER'];
		preg_match("#http:\/\/.*\/(.+)#",$previous,$match);
		$replace1 = str_replace('/' , '', $match);
		$replace2 = str_replace('-' , ' ', $replace1);
		$backlinkname = end ($replace2);
		if(isset($previous) && $previous !=''):
	?>
	<div class="content-menu single">
		<ul>
			<li>	
				<a href="<?php echo $previous; ?>" id="back">Go back to 
				<?php 
					if($backlinkname == 'pfe' ){ 
						echo "home"; 
					}elseif($backlinkname == 'category' ||$backlinkname == 'learn with tips and tricks'){
						echo "tips and tricks"; 
					}else{ 
						if(strlen($backlinkname) > 15){
							$result = substr($backlinkname, 0, 15);
							$result .= "...";
						}else{
							$result = $backlinkname;		
						}
						echo $result; 
					}; 				
				?>
				</a>					
			</li>
		</ul>
	</div>
	<?php endif; ?>
	<div id="the-post">
	<?php $post_id = get_the_ID(); ?>
	<article id="post-<?php echo $post_id; ?>" <?php post_class(); ?>>
		<h3 role="heading" aria-level="3" itemprop="name"><?php the_title(); ?></h3>
			<?php if(get_field('date')): ?>
			<?php 
				$start_source = get_field('date');
				$event_start = new DateTime($start_source);
				$end_source = get_field('end_date');
				$event_end = new DateTime($end_source);
						
			?>
			<h4>
				<?php echo $event_start->format('d/m/Y'); ?>
				 
				<?php
					if( get_field('end_date')){
						echo '  to ' . $event_end->format('d/m/Y');
					} 
				?>
				<?php 
					if(get_field('place')){
						echo ' at ' . get_field('place');
					} 
				?>
			</h4>
			<?php endif; ?>
			<?php if(get_field('video')): ?>
			<div class="the-video">
				<?php echo do_shortcode(get_field('video')); ?>
			</div>
			<?php endif;?>
			<?php if(get_field('image')): ?>
			<div class="the-image">
				<a href="<?php $src = get_field('image'); echo $src['sizes']['large']; ?>" rel="lightbox"><img id="the-image" src="<?php echo $src['sizes']['medium']; ?>" alt="<?php echo $src['title']; ?>" width="<?php echo $src['sizes']['medium-width']; ?>" height="<?php echo $src['sizes']['medium-height']; ?>" /></a>
			</div>
			<?php endif;?>
			<?php if($post_type == 'shops' || $post_type == 'spots'): ?>
			<div class="itemcard">
			<?php endif;?>
			<?php if(get_field('website_url')): ?>
			<p class="website"><a href="<?php echo get_field('website_url'); ?>" target="_blank"><?php echo get_field('website_url'); ?></a></p>
			<?php endif; ?>
			<?php if(get_field('telephone')): ?>
			<p class="tel">Tel. : <?php echo get_field('telephone'); ?></p>
			<?php endif; ?>
			<?php if(get_field('email')): ?>
			<p class="mail">Mail. : <a href="mailto:<?php echo get_field('email'); ?>"><?php echo get_field('email'); ?></a></p>
			<?php endif; ?>
			<?php if(get_field('description')): ?>
			<p class="content"><?php echo get_field('description'); ?></p>
			<?php endif; ?>			
			<?php if(get_field('street_address')): ?>
				<address class="adr-gmap adr">
					<span class="street-address"><?php echo get_field('street_address'); ?></span>
					<?php if(get_field('country')): ?>
						<span class="country-name" itemprop="country-name"><?php echo get_field('country'); ?></span>
					<?php endif; ?>
				</address>				
			<?php endif; ?>
		<?php if($post_type == 'shops' || $post_type == 'spots'): ?>	
		</div> <!-- end itemcard -->
		<?php endif;?>
		<?php if(get_field('street_address')): ?>
		<div id="gmap"></div>
		<?php endif; ?>
		<div class="entry-content">
			<?php the_content(); ?>
			<div>
				<p class="post-author">
					<span><?php echo get_the_date('d/m/Y'); ?></span>
					<span class="icon-clock hour"><?php echo get_the_date('G:i'); ?></span>
					<span>by</span>
					<span class="the-author"><?php echo get_the_author(); ?></span>				
				</p>
				<?php if( function_exists('zilla_likes') ) zilla_likes(); ?>
			</div>			
		</div>
	</article>
	<?php
		if ( is_user_logged_in() ){
			comments_template();
		}else{
	?>
		<p class="warning">You must be <a class="gotologin" href="#login_tab" title="Go to login panel">logged in</a> to see comments or adding them.</p>
	<?php
		}
	?>
	</div>
		<?php 			
			if($post_type == "spots"):
		?>
		<section id="lightbox">
			<h4 role="heading" aria-level="4">Gallery</h4>
			<a href="<?php echo bloginfo("template_directory"); ?>/img/bikepark1.jpg" rel="lightbox"><img src="<?php echo bloginfo("template_directory"); ?>/img/bikepark1-300.jpg" alt="bikepark1" /></a>
			<a href="<?php echo bloginfo("template_directory"); ?>/img/bikepark2.jpg" rel="lightbox"><img src="<?php echo bloginfo("template_directory"); ?>/img/bikepark2-300.jpg" alt="bikepark2" /></a>
			<a href="<?php echo bloginfo("template_directory"); ?>/img/bikepark3.jpg" rel="lightbox"><img src="<?php echo bloginfo("template_directory"); ?>/img/bikepark3-300.jpg" alt="bikepark3" /></a>
			<a href="<?php echo bloginfo("template_directory"); ?>/img/bikepark4.jpg" rel="lightbox"><img src="<?php echo bloginfo("template_directory"); ?>/img/bikepark4-300.jpg" alt="bikepark4" /></a>
		</section>
		<?php elseif($post_type == "shops"): ?>
		<section id="lightbox">
			<h4 role="heading" aria-level="4">Gallery</h4>
			<a href="<?php echo bloginfo("template_directory"); ?>/img/bikeshop1.jpg" rel="lightbox"><img src="<?php echo bloginfo("template_directory"); ?>/img/bikeshop1-300.jpg" alt="bikeshop1" /></a>
			<a href="<?php echo bloginfo("template_directory"); ?>/img/bikeshop2.jpg" rel="lightbox"><img src="<?php echo bloginfo("template_directory"); ?>/img/bikeshop2-300.jpg" alt="bikeshop2" /></a>
			<a href="<?php echo bloginfo("template_directory"); ?>/img/bikeshop3.jpg" rel="lightbox"><img src="<?php echo bloginfo("template_directory"); ?>/img/bikeshop3-300.jpg" alt="bikeshop3" /></a>
			<a href="<?php echo bloginfo("template_directory"); ?>/img/bikeshop4.jpg" rel="lightbox"><img src="<?php echo bloginfo("template_directory"); ?>/img/bikeshop4-300.jpg" alt="bikeshop4" /></a>
		</section>
		<?php elseif($post_type == "events"): ?>
		<section id="lightbox">
			<h4 role="heading" aria-level="4">Gallery</h4>
			<a href="<?php echo bloginfo("template_directory"); ?>/img/event1.jpg" rel="lightbox"><img src="<?php echo bloginfo("template_directory"); ?>/img/event1-300.jpg" alt="event1" /></a>
			<a href="<?php echo bloginfo("template_directory"); ?>/img/event2.jpg" rel="lightbox"><img src="<?php echo bloginfo("template_directory"); ?>/img/event2-300.jpg" alt="event2" /></a>
			<a href="<?php echo bloginfo("template_directory"); ?>/img/event3.jpg" rel="lightbox"><img src="<?php echo bloginfo("template_directory"); ?>/img/event3-300.jpg" alt="event3" /></a>
			<a href="<?php echo bloginfo("template_directory"); ?>/img/event4.jpg" rel="lightbox"><img src="<?php echo bloginfo("template_directory"); ?>/img/event4-300.jpg" alt="event4" /></a>
		</section>
		<?php		
			endif;
			$tags = get_the_tags(); 
			if($tags != '' && $post_type !== "shops"):
		?>
	<section id="tags">
		<h4 role="heading" aria-level="4">Similar content</h4>
		<?php
			foreach($tags as $tag):
		?>
		
		<?php			
			if($post_type == "post"){
				$loop = new WP_Query( array( 'post_type' => $post_type, 'posts_per_page' => 8, 'tag' => $tag->slug ) ); 
			}elseif($post_type == "videos" || $post_type == "images"){
				$loop = new WP_Query( array( 'post_type' => $post_type, 'posts_per_page' => 1, 'tag' => $tag->slug, 'orderby' => 'rand' , 'post__not_in' => array($post_id)) ); 
			}else{
				$loop = new WP_Query( array( 'post_type' => $post_type, 'posts_per_page' => 2, 'tag' => $tag->slug ) );
			}
			if($loop->have_posts()):
			
				if($post_type == 'post'):
			?>
				<section>
				<h5 role="heading" aria-level="5"><?php echo $post_category[0]->name; ?></h5>
			<?php else: ?>
				<section>
				<h5 role="heading" aria-level="5"><?php echo $tag->slug; ?></h5>
			<?php
				endif;
			endif;
			while ( $loop->have_posts() ) : $loop->the_post(); 
				$tag_post_id = get_the_ID();
				$post_title = get_the_title();
				if(strlen($post_title) > 25){
					$result = substr($post_title, 0, 25);
					$result .= "...";
				}else{
					$result = $post_title;		
				}
			?>				
			<?php			
				if($post_type == 'images'):
				$src = get_field('image');
			?>
					<div class="image">
						<a href="<?php echo the_permalink(); ?> " title="See it in bigger size">		
							<img src="<?php echo $src['sizes']['thumbnail']; ?>" alt="<?php echo get_the_title(); ?>" title="<?php echo get_the_title(); ?>" width="300" height="200" />
						</a>
						<p>
							<span class="title"><?php echo $result; ?></span>
							<span class="like-count"><?php if( function_exists('zilla_likes') ) zilla_likes(); ?></span>
						</p>						
					</div>		
				<?php elseif($post_type == 'videos'): ?>
				<div class="video">
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
				<?php elseif($post_type == 'post' && $tag_post_id != $post_id): ?>
				<div class="post-tags">
					<h6 role="heading" aria-level="6">				
						<a href="<?php the_permalink() ?>">
							<?php 
								$post_title = get_the_title(); 
								if(strlen($post_title) > 25){
									$result = substr($post_title, 0, 25);
									$result .= "...";
								}else{
									$result = $post_title;
								}
								echo $result;
							?>
						</a>
					</h6>
				</div>
			<?php endif; ?>
		<?php endwhile; ?>
		</section>
		<?php endforeach; ?>
	</section>
	<?php endif; ?>