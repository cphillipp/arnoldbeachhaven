<?php

/*
 * Like Widget 
 * lambda framework v 2.1
 * by www.unitedthemes.com
 * since framework v 2.0
 */

class MostLikedPostsWidget extends WP_Widget
{
     function MostLikedPostsWidget()
     {
		 $widget_ops = array('classname' => 'lambda_widget_mostlikesposts', 'description' => __('Widget to display most liked posts for a given time range.', 'claymore'));
         parent::__construct('lw_mostlikesposts', __('Lambda - Most Liked Posts', 'claymore'), $widget_ops);
		 $this->alt_option_name = 'lambda_widget_mostlikesposts';
		  
     }

     function widget($args, $instance) {
          global $MostLikedPosts;
          $MostLikedPosts->widget($args, $instance); 
     }
    
     function update($new_instance, $old_instance) {         
          if($new_instance['title'] == ''){
               $new_instance['title'] = __('Most Liked Posts', 'claymore');
          }
         		
		if($new_instance['time_range'] == ''){
               $new_instance['time_range'] = 'all';
          }
		
          return $new_instance;
     }
    
     function form($instance)
     {
        global $MostLikedPosts;
		$time_range_array = array(
							'all' => __('All time', 'claymore'),
							'1' => __('Last one day', 'claymore'),
							'2' => __('Last two days', 'claymore'),
							'3' => __('Last three days', 'claymore'),
							'7' => __('Last one week', 'claymore'),
							'14' => __('Last two weeks', 'claymore'),
							'21' => __('Last three weeks', 'claymore'),
							'1m' => __('Last one month', 'claymore'),
							'2m' => __('Last two months', 'claymore'),
							'3m' => __('Last three months', 'claymore'),
							'6m' => __('Last six months', 'claymore'),
							'1y' => __('Last one year', 'claymore')
						);
		
		$show_types = array('most_liked' => __('Most Liked', 'claymore'), 'recent_liked' => __('Recently Liked', 'claymore'));
          ?>
		<p>
               <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'claymore'); ?>:<br />
               <input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title'];?>" /></label>
          </p>		
		<p>
               <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show', 'claymore'); ?>:<br />
               <input type="text" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" style="width: 25px;" value="<?php echo $instance['number'];?>" /></label>
          </p>
		<p>
               <label for="<?php echo $this->get_field_id('time_range'); ?>"><?php _e('Time range', 'claymore'); ?>:<br />
			<select name="<?php echo $this->get_field_name('time_range'); ?>" id="<?php echo $this->get_field_id('time_range'); ?>">
			<?php
			foreach($time_range_array as $time_range_key => $time_range_value) {
				$selected = ($time_range_key == $instance['time_range']) ? 'selected' : '';
				echo '<option value="' . $time_range_key . '" ' . $selected . '>' . $time_range_value . '</option>';
			}
			?>
			</select>
          </p>
		<p>
               <label for="<?php echo $this->get_field_id('show_count'); ?>"><input type="checkbox" id="<?php echo $this->get_field_id('show_count'); ?>" name="<?php echo $this->get_field_name('show_count'); ?>" value="1" <?php if($instance['show_count'] == '1') echo 'checked="checked"'; ?> /> <?php _e('Show like count', 'claymore'); ?></label>
          </p>
		<input type="hidden" id="lambda-most-submit" name="lambda-submit" value="1" />	   
        <?php
     }
}

class MostLikedPosts
{
     function MostLikedPosts(){
          add_action( 'widgets_init', array(&$this, 'init') );
     }
    
     function init(){
          register_widget("MostLikedPostsWidget");
     }
     
     function widget($args, $instance = array() ){
		global $wpdb;
		extract($args);
	    
		$where = '';
		
		$title = $instance['title'];
		$show_count = $instance['show_count'];
		$time_range = $instance['time_range'];
		
		if((int)$instance['number'] > 0) {
			$limit = "LIMIT " . (int)$instance['number'];
		}
		
		$widget_data  = $before_widget;
		$widget_data .= $before_title . $title . $after_title;
		$widget_data .= '<ul class="lambda-most-liked-posts">';

		
		if($time_range != 'all') {
			$last_date = GetLambdaLastDate($time_range);
			$where .= " AND date_time >= '$last_date'";
		}
				
		$posts = LambdaMostLikeQuery($limit, $where);
		


		if(count($posts) > 0) {
			foreach ($posts as $post) {
				$post_title = stripslashes($post->post_title);
				$permalink = get_permalink($post->post_id);
				$like_count = $post->like_count;
				
				$widget_data .= '<li><a href="' . $permalink . '" title="' . $post_title.'" rel="nofollow">' . lambda_translate_meta($post_title) . '</a>';
				$widget_data .= $show_count == '1' ? ' ('.$like_count.')' : '';
				$widget_data .= '</li>';
			}
		} else {
			$widget_data .= '<li>';
			$widget_data .= __('No posts liked yet.', 'claymore');
			$widget_data .= '</li>';
		}
   
		$widget_data .= '</ul>';
		$widget_data .= $after_widget;
   
		echo $widget_data;
     }
}

$MostLikedPosts = new MostLikedPosts();
?>
