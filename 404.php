<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package alep
 */

get_header(); ?>
			<?php get_template_part('searchform'); ?>
				<!-- single and page :: with sidebar -->
				<div id="single" <?php body_class(); ?>>
					<div id="single-main-media">
						</div>
						<div id="single-container">
							<div id="single-main" class="full-width">
								<div id="inside-article">
									<div id="article-main-content">
										<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

											<div class="entry-content" style="padding: 3% 10% 0 10% !important;">
														<h1 style="border-bottom:none !important; text-align:center; font-size: 3em;">Sorry, the page you are looking for could not be found. Please try to search for your topic...</h1>
														<?php echo '<img src="'. get_stylesheet_directory_uri() . '/img/404.png" />'; ?>
													</div>

												</div>
											</div><!-- .entry-content -->
										</article><!-- #post-## -->
									</div><!-- #article-main-content -->
								</div><!-- #inside-article -->



<?php
//get_sidebar();
get_footer(); 