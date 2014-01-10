<?php
/* Active Page Creator Loop File
 *
 * lambda framework v 2.1
 * by www.unitedthemes.com
 * since lambda framework v 1.0
 * based on skeleton
 */
global $gridvalues, $post;

$theme_options = get_option('option_tree');
$boxmetadata = lambda_return_meta('page'); ?>

<?php if ( post_password_required( $post ) ) { ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<section>
	<article>
		<?php the_content(); ?>
	</article>
</section>
    
<?php endwhile; // end of the loop. ?>

<?php } else { ?>

<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php 

$last = 0;
$counter = 1;

if(isset($boxmetadata['lambda_page_item']) && is_array($boxmetadata['lambda_page_item']))
	
	foreach($boxmetadata['lambda_page_item'] as $singlebox) {
		
		$gridsize = (isset($singlebox['grid_size'])) ? $singlebox['grid_size'] : '960';

		if(isset($gridsize) && $gridsize != "960") {

			$last = $last+$gridsize+20;
			
		}		
		
		//Design Exceptions		
		$boxtitle = (isset($singlebox['box_title']) && $singlebox['box_type'] != 'testimonialcarousel') ? $singlebox['box_title'] : false;
		$overflow = (isset($singlebox['box_type']) && $singlebox['box_type'] == 'testimonialcarousel') ? true : false;
		$entrycontent = (isset($singlebox['box_type']) && $singlebox['box_type'] == 'simple_textbox') ? true : false;		
		
		
		if(isset($singlebox['box_type']) && $singlebox['box_type'] != 'service_column') { 
			build_grid_opener($gridsize, $last, $boxtitle, $overflow, $entrycontent, $singlebox); } 
		else { 
			build_article_opener($gridsize, $last, $boxtitle, $overflow, $entrycontent, $singlebox); 
		};
		
		if(isset($singlebox['box_type'])) :
			
		switch($singlebox['box_type']) {
			
			case "simple_textbox": render_simple_textbox($singlebox['extra_content']);
			break;
			
			case "simple_quote": render_simple_quote($singlebox['quote'], $singlebox['quote_cite']);
			break;
			
			case "call_to_action": render_cta_box($singlebox['cta_headline'],$singlebox['cta_content'],$singlebox['cta_buttonlink'],$singlebox['cta_buttontext']);
			break;
			
			case "rev_slider": render_rev_slider($singlebox['rev_slider']);
			break;
			
			case "standard_slider": render_standard_slider($singlebox['standard_slider']);
			break;
			
			case "soundcloud": render_soundcloud($singlebox);
			break;			
			
			case "simple_video": post_format_video($singlebox, $counter);
			break;
			
			case "google_map": render_googlemap($singlebox);
			break;
			
			case "row": render_row($singlebox);
			break;
						
			case "service_column": render_service_column($singlebox);
			break;
			
			case "testimonial": render_testimonial($singlebox);
			break;
			
			case "pricing_table": render_pricing_table($singlebox['pricing_table']);
			break;
			
			case "portfolio_excerpt": lambda_portfolio_columns($singlebox, $counter, true);
			break;
			
			case "testimonialcarousel": render_testimonial_carousel($singlebox, '',$counter, 'page');
			break;
			
			case "blog_excerpt": render_lambda_blog($singlebox);
			break;
			
			case "sidebarwidget": render_simple_sidebar($singlebox);
			break;
			
			case "clientbox": render_clientbox($singlebox);
			break;			
											
		
		}
		
		endif;
	
	//choose correct closing tag
	if(isset($singlebox['box_type']) && $singlebox['box_type'] != 'service_column') { echo '</div>'; } else { echo '</section>'; }
	
	//reset last if it has reached 960 for next loop 
	if($gridsize == "960") {
		
		$last = 0;
	
	} else {
		
		//add a clear after row has been filled with boxes
		if($last == 960 && (isset($singlebox['box_type']) && $singlebox['box_type'] != 'row')) { echo '<div class="clear"></div>'; }
		$last = ($last == 960 || (isset($singlebox['box_type']) && $singlebox['box_type'] == 'row')) ? 0 : $last;
		
	}
	
	$counter++;
	
}
?>

<div class="edit-link-wrap">
	<?php edit_post_link( __( 'Edit', 'claymore' ), '<span class="edit-link">', '</span>' ); ?>
</div><!-- .edit-link-wrap -->

</section><!-- #post-## -->

<?php if(comments_open()) { ?>
	<div class="loop-single-divider"></div>
<?php } ?>
                
<?php comments_template( '', true ); ?>

<?php } ?>