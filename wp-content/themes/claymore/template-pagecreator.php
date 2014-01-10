<?php

/**
 * Template Name: Page Creator
 *
 * lambda framework v 2.1
 * by www.unitedthemes.com
 * since lambda framework v 1.0
 * based on skeleton
*/

$meta_sidebar = lambda_return_meta('page');
$meta_sidebar = (isset($meta_sidebar['sidebar'])) ? $meta_sidebar['sidebar'] : get_option_tree('select_sidebar');

//includes the header.php
get_header(); ?>

<?php 
//includes the template-part-slider.php
get_template_part( 'template-part', 'slider' );

//includes the template-part-teaser.php
get_template_part( 'template-part', 'teaser' ); 

//set column layout depending if user wants to display a sidebar
if($meta_sidebar != UT_THEME_INITIAL.'sidebar_none') {

	lambda_before_content($columns='');
	
} elseif($meta_sidebar == UT_THEME_INITIAL.'sidebar_none') {
	
	lambda_before_content($columns='sixteen');
	
}

get_template_part( 'loop', 'pagecreator' );

//content closer - this function can be found in functions/theme-layout-functions.php line 56-61
lambda_after_content();

//include the sidebar-page.php
if(empty($columns))
get_sidebar();

//includes the footer.php
get_footer();
?>
