<?php
#-----------------------------------------------------------------
# do not remove this part!
#-----------------------------------------------------------------
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];

// Access to WordPress
require_once( $path_to_wp . '/wp-load.php' ); ?>
{
    "name" : "UnitedThemes Twitter",
    "slug" : "ut-twitter",
    "download_url" : "<?php echo get_template_directory_uri(); ?>/functions/lib/ut-twitter.zip",
    "version" : "1.2",
    "author" : "UnitedThemes",
    "sections" : {
        "description" : "A simple widget to display tweets"
    }
}