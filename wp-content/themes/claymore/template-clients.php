<?php
/**
 * Template Name: Client Template
 *
 * lambda framework v 2.1
 * by www.unitedthemes.com
*/

global $post;

//retrieve meta data
$metadata = lambda_return_meta('page');
$clientlayout = (isset($metadata[UT_THEME_INITIAL.'client_layout'])) ? $metadata[UT_THEME_INITIAL.'client_layout'] : '4';

switch ($clientlayout) {
		
	case 4:
	$grid = "four columns";
	$columnset = 4;
	break;
			
	case 5:
	$grid = "five columns";
	$columnset = 5;
	break;
	
}



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
# Clients
#-----------------------------------------------------------------
?>

<?php if ( !post_password_required( $post ) ) : ?>

<section class="client-wrap clearfix">	

<ul class="clearfix clients">

<?php

$z = 0;
if(isset($metadata[UT_THEME_INITIAL.'client_images']) && is_array($metadata[UT_THEME_INITIAL.'client_images'])) {
	
	foreach($metadata[UT_THEME_INITIAL.'client_images'] as $client) {
			
			$itemposition = '';	//reset position	
			
			//fallback
			$url = (isset($client['url'])) ? $client['url'] : '#';
			$title = (isset($client['title'])) ? $client['title'] : '';
			$src = (isset($client['imgurl'])) ? $client['imgurl'] : '';
			
				
			if($columnset == 4) { (($z%4)==3) ? $itemposition = ' last' : $itemposition = ''; }
			if($columnset == 5) { (($z%5)==4) ? $itemposition = ' last' : $itemposition = ''; }
			if($columnset == 6) { (($z%6)==5) ? $itemposition = ' last' : $itemposition = ''; }
							
			//Output client
			echo '<li class="'.$grid.$itemposition.'">';
			
				echo '<a href="'.$client['url'].'"><img alt="'.$title.'" src="'.$src.'" /></a>';
			
			echo '</li>';
			
			$z++;
	}
	
}
?>
</ul>


</section><!-- end member-wrap -->

<?php
//content closer - this function can be found in functions/theme-layout-functions.php line 56-61
lambda_after_content();

//end password protection
endif;

//includes the footer.php
get_footer();
?>
