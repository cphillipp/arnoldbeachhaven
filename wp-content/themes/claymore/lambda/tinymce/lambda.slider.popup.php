<?php
$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];

// Access to WordPress
require_once( $path_to_wp . '/wp-load.php' );
$themepath = get_template_directory_uri();
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php _e('Insert your individual Slider', 'claymore'); ?></title>
	
	<link rel="stylesheet" href="<?php echo $themepath; ?>/lambda/assets/css/lambda.ui.css" />
	<script type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/jquery/jquery.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option( 'siteurl' ) ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>

	
<style type="text/css">		
	label{
			font-weight: block;
			color: #333;
			padding: 3px 5px;
	}
</style>
<script type="text/javascript">
	

	
	var ButtonDialog = {
		local_ed : 'ed',
		init : function(ed , url) {
			ButtonDialog.local_ed = ed;
			tinyMCEPopup.resizeToInnerSize();
		},
		insert : function insertButton(ed) {
		 
			// set up variables to contain our input values
			var slideID = jQuery('#sliderselect').val();				
			var output = '[lambdaslider id="'+slideID+'"]';
		 
			tinyMCEPopup.execCommand('mceReplaceContent', false, output);
			 
			// Return
			tinyMCEPopup.close();
		}
	};
	
	tinyMCEPopup.onInit.add(ButtonDialog.init, ButtonDialog);
	
	
</script>
	
</head>
<body>
<div class="bootstrap-wpadmin">

	
	<div class="lambda-opttitle">
		<div class="lambda-opttitle-pad"><?php _e('available Sliders', 'claymore' ); ?></div>
	</div>

	<div class="lambda-settings-pad">

	<form id="lambdaform">
	   <p>
			<select id="sliderselect">
			<option value="lambda_slider_options">Select Slider...</option>
			<?php 
			global $wpdb;
			$table_name = $wpdb->base_prefix . "lambda_sliders"; 
			$slidedata = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id");
			foreach ($slidedata as $singledata) { 

			   if($singledata->slidertype != 'supersized')
			   echo "<option value='".$singledata->id."' name='".$singledata->option_name."'>".$singledata->option_name."</option>";
			   
			}
			?>
			</select>
		</p>
	</form>
	
	</div>

	<p>
		<a href="javascript:ButtonDialog.insert(ButtonDialog.local_ed)" class="btn btn-success">Insert Slider</a>
	</p>

</div>
</body>
</html>
