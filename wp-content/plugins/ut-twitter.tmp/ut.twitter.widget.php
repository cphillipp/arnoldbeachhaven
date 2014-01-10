<?php

/*
 * UT Twitter Widget 
 * by www.unitedthemes.com
 */

class WP_UT_Widget_Twitter extends WP_Widget {
	
	protected $slug = 'ut_twitter';
	
    function __construct() {
		$widget_ops = array('classname' => 'ut_widget_twitter', 'description' => __( 'Displays simple Twitter tweets', 'ut_lang') );
		parent::__construct('lw_ut_twitter', __('UnitedThemes - Twitter', 'ut_lang'), $widget_ops);
		$this->alt_option_name = 'ut_widget_twitter';

	}

    function form($instance) {
	
	if ( $instance ) {
	    
		$title = esc_attr( $instance['title'] );
				
	    $twitter_count = esc_attr($instance['count']);
	    $twitter_count = is_int($twitter_count) && (!$twitter_count) ? "5" : $twitter_count;		

	} ?>

	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ut_lang'); ?>
	    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo isset($title) ? $title : ''; ?>" />
	</label>
	<p class="description"><?php _e('The widgets title.', 'ut_lang' ); ?></p>
	
	<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Count:', 'ut_lang'); ?>
	    <input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo isset($twitter_count) ? $twitter_count : ''; ?>" />
	</label>
	<p class="description"><?php _e('How many tweets to display.', 'ut_lang' ); ?></p>

	<?php
    }

    function update($new_instance, $old_instance) {
        return $new_instance;
    }

    function widget( $args, $instance ) {
        
        $twitter_options = ( is_array( get_option('ut_twitter_options') ) ) ? get_option('ut_twitter_options') : array();
        
		
		if ( ! function_exists( 'twitterify' ) ) :
		
			function twitterify($ret) {
				$ret = preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t< ]*)#", "\\1<a href=\"\\2\" target=\"_blank\">\\2</a>", $ret);
				$ret = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r< ]*)#", "\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>", $ret);
				$ret = preg_replace("/@(\w+)/", "<a href=\"http://www.twitter.com/\\1\" target=\"_blank\">@\\1</a>", $ret);
				$ret = preg_replace("/#(\w+)/", "<a href=\"http://search.twitter.com/search?q=\\1\" target=\"_blank\">#\\1</a>", $ret);
				return $ret;
			}
		
		endif;		
		
        if ( ! function_exists( 'twitterTimeAgo' ) ) :
        
			function twitterTimeAgo($oldTime, $newTime) {
				 
				$timeCalc = $newTime - $oldTime;
				
				if ( $timeCalc > (60*60*24) ) { $timeCalc = round($timeCalc/60/60/24) . __(" days ago" , 'ut_lang' ); }
				else if ( $timeCalc > (60*60) ) { $timeCalc = round($timeCalc/60/60) . __(" hours ago" , 'ut_lang' ); }
				else if ( $timeCalc > 60 ) { $timeCalc = round($timeCalc/60) . __(" minutes ago" , 'ut_lang' ); }
				else if ( $timeCalc > 0 ) { $timeCalc .= __(" seconds ago" , 'ut_lang' ); }
				
				return $timeCalc;
			}
        
        endif;  
        
		 
        extract( $args ); extract( $instance );
        
        $title = apply_filters( $this->slug, $title );
        
        if(empty($count) )
        $count = 3;	
        
        /** Set access tokens here - see: https://dev.twitter.com/apps/ **/
        $settings = array(
            'oauth_access_token' => $twitter_options['oauth_access_token'],
            'oauth_access_token_secret' => $twitter_options['oauth_access_token_secret'],
            'consumer_key' => $twitter_options['consumer_key'],
            'consumer_secret' => $twitter_options['consumer_secret']
        );
        
		if( empty($twitter_options['oauth_access_token']) || empty($twitter_options['oauth_access_token_secret']) || empty($twitter_options['consumer_key']) || empty($twitter_options['consumer_secret']) ) {
		
			_e( 'Please make sure you have entered all necessary Twitter API Keys under Dashboard -> Settings -> Twitter' , 'ut_lang');
		
		} else {		
		                                
        $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
        $getfield = '?count='.$count;
        $requestMethod = 'GET';
        
        $twitter = new TwitterAPIExchange($settings);
        $tweets = $twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest();
        $tweets = json_decode( $tweets );
                        
        # generate tweet list        
        $our_tweets = '<ul class="tweet_list">';
        
        foreach($tweets as $tweet) {
            			
            $tweetdate = new DateTime($tweet->created_at);
            $tweetdate = strtotime($tweetdate->format('Y-m-d H:i:s'));
            $currentdate = strtotime(date('Y-m-d H:i:s'));  
            $days = twitterTimeAgo($tweetdate , $currentdate);
                       
            $our_tweets .= '<li class="tweet_first tweet_odd"><div>';
                $our_tweets .= '<span class="tweet_join"></span>'; 
                $our_tweets .= '<span class="tweet_text">'.twitterify($tweet->text).'</span>';
                $our_tweets .= '<span class="tweet_time"><a href="http://twitter.com/'.$tweet->user->screen_name.'/status/'.$tweet->id.'">'.__('about', 'ut_lang').' '.$timedifference.' '.$days.'</a></span>';
            $our_tweets .= '</div></li>';           
        
        }
        
        $our_tweets .= '</ul>';
        
        //fallback
        $text_url = (isset($text_url)) ? $text_url  : '';
        $text_loading = (isset($text_loading)) ? esc_attr($text_loading) : 'loading tweets...';
        $title = (isset($title)) ? $before_title.do_shortcode($title).$after_title  : '';
        
    
        echo "
        $before_widget
            $title
            $our_tweets
        $after_widget";
		
		}
    
	}

}

add_action( 'widgets_init', create_function( '', 'return register_widget("WP_UT_Widget_Twitter");' ) );

?>