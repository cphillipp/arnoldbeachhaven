<?php

/*
 * basic update manager
 * lambda framework v 2.1
 * by www.unitedthemes.com
 * since framework v 2.1
 */

global $wpdb;

#-----------------------------------------------------------------
# additional styles
#-----------------------------------------------------------------
function lambda_tinfo_admin_add_styles() {
    	
	wp_register_style('standard-css', THEME_WEB_ROOT.'/lambda/assets/css/lambda.ui.css');
    wp_enqueue_style( 'standard-css');
				
}
#-----------------------------------------------------------------
# load updateclass
#-----------------------------------------------------------------
require_once('lambda.update.class.php');


#-----------------------------------------------------------------
# Only load Scripts&Styles when needed
#-----------------------------------------------------------------
if ( isset($_GET['page']) && $_GET['page'] == 'view_info' ) {	
	add_action('admin_print_styles', 'lambda_tinfo_admin_add_styles');
}


#-----------------------------------------------------------------
# Output
#-----------------------------------------------------------------
function lambda_view_info() { 

global $version, $themeinfo; ?>

<div id="lambda-option-panel" class="bootstrap-wpadmin">

<div class="alert alert-success">
	<?php _e('Please paste down these information when starting a support inquiry in our supportforum', 'claymore'); ?>
</div>

<br /><br />
		
<div class="alert alert-success">
	<h3>General Information</h3>
	<p>
		<ul>
			<li>WordPress Version: <?php echo get_bloginfo('version'); ?></li>
			<li>URL: <?php echo site_url(); ?></li>
			<li>Theme Version: <?php echo UT_THEME_VERSION; ?></li>
			<li>Framework Version: <?php echo UT_LAMBDA_VERSION; ?></li>
			<li>PHP Version: <?php echo phpversion(); ?> </li>
		</ul>
		
		<?php if( is_array(get_option( 'active_plugins' ))) { ?>
			<br />
			<h3>Installed Plugins</h3>
			<p>
			<ul>
				
				<?php foreach(get_option( 'active_plugins' ) as $plugin) {
					echo '<li>'.$plugin.'</li>';
				} ?>
				
			</ul>
			</p>		
		<?php } ?>
		
	</p>
</div>

<div class="well">
	
	<?php 
		
		if( !get_option( 'lambdacopyright' ) && !get_option( 'lambdacopyrightlink' )) {
					
				add_option('lambdacopyright');
				add_option('lambdacopyrightlink');
				
				update_option('lambdacopyright', 'UnitedThemes');
				update_option('lambdacopyrightlink', 'http://www.unitedthemes.com/');
				
		}
		
		
		$copyright = (get_option('lambdacopyright')) ? get_option('lambdacopyright') : '';
		$copyrightlink = (get_option('lambdacopyrightlink')) ? get_option('lambdacopyrightlink') : '';
	
	?>
	
	
	<form method="post" action="?page=view_info&changecr=true" class="form-horizontal">
		
		<p><label class="control-label"><?php _e('Copyright', 'claymore'); ?></label>
		<input style="margin-left:20px;" type="text" id="option_name" class="lambda_input" name="copyright" size="70" value="<?php echo $copyright; ?>" /></p>
		
		<p><label class="control-label"><?php _e('Copyrightlink', 'claymore'); ?></label>
		<input style="margin-left:20px;" type="text" id="option_name" class="lambda_input" name="copyrightlink" size="70" value="<?php echo $copyrightlink; ?>" /></p>
		
		<button style="float:right;" type="submit" class="btn" value="Add new" /><?php _e('change', 'claymore'); ?></button>
		
		<div class="clear"></div>
		
	</form>
	
	
</div>
<?php } 

if( isset($_GET['changecr'] ) ) {

	$changecr = isset($_GET['changecr']) ? $_GET['changecr'] : false;	
	
	$copyright = isset($_POST['copyright']) ? $_POST['copyright'] : '';
	$copyrightlink = isset($_POST['copyrightlink']) ? $_POST['copyrightlink'] : '';
		
	if($changecr) {
		
		update_option('lambdacopyright', $copyright);
		update_option('lambdacopyrightlink', $copyrightlink);		
		
	}

}

?>