<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package alep
 */

get_header(); ?>
			<?php get_template_part('searchform'); ?>
			
			<div id="search-header"><h1><?php printf( esc_html__( 'Search Results for: "%s"', 'themename' ), '<span>' . get_search_query() . '</span>' ); ?></h1></div>
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

