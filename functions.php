<?php

/*####################################################################################
####################################################################################

ALEP FUNCTIONS

####################################################################################
####################################################################################*/

/*[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
REGISTER MENUS
[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]*/

	register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'alep' ),
		) );

/*[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
LOAD THE THEMES SCRIPTS
[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]*/

	function alepscript() {
		wp_enqueue_script( 'alepscript', get_template_directory_uri() . '/js/alep.min.js', array( 'jquery' ), '1.0.0', true );

		wp_enqueue_script( 'dotdotdot', get_template_directory_uri() . '/js/dotdotdot.min.js', array( 'jquery' ), '1.8.3', true );
	}
	add_action( 'wp_enqueue_scripts', 'alepscript' );

/*[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
ENABLE FEATURED IMAGES FOR POSTS
[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]*/

	add_theme_support( 'post-thumbnails' );

	function featured_image_size() {
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1007, 567 );
	}
	add_action( 'after_setup_theme', 'featured_image_size' );

	// This is the largest size for the thumbnails on the frontpage:
	add_image_size( 'frontpage-thumbnail', 504,9999, false ); 
	// This is the largest size for the thumbnails on single pages:
	add_image_size( 'singlepage-thumb', 1250, 9999, false );

	// Sets the maximum image size limit to 1240px
	// http://wordpress.stackexchange.com/a/211405/82313
	add_filter('max_srcset_image_width', function($max_srcset_image_width, $size_array){
	    return 1250; /*This should be the same as the largest images you will have on your site*/
	}, 10, 2);

	/*==================================================================
	ADD CUSTOM SIZES TO THE MEDIA UPLOADER
	https://goo.gl/zjTXrT
	==================================================================*/

	if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'alep-full-width-relative-height', 836, 9999, false ); //(cropped)
	}
	add_filter('image_size_names_choose', 'my_image_sizes');
	function my_image_sizes($sizes) {
	$addsizes = array(
	"alep-full-width-relative-height" => __( "Alep - Full width, relative height")
	);
	$newsizes = array_merge($sizes, $addsizes);
	return $newsizes;
	}

	/*==================================================================
	http://www.hongkiat.com/blog/wordpress-related-posts-without-plugins/	
	==================================================================*/	

	// set_post_thumbnail_size( 100, 50, true );
	// add_image_size( 'sidebar-thumb', 70, 70, true ); //70 pixels wide for sidebar images

/*[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
ADD POST THUMBNAIL TO YOUR WORDPRESS RSS FEEDS
[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]*/
	
	/*http://www.wpbeginner.com/wp-tutorials/how-to-add-post-thumbnail-to-your-wordpress-rss-feeds*/

	function rss_post_thumbnail($content) {
	global $post;
	if(has_post_thumbnail($post->ID)) {
	$content = '<p>' . get_the_post_thumbnail($post->ID) .
	'</p>' . get_the_content();
	}
	return $content;
	}
	add_filter('the_excerpt_rss', 'rss_post_thumbnail');
	add_filter('the_content_feed', 'rss_post_thumbnail');

/*[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
CUSTOM LOGO
[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]*/
	/*Adds the ability to upload a custom logo through the WP Customizer*/

	add_theme_support('custom-logo', array(
	// The logo will be displayed with the following sizes:
	    'width' => 190,
	    'height' => 190,
	));

	// Sets a custom size for a secondary logo
	function mobile_header_logo( $downsize, $id, $size )
	{
	    //-------------------
	    // Edit to your needs
	    $size = [50,50];          // Array of width and height
	    // $size = 'thumbnail';   // String value with the image size name
	    //-------------------

	    remove_filter( current_filter(), __FUNCTION__ ); // Important to avoid recursive loop
	    return image_downsize( $id, $size );
	}

/*[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
FONTS ICONS / WEB-FONTS
[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]*/

	// Google fonts : Open Sans (For general text)
	// https://fonts.google.com/specimen/Open+Sans?selection.family=Open+Sans:300,400,700
	function add_google_fonts_opensans() {
	wp_enqueue_style( 'add_google_fonts_opensans', 'https://fonts.googleapis.com/css?family=Open+Sans:300light,400regular,700bold,300,400,700', false ); 
	}
	add_action( 'wp_enqueue_scripts', 'add_google_fonts_opensans' );

	// Google fonts : Roboto Condensed (For titles, headings and menus)
	// https://fonts.google.com/specimen/Roboto+Condensed
	function add_google_fonts_robotocondensed() {
	wp_enqueue_style( 'add_google_fonts_robotocondensed', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:400regular,700bold,400,700', false ); 
	}
	add_action( 'wp_enqueue_scripts', 'add_google_fonts_robotocondensed' );

	// Google fonts : Source Code Pro (For <code> tags)
	// https://fonts.google.com/specimen/Source+Code+Pro?selection.family=Source+Code+Pro
	function add_google_fonts_sourcecodepro() {
	wp_enqueue_style( 'add_google_fonts_sourcecodepro', 'https://fonts.googleapis.com/css?family=Source+Code+Pro:400regular,700bold,400,700', false ); 
	}
	add_action( 'wp_enqueue_scripts', 'add_google_fonts_sourcecodepro' );

	// Alep custom icons
	// A combination of custom icons and Font Awesome
	// fontello.com
	function enqueue_alep_icons(){
		wp_enqueue_style('alep-icons', get_stylesheet_directory_uri() . '/fonts/alep-icons/css/alep_icons.css'); 
	}
	add_action('wp_enqueue_scripts','enqueue_alep_icons');

/*[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
THEME STYLE SHEETS
[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]*/

	function alep_stylesheets() {

	// Styles required for theme description
		wp_register_style( 'alep-style',  get_template_directory_uri() .'style.css', array(), null, 'all' );

	// Theme styles
		wp_register_style( 'alep-alepstyles',  get_template_directory_uri() .'/style-sheets/alep.min.css', array(), null, 'all' );

	// Underscores default styles
	// http://underscores.me/
		wp_register_style( 'alep-underscores',  get_template_directory_uri() .'/style-sheets/underscores.min.css', array(), null, 'all' );

	// Animate.css
	// https://daneden.github.io/animate.css/

		wp_register_style( 'alep-animate',  get_template_directory_uri() .'/style-sheets/animate.min.css', array(), null, 'all' );

		wp_enqueue_style( 'alep-default' );
		wp_enqueue_style( 'alep-alepstyles' );
		wp_enqueue_style( 'alep-underscores' );
		wp_enqueue_style( 'alep-animate' );
	}
	add_action( 'wp_enqueue_scripts', 'alep_stylesheets' );

/*[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
CUSTOM POST PAGINATION
[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]*/
	
	/*==================================================================
	Add FontAwesome icons to previous and next links 
	http://wordpress.stackexchange.com/questions/37256/paged-posts-how-to-use-numbers-and-next-previous-links
	https://www.alphablossom.com/genesis-style-page-links-multiple-pages-posts
	==================================================================*/

	add_filter( 'wp_link_pages_args', 'alep_change_link_page_args', 5 );
	function alep_change_link_page_args( $defaults ) {
		$defaults = array(
			'before'           => '<div class="page-pagination">',
			'after'            => '</div>',
			'link_before'      => '<span class="custom-page-links">',
			'link_after'       => '</span>',
			'next_or_number'   => 'number',
			'separator'        => ' ',
			'nextpagelink'     => __( '<span class="prevnext-page">Next page</span> <i class="right-big alep-icon" aria-hidden="true"></i>' ),
			'previouspagelink' => __( '<i class="left-big alep-icon" aria-hidden="true"></i> <span class="prevnext-page">Previous page</span> ' ),
			'pagelink'         => '%',
			'echo'             => 1
			);
		return $defaults;
	}

	add_filter('wp_link_pages_args', 'alep_style_page_post_pagination');
	function alep_style_page_post_pagination($args) {
		global $page, $numpages, $more, $pagenow;
		if (!$args['next_or_number'] == 'next_and_number')
	 return $args; # exit early
	 $args['next_or_number'] = 'number'; # keep numbering for the main part
	 if (!$more)
	 return $args; # exit early
	 if($page-1) # there is a previous page
	 $args['before'] .= _wp_link_page($page-1) . $args['link_before'] . $args['previouspagelink'] . $args['link_after'] . '</a>';
	 if ($page<$numpages) # there is a next page
	 $args['after'] = _wp_link_page($page+1) . $args['link_before'] . $args['nextpagelink'] . $args['link_after'] . '</a>' . $args['after'];
	 return $args;
	}

/*[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
BREADCRUMBS
[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]*/

	/*==================================================================
	https://www.thewebtaylor.com/articles/wordpress-creating-breadcrumbs-without-a-plugin
	==================================================================*/

	// Breadcrumbs
	function custom_breadcrumbs() {
	// Settings
	$separator = '&gt;';
	$breadcrums_id = 'breadcrumbs';
	$breadcrums_class = 'breadcrumbs';
	$home_title = 'Homepage';
	// If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
	$custom_taxonomy = 'product_cat';
	// Get the query & post information
	global $post,$wp_query;
	// Do not display on the homepage
	if ( !is_front_page() ) {
	// Build the breadcrums
	echo '<ul id="' . $breadcrums_id . '" class="' . $breadcrums_class . '">';
	// Home page
	echo '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a></li>';
	echo '<li class="separator separator-home"> ' . $separator . ' </li>';
	if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {
	echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . post_type_archive_title($prefix, false) . '</strong></li>';
	} else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {
	// If post is a custom post type
	$post_type = get_post_type();
	// If it is a custom post type display name and link
	if($post_type != 'post') {
	$post_type_object = get_post_type_object($post_type);
	$post_type_archive = get_post_type_archive_link($post_type);
	echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
	echo '<li class="separator"> ' . $separator . ' </li>';
	}
	$custom_tax_name = get_queried_object()->name;
	echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . $custom_tax_name . '</strong></li>';
	} else if ( is_single() ) {
	// If post is a custom post type
	$post_type = get_post_type();
	// If it is a custom post type display name and link
	if($post_type != 'post') {
	$post_type_object = get_post_type_object($post_type);
	$post_type_archive = get_post_type_archive_link($post_type);
	echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
	echo '<li class="separator"> ' . $separator . ' </li>';
	}
	// Get post category info
	$category = get_the_category();
	if(!empty($category)) {
	// Get last category post is in
	$last_category = end(array_values($category));
	// Get parent any categories and create array
	$get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
	$cat_parents = explode(',',$get_cat_parents);
	// Loop through parent categories and store in variable $cat_display
	$cat_display = '';
	foreach($cat_parents as $parents) {
	$cat_display .= '<li class="item-cat">'.$parents.'</li>';
	$cat_display .= '<li class="separator"> ' . $separator . ' </li>';
	}
	}
	// If it's a custom post type within a custom taxonomy
	$taxonomy_exists = taxonomy_exists($custom_taxonomy);
	if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {
	$taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
	$cat_id = $taxonomy_terms[0]->term_id;
	$cat_nicename = $taxonomy_terms[0]->slug;
	$cat_link = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
	$cat_name = $taxonomy_terms[0]->name;
	}
	// Check if the post is in a category
	if(!empty($last_category)) {
	echo $cat_display;
	echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
	// Else if post is in a custom taxonomy
	} else if(!empty($cat_id)) {
	echo '<li class="item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
	echo '<li class="separator"> ' . $separator . ' </li>';
	echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
	} else {
	echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
	}
	} else if ( is_category() ) {
	// Category page
	echo '<li class="item-current item-cat"><strong class="bread-current bread-cat">' . single_cat_title('', false) . '</strong></li>';
	} else if ( is_page() ) {
	// Standard page
	if( $post->post_parent ){
	// If child page, get parents
	$anc = get_post_ancestors( $post->ID );
	// Get parents in the right order
	$anc = array_reverse($anc);
	// Parent page loop
	foreach ( $anc as $ancestor ) {
	$parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
	$parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
	}
	// Display parent pages
	echo $parents;
	// Current page
	echo '<li class="item-current item-' . $post->ID . '"><strong title="' . get_the_title() . '"> ' . get_the_title() . '</strong></li>';
	} else {
	// Just display current page if not parents
	echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</strong></li>';
	}
	} else if ( is_tag() ) {
	// Tag page
	// Get tag information
	$term_id = get_query_var('tag_id');
	$taxonomy = 'post_tag';
	$args = 'include=' . $term_id;
	$terms = get_terms( $taxonomy, $args );
	$get_term_id = $terms[0]->term_id;
	$get_term_slug = $terms[0]->slug;
	$get_term_name = $terms[0]->name;
	// Display the tag name
	echo '<li class="item-current item-tag-' . $get_term_id . ' item-tag-' . $get_term_slug . '"><strong class="bread-current bread-tag-' . $get_term_id . ' bread-tag-' . $get_term_slug . '">' . $get_term_name . '</strong></li>';
	} elseif ( is_day() ) {
	// Day archive
	// Year link
	echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
	echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
	// Month link
	echo '<li class="item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a></li>';
	echo '<li class="separator separator-' . get_the_time('m') . '"> ' . $separator . ' </li>';
	// Day display
	echo '<li class="item-current item-' . get_the_time('j') . '"><strong class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</strong></li>';
	} else if ( is_month() ) {
	// Month Archive
	// Year link
	echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
	echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
	// Month display
	echo '<li class="item-month item-month-' . get_the_time('m') . '"><strong class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</strong></li>';
	} else if ( is_year() ) {
	// Display year archive
	echo '<li class="item-current item-current-' . get_the_time('Y') . '"><strong class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</strong></li>';
	} else if ( is_author() ) {
	// Auhor archive
	// Get the author information
	global $author;
	$userdata = get_userdata( $author );
	// Display author name
	echo '<li class="item-current item-current-' . $userdata->user_nicename . '"><strong class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . 'Author: ' . $userdata->display_name . '</strong></li>';
	} else if ( get_query_var('paged') ) {
	// Paginated archives
	echo '<li class="item-current item-current-' . get_query_var('paged') . '"><strong class="bread-current bread-current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">'.__('Page') . ' ' . get_query_var('paged') . '</strong></li>';
	} else if ( is_search() ) {
	// Search results page
	echo '<li class="item-current item-current-' . get_search_query() . '"><strong class="bread-current bread-current-' . get_search_query() . '" title="Search results for: ' . get_search_query() . '">Search results for: ' . get_search_query() . '</strong></li>';
	} elseif ( is_404() ) {
	// 404 page
	echo '<li>' . 'Error 404' . '</li>';
	}
	echo '</ul>';
	}
	}

/*[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
NUMBERED PAGINATION
[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]*/

	/*==================================================================
	Display navigation to next/previous set of posts when applicable.
	Based on paging nav function from Twenty Fourteen
	==================================================================*/

	if ( ! function_exists( 'alep_paging_nav' ) ) :
	 
	function alep_paging_nav() {
	    // Don't print empty markup if there's only one page.
	    if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
	        return;
	    }
	 
	    $paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	    $pagenum_link = html_entity_decode( get_pagenum_link() );
	    $query_args   = array();
	    $url_parts    = explode( '?', $pagenum_link );
	 
	    if ( isset( $url_parts[1] ) ) {
	        wp_parse_str( $url_parts[1], $query_args );
	    }
	 
	    $pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	    $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';
	 
	    $format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	    $format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';
	 
	    // Set up paginated links.
	    $links = paginate_links( array(
	        'base'     => $pagenum_link,
	        'format'   => $format,
	        'total'    => $GLOBALS['wp_query']->max_num_pages,
	        'show_all'           => false,
	        'current'  => $paged,
	        'mid_size' => 5,
	        'add_args' => array_map( 'urlencode', $query_args ),
	        'prev_text' => __( '<i class="left-open alep-icon"></i>', 'alep' ),
	        'next_text' => __( '<i class="right-open alep-icon"></i>', 'alep' ),
	        'type'      => 'list',
	    ) );
	 
	    if ( $links ) :
	 
	    ?>
	    <nav class="navigation paging-navigation" role="navigation">
	        <h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'alep' ); ?></h1>
	            <?php echo $links; ?>
	    </nav><!-- .navigation -->
	    <?php
	    endif;
	}
	endif;

/*[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
CUSTOM WALKER SCRIPT
[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]*/

	/*==================================================================
	Needed for CSS Menu
	https://www.youtube.com/watch?v=ArEmwJV6M7s	
	==================================================================*/

	// An extension of the pre-existing core functionality of Wordpress 
	class CSS_Menu_Maker_Walker extends Walker

		{
		var $db_fields = array(
			'parent' => 'menu_item_parent',
			'id' => 'db_id'
		);
		function start_lvl(&$output, $depth = 0, $args = array()) // ul
			{
			$indent = str_repeat("\t", $depth);
			$output.= "\n$indent<ul>\n";
			}

		function end_lvl(&$output, $depth = 0, $args = array()) // closing ul
			{
			$indent = str_repeat("\t", $depth);
			$output.= "$indent</ul>\n";
			}

		function start_el(&$output, $item, $depth = 0, $args = array() , $id = 0) // li a span
			{
			global $wp_query;
			$indent = ($depth) ? str_repeat("\t", $depth) : '';
			$class_names = $value = '';
			$classes = empty($item->classes) ? array() : (array)$item->classes;
			if (in_array('current-menu-item', $classes))
				{
				$classes[] = 'active';
				unset($classes['current-menu-item']);
				}

			$children = get_posts(array(
				'post_type' => 'nav_menu_item',
				'nopaging' => true,
				'numberposts' => 1,
				'meta_key' => '_menu_item_menu_item_parent',
				'meta_value' => $item->ID
			));
			if (!empty($children))
				{
				$classes[] = 'has-sub';
				}

			$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes) , $item, $args));
			$class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
			$id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
			$id = $id ? ' id="' . esc_attr($id) . '"' : '';
			$output.= $indent . '<li' . $id . $value . $class_names . '>';
			$attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
			$attributes.= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
			$attributes.= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
			$attributes.= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
			$item_output = $args->before;
			$item_output.= '<a' . $attributes . '><span>';
			$item_output.= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
			$item_output.= '</span></a>';
			$item_output.= $args->after;
			$output.= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
			}

		function end_el(&$output, $item, $depth = 0, $args = array()) // closing li a span
			{
			$output.= "</li>\n";
			}
		}

/*[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
CUSTOM METABOX FOR SHORTCODES
[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]*/

	/*==================================================================
	Code by: https://wpshed.com/wordpress/create-custom-meta-box-easy-way/
	==================================================================*/

	/**
	 * function to return a custom field value.
	 */
	function alep_get_custom_field( $value ) {
		global $post;

		$custom_field = get_post_meta( $post->ID, $value, true );
		if ( !empty( $custom_field ) )
			return is_array( $custom_field ) ? stripslashes_deep( $custom_field ) : stripslashes( wp_kses_decode_entities( $custom_field ) );

		return false;
	}

	/**
	 * Register the Meta box
	 */
	function alep_add_custom_meta_box() {
		add_meta_box( 'alep-meta-box', __( 'Alep Shortcodes', 'alep' ), 'alep_meta_box_output', 'post', 'normal', 'high' );
		add_meta_box( 'alep-meta-box', __( 'Alep Shortcodes', 'alep' ), 'alep_meta_box_output', 'page', 'normal', 'high' );
	}
	add_action( 'add_meta_boxes', 'alep_add_custom_meta_box' );

	/**
	 * Output the Meta box
	 */
	function alep_meta_box_output( $post ) {
		// create a nonce field
		wp_nonce_field( 'my_alep_meta_box_nonce', 'alep_meta_box_nonce' ); ?>

		<p><i>This theme supports a number of shortcodes and embedds. To use them properly please insert the shortcodes or ID's respectively in each box.</i></p>
		<br />

		<p>
			<label for="alep_delightful_downloads_shortcode"><b><?php _e( 'Delightful Downloads shortcode', 'alep' ); ?>:</b></label>
			<br />
			<span><i>Please enter the the whole shortcode generated by DD here:</i></span>
			<br />
			<textarea name="alep_delightful_downloads_shortcode" id="alep_delightful_downloads_shortcode" cols="40" rows="3"><?php echo alep_get_custom_field( 'alep_delightful_downloads_shortcode' ); ?></textarea>
		</p>

		<p>
			<label for="alep_easy_digital_downloads"><b><?php _e( 'Easy Digital Downloads shortcode', 'alep' ); ?>:</b></label>
			<br />
			<span><i>Please enter the the whole shortcode generated by EDD here:</i></span>
			<br />
			<textarea name="alep_easy_digital_downloads" id="alep_easy_digital_downloads" cols="40" rows="3"><?php echo alep_get_custom_field( 'alep_easy_digital_downloads' ); ?></textarea>
		</p>

		<p>
			<label for="alep_youtube_embedding"><b><?php _e( 'Youtube URL', 'alep' ); ?>:</b></label>
			<br />
			<span><i>Please enter the ID of the video only!</i></span>
			<br />
			<textarea name="alep_youtube_embedding" id="alep_youtube_embedding" cols="40" rows="1"><?php echo alep_get_custom_field( 'alep_youtube_embedding' ); ?></textarea>
		</p>

		<?php
	}

	/**
	 * Save the Meta box values
	 */
	function alep_meta_box_save( $post_id ) {
		// Stop the script when doing autosave
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

		// Verify the nonce. If insn't there, stop the script
		if( !isset( $_POST['alep_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['alep_meta_box_nonce'], 'my_alep_meta_box_nonce' ) ) return;

		// Stop the script if the user does not have edit permissions
		if( !current_user_can( 'edit_post', get_the_id() ) ) return;

	    // Save the textarea
		if( isset( $_POST['alep_delightful_downloads_shortcode'] ) )
			update_post_meta( $post_id, 'alep_delightful_downloads_shortcode', ( $_POST['alep_delightful_downloads_shortcode'] ) );

	    // Save the textarea
		if( isset( $_POST['alep_easy_digital_downloads'] ) )
			update_post_meta( $post_id, 'alep_easy_digital_downloads', ( $_POST['alep_easy_digital_downloads'] ) );

	    // Save the textarea
		if( isset( $_POST['alep_youtube_embedding'] ) )
			update_post_meta( $post_id, 'alep_youtube_embedding', ( $_POST['alep_youtube_embedding'] ) );
		
	}
	add_action( 'save_post', 'alep_meta_box_save' );

/*[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
THEME SUPPORT FOR POST FORMATS
[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]*/

	// Add format support for each template made. E.g 'aside', 'quote', 'status', 'image', 'gallery', 'chat', 'link', 'audio', 'video'
	add_theme_support( 'post-formats', array( 'video' ) );

/*[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
CUSTOM PARAMETERS TO YOUTUBE EMBEDS
[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]*/

	// function namespace_oembed_youtube_no_title( $html, $url, $args ) {
	// // Only run this for YouTube embeds
	// if ( !strstr($url, 'youtube.com') )
	//     return $html;
	// // Get embed URL
	// $url_string = parse_url($url, PHP_URL_QUERY);
	// parse_str($url_string, $id);
	// // Set default arguments
	// $defaults = array(
	//     'width' => 1920,
	//     'height' => 1080,
	//     'showinfo' => false,
	//     'rel' => false
	// );
	// // Merge args with defaults
	// $args = wp_parse_args( $args, $defaults );
	// // Define variables
	// extract( $args, EXTR_SKIP );
	// // Add custom parameter values to IFRAME
	// if ( isset($id['v']) ) {
	//     return '<iframe width="' . intval($width) . '" height="' . intval($height) . '" src="http://www.youtube.com/embed/' . $id['v'] . '?rel=' . intval($rel) . '&showinfo=' . intval($showinfo) . '" frameborder="0" allowfullscreen></iframe>';
	// }
	// return $html;
	// }

	// add_filter('oembed_result', 'namespace_oembed_youtube_no_title', 10, 3);
	// add_filter('embed_oembed_html', 'remove_youtube_controls');

/*[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
DISPLAY WHICH TEMPLATE IS BEING USED IN WP
[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]*/

	/*Prints the directory and php of the template being used*/
	
	// add_action('wp_footer', 'show_template');
	// function show_template() {
	// 	global $template;
	// 	echo '<div style="
	// 		color: #ff0000;
	// 		font-weight: bold; background-color: #ff0000;
	// 		position: fixed; z-index: 999; padding: 5px;
	// 		bottom: 20px;
	// 		background-color: rgba(0, 0, 0, 0.91);
	// 		border-radius: 10px;
	// 	">', $template, '</div>';
	// }

/*[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
DISABLE THE ADMIN BAR
[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]*/

	add_action('get_header', 'my_filter_head');
	function my_filter_head() {
	remove_action('wp_head', '_admin_bar_bump_cb');
	}

/*[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
DISABLE WORDPRESS IMAGE COMPRESSION
[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]*/

	add_filter('jpeg_quality', function($arg){return 100;});

/*[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
DISPLAY CATEGORY AS POST CLASS
[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]*/

	/*==================================================================
	http://stackoverflow.com/questions/20621481/
	==================================================================*/

	// function category_as_class($classes) {
	//     global $post;
	//     foreach((get_the_category($post->ID)) as $category)
	//         $classes[] = $category->category_nicename;
	//     return $classes;
	// }
	// add_filter('post_class', 'category_as_class');

/*[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
DISABLE HTML IN COMMENTS
[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]*/
	
	/*==================================================================
	http://wp-time.com/disable-html-tags-wordpress-comments/
	==================================================================*/

	function wptime_comment_text_filter($comment_text){
	    return strip_tags($comment_text);
	}
	add_filter('comment_text', 'wptime_comment_text_filter'); // Disable HTML in comments
	add_filter('comment_text_rss', 'wptime_comment_text_filter'); // Disable HTML in RSS comments (optional)
	add_filter('comment_excerpt', 'wptime_comment_text_filter'); // Disable HTML excerpt comments (optional)

/*[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
AVOID DISPLAYING STICKY POSTS TWICE IN THE LOOP
[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]*/
	add_action( 'pre_get_posts', function( $q ) 
	{
	    if ( $q->is_home() && $q->is_main_query() && $q->get( 'paged' ) > 1 )
	        $q->set( 'post__not_in', get_option( 'sticky_posts' ) );

	} );

/*[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
WORDPRESS POST DEFAULT TEXT
[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]*/
	add_filter( 'default_content', 'my_editor_content' );
	function my_editor_content( $content ) {
		$content = "";
		return $content;
	}

/*[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
LINKING POST PUBLISHED OR EDITED DATES TO THEIR ARCHIVES
[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]*/

	/*http://justintadlock.com/archives/2010/08/06/linking-post-published-dates-to-their-archives*/

	add_shortcode( 'entry-link-published', 'my_entry_published_link' );

	function my_entry_published_link() {

		/* Get the year, month, and day of the current post. */
		$year = get_the_time( 'Y' );
		$month = get_the_time( 'm' );
		$day = get_the_time( 'd' );
		$out = '';

		/* Add a link to the monthly archive. */
		$out .= '<a href="' . get_month_link( $year, $month ) . '" title="Archive for ' . esc_attr( get_the_time( 'F Y' ) ) . '">' . get_the_time( 'M' ) . '</a>';

		/* Add a link to the daily archive. */
		$out .= ' <a href="' . get_day_link( $year, $month, $day ) . '" title="Archive for ' . esc_attr( get_the_time( 'F d, Y' ) ) . '">' . $day . '</a>';

		/* Add a link to the yearly archive. */
		$out .= ', <a href="' . get_year_link( $year ) . '" title="Archive for ' . esc_attr( $year ) . '">' . $year . '</a>';

		return $out;
	}

	add_shortcode( 'entry-link-edited', 'my_entry_edited_link' );

/*[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
ADD THUMBNAILS IN MANAGE POSTS/PAGES LIST
[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]*/

	/****** Add Thumbnails in Manage Posts/Pages List ******/
	if ( !function_exists('AddThumbColumn') && function_exists('add_theme_support') ) {

	    // for post and page
	    add_theme_support('post-thumbnails', array( 'post', 'page' ) );

	    function AddThumbColumn($cols) {

	        $cols['thumbnail'] = __('Thumbnail');

	        return $cols;
	    }

	    function AddThumbValue($column_name, $post_id) {

	            $width = (int) 35;
	            $height = (int) 35;

	            if ( 'thumbnail' == $column_name ) {
	                // thumbnail of WP 2.9
	                $thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
	                // image from gallery
	                $attachments = get_children( array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image') );
	                if ($thumbnail_id)
	                    $thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
	                elseif ($attachments) {
	                    foreach ( $attachments as $attachment_id => $attachment ) {
	                        $thumb = wp_get_attachment_image( $attachment_id, array($width, $height), true );
	                    }
	                }
	                    if ( isset($thumb) && $thumb ) {
	                        echo $thumb;
	                    } else {
	                        echo __('None');
	                    }
	            }
	    }

	    // for posts
	    add_filter( 'manage_posts_columns', 'AddThumbColumn' );
	    add_action( 'manage_posts_custom_column', 'AddThumbValue', 10, 2 );

	    // for pages
	    add_filter( 'manage_pages_columns', 'AddThumbColumn' );
	    add_action( 'manage_pages_custom_column', 'AddThumbValue', 10, 2 );
	}

/*[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
ADD "NEXT-PAGE"-BUTTON IN WYSIYG-EDITOR
[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]*/
	add_filter('mce_buttons','wysiwyg_editor');
	function wysiwyg_editor($mce_buttons) {
	    $pos = array_search('wp_more',$mce_buttons,true);
	    if ($pos !== false) {
	        $tmp_buttons = array_slice($mce_buttons, 0, $pos+1);
	        $tmp_buttons[] = 'wp_page';
	        $mce_buttons = array_merge($tmp_buttons, array_slice($mce_buttons, $pos+1));
	    }
	    return $mce_buttons;
	}

/*[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
MOVE THE LOCATION OF JETPACK SHARE BUTTONS
[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]*/

	/*https://jetpack.com/2013/06/10/moving-sharing-icons/*/

	function jptweak_remove_share() {
	    remove_filter( 'the_content', 'sharing_display',19 );
	    remove_filter( 'the_excerpt', 'sharing_display',19 );
	    if ( class_exists( 'Jetpack_Likes' ) ) {
	        remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
	    }
	}
	 
	add_action( 'loop_start', 'jptweak_remove_share' );

/*[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
DISPLAY STYLE DROPDOWN FOR WYSIWYG IN WORDPRESS
[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]*/

/*[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
SHOW RELATED POSTS BY CATEGORY
[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]*/

	// http://www.wpcustoms.net/snippets/show-related-posts-by-category/ 
	
	 function alep_related_posts_by_category() {  
	    global $post;  
	    // We should get the first category of the post  
	    $categories = get_the_category( $post->ID );  
	    $first_cat = $categories[0]->cat_ID;  
	  
	    $args = array(  
	        // It should be in the first category of our post:  
	        'category__in' => array( $first_cat ),  
	        // Our post should NOT be in the list:  
	        'post__not_in' => array( $post->ID ),  
	        'posts_per_page' => 3  
	    );  
	  
	    $posts = get_posts( $args );  
	    if( $posts ) {  
	        $output = '<p class="sidebar-title">Related articles:</p><div class="sidebar-entries">';  
	  
	        foreach( $posts as $post ) {  
	            setup_postdata( $post );  
	            $post_title = get_the_title();  
	            $permalink = get_permalink();  
	            $output .= '<p class="related clickablediv"><a href="' . $permalink . '" title="' . esc_attr( $post_title ) . '">' . $post_title . '</a></p>';  
	        }  
	        $output .= '</div>';  
	    } else {  
	          
	        $output .= '<p></p>';  
	    }  
	    echo $output;
	    wp_reset_postdata();  
	}  

/*[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
REMOVE CATEGORIES FROM THE_CATEGORY
[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]*/

	// http://www.smashingthemes.com/blog/how-to-remove-categories-from-the_category-function-in-wordpress/

	// function the_category_filter($thelist,$separator=' ') {  
	//     if(!defined('WP_ADMIN')) {  
	//         //Category Names to exclude  
	//         $exclude = array('Uncategorized');  
	          
	//         $cats = explode($separator,$thelist);  
	//         $newlist = array();  
	//         foreach($cats as $cat) {  
	//             $catname = trim(strip_tags($cat));  
	//             if(!in_array($catname,$exclude))  
	//                 $newlist[] = $cat;  
	//         }  
	//         return implode($separator,$newlist);  
	//     } else {  
	//         return $thelist;  
	//     }  
	// }  
	// add_filter('the_category','the_category_filter', 10, 2); 

	add_action( 'wp_print_scripts', 'myplugin_scripts' );
	function myplugin_scripts(){
	  if ( is_single() && comments_open() ) {
	    // myplugin_script must have been previously registered via wp_register_script()
	    wp_enqueue_script( 'myplugin_script' );
	  }
	}

/*[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
REMOVE HARD-CODED WIDTH FROM WP_CAPTION
[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]*/

	// http://wordpress.stackexchange.com/questions/107358/make-wordpress-image-captions-responsive
	// Filter to replace the [caption] shortcode text with HTML5 compliant code
	// text HTML content describing embedded figure

	add_filter('img_caption_shortcode', 'my_img_caption_shortcode_filter',10,3);


	function my_img_caption_shortcode_filter($val, $attr, $content = null)
	{
	    extract(shortcode_atts(array(
	        'id'    => '',
	        'align' => '',
	        'width' => '',
	        'caption' => ''
	    ), $attr));

	    if ( 1 > (int) $width || empty($caption) )
	        return $val;

	    $capid = '';
	    if ( $id ) {
	        $id = esc_attr($id);
	        $capid = 'id="figcaption_'. $id . '" ';
	        $id = 'id="' . $id . '" aria-labelledby="figcaption_' . $id . '" ';
	    }

	    return '<div ' . $id . 'class="wp-caption ' . esc_attr($align) . '" >'
	    . do_shortcode( $content ) . '<p ' . $capid 
	    . 'class="wp-caption-text">' . $caption . '</p></div>';
	}

/*[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
THEME OPTIONS TAB IN WP CONTROL PANEL
[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]*/

	// http://www.wpexplorer.com/wordpress-theme-options/

	// Exit if accessed directly
	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}

	// Start Class
	if ( ! class_exists( 'alep_Theme_Options' ) ) {

		class alep_Theme_Options {

			/**
			 * Start things up
			 *
			 * @since 1.0.0
			 */
			public function __construct() {

				// We only need to register the admin panel on the back-end
				if ( is_admin() ) {
					add_action( 'admin_menu', array( 'alep_Theme_Options', 'add_admin_menu' ) );
					add_action( 'admin_init', array( 'alep_Theme_Options', 'register_settings' ) );
				}

			}

			/**
			 * Returns all theme options
			 *
			 * @since 1.0.0
			 */
			public static function get_theme_options() {
				return get_option( 'theme_options' );
			}

			/**
			 * Returns single theme option
			 *
			 * @since 1.0.0
			 */
			public static function get_theme_option( $id ) {
				$options = self::get_theme_options();
				if ( isset( $options[$id] ) ) {
					return $options[$id];
				}
			}

			/**
			 * Add sub menu page
			 *
			 * @since 1.0.0
			 */
			public static function add_admin_menu() {
				add_menu_page(
					esc_html__( 'Alep', 'text-domain' ),
					esc_html__( 'Alep', 'text-domain' ),
					'manage_options',
					'theme-settings',
					array( 'alep_Theme_Options', 'create_admin_page' )
				);
			}

			/**
			 * Register a setting and its sanitization callback.
			 *
			 * We are only registering 1 setting so we can store all options in a single option as
			 * an array. You could, however, register a new setting for each option
			 *
			 * @since 1.0.0
			 */
			public static function register_settings() {
				register_setting( 'theme_options', 'theme_options', array( 'alep_Theme_Options', 'sanitize' ) );
			}

			/**
			 * Sanitization callback
			 *
			 * @since 1.0.0
			 */
			public static function sanitize( $options ) {

				// If we have options lets sanitize them
				if ( $options ) {

				}

				// Return sanitized options
				return $options;

			}

			/**
			 * Settings page output
			 *
			 * @since 1.0.0
			 */
			public static function create_admin_page() { ?>

				<div class="wrap alep-theme-information" style="font-size: 150%;">

					<h1><?php esc_html_e( 'Alep Theme Information:', 'text-domain' ); ?></h1>
					<br>
					<h2>Theme plugin dependancies:</h2>
					<p style="font-size: 150%;">This theme supports the following plugins:</p>
					<p style="font-size: 150%;"><a href="https://jetpack.com/">Jetpack: Social sharing buttons</a></p>
					<p style="font-size: 150%;"><a href="https://codecanyon.net/item/digital-paybox-pay-and-download/2637036?utm_source=sharetw">Digital Paybox (Purchased from Envato)</a></p>
					<p style="font-size: 150%;"><a href="https://wordpress.org/plugins/shortcodes-ultimate/">Shortcodes Ultimate</a></p>
					<p style="font-size: 150%;"><a href="https://wordpress.org/plugins/delightful-downloads/">Delightful Downloads</a></p>
					<p style="font-size: 150%;"><a href="https://wordpress.org/plugins/wp-browser-update/">WP BrowserUpdate</a></p>
					<p style="font-size: 150%;"><a href="https://wordpress.org/plugins/lightbox/">Huge IT Lightbox</a></p>
					<br>
					<h2>This theme has these custom fonts and web fonts:</h2>

					<p style="font-size: 150%;"><a href="hhttps://fonts.google.com/specimen/Roboto">Roboto</a></p>
					<p style="font-size: 150%;"><a href="https://fonts.google.com/specimen/Titillium+Web">Titillium Web</a></p>
					<p style="font-size: 150%;"><a href="http://fontello.com/">Fontello Alep icons</a></p>
					<br>
					<h2>This plugin does also require you to add your Google Analytics code in functions.php<h2>	

				</div><!-- .wrap -->
			<?php }

		}
	}
	new alep_Theme_Options();

	// Helper function to use in your theme to return a theme option value
	function myprefix_get_theme_option( $id = '' ) {
		return alep_Theme_Options::get_theme_option( $id );
	}

/*[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
ALLOW SVG Through WORDPRESS MEDIA UPLOADER
[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]*/

	function cc_mime_types($mimes) {
	  $mimes['svg'] = 'image/svg+xml';
	  return $mimes;
	}
	add_filter('upload_mimes', 'cc_mime_types');

	function bodhi_svgs_disable_real_mime_check( $data, $file, $filename, $mimes ) {
	    $wp_filetype = wp_check_filetype( $filename, $mimes );

	    $ext = $wp_filetype['ext'];
	    $type = $wp_filetype['type'];
	    $proper_filename = $data['proper_filename'];

	    return compact( 'ext', 'type', 'proper_filename' );
	}
	add_filter( 'wp_check_filetype_and_ext', 'bodhi_svgs_disable_real_mime_check', 10, 4 );

/*[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
REMOVE H1 FROM THE WORDPRESS EDITOR
[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]*/

	// https://gist.github.com/kjbrum/da4eb508be09b9c336a9
	function wp_remove_h1_from_editor( $init ) {
	    $init['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;Preformatted=pre;';
	    return $init;
	}
	add_filter( 'tiny_mce_before_init', 'wp_remove_h1_from_editor' );

/*[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
CHECK IF THE CONTENT OF A POST IS EMPTY
[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]*/

	// http://blog.room34.com/archives/5360

	function empty_content($str) {
	    return trim(str_replace('&nbsp;','',strip_tags($str))) == '';
	}

/*[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
DYNAMIC COPYRIGHT DATE
[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]*/

	/*Selects the date of the first post and the current year
	and displays a copyright symbol. Example: (c) 2006 – 2010*/

	function comicpress_copyright() {
	global $wpdb;
	$copyright_dates = $wpdb->get_results("
	SELECT
	YEAR(min(post_date_gmt)) AS firstdate,
	YEAR(max(post_date_gmt)) AS lastdate
	FROM
	$wpdb->posts
	WHERE
	post_status = 'publish'
	");
	$output = '';
	if($copyright_dates) {
	$copyright = "&copy; " . $copyright_dates[0]->firstdate;
	if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
	$copyright .= '-' . $copyright_dates[0]->lastdate;
	}
	$output = $copyright;
	}
	return $output;
	}


/*[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
CUSTOM STYLES FOR THE Tiny MCE EDITOR IN WORDPRESS
[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]*/

	// https://code.tutsplus.com/tutorials/adding-custom-styles-in-wordpress-tinymce-editor--wp-24980*

	// Apply styles to the visual editor
	add_filter('mce_css', 'tuts_mcekit_editor_style');
	function tuts_mcekit_editor_style($url) {
	 
		if ( !empty($url) )
		$url .= ',';
	 
		// Retrieves the plugin directory URL
		// Change the path here if using different directories
		$url .= trailingslashit( get_stylesheet_directory_uri() ) . 'style-sheets/tinymce.min.css';
		return $url;
	}
	 
	// Add "Styles" drop-down
	add_filter( 'mce_buttons_2', 'tuts_mce_editor_buttons' );
	function tuts_mce_editor_buttons( $buttons ) {
		array_unshift( $buttons, 'styleselect' );
		return $buttons;
	}
	 
	// Add styles/classes to the "Styles" drop-down
	add_filter( 'tiny_mce_before_init', 'tuts_mce_before_init' );
	function tuts_mce_before_init( $settings ) {

		$style_formats = array(
		array(
			'title' => 'Accordion title',
			'block' => 'div',
			'classes' => 'accordion_title_wrapper',
			'wrapper' => true,
			),
		array(
			'title' => 'Accordion content',
			'block' => 'div',
			'classes' => 'accordion_content_wrapper',
			'wrapper' => true,
			),
		array(
			'title' => 'Emphasis box',
			'block' => 'p',
			'classes' => 'emphasis-box',
			),
		array(
			'title' => 'Alert box blue',
			'block' => 'p',
			'classes' => 'alertbox blue',
			),
		array(
			'title' => 'Alert box yellow',
			'block' => 'p',
			'classes' => 'alertbox yellow',
			),
		array(
			'title' => 'Alert box red',
			'block' => 'p',
			'classes' => 'alertbox red',
			),
		array(
			'title' => 'Alert box green',
			'block' => 'p',
			'classes' => 'alertbox green',
			),
		array(
			'title' => 'Alert box pink',
			'block' => 'p',
			'classes' => 'alertbox pink',
			)
		);
	 
		$settings['style_formats'] = json_encode( $style_formats );
	 	return $settings;
	}
	 
	// Learn TinyMCE style format options at http://www.tinymce.com/wiki.php/Configuration:formats
	 // Add custom stylesheet to the website front-end with hook 'wp_enqueue_scripts'
	add_action('wp_enqueue_scripts', 'tuts_mcekit_editor_enqueue');
	 
	// Enqueue stylesheet, if it exists.
	function tuts_mcekit_editor_enqueue() {
	$StyleUrl = get_stylesheet_directory_uri().'/style-sheets/tinymce.min.css'; // Customstyle.css is relative to the current file
	wp_enqueue_style( 'myCustomStyles', $StyleUrl );
	}

// [[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
// CUSTOM STYLE FOR DELIGHTFUL DOWNLOADS
// [[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]

	function dedo_custom_output( $styles ) {
		$styles['button'] = array(
	 		'name' => __( 'Button with name, extension and file size', 'delightful-downloads' ),
	 		'format' => '<a href="%url%" title="%title%.%ext% (%filesize%)" rel="nofollow" class="%class%">%title%.%ext% (%filesize%)</a>'
		);
		return $styles;
	}
	add_filter( 'dedo_get_styles', 'dedo_custom_output' );