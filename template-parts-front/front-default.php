<div id="post-<?php the_ID(); ?>" <?php post_class('grid-item-wrapper'); ?>>
	<div class="inner">
		<div class="featured-image clickablediv" >
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"></a>
			<?php
				// Check if the post has a Post Thumbnail assigned to it
				if ( has_post_thumbnail() ) {
				echo '<a href="' . get_permalink($post->ID) . '" >';
				the_post_thumbnail('frontpage-thumbnail');
				echo '</a>';
				} else {
				echo '<a href="' . get_permalink($post->ID) . '" >
					<div  
					style="background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVQYV2NQVFL9DwACOAFognNXOgAAAABJRU5ErkJggg==) 
					repeat; 
					height: 100%; 
					width:100%;
					"></div></a>';}
			?>
		</div>
		<?php get_template_part( 'template-parts-front/homepage-card-text-content' ); ?>
	</div><!-- /.ms-item-margin -->
</div>