<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package alep
 */

get_header(); ?>
				<?php get_template_part('searchform'); ?>
				
				<!-- single and page :: with sidebar -->
				<div id="single" <?php body_class(); ?>>
					<div id="single-main-media">
						<?php
						while ( have_posts() ) : the_post();

						get_template_part( 'template-parts-single/single', get_post_format() );

						//the_post_navigation();

						endwhile; // End of the loop.
						?>

<?php
//get_sidebar();
get_footer();