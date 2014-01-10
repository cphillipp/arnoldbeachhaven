<?php

# import twitter settings page
function ut_twitter_admin() {
     include('ut_import_admin.php');
}

# hook admin menu
function ut_twitter_admin_actions() {  

    $hook = add_options_page("Twitter", "Twitter", 'edit_pages', "Twitter", "ut_twitter_admin");

}  
add_action('admin_menu', 'ut_twitter_admin_actions');

# register options
function register_ut_twitter_options() {
	
    register_setting( 'ut_twitter_options_group', 'ut_twitter_options'); 
    
} 
add_action('admin_init', 'register_ut_twitter_options' );

?>