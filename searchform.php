<div id="main-search" class="no-print">
	<!-- Search -->
	<form role="search" method="get" class="search-form main-search-box" action="<?php echo home_url( '/' ); ?>">

		<label>

			<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>

			<input type="search"
			class="search-field"
			placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder' ) ?>" 
			value="<?php echo get_search_query() ?>" 
			name="s" 
			title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />

			<button class="main-search-submit"><i class="search alep-icon" aria-hidden="true"></i></button>

		</label>
<!-- 			<i class="search alep-icon" aria-hidden="true"></i><input type="submit" class="search-submit"
			value="<?php //echo esc_attr_x( 'Search', 'submit button' ) ?>" /> -->
		</form>


		<!-- #Search -->
	</div>
	<!-- <i class="search alep-icon" aria-hidden="true"></i> -->


