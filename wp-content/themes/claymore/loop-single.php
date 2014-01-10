<?php
/**
 * The loop that displays a single post.
 *
 * lambda framework v 2.1
 * by www.unitedthemes.com
 * since lambda framework v 1.0
 * based on skeleton
 */
 
global $lambda_meta_data;

?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
 
            
				<section id="post-<?php the_ID(); ?>" <?php post_class('single'); ?>>
                              
					<article class="entry-post clearfix">
                    
                    	<header class="entry-header clearfix">
            	        
                            <div class="entry-meta row clearfix">
					
							<div class="post-ut">                        
								<?php _e( 'By ', 'claymore' ); ?>
								<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
									<span class="author-link"><?php the_author(); ?></span>
								</a>												
							</div> <!-- post by -->
					                        
                            <div class="post-ut">
                                <?php echo lambda_posted_on(); ?>
                            </div> <!-- post date -->
                             
                            <div class="post-ut">	
                               <span class="comments-link"><?php comments_popup_link( __( '0 Comments', 'claymore' ), __( '1 Comment', 'claymore' ), __( '% Comments', 'claymore' ) ); ?></span>
                            </div><!-- post comments -->
                        
                            <?php if(get_option_tree('activate_likes_in_blog') == "yes") : ?>
                        
                            <?php echo GetLambdaLikePost(); ?>				
                        
                            <?php endif; ?>
                                                 
                            </div><!-- .entry-meta -->    
                    
            			</header>	
        
        			<div class="clear"></div>
                					
                    <?php
					$post_format = get_post_format();
					($post_format) ? get_template_part( 'post-formats/' . $post_format ) : get_template_part( 'post-formats/standard' );
					?>
                   
                    <div class="entry-content clearfix">
                    
						<div class="entry-summary">					
							<?php the_content(); ?>
                            <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'claymore' ), 'after' => '</div>' ) ); ?>                           
                        </div>
                        
					</div><!-- .entry-content -->
                    
				</article><!-- end article -->
                
				<?php $tags_list = get_the_tag_list( '', ', ' );
						if ( $tags_list ):	?>
						
                    	<div class="post-ut">	
						
							<span class="tag_links">
								<?php printf( __( '<span class="%1$s"></span> %2$s', 'claymore' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
							</span>
							
						</div><!-- post tags -->
						
				<?php endif; ?>
				
				<div class="clear"></div>
				            
			</section><!-- #post-## -->             
                
                <div class="edit-link-wrap">
						<?php edit_post_link( __( 'Edit', 'claymore' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .edit-link-wrap -->
                              
                <div class="clear"></div>
                                
				<?php
				if ( get_the_author_meta( 'description' ) && get_option_tree('author_in_blog') == 'on' && $lambda_meta_data->get_the_value('hide_authorbox') != 'off' ) : ?>
				<div id="author-info" class="clearfix">
					
					
					<figure id="author-avatar">
						<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'lambda_author_bio_avatar_size', 60 ) ); ?>
					</figure><!-- #author-avatar -->
							
					
					<div id="author-description">
						
						<h3 class="author-name">						
							<?php _e( 'About ', 'claymore' ); ?>
							<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
								<span class="author-link"><?php the_author(); ?></span>
							</a>												
						</h3>
						
						<?php echo lambda_translate_meta(get_the_author_meta( 'description' )); ?>
                        
                    <div class="author-links clearfix">					
					
					<?php if(get_the_author_meta( 'user_url', $author_id )) : ?>
					
					<a class="link-author" href="<?php the_author_meta( 'user_url', $author_id ); ?>" target="_blank"></a>
    				
					<?php endif; ?>
					
					
					<?php if(get_the_author_meta( 'facebook', $author_id )) : ?>
					
					<a class="facebook-author" href="<?php the_author_meta( 'facebook', $author_id ); ?>" target="_blank"></a>
					
					<?php endif; ?>
					
					
					<?php if(get_the_author_meta( 'twitter', $author_id )) : ?>
					
					<a class="twitter-author" href="<?php the_author_meta( 'twitter', $author_id ); ?>" target="_blank"></a>
					
					<?php endif; ?>
					
					
					<?php if(get_the_author_meta( 'aim', $author_id )) : ?>
					
					<a class="aim-author" href="<?php the_author_meta( 'aim', $author_id ); ?>" target="_blank"></a>
					
					<?php endif; ?>	
					
					
					<?php if(get_the_author_meta( 'yim', $author_id )) : ?>
					
					<a class="yahoo-author" href="<?php the_author_meta( 'yim', $author_id ); ?>" target="_blank"></a>
					
					<?php endif; ?>	
                    
  					
					<?php if(get_the_author_meta( 'jabber', $author_id )) : ?>
					
					<a class="google-author" href="<?php the_author_meta( 'jabber', $author_id ); ?>" target="_blank"></a>
					
					<?php endif; ?>	
					
					
					<?php if(get_the_author_meta( 'email', $author_id )) : ?>
					
					<a class="email-author" href="mailto:<?php the_author_meta( 'email', $author_id ); ?>" target="_blank"></a>
					
					<?php endif; ?>	
					
					</div>
                    
					</div><!-- #author-description	-->
                    
                 
				</div><!-- #entry-author-info -->
				<?php endif; ?>
				                                
				<?php comments_template( '', true ); ?>
                
                <div class="clear"></div>
                
                <div id="nav-below" class="navigation loop-single clearfix">
					<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&#8656;', 'Previous post link', 'claymore' ) . '</span> %title' ); ?></div>
					<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&#8658;', 'Next post link', 'claymore' ) . '</span>' ); ?></div>
				</div><!-- #nav-below -->

<?php endwhile; // end of the loop. ?>