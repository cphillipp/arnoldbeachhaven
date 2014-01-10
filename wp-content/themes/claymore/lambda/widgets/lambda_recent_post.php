<?php 

/**
 * Recent Posts Widget 
 *
 * lambda framework v 2.1
 * by www.unitedthemes.com
 * since Passion 1.0
 */
 
class WP_Widget_Recent_Posts_Avatar extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'lambda_widget_recent_posts', 'description' => __( "The most recent posts with on your site with postformats", 'claymore') );
		parent::__construct('lw_recent-posts', __('Lambda - Recent Posts', 'claymore'), $widget_ops);
		$this->alt_option_name = 'lambda_widget_recent_posts';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance) {
		$cache = wp_cache_get('widget_recent_posts_avatar', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts', 'claymore') : $instance['title'], $instance, $this->id_base);
		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
 			$number = 10;

		$r = new WP_Query(array('posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true));
		if ($r->have_posts()) :
?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; 
		
		
		?>
		<ul>
		<?php  while ($r->have_posts()) : $r->the_post(); ?>
		<li class="clearfix">
        
        <?php 
			
			//get post formats
			$post_format = get_post_format( get_the_ID() ); 
			if(!$post_format)
				$post_format = 'standard';

		?>
        
	  	<div class="pformat">
        	<a href="<?php the_permalink(); ?>" title="<?php printf(__('Permanent link to %s', 'claymore'), get_the_title()); ?>" class="post_format_<?php echo $post_format; ?>"></a>
        </div>
        
        <div class="pformat_entry">
        	<a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a><br />
			<span><?php echo get_the_date(); ?></span>
        </div>
        
		</li>
		<?php endwhile; ?>
		</ul>
		<?php echo $after_widget; ?>
		
		<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_recent_posts_avatar', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_recent_entries']) )
			delete_option('widget_recent_entries');

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('widget_recent_posts_avatar', 'widget');
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$number = isset($instance['number']) ? absint($instance['number']) : 5;
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'claymore'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:', 'claymore'); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
<?php
	}
}
add_action( 'widgets_init', create_function( '', 'return register_widget("WP_Widget_Recent_Posts_Avatar");' ) );
?>