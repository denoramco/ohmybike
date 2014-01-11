<?php
/*
 * Template Name: HOME

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
		<h1>Your new home</h1>
		<h2>Images & Videos</h2>
	</header>
		<?php if ( is_user_logged_in() ): 
				$erreurTitreImage = $_SESSION['emptyTitleImage']; 
				$erreurFileUpload = $_SESSION['emptyFileUpload'];
				$erreurTitreVideo = $_SESSION['emptyTitleVideo'];
				$erreurURL = $_SESSION['errorURL'];
				$erreurTags = $_SESSION['emptyTags'];
				session_destroy();
			?>
		<div class="content-menu home connected">
			<ul>						
				<li><button id="add-image" class="off">Add new image</button></li>
				<li><button id="add-video" class="off">Add new video</button></li>	
				<li>
					<form action="" class="filters">
						<div>
							<label for="filters">Tag filter : </label>
							<select id="filters" name="filters">
								<option value="all" selected="selected">All</option>
								<?php 
									$tags = get_tags();
									foreach($tags as $tag):	
									if($tag->description !== "forum"):
								?>
								<option value="<?php echo $tag->slug;?>"><?php echo $tag->name;?></option>	
								<?php endif;endforeach; ?>
							</select>
						</div>
					</form>
				</li>					
			</ul>
			<form method="post" action="<?php echo get_template_directory_uri(); ?>/create-image.php" class="add-image" enctype="multipart/form-data">
				<fieldset>
					<label for="imageTitle">Title <span class="required">*</span></label>
					<?php if(isset($erreurTitre)): ?>
						<input id="imageTitle" class="error" name="imageTitle" type="text" required />
						<p class="error"><?php echo $erreurTitre; ?></p>
					<?php else: ?>		
						<input id="imageTitle" name="imageTitle" type="text" required />
					<?php endif; ?>
				</fieldset>
				<fieldset>
					<label for="imageTags">Tags <span class="required">*</span></label>
					<p class="advice">Separate tags with commas (ex: Dirt Bike , Freestyle)</p>
					<?php if(isset($erreurTags)): ?>
						<input id="imageTags" class="error" name="imageTags" type="text" required />
						<p class="error"><?php echo $erreurTags; ?></p>
					<?php else: ?>
						<input id="imageTags" name="imageTags" type="text" required />
					<?php endif; ?>
				</fieldset>
				<fieldset>
					<label for="image">Your image <span class="required">*</span></label>
					<input type="file" id="image" name="image" required />
				</fieldset>
				<button class="button" type="submit" name="submit">Post image</button>
			</form>		
			<form method="post" action="<?php echo get_template_directory_uri(); ?>/create-video.php" class="add-video">
				<fieldset>
					<label for="videoTitle">Title <span class="required">*</span></label>
					<?php if(isset($erreurTitreVideo)): ?>
						<input id="videoTitle" class="error" name="videoTitle" type="text" required />
						<p class="error"><?php echo $erreurTitreVideo; ?></p>
					<?php else: ?>		
						<input id="videoTitle" name="videoTitle" type="text" required />
					<?php endif; ?>
				</fieldset>
				<fieldset>
					<label for="videoTags">Tags <span class="required">*</span></label>
					<p class="advice">Separate tags with commas (ex: Dirt Bike , Freestyle)</p>
					<?php if(isset($erreurTags)): ?>
						<input id="videoTags" class="error" name="videoTags" type="text" required />
						<p class="error"><?php echo $erreurTags; ?></p>
					<?php else: ?>
						<input id="videoTags" name="videoTags" type="text" required />
					<?php endif; ?>
				</fieldset>				
				<fieldset>
					<label for="video">Your video <span class="required">*</span></label>
					<p>Only youtube, dailymotion and vimeo are supported</p>
					<?php if(isset($erreurURL)): ?>
						<input type="text" id="video" name="video" class="error" placeholder="http://www.youtube.com/watch?v=yourvideocode" required />
						<p class="error"><?php echo $erreurURL; ?></p>
					<?php else: ?>		
						<input type="text" id="video" name="video" placeholder="http://www.youtube.com/watch?v=yourvideocode" required />
					<?php endif; ?>				
				</fieldset>
				<button class="button" type="submit" name="submit">Post video</button>
			</form>			
		</div>		
	<?php else: ?>
	<div class="content-menu home unconnected">
		<ul>
			<li>
				<form action="" class="filters">
					<div>
						<label for="filters">Tag filter : </label>
						<select id="filters" name="filters">
							<option value="all" selected="selected">All</option>
							<?php 
								$tags = get_tags();
								foreach($tags as $tag => $value):
								if($value->description !== "forum"):
							?>
							<option value="<?php echo $value->slug . ' ';?>"><?php echo $value->name . ' ';?></option>	
							<?php endif;endforeach; ?>
						</select>
					</div>
				</form>
			</li>
		</ul>
	</div>
	<?php endif; ?>
	<div id="gallery">		
		<?php get_template_part('content','images-videos'); ?>
	</div>

<?php get_footer(); ?>