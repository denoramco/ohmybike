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
		
		// envoi des donnees si verif ok
		if($valid){
			$post_data = array(
			  'comment_status' => 'open',
			  'ping_status'    => 'closed',
			  'post_type'      => 'spots',
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
		}
		
		if (!$is_ajax) {
			header('Location: '.$_SERVER['HTTP_REFERER']);
		}else{
			echo($msg?$msg:'The spot has been referenced');
		}
	}
?>