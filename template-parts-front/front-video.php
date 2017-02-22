<div id="post-<?php the_ID(); ?>" <?php post_class('grid-item-wrapper'); ?>>
	<div class="inner">
		<div class="featured-image">
			<?php
					// Check if the post has a Youtube thumbnail (using custom field alep_youtube_embedding)
					if (get_post_meta($post->ID,'alep_youtube_embedding',true)) {
					echo '<a href="' . get_permalink($post->ID) . '" >';
					echo '<img src="http://img.youtube.com/vi/' . get_post_meta($post->ID,'alep_youtube_embedding',true) . '/maxresdefault.jpg"/>';
					echo '</a>';
					}
					// Check if the post has a Post Thumbnail assigned to it
					elseif ( has_post_thumbnail() ) {
					echo '<a href="' . get_permalink($post->ID) . '" >';
					the_post_thumbnail('frontpage-thumbnail');
					echo '</a>';
					}
					// If the post does not have a featured image then display the fallback image
					else {
					echo '<a href="' . get_permalink($post->ID) . '" >
					<img src="'. get_stylesheet_directory_uri() . '/img/fallback-image.jpg">
					</a>';
					}
					?>
		</div>
		<?php get_template_part( 'template-parts-front/homepage-card-text-content' ); ?>
	</div><!-- /.ms-item-margin -->
</div>