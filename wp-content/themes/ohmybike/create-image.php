<?php
	session_start();
	
	require( '../../../wp-load.php' );
	require('../../../wp-admin/includes/media.php');
	require('../../../wp-admin/includes/image.php');	
	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){

		extract($_POST);
		$is_ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) ? true : false;
		$msg = '';	
		
		// verify title
		if(empty($imageTitle)){
			$_SESSION['emptyTitleImage'] = "Enter a title please.";
			$valid = false;
		}else{
			$valid = true;
		}
		// verify file
		if(empty($_FILES['image'])){
			$_SESSION['emptyFileUpload'] = "Upload an image.";
			$valid = false;
		}else{
			$valid = true;
		}
		// verify tags
		if(empty($imageTags)){
			$_SESSION['emptyTags'] = "Add tags to your image.";
			$valid = false;
		}else{
			$valid = true;
		}
		// envoi des donnees si verif ok
		if($valid){
			$post_data = array(
				'comment_status' => 'open',
				'ping_status'    => 'closed',
				'post_type'   	=> 'images',
				'post_status'    => 'publish',
				'post_title'   		=> $imageTitle
			);
			
			$post_id = wp_insert_post( $post_data ); // recup post id
			
			wp_set_post_tags( $post_id, $imageTags ); // set tags to post
			
			$upload_dir = wp_upload_dir(); // upload directory
			$image_data = file_get_contents($_FILES['image']['tmp_name']); 
			$filename = $_FILES['image']['name']; // image name
			if(wp_mkdir_p($upload_dir['path'])){
				$file = $upload_dir['path'] . '/' . $filename;
			}else{
				$file = $upload_dir['basedir'] . '/' . $filename;
			}			
			file_put_contents($file, $image_data);
			
			$wp_filetype = wp_check_filetype($filename, null );
			$attachment = array(
				'post_mime_type' => $wp_filetype['type'],
				'post_title' => sanitize_file_name($filename),
				'post_content' => '',
				'post_status' => 'inherit'
			);
			$attach_id = wp_insert_attachment( $attachment, $file, $post_id );
			
			add_post_meta($post_id, '_image', 'field_51dc00a9e81cf', false);
			add_post_meta($post_id, 'image', $attach_id , false);
			
			$attach_data = wp_generate_attachment_metadata( $attach_id, $file );
			wp_update_attachment_metadata( $attach_id, $attach_data );
			
		}		
		
		if (!$is_ajax) {
			header('Location: '.$_SERVER['HTTP_REFERER']);
		}else{
			echo($msg?$msg:'Your image has been uploaded');
		}
	}
?>