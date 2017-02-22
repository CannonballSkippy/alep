<div id="single-aside">
	<p class="first-meta sidebar-title">Article:</p>
	<div class="single-post-meta">
			<!-- <p class="avatar"><?php //echo get_avatar( get_the_author_email(), '70', '/images/no_images.jpg', get_the_author() ); ?></p> -->
			<span>
			<p class="author">Author: <?php the_author(); ?></p>
			<p class="posted">Posted: <?php the_date('M j, Y'); ?></p>
			<p class="updated">Updated: <?php the_modified_date('M j, Y'); ?> at <?php the_modified_date('H:s'); ?></p>
			<p class="categories">Categories: <br><?php the_category( '<br>' ); ?></p>
			</span>
	</div>

		<?php alep_related_posts_by_category(); ?>

	<!-- <h1 class="title">Share links:</h1> -->
	<!-- <div class="single-post-meta"> -->
			<!-- <input class="url-input" type="url" value="<?php //echo get_permalink( $post->ID ); ?>"> -->
			
			<!-- Display Jetpack's sharing buttons here -->
			<?php 

			if ( function_exists( 'sharing_display' ) ) {
				echo "<p class=\"sidebar-title\">Share links:</p>\n";
			    sharing_display( '', true );
			}

			if ( class_exists( 'Jetpack_Likes' ) ) {
			    $custom_likes = new Jetpack_Likes;
			    echo $custom_likes->post_likes( '' );
			}
			?>
			<!-- 						 -->

	<!-- </div> -->

	<!-- https://wpshed.com/wordpress/create-custom-meta-box-easy-way/ -->
	<?php //echo do_shortcode( get_post_meta( get_the_id(), 'alep_delightful_downloads_shortcode', true ) ); ?>
	<?php //echo do_shortcode( get_post_meta( get_the_id(), 'alep_easy_digital_downloads', true ) ); ?>
	
	<?php if (is_user_logged_in() ) { ?>
	<div><?php edit_post_link('Edit article', '<p>', '</p>'); ?></div>
	<?php } ?>

</div>

