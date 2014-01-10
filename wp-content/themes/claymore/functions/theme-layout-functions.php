<?php

#-----------------------------------------------------------------
# Before Content
#-----------------------------------------------------------------
if ( !function_exists( 'lambda_before_content' ) ) {
	
	function lambda_before_content($columns) {
	
	global $lambda_meta_data;
	
	if( lambda_is_blog_related() ) {
		
		//get the meta data from the blog page	
		$homeid = get_option('page_for_posts');  
		$sidebar_align = get_post_meta($homeid, $lambda_meta_data->get_the_id(), TRUE);
					
	} else {
		
		$sidebar_align = $lambda_meta_data->the_meta();
	
	}
	$sidebar_align = (isset($sidebar_align['sidebar_align'])) ? $sidebar_align['sidebar_align'] : get_option_tree('sidebar_alignement');
		
	#-----------------------------------------------------------------
	# Standard Column Set
	#-----------------------------------------------------------------
	if (empty($columns) && $sidebar_align != 'both') {
		//one sidebar
		$columns = 'eleven';
		$GLOBALS['lambda_content_column'] = $columns;
		
	} elseif (empty($columns) && $sidebar_align == 'both') {
		//two sidebars
		$columns = 'eight';
		$GLOBALS['lambda_content_column'] = $columns;
		
	} else {
		// Check the function for a returned variable
		$columns = $columns;
		$GLOBALS['lambda_content_column'] = $columns;
	}
	
	#----------------------------------------------------------------
	# Markup
	#----------------------------------------------------------------
	
	#start content wrap and content
	echo '<div id="content-wrap" class="fluid clearfix" data-content="content"><!-- /#start content-wrap -->
				<div class="container">';
	
	//Call Second Sidebar
	if($columns == 'eight' && $sidebar_align == 'both') {
		get_sidebar('second');
	}
				
	echo '<div id="content" class="'.$columns.' columns">';
	
	}
}


#-----------------------------------------------------------------
# After Content
#-----------------------------------------------------------------
if (! function_exists('lambda_after_content'))  {
    function lambda_after_content() {
    	
		#close content wrap
		echo '</div><!-- /#content-wrap -->';
		
    }
}

#-----------------------------------------------------------------
# Before Sidebar - do_action('st_before_sidebar')
#-----------------------------------------------------------------
if ( !function_exists( 'before_sidebar' ) ) {
	
	function before_sidebar($columns) {
	
	global $lambda_meta_data;

	if( lambda_is_blog_related() ) {
		
		//get the meta data from the blog page	
		$homeid = get_option('page_for_posts');  
		$sidebar_align = get_post_meta($homeid, $lambda_meta_data->get_the_id(), TRUE);
					
	} else {
		
		$sidebar_align = $lambda_meta_data->the_meta();
		
	}	
	$sidebar_align = (isset($sidebar_align['sidebar_align'])) ? $sidebar_align['sidebar_align'] : get_option_tree('sidebar_alignement');
	
	
	if (empty($columns) && $sidebar_align != 'both') {
		
		//one sidebar
		$columns = 'five';
		
	} elseif (empty($columns) && $sidebar_align == 'both') {
		
		//two sidebars
		$columns = 'four';
		
	} else {
		
		// Check the function for a returned variable
		$columns = $columns;
	}
	
	echo '<aside id="sidebar" class="'.$columns.' columns" role="complementary">';
	}
} 
add_action( 'st_before_sidebar', 'before_sidebar');  

#-----------------------------------------------------------------
# After Sidebar
#-----------------------------------------------------------------
if ( !function_exists( 'after_sidebar' ) ) {
	function after_sidebar() {
		// Additional Content could be added here
	   echo '</aside><!-- #sidebar -->';
	}
}
add_action( 'st_after_sidebar', 'after_sidebar'); 

#-----------------------------------------------------------------
# Before Second Sidebar - do_action('st_before_sidebar_second')
#-----------------------------------------------------------------
if ( !function_exists( 'before_sidebar_second' ) ) {
	
	function before_sidebar_second($columns) {

	if (empty($columns)) {
	// Set the default
		$columns = 'four';
	} else {
	// Check the function for a returned variable
		$columns = $columns;
	}
	echo '<aside id="sidebar_second" class="'.$columns.' columns" role="complementary">';
	}
} 
add_action( 'st_before_sidebar_second', 'before_sidebar_second');  

#-----------------------------------------------------------------
# After Second Sidebar
#-----------------------------------------------------------------
if ( !function_exists( 'after_sidebar_second' ) ) {
	function after_sidebar_second() {
		// Additional Content could be added here
	   echo '</aside><!-- #sidebar -->';
	}
}
add_action( 'st_after_sidebar_second', 'after_sidebar_second'); 
 

#-----------------------------------------------------------------
# Comment Styles
#-----------------------------------------------------------------
if ( ! function_exists( 'st_comments' ) ) :
function st_comments($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; 
$admincomment = (1 == $comment->user_id) ? 'admin-comment' : '';
?>


<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
			<div id="comment-<?php comment_ID(); ?>" class="single-comment clearfix">
                       
                    <figure class="comment-author vcard <?php echo $admincomment; ?>"> 
                        <?php echo get_avatar( $comment->comment_author_email, '60' ); ?> 
                    </figure>
               
                    <article class="comment-body">
                    
                    	<header class="comment-header">
							
							<?php if ($comment->comment_approved == '0') : ?>
                            	<em><?php _e('Comment is awaiting moderation','claymore');?></em> <br />
                            <?php endif; ?>
							
                            <cite class="fn"><?php echo get_comment_author_link(); ?></cite>
                             <br />
                            <span class="comment-date"><?php echo get_comment_date(). '  -  ' . get_comment_time(); ?></span>
                            <?php comment_reply_link(array_merge( $args, array('reply_text' => __('Reply','claymore'),'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                        </header>
                        
						<?php comment_text() ?>
                        
                        <footer class="comment-meta commentmetadata">
							<?php edit_comment_link(__('Edit Comment','claymore'),'  ',''); ?>
						</footer>
                        
                	</article>                               
		</div>
<!-- </li> -->
<?php  }
endif;



#-----------------------------------------------------------------
# Custom Background
#-----------------------------------------------------------------
if ( ! function_exists( 'customBackground' ) ) {
	function customBackground() {
		
		global $lambda_meta_data, $theme_options;
		
		$custom_wrap = get_option_tree('sitelayout');
						
		//defaultvalues
		$backgroundtype = get_option_tree( 'background_type');
		$backgroundcolor = get_option_tree( 'default_backgroundcolor');
		$backgroundpattern = get_option_tree( 'default_backgroundpattern');
		$backgroundtexture = get_option_tree( 'default_backgroundtexture');
		$backgroundimage = get_option_tree( 'default_backgroundimage');
		$backgroundslider = get_option_tree( 'default_backgroundslider');

		
		//Get needed meta variables
		if( lambda_is_blog_related() ) {
			
			$homeid = get_option('page_for_posts');  
			$imagedata = get_post_meta($homeid, $lambda_meta_data->get_the_id(), TRUE);	
			
		} else {
		
			$imagedata = $lambda_meta_data->the_meta();
		
		}
				
		//overwrite default values if necessary
		if(isset($imagedata['background_type']) && $imagedata['background_type'] != 'default_none') {
			$backgroundtype = (isset($imagedata['background_type'])) ? $imagedata['background_type'] : $backgroundtype ;
			$backgroundcolor = (isset($imagedata['default_backgroundcolor'])) ? $imagedata['default_backgroundcolor'] : $backgroundcolor;
			$backgroundpattern = (isset($imagedata['default_backgroundpattern'])) ? $imagedata['default_backgroundpattern'] : $backgroundpattern;
			$backgroundimage = (isset($imagedata['default_backgroundimage'])) ? $imagedata['default_backgroundimage'] : $backgroundimage;
			$backgroundtexture = (isset($imagedata['default_backgroundtexture'])) ? $imagedata['default_backgroundtexture']: $backgroundtexture;		
		}
		
		if($custom_wrap == 'boxed' && $backgroundtype != 'default_backgroundslider') {

			if($backgroundtype == 'default_backgroundcolor') {
			
				 echo 'body { background-color: '.$backgroundcolor.' !important; }';
			
			} elseif($backgroundtype == 'default_backgroundpattern') {
			
				 echo 'body { background: url('.THEME_WEB_ROOT.'/images/pattern/'.$backgroundpattern.') repeat; }';
			
			} elseif($backgroundtype == 'default_backgroundimage') {
				
				echo 'html { background: url('.$backgroundimage.') fixed; ';
				
				?>
				
				-webkit-background-size: cover;
				-moz-background-size: cover;
				-o-background-size: cover;
				background-size: cover;
								
				<?php
				
				echo '}';			
			
			} elseif($backgroundtype == 'default_backgroundtexture') {
			
				echo 'html { background: url('.THEME_WEB_ROOT.'/images/bg-textured/'.$backgroundtexture.') fixed; ';
				
				?>
				
				-webkit-background-size: cover;
				-moz-background-size: cover;
				-o-background-size: cover;
				background-size: cover;
			
				<?php
				
				echo '}';
				
			}
		}
	}
}


#-----------------------------------------------------------------
# Custom Slider Background
#-----------------------------------------------------------------
if ( ! function_exists( 'customSliderBackground' ) ) {
	function customSliderBackground() {
		
		global $slider_meta_data;
		
		//defaultvalues
		$backgroundtype = get_option_tree( 'slider_background_type' );
		$backgroundpattern = get_option_tree( 'slider_default_backgroundpattern' );
		$backgroundtexture = get_option_tree( 'slider_default_backgroundtexture' );
		$backgroundimage = get_option_tree( 'slider_default_backgroundimage' , '' , false , true);
		
	
		//Get needed meta variables
		if( lambda_is_blog_related() ) {
			
			$homeid = get_option('page_for_posts');  
			$imagedata = get_post_meta($homeid, $slider_meta_data->get_the_id(), TRUE);	
			
		} else {
			
			$imagedata = $slider_meta_data->the_meta();
		}
				
		//overwrite default values coming from meta panel if necessary
		$backgroundtype = (isset($imagedata['slider_background_type'])) ? $imagedata['slider_background_type']: $backgroundtype ;
		$backgroundpattern = (isset($imagedata['slider_default_backgroundpattern'])) ? $imagedata['slider_default_backgroundpattern'] : $backgroundpattern;
		$backgroundtexture = (isset($imagedata['slider_default_backgroundtexture'])) ? $imagedata['slider_default_backgroundtexture']: $backgroundtexture;		
		$backgroundimage['background-color'] = (isset($imagedata['slider_default_backgroundcolor'])) ? $imagedata['slider_default_backgroundcolor'] : $backgroundimage['background-color'];
		
		if(isset($imagedata['slider_default_background_image'])) {
			$backgroundimage['background-image'] = (isset($imagedata['slider_default_background_image'])) ? $imagedata['slider_default_background_image'] : $backgroundimage['background-image'];
			$backgroundimage['background-repeat'] = (isset($imagedata['slider_default_background_repeat'])) ? $imagedata['slider_default_background_repeat'] : $backgroundimage['background-repeat'];
			$backgroundimage['background-position'] = (isset($imagedata['slider_default_background_position'])) ? $imagedata['slider_default_background_position'] : $backgroundimage['background-position'];
			$backgroundimage['background-attachment'] = (isset($imagedata['slider_default_background_attachment'])) ? $imagedata['slider_default_background_attachment'] : $backgroundimage['background-attachment'];
		}
				
		if($backgroundtype == 'slider_default_backgroundpattern') {
		
			 echo '#lambda-featured-header-wrap { background: url('.THEME_WEB_ROOT.'/images/pattern/'.$backgroundpattern.') repeat; }';
		
		} elseif($backgroundtype == 'slider_default_backgroundimage') {
			
			echo '#lambda-featured-header-wrap { background:'.$backgroundimage['background-color'].' url('.$backgroundimage['background-image'].') '.$backgroundimage['background-repeat'].' '.$backgroundimage['background-position'].' '.$backgroundimage['background-attachment'].'; }';
		
		} elseif($backgroundtype == 'slider_default_backgroundtexture') {
		
			echo '#lambda-featured-header-wrap { background: url('.THEME_WEB_ROOT.'/images/bg-textured/'.$backgroundtexture.') top center; background-size: 100%; }';
			
		
		}
		
	}
}

#-----------------------------------------------------------------
# Custom Wrap
#-----------------------------------------------------------------
if ( ! function_exists( 'customWrap' ) ) {
	function customWrap() {
		
		global $lambda_meta_data, $slider_meta_data, $cookiestatus, $theme_options;
		
		//default layout
		$custom_wrap = get_option_tree('sitelayout');
		$imagesize = ($slider_meta_data->get_the_value('static_image_size')) ? $slider_meta_data->get_the_value('static_image_size') : 'off';
			
		//overwrite custom_css array if meta data has been set
		if( lambda_is_blog_related() ) {
			
			$homeid = get_option('page_for_posts');  
			$imagesize = get_post_meta($homeid, $slider_meta_data->get_the_id(), TRUE);
			$imagesize = (isset($imagesize['static_image_size'])) ? $imagesize['static_image_size'] : $imagesize;

		} 
						
					
		if( $custom_wrap == 'boxed' ) { ?>
		#wrap {
			padding:0;
			margin:0 auto;
			position:relative;
            -webkit-box-shadow: 0 0 25px rgba(0, 0, 0, 0.6);  
    		-moz-box-shadow: 0 0 25px rgba(0, 0, 0, 0.6);
   			-ms-box-shadow: 0 0 25px rgba(0, 0, 0, 0.6);
			-o-box-shadow: 0 0 25px rgba(0, 0, 0, 0.6);
    		box-shadow: 0 0 25px rgba(0, 0, 0, 0.6);
            width:990px;
		}
        
       
		#lambda-featured-header { 
			max-width:100%; 
			margin: 0 auto; 
		}
		
		<?php } elseif( $custom_wrap == 'fullwidth' ) { ?>
		
            #wrap {
                padding:0;
                margin:0;
                position:relative;
                width:100%;            
            }
            
            #lambda-featured-header { 
                <?php echo (isset($imagesize) && $imagesize != 'off') ? 'width:940px;' : ''; ?> 
                max-width:100%; 
                margin: 0 auto; 
            }
            
            body {
                background: #242424 !important;
            }
            
            
            <?php if($cookiestatus && ( isset($_COOKIE['responsivestatus'] ) && $_COOKIE['responsivestatus'] == "off") ) { ?>
            
                @media only screen and (max-width: 959px) {
                    
                    #wrap {
                        width:990px;
                    }
                
                }
                
                @media only screen and (min-width: 960px) {
                    
                    #wrap {
                        width:100%;
                    }
                
                }
              
            <?php } elseif(!$cookiestatus && $theme_options['responsive'] == 'off')  { ?> 
            
                
                 @media only screen and (max-width: 959px) {
                    
                    #wrap {
                        width:990px;
                    }
                
                }
                
                @media only screen and (min-width: 960px) {
                    
                    #wrap {
                        width:100%;
                    }
                
                }        
            
            <?php } else { ?>
            
                  #wrap {
                        width:100%;
                  }
            
            <?php } ?>
        
		<?php } 
		
	}
}

#-----------------------------------------------------------------
# Lambda Like
#-----------------------------------------------------------------
if ( ! function_exists( 'GetLambdaLikePost' ) ) {
	function GetLambdaLikePost($arg = null) {
		 
		global $wpdb;
		 
		$post_id = get_the_ID();
		$lambda_like_post = "";
		  
		$category = get_the_category();
		$title_text_like = __('Like', 'claymore');
	
		$like_count = GetLambdaLikeCount($post_id);
		$hasalreadyvoted = HasLambdaAlreadyVoted($post_id);
		
		$like_class = ($hasalreadyvoted > 0) ? 'lambda-like' : 'lambda-unlike';
		
		$like = '<div class="entry-like like_it" id="like-'.$post_id.'">';
				
				$like .= '<a title="'.$title_text_like.'">';
				$like .= '<span id="liked-'.$post_id.'" class="'.$like_class.'">';
					$like .= $like_count;
				$like .= '</span></a>';
			
		$like .= '</div><!-- end post-ut -->';
		
		return $like;
	
	}
}
?>