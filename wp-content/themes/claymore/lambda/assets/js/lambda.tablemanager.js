/* ------------------------------------------------
	Lambda Framework 2.0
	by unitedthemes.com
	author: Matthias Nettekoven
	------------------------------------------------ */
	
jQuery(document).ready(function($) { 

	/* ------------------------------------------------
	html string builder
	------------------------------------------------ */
	buildHTML = function(tag, html, attrs, id) {
		if (typeof(html) != 'string') {
			attrs = html;
			html = null;
		}
		
		var h = '<' + tag;
		for (attr in attrs) {
			if(attrs[attr] === false) continue;
			h += ' ' + attr + '="' + attrs[attr] + '"';
		}
		return h += html ? ">" + html + "</" + tag + ">" : "/>";
	}
	
	/* ------------------------------------------------
	Radio Buttons
	------------------------------------------------ */
    $(".radio_active").click(function(){
		var radio = $(this).attr('value');
		var parent = $(this).parent('.btn-group');

		$('.radiostate_inactive', parent).attr('checked', false);
        $('#'+radio).attr('checked', true);
		
    });
		
    $(".radio_inactive").click(function(){
		var radio = $(this).attr('value');
		var parent = $(this).parent('.btn-group');
		
		$('.radiostate_active', parent).attr('checked', false);
        $('#'+radio).attr('checked', true);
	});	
	
	/* ------------------------------------------------
	lets find the latest ID
	------------------------------------------------ */
	var total_columns = 0;
	var latest_feat_id = 0;
	
	$(".column_item").each(function() {
		var id = parseInt( this.id.split('_')[2], 10 );
		
		if( id >= total_columns)
		latest_id = id + 1;
			
	});
	
	/* ------------------------------------------------
	remove feature
	------------------------------------------------ */
	$(".remove-feature").live("click", function() {
		$(this).parent().remove();
	});
	
	
	$( ".add_column_feature").live('click', function() {
		
		featuregroup = $(this).attr('value');
		key = $(this).data('key');
		table = $(this).data('table');
		group = $(this).data('group');
					
		$('#'+featuregroup+' > div > input').each(function() {
									
			var id = parseInt( this.id.split('_')[1], 10 );
									
			if( id >= latest_feat_id)
			latest_feat_id = id + 1;
			
		});
				
		$('#'+featuregroup).append('<div class="feature_item"><input style="width:115px !important; min-width: inherit !important;" class="feature" id="feature_'+latest_feat_id+'" type="text" name="'+group+'['+table+'][columns]['+key+'][column_content]['+latest_feat_id+']" value="" /><br /><button type="button" class="btn btn-mini btn-danger remove-feature"><i class="icon-remove icon-white"></i></button></div>');
	
	});
	
	

});