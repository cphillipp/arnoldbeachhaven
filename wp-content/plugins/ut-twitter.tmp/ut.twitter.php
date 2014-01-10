<?php    

/* 
Plugin Name: Twitter by UnitedThemes 
Plugin URI: http://www.unitedthemes.com 
Description: Plugin to display simple Twitter tweets
Author: UnitedThemes 
Version: 1.2
Author URI: http://www.unitedthemes.com 
License: GNU General Public License version 3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

define('UT_TWITTER_DIR', plugin_dir_path(__FILE__));
define('UT_TWITTER_URL', plugin_dir_url(__FILE__));
define('UT_TWITTER_VERSION', '1.2');
define('UT_TWITTER_LANG', 'ut_lang');

/*
 * required files
 */
require_once( UT_TWITTER_DIR . '/admin/admin.php' );
require_once( UT_TWITTER_DIR . '/inc/twitter.api.php' );
require_once( UT_TWITTER_DIR . '/ut.twitter.widget.php' );


/*
 * Activation, Deactivation and Uninstall Functions
 */
register_activation_hook(__FILE__, 'ut_twitter_activation');
register_deactivation_hook(__FILE__, 'ut_twitter_deactivation');


function ut_twitter_activation() {
    
    //actions to perform once on plugin activation    
    add_option('ut_twitter_options');
    
    //register uninstaller
    register_uninstall_hook(__FILE__, 'ut_twitter_uninstall');
    
}

function ut_twitter_deactivation() {
    
    // actions to perform once on plugin deactivation
        
}

function ut_twitter_uninstall(){
    
    //actions to perform once on plugin uninstall
    delete_option('ut_twitter_options');
}


/*
 * load needed javascript
 */
function ut_twitter_enqueuescripts() {
    
    if( !is_admin() ) {
           
        
    }
    
}
add_action('wp_enqueue_scripts', 'ut_twitter_enqueuescripts');



/*
 * load needed styles
 */
function ut_twitter_enqueuestyles() {
    
    if( !is_admin() ) {

        
    }
    
}
add_action('get_header', 'ut_twitter_enqueuestyles');


/*
 * editor panel
 */
function ut_twitter_init(){
        
    if( is_admin() ) {
       
    }
    
}
ut_twitter_init();


?>