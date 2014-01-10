<?php
#-----------------------------------------------------------------
# Hook for adding admin menus
#-----------------------------------------------------------------
add_action('admin_menu', 'lambda_tupdate_admin_menu');

function lambda_tupdate_admin_menu() {
    	
	add_submenu_page('option_tree','Theme Info','Theme Info', 'manage_options', 'view_info', 'lambda_view_info');

}
?>