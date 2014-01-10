<?php
/**
 * Template Name: Testimonials Template
 *
 * lambda framework v 2.1
 * by www.unitedthemes.com
 * since lambda framework v 1.0
 * based on skeleton
*/

global $post;

$testimonial_data  = lambda_return_meta('page');
$testimonial_items = $testimonial_data[UT_THEME_INITIAL.'testimonial_items'];

//includes the header.php
get_header();

//includes the template-part-slider.php
get_template_part( 'template-part', 'slider' );

//includes the template-part-teaser.php
get_template_part( 'template-part', 'teaser' );

//content opener - this function can be found in functions/theme-layout-functions.php line 5-50
lambda_before_content($columns='sixteen');

?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<section>
	<article>
		<?php the_content(); ?>
	</article>
</section>
    
<?php endwhile; // end of the loop. ?>


<?php
#-----------------------------------------------------------------
# Testimonials
#-----------------------------------------------------------------
?>


<?php if ( !post_password_required( $post ) ) : ?>


<?php //check if faq items exists
if( is_array($testimonial_items) ) { ?>

	<section class="testimonial-wrap clearfix">
	
	<?php $z=1; $async=1; foreach($testimonial_items as $item) { ?>
		
		<div class="one_half <?php echo ($z % 2 == 0) ? 'last' : ''; ?> clearfix">
				
		<?php 
		
		if( $async == 1 ) { $odd = true; }
				
		if($odd) {
			
			$even = false;
			
		} elseif($even) {
			
			$odd = false;

		}
		?>
		
		<?php render_testimonial($item, $async); ?>
		
		</div>
		
		<?php echo ($z % 2 == 0 && $z != count($testimonial_items)) ? '<div class="clear"></div>' : ''; ?>
		
		<?php 
			
		if($odd) {
			
			$async++;
			$even = true;
			$odd = false;
			
		} elseif($even) {
			
			$async = $async+2;
			$odd = true;
			$even = false;
			
		}
		 
		?>
		
	<?php $z++; } ?>

	</section>
	<div class="clear"></div>
	
<?php } ?>

<?php echo !empty($testimonial_data['testimonails_additional_content']) ? do_shortcode($testimonial_data['testimonails_additional_content']) : ''; ?>

<div class="edit-link-wrap">
	<?php edit_post_link( __( 'Edit', 'claymore' ), '<span class="edit-link">', '</span>' ); ?>
</div><!-- .edit-link-wrap -->
                       
<?php
//content closer - this function can be found in functions/theme-layout-functions.php line 56-61
lambda_after_content();

//end password protection
endif;

//includes the footer.php
get_footer();
?>
