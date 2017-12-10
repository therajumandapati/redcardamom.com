<?php function thb_button( $atts, $content = null ) {
  $atts = vc_map_get_attributes( 'thb_button', $atts );
  extract( $atts );
	
	if($icon) { $caption = '<span class="icon"><i class="fa '.$icon.'"></i></span> '.$caption; }
	
	$out = '<a class="btn '.$size.' '.$animation.'" href="'.$link.'" ' . ($target_blank ? ' target="_blank"' : '') .' role="button">' .$caption. '</a>';
  
  return $out;
}
thb_add_short('thb_button', 'thb_button');
