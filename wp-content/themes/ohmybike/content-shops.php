<div class="content-menu shops <?php if ( is_user_logged_in() ){echo 'connected';}else{echo 'unconnected';}; ?>">
	<ul>
		<?php if ( is_user_logged_in() ): ?>		
		<li><button id="add-shop" class="off">Add new shop</button></li>
		<?php endif; ?>
		<li>
			<form action="" class="filters">
				<div>
					<label for="filters">Country filter : </label>
					<select id="filters" name="filters">
						<option value="all" selected="selected">All</option>
						<option value="Belgium">Belgium</option>
						<option value="France">France</option>
						<option value="Germany">Germany</option>
						<option value="Spain">Spain</option>
						<option value="Italy">Italy</option>
						<option value="Portugal">Portugal</option>
						<option value="Switzerland">Switzerland</option>
						<option value="Norway">Norway</option>
						<option value="Canada">Canada</option>
						<option value="United States">United States</option>
						<option value="United Kingdom">United Kingdom</option>
						<option value="Ireland">Ireland</option>
						<option value="The Netherlands">The Netherlands</option>
					</select>
				</div>
			</form>			
		</li>
	</ul>	
<?php if ( is_user_logged_in() ): ?>
	<?php 
		$erreurTitre = $_SESSION['emptyTitle']; 
		$erreurURL = $_SESSION['errorURL']; 
		$erreurAddress = $_SESSION['emptyAddress']; 
		$erreurCountry = $_SESSION['emptyCountry']; 
		$erreurEmail = $_SESSION['errorMail'];
		$erreurTags = $_SESSION['shopTags'];
		//$erreurUpload = $_SESSION['emptyFileUpload'];
		
		$successTitre = $_SESSION['successTitle'];
		$successURL = $_SESSION['successURL'];
		$successAddress = $_SESSION['successAddress'];
		$successCountry = $_SESSION['successCountry'];
		$successEmail = $_SESSION['successEmail'];
		$successTelephone = $_SESSION['successTelephone'];
		$successDescription = $_SESSION['successDescription'];
		$successBmx = $_SESSION['successBmx'];
		$successQuad = $_SESSION['successQuad'];
		$successMoto = $_SESSION['successMoto'];
		$successDirt = $_SESSION['successDirt'];
		$successDh = $_SESSION['successDh'];
		$successRepair = $_SESSION['successRepair'];
		
		session_destroy();		
	?>	
		<form method="post" action="<?php echo get_template_directory_uri(); ?>/create-shop.php" class="add-content add-shop">
			<fieldset>
				<label for="title">Title <span class="required">*</span></label>
				<?php if(isset($erreurTitre)): ?>
					<input id="title" class="error" name="title" type="text" required />
					<p class="error"><?php echo $erreurTitre; ?></p>
				<?php else: ?>
					<input id="title" name="title" value="<?php if(isset($successTitre)){echo $successTitre;} ?>" type="text" required />
				<?php endif; ?>
			</fieldset>
			<fieldset>
				<label for="website_url">Website url</label>			
				<?php if(isset($erreurURL)): ?>
					<input type="text" class="error" id="website_url" name="website_url" placeholder="http://www.thewebsite.com"  />
					<p class="error"><?php echo $erreurURL; ?></p>
				<?php else: ?>		
					<input type="text" id="website_url" name="website_url" value="<?php if(isset($successURL)){echo $successURL;} ?>" placeholder="http://www.thewebsite.com" />
				<?php endif; ?>
			</fieldset>
			<fieldset>
				<label for="street_address">Street address <span class="required">*</span></label>			
				<?php if(isset($erreurAddress)): ?>
					<input type="text" class="error" id="street_address" name="address"  required />
					<p class="error"><?php echo $erreurAddress; ?></p>
				<?php else: ?>		
					<input type="text" id="street_address" name="address" value="<?php if(isset($successAddress)){echo $successAddress;} ?>" required />
				<?php endif; ?>
				<label for="country">Country <span class="required">*</span></label>			
				<?php if(isset($erreurCountry)): ?>
					<select id="country" class="error" name="country">
						<option value="Belgium">Belgium</option>
						<option value="France">France</option>
						<option value="Germany">Germany</option>
						<option value="Spain">Spain</option>
						<option value="Italy">Italy</option>
						<option value="Portugal">Portugal</option>
						<option value="Switzerland">Switzerland</option>
						<option value="Norway">Norway</option>
						<option value="Canada">Canada</option>
						<option value="United States">United States</option>
						<option value="United Kingdom">United Kingdom</option>
						<option value="Ireland">Ireland</option>
						<option value="The Netherlands">The Netherlands</option>
					</select>
					<p class="error"><?php echo $erreurCountry; ?></p>
				<?php else: ?>		
					<select id="country" name="country">
						<?php if(isset($successCountry)): ?>
							<option value="<?php echo $successCountry; ?>" selected="selected"><?php echo $successCountry; ?></option>
						<?php endif; ?>
						<option value="Belgium">Belgium</option>
						<option value="France">France</option>
						<option value="Germany">Germany</option>
						<option value="Spain">Spain</option>
						<option value="Italy">Italy</option>
						<option value="Portugal">Portugal</option>
						<option value="Switzerland">Switzerland</option>
						<option value="Norway">Norway</option>
						<option value="Canada">Canada</option>
						<option value="United States">United States</option>
						<option value="United Kingdom">United Kingdom</option>
						<option value="Ireland">Ireland</option>
						<option value="The Netherlands">The Netherlands</option>
					</select>
				<?php endif; ?>
			</fieldset>
			<fieldset>
				<label for="telephone">Telephone</label>
				<input type="text" id="telephone" name="telephone" value="<?php if(isset($successTelephone)){echo $successTelephone;} ?>" />
			</fieldset>
			<fieldset>
				<label for="email">Email</label>			
				<?php if(isset($erreurEmail)): ?>
					<input type="text" class="error" id="email" name="email" placeholder="the@email.com" />
					<p class="error"><?php echo $erreurEmail; ?></p>
				<?php else: ?>		
					<input type="text" id="email" name="email" value="<?php if(isset($successEmail)){echo $successEmail;} ?>" placeholder="the@email.com"/>
				<?php endif; ?>
			</fieldset>
			<fieldset>
					<label>This shop sells or repairs : <span class="required">*</span></label>
					<?php if(isset($erreurTags)): ?>
						<p class="error"><?php echo $erreurTags; ?></p>
					<?php endif; ?>
						<input type="checkbox" name="bmxTag" id="bmxTag" value="BMX" class="taginput" <?php if($successBmx){echo 'checked="checked"';}; ?>>
					<label for="bmxTag" class="taglabel">BMX</label>
						<input type="checkbox" name="quadTag" id="quadTag" value="Quad" class="taginput" <?php if($successQuad){echo 'checked="checked"';}; ?>>
					<label for="quadTag" class="taglabel">Quad</label>
						<input type="checkbox" name="motoTag" id="motoTag" value="Motocross" class="taginput" <?php if($successMoto){echo 'checked="checked"';}; ?>>
					<label for="motoTag" class="taglabel">Motocross</label>
						<input type="checkbox" name="dirtTag" id="dirtTag" value="Dirtbike" class="taginput" <?php if($successDirt){echo 'checked="checked"';}; ?>>
					<label for="dirtTag" class="taglabel">Dirtbike</label>
						<input type="checkbox" name="dhTag" id="dhTag" value="Downhill Bike" class="taginput" <?php if($successDh){echo 'checked="checked"';}; ?>>
					<label for="dhTag" class="taglabel">Downhill Bike</label>
						<input type="checkbox" name="repairTag" id="repairTag" value="Repair" class="taginput" <?php if($successRepair){echo 'checked="checked"';}; ?>>
					<label for="repairTag" class="taglabel">Repair</label>
						
				</fieldset>
			<fieldset>
				<label for="description">Description</label>
				<textarea name="description" id="description" cols="50" rows="5" placeholder="You can also tell why you added it"><?php if(isset($successDescription)){echo $successDescription;} ?></textarea>
			</fieldset>
			<fieldset id="multi_images_uploader">
				<div id="multi_button">
					<label for="multi_images">Upload Image(s)</label>
					<input multiple="multiple" type="file" name="images" id="multi_images" />
				</div>
			</fieldset>
			<button class="button" type="submit" name="submit">Post</button>
		</form>	
<?php endif; ?>
</div>	
<div class="gallery">
	<?php $loop = new WP_Query( array( 'post_type' => 'shops', 'posts_per_page' => -1 ) ); ?>

	<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
	<article class="shop item vcard all <?php echo get_field('country'); ?>">
		<?php
			$titre = get_the_title();
			if(strlen($titre) > 16){
				$result = substr($titre, 0, 16);
				$result .= "...";
			}else{
				$result = $titre;
			}
		?>
		<h2 class="fn org"><a href="<?php echo the_permalink(); ?>"><?php echo str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($result)))); ?></a></h2>
		
		<address class="adr-link adr <?php echo get_field('country'); ?>">
		<?php if(get_field('street_address')): ?>
			<span class="street-address"><?php echo get_field('street_address'); ?></span>
		<?php endif; ?>
		<?php if(get_field('country')): ?>
			<span class="country-name"><?php echo get_field('country'); ?></span>
		<?php endif; ?>
		</address>

		<p class="like-count"><?php if( function_exists('zilla_likes') ) zilla_likes(); ?></p>
		<p class="comment-count"><a href="<?php echo the_permalink(); ?>#respond"><span class="icon-comment"></span>&nbsp;<?php comments_number(__('0', 'omb'), __('1', 'omb'), __('%', 'omb')); ?></a></p>
		<?php 
			$tags = get_the_tags(); 
			if($tags):
				foreach($tags as $tag):
			?>
			<span class="shoptag <?php echo $tag->slug; ?>" title="<?php echo $tag->name; ?>"></span>
			<?php
				endforeach;			
			endif;			
		?>
	</article>
	<?php endwhile; ?>	
</div>

