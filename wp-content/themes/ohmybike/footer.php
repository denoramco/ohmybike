<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
			<?php if ( !is_user_logged_in() ): ?>
			<p class="warning">All contents are written by users, you must be <a class="gotologin" href="#login_tab" title="Go to login panel">logged in</a> to add content or add a comment.</p>
			<?php endif; ?>
			<footer>
				<p>&copy; Ohmywebstudio | Signal a problem, mail to : <a href="mailto:olivier.denomerenge@hotmail.com">olivier.denomerenge@hotmail.com</a></p>
			</footer>
		</div>
	<?php wp_footer(); ?>
	</body>
	<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDHJ3p-sn1Y5tJGrzH9MF5cbR5sdsDmhfg&sensor=false"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.colorbox-min.js"></script>
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-46675096-1', 'ohmywebstudio.be');
	  ga('send', 'pageview');

	</script>
</html>