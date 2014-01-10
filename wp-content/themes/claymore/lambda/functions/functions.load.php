<?php if (!defined('OT_VERSION')) exit('No direct script access allowed');
/**
 * Functions Load
 *
 * @package     WordPress
 * @subpackage  OptionTree
 * @since       1.0.0
 * @author      Derek Herman
 */
include( OT_PLUGIN_DIR . '/functions/functions.php' );
include( OT_PLUGIN_DIR . '/functions/get-option-tree.php' );
include( OT_PLUGIN_DIR . '/functions/webfonts.php' );

if ( is_admin() && isset( $_GET['page'] ) && strpos( '_' . $_GET['page'], 'option_tree' ) ) {
  include( OT_PLUGIN_DIR . '/functions/admin/export.php' );
  include( OT_PLUGIN_DIR . '/functions/admin/heading.php' );
  include( OT_PLUGIN_DIR . '/functions/admin/subheading.php' );
  include( OT_PLUGIN_DIR . '/functions/admin/color_scheme.php' );
  include( OT_PLUGIN_DIR . '/functions/admin/input.php' );
  include( OT_PLUGIN_DIR . '/functions/admin/client-media.php' );
  include( OT_PLUGIN_DIR . '/functions/admin/checkbox.php' );
  include( OT_PLUGIN_DIR . '/functions/admin/radio.php' );
  include( OT_PLUGIN_DIR . '/functions/admin/select.php' );
  include( OT_PLUGIN_DIR . '/functions/admin/easing.php' );
  include( OT_PLUGIN_DIR . '/functions/admin/image_hover.php' );
  include( OT_PLUGIN_DIR . '/functions/admin/image_effect.php' );
  include( OT_PLUGIN_DIR . '/functions/admin/select-sidebars.php' );
  include( OT_PLUGIN_DIR . '/functions/admin/select-backgroundslider.php' );
  include( OT_PLUGIN_DIR . '/functions/admin/textarea.php' );
  include( OT_PLUGIN_DIR . '/functions/admin/upload.php' );
  include( OT_PLUGIN_DIR . '/functions/admin/colorpicker.php' );
  include( OT_PLUGIN_DIR . '/functions/admin/colorpicker_rgb.php' );
  include( OT_PLUGIN_DIR . '/functions/admin/textblock.php' );
  include( OT_PLUGIN_DIR . '/functions/admin/post.php' );
  include( OT_PLUGIN_DIR . '/functions/admin/page.php' );
  include( OT_PLUGIN_DIR . '/functions/admin/category.php' );
  include( OT_PLUGIN_DIR . '/functions/admin/tag.php' );
  include( OT_PLUGIN_DIR . '/functions/admin/custom-post.php' );
  include( OT_PLUGIN_DIR . '/functions/admin/measurement.php' );
  include( OT_PLUGIN_DIR . '/functions/admin/slider.php' );
  include( OT_PLUGIN_DIR . '/functions/admin/social-media.php' );
  include( OT_PLUGIN_DIR . '/functions/admin/sidebar.php' );
  include( OT_PLUGIN_DIR . '/functions/admin/background.php' );
  include( OT_PLUGIN_DIR . '/functions/admin/background_pattern.php' );
  include( OT_PLUGIN_DIR . '/functions/admin/background_texture.php' );
  include( OT_PLUGIN_DIR . '/functions/admin/footer_background_pattern.php' );
  include( OT_PLUGIN_DIR . '/functions/admin/footer_background_texture.php' );
  include( OT_PLUGIN_DIR . '/functions/admin/typography.php' );
  include( OT_PLUGIN_DIR . '/functions/admin/typography_menu.php' );
  include( OT_PLUGIN_DIR . '/functions/admin/typography_headlines.php' );
  include( OT_PLUGIN_DIR . '/functions/admin/typography_google.php' );
  include( OT_PLUGIN_DIR . '/functions/admin/css.php' );
  include( OT_PLUGIN_DIR . '/functions/admin/js_group_open.php' );
  include( OT_PLUGIN_DIR . '/functions/admin/js_group_close.php' );
  include( OT_PLUGIN_DIR . '/functions/admin/fontmanager.php' );
}

