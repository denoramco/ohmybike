<section id="recent-comments">
<h2 role="heading" aria-level="2">Recent comments</h2>
<?php
	$comment_args = array( 'number' => 3);
	$recent_comments = get_comments($comment_args);
	foreach( $recent_comments as $recent_comment ):
		//var_dump($recent_comments);
		$comment_source = $recent_comment->comment_date;
		$comment_date = new DateTime($comment_source);
?>
		<div class="comment">	
			<p class="date">
				<span class="day">
				<?php 
					echo $comment_date->format('d');
				?>
				</span>
				<span class="month">
				<?php 
					echo $comment_date->format('M');
				?>
				</span>
			</p>
			<h3 role="heading" aria-level="3">
				<a href="<?php echo get_permalink($recent_comment->comment_post_ID); ?>">				
				<?php 
					$content = $recent_comment->comment_content; 
					if(strlen($content) > 28){
						$result = substr($content, 0, 28);
						$result .= "...";
					}else{
						$result = $content;
					}
					echo $result;
				?>
				</a>
			</h3>				
			<p class="extra">
				<span class="icon-clock hour"> <?php echo $comment_date->format('H:i'); ?></span>
				<span>by</span>
				<span class="comment-author"> <?php echo $recent_comment->comment_author; ?></span>
				<span>on <a href="<?php echo get_permalink( $recent_comment->comment_post_ID ); ?>"><?php echo get_the_title($recent_comment->comment_post_ID); ?></a></span>
			<p>		
		</div>
	<?php endforeach; ?>
</section>