<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package businesscarmanager
 * @since businesscarmanager 1.0
 */
global $woocommerce;
?>
	</div><!-- #main .site-main -->
	
	<footer id="footer" class="footer" role="contentinfo">
		<div class="container inner">
			<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_class' => 'clearfix menu', 'container' => 'nav', 'container_class' => 'secondary-navigation navigation', 'depth' => 2 )); ?>
			<div class="copyright">&copy; <b><?php bloginfo('name'); ?></b> <?php echo date("Y"); ?>. All Rights Reserved.</div>
			<div class="info">Business Car Manager Ltd is a company registered in England and Wales, number: 5581943. Registered offices: 10 Cardinals Walk, Hampton, Middx TW12 2TS. VAT registration number: 871 7461 04.</div>
			<span class="by">Site By <a href="http://www.kishandchips.com" title="Kish and Chips" target="_blank"><i class="icon-kishandchips"></i> <b>Kish &amp; Chips</b></a></span>
		</div>
	</footer><!-- #footer .site-footer -->

	<div id="lightbox" class="lightbox">
		<div class="lightbox-content content"></div>
		<div class="lightbox-overlay overlay"></div>
		<div class="lightbox-preloader preloader"></div>
		<button class="close-btn"></button>
	</div>
</div><!-- #wrap -->

<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '<?php the_field('google_analytics_account', 'options'); ?>']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>

<?php wp_footer(); ?>

</body>
</html>