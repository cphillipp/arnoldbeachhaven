<?php
/**
 * The template for displaying 404 pages (Not Found).
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

lambda_before_content($columns='');
?>
	<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'claymore' ); ?></p>
    <div class="row">
	<?php get_search_form(); ?>
	</div>
	<script type="text/javascript">
		// focus on search field after it has loaded
		document.getElementById('s') && document.getElementById('s').focus();
	</script>

<?php
//content closer - this function can be found in functions/theme-layout-functions.php line 56-61
lambda_after_content();

//include the sidebar-page.php
get_sidebar();

//includes the footer.php
get_footer();
?>