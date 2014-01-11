<?php
/**
 * The template for displaying Category pages.
 *
 * Used to display archive-type pages for posts in a category.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
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
		<h1 role="heading" aria-level="1">Learn with tips & tricks</h1>
		<h2 role="heading" aria-level="2"><?php echo get_category(get_query_var('cat'))->name; ?></h2>
	</header>
	<div class="content-menu forum <?php if ( is_user_logged_in() ){echo 'connected';}else{echo 'unconnected';}; ?>">
		<?php if ( is_user_logged_in() ):
			$erreurTitre = $_SESSION['errorTitle']; 
			$erreurContent = $_SESSION['errorContent'];
			session_destroy();
		?>
			<ul>
				<li><button id="add-article" class="off">Add new article</button></li>
			</ul>
			<form method="post" action="<?php echo get_template_directory_uri(); ?>/create-article.php" class="add-article">
				<fieldset>
					<label for="title">Title <span class="required">*</span></label>
					<?php if(isset($erreurTitre)): ?>
						<input id="title" class="error" name="title" type="text" required />
						<p class="error"><?php echo $erreurTitre; ?></p>
					<?php else: ?>		
						<input id="title" name="title" type="text" required />
					<?php endif; ?>
				</fieldset>
				<fieldset>
					<label for="category">Category</label>
					<select name="category" id="category" disabled>
						<?php 
							$cat_id = get_query_var('cat');
						?>
						<option value="<?php echo $cat_id;  ?>"><?php echo   get_category($cat_id)->name; ?></option>
					</select>
				</fieldset>
				<fieldset>
					<label for="postTags">Post Tag</label>
					<select name="postTags" id="postTags">
						<option value="en">English</option>
						<option value="fr">Français</option>
					</select>
				</fieldset>
				<fieldset>
					<label for="content">Content<span class="required">*</span></label>
					<p class="advice">Don't forget to close tags. If you are not familiar with tags, just click on a button then write your text and click again on the same button.</p>
					<?php if(isset($erreurContent)): ?>
						<?php 
							$editor_settings = array(
								'media_buttons' => false,
							); 
							wp_editor( '' , 'content' , $editor_settings);
						?>
						<p class="error"><?php echo $erreurContent; ?></p>
					<?php else: ?>
						<?php 
							$editor_settings = array(
								'media_buttons' => false,
								'quicktags' => array(
									'visual' => false,
									'text' => true
								)
							); 
							wp_editor( '' , 'content' , $editor_settings);
						?>
					<?php endif; ?>
				</fieldset>
				<button class="button" type="submit" name="submit">Post</button>
			</form>		
		<?php endif; ?>
	</div>
	<nav id="forum-menu" class="<?php if ( is_user_logged_in() ){echo 'connected';}else{echo 'unconnected';}; ?>">	
		<h3 class="hidden"role="heading" aria-level="3">Forum navigation</h3>
		<ul>
			<li><a href="<?php bloginfo( 'wpurl' ); ?>/learn-with-tips-and-tricks"><span class="name">All forums</span></a></li>
			<?php 
				$current_category = get_query_var('cat');
				$the_category = get_category($current_category);
				$categories = get_categories(array('hide_empty' => 0));
				foreach($categories as  $category): 
			?>						
			<li <?php if($category->term_id == $current_category){echo 'class="active"';}?>>
				<a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" title="<?php echo $category->name; ?>">
					<span class="name"><?php echo $category->name; ?></span>
					<span class="description"><?php echo $category->category_description; ?></span>
				</a>
			</li>
			<?php endforeach; ?>
		</ul>
		<form action="" id="mobile-forum-menu" <?php if ( is_user_logged_in() ){echo 'class="connected"';}else{ echo 'class="unconnected"';};?>>
			<div>
				<label for="categories">Select a category : </label>
				<select name="categories" id="categories">
					<option value="<?php bloginfo( 'wpurl' ); ?>/learn-with-tips-and-tricks">All forums</option>
					<?php foreach($categories as $category): ?>
						<?php if($category->term_id == $current_category): ?>
					<option value="<?php echo esc_url(get_category_link($category->term_id)); ?>" selected="selected"><?php echo $category->name; ?></option>
						<?php else: ?>
					<option value="<?php echo esc_url(get_category_link($category->term_id)); ?>"><?php echo $category->name; ?></option>
						<?php endif; ?>				
					<?php endforeach; ?>
				</select>
			</div>
		</form>
	</nav>
	<div id="wrap">
		<table class="articles">
			<thead>
				<tr>
					<th>Subject</th>
					<th>Author</th>
					<th>Date</th>
					<th>Likes</th>
					<th>Comments</th>
				</tr>
			</thead>
			<tbody>			
				<?php
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;			
					$loop = new WP_Query( array( 'post_type' => 'post' , 'cat' => $current_category , 'paged' => $paged, 'posts_per_page' => 2 ) );
										
					while ( $loop->have_posts() ) : $loop->the_post(); 
					$postTags = get_the_tags();
				?>
				<tr>
					<td>
						<p>
							<a href="<?php echo the_permalink(); ?>">
								<?php foreach($postTags as $tag){
									if($tag->name == "En"){							
										echo "[EN] ";
									}elseif($tag->name == "Fr"){							
										echo "[FR] ";
									}; 
								};
								?>
								<?php echo get_the_title(); ?>
							</a>
						</p>
					</td>
					<td><p><?php echo get_the_author(); ?> </p></td>
					<td><p><?php echo get_the_date(); ?> @ <?php echo get_the_time(); ?></p></td>
					<td><p class="like-count"><?php if( function_exists('zilla_likes') ) zilla_likes(); ?></p></td>
					<td><p class="comment-count"><a href="<?php echo the_permalink(); ?>#respond"><span class="icon-comment"></span>&nbsp;<?php comments_number(__('0', 'omb'), __('1', 'omb'), __('%', 'omb')); ?></a></p></td>
				</tr>
				<?php
					endwhile; 
				?>
			</tbody>
		</table>
		<?php if( $loop->max_num_pages > 1 ):?>
			<nav class="pager">
				<?php
					$big = 999999999; // need an unlikely integer

					echo paginate_links( array(
						'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format' => '?paged=%#%',
						'current' => max( 1, get_query_var('paged') ),
						'total' => $loop->max_num_pages
					) );
					?>
				<?php				
					$path = $_SERVER['REQUEST_URI'];
					preg_match_all('!\d+!', $path, $npage);
					$current_page = $npage[0][0];
					if($current_page == 0){
						$current_page = 1;
					}
				?>
				<?php if($paged > 1): ?>					
					<a href="<?php echo bloginfo("wpurl").'/learn-with-tips-and-tricks/' . $the_category->slug . '/page/'.($current_page-1);?>" class="paginate previous">Previous</a>
				<?php endif;
				for($i=1;$i<=$loop->max_num_pages;$i++):?>
					<a href="<?php echo bloginfo("wpurl").'/learn-with-tips-and-tricks/' . $the_category->slug . '/page/'.$i;?>" class="paginate <?php echo ($paged==$i)? 'active':'';?>"><?php echo $i;?></a>
					<?php
				endfor;
				if($paged < $loop->max_num_pages):?>
					<a href="<?php echo bloginfo("wpurl").'/learn-with-tips-and-tricks/' . $the_category->slug . '/page/'.($current_page+1);?>" class="paginate next">Next</a>
				<?php endif; ?>
			</nav>
		<?php endif; ?>
		<div class="mobile-articles">
		<?php
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;					
			$mobile_loop = new WP_Query( array( 'post_type' => 'post' , 'cat' => $current_category , 'paged' => $paged, 'posts_per_page' => 7 ) );
			
			while ( $mobile_loop->have_posts() ) : $mobile_loop->the_post(); 
			$postTags = get_the_tags();
		?>
		<article>
			<h4 role="heading" aria-level="4">
				<a href="<?php echo the_permalink(); ?>">
					<?php 
					foreach($postTags as $tag){
						if($tag->name == "En"){							
							echo "[EN] ";
						}elseif($tag->name == "Fr"){							
							echo "[FR] ";
						}; 
					};
					?>
					<?php echo get_the_title(); ?>
				</a>
			</h2>
			<p>Posted by <?php echo get_the_author(); ?> </p>
			<p><?php echo get_the_date(); ?> @&nbsp;<?php echo get_the_time(); ?></p>
			<p class="like-count"><?php if( function_exists('zilla_likes') ) zilla_likes(); ?></p>
			<p class="comment-count"><a href="<?php echo the_permalink(); ?>#respond"><span class="icon-comment"></span>&nbsp;<?php comments_number(__('0', 'omb'), __('1', 'omb'), __('%', 'omb')); ?></a></p>
		</article>
		<?php
			endwhile; 
		?>
		</div>		
		<?php if( $mobile_loop->max_num_pages > 1 ):?>
			<nav class="mobile pager">
				<?php
					$path = $_SERVER['REQUEST_URI'];
					preg_match_all('!\d+!', $path, $npage); // return array with end of url path, 2 levels of array npage[0][0] to get real npage
					$current_page = $npage[0][0];
					if($current_page == 0){
						$current_page = 1;
					}
				?>
				<?php if($paged > 1): ?>					
					<a href="<?php echo bloginfo("wpurl").'/category/' . $the_category->slug . '/page/'.($current_page-1);?>" class="paginate previous">Previous</a>
				<?php endif;
				for($i=1;$i<=$loop->max_num_pages;$i++):?>
					<a href="<?php echo bloginfo("wpurl").'/category/' . $the_category->slug . '/page/'.$i;?>" class="paginate <?php echo ($paged==$i)? 'active':'';?>"><?php echo $i;?></a>
					<?php
				endfor;
				if($paged < $loop->max_num_pages):?>
					<a href="<?php echo bloginfo("wpurl").'/category/' . $the_category->slug . '/page/'.($current_page+1);?>" class="paginate next">Next</a>
				<?php endif; ?>
			</nav>
		<?php endif; ?>		
	</div>
<?php get_footer(); ?>