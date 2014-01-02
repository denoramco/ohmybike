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
		// verify content
		if(empty($content)){
			$_SESSION['errorContent'] = "Enter a content please.";
			$valid = false;
		}else{
			$valid = true;
		}
		
		// envoi des donnees si verif ok
		if($valid){
			$post_data = array(
			  'comment_status' => 'open',
			  'ping_status'    => 'closed',
			  'post_type'      => 'post',
			  'post_status'    => 'publish',
			  'post_title'     => $title,	
			  'post_content'   => $content
			);
			$categories[] = $category;
			$post_id = wp_insert_post( $post_data );			
			wp_set_post_categories( $post_id, $categories );
		}
		
		if (!$is_ajax) {
			header('Location: '.$_SERVER['HTTP_REFERER']);
		}else{
			echo($msg?$msg:'The spot has been referenced');
		}
	}
?>