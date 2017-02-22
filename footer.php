<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package alep
 */

?>
			</div><!-- /#site-content -->
			<footer id="site-footer" class="no-print">
					<p class="footer-main"><?php echo comicpress_copyright(); ?>&nbsp;<?php bloginfo('name'); ?> - All rights reserved</p>
					<p>
						<span><a href="<?php echo get_site_url(); ?>/about">About</a></span>
						<span><a href="<?php echo get_site_url(); ?>/contact">Contact</a></span>
						<span><a href="<?php echo get_site_url(); ?>/termsofuse">Terms of Use</a></span>
						<span><a href="<?php echo get_site_url(); ?>/privacypolicy">Privacy Policy</a></span>
						<span><a href="<?php echo get_site_url(); ?>/rss">rss</a></span>
						<span><a href="<?php echo get_site_url(); ?>/rss2">rss2</a></span>
					</p>
			</footer>
		</div><!-- /#site-main -->
	</div><!-- /site-container -->

<?php wp_footer(); ?>
</body>
</html>