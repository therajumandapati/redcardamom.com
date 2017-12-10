<?php

function thb_filter_radio_images( $array, $field_id ) {

  if ( $field_id == 'footer_columns' ) {
    $array = array(
      array(
        'value'   => 'fourcolumns',
        'label'   => __( 'Four Columns', 'option-tree' ),
        'src'     => THB_THEME_ROOT . '/assets/img/admin/four-columns.png'
      ),
      array(
        'value'   => 'threecolumns',
        'label'   => __( 'Three Columns', 'option-tree' ),
        'src'     => THB_THEME_ROOT . '/assets/img/admin/three-columns.png'
      ),
      array(
        'value'   => 'twocolumns',
        'label'   => __( 'Two Columns', 'option-tree' ),
        'src'     => THB_THEME_ROOT . '/assets/img/admin/two-columns.png'
      ),
      array(
        'value'   => 'doubleleft',
        'label'   => __( 'Double Left Columns', 'option-tree' ),
        'src'     => THB_THEME_ROOT . '/assets/img/admin/doubleleft-columns.png'
      ),
      array(
        'value'   => 'doubleright',
        'label'   => __( 'Double Right Columns', 'option-tree' ),
        'src'     => THB_THEME_ROOT . '/assets/img/admin/doubleright-columns.png'
      ),
      array(
        'value'   => 'fivecolumns',
        'label'   => __( 'Five Columns', 'option-tree' ),
        'src'     => THB_THEME_ROOT . '/assets/img/admin/five-columns.png'
      )
      
    );
  }
  
  if ( $field_id == 'demo-select' ) {
    $array = array(
      array(
        'value'   => '0',
        'label'   => esc_html__( 'The Voux', 'option-tree' ),
        'src'     => THB_THEME_ROOT . '/assets/img/admin/demos/voux.jpg'
      ),
      array(
        'value'   => '1',
        'label'   => esc_html__( 'Foodies', 'option-tree' ),
        'src'     => THB_THEME_ROOT . '/assets/img/admin/demos/foodies.jpg'
      ),
      array(
        'value'   => '2',
        'label'   => esc_html__( 'AdventureLove', 'option-tree' ),
        'src'     => THB_THEME_ROOT . '/assets/img/admin/demos/adventurelove.jpg'
      ),
      array(
        'value'   => '3',
        'label'   => esc_html__( 'FashionMe', 'option-tree' ),
        'src'     => THB_THEME_ROOT . '/assets/img/admin/demos/fashionme.jpg'
      ),
      array(
        'value'   => '4',
        'label'   => esc_html__( 'Avantgarde', 'option-tree' ),
        'src'     => THB_THEME_ROOT . '/assets/img/admin/demos/avantgarde.jpg'
      )
      
    );
  }
  return $array;
  
}
add_filter( 'ot_radio_images', 'thb_filter_radio_images', 10, 2 );

function thb_filter_options_name() {
	return __('<a href="http://fuelthemes.net">Fuel Themes</a>', 'thevoux');
}
add_filter( 'ot_header_version_text', 'thb_filter_options_name', 10, 2 );


function thb_filter_upload_name() {
	return __('Send to Theme Options', 'thevoux');
}
add_filter( 'ot_upload_text', 'thb_filter_upload_name', 10, 2 );

function thb_header_list() {
	echo '<li class="theme_link"><a href="http://fuelthemes.ticksy.com/" target="_blank">Support Forum</a></li>';
	echo '<li class="theme_link right"><a href="http://wpeng.in/fuelt/" target="_blank">Recommended Hosting</a></li>';
	echo '<li class="theme_link right"><a href="https://wpml.org/?aid=85928&affiliate_key=PIP3XupfKQOZ" target="_blank">Purchase WPML</a></li>';
}
add_filter( 'ot_header_list', 'thb_header_list' );

function thb_filter_ot_recognized_font_families( $array, $field_id ) {
	$array['helveticaneue'] = "'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif";
	ot_fetch_google_fonts( true, false );
	$ot_google_fonts = wp_list_pluck( get_theme_mod( 'ot_google_fonts', array() ), 'family' );
  $array = array_merge($array,$ot_google_fonts);
  
  if (ot_get_option('typekit_id')) {
  	$typekit_fonts = trim(ot_get_option('typekit_fonts'), ' ');
  	$typekit_fonts = explode(',', $typekit_fonts);
  	
  	$array = array_merge($array,$typekit_fonts);
  }
  
  foreach ($array as $font => $value) {
		$thb_font_array[$value] = $value;
  }
  return $thb_font_array;
}
add_filter( 'ot_recognized_font_families', 'thb_filter_ot_recognized_font_families', 10, 2 );

function thb_filter_typography_fields2( $array, $field_id ) {

	if ( in_array($field_id, array("title_type") ) ) {
		$array = array( 'font-family');
	}
	if ( in_array($field_id, array("body_type") ) ) {
		$array = array( 'font-family', 'font-color');
	}
	if ( in_array($field_id, array("article_title_type") ) ) {
		$array = array( 'font-size', 'font-style', 'font-variant', 'font-weight', 'text-decoration', 'text-transform', 'line-height', 'letter-spacing');
	}
	if ( in_array($field_id, array("menu_type", "submenu_type") ) ) {
		$array = array( 'font-family', 'font-size', 'font-style', 'font-variant', 'font-weight', 'text-decoration', 'text-transform', 'line-height', 'letter-spacing');
	}
   return $array;

}
add_filter( 'ot_recognized_typography_fields', 'thb_filter_typography_fields2', 10, 2 );

function thb_filter_typography_fields3( $array, $field_id ) {
	
   $fields = array('menu_left_type', 'menu_right_type');
   if ( in_array($field_id, $fields )) {
      $array = array('font-family', 'font-size', 'font-style', 'font-variant', 'font-weight', 'text-decoration', 'text-transform', 'line-height', 'letter-spacing');
   }

   return $array;

}
add_filter( 'ot_recognized_typography_fields', 'thb_filter_typography_fields3', 10, 2 );

function thb_social_links_settings( $id ) {
    
  $settings = array(
    array(
      'label'       => 'Social Networks to display',
      'id'          => 'footer_social_network',
      'type'        => 'select',
      'desc'        => 'Select your social network',
      'choices'     => array(
        array(
          'label'       => 'Facebook',
          'value'       => 'facebook'
        ),
        array(
          'label'       => 'Twitter',
          'value'       => 'twitter'
        ),
        array(
          'label'       => 'Google Plus',
          'value'       => 'google-plus'
        ),
        array(
          'label'       => 'Pinterest',
          'value'       => 'pinterest'
        ),
        array(
          'label'       => 'Linkedin',
          'value'       => 'linkedin'
        ),
        array(
          'label'       => 'Instagram',
          'value'       => 'instagram'
        ),
        array(
          'label'       => 'Flickr',
          'value'       => 'flickr'
        ),
        array(
          'label'       => 'VK',
          'value'       => 'vk'
        ),
        array(
          'label'       => 'Tumblr',
          'value'       => 'tumblr'
        ),
        array(
          'label'       => 'Spotify',
          'value'       => 'spotify'
        ),
        array(
          'label'       => 'Youtube',
          'value'       => 'youtube'
        ),
        array(
          'label'       => 'Vimeo',
          'value'       => 'vimeo'
        ),
        array(
          'label'       => 'Dribbble',
          'value'       => 'dribbble'
        ),
        array(
          'label'       => '500px',
          'value'       => '500px'
        ),
        array(
          'label'       => 'Behance',
          'value'       => 'behance'
        )
      )
    ),
    array(
      'id'        => 'href',
      'label'     => 'Link',
      'desc'      => sprintf( __( 'Enter a link to the profile or page on the social website. Remember to add the %s part to the front of the link.', 'thevoux' ), '<code>http://</code>' ),
      'type'      => 'text',
    )
  );
  
  return $settings;

}
add_filter( 'ot_social_links_settings', 'thb_social_links_settings');