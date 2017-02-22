<?php
/**
 * Template part for displaying video posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package alep
 */

?>

	<div id="single-featured-media-container">
		<?php
			// Get the video URL and put it in the $video variable
			$videoID = get_post_meta($post->ID, 'alep_youtube_embedding', true);
			// Check if there is in fact a video URL
			if ($videoID) {
				echo '<div class="video-container no-print">';
				// Echo the embed code via oEmbed
				echo wp_oembed_get( 'http://www.youtube.com/watch?v=' . $videoID ); 
				echo '</div>';
			}
		?>

	</div>

	<!-- <header id="single-entry-header"> -->
		<!-- <h1><?//php the_title(); ?></h1> -->
		<!-- <p class="preamble"><?php //echo do_shortcode( get_post_meta( get_the_id(), 'alep_preamble_meta_box', true ) ); ?></p> -->
	<!-- </header> --><!-- .entry-header -->

</div>
<div id="single-container">
	<div id="single-main">

		<div id="inside-article">
			<div id="article-main-content">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<div class="entry-content">				

						<?php if (empty_content($post->post_content)) {} elseif ($post->post_content) {
							echo "<h1>";
							the_title();
							echo "</h1>";
						} ?>
					
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

	</footer><!-- .entry-footer -->
	</div>
	
	<?php if (empty_content($post->post_content)) get_template_part( 'template-parts-single/single-sidebar2' ); elseif ($post->post_content) {
		get_template_part( 'template-parts-single/single-sidebar' );
	} ?>
	<?php //get_template_part( 'template-parts-single/single-sidebar' ); ?>
</div>
<div id="single-comments-container">
	<div id="single-comments">
		<?php comments_template(); ?>
	</div>
<!-- 	<div id="single-comments-aside"></div>	 -->		
</div>
<!-- #single and page :: with sidebar -->