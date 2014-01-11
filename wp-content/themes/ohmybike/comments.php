<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to twentyeleven_comment() which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage ohmybike
 * @since ohmybike
 */
?>
<?php if ( have_comments() ) : ?> 

    <h3 id="comments-title">
        <?php comments_number(__('no comments'), __('1 comment'), __('% comments')); ?> to "<?php the_title(); ?>"		
    </h3>	
	
	<ol class="comments-list">
		<?php
			wp_list_comments(array( 'type' => 'comment', 'callback' => 'omb_comment'));
		?>
	</ol>	
	
	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Prev Comments', 'omb' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Next Comments <span class="meta-nav">&rarr;</span>', 'omb' ) ); ?></div>
			</div><!-- .navigation -->
	<?php endif; ?> 
	
<?php endif; // end have_comments() ?>

<?php if ( comments_open() ): ?>			
		<div id="respond">
		<?php preg_match( '#replytocom=?([0-9]{1,})#' , $_SERVER['REQUEST_URI'] , $comment_id , PREG_OFFSET_CAPTURE); ?>
		<?php if(!empty($comment_id)): ?>		
			<h2 id="leave-reply">Leave a reply to <?php comment_author( $comment_id[1][0] ); ?></h2>
		<?php else: ?>
	 		<h2 id="leave-reply">Leave a reply to "<?php the_title(); ?>"</h2>
		<?php endif; ?>
			<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
				<p>
					<?php global $guahanAjaxCommentsPlugin; if (isset($guahanAjaxCommentsPlugin)) { $guahanAjaxCommentsPlugin->renderCustomCommentField(); } else { echo '<textarea name="comment" id="comment" cols="50" rows="10" tabindex="4"></textarea>'; } ?>
				</p>
				<p>
					<input name="submit" type="submit" id="submit" tabindex="5" value="Send comment" />
					<?php comment_id_fields(); ?>
				</p>
				<?php do_action('comment_form', $post->ID); ?>
			</form>
		</div>
		
<?php endif; // end comments_open() ?>