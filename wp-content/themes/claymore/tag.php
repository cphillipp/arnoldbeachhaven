<?php
/**
 * The template for displaying Tag Archive pages.
 *
 * lambda framework v 2.1
 * by www.unitedthemes.com
 * since lambda framework v 1.0
 */

//includes the header.php
get_header();

//includes the template-part-slider.php
get_template_part( 'template-part', 'slider' );

//includes the template-part-teaser.php
get_template_part( 'template-part', 'teaser' );

lambda_before_content($columns=''); ?>

<p class="tag-title"><?php printf( __( 'Tag Archives: %s', 'claymore' ), '<span class="themecolor">' . single_tag_title( '', false ) . '</span>' );?></p>

<?php

//the content loop
get_template_part( 'loop', 'tag' );

//content closer - this function can be found in functions/theme-layout-functions.php line 56-61
lambda_after_content();

//include the sidebar-page.php
get_sidebar('page');

//includes the footer.php
get_footer();
?>