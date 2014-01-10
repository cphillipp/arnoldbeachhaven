<?php
/**
 * The template for displaying Search Results pages.
 *
 * lambda framework v 2.1
 * by www.unitedthemes.com
 * since lambda framework v 1.0
 * based on skeleton
 */
 
$meta_sidebar = get_option_tree('select_sidebar');

//includes the header.php
get_header();

//includes the template-part-slider.php
get_template_part( 'template-part', 'slider' );

//includes the template-part-teaser.php
get_template_part( 'template-part', 'teaser' );

//set column layout depending if user wants to display a sidebar
if($meta_sidebar != UT_THEME_INITIAL.'sidebar_none') {

	lambda_before_content($columns='eleven');
	
} elseif($meta_sidebar == UT_THEME_INITIAL.'sidebar_none') {
	
	lambda_before_content($columns='sixteen');
	
}

if ( have_posts() ) : ?>
				<p class="search-title"><?php printf( __( 'Search Results for:<span> %s </span>', 'claymore' ), '' . get_search_query() . '' ); ?></p>
				<?php
				/* Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called loop-search.php and that will be used instead.
				 */
				 get_template_part( 'loop', 'search' );
				?>
<?php else : ?>
				<div id="post-0" class="post no-results not-found">
					<p class="search-title"><?php _e( 'Nothing Found', 'claymore' ); ?></p>
					
					<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'claymore' ); ?></p>
						<?php get_search_form(); ?>
					
				</div><!-- #post-0 -->
<?php endif;

//content closer - this function can be found in functions/theme-layout-functions.php line 56-61
lambda_after_content();

//include the sidebar.php
get_sidebar();

//includes the footer.php
get_footer();
?>