<div class="content clickablediv dot-ellipsis dot-load-update">
	<h1 class="title"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"> <?php $thetitle = $post->post_title; /* or you can use get_the_title() */ $getlength = strlen($thetitle); $thelength = 95; echo substr($thetitle, 0, $thelength); if ($getlength > $thelength) echo "..."; ?> </a></h1>
	<?php echo '<p class="excerpt">' . get_the_excerpt() . '</p>'; ?>
</div>




<!-- <div class="meta"> -->
	<!-- <span class="date"> -->
		<!-- <i class="alep-icon calendar"></i>&nbsp;</i> --><?php //echo my_entry_published_link(); ?>
	<!-- </span> -->

	<?php
	    // $categories = get_the_category();
	    // foreach( $categories as $category) {
	    //     $name = $category->name;
	    //      $uname = sanitize_key($name);
	    //     $category_link = get_category_link( $category->term_id );
	    //     echo "
	    //     <a href='$category_link' title='$name' class='iconlink'><span class='caticon $uname alep-icon'></span>
	    //          </a>";
	    // }
	?>
<!-- </div> -->