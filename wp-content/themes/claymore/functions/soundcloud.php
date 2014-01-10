<?php 
//Soundcloud
/*Version: 2.0
Author: Johannes Wagener <johannes@soundcloud.com>
Author URI: http://johannes.wagener.cc
add_shortcode( "soundcloud", "soundcloud_shortcode" );
enhanced by unitedthemes 
*/
add_shortcode( "soundcloud", "lambda_soundcloud_shortcode" );


function lambda_soundcloud_shortcode($attributes, $content=null) {
  return LambdaSoundcloudShortcode::parse($attributes, $content);
}

class LambdaSoundcloudShortcode {

  const IFRAME_HEIGHT           = '166';
  const IFRAME_TRACKLIST_HEIGHT = '450';
  const IFRAME_WIDTH            = '100%';

  const FLASH_HEIGHT            = '81';
  const FLASH_TRACKLIST_HEIGHT  = '255';
  const FLASH_WIDTH             = '100%';

  // set to true when we deprecate the flash player
  const DEFAULT_TO_IFRAME       = false;

  public function parse($attributes, $content=null) {

    extract(shortcode_atts(array(
      'url' => $content,
      'iframe' => self::getDefaultIframePreference(),
      'params' => self::getDefaultQuery(),
      'height' => '',
      'width'  => ''
    ), $attributes));

    $iframe = self::booleanize($iframe);

    // The HTML5 widget doesn't support http://soundcloud.com/<username>
    // style urls yet. So we force the old Flash widget for now.
    if (self::isLegacyURL($url)) {
      $iframe = false;
    }

    $type = self::getType($url);
    $width = self::getWidth($width, $iframe, $type);
    $height = self::getHeight($height, $iframe, $type);

    return self::getHTML($url, $iframe, $params, $width, $height);
  }

  public function getDefaultQuery() {
    $options = array(
      'auto_play',
      'show_comments',
      'theme_color',
	  'show_artwork'
    );
    $params = array();
    foreach ($options as &$option) {
      $value = get_option_tree('soundcloud_' . $option, '');
      if (!empty($value)) {
        if($value == 'Yes') { $value = 'true'; } else { $value = 'false'; }
		$params[$option] = $value;		
      }
    }
	$params['color'] = str_replace('#', '', get_option_tree('color_scheme'));
    return http_build_query($params);
  }

  public function getDefaultIframePreference() {
    $pref = get_option_tree('soundcloud_player_iframe', '', false, false);	
	($pref == 'HTML5') ? $pref = 'true' : $pref= 'false';	
    return ($pref === '') ? DEFAULT_TO_IFRAME : self::booleanize($pref);
  }

  private function booleanize($value) {
    if ($value && strtolower($value) !== "false") {
      return true;
    } else {
      return false;
    }
  }

  private function isLegacyURL($url) {
    return !preg_match("/api.soundcloud.com/i", $url);
  }

  private function getWidth($width, $iframe, $type) {
    if (empty($width)) {
      $default = ($iframe) ? self::IFRAME_WIDTH : self::FLASH_WIDTH;
      $width = get_option_tree('soundcloud_player_width');
      $width = $width === '' ? $default : $width;
    }
    return $width;
  }

  private function getHeight($height, $iframe, $type) {
    switch ($type) {
      case 'groups':
      case 'sets':
      case 'playlists':
        $default = ($iframe) ? self::IFRAME_TRACKLIST_HEIGHT : self::FLASH_TRACKLIST_HEIGHT;
        $height = (empty($height)) ? get_option_tree('soundcloud_player_height_multi') : $height;
        $height = (empty($height)) ? $default : $height;
        if ($iframe) {
          $height = self::fixHeight($height, $default);
        }
        break;
      default:
        $default = ($iframe) ? self::IFRAME_HEIGHT : self::FLASH_HEIGHT;
        $height = (empty($height)) ? get_option_tree('soundcloud_player_height') : $height;
        $height = (empty($height)) ? $default : $height;
        if ($iframe) {
          $height = self::fixHeight($height, $default);
        }
        // sounds can only be default height
        //$height = ($iframe) ? self::IFRAME_HEIGHT : self::FLASH_HEIGHT;
        break;
    }
    return $height;
  }

  private function fixHeight($height, $min_height) {
    if (!preg_match("/[0-9]+%/", $height) && intval($height) < $min_height) {
      $height = $min_height;
    }
    return $height;
  }

  private function getType($url) {
    if (empty($url)) {
      return false;
    }
    if ($url = parse_url($url)) {
      $splitted_url =  preg_split( "/\//", $url['path'] );
      $media_type = $splitted_url[count($splitted_url) - 2];
      return $media_type;
    }
  }

  private function getHTML($url, $iframe, $params, $width, $height) {

    $encoded_url = urlencode($url);
    $parsed_url = parse_url($url);

    if ($iframe) {
      $player_host = 'w.soundcloud.com';
      $player_params = 'url=' . $encoded_url . '&' . $params;
      $player_src = 'http://' . $player_host . '/player/?' . $player_params;
    } else {
      $player_host = preg_replace('/(.+\.)?(((staging|sandbox)-)?soundcloud\.com)/', 'player.$2', $parsed_url['host']);
      $player_params = 'url=' . $encoded_url . '&g=1&' . $params;
      $player_src = 'http://' . $player_host . '/player.swf?' . $player_params;
    }

    $width = esc_attr($width);
    $height = esc_attr($height);
    $player_src = esc_attr($player_src);

    if ($iframe) {
      $html = '<iframe width="' . $width . '" height="' . $height . '" scrolling="no" frameborder="no" src="' . $player_src . '"></iframe>';
    } else {
      $html = '<object height="' . $height . '" width="' . $width . '"><param name="movie" value="' . $player_src . '"></param><param name="allowscriptaccess" value="always"></param><embed allowscriptaccess="always" height="' . $height . '" src="' . $player_src . '" type="application/x-shockwave-flash" width="' . $width . '"></embed></object>';
    }
    return $html;
  }

}
?>