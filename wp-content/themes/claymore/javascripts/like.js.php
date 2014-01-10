<?php 

if ( !function_exists( 'lambda_like_js' ) ) {

	function lambda_like_js() { ?>
    	
        <script type="text/javascript">
        
		(function($){ 
            
            $(document).ready(function(){
            
                $(".like_it").click(function(){
                      
                      var post_id = jQuery(this).attr("id");
                      post_id = post_id.replace("like-", "");
                                
                      $.ajax({
                           type: "POST",
                           url:  "<?php echo THEME_WEB_ROOT.'/functions/ajax-request.php'; ?>",
                           data: "post_id=" + post_id + "&num=" + Math.random(),
                           success: function(data){
                                jQuery("#liked-" + post_id).html(data.like);
                                jQuery("#like-" + post_id).find('span').removeClass('lambda-unlike').addClass('lambda-like');
                           },
                           dataType: "json"
                      });
                 });
             
             });	 
             
        })(jQuery);
		
        </script>
        
	<?php  }
	
	add_action('wp_footer', 'lambda_like_js');
}

?>