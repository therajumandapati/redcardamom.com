<?php 
	
function thb_option_element( $name, $attr_option, $type, $shortcode ){
	
	$option_element = null;
	
	(isset($attr_option['desc']) && !empty($attr_option['desc'])) ? $desc = '<p class="description">'.$attr_option['desc'].'</p>' : $desc = '';
		
	switch( $attr_option['type'] ){
		
	case 'radio':
	    
		$option_element .= '<div class="row"><div class="label"><strong>'.$attr_option['title'].': </strong></div><div class="content large">';
	    foreach( $attr_option['opt'] as $val => $title ){
	    
		(isset($attr_option['def']) && !empty($attr_option['def'])) ? $def = $attr_option['def'] : $def = '';
		
		 $option_element .= '
			
		    <input type="radio" name="'.$shortcode.'-'.$name.'" value="'.$val.'" id="shortcode-option-'.$shortcode.'-'.$name.'-'.$val.'"'. ( $val == $def ? ' checked="checked"':'').'><label for="shortcode-option-'.$shortcode.'-'.$name.'-'.$val.'">'.$title.'</label>';
	    }
		
		$option_element .= $desc . '</div></div>';
		
	    break;
		
	case 'checkbox':
		
		$option_element .= '<div class="row"><div class="label"><label for="' . $name . '"><strong>' . $attr_option['title'] . ': </strong></label></div>    <div class="content large"> <input type="checkbox" class="' . $name . '" id="' . $shortcode. '-' . $name . '" />'. $desc. '</div></div>';
		
		break;	
	
	case 'select':
		
		$option_element .= '<div class="row">
		<div class="label"><label for="'.$name.'"><strong>'.$attr_option['title'].': </strong></label></div>
		
		<div class="content"><select id="'.$shortcode.'-'.$name.'">';
			$values = $attr_option['values'];
			foreach( $values as $value ){
		    	$option_element .= '<option value="'.$value.'">'.$value.'</option>';
			}
		$option_element .= '</select>' . $desc . '</div></div>';
		
		break;
		
	case 'textarea':
		$option_element .= '<div class="row">
		<div class="label"><label for="shortcode-option-'.$name.'"><strong>'.$attr_option['title'].': </strong></label></div>
		<div class="content"><textarea id="'.$shortcode.'-'.$name.'" data-attrname="'.$name.'"></textarea> ' . $desc . '</div></div>';
		break;
			
	case 'text':
	default:
	  $option_element .= '<div class="row">
		<div class="label"><label for="shortcode-option-'.$name.'"><strong>'.$attr_option['title'].': </strong></label></div>
		<div class="content"><input class="attr" type="text" id="'.$shortcode.'-'.$name.'" data-attrname="'.$name.'" value="" />' . $desc . '</div></div>';
	  break;

    }
   
    return $option_element;
}