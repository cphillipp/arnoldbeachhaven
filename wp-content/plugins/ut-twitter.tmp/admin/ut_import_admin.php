<div class="wrap"> 
     
     <?php echo "<h2>" . __( 'UT Twitter' , UT_TWITTER_LANG ) . "</h2>"; ?>  
     
     <form method="post" action="options.php"> 
     
        <?php wp_nonce_field('update-options'); ?>
        <?php settings_fields('ut_twitter_options_group'); ?>
         
        
        <?php $twitter_options = ( is_array( get_option('ut_twitter_options') ) ) ? get_option('ut_twitter_options') : array(); ?> 
 
        <h3><?php _e("Settings (OAuth)" , UT_TWITTER_LANG ); ?></h3>
        
        <p>Please go to <a href="https://dev.twitter.com/apps">Twitter Developer Apps</a> and create a new APP for your Website. Make sure the the Request Type has been set to "GET" inside the "OAuth Tool" tab. Learn more about the new Twitter API here <a href="https://dev.twitter.com/docs/auth/oauth/faq">OAuth FAQ</a> and here <a href="https://dev.twitter.com/">Twitter Developer</a></p>
        
        <table class="form-table">
            <tbody>

                <tr valign="top">
                    <th scope="row"><label for="ut_twitter_options[consumer_key]"><?php _e("Consumer Key: " , UT_TWITTER_LANG ); ?></label></th>
                    <td>
                        <input type="text" name="ut_twitter_options[consumer_key]" value="<?php echo (isset($twitter_options['consumer_key'])) ? $twitter_options['consumer_key'] : '' ; ?>" size="40">
                    </td>
                </tr>
                
                <tr valign="top">
                    <th scope="row"><label for="ut_twitter_options[consumer_secret]"><?php _e("Consumer Secret Key: " , UT_TWITTER_LANG ); ?></label></th>
                    <td>
                        <input type="text" name="ut_twitter_options[consumer_secret]" value="<?php echo (isset($twitter_options['consumer_secret'])) ? $twitter_options['consumer_secret'] : '' ; ?>" size="40">
                    </td>
                </tr>
                
                <tr valign="top">
                    <th scope="row"><label for="ut_twitter_options[oauth_access_token]"><?php _e("Access token: " , UT_TWITTER_LANG ); ?></label></th>
                    <td>
                        <input type="text" name="ut_twitter_options[oauth_access_token]" value="<?php echo (isset($twitter_options['oauth_access_token'])) ? $twitter_options['oauth_access_token'] : '' ; ?>" size="40">
                    </td>
                </tr>
                
                <tr valign="top">
                    <th scope="row"><label for="ut_twitter_options[oauth_access_token_secret]"><?php _e("Access token secret: " , UT_TWITTER_LANG ); ?></label></th>
                    <td>
                        <input type="text" name="ut_twitter_options[oauth_access_token_secret]" value="<?php echo (isset($twitter_options['oauth_access_token_secret'])) ? $twitter_options['oauth_access_token_secret'] : '' ; ?>" size="40">
                    </td>
                </tr>
                
            </tbody>
        </table>    
        
        <input type="hidden" name="action" value="update" />
	    <input type="hidden" name="page_options" value="ut_twitter_options" />
	    <p class="submit"><input type="submit" class="button button-primary" value="<?php _e('Save Settings', UT_THEME_NAME) ?>" /></p>
        
        
     </form>  
</div>