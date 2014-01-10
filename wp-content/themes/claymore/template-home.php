<?php

/**
 * Template Name: Home Template
 *
 * lambda framework v 1.0
 * by www.unitedthemes.com
 * since lambda framework v 1.0
*/

global $post;

$metadata = lambda_return_meta('page');
$theme_options = get_option('option_tree');

//includes the header.php
get_header();

//includes the template-part-slider.php
get_template_part( 'template-part', 'slider' );

//includes the template-part-teaser.php
get_template_part( 'template-part', 'teaser' );

//content opener - this function can be found in functions/theme-layout-functions.php line 5-50
lambda_before_content($columns='sixteen'); ?>

<?php if ( post_password_required( $post ) ) { ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<section>
	<article>
		<?php the_content(); ?>
	</article>
</section>
    
<?php endwhile; // end of the loop. ?>

<?php } else { ?>

<div id="home-template">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<section>
	<article>
		<?php the_content(); ?>
	</article>
</section>
    
<?php endwhile; // end of the loop. ?>
<?php
#-----------------------------------------------------------------
# Service Columns 
#-----------------------------------------------------------------
if( !function_exists( 'home_service_columns' ) ) {
    function home_service_columns($count) {
		
		global $theme_options;
		$metadata = lambda_return_meta('page');
		
		if(isset($metadata['activate_service_columns']) && $metadata['activate_service_columns'] == 'on') { 
		
			$col1 = (isset($metadata['activate_col_1']) && $metadata['activate_col_1'] == 'on' ? '1' : false);
			$col2 = (isset($metadata['activate_col_2']) && $metadata['activate_col_2'] == 'on' ? '1' : false);
			$col3 = (isset($metadata['activate_col_3']) && $metadata['activate_col_3'] == 'on' ? '1' : false);
			$col4 = (isset($metadata['activate_col_4']) && $metadata['activate_col_4'] == 'on' ? '1' : false);
			
			$servicecolumns =  $col1 + $col2 + $col3 +$col4;
			$colcounter = NULL;
			
			
			// default grid value
			$servicegrid = "one_fourth";
			
			// if only one
			if ($servicecolumns == "1") {
				
				$servicegrid = "sixteen columns alpha omega row";
				
			// if two, split in half
			} elseif ($servicecolumns == "2") {
				
				$servicegrid = "one_half";
				
			// if three, divide in thirds
			} elseif ($servicecolumns == "3") {
				
				$servicegrid = "one_third";
				
			// if four, split in fourths
			} elseif ($servicecolumns == "4") {
				
				$servicegrid = "one_fourth";
				
			} ?>
			
			<section class="service-columns clearfix<?php echo ($count == 1) ? ' home-border' : ''; ?>">
			
				<?php if($col1) { $colcounter++; 
				$last = ($colcounter == $servicecolumns) ? ' last' : '';
					
					render_service_column($metadata, $servicegrid, $last, true, 1);
		
				} ?>
				
				<?php if($col2) { $colcounter++; 
				$last = ($colcounter == $servicecolumns) ? ' last' : ''; 
					
					render_service_column($metadata, $servicegrid, $last, true, 2);	
		
				} ?>
				
				<?php if($col3) { $colcounter++; 
				$last = ($colcounter == $servicecolumns) ? ' last' : ''; 
					
					render_service_column($metadata, $servicegrid, $last, true, 3);
		
				} ?>
				
				<?php if($col4) { $colcounter++; 
				$last = ($colcounter == $servicecolumns) ? ' last' : '';
					
					render_service_column($metadata, $servicegrid, $last, true, 4);
		
				} ?>
				
			
			<div class="clear"></div>
						
			</section>
		
			
		<?php } // end service columns 
	}
}?>






<?php
#-----------------------------------------------------------------
# Latest Posts
#-----------------------------------------------------------------
if( !function_exists( 'home_blog_columns' ) ) {
    function home_blog_columns($count) {
						
		$metadata = lambda_return_meta('page');
		
		if($metadata['activate_latest_blog'] == 'on') { ?>
				
		<section class="recent-post clearfix<?php echo ($count == 1) ? ' home-border' : ''; ?>">
		
		
		<?php if(isset($metadata['blog_headline'])) :?>
			
			<h3 class="home-title"><span><?php echo lambda_translate_meta($metadata['blog_headline']); ?></span></h3>
								
		<?php endif; ?>	
		
		<?php render_lambda_blog($metadata); ?>
		
		</section>
		
		<?php } // end blog 
	}
}
?>


<?php
#-----------------------------------------------------------------
# Testimonials
#-----------------------------------------------------------------
if( !function_exists( 'home_testimonials' ) ) {
    function home_testimonials($count) {
		
		global $lambda_meta_data;
		
		$metadata = lambda_return_meta('page');
				
		//default "own"
		$testimonials = $metadata[UT_THEME_INITIAL.'home_testimonials'];
		$tab_items = $metadata[UT_THEME_INITIAL.'home_verticaltabs'];
				
		if($metadata['activate_testimonials'] == 'on') { 
			
			if($metadata['testimonial_type'] == 'page') {
				//get page meta data
				$pagemetadata = get_post_meta($metadata['home_testimonial_page'], $lambda_meta_data->get_the_id(), TRUE);
				$testimonials = ( isset($pagemetadata[UT_THEME_INITIAL.'testimonial_items']) && !empty($pagemetadata[UT_THEME_INITIAL.'testimonial_items']) ) ? $pagemetadata[UT_THEME_INITIAL.'testimonial_items']: '';				
			}
			
			if($metadata['toggle_type'] == 'page') {
				//get page meta data
				$pagemetadata = get_post_meta($metadata['home_service_page'], $lambda_meta_data->get_the_id(), TRUE);
				$tab_items = ( isset($pagemetadata[UT_THEME_INITIAL.'verticaltabs']) && !empty($pagemetadata[UT_THEME_INITIAL.'verticaltabs']) ) ? $pagemetadata[UT_THEME_INITIAL.'verticaltabs'] : '';
			}
					
		?>
		
		<section class="clearfix<?php echo ($count == 1) ? ' home-border' : ''; ?>">
			
			<div class="lambda-service-excerpt one_half">
				
				<?php if(isset($metadata['service_headline'])) :?>
			
					<h3 class="home-title"><span><?php echo lambda_translate_meta($metadata['service_headline']); ?></span></h3>
										
				<?php endif; ?>		
				
								
				<div class="clearfix">
	
					<?php 
					$z=1;
					
					$maxservice = (isset($metadata['service_load_last']) && $metadata['service_load_last']) ? $metadata['service_load_last'] : 999;
					
					if(is_array($tab_items)) {
										
					foreach($tab_items as $tab) { 
					
					if($z <= $maxservice) { ?>
					
					<article class="list"><h3 class="trigger"><a href="#"><?php echo (isset($tab['tab_name'])) ? lambda_translate_meta($tab['tab_name']) : ''; ?></a></h3>
					<div class="toggle_container"><div class="block clearfix"><?php echo (isset($tab['tab_content'])) ? do_shortcode(apply_filters('the_content', $tab['tab_content'])) : ''; ?></div></div></article>
				
					<?php  } $z++; } } ?>
			
				</div>
				<div class="clear"></div>			
			
			</div>
			
			<section class="one_half last" style="overflow:hidden;">
				
				<?php render_testimonial_carousel($metadata, $testimonials, $count, 'home'); ?>
			
			</section>
			
		</section>
		
		
		<div class="clear"></div>
		<?php } // end testimonials 
			
	}
}
?>

<?php
#-----------------------------------------------------------------
# Clients
#-----------------------------------------------------------------
if( !function_exists( 'home_clients' ) ) {
    function home_clients($count) {
	
		global $lambda_meta_data;
		
		//receive standard meta
		$metadata = lambda_return_meta('page');
		$clients  = !empty($metadata[UT_THEME_INITIAL.'home_clients']) ? $metadata[UT_THEME_INITIAL.'home_clients'] : '';
		
		if($metadata['client_type'] == 'page') {
		    //get page meta data
			$pagemetadata = get_post_meta($metadata['home_client_page'], $lambda_meta_data->get_the_id(), TRUE);
			$clients = $pagemetadata[UT_THEME_INITIAL.'client_images'];				
		}
		
		switch ($metadata[UT_THEME_INITIAL.'home_client_layout']) {
		
			case 4:
				
				$grid = "four columns";
				$columnset = 4;
				break;
			
			case 5:
				
				$grid = "five columns";
				$columnset = 5;
				break;
				
				
		} ?>
		
		<section class="client-wrap clearfix">	
		
			<?php if(isset($metadata['client_headline'])) :?>
			
				<h3 class="home-title"><span><?php echo lambda_translate_meta($metadata['client_headline']); ?></span></h3>
										
			<?php endif; ?>	

		<ul class="clients clearfix">
		
		<?php
		
		$z = 0;
		$loadmax = (isset($metadata['client_load_last'])) ? $metadata['client_load_last'] : $columnset;
		
		if(is_array($clients)) {
			
            shuffle($clients);
			
            foreach($clients as $client) {
					
					if($z+1 <= $loadmax) {
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
					
					}
					
					$z++;
			}
		}
		?>
		</ul>
		
		
		</section><!-- end client-wrap -->
		
		
	
	
	<?php
	}
} 
?>



<?php
#-----------------------------------------------------------------
# Loop Home Items 
#-----------------------------------------------------------------
if(isset($metadata['home_item']) && is_array($metadata['home_item'])) {
	
	$count = 1;
	
	foreach($metadata['home_item'] as $home_item) {		
					
		switch($home_item) {
			
			case "service": 
			if(isset($metadata['activate_service_columns']) && $metadata['activate_service_columns'] == 'on') {
				home_service_columns($count);
				$count++;
			}
			break;
			
			case "portfolio": 
			if(isset($metadata['activate_portfolio']) && $metadata['activate_portfolio'] == 'on') {
				lambda_portfolio_columns($metadata, $count, false, 'latest-portfolio');
				$count++;
			}
			break;
			
			case "blog": 
			if(isset($metadata['activate_latest_blog']) && $metadata['activate_latest_blog'] == 'on') {
				home_blog_columns($count);
				$count++;
			}
			break;
			
			case "testimonials": 
			if(isset($metadata['activate_testimonials']) && $metadata['activate_testimonials'] == 'on') {
				home_testimonials($count);
				$count++;
			}
			break;
			
			case "clients": 
			if(isset($metadata['activate_clients']) && $metadata['activate_clients'] == 'on') {
				home_clients($count);
				$count++;
			}
			break;
			
			case "cta": 
			if(isset($metadata['activate_cta']) && $metadata['activate_cta'] == 'on') {
				
				$buttonlink = ( isset($metadata['cta_buttonlink'] ) ) ? $metadata['cta_buttonlink'] : '';
				$buttontext = ( isset($metadata['cta_buttontext'] ) ) ? $metadata['cta_buttontext'] : '';
								
				echo do_shortcode('[cta ctaclass="margin-40" headline="'.lambda_translate_meta($metadata['cta_headline']).'" buttonlink="'.$buttonlink.'" buttontext="'.lambda_translate_meta($buttontext).'"] '.lambda_translate_meta($metadata['cta_content']).' [/cta]');
				
				$count++;
			}
			break;					
			
		}
		
	}

}?>

</div>

<?php

//content closer - this function can be found in functions/theme-layout-functions.php line 56-61
lambda_after_content();

//end password protection
}

//includes the footer.php
get_footer();
?>