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
	<div id="the-post">
	<?php $post_id = get_the_ID(); ?>
	<article id="post-<?php echo $post_id; ?>" <?php post_class(); ?>>
		<h4 role="heading" aria-level="4" itemprop="name"><?php the_title(); ?></h4>
		<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
		<div class="featured-post">
			<?php _e( 'Featured post', 'twentytwelve' ); ?>
		</div>
		<?php endif; ?>			
		
			<?php if( get_field('video')): ?>
			<div class="the-video">
				<?php echo do_shortcode(get_field('video')); ?>
			</div>
			<?php endif;?>
			<?php if( get_field('image')): ?>
			<div class="the-image">
				<a href="<?php $src = get_field('image'); echo $src['sizes']['large']; ?>" rel="lightbox"><img id="the-image" src="<?php echo $src['sizes']['medium']; ?>" alt="<?php echo $src['title']; ?>" width="<?php echo $src['sizes']['medium-width']; ?>" height="<?php echo $src['sizes']['medium-height']; ?>" /></a>
			</div>
			<?php endif;?>
			<?php if(get_field('website_url')): ?>
			<p><a href="<?php echo get_field('website_url'); ?>" target="_blank"><?php echo get_field('website_url'); ?></a></p>
			<?php endif; ?>
			<?php if(get_field('street_address')): ?>
				<address class="adr-gmap adr">
					<span class="street-address"><?php echo get_field('street_address'); ?></span>
					<?php if(get_field('country')): ?>
						<span class="country-name" itemprop="country-name"><?php echo get_field('country'); ?></span>
					<?php endif; ?>
				</address>
				<div id="gmap"></div>
			<?php endif; ?>
			<?php if(get_field('telephone')): ?>
			<p><?php echo get_field('telephone'); ?></p>
			<?php endif; ?>
			<?php if(get_field('email')): ?>
			<p><a href="mailto:<?php echo get_field('email'); ?>"><?php echo get_field('email'); ?></a></p>
			<?php endif; ?>
			<?php if(get_field('description')): ?>
			<p><?php echo get_field('description'); ?></p>
			<?php endif; ?>
		
		<?php if ( is_search() ) : ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div>
		<?php else : ?>
		<div class="entry-content">
			<?php the_content(); ?>
			<div>
				<p class="post-author">
					<span><?php echo get_the_date('d/m/Y @ G:i'); ?></span>
					<span>by</span>
					<span><?php echo get_the_author(); ?></span>				
				</p>
				<?php if( function_exists('zilla_likes') ) zilla_likes(); ?>
			</div>			
		</div>
		<?php endif; ?>
	</article>
	<?php 
		comments_template();?>
	</div>
		<?php 
			$post_type = get_post_type();
			if($post_type == "spots"):
		?>
		<section id="lightbox">
			<h3 role="heading" aria-level="3">Gallery</h3>
			<a href="<?php echo bloginfo("template_directory"); ?>/img/bikepark1.jpg" rel="lightbox"><img src="<?php echo bloginfo("template_directory"); ?>/img/bikepark1-300.jpg" alt="bikepark1" /></a>
			<a href="<?php echo bloginfo("template_directory"); ?>/img/bikepark2.jpg" rel="lightbox"><img src="<?php echo bloginfo("template_directory"); ?>/img/bikepark2-300.jpg" alt="bikepark2" /></a>
			<a href="<?php echo bloginfo("template_directory"); ?>/img/bikepark3.jpg" rel="lightbox"><img src="<?php echo bloginfo("template_directory"); ?>/img/bikepark3-300.jpg" alt="bikepark3" /></a>
			<a href="<?php echo bloginfo("template_directory"); ?>/img/bikepark4.jpg" rel="lightbox"><img src="<?php echo bloginfo("template_directory"); ?>/img/bikepark4-300.jpg" alt="bikepark4" /></a>
		</section>
		<?php elseif($post_type == "shops"): ?>
		<section id="lightbox">
			<h3 role="heading" aria-level="3">Gallery</h3>
			<a href="<?php echo bloginfo("template_directory"); ?>/img/bikeshop1.jpg" rel="lightbox"><img src="<?php echo bloginfo("template_directory"); ?>/img/bikeshop1-300.jpg" alt="bikeshop1" /></a>
			<a href="<?php echo bloginfo("template_directory"); ?>/img/bikeshop2.jpg" rel="lightbox"><img src="<?php echo bloginfo("template_directory"); ?>/img/bikeshop2-300.jpg" alt="bikeshop2" /></a>
			<a href="<?php echo bloginfo("template_directory"); ?>/img/bikeshop3.jpg" rel="lightbox"><img src="<?php echo bloginfo("template_directory"); ?>/img/bikeshop3-300.jpg" alt="bikeshop3" /></a>
			<a href="<?php echo bloginfo("template_directory"); ?>/img/bikeshop4.jpg" rel="lightbox"><img src="<?php echo bloginfo("template_directory"); ?>/img/bikeshop4-300.jpg" alt="bikeshop4" /></a>
		</section>
		<?php		
			endif;
			$tags = get_the_tags(); 
			if($tags != ''):
		?>
	<section id="tags">
		<h3 role="heading" aria-level="3">Tags</h3>
		<?php
			foreach($tags as $tag):
		?>
		<section>
			<h4 role="heading" aria-level="4"><?php echo $tag->slug; ?></h4>
		<?php			
			if($post_type == "post"){
				$loop = new WP_Query( array( 'post_type' => $post_type, 'posts_per_page' => 8, 'tag' => $tag->slug ) ); 
			}else{
				$loop = new WP_Query( array( 'post_type' => $post_type, 'posts_per_page' => 2, 'tag' => $tag->slug ) ); 
			}
			while ( $loop->have_posts() ) : $loop->the_post(); 
				$tag_post_id = get_the_ID();
				$post_title = get_the_title();
			?>				
			<?php			
				if($post_type == 'images' && $tag_post_id != $post_id):
				$src = get_field('image');
			?>
					<div>
						<a href="<?php echo the_permalink(); ?> ">		
							<img src="<?php echo $src['sizes']['thumbnail']; ?>" alt="<?php echo get_the_title(); ?>" title="<?php echo get_the_title(); ?>" width="300" height="200" />
						</a>			
					</div>		
				<?php elseif($post_type == 'videos' && $tag_post_id != $post_id): ?>
				<div>
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
				</div>
				<?php elseif($post_type == 'post' && $tag_post_id != $post_id): ?>
				<div class="post-tags">
					<h5 role="heading" aria-level="5">				
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
					</h5>
					<p class="content">
						<?php 
							$post_content = get_the_content(); 
							if(strlen($post_content) > 80){
								$result = substr($post_content, 0, 80);
								$result .= "...";
							}else{
								$result = $post_content;
							}
							echo $result;
						?>
					</p>
				</div>
			<?php endif; ?>
		<?php endwhile; ?>
		</section>
		<?php endforeach; ?>
	</section>
	<?php endif; ?>