<?php
function thb_bgecho($array) {
	if(!empty($array)) {
		if (!empty($array['background-color'])) { 
			echo "background-color: " . $array['background-color'] . " !important;\n";
		}
		if (!empty($array['background-image'])) { 
			echo "background-image: url(" . $array['background-image'] . ") !important;\n";
		}
		if (!empty($array['background-repeat'])) { 
			echo "background-repeat: " . $array['background-repeat'] . " !important;\n";
		}
		if (!empty($array['background-attachment'])) { 
			echo "background-attachment: " . $array['background-attachment'] . " !important;\n";
		}
		if (!empty($array['background-position'])) { 
			echo "background-position: " . $array['background-position'] . " !important;\n";
		}
		if (!empty($array['background-size'])) { 
			echo "background-size: " . $array['background-size'] . " !important;\n";
		}
	}
}

function thb_paddingecho($array) {
	if(!empty($array)) {
		if (!empty($array['top'])) { 
			echo "padding-top: " . $array['top'] . $array['unit'].";\n";
		}
		if (!empty($array['right'])) { 
			echo "padding-right: " . $array['right'] . $array['unit'].";\n";
		}
		if (!empty($array['bottom'])) { 
			echo "padding-bottom: " . $array['bottom'] . $array['unit'].";\n";
		}
		if (!empty($array['left'])) { 
			echo "padding-left: " . $array['left'] . $array['unit'].";\n";
		}
	}
}

function thb_linkcolorecho($array, $start) {
	if(!empty($array)) {
		if (!empty($array['link'])) { 
			echo $start." a { color: " . $array['link'] ."; }\n";
		}
		if (!empty($array['hover'])) { 
			echo $start." a:hover { color: " . $array['hover'] ."; }\n";
		}
		if (!empty($array['active'])) { 
			echo $start." a:active { color: " . $array['active'] ."; }\n";
		}
		if (!empty($array['visited'])) { 
			echo $start." a:visited { color: " . $array['visited'] ."; }\n";
		}
		if (!empty($array['link'])) { 
			echo $start." a:focus { color: " . $array['focus'] ."; }\n";
		}
	}
}

$thb_fontlist = array();

function thb_google_webfont() {
		global $thb_fontlist;
		$options = array( 
			array( 
					'option' => "body_type", 
					'default' => "Lora"
			),
			array( 
					'option' => "title_type", 
					'default' => "Playfair Display"
			),
			array( 
					'option' => "menu_type", 
					'default' => "Lora"
			),
			array( 
					'option' => "submenu_type", 
					'default' => "Lora"
			),
			array( 
					'option' => "widget_title_type", 
					'default' => "Lora"
			),
			
		);
		$import = '';	
						
		$subsets = 'latin,latin-ext';
		$subset = ot_get_option('font_subsets');

		if ( 'cyrillic' == $subset )
			$subsets .= ',cyrillic,cyrillic-ext';
		elseif ( 'greek' == $subset )
			$subsets .= ',greek,greek-ext';
		elseif ( 'vietnamese' == $subset )
			$subsets .= ',vietnamese';

		$weights = ':300,400,500,600,700,900';
		foreach($options as $option) {
			$array = ot_get_option($option['option']);
			
			if (!empty($array['font-family'])) { 
				if (!in_array($array['font-family'], $thb_fontlist)) {
					$font = str_replace(' ', '+', $array['font-family']).$weights;
					array_push($thb_fontlist, $font);
				}
			} else if ($option['default']) {
				if (!in_array($option['default'], $thb_fontlist)) {
					$font = str_replace(' ', '+', $option['default']).$weights;
					array_push($thb_fontlist, $font);
				}
			}
		}
		$font_list = array_unique($thb_fontlist);
			
		$cssfont = implode('|', $font_list);
		$query_args = array(
			'family' => $cssfont,
			'subset' => $subsets,
		);
		$font_url = add_query_arg( $query_args, "https://fonts.googleapis.com/css" );
		return $font_url;
}

function thb_typeecho($array, $important = false, $default = false) {
	global $thb_fontlist;
	
	if(!empty($array)) {
		
		if (!empty($array['font-family'])) { 
			echo "font-family: '" . $array['font-family'] . "';\n";
		} else if ($default) {
			echo "font-family: '" . $default . "';\n";
		}
		if (!empty($array['font-color'])) { 
			echo "color: " . $array['font-color'] . ";\n";
		}
		if (!empty($array['font-style'])) { 
			echo "font-style: " . $array['font-style'] . ";\n";
		}
		if (!empty($array['font-variant'])) { 
			echo "font-variant: " . $array['font-variant'] . ";\n";
		}
		if (!empty($array['font-weight'])) { 
			echo "font-weight: " . $array['font-weight'] . ";\n";
		}
		if (!empty($array['font-size'])) { 
			
			if ($important) {
				echo "font-size: " . $array['font-size'] . " !important;\n";
			} else {
				echo "font-size: " . $array['font-size'] . ";\n";
			}
		}
		if (!empty($array['text-decoration'])) { 
				echo "text-decoration: " . $array['text-decoration'] . " !important;\n";
		}
		if (!empty($array['text-transform'])) { 
				echo "text-transform: " . $array['text-transform'] . " !important;\n";
		}
		if (!empty($array['line-height'])) { 
				echo "line-height: " . $array['line-height'] . " !important;\n";
		}
		if (!empty($array['letter-spacing'])) { 
				echo "letter-spacing: " . $array['letter-spacing'] . " !important;\n";
		}
	}
	if(empty($array) && !empty($default)) {
		echo "font-family: '" . $default . "';\n";
	}
}

function thb_spacingecho($array, $std = false, $type = 'padding') {
	if(!empty($array)) {
		$unit = array_key_exists('unit', $array) ? $array['unit'] : 'px';
		if (array_key_exists('top', $array)) {
			$top = array_key_exists('top', $array) ? $array['top'] : false; 
			echo esc_attr($type.'-top:'.$top.$unit.';');
		}
		if (array_key_exists('right', $array)) {
			$right = array_key_exists('right', $array) ? $array['right'] : false;
			echo esc_attr($type.'-right:'.$right.$unit.';');
		}
		if (array_key_exists('bottom', $array)) {
			$bottom = array_key_exists('bottom', $array) ? $array['bottom'] : false;
			echo esc_attr($type.'-bottom:'.$bottom.$unit.';');
		}
		if (array_key_exists('left', $array)) {
			$left = array_key_exists('left', $array) ? $array['left'] : false;
			echo esc_attr($type.'-left:'.$left.$unit.';');
		}
	}
	
}

function thb_measurementecho($array) {
	if(!empty($array)) {
		echo $array[0] . $array[1];
	}
}

function thb_hex2rgb($hex) {

   $hex = str_replace("#", "", $hex);

	if(strlen($hex) == 3) {

      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));

   } else {

      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));

   }

   $rgb = array($r, $g, $b);

   return implode(",", $rgb); // returns the rgb values separated by commas

}
function thb_adjustColorLightenDarken($color_code,$percentage_adjuster = 0) {
    $percentage_adjuster = round($percentage_adjuster/100,2);
    if(is_array($color_code)) {
        $r = $color_code["r"] - (round($color_code["r"])*$percentage_adjuster);
        $g = $color_code["g"] - (round($color_code["g"])*$percentage_adjuster);
        $b = $color_code["b"] - (round($color_code["b"])*$percentage_adjuster);

        return array("r"=> round(max(0,min(255,$r))),
            "g"=> round(max(0,min(255,$g))),
            "b"=> round(max(0,min(255,$b))));
    }
    else if(preg_match("/#/",$color_code)) {
        $hex = str_replace("#","",$color_code);
        $r = (strlen($hex) == 3)? hexdec(substr($hex,0,1).substr($hex,0,1)):hexdec(substr($hex,0,2));
        $g = (strlen($hex) == 3)? hexdec(substr($hex,1,1).substr($hex,1,1)):hexdec(substr($hex,2,2));
        $b = (strlen($hex) == 3)? hexdec(substr($hex,2,1).substr($hex,2,1)):hexdec(substr($hex,4,2));
        $r = round($r - ($r*$percentage_adjuster));
        $g = round($g - ($g*$percentage_adjuster));
        $b = round($b - ($b*$percentage_adjuster));

        return "#".str_pad(dechex( max(0,min(255,$r)) ),2,"0",STR_PAD_LEFT)
            .str_pad(dechex( max(0,min(255,$g)) ),2,"0",STR_PAD_LEFT)
            .str_pad(dechex( max(0,min(255,$b)) ),2,"0",STR_PAD_LEFT);

    }
}
function thb_catcolorecho($array) {
	if(!empty($array)) {
		foreach ($array as $cat => $color) {
			$cat = get_category($cat);
			if ($cat) {
				echo ".post-meta a.cat-".$cat->slug." { color: ". $color ."; }\n";
				echo ".post .post-content .category_title.catstyle-style".$cat->term_id." h2 a:hover { color: ". $color ."; }\n";
			}
		}
	}
}