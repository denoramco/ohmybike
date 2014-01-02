<?php
	session_start();
	
	require( '../../../wp-load.php' );
	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){

		extract($_POST);
		$is_ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) ? true : false;
		$msg = '';	
		
		// verify title
		if(empty($title)){
			$_SESSION['emptyTitle'] = "Enter a title please.";
			$valid = false;
		}else{
			$valid = true;
		}
		// verify url if set
		if(!empty($website_url)){
			if(filter_var($website_url, FILTER_VALIDATE_URL)){
				$correct_url = $website_url;
				$valid = true;
			}else{
				$msg.='Enter a valid URL.';
				$_SESSION['errorURL'] = 'Enter a valid URL.';
				$valid = false;
				if( $is_ajax ){
					header('HTTP/1.0 404 Not Found');
					echo $msg;
					exit();
				}
			}
		}
		// verify street address
		if(empty($address)){
			$_SESSION['emptyAddress'] = "Enter an address please.";
			$valid = false;
		}
		// verify country
		if(empty($country)){
			$_SESSION['emptyCountry'] = "Enter a country please.";
			$valid = false;
		}
		// verify mail if set
		if(!empty($email)){
			if(filter_var($email, FILTER_VALIDATE_EMAIL)){
				$shop_email = $email;
				$valid = true;
			}else{
				$msg.='Enter a valid email';
				$_SESSION['errorMail'] = 'Enter a valid email. (ex: the@email.com)';
				$valid = false;
				if( $is_ajax ){
					header('HTTP/1.0 404 Not Found');
					echo $msg;
					exit();
				}
			}
		}		
		// verify images
		if(empty($_FILES['images'])){
			$_SESSION['emptyFileUpload'] = "Upload an image.";
			$valid = false;
		}else{
			$valid = true;
		}
		
		// send data if verif ok
		if($valid){
			$post_data = array(
			  'comment_status' => 'open',
			  'ping_status'    => 'closed',
			  'post_type'      => 'shops',
			  'post_status'    => 'publish',
			  'post_title'     => $title,	  
			);
			
			$post_id = wp_insert_post( $post_data );
			
			add_post_meta($post_id, 'website_url', $correct_url);
			add_post_meta($post_id, 'street_address', $address);
			add_post_meta($post_id, 'country', $country);
			add_post_meta($post_id, 'telephone', $telephone);
			add_post_meta($post_id, 'email', $shop_email);
			add_post_meta($post_id, 'description', $description);					
			
			$uploadedfile = $_FILES['images'];
			$upload_overrides = array( 'test_form' => false );
			$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
			
			$upload_dir = wp_upload_dir(); // upload directory
			
			$filename = str_replace( $wp_upload_dir['url'] . '/', '', $movefile['url'] );
			$wp_filetype = wp_check_filetype( basename($filename), null );
			
			$image_data = file_get_contents($_FILES['images']['tmp_name']); 
			$filename = $_FILES['images']['name']; // image name
			if(wp_mkdir_p($upload_dir['path'])){
				$filepath = $upload_dir['path'] . '/' . $filename;
			}else{
				$filepath = $upload_dir['basedir'] . '/' . $filename;
			}			
			file_put_contents($filepath, $image_data);
			
			$wp_filetype = wp_check_filetype($filename, null );
			$attachment = array(
				'post_mime_type' => $wp_filetype['type'],
				'post_title' => sanitize_file_name($filename),
				'post_content' => '',
				'post_status' => 'inherit'
			);
			$attach_id = wp_insert_attachment( $attachment, $filepath, $post_id );
			
			if ( wp_attachment_is_image( $attach_id ) ) {
				if ( ! function_exists( 'wp_generate_attachment_metadata' ) OR ! function_exists( 'wp_update_attachment_metadata' ))
					require_once( ABSPATH . 'wp-admin/includes/image.php' );

				$attach_data = wp_generate_attachment_metadata( $attach_id, $filepath );

				wp_update_attachment_metadata( $attach_id, $attach_data );
			} // if()
			
		} // endif valid
		
		if (!$is_ajax) {
			header('Location: '.$_SERVER['HTTP_REFERER']);
		}else{
			echo($msg?$msg:'The shop has been referenced');
		}
	}	
?>