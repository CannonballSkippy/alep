<?php
/**
 * Template part for displaying checkout page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package alep
 */

?>
	<div id="single-featured-media-container">

	</div>
	<header id="single-entry-header">
		<h1><?php the_title(); ?></h1>
	</header><!-- .entry-header -->
</div>
<div id="single-container">
	<div id="single-main" class="full-width" <?php body_class(); ?>>






		<div id="inside-article">
			<div id="article-main-content">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<div class="entry-content">
						<?php
							the_content( sprintf(
								/* translators: %s: Name of current post. */
								wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'alep' ), array( 'span' => array( 'class' => array() ) ) ),
								the_title( '<span class="screen-reader-text">"', '"</span>', false )
							) );

							wp_link_pages( array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'alep' ),
								'after'  => '</div>',
							) );
						?>
					</div><!-- .entry-content -->
				</article><!-- #post-## -->
			</div><!-- #article-main-content -->
		</div><!-- #inside-article -->


	<footer class="entry-footer">
		<?php if (is_user_logged_in() ) { ?>
		<div><?php edit_post_link('Edit post', '<p>', '</p>'); ?></div>
		<?php } ?>
	</footer><!-- .entry-footer -->
	</div>
	
</div>
<div id="single-comments-container">
	<div id="single-comments">
		<?php comments_template(); ?>
	</div>
<!-- 	<div id="single-comments-aside"></div>	 -->		
</div>
<!-- #single and page :: with sidebar -->