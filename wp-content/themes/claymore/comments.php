<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'claymore');?></p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->
<div id="comments">
<?php if ( have_comments() ) : ?>

	
	
	<h3 class="response">	
	<?php printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'claymore' ),
			number_format_i18n( get_comments_number() ), '<span>&quot;'.get_the_title().'&quot;</span>' );?>
	
	</h3>

	
	<ul class="commentlist">
	<?php wp_list_comments("callback=st_comments"); ?>
	</ul>

	<!-- comments navigation disabled
	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>
	-->
    
<?php else : // this is displayed if there are no comments so far ?>

	
<?php endif; ?>

</div>
<?php if ( comments_open() ) : ?>

<div id="respond">

<?php 

comment_form(); 

?>

</div>

<?php endif; // if you delete this the sky will fall on your head ?>
