<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package alep
 */

get_header(); ?>

			<?php get_template_part('searchform'); ?>

			<div id="archive-header"><h1><?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				?></h1></div>
				<div class="spacer"></div>
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
						<div id="site-pagination">
							<?php alep_paging_nav(); ?>
						</div><!-- /#site-pagination -->
					</div><!-- /.grid-container -->

<?php
get_footer();
