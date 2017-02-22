<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package alep
 */
get_header(); ?>
				<!-- single and page :: with sidebar -->
				<div id="single" <?php body_class('full-width'); ?>>
					<div id="single-main-media">
						<?php
						while ( have_posts() ) : the_post();

						get_template_part( 'template-parts-page/page-checkout', get_post_format() );

						//the_post_navigation();

						endwhile; // End of the loop.
						?>

<?php
//get_sidebar();
get_footer();