<?php
/**
 * Template Name: Archive
 *
 * lambda framework v 2.1
 * by www.unitedthemes.com
 * since lambda framework v 1.0
 * based on skeleton
*/

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

<section class="one_fourth">
	<article>
		
		<ul class="archive">
        
        
				<h3 class="archiv-title"><?php _e('Last 30 Posts', 'claymore' ) ?></h3>
	
        
        <ul>
				<?php $archive = get_posts('numberposts=30');
    						foreach($archive as $post) : ?>
				<li><a href="<?php the_permalink(); ?>">
						<?php the_title();?>
						</a></li>
				<?php endforeach; ?>
                </ul>
               
		</ul>
	</article>        
</section>


		<section class="one_fourth">
			<article>        
                
				<ul class="archive">
                
                        <h3 class="archiv-title"><?php _e('Top 10 Likes', 'claymore' ) ?></h3>
                
                
                <ul>
				<?php $posts = LambdaMostLikeQuery('LIMIT 10', ''); ?>
				
				<?php
			
					if(is_array($posts)) {
						
						foreach ($posts as $post) {
							echo '<li><a href="' . get_permalink($post->post_id) . '" title="' . stripslashes($post->post_title) .'" rel="nofollow">' . stripslashes($post->post_title) . '</a>&nbsp;('.$post->like_count.')</li>';
						}
						
					} else {
						
						echo '<li>'.__('No posts voted yet.', 'claymore').'</li>';
						
					}
					
				?>
                </ul>
               		
				</ul>		
			</article>        
		</section>

		<section class="one_fourth">
			<article>
                
                <ul class="archive">
                	
                        <h3 class="archiv-title"><?php _e('Archives by Subject:', 'claymore' ) ?></h3>
                    	<ul>
                        <?php wp_list_categories( 'title_li=' ); ?>
                        </ul>
                       
                </ul>
            </article>
         </section>  
         
         <section class="one_fourth last">
			<article>
                
                <ul class="archive">
                	
                        <h3 class="archiv-title"><?php _e('Archives by Month:', 'claymore' ) ?></h3>
                
                	<ul>
                        <?php wp_get_archives('type=monthly'); ?>
                    </ul>
                     
                </ul>        
      		</article>
		</section> 
                       
<?php
//content closer - this function can be found in functions/theme-layout-functions.php line 56-61
lambda_after_content();

//includes the footer.php
get_footer();
?>
