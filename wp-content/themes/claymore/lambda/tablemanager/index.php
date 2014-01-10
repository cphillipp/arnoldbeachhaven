<?php if (!defined('OT_VERSION')) exit('No direct script access allowed');

/*
 * basic table manager
 * lambda framework v 2.1
 * by www.unitedthemes.com
 * since framework v 2.0
 */

global $wpdb;

include_once ('lambda.table.class.php');
include_once ( THEME_DOCUMENT_ROOT  . '/functions/theme-sanitize.php' );

#-----------------------------------------------------------------
# Get table prefix
#-----------------------------------------------------------------
if ( !function_exists( 'lambda_get_table_prefix' ) ) {
	function lambda_get_table_prefix(){
		
		global $blog_id, $wpdb;
			
		if($blog_id != 1 && is_multisite() ){
			$table_prefix = $wpdb->base_prefix . $blog_id."_";
		} else {
			$table_prefix = $wpdb->base_prefix;
		}
		
		return( $table_prefix );
		
	}
}

#-----------------------------------------------------------------
# Update Table System
#-----------------------------------------------------------------
if ( !function_exists( 'lambda_update_tablesystem' ) ) {
	function lambda_update_tablesystem(){
		
		global $wpdb;
		
		$table_prefix = lambda_get_table_prefix();
		$table_lambda_tables = $table_prefix . "lambda_tables"; 

		
		$needsupdate = $wpdb->get_var( 
		
			"SHOW COLUMNS FROM $table_lambda_tables LIKE 'table_content'"
		
		 );
		
		if( empty( $needsupdate ) ) {
						
			$wpdb->query( 
			
				"ALTER TABLE $table_lambda_tables ADD COLUMN table_content TEXT NOT NULL AFTER table_name" 
						
			 );
			
		}
	}
}

#-----------------------------------------------------------------
# additional scripts
#-----------------------------------------------------------------
function lambda_table_admin_add_scripts() {
 	
	wp_register_script ('bootstrap', THEME_WEB_ROOT.'/lambda/assets/js/bootstrap.js', array('jquery'), '2.0.3' , true);
    wp_enqueue_script  ('bootstrap' );
	
	wp_register_script ('tablemanager', THEME_WEB_ROOT.'/lambda/assets/js/lambda.tablemanager.js', array('jquery'), '1.0' , true);
    wp_enqueue_script  ('tablemanager' );
	
}

#-----------------------------------------------------------------
# additional styles
#-----------------------------------------------------------------
function lambda_table_admin_add_styles() {
    	
	wp_register_style('standard-css', THEME_WEB_ROOT.'/lambda/assets/css/lambda.ui.css');
    wp_enqueue_style( 'standard-css');
				
}

#-----------------------------------------------------------------
# Only load Scripts&Styles when needed
#-----------------------------------------------------------------
if ( isset($_GET['page']) && $_GET['page'] == 'view_tables' ) {	
	add_action('admin_print_styles', 'lambda_table_admin_add_styles');
	add_action('admin_init', 'lambda_table_admin_add_scripts');

}


#-----------------------------------------------------------------
# General Output
#-----------------------------------------------------------------
function lambda_table_admin_page() {

	echo '<div id="lambda_framework_wrap">';
	
	//Show Tableoverview
	if ((isset($_GET['page']) && $_GET['page'] == 'view_tables') && !isset($_GET['edit']) ) {
		lambda_table_overview();
	}
	
	//Show Table Edit Page
	if ((isset($_GET['page']) && $_GET['page'] == 'view_tables') && isset($_GET['edit']) ) {
		lambda_table_edit();	
	}
	
	echo '</div>';

}


#-----------------------------------------------------------------
# Table Overview - Table Block - will automatically
#-----------------------------------------------------------------
function lambda_table_overview() { ?>

<div id="lambda-option-panel" class="bootstrap-wpadmin">
<div id="content_wrap" class="well form-horizontal">


<div id="lambda-options-panel-title">
	  	
	<h1><?php echo _e('Manage your Tables', 'claymore')?></h1>
	<div class="clear"></div>
		
</div>

<table cellspacing="0" class="table table-striped table-bordered table-condensed">
		<thead>
			<tr>
				<th scope="col" id="name" colspan="7">
				
				<?php _e('List of created Tables', 'claymore')?>
								
				</th>
			</tr>
            <tr>
            	<td> <?php _e('ID', 'claymore'); ?> </td>
            	<td> <?php _e('Table Name', 'claymore'); ?> </td>
				<td> <?php _e('Shortcode', 'claymore'); ?> </td>
            	<td> <?php _e('Edit', 'claymore'); ?> </td>
            	<td> <?php _e('Delete', 'claymore'); ?> </td>
            </tr>
			</thead>
			<tbody>
            <?php lambda_table_view(); ?>
            
</table>
</div>
</div>

<?php
} // End Main Table Function


#-----------------------------------------------------------------
# Display all existing Tables
#-----------------------------------------------------------------
function lambda_table_view() {
    
	//globals
	global $wpdb, $tm_message;
	
	//internal counter
	$num=1;
	
	$table_prefix = lambda_get_table_prefix();
		
	$table_lambda_tables = $table_prefix . "lambda_tables"; 	
    $lambda_table_data = $wpdb->get_results("SELECT * FROM $table_lambda_tables ORDER BY id");
	
	lambda_update_tablesystem();
	
	
	if(is_array($lambda_table_data) && !empty($lambda_table_data)) {
    foreach ($lambda_table_data as $data) { 
        
      echo '<tr>
	   			<td>
					'.$data->id.'
				</td>
				<td>
					'.$data->table_name.'
				</td>
				<td>
					[lambdatable id="'.$data->id.'"]
				</td>				
	   			<td>
					<button type="button" onClick="location=\'?page=view_tables&edit='.$data->table_name.'\'" class="btn btn-mini btn-primary"><i class="icon-edit icon-white"></i></button>        
       			</td>
       			<td>
					<button onClick="location=\'?page=view_tables&delete='.$data->table_name.'\'" class="btn btn-mini btn-danger"><i class="icon-remove icon-white"></i></button>
				</td>
			</tr>';       
	   $num++;
	   
	   } }
	
       ?>
      
	   
       <tr>
		   <td>
				<?php echo ($data->id+1); ?>
		   </td>
		   <td colspan="6">
		   		<form method="post" action="?page=view_tables&add=table" class="form-horizontal">
				
				
				<label class="control-label"><?php _e('Enter Table Name', 'claymore'); ?></label>
				
				<div class="controls">
				<input type="text" id="table_name" class="lambda_input" name="table_name" size="70" placeholder="<?php _e('Table Name', 'claymore'); ?>" /><br />
				</div>
				
				<button type="submit" class="btn btn-success" value="<?php _e('Add new Table', 'claymore'); ?>" /><i class="icon-plus icon-white"></i></button>
				
				<br />
				
				<span class="info"><?php _e('* Do not use spaces or special characters in the name. This Name is only for internal use!', 'claymore'); ?></span>

				</form>
		   </td>
       </tr>
	   </tbody>
			<tfoot>
			
			<?php if($tm_message) : ?>
			<tr>
				<th scope="col" colspan="7">
					<?php echo '<div class="alert alert-block" id="message"><p><strong>'.$tm_message.'</strong></p></div></div>'; ?>
				</th>
			</tr>	
			<?php endif; ?>
			
	   </tfoot>
       
	   
       <?php
}

#-----------------------------------------------------------------
# Add Table Item
#-----------------------------------------------------------------
if ( isset($_GET['add']) && $_GET['add'] == 'table' ) {	
    
	
	$table_prefix = lambda_get_table_prefix();
	$table_lambda_tables = $table_prefix . "lambda_tables";
	
	$table_name = sanitize_text_field( $_POST['table_name'] );
	
	
	$table_exists = $wpdb->get_var(
		
			"SELECT * from $table_lambda_tables WHERE table_name = '$table_name'"
		
	);
	
	if( $table_exists ) {
		
		$tm_message = __( 'Table already exists' , 'claymore' );
		
	} else {
		
		$data = array(
		
			'table_name' 	=> $table_name, 
			'table_content' => '' 
		
		);		
		
		$wpdb->insert( $table_lambda_tables , $data );
		$tm_message = __( 'Table successfully added' , 'claymore' );
		
	}
	
		
}

#-----------------------------------------------------------------
# Delete Table Item
#-----------------------------------------------------------------
if ( isset($_GET['delete']) ) {	
   
	$option = $_GET['delete'];
	delete_option($option);
    
	$table_prefix = lambda_get_table_prefix();
		
	$table_lambda_tables = $table_prefix . "lambda_tables"; 
    $sql = "DELETE FROM " . $table_lambda_tables . " WHERE table_name='".$option."';";
		$wpdb->query( $sql );
		
	$tm_message = __('Table deleted', 'claymore');
}


#-----------------------------------------------------------------
# Save Table Item
#-----------------------------------------------------------------
if ( isset($_POST['action']) && $_POST['action'] == 'table_update') {	   
    
	$table_name = sanitize_text_field( $_POST['page_options'] );
	$table_content = lambda_prepare_save( $_POST['lambda_table_content'] );
	
	$table_prefix = lambda_get_table_prefix();
	$table_lambda_tables = $table_prefix . "lambda_tables";
		
	$wpdb->update( 
	
			$table_lambda_tables,
			array( 'table_content' => $table_content ),
			array( 'table_name' => $table_name ),
			array( '%s')	
	
	);
			
}


#-----------------------------------------------------------------
# Table Item Edit Section
#-----------------------------------------------------------------
function lambda_table_edit() { ?>
	
    <div id="lambda-option-panel" class="bootstrap-wpadmin option-tables">
	<form method="post" class="well form-inline" >   
    
	<?php global $wpdb; $tablename = $table = $_GET['edit']; ?>	
	
	<div class="lambda-opttitle">
            <div class="lambda-opttitle-pad settingstitle">
                <h1><?php echo _e('Table Manager', 'claymore')?></h1>
                
				<input type="hidden" name="action" value="table_update" />
				<input type="hidden" name="page_options" value="<?php echo $tablename; ?>" />
				<input type="submit" class="lambda_save btn btn-success right" value="<?php _e('Save Settings', 'claymore') ?>" />
				
                <div class="clear"></div>				
       		</div>
    </div>
	
	<div id="table-items" class="tab-pane">
				
		<div id="single-columns">
				
			<?php 
			
			$table_prefix = lambda_get_table_prefix();
			$table_lambda_tables = $table_prefix . "lambda_tables";
									
			// get table data from database
			$table_content = $wpdb->get_var( "SELECT table_content FROM $table_lambda_tables WHERE table_name = '$tablename'" );
			$table_content = lambda_prepare_load($table_content);			
						
			// old system variable
			$options = get_option( $tablename );
							
			// fallback to old system and default values
			if ( !empty( $table_content[$tablename]['columns']) ) {
				
				$newsystem = true;
				$table_content = $table_content[$tablename]['columns'];
				
			} elseif(  !empty($options['columns']) ) {
				
				$oldsystem = true;				
				$table_content = $options['columns'];
				
			} else {
				
				$table_content = lambda_table_item_array();
								
			}
	
			foreach ($table_content as $key => $value ) { ?>
							
			<div id="lambda_<?php echo $tablename.'_'.$key; ?>" class="column_item">
						
			<label for="column_<?php echo $tablename.'_'.$key; ?>"><?php _e('Activate Column?', 'claymore'); ?></label><br />
			
			<div class="lambda_row">
				
				<div class="btn-group" data-toggle="buttons-radio">
				
				<button value="<?php echo $tablename.'_'.$key; ?>_on" type="button" class="btn btn-mini btn-info <?php echo ($value['column_active'] == 'on') ? 'active' : 'inactive'; ?> radio_<?php echo ($value['column_active'] == 'on') ? 'active' : 'inactive'; ?>"><?php _e('on', 'claymore'); ?></button>				
				<button value="<?php echo $tablename.'_'.$key; ?>_off" type="button" class="btn btn-mini btn-info <?php echo ($value['column_active'] == 'off') ? 'active' : 'inactive'; ?> radio_<?php echo ($value['column_active'] == 'off') ? 'active' : 'inactive'; ?>"><?php _e('off', 'claymore'); ?></button>
				
				<input class="radiostate_<?php echo ($value['column_active'] == 'on') ? 'active' : 'inactive'; ?>" style="display:none;" id="<?php echo $tablename.'_'.$key; ?>_on" type="radio" name="lambda_table_content[<?php echo $tablename; ?>][columns][<?php echo $key; ?>][column_active]" value="on" <?php echo ($value['column_active'] == 'on') ? 'checked="checked"' : ''; ?> /><br />
				<input class="radiostate_<?php echo ($value['column_active'] == 'off') ? 'active' : 'inactive'; ?>" style="display:none;" id="<?php echo $tablename.'_'.$key; ?>_off" type="radio" name="lambda_table_content[<?php echo $tablename; ?>][columns][<?php echo $key; ?>][column_active]" value="off" <?php echo ($value['column_active'] == 'off') ? 'checked="checked"' : ''; ?> /><br />
				
				</div>
				
			</div>
			
			<hr />
			
			<label for="column_<?php echo $tablename.'_'.$key; ?>"><?php _e('Column is featured?', 'claymore'); ?></label><br />
			
			<div class="lambda_row">
				
				<div class="btn-group" data-toggle="buttons-radio">
				
				<button value="<?php echo $tablename.'_'.$key; ?>_yes" type="button" class="btn btn-mini btn-info <?php echo ($value['featured'] == 'yes') ? 'active' : 'inactive'; ?> radio_<?php echo ($value['featured'] == 'yes') ? 'active' : 'inactive'; ?>"><?php _e('yes', 'claymore'); ?></button>				
				<button value="<?php echo $tablename.'_'.$key; ?>_no" type="button" class="btn btn-mini btn-info <?php echo ($value['featured'] == 'no') ? 'active' : 'inactive'; ?> radio_<?php echo ($value['featured'] == 'no') ? 'active' : 'inactive'; ?>"><?php _e('no', 'claymore'); ?></button>
				
				<input class="radiostate_<?php echo ($value['featured'] == 'yes') ? 'active' : 'inactive'; ?>" style="display:none;" id="<?php echo $tablename.'_'.$key; ?>_yes" type="radio" name="lambda_table_content[<?php echo $tablename; ?>][columns][<?php echo $key; ?>][featured]" value="yes" <?php echo ($value['featured'] == 'yes') ? 'checked="checked"' : ''; ?> /><br />
				<input class="radiostate_<?php echo ($value['featured'] == 'no') ? 'active' : 'inactive'; ?>" style="display:none;" id="<?php echo $tablename.'_'.$key; ?>_no" type="radio" name="lambda_table_content[<?php echo $tablename; ?>][columns][<?php echo $key; ?>][featured]" value="no" <?php echo ($value['featured'] == 'no') ? 'checked="checked"' : ''; ?> /><br />
				
				</div>
				
			</div>	
			
			<hr />
						
			<label><?php _e('Column Headline', 'claymore'); ?></label><br />
			<input style="width:148px !important; min-width: inherit !important;" id="<?php echo $tablename.'_'.$key; ?>" type="text" name="lambda_table_content[<?php echo $tablename; ?>][columns][<?php echo $key; ?>][column_head]" value="<?php echo $value['column_head']; ?>" /><br />
			
			<hr />
			
			<label><?php _e('Column Price', 'claymore'); ?></label><br />
			<input style="width:148px !important; min-width: inherit !important;" id="<?php echo $tablename.'_'.$key; ?>" type="text" name="lambda_table_content[<?php echo $tablename; ?>][columns][<?php echo $key; ?>][column_price]" value="<?php echo $value['column_price']; ?>" /><br />
			
			<hr />
			
			<label><?php _e('Price Currency', 'claymore'); ?></label><br />
			<input style="width:148px !important; min-width: inherit !important;" id="<?php echo $tablename.'_'.$key; ?>" type="text" name="lambda_table_content[<?php echo $tablename; ?>][columns][<?php echo $key; ?>][column_curr]" value="<?php echo $value['column_curr']; ?>" /><br />
			
			<hr />
			
			<label><?php _e('Period', 'claymore'); ?></label><br />
			<input style="width:148px !important; min-width: inherit !important;" id="<?php echo $tablename.'_'.$key; ?>" type="text" name="lambda_table_content[<?php echo $tablename; ?>][columns][<?php echo $key; ?>][column_time]" value="<?php echo $value['column_time']; ?>" /><br />
					
			<hr />
					
					<label><?php _e('Features', 'claymore'); ?></label><br />
					
					<div id="features_<?php echo $tablename.'_'.$key; ?>">
					
					<?php foreach($value['column_content'] as $x => $feature) { ?>
						
						<div class="feature_item">			
						<input style="width:115px !important; min-width: inherit !important;" class="feature" id="feature_<?php echo $x; ?>" type="text" name="lambda_table_content[<?php echo $tablename; ?>][columns][<?php echo $key; ?>][column_content][<?php echo $x; ?>]" value="<?php echo $value['column_content'][$x]; ?>" /><br />
						<button type="button" class="btn btn-mini btn-danger remove-feature"><i class="icon-remove icon-white"></i></button>
						</div>
							
					<?php } ?>
					
					</div>
					<button data-key="<?php echo $key; ?>" data-group="lambda_table_content" data-table="<?php echo $table; ?>" type="button" value="features_<?php echo $tablename.'_'.$key; ?>" class="add_column_feature right btn btn-mini btn-info" name="lambda_table_content[<?php echo $tablename; ?>]"><i class="icon-picture icon-white"></i> <?php _e('Add Row', 'claymore'); ?></button>
	
					<div class="clear"></div>
			
			
			<hr />
			
			<label><?php _e('Custom URL', 'claymore'); ?></label><br />
			<input style="width:148px !important; min-width: inherit !important;" id="<?php echo $tablename.'_'.$key; ?>" type="text" name="lambda_table_content[<?php echo $tablename; ?>][columns][<?php echo $key; ?>][column_url]" value="<?php echo $value['column_url']; ?>" /><br />
			
			<hr />
			
			<label><?php _e('Buttontext', 'claymore'); ?></label><br />
			<input style="width:148px !important; min-width: inherit !important;" id="<?php echo $tablename.'_'.$key; ?>" type="text" name="lambda_table_content[<?php echo $tablename; ?>][columns][<?php echo $key; ?>][column_buttontext]" value="<?php echo $value['column_buttontext']; ?>" /><br />
			
			
			<hr />
			
            	
				<?php if( $oldsystem ) :
					 
					 $content_output =  (isset($value['column_htmltext'])) ? $value['column_htmltext'] : '';
					 
					 else : 
					 
					 $content_output = (isset($value['column_htmltext'])) ? $value['column_htmltext'] : '';
					 
				endif; ?>            
            
			<label><?php _e('HTML Content', 'claymore'); ?></label><br />
			<textarea style="width:148px !important; min-width: inherit !important;" id="<?php echo $tablename.'_'.$key; ?>" name="lambda_table_content[<?php echo $tablename; ?>][columns][<?php echo $key; ?>][column_htmltext]"/><?php echo $content_output; ?></textarea><br />
			
			
			</div>			
			
			<?php } // endforeach ?>
			
		<div class="clear"></div>	
		</div><!-- /#single  columns -->
	
	</div><!-- /#table items -->
		
	</form>
	</div>
	
<?php }  ?>