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
			<?php get_template_part('searchform'); ?>
				<!-- single and page :: with sidebar -->
				<div id="single" <?php body_class(); ?>>
					<div id="single-main-media">
						<?php
						    if( have_posts() ) {
						        while( have_posts() ) {
						            the_post();
						            $format = get_post_format();
						            $format = ( FALSE !== $format ) ? $format : 'default';

						            get_template_part( 'template-parts-page/page', $format );
						        }
						    }
						?>

<?php
//get_sidebar();
get_footer();