<?php
 /*
 Template Name: Full Width
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