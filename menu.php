<nav id="cd-lateral-nav">
	<?php 
		wp_nav_menu(array(
		'menu' => 'Primary',
		'theme_location' => 'primary',
		'container_id' => 'cssmenu', 
		'walker' => new CSS_Menu_Maker_Walker()
		)); 
	?>
</nav>
