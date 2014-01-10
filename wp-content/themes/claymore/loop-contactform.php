<?php

/* Contact Form Loop
 *
 * lambda framework v 2.1
 * by www.unitedthemes.com
 * since lambda framework v 1.0
 */
 
global $emailSent, $captcha_error, $columns;
$contactelements = lambda_return_meta('page'); ?>


<section id="post-<?php the_ID(); ?>" <?php post_class('single'); ?>>
  	<article class="entry-content">
    
	<?php 
		#-----------------------------------------------------------------
		# google map output
		#-----------------------------------------------------------------
		if(isset($contactelements['show_map'])) {
			
			if(isset($contactelements['map_title']))
			echo '<h3 class="home-title"><span>'.lambda_translate_meta($contactelements['map_title']).'</span></h3>';
								
			echo do_shortcode('[googlemap address="'.$contactelements['map_address'].'" zoom="'.$contactelements['map_zoom'].'" height="'.$contactelements['map_height'].'"]');
		}
	?>
    
    <?php
		
		if(isset($contactelements['contact_title'])) {
			echo '<h3 class="home-title"><span>'.lambda_translate_meta($contactelements['contact_title']).'</span></h3>';
		}
		
		#-----------------------------------------------------------------
		# the content
		#----------------------------------------------------------------- 
		if(have_posts()) : while (have_posts()) : the_post();
			the_content();
		endwhile; endif; ?>
    
    
    
    <?php if(get_option_tree('google_recaptcha')) { ?>
	<script type="text/javascript">
		var RecaptchaOptions = {
		theme : 'clean',
		lang : 'en'
	};
	</script>
    <?php } ?>

  
    <?php 
	#-----------------------------------------------------------------
	# mail has been sent or not :)
	#----------------------------------------------------------------- 
	if ($emailSent) {
		echo '<div class="alert green" id="send_success">'.__( 'Message has been sent!', 'claymore' ).'</div>';
	}
	if ($captcha_error) {
		echo '<div class="alert yellow" id="send_error">'.__( 'Message has not been sent! Reason: Incorrect Caption!', 'claymore' ).'</div>';
	}	
	
   
	?>
    <form action="<?php the_permalink(); ?>#send_success" id="contactForm" method="post" class="validateform">
    		 <?php 		
			 			
						//generate Contact form!
						if(isset($contactelements[UT_THEME_INITIAL.'contact_form_fields']) && is_array($contactelements[UT_THEME_INITIAL.'contact_form_fields'])) {
							foreach ($contactelements[UT_THEME_INITIAL.'contact_form_fields'] as $field)	{
								$form_data = '';
								if(is_array($_POST)) {
									//Check if some Post data has sent before but caption was not correct
									foreach($_POST as $celement => $value) {
										
										//data of fields
										if($celement == remove_trash($field['field_name']) && !$emailSent) {
											//reasign Data to Form
											$form_data = $value;
										}
												
									}	//endforeach		
								} //endif
								
								//Start creating the contact form
								switch($field['field_type']) {
									//needed function in form-functions.php
									case "input": render_input_field($field, $form_data);
									break;
									
									case "email": render_email_field($field, $form_data);
									break;
									
									case "textarea": render_textarea($field, $form_data);
									break;
									
									case "radio": render_radio($field, $form_data);
									break;
									
									case "select": render_select($field, $form_data);
									break;
									
									case "checkbox": render_checkbox($field, $form_data);
									break;
								}
												
								
							}
							
							//Anti Spam - ReCaptcha Plugin
          					if(get_option_tree('google_recaptcha')) { 
							
								require_once('functions/recaptchalib.php');
								$publickey = get_option_tree('public_key'); // you got this from the signup page
								echo recaptcha_get_html($publickey, $captcha_error, true); 
							} //endif
							
							echo '<p><input type="submit" value="'.lambda_translate_meta($contactelements['submit_text']).'" ></p>';
						}	
			?>
    <input type="hidden" name="submitted" id="submitted" value="true" />
    </form>
    <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'claymore' ), 'after' => '</div>' ) ); ?>
  </article>
  <!-- .entry-content --> 
  
</section>
<!-- #post-## --> 

