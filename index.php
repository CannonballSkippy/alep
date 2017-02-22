<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package alep
 */

get_header(); ?>

			<?php get_template_part('searchform'); ?>

			<div id="site-content">
					<div class="grid-container">
						<?php
						    if( have_posts() ) {
						        while( have_posts() ) {
						            the_post();
						            $format = get_post_format();
						            $format = ( FALSE !== $format ) ? $format : 'default';

						            get_template_part( 'template-parts-front/front', $format );
						        }
						    }
						?>
						<div id="site-pagination-container">
							<?php alep_paging_nav(); ?>		
						</div>
					</div>
					


<?php
get_footer();