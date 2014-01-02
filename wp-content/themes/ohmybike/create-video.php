<?php
	session_start();
	
	require( '../../../wp-load.php' );
	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){

		extract($_POST);
		$is_ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) ? true : false;
		$msg = '';	
		
		// verify title
		if(empty($videoTitle)){
			$_SESSION['emptyTitleVideo'] = "Enter a title please.";
			$valid = false;
		}else{
			$valid = true;
		}
		// verify tags
		if(empty($videoTags)){
			$_SESSION['emptyTags'] = "Add tags to your image.";
			$valid = false;
		}else{
			$valid = true;
		}
		// verify url if set
		if(!empty($video)){
			if(filter_var($video, FILTER_VALIDATE_URL)){
				if(substr($video, 0, 18)  === 'http://www.youtube'){
					$correct_url = "[youtube]" . $video . "[/youtube]" ;
					$valid = true;
				}else if(substr($video, 0, 22)  === 'http://www.dailymotion'){
					$correct_url = "[dailymotion]" . $video . "[/dailymotion]" ;
					$valid = true;
				}else if(substr($video, 0, 13)  === 'https://vimeo'){
					$correct_url = "[vimeo]" . $video . "[/vimeo]" ;
					$valid = true;
				}else{			
				$msg.='Enter youtube, dailymotion or vimeo URL.';
				$_SESSION['errorURL'] = 'Enter youtube, dailymotion or vimeo URL.';
				$valid = false;
				}
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
		}else{
			$msg.='Enter an URL.';
			$_SESSION['errorURL'] = 'Enter an URL.';
			$valid = false;
		}
		
		// envoi des donnees si verif ok
		if($valid){
			$post_data = array(
			  'comment_status' => 'open',
			  'ping_status'    => 'closed',
			  'post_type'      => 'videos',
			  'post_status'    => 'publish',
			  'post_title'     => $videoTitle,	  
			);
			
			$post_id = wp_insert_post( $post_data );
			
			wp_set_post_tags( $post_id, $videoTags ); // set tags to post
			
			add_post_meta($post_id, 'video', $correct_url);
			
			 wp_update_post( $post_id );
		}
		
		if (!$is_ajax) {
			header('Location: '.$_SERVER['HTTP_REFERER']);
		}else{
			echo($msg?$msg:'Your video has been uploaded');
		}
	}
?>