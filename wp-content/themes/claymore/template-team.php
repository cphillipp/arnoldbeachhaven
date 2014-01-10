<?php
/**
 * Template Name: Team Template
 *
 * lambda framework v 2.1
 * by www.unitedthemes.com
 * since lambda framework v 1.0
 * based on skeleton
*/

global $post;

//retrieve member data
$member_data  = lambda_return_meta('page');
$memberitems  = $member_data[UT_THEME_INITIAL.'team_member'];

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
# Team
#-----------------------------------------------------------------
?>

<?php if ( !post_password_required( $post ) ) : ?>

<section class="member-wrap clearfix entry-content">	

<?php

$z = 1;
$count = count($memberitems);

if(is_array($memberitems)) { 
	
	foreach($memberitems as $member) { ?>
	
		<div class="one_third <?php echo ($z%3 == 0) ? 'last' : ''; ?>">
		
		<section class="member-details clearfix">	
			
        <figure class="member-photo">
			
			<?php 
			if(empty($member['member_pic'])) {
			
				$member_pic['url'] = THEME_WEB_ROOT.'/images/default-avatar.jpg';
			
			} else {
				
				$member_pic['url'] = $member['member_pic'];

			}			 	
			?>
			
			<img class="member-img" src="<?php echo $member_pic['url']; ?>">
						
		</figure>   
            
        <div class="member-info">    
        
        <h3 class="member-name"><?php echo $member['member_name']; ?></h3>
		
		<?php if($member['member_title']) { ?>
			<span class="member-title">
				<?php echo lambda_translate_meta($member['member_title']); ?>
			</span>
			<?php } ?>
        
        </div>
        
		<?php echo do_shortcode(apply_filters( 'the_content' , $member['member_text']) ); ?>			
        
        <div class="member-contact">
			<ul>
				
				<?php if($member['member_email']) { ?><li><a class="email-author" href="mailto:<?php echo $member['member_email']; ?>"></a></li><?php } ?>
				
				<?php if($member['member_website']) { ?><li><a class="link-author" href="<?php echo $member['member_website'];?>"></a></li><?php } ?>
				
				<?php if($member['member_twitter']) { ?><li><a class="twitter-author" href="<?php echo $member['member_twitter'];?>"></a></li><?php } ?>
				
				<?php if($member['member_facebook']) { ?><li><a class="facebook-author" href="<?php echo $member['member_facebook'];?>"></a></li><?php } ?>
				
				<?php if($member['member_google']) { ?><li><a class="google-author" href="<?php echo $member['member_google'];?>"></a></li><?php } ?>
                
                <?php if($member['member_linkedin']) { ?><li><a class="linkedin-author" href="<?php echo $member['member_linkedin'];?>"></a></li><?php } ?>
				
			</ul>
		</div>		
		
        <div class="clear"></div>        
		
		</section><?php echo '<!-- end member '.$z.'-->'; ?> 
		
		</div>
		
		<?php echo ($z%3 == 0) ? '<div class="clear"></div>' : ''; ?>
								
		
<?php $z++; } } ?>

</section><!-- end member-wrap -->

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
