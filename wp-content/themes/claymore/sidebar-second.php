<?php
/**
 * The Sidebar containing the primary blog sidebar
 *
 * lambda framework v 2.1
 * by www.unitedthemes.com
 * since lambda framework v 1.0
 * based on skeleton
 */
 
$sidebar = lambda_return_meta('page');
 
do_action('st_before_sidebar_second');
		
		echo '<ul>';
			
			if(!isset($sidebar['sidebar_second']) || ( isset($sidebar['sidebar_second']) && $sidebar['sidebar_second'] == UT_THEME_INITIAL."sidebar_default") ) {
				
				dynamic_sidebar( get_option_tree( 'select_sidebar_second' ) );
				
			}elseif(isset($sidebar['sidebar_second'])) {
				
				dynamic_sidebar($sidebar['sidebar_second']);
				
			} 
			
		echo '</ul>';
		
do_action('st_after_sidebar_second');?>

