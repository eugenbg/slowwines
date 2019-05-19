<?php
/**
 * The footer template file
 *
 * @file           footer.php
 * @package        Impulse Press
 * @author         Two Impulse
 * @copyright      2014 Two Impulse
 * @license        license.txt
 * @version        Release: 1.3
 */
?>
	</div> <!--Wrap-->
 		<footer id="q23Foot">
		</footer>
		<?php echo impulse_press_options('tracking_footer'); ?>
        <script type="text/javascript" src="/js/usr.main.js"></script>
		<script type="text/javascript" src="/inc/vndr/masterslider/jquery.easing.min.js"></script>
		<script type="text/javascript" src="/inc/vndr/masterslider/masterslider.min.js"></script>
		<script type="text/javascript" src="/inc/vndr/megamenu/bootstrap-hover-dropdown.js"></script>
		<script type="text/javascript" src="/inc/vndr/megamenu/fitdivs.js"></script>
		<script type="text/javascript" src="/inc/vndr/jQuery/jq.form.js"></script>
		<script type="text/javascript" src="/inc/vndr/validate/jquery.validate.js"></script>
		<script type="text/javascript" src="/inc/vndr/multiSelect/js/bootstrap-multiselect.js"></script>
		<script type="text/javascript" src="/inc/vndr/cookiesDirective/jquery.cookiesdirective.js"></script>
		<?php wp_footer(); ?>
		<script>
			$( document ).ready
			(
				function()
				{
					$( "#q23Head" ).load( "/jx/get.blog.php?type=head&lng=en" );
					$( "#q23Foot" ).load( "/jx/get.blog.php?type=foot&lng=en" );
					
					$( '.navbar li ul' ).hide().removeClass( 'fallback' );
					$( '.navbar li.dropdown' ).hover
					(
						function()
						{
							$( 'ul', this ).stop().fadeIn( 240 );
						},
						function()
						{
							$( 'ul', this ).stop().fadeOut( 400 );
						}
					);
				}
			)
		</script>
		<style>
			.modal-backdrop.in { z-index: auto;}
		</style>
	</body>
</html>