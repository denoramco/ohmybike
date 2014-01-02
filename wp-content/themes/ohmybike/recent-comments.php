<section id="recent-comments">
<h2 role="heading" aria-level="2">Recent comments</h2>
<?php
	$comment_args = array( 'number' => '3');
	$recent_comments = get_comments($comment_args);
	foreach( $recent_comments as $recent_comment ):
?>
		<div class="comment" >
			<p class="date">
				<span class="day">
				<?php					
					$comment_source = $recent_comment->comment_date;
					$comment_date = new DateTime($comment_source);
					echo $comment_date->format('d');
				?>
				</span>
				<span class="month">
				<?php 
					echo $comment_date->format('M');
				?>
				</span>
			</p>
			<h3 role="heading" aria-level="3"><span>@ <?php echo $comment_date->format('G:i:s'); ?></span>&nbsp;-&nbsp;<span itemprop="comment-author"><?php echo $recent_comment->comment_author; ?></span></h3>
			<p class="content"><?php echo $recent_comment->comment_content; ?></p>
		</div>
	<?php endforeach; ?>
</section>