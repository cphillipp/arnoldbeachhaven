<?php
/**
 * The Sidebar
 *
 * lambda framework v 2.1
 * by www.unitedthemes.com
 * since lambda framework v 1.0
 * based on skeleton
 */

$sidebar = lambda_return_meta('page');

do_action('st_before_sidebar');
		
		echo '<ul>';
			
			if( !isset($sidebar['sidebar']) || ( isset($sidebar['sidebar']) && $sidebar['sidebar'] == UT_THEME_INITIAL."sidebar_default") ) {
				
				dynamic_sidebar( get_option_tree( 'select_sidebar' ) );
				
			} elseif(isset($sidebar['sidebar'])) {
				
				dynamic_sidebar($sidebar['sidebar']);
				
			}
			
		echo '</ul>';
		
do_action('st_after_sidebar');?>
