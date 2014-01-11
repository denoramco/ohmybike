<?php
/*
 * Template Name: FORUM

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
<div id="main-content">
	<aside id="sidebar">
		<h2 class="hidden">Events, News & Comments</h2>
		<?php get_template_part('content-events'); ?>
		<?php get_template_part('latest-news'); ?>
		<?php get_template_part('recent-comments'); ?> 
	</aside>
	<header class="banner" role="banner">
		<p  id="logo"><a href="<?php echo bloginfo('url'); ?>" title="home" alt="home">home</a></p>
		<h1>Learn with tips & tricks</h1>
		<h2>All forums</h2>
	</header>
	<div class="content-menu forum <?php if ( is_user_logged_in() ){echo 'connected';}else{echo 'unconnected';}; ?>">
	<?php if ( is_user_logged_in() ):
		$erreurTitre = $_SESSION['errorTitle']; 
		$erreurContent = $_SESSION['errorContent'];
		session_destroy();
		$title = ( array_key_exists( 'title', $_GET ) ) ? trim( $_GET['title'] ) : false;
	?>		
			<ul>
				<li><button id="add-article" class="off">Add new article</button></li>
			</ul>			
			<form method="post" action="<?php echo get_template_directory_uri(); ?>/create-article.php" class="add-article">
				<fieldset>
					<label for="title">Title <span class="required">*</span></label>
					<?php if(isset($erreurTitre)): ?>
						<input id="title" class="error" value="<?php echo stripslashes( $title ); ?>" name="title" type="text" required />
						<p class="error"><?php echo $erreurTitre; ?></p>
					<?php else: ?>		
						<input id="title" name="title" value="<?php echo stripslashes( $title ); ?>" type="text" required />
					<?php endif; ?>
				</fieldset>
				<fieldset>
					<label for="category">Category</label>
					<select name="category" id="category">
						<option value="1">Unclassed</option>
						<option value="9">Dirt quad</option>
						<option value="10">Motocross</option>
						<option value="11">Dirt bike & BMX</option>
						<option value="12">Mountain bike</option>
						<option value="13">Your own gear</option>
					</select>
				</fieldset>
				<fieldset>
					<label for="postTags">Post Tag</label>
					<select name="postTags" id="postTags">
						<option value="En">English</option>
						<option value="Fr">Français</option>
					</select>
				</fieldset>
				<fieldset>
					<label for="content">Content<span class="required">*</span></label>
					<p class="advice">Don't forget to close tags. If you are not familiar with tags, just click on a button then write your text and click again on the same button.</p>
					<?php if(isset($erreurContent)): ?>
						<?php 
							$editor_settings = array(
								'media_buttons' => false,
								'textarea_row' => get_option('default_post_edit_rows', 40)
							); 
							wp_editor( '' , 'content' , $editor_settings);
						?>
						<p class="error"><?php echo $erreurContent; ?></p>
					<?php else: ?>
						<?php 
							$editor_settings = array(
								'media_buttons' => false
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
		<h3 class="hidden">Forum navigation</h3>
		<ul>
			<li class="active"><a href="<?php bloginfo( 'wpurl' ); ?>/learn-with-tips-and-tricks"><span class="name">All forums</span></a></li>
			<?php 
				$categories = get_categories(array('hide_empty' => 0));
				
				foreach($categories as  $category): 
			?>
			<li>
				<a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" title="<?php echo $category->name; ?>">
					<span class="name"><?php echo $category->name; ?></span>
					<span class="description"><?php echo $category->category_description; ?></span>
				</a>
			</li>
			<?php endforeach; ?>
		</ul>
		<form action="" id="mobile-forum-menu"  <?php if ( is_user_logged_in() ){echo 'class="connected"';}else{ echo 'class="unconnected"';};?>>
			<div>
				<label for="categories">Select a category : </label>
				<select name="categories" id="categories">
					<option value="<?php bloginfo( 'wpurl' ); ?>/learn-with-tips-and-tricks">All forums</option>
					<?php foreach($categories as $category): ?>
					<option value="<?php echo esc_url(get_category_link($category->term_id)); ?>"><?php echo $category->name; ?></option>
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
					$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
					$loop = new WP_Query( array( 'post_type' => 'post' , 'paged' => $paged ) );
					
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
					<td><p><?php echo get_the_date(); ?> @&nbsp;<?php echo get_the_time(); ?></p></td>
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
					preg_match_all('!\d+!', $path, $npage); // return array with end of url path, 2 levels of array npage[0][0] to get real npage
					$current_page = $npage[0][0];
					if($current_page == 0){
						$current_page = 1;
					}
				?>
				<?php if($paged > 1): ?>					
					<a href="<?php echo bloginfo("wpurl").'/learn-with-tips-and-tricks/page/'.($current_page-1);?>" class="paginate previous">Previous</a>
				<?php endif;
				for($i=1;$i<=$loop->max_num_pages;$i++):?>
					<a href="<?php echo bloginfo("wpurl").'/learn-with-tips-and-tricks/'.$i;?>" class="paginate <?php echo ($paged==$i)? 'active':'';?>" ><?php echo $i;?></a>
					<?php
				endfor;
				if($paged < $loop->max_num_pages):?>
					<a href="<?php echo bloginfo("wpurl").'/learn-with-tips-and-tricks/page/'.($current_page+1);?>" class="paginate next">Next</a>
				<?php endif; ?>
			</nav>
		<?php endif;?>
		<div class="mobile-articles">
		<?php
			$mobile_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;					
			$mobile_loop = new WP_Query( array( 'post_type' => 'post' , 'paged' => $mobile_paged, 'posts_per_page' => 7 ) );
			
			while ( $mobile_loop->have_posts() ) : $mobile_loop->the_post(); 
			$postTags = get_the_tags();
		?>
		<article itemscope>
			<h2 itemprop="post-name">
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
			<p itemprop="post-author">Posted by <?php echo get_the_author(); ?> </p>
			<p itemprop="post-time"><?php echo get_the_date(); ?> @&nbsp;<?php echo get_the_time(); ?></p>
			<p class="like-count" itemprop="post-likes"><?php if( function_exists('zilla_likes') ) zilla_likes(); ?></p>
			<p class="comment-count" itemprop="post-comment-count"><a href="<?php echo the_permalink(); ?>#respond"><span class="icon-comment"></span>&nbsp;<?php comments_number(); ?></a></p>
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
					<a href="<?php echo bloginfo("wpurl").'/learn-with-tips-and-tricks/page/'.($current_page-1);?>" class="paginate previous">Previous</a>
				<?php endif;
				for($i=1;$i<=$loop->max_num_pages;$i++):?>
					<a href="<?php echo bloginfo("wpurl").'/learn-with-tips-and-tricks/page/'.$i;?>" class="paginate <?php echo ($paged==$i)? 'active':'';?>" ><?php echo $i;?></a>
					<?php
				endfor;
				if($paged < $loop->max_num_pages):?>
					<a href="<?php echo bloginfo("wpurl").'/learn-with-tips-and-tricks/page/'.($current_page+1);?>" class="paginate next">Next</a>
				<?php endif; ?>
			</nav>
		<?php endif;?>		
	</div>	
	<?php get_footer(); ?>