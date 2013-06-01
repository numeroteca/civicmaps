<?php include( get_stylesheet_directory(). '/general-vars.php' ); ?>
	</div><!-- end id content -->
	<hr />

	<footer id="epi" class="row-fluid">
		<div class="span12">
		<?php // navigation menu
		$menu_slug = "footer-menu";
			$args = array(
				'theme_location' => $menu_slug,
				'container' => 'false',
				'menu_id' => 'epimenu',
				'menu_class' => 'unstyled inline pull-left',
			);
				wp_nav_menu( $args );
		?>

		<div id="social" class="pull-right">
			<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
			<!--div class="fb-like" data-href="http://www.facebook.com/spainlab" data-send="true" data-layout="button_count" data-width="150" data-show-faces="false"></div-->

			<a href="https://twitter.com/civicmit" class="twitter-follow-button" data-show-count="false">Follow @civicmit</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

			<a href="https://twitter.com/share" class="twitter-share-button" data-via="civicmit">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		</div>

		</div><!-- end class centrator-->
	</footer>
</div><!-- /container -->
<?php // stats code
echo $general_options['stats_code']; ?>

<script type="text/javascript" src="<?php echo $general_options['blogtheme']. "/js/add.field.js"; ?>"></script>
<script type="text/javascript" src="<?php echo $general_options['blogtheme']. "/js/flus.js"; ?>"></script>
<script type="text/javascript" src="<?php echo $general_options['blogtheme']. "/js/autoplay.js"; ?>"></script>
<script type="text/javascript" src="<?php echo $general_options['blogtheme']. "/js/accordion.js"; ?>"></script>

<?php wp_footer(); ?>

</body><!-- end body as main container -->
</html>
