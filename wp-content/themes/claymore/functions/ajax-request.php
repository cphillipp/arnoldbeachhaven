<?php
#-----------------------------------------------------------------
# Lambda Ajax Request
#-----------------------------------------------------------------

//Split path to locate wordpress root!
$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];

require_once( $path_to_wp . '/wp-load.php' );

global $wpdb;

//get necessary data
$post_id = (int)$_POST['post_id'];
$ip = $_SERVER['REMOTE_ADDR'];

//get setting data
$is_logged_in = is_user_logged_in();
$login_required = get_option_tree('like_login_required');
$can_vote = false;

if($login_required == 'yes' && !$is_logged_in) {
	
	$error = 1;
	$msg = __('You need to be logged in to vote!', 'claymore');
	
	
} else {
	
	$has_already_voted = HasLambdaAlreadyVoted($post_id, $ip);
	//$has_already_voted = '';
	
	$datetime_now = date('Y-m-d H:i:s');
	
	if($has_already_voted) {
		$error = 1;
	} else {
		$can_vote = true;
	}
}

if($can_vote) {
	$current_user = wp_get_current_user();
	$user_id = (int)$current_user->ID;
	
		
	$query = ($has_already_voted) ?
		"UPDATE {$wpdb->base_prefix}lambda_like_post SET likeit = likeit + 1, date_time = '" . date('Y-m-d H:i:s') . "' WHERE post_id = '" . $post_id . "' AND ip = '$ip'" :
		"INSERT INTO {$wpdb->base_prefix}lambda_like_post SET post_id = '" . $post_id . "', likeit = '1', date_time = '" . date('Y-m-d H:i:s') . "', ip = '$ip'";
	
	$success = $wpdb->query($query);
	if($success) {
		
		$error = 0;
		$msg = __('Thanks for voting!', 'claymore');
	
	} else {
		
		$error = 1;
		$msg = __('Sorry, a technical error has occured. Please try again later', 'claymore');
	}
}

$options = get_option("lambda_most_liked_posts");
$number = $options['number'];
$show_count = $options['show_count'];

$lambda_like_count = GetLambdaLikeCount($post_id);
$result = array("msg" => $msg, "error" => $error, "like" => $lambda_like_count, "unlike" => $lambda_unlike_count);
echo json_encode($result);
?>