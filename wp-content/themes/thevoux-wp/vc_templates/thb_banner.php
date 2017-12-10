<?php function thb_banner( $atts, $content = null ) {
  $atts = vc_map_get_attributes( 'thb_banner', $atts );
  extract( $atts );
	
	$out = '';
	
	$img_id = preg_replace('/[^\d]/', '', $banner_bg);
	$img = wp_get_attachment_image_src($img_id, 'full');
	
  $out .= '<figure class="banner '.$type.'" style="height:'.$banner_height.'px;">';
	$out .= '<img src="'.$img[0].'"></img><figcaption>';
	$out .= '<h2>'.$title.'</h2>';
	$out .= '<p>'.$subtitle.'</p><figcaption>';
  	
	if ($overlay_link) {
  	$out .= '<a href="'.$overlay_link.'"></a>';
	}
  $out .= '</figure>';
  return $out;
}
add_shortcode('thb_banner', 'thb_banner');
