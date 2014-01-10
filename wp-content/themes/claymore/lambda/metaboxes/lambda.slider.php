<div class="bootstrap-wpadmin" id="featuredheader">
<?php
 
/* Meta Page Panel
 * Update to Page Tool   
 * lambda framework v 2.1
 * by www.unitedthemes.com
 * since lambda framework v 1.0
*/

global $wpalchemy_media_access;
?>


<div class="ui-panelcontent">
    
	<div class="container block">
					
			<div class="meta-headline">
			
				<h1><?php _e( 'Featured Header', 'claymore' ); ?></h1>
				<div class="clear"></div>
				
			</div>
		
			<div class="six columns">
			
				<div class="lambda-opttitle">
        	
					<div class="lambda-opttitle-pad">
						<i class="icon-list-alt icon-black"></i><?php _e( 'Choose Header Type', 'claymore' ); ?>
					</div>
			
				</div>


				<div class="lambda-settings-pad">

				<div class="slider_type_details">		
					
					<?php 
					$slidertype = array (
						'' 					=> __( 'Choose Header Type', 'claymore' ),
						'static_image' 		=> __( 'Static Image', 'claymore' ),
						'static_video' 		=> __( 'Static Video', 'claymore' ),
						'static_slider' 	=> __( 'Slider', 'claymore' ),
						'static_textvideo' 	=> __( 'Static Video + Text', 'claymore' )
					);
							
					?>			
							
					<?php $mb->the_field('sliderstyle_type'); ?>
					<select name="<?php $mb->the_name(); ?>" id="sliderstyle_type">
						<?php foreach($slidertype as $key => $value) { echo '<option value="'.$key.'" '.$mb->get_the_select_state($key).'>'.$value.'</option>'; } ?> 
					</select>
											
					<hr />
	
					<?php
					#-----------------------------------------------------------------
					# Static Image
					#-----------------------------------------------------------------
					?>	
					<div id="static_image" class="ss_box">
						
						<div class="lambda-opttitle">
						<div class="lambda-opttitle-pad">
							<?php _e( 'Static Image', 'claymore' ); ?>
							</div>
						</div>
								
						<div class="lambda-settings-pad">
						
						<?php $mb->the_field('static_image'); ?>
						<?php $wpalchemy_media_access->setGroupName('img-s'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
						<p>   
                            <label><?php _e( 'Static Image', 'claymore' ); ?></label>
                            <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
							<br /><span class="badge badge-info"><?php _e( 'This Image should be at least 980px wide', 'claymore' ); ?></span><br />
                            <?php echo wpa_media_button(__("Upload Video" , 'claymore') , __("claymore Files" , 'claymore'), __("Insert Video" , 'claymore') , 'image'); ?>
                                                   
                        </p>
						
						<hr />
						
						<p>
							<label><?php _e( 'URL (optional)', 'claymore' ); ?></label>
							<?php $mb->the_field('static_image_url'); ?>
							<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
						</p>
							
						<p>
							<label><?php _e( 'Caption (optional)', 'claymore' ); ?></label>
							<?php $mb->the_field('static_image_caption'); ?>
							<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
						</p>
						
						
						
						<div class="btn-group" style="margin-bottom:15px;">
							<label><?php _e( 'Image width', 'claymore' ); ?></label>
							<?php $mb->the_field('static_image_size'); ?>
								
							<?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
							<?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-success' : 'inactive'; ?>
								
							<button data-state="static_image_size_on" class="btn <?php echo $activestate; ?> radio_active" type="button" value="on"><?php _e( 'centered', 'claymore' ); ?></button>
							<input id="static_image_size_on" type="radio" value="on" name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
							<button data-state="static_image_size_off" class="btn <?php echo $deactivestate; ?> radio_inactive" type="button" value="off"><?php _e( 'fullwidth', 'claymore' ); ?></button>	
							<input id="static_image_size_off" type="radio" value="off" name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>
							<span class="badge badge-info"><?php _e( 'only takes effect on full width layouts!', 'claymore' ); ?></span>	
						</div>
									
						</div>			
					</div>
								
								
					<?php
					#-----------------------------------------------------------------
					# Static Video
					#-----------------------------------------------------------------
					?>
					<div id="static_video" class="ss_box">
						
						<div class="lambda-opttitle">
						<div class="lambda-opttitle-pad">
							<?php _e( 'Static Video', 'claymore' ); ?>
							</div>
						</div>
								
						<div class="lambda-settings-pad">
						
                        		<?php $mb->the_field('single_nonverbla_url'); ?>
								<?php $wpalchemy_media_access->setGroupName('nonverbla_url_slider'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
                                <p>   
                                    <label><?php _e( 'Upload Video', 'claymore' ); ?></label>
                                    <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                                    <br /><span class="info badge badge-info">(<?php _e('can be .mov, .flv', 'claymore'); ?>)</span><br />
                                    <?php echo wpa_media_button(__("Upload Video" , 'claymore') , __("claymore Files" , 'claymore'), __("Insert Video" , 'claymore') , 'image'); ?>
                                                           
                                </p>
                                
                                <?php $mb->the_field('single_nonverbla_hd_url'); ?>
                                <?php $wpalchemy_media_access->setGroupName('nonverbla_hd_url_slider'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
                                <p>   
                                    <label><?php _e( 'Upload Video', 'claymore' ); ?></label>
                                    <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                                    <br /><span class="info badge badge-info">(<?php _e('can be .mov, .flv', 'claymore'); ?>)</span><br />
                                    <?php echo wpa_media_button(__("Upload Video" , 'claymore') , __("claymore Files" , 'claymore'), __("Insert Video" , 'claymore') , 'image'); ?>
                                                           
                                </p>
                                
                                <?php $mb->the_field('single_poster_image'); ?>
                                <?php $wpalchemy_media_access->setGroupName('poster_image'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
                                <p>   
                                    <label><?php _e( 'Poster Image', 'claymore' ); ?></label>
                                    <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                                    <br /><span class="info badge badge-info">(<?php _e('should be same size as Video', 'claymore'); ?>)</span><br />
                                    <?php echo wpa_media_button(__("Upload Poster" , 'claymore') , __("claymore Files" , 'claymore'), __("Insert Poster" , 'claymore') , 'image'); ?>
                                                           
                                </p>		
                                
                                <?php $mb->the_field('single_mp4_url'); ?>
                                <?php $wpalchemy_media_access->setGroupName('mp4_url_slider'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
                                <p>   
                                    <label><?php _e( 'MP4 File URL', 'claymore' ); ?></label>
                                    <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                                    <br /><span class="info badge badge-info">(<?php _e('should be same size as Video', 'claymore'); ?>)</span><br />
                                    <?php echo wpa_media_button(__("Upload Video" , 'claymore') , __("claymore Files" , 'claymore'), __("Insert Video" , 'claymore') , 'image'); ?>
                                                           
                                </p>
                                
                                <p><h4>or</h4></p>
                                
                                <p>
                                <?php $mb->the_field('single_embedded_code'); ?>
                                <label class="metalabel"><?php _e( 'Embedded Code', 'claymore' ); ?></label>
                                <textarea name="<?php $mb->the_name(); ?>" rows="8" cols="75" class="lambdatextarea"><?php $mb->the_value(); ?></textarea>
                                <br /><span class="info badge badge-info">(<?php _e( 'Embedded Code', 'claymore' ); ?>)</span>
                                </p>
                                						
						</div>
								
					</div>			
								
							
					<?php
					#-----------------------------------------------------------------
					# Static Slider
					#-----------------------------------------------------------------
					?>	
					<div id="static_slider" class="ss_box">
						
						<div class="lambda-opttitle">
						<div class="lambda-opttitle-pad">
							<?php _e( 'Static Slider', 'claymore' ); ?>
							</div>
						</div>
								
						<div class="lambda-settings-pad">
						
						
						<?php $mb->the_field('main_slider'); ?>
						<select name="<?php $mb->the_name(); ?>" class="lambda_select">
						<option value=""><?php _e( 'Choose Slider', 'claymore' ); ?></option>
						
						<?php
										
						global $wpdb, $blog_id;
							
							$table_name = $wpdb->base_prefix . "lambda_sliders";
							$slidedata = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id");
												
							foreach ($slidedata as $singledata) { 
							   
							   if($singledata->slidertype != 'supersized')
						
								   echo "<option value='lambda_".$singledata->id."' name='".$singledata->option_name."' ".$mb->get_the_select_state('lambda_'.$singledata->id).">".$singledata->option_name."</option>";
						 
								}							
								
								if($blog_id != 1){
									$table_prefix = $wpdb->base_prefix . $blog_id."_";
								} else {
									$table_prefix = $wpdb->base_prefix;
								}
													
								$table_name = $table_prefix . "revslider_sliders";
								$slidedata = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id");
											
								foreach ($slidedata as $singledata) { 
										   
								   echo "<option value='revslider_".$singledata->id."' name='".$singledata->title."' ".$mb->get_the_select_state('revslider_'.$singledata->id).">".$singledata->title."</option>";
									
								} 
								
								?>
						</select>
						</div>
					</div>
					
					
					
					<?php
					#-----------------------------------------------------------------
					# Static Video + Text
					#-----------------------------------------------------------------
					?>	
					<div id="static_textvideo" class="ss_box">
						
						<div class="lambda-opttitle">
						<div class="lambda-opttitle-pad">
							<?php _e( 'Static Video & Text', 'claymore' ); ?>
							</div>
						</div>
								
						<div class="lambda-settings-pad">
						
						<h5>Feature Box</h5><br />
						<p><label><?php _e( 'Headline', 'claymore' ); ?></label>
						<?php $mb->the_field('featured_headline'); ?>
						<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
						
						
						<script type="text/javascript">
								
								jQuery(document).ready(function($) {  
									$('#featured_headline_color').ColorPicker({
										onSubmit: function(hsb, hex, rgb) {
											$('#featured_headline_color').val('#'+hex);
										},
										onBeforeShow: function () {
											$(this).ColorPickerSetColor(this.value);
											return false;
										},
										onChange: function (hsb, hex, rgb) {
											$('#featured_headline_color').val('#'+hex);
											$('#cp_featured_headline_color div').css({'backgroundColor':'#'+hex, 'borderColor':'#'+hex});
											$('#cp_featured_headline_color').prev('input').attr('value', '#'+hex);
										}
										}).bind('keyup', function(){
											$(this).ColorPickerSetColor(this.value);
										});
								});
								
						</script>
						
						<div class="colorform">	
							<?php $mb->the_field('featured_headline_color'); ?>
							
							<div id="cp_featured_headline_color" class="cp_box box_style_2">
								<div style="background-color:<?php echo ( !is_null ( $mb->get_the_value() ) ) ? $mb->get_the_value() : '#ffffff'; ?>;<?php if ( !is_null ( $mb->get_the_value() ) ) { echo 'border-color:' . $mb->get_the_value() . ';'; } ?>"> 
								</div>
							</div> 
									
							<label class="cp_box_label"><?php _e('Headline Color', 'claymore'); ?></label>
							<input id="featured_headline_color" type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
						</div>
						
							
						<p><label><?php _e( 'Text', 'claymore' ); ?></label>
						<?php $mb->the_field('featured_text'); ?>
						<textarea name="<?php $mb->the_name(); ?>" rows="8" cols="75" class="lambdatextarea"><?php $mb->the_value(); ?></textarea></p>
						
						
						<script type="text/javascript">
								
								jQuery(document).ready(function($) {  
									$('#featured_text_color').ColorPicker({
										onSubmit: function(hsb, hex, rgb) {
											$('#featured_text_color').val('#'+hex);
										},
										onBeforeShow: function () {
											$(this).ColorPickerSetColor(this.value);
											return false;
										},
										onChange: function (hsb, hex, rgb) {
											$('#featured_text_color').val('#'+hex);
											$('#cp_featured_text_color div').css({'backgroundColor':'#'+hex, 'borderColor':'#'+hex});
											$('#cp_featured_text_color').prev('input').attr('value', '#'+hex);
										}
										}).bind('keyup', function(){
											$(this).ColorPickerSetColor(this.value);
										});
								});
								
						</script>
							
						<div class="colorform">		
							<?php $mb->the_field('featured_text_color'); ?>	
							
							<div id="cp_featured_text" class="cp_box box_style_2">
								<div style="background-color:<?php echo ( !is_null ( $mb->get_the_value() ) ) ? $mb->get_the_value() : '#ffffff'; ?>;<?php if ( !is_null ( $mb->get_the_value() ) ) { echo 'border-color:' . $mb->get_the_value() . ';'; } ?>"> 
								</div>
							</div> 
							
							<label class="cp_box_label"><?php _e('Textcolor', 'claymore'); ?></label>
							<input id="featured_text_color" type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
												
						</div>
						
						<p><label><?php _e( 'Buttontext', 'claymore' ); ?></label>
						<?php $mb->the_field('featured_buttontext'); ?>
						<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
						
						<p><label><?php _e( 'Buttonlink', 'claymore' ); ?></label>
						<?php $mb->the_field('featured_link'); ?>
						<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>		
						
						<hr />
						
						<h5>Video Settings</h5><br />	
						
						<p>
						<?php $mb->the_field('nonverbla_url'); ?>
						<?php $wpalchemy_media_access->setGroupName('nonverbla_url_slider'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
						<label><?php _e( 'Upload Video', 'claymore' ); ?></label>
						<?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
						<br /><span class="info badge badge-info">(<?php _e('can be .mov, .flv', 'claymore'); ?>)</span><br />
						<?php echo $wpalchemy_media_access->getButton(); ?>
						</p>
										
								
						<p>
						<?php $mb->the_field('nonverbla_hd_url'); ?>
						<?php $wpalchemy_media_access->setGroupName('nonverbla_hd_url_slider'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
						<label><?php _e( 'Upload HD Video', 'claymore' ); ?></label>
						<?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
						<br /><span class="info badge badge-info">(<?php _e('can be .mov, .flv', 'claymore'); ?>)</span><br />
						<?php echo $wpalchemy_media_access->getButton(); ?>
						</p>
						
						
						<p>
						<?php $mb->the_field('poster_image'); ?>
						<?php $wpalchemy_media_access->setGroupName('poster_image'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
						<label><?php _e( 'Poster Image', 'claymore' ); ?></label>
						<?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
						<br /><span class="info badge badge-info">(<?php _e('should be same size as Video', 'claymore'); ?>)</span><br />
						<?php echo $wpalchemy_media_access->getButton(); ?>
						</p>			
								
								
						<p>
						<?php $mb->the_field('mp4_url'); ?>
						<?php $wpalchemy_media_access->setGroupName('mp4_url_slider'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
						<label><?php _e( 'MP4 File URL', 'claymore' ); ?></label>
						<?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
						<br /><span class="info badge badge-info">(<?php _e('The URL to .mp4 video file for Ipad', 'claymore'); ?>)</span><br />
						<?php echo $wpalchemy_media_access->getButton(); ?>
						</p>    
								
								
						<p>
						<label class="metalabel"><?php _e( 'Embedded Code', 'claymore' ); ?></label>
						<?php $mb->the_field('embedded_code'); ?>
						<textarea name="<?php $mb->the_name(); ?>" rows="8" cols="75" class="lambdatextarea"><?php $mb->the_value(); ?></textarea>
						<br /><span class="info badge badge-info">(<?php _e( 'Embedded Code', 'claymore' ); ?>)</span>
						</p>
						
					</div>			
		
			</div>
		
		</div>
		
	</div>	
	
</div> <!-- /slider type details -->

		

<div class="slider_type_background ten columns">
	
	<div class="lambda-opttitle">
		<div class="lambda-opttitle-pad">
			<i class="icon-align-justify icon-black"></i><?php _e( 'Hide Teaser / Page Title?', 'claymore' ); ?>
		</div>
	</div>
	
	<div class="lambda-settings-pad">
	
		<div class="btn-group" style="height:40px;">
			
			<?php $mb->the_field('hide_teaser'); ?>
							
			<?php $activestate = ($mb->get_the_value() == 'teaseron') ? 'active btn-success' : 'inactive'; ?>
			<?php $deactivestate = ($mb->get_the_value() == 'teaseroff') ? 'active btn-success' : 'inactive'; ?>
				
			<button data-state="hide_teaser_on" class="btn <?php echo $activestate; ?> radio_active" type="button" value="teaseron"><?php _e( 'show', 'claymore' ); ?></button>
			<input id="hide_teaser_on" type="radio" value="teaseron" name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_active" <?php $mb->the_radio_state('teaseron'); ?>>
			<button data-state="hide_teaser_off" class="btn <?php echo $deactivestate; ?> radio_inactive" type="button" value="teaseroff"><?php _e( 'hide', 'claymore' ); ?></button>	
			<input id="hide_teaser_off" type="radio" value="teaseroff" name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_inactive" <?php $mb->the_radio_state('teaseroff'); ?>>
						
		</div>
		
			
	</div>
	
	
	
	
	<div class="lambda-opttitle">
		<div class="lambda-opttitle-pad">
			<i class="icon-picture icon-black"></i><?php _e( 'Background Settings', 'claymore' ); ?>
		</div>
	</div>
			
	<div class="lambda-settings-pad">
				
		<p>
			<?php $mb->the_field('slider_background_type'); ?>
			<select name="<?php $mb->the_name(); ?>" id="sbgstyle_type">
				<option value=""><?php _e( 'Choose Background Type', 'claymore' ); ?></option>
				<option value="slider_default_backgroundimage" <?php $mb->the_select_state('slider_default_backgroundimage'); ?>> <?php _e( 'Image or Color', 'claymore' ); ?> </option>
				<option value="slider_default_backgroundpattern" <?php $mb->the_select_state('slider_default_backgroundpattern'); ?>> <?php _e( 'Background Pattern', 'claymore' ); ?> </option>
				<option value="slider_default_backgroundtexture" <?php $mb->the_select_state('slider_default_backgroundtexture'); ?>> <?php _e( 'Background Texture', 'claymore' ); ?> </option>
			</select>
		</p>
	
		<div id="slider_default_backgroundimage" class="sbg_box">
			
			<script type="text/javascript">
				
				jQuery(document).ready(function($) {  
					$('#slider_solid_backgroundcolor').ColorPicker({
						onSubmit: function(hsb, hex, rgb) {
							$('#slider_solid_backgroundcolor').val('#'+hex);
						},
						onBeforeShow: function () {
							$(this).ColorPickerSetColor(this.value);
							return false;
						},
						onChange: function (hsb, hex, rgb) {
							$('#slider_solid_backgroundcolor').val('#'+hex);
							$('#cp_slider_solid_backgroundcolor div').css({'backgroundColor':'#'+hex, 'borderColor':'#'+hex});
							$('#cp_slider_solid_backgroundcolor').prev('input').attr('value', '#'+hex);
						}
						}).bind('keyup', function(){
							$(this).ColorPickerSetColor(this.value);
						});
				});
				
			</script>
			
					<?php $mb->the_field('slider_default_backgroundcolor'); ?>
					<p>
					
					<div id="cp_slider_solid_backgroundcolor" class="cp_box">
						<div style="background-color:<?php echo ( !is_null ( $mb->get_the_value() ) ) ? $mb->get_the_value() : '#ffffff'; ?>;<?php if ( !is_null ( $mb->get_the_value() ) ) { echo 'border-color:' . $mb->get_the_value() . ';'; } ?>"> 
						</div>
					</div> 
					<br />
					
					<label><?php _e('Background-Color', 'claymore'); ?></label>
					<input id="slider_solid_backgroundcolor" type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
					</p>
					

					
					<p>					
					<?php $mb->the_field('slider_default_background_repeat'); ?>
					<label><?php _e('Background-Repeat', 'claymore'); ?></label>
					<select name="<?php $mb->the_name(); ?>" class="select">
						<?php
							echo '<option value="">background-repeat</option>';
							foreach ( recognized_background_repeat() as $key => $repeat ) {
							echo '<option value="' . esc_attr( $key ) . '" ' . $mb->get_the_select_state(esc_attr( $key )) . '>' . esc_html( $repeat ) . '</option>';
						} 
					?>
					</select>
					</p>
											
					<p>
					<?php $mb->the_field('slider_default_background_attachment'); ?>
					<label><?php _e('Background-Attachment', 'claymore'); ?></label>
					<select name="<?php $mb->the_name(); ?>" class="select">
						<?php
							echo '<option value="">background-attachment</option>';
							foreach ( recognized_background_attachment() as $key => $attachment ) {
							echo '<option value="' . esc_attr( $key ) . '" ' . $mb->get_the_select_state(esc_attr( $key )) . '>' . esc_html( $attachment ) . '</option>';
						} 
						?>
					</select>
					</p>	
						
					<p>						
					<?php $mb->the_field('slider_default_background_position'); ?>
					<label><?php _e('Background-Position', 'claymore'); ?></label>
					<select name="<?php $mb->the_name(); ?>" class="select">
						<?php
							echo '<option value="">background-position</option>';
							foreach ( recognized_background_position() as $key => $position ) {
							echo '<option value="' . esc_attr( $key ) . '" ' . $mb->get_the_select_state(esc_attr( $key )) . '>' . esc_html( $position ) . '</option>';
						} 
						?>
					</select>					
					</p>
						
					<?php $mb->the_field('slider_default_background_image'); ?>
					<?php $wpalchemy_media_access->setGroupName('img-bs'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
					<p>
						<img src="<?php if(!$mb->get_the_value()){ echo THEME_WEB_ROOT.'/lambda/assets/images/nopic.jpg'; } 
						else { echo aq_resize( $mb->get_the_value(), 140, 140, true ); } ?>" width="175px" />
													
						<label><?php _e( 'Image URL', 'claymore' ); ?></label>                        
							
						<?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
						<?php echo $wpalchemy_media_access->getButton(); ?>
					</p>
				</div>
						
				<div id="slider_default_backgroundpattern" class="sbg_box">			
				<?php $mb->the_field('slider_default_backgroundpattern'); ?>			
				<fieldset id="choosepattern">
				
					<?php
					//First we need the absolute path to our theme directory to make readdir work
					$absolute_path = __FILE__;
					$path_to_file = explode( 'lambda', $absolute_path );
					$absolute_path_to_theme = $path_to_file[0];
					
					//lets search for pattern!
					if ($handle = opendir($absolute_path_to_theme.'/images/pattern/')) {
						
						$count = 0;
						while (false !== ($file = readdir($handle))) {
							if($file != '..' && $file != '.') {	
								echo '<div class="single_pattern">
									  <input class="check-with-label" name="'.$mb->get_the_name().'" id="'.$mb->get_the_name().'_'.$count.'" type="radio" value="'.trim( $file ).'"'.$mb->get_the_radio_state(trim( $file )).' />
									  <label class="label-for-check" for="'.$mb->get_the_name().'_'.$count.'"><div class="pattern" style="background: url('.THEME_WEB_ROOT.'/images/pattern/'.$file.');"></div></label></div>';
								$count++;
							}
						}
						
						//and we also do not forget to close ;)			
						closedir($handle);
					}	
					?>
					
				</fieldset>			
				</div>	
				
				
				<div id="slider_default_backgroundtexture" class="sbg_box">
				<?php $mb->the_field('slider_default_backgroundtexture'); ?>			
				<fieldset id="choosepattern">
				
					<?php
					//First we need the absolute path to our theme directory to make readdir work
					$absolute_path = __FILE__;
					$path_to_file = explode( 'lambda', $absolute_path );
					$absolute_path_to_theme = $path_to_file[0];
					
					//lets search for pattern!
					if ($handle = opendir($absolute_path_to_theme.'/images/bg-textured/prev/')) {
						
						$count = 0;
						while (false !== ($file = readdir($handle))) {
							if($file != '..' && $file != '.') {	
								echo '<div class="single_pattern">
									  <input class="check-with-label" name="'.$mb->get_the_name().'" id="'.$mb->get_the_name().'_'.$count.'" type="radio" value="'.trim( $file ).'"'.$mb->get_the_radio_state(trim( $file )).' />
									  <label class="label-for-check" for="'.$mb->get_the_name().'_'.$count.'"><div class="pattern" style="background: url('.THEME_WEB_ROOT.'/images/bg-textured/prev/'.$file.');"></div></label></div>';
								$count++;
							}
						}
						
						//and we also do not forget to close ;)			
						closedir($handle);
					}	
					?>
					
				</fieldset>			
				</div>	
			
	</div>
</div> <!-- /slider type background -->

<div class="clear"></div>
</div><!-- /pad-->
</div><!-- /content-->		  
</div><!-- /bootstrapadmin-->