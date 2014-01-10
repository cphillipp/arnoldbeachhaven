<?php

/* Template Name: Portfolio
 *
 * lambda framework v 2.1
 * by www.unitedthemes.com
 * since lambda framework v 1.0
 */
global $lambda_meta_data;

if(!$lambda_meta_data->get_the_value(UT_THEME_INITIAL.'column_layout')) { $columnset = 1; } else { $columnset = $lambda_meta_data->get_the_value(UT_THEME_INITIAL.'column_layout'); }
 
//includes the header.php
get_header();

//includes the template-part-slider.php
get_template_part( 'template-part', 'slider' );

//includes the template-part-teaser.php
get_template_part( 'template-part', 'teaser' );

lambda_before_content($columns='sixteen');

//the content loop
get_template_part( 'archive', 'portfolio');

//content closer - this function can be found in functions/theme-layout-functions.php line 56-61
lambda_after_content();

//includes the footer.php
get_footer();
?>