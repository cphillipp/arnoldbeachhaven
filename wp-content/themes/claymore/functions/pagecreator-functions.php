<?php
#-----------------------------------------------------------------
# grid related values
#-----------------------------------------------------------------
$gridvalues = array('220' 	=>	'one_fourth',
					'300' 	=>	'one_third',
					'460'	=>	'one_half',
					'620'	=>	'two_thirds',
					'700'	=>	'three_fourths',
					'940'	=>	'full-width',
					'960'	=>	'full-width');

#-----------------------------------------------------------------
# dynamic grid builder
#-----------------------------------------------------------------
if( !function_exists( 'build_grid_opener' ) ) {
    function build_grid_opener($gridsize, $last, $boxtitle='lnotitle', $overflow=false, $entrycontent=false, $singlebox) {
		
		global $gridvalues;
		
		$activate_desktop = (isset($singlebox['activate_desktop']) && $singlebox['activate_desktop'] == 'on') ? ' lambda-hide-desktop ' : '';
		$activate_landscape = (isset($singlebox['activate_landscape']) && $singlebox['activate_landscape'] == 'on') ? ' lambda-hide-tablet ' : '';
		$activate_mobile = (isset($singlebox['activate_mobile']) && $singlebox['activate_mobile'] == 'on') ? ' lambda-hide-mobile ' : '';		
		
		if($overflow)
		$overflow = 'style="overflow:hidden;"';
		
		$entrycontent = ($entrycontent) ? ' entry-content' : '';		
		
		$last = ($last == "960") ? ' last'  : '';
		
		$gridopener = '<div class="'.$gridvalues[$gridsize].$last.$entrycontent.$activate_desktop.$activate_landscape.$activate_mobile.'  clearfix" '.$overflow.'>';
		
		if($boxtitle) {
			$gridopener .= '<h3 class="home-title"><span>'.lambda_translate_meta($boxtitle).'</span></h3>';
		}
		
		echo $gridopener;
    }
}

#-----------------------------------------------------------------
# dynamic article builder
#-----------------------------------------------------------------
if( !function_exists( 'build_article_opener' ) ) {
    function build_article_opener($gridsize, $last, $boxtitle='lnotitle', $overflow=false, $entrycontent=false, $singlebox) {
		
		global $gridvalues;
		
		$activate_desktop = (isset($singlebox['activate_desktop']) && $singlebox['activate_desktop'] == 'on') ? ' lambda-hide-desktop ' : '';
		$activate_landscape = (isset($singlebox['activate_landscape']) && $singlebox['activate_landscape'] == 'on') ? ' lambda-hide-tablet ' : '';
		$activate_mobile = (isset($singlebox['activate_mobile']) && $singlebox['activate_mobile'] == 'on') ? ' lambda-hide-mobile ' : '';		
		
		if($overflow)
		$overflow = 'style="overflow:hidden;';
		
		$entrycontent = ($entrycontent) ? ' entry-content' : '';		
		
		$last = ($last == "960") ? ' last'  : '';
		
		$gridopener = '<section class="'.$gridvalues[$gridsize].$last.$entrycontent.$activate_desktop.$activate_landscape.$activate_mobile.' service clearfix" '.$overflow.'>';
		
		if($boxtitle) {
			$gridopener .= '<h3 class="home-title"><span>'.lambda_translate_meta($boxtitle).'</span></h3>';
		}
		
		echo $gridopener;
    }
}


#-----------------------------------------------------------------
# simple text box with shortcodes
#-----------------------------------------------------------------
if( !function_exists( 'render_simple_textbox' ) ) {
    function render_simple_textbox($content) {
		
		$final_simple_textbox = do_shortcode(apply_filters( 'the_content' , $content) );
				
		echo $final_simple_textbox;
    }
}


#-----------------------------------------------------------------
# simple quote box
#-----------------------------------------------------------------
if( !function_exists( 'render_simple_quote' ) ) {
    function render_simple_quote($quote, $quote_cite) {
		
		$final_simple_quote = '<div class="quote"><div class="quote-border">';
		
		$final_simple_quote.= '<h2 class="quote-title">'.do_shortcode(lambda_translate_meta($quote)).'</h2>';
		
		$final_simple_quote.= '<cite>&#8722;'.do_shortcode($quote_cite).'</cite>';
				
		echo $final_simple_quote.'</div></div>';
    }
}


#-----------------------------------------------------------------
# revolution slider
#-----------------------------------------------------------------
if( !function_exists( 'render_rev_slider' ) ) {
    function render_rev_slider($sliderid) {
						
		$revslider = '<div class="lambda-pc">'.do_shortcode('[rev_slider '.$sliderid.']').'</div>';
		echo $revslider;
		
    }
}


#-----------------------------------------------------------------
# Call to Action
#-----------------------------------------------------------------
if( !function_exists( 'render_cta_box' ) ) {
	function render_cta_box($cta_headline = '', $cta_content = '', $cta_link = '', $cta_button_text = '') {
						
		echo do_shortcode('[cta headline="'.lambda_translate_meta($cta_headline).'" buttonlink="'.$cta_link.'" buttontext="'.$cta_button_text.'"] '.lambda_translate_meta($cta_content).' [/cta]');
	
    }
}



#-----------------------------------------------------------------
# standard slider
#-----------------------------------------------------------------
if( !function_exists( 'render_standard_slider' ) ) {
    function render_standard_slider($sliderid) {
		
		$standardslider = '<div class="lambda-pc">'.do_shortcode('[lambdaslider id="'.$sliderid.'"]').'</div>';
				
		echo $standardslider;
    }
}


#-----------------------------------------------------------------
# soundcloud 
#-----------------------------------------------------------------
if( !function_exists( 'render_soundcloud' ) ) {
    function render_soundcloud($soundcloud) {
						
		$soundcloud = '<div class="post_player">'.do_shortcode('[soundcloud url='.$soundcloud['soundcloud_url'].'/]').'</div>';
		
		echo $soundcloud;
    }
}


#-----------------------------------------------------------------
# horizontal row 
#-----------------------------------------------------------------
if( !function_exists( 'render_row' ) ) {
    function render_row($hrdata) {
						
		$row = '<hr style="margin-top:0px !important;" />';
		
		echo $row;
    }
}


#-----------------------------------------------------------------
# pricing table
#-----------------------------------------------------------------
if( !function_exists( 'render_pricing_table' ) ) {
    function render_pricing_table($tableid) {
		
		$table = do_shortcode('[lambdatable id="'.$tableid.'"]');
				
		echo $table;
    }
}


#-----------------------------------------------------------------
# Portfolio 
#-----------------------------------------------------------------
if( !function_exists( 'lambda_portfolio_columns' ) ) {
    function lambda_portfolio_columns($portfolio, $count, $pagebuilder = false, $containerID = 'none') {
	
	global $lambda_meta_data;
	
	$theme_options = get_option('option_tree');
	
	//class change for home and pagebuilder
	$portfoliowidth = ($pagebuilder) ? 'fullwidth' : 'sixteen columns alpha omega'; 
	$removebottom = ($pagebuilder) ? 'remove-bottom' : '';
	
	$container = ($containerID != 'none') ? 'id="'.$containerID.'"' : '';
	
	if((isset($portfolio['activate_portfolio']) && $portfolio['activate_portfolio'] == 'on') || $pagebuilder = true) { ?>
		
			<script type="text/javascript">				
				
				(function($){
		
					$(document).ready(function(){	
							
						$(".portfolio-excerpt-<?php echo $count; ?> > li > .thumb > .overflow-hidden").stop().hover(function(){						
													
							$(this).find('.hover-overlay').stop().fadeIn(250);
							
						  
						}, function () {
							
							$(this).find('.hover-overlay').stop().fadeOut(250);						
							
						});
																							
					});
						
				})(jQuery);
					
			</script>

				
			<section class="list_portfolio clearfix<?php echo ($count == 1) ? ' home-border' : ''; ?>">
	
			<?php if(isset($portfolio['portfolio_headline'])) :?>
		
				<h3 class="home-title"><span><?php echo lambda_translate_meta($portfolio['portfolio_headline']); ?></span></h3>
				
			<?php endif; ?>	
	
			<ul <?php echo $container; ?> class="clearfix portfolio-excerpt-<?php echo $count; ?> <?php echo $removebottom; ?>">
				
				<?php 
							
				#-----------------------------------------------------------------
				# custom project types for portfolio query
				#-----------------------------------------------------------------
				
				$project_types = '';
				$preview = '';
				$unkown = '';
							
				if(isset($portfolio['project_type'])) {
					if(is_array($portfolio['project_type'])) {
						$project_types = "&project-type=";
						foreach($portfolio['project_type'] as $type) {
							$project_types .= $type.',';
						}
						$project_types = substr($project_types, 0, -1);
					}
				}
				
				
				$posts_per_page = (isset($portfolio['portfolio_count'])) ? $portfolio['portfolio_count'] : '12';				
				$portfoliogrid = ( isset($portfolio['portfolio_grid']) ) ? $portfolio['portfolio_grid'] : 'one_fourth';	

				$gridcount = array('full-width'		=> '1',
								   'one_third' 		=> '3',
								   'one_half'  		=> '2',
								   'one_fourth'		=> '4',
								   'four columns'	=> '4');
				
				$portfoliogrid = (!$pagebuilder && $gridcount[$portfoliogrid] == 4) ? 'four columns' : $portfoliogrid;
				
				$counter = 1;
				
				//start query
				query_posts('post_type='.UT_PORTFOLIO_SLUG.'&posts_per_page='.$posts_per_page.'&project_types='.$project_types);	
				
				if (have_posts()) : while (have_posts()) : the_post(); $lambda_meta_data->the_meta();
														
				#-----------------------------------------------------------------
				# get all project-types for this item
				#-----------------------------------------------------------------						
				$projecttypeclean = NULL;			
				$project_cats = wp_get_object_terms( get_the_ID(), 'project-type' );
					
				if(is_array($project_cats)) {
					
					$i = '0';
				
					foreach( $project_cats as $types ){
									
					if($types->parent > 0)
					$projecttypeclean.= $types->name.', '; 
												
					$i++;		
				
					}
				}
				
				//cut last whitespace and comma
				$projecttypeclean = substr($projecttypeclean,0,-2);					
				
				//fallback for selfhosted videos 
				$unkown = $preview; //we need to keep the variable value
		
				$title= str_ireplace('"', '', trim(get_the_title()));
				
				$url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()));			
				$image = aq_resize( $url, 460, 260, true );  
				
				?>	
				
				<li style="margin-left:0px !important;" class="<?php echo $portfoliogrid; ?> <?php echo ($counter % $gridcount[$portfoliogrid] == 0) ? 'last' : ''; ?> clearfix">
					
					<div class="thumb <?php echo $removebottom; ?>">
							
							<div class="overflow-hidden">
							
							<img class="hovereffect wp-post-image" src="<?php echo $image; ?>" alt="<?php echo get_the_title(); ?>">
							
							<a href="<?php echo get_permalink(); ?>">
								
									<div class="hover-overlay">
										<?php if($portfolio['portfolio_item_title'] != 'on') { ?>
											<h1 class="portfolio-title"><?php echo lambda_translate_meta($title); ?><br /><span><?php echo lambda_translate_meta($projecttypeclean); ?></span></h1>
										<?php } else { ?>
											<span class="circle-hover"><img src="<?php echo THEME_WEB_ROOT; ?>/images/circle-hover.png" /></span>
										<?php } ?>
									</div>
																		
							</a>
							
						</div>
					
					 <?php 
					#-----------------------------------------------------------------
					# display title or not
					#-----------------------------------------------------------------
					if($portfolio['portfolio_item_title'] == 'on') { ?>							
                            							
						<h1 class="portfolio-title-below"><a href="<?php the_permalink(); ?>"><?php echo lambda_translate_meta($title); ?></a><br /><span><?php echo lambda_translate_meta($projecttypeclean); ?></span></h1>
							
					<?php } //endif ?> 
					 
					</div>
					
				</li>			
			
					
			<?php $counter++; endwhile; endif; ?>
			<?php wp_reset_query(); ?>
			</ul>
					
			</section>
			
			<div class="clear"></div>
	
		<?php
		
	
		} // end portfolio 
	}
}


#-----------------------------------------------------------------
# Testimonial
#-----------------------------------------------------------------
if( !function_exists( 'render_testimonial' ) ) {
    function render_testimonial($metadata, $async = 2) { ?>
		
		<?php  
		
		if(isset($metadata['author_image'])) {
			$authorimage = aq_resize( $metadata['author_image'], 50, 50, true );
		} ?> 
		    	        
		<?php if(empty($metadata['author_image'])) {
			  $authorimage = THEME_WEB_ROOT.'/images/default-avatar.jpg';
		} ?>
					
     	<article class="testimonial-entry <?php echo ($async % 2 == 0) ? 'dark' : 'white'; ?>">

			<?php echo do_shortcode(lambda_translate_meta($metadata['author_comment'])); ?>
         
      	</article> 
        
        <figure class="testimonial-photo">
        
        <img class="testimonial-img" src="<?php echo $authorimage; ?>">
        
     	</figure>
        <p class="testimonial-name"><?php echo (isset($metadata['author_name'])) ? $metadata['author_name'] : ''; ?><?php echo (isset($metadata['author_company'])) ? ', <span>'.$metadata['author_company'].'</span>' : '';?></p>           
        
	
    <?php }
}


#-----------------------------------------------------------------
# Service Column
#-----------------------------------------------------------------
if( !function_exists( 'render_service_column' ) ) {
    function render_service_column($metadata, $servicegrid='one_fourth', $last='', $home = false, $colnumber=1) { 			
				
				
				if($home) { 
					
					$metadata['col_icon']			= 	!empty($metadata['col_'.$colnumber.'_icon']) ? $metadata['col_'.$colnumber.'_icon'] : '';
					$metadata['col_alt']			= 	!empty($metadata['col_'.$colnumber.'_icon_alt']) ? $metadata['col_'.$colnumber.'_icon_alt'] : '';
					$metadata['col_headline']		= 	!empty($metadata['col_'.$colnumber.'_headline']) ? $metadata['col_'.$colnumber.'_headline'] : '';
					$metadata['col_content']		= 	!empty($metadata['col_'.$colnumber.'_content']) ? $metadata['col_'.$colnumber.'_content'] : '';
					$metadata['col_buttontext']		= 	!empty($metadata['col_'.$colnumber.'_buttontext']) ? $metadata['col_'.$colnumber.'_buttontext'] : '';
					$metadata['col_link']			= 	!empty($metadata['col_'.$colnumber.'_link']) ? $metadata['col_'.$colnumber.'_link'] : '';
				
				} ?>
				
				<?php if($home) { ?>
				
				<section class="<?php echo $servicegrid.$last; ?> service clearfix">       		
					
				<?php } ?>	
							
							<?php if(isset($metadata['col_icon'])) : ?>
							<figure class="service-icon">
								<img src="<?php echo $metadata['col_icon']; ?>" alt="<?php echo (isset($metadata['col_alt'])) ? $metadata['col_alt'] : ''; ?>" />
							</figure>
							<?php endif; ?>		
						
					
					<article class="service">
					
						<h3>
							<?php echo (isset($metadata['col_headline'])) ? lambda_translate_meta($metadata['col_headline']) : ''; ?>
						</h3>
								
									
						<?php if(isset($metadata['col_content'])) : ?>
						
							<p><?php echo do_shortcode(lambda_translate_meta($metadata['col_content'])); ?></p>
								
						<?php endif; ?>
						
		
						<?php if(isset($metadata['col_buttontext'])) { ?>
						
							<a href="<?php echo lambda_translate_meta($metadata['col_link']); ?>" class="excerpt" target="_self"><?php echo lambda_translate_meta($metadata['col_buttontext']); ?></a>
						
						<?php } ?>
						
					</article>				
				
				<?php if($home) { ?>
				</section>	
				<?php } ?>
					
	<?php }
}


#-----------------------------------------------------------------
# Testimonial Carousel
#-----------------------------------------------------------------
if( !function_exists( 'render_testimonial_carousel' ) ) {
	function render_testimonial_carousel($metadata, $testimonials='', $ID=1, $type) {
		
		global $lambda_meta_data;
		
		if($type == 'page') {
				//get page meta data
				$pagemetadata = get_post_meta($metadata['testimonialcarousel'], $lambda_meta_data->get_the_id(), TRUE);
				$testimonials = $pagemetadata[UT_THEME_INITIAL.'testimonial_items'];				
		}
		
		if(isset($metadata['testimonial_headline'])) : ?>
			
			<h3 class="home-title"><span><?php echo lambda_translate_meta($metadata['testimonial_headline']); ?></span>
				<a class="tnext gon_<?php echo $ID; ?>" href="#">next</a>
				<a class="tprev pon_<?php echo $ID; ?>" href="#">prev</a>
			</h3>
										
		<?php endif; ?>
		
		
		<?php if(isset($metadata['box_type'])) : ?>
			
			<h3 class="home-title"><span><?php echo $metadata['box_title'] ?></span>
				<a class="tnext gon_<?php echo $ID; ?>" href="#">next</a>
				<a class="tprev pon_<?php echo $ID; ?>" href="#">prev</a>
			</h3>
										
		<?php endif; ?>
				
				<?php if(is_array($testimonials)) { ?>				
				
				<script type="text/javascript">
				
					(function($){
			
						$(document).ready(function(){
							 
							var testimonials = $(".single-testimonial_<?php echo $ID; ?>").find('ul').children().length;
							 
							 $(".single-testimonial_<?php echo $ID; ?>").jCarouselLite({
								btnNext: ".gon_<?php echo $ID; ?>",
								btnPrev: ".pon_<?php echo $ID; ?>",
								<?php 
								if( isset($metadata['testimonials_autoplay']) && $metadata['testimonials_autoplay'] == 'on')
								echo (isset($metadata['testimonial_time'])) ? 'auto:'.$metadata['testimonial_time'].',' : 'auto:1000,';
								?>
								
								
								visible: testimonials
							});
							
							
						});
						
					})(jQuery);
				
				</script>
				
				<?php } ?>
				
				<div class="single-testimonial_<?php echo $ID; ?>">				
					
					<ul class="clearfix">
						
						<?php 
						if(is_array($testimonials)) {
							
							if($metadata['testimonial_color'] == 'white') {
								$testimonialcolor = $metadata['testimonial_color'];
							}
							
							if($metadata['testimonial_color'] == 'dark') {
								$testimonialcolor = $metadata['testimonial_color'];
							}							
							
							$z = 1;							
							foreach($testimonials as $testimonial) { ?>
					
							<li style="margin-bottom:0px !important; margin-left:0px !important; padding:0 1px;">
								
								<?php
								if(isset($testimonial['author_image'])) {
									$authorimage = aq_resize( $testimonial['author_image'], 50, 50, true );
								} ?> 
								
								<?php if(empty($testimonial['author_image'])) {
									$authorimage = THEME_WEB_ROOT.'/images/default-avatar.jpg';
								} 
								
								if($metadata['testimonial_color'] == 'alternate') {
									if($z%2==0) {
										$testimonialcolor = 'white';
									} else {
										$testimonialcolor = 'dark';
									}
								}								
								
								?>
								
								<div class="testimonial-entry <?php echo $testimonialcolor; ?>">
								
									<?php echo do_shortcode(lambda_translate_meta($testimonial['author_comment'])); ?>	
								 
								</div>
								
								<div class="testimonial-photo">
        
									<img class="testimonial-img" src="<?php echo $authorimage; ?>">
										
								</div>
								<p class="testimonial-name"><?php echo lambda_translate_meta($testimonial['author_name']); ?><?php echo ($testimonial['author_company']) ? ', <span>'.lambda_translate_meta($testimonial['author_company']).'</span>' : '';?></p> 
								
							</li>
							
							<?php $z++; } 
						
						} ?>
						
					</ul>

				</div>
		
		<?php
	}
}

#-----------------------------------------------------------------
# Blog
#-----------------------------------------------------------------
if( !function_exists( 'render_lambda_blog' ) ) {
	function render_lambda_blog($metadata) {
		
		global $lambda_meta_data, $post, $paged;
		
		$theme_options = get_option('option_tree');
		
		$numberpost = ($metadata['blog_length']) ? $metadata['blog_length'] : 3;
		$blogcats = (isset($metadata['only_category']) && is_array($metadata['only_category'])) ? implode(",",$metadata['only_category']) : '';
		$post_not_in = (isset($metadata['post_not_in']) && is_array($metadata['post_not_in'])) ? $metadata['post_not_in'] : '';
		
		if ( get_query_var('paged') ) {	$paged = get_query_var('paged'); } 
		elseif ( get_query_var('page') ) { $paged = get_query_var('page'); } 
		else { $paged = 1; }		
				
		$z = 1;		
		$args = array(
			'posts_per_page' => $numberpost,
			'post__not_in' => $post_not_in,
			'cat' => $blogcats,
		    'paged' => $paged
		);
		
		
		query_posts( $args );
		
		if (have_posts()) : while (have_posts()) : the_post(); $lambda_meta_data->the_meta();
		
		global $more; 
		$more = ($metadata['activate_blog_excerpt'] == 'on') ? 1 : 0;
		$bloggrid = ( isset($metadata['blog_grid']) ) ? $metadata['blog_grid'] : 'one_third';	
		
		
		$gridcount = array('full-width'	=> '1',
						   'one_third' 	=> '3',
			  			   'one_half'  	=> '2',
			  			   'one_fourth'	=> '4');		
			
		?>
		
		<section class="post <?php echo $bloggrid; ?> <?php if($z%$gridcount[$bloggrid]==0) { echo 'last'; } ?>" id="post-<?php the_ID(); ?>">
		<article class="entry-post clearfix">
		
		<header class="entry-header clearfix">
			
			<?php 
			
			$pformat = get_post_format(); 
			$postformat = (!empty( $pformat )) ? $pformat : 'standard'; 
								
			?>
			  
			<h1 class="entry-title <?php echo $postformat; ?>-post-title">
				<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'claymore' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h1>
			
			<div class="entry-meta row clearfix">
				
				<div class="post-ut">
					<?php echo lambda_posted_on(); ?>
				</div> <!-- post date -->
								 
				<div class="post-ut">	
					<span class="comments-link"><?php comments_popup_link( __( '0 Comments', 'claymore' ), __( '1 Comment', 'claymore' ), __( '% Comments', 'claymore' ) ); ?></span>
				</div><!-- post comments -->
							
				<?php if(get_option_tree('activate_likes_in_blog') == "yes" && (isset($metadata['activate_blog_like']) && $metadata['activate_blog_like'] != 'off')) : ?>
							  
					<?php echo GetLambdaLikePost(); ?>				
							   
				<?php endif; ?>
													 
		</div><!-- .entry-meta -->
							   
		</header>  
		
		<?php 
		$post_format = get_post_format();	
		$post_format = ( isset($postformat['portfolio_type']) && $postformat['portfolio_type'] == 'image_portfolio') ? 'gallery' : $post_format;		
		
		if($metadata['activate_blog_images'] == 'on')
		get_template_part( 'post-formats/' . $post_format ); 
		
		?> 
		
		
		<?php
						
		if(has_post_thumbnail(get_the_ID()) && $metadata['activate_blog_images'] == 'on' && $post_format != 'video') :
			
			$imgID = get_post_thumbnail_id($post->ID);		
			$url = wp_get_attachment_url( $imgID ); 
			$alt = get_post_meta($imgID , '_wp_attachment_image_alt', true);			
			
			echo '<div class="thumb"><div class="post-image"><div class="overflow-hidden imagepost">';
			echo '<img class="wp-post-image" alt="'.trim( strip_tags($alt) ).'" src="'.$url.'" />';
			echo '<a title="'.get_the_title().'" href="'.get_permalink().'"><div class="hover-overlay"><span class="circle-hover"><img src="'.THEME_WEB_ROOT.'/images/circle-hover.png" /></span></div></a>';
			echo '</div></div></div>';
								
		endif;
		
		
		
		?>	
		
		<div class="entry-summary">
		
		<?php 

		if($numberpost != 0) {
		
			if ($metadata['activate_blog_excerpt'] == 'on') : 
				
				if ( $post->post_excerpt ){
					 
					the_excerpt();
					
				} else {
								
					$excerptlength = (isset($metadata['blog_excerpt_length'])) ? $metadata['blog_excerpt_length'] : $theme_options['excerpt_blog_length'];
					echo excerpt_by_id($post->ID, $excerptlength, '', lambda_continue_reading_link()); 
				
				}
				
			else : 
					
				the_content( __( 'Read more <span class="meta-nav"></span>', 'claymore' ) );       
					
			endif;
			
			
			 
		}
		?>
			
		</div>
		
		</article>
		</section>		
		
		<?php if(($z%$gridcount[$bloggrid]==0) && $bloggrid != 'full-width') { ?>
			<div class="clear"></div>
		<?php } ?>
		
		<?php $z++; endwhile; endif; ?>
        
				<?php if( !is_page_template('template-home.php') ) : ?>
                
                <div id="nav-below" class="navigation clearfix">
					<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&#8656;</span> Older posts', 'claymore' ) ); ?></div>
					<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&#8658;</span>', 'claymore' ) ); ?></div>
				</div><!-- #nav-below -->
                
                <?php endif; ?>
		
		<?php wp_reset_query(); ?>
               
                
	<?php
	}
}

#-----------------------------------------------------------------
# google map
#-----------------------------------------------------------------
if( !function_exists( 'render_googlemap' ) ) {
    function render_googlemap($mapdata) {
		
		$map = do_shortcode('[googlemap address="'.$mapdata['map_address'].'" zoom="'.$mapdata['map_zoom'].'" height="'.$mapdata['map_height'].'"]');
		echo $map;
		
    }
}


#-----------------------------------------------------------------
# sidebar 
#-----------------------------------------------------------------
if( !function_exists( 'render_simple_sidebar' ) ) {
    function render_simple_sidebar($content) {
		do_action('st_before_sidebar');
			echo '<ul>';
				dynamic_sidebar($content['sidebar']);
			echo '</ul>';
		do_action('st_after_sidebar');	
    }
}


#-----------------------------------------------------------------
# Client Box
#-----------------------------------------------------------------
if( !function_exists( 'render_clientbox' ) ) {
    function render_clientbox($clientdata) {
		
		global $lambda_meta_data, $theme_path;
		
		$pagemetadata = get_post_meta($clientdata['home_client_page'], $lambda_meta_data->get_the_id(), TRUE);
		$clients = $pagemetadata[UT_THEME_INITIAL.'client_images'];	
		
		$grid = "one_fourth";
		$columnset = 4;
						
		$z = 0;
		$loadmax = (isset($clientdata['client_load_last'])) ? $clientdata['client_load_last'] : $columnset;
		
		echo '<ul class="clientspc clearfix">';
		
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
		
		echo '</ul>';		
		
    }
}

?>