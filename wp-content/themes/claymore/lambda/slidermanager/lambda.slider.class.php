<?php
#-----------------------------------------------------------------
# Hook for adding admin menus
#-----------------------------------------------------------------
add_action('admin_menu', 'lambda_sliders_admin_menu');

function lambda_sliders_admin_menu() {
    	
    add_submenu_page('option_tree','Manage Sliders','Manage Sliders', 'publish_posts', 'view_sliders', 'lambda_slider_admin_page');

}

?>
