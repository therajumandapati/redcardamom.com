<?php 
function thb_ocdi_import_files() {
    return array(
        array(
            'import_file_name'       => 'The Voux',
            'import_file_url'        => "http://themes.fuelthemes.net/theme-demo-files/thevoux/voux/demo-content.xml",
            'import_widget_file_url' => "http://themes.fuelthemes.net/theme-demo-files/thevoux/voux/widget_data.json",
            'import_theme_options_url' => "http://themes.fuelthemes.net/theme-demo-files/thevoux/voux/theme-options.txt"
        ),
        array(
            'import_file_name'       => 'Foodies',
            'import_file_url'        => "http://themes.fuelthemes.net/theme-demo-files/thevoux/foodies/demo-content.xml",
            'import_widget_file_url' => "http://themes.fuelthemes.net/theme-demo-files/thevoux/foodies/widget_data.json",
            'import_theme_options_url' => "http://themes.fuelthemes.net/theme-demo-files/thevoux/foodies/theme-options.txt"
        ),
        array(
            'import_file_name'       => 'Adventure Love',
            'import_file_url'        => "http://themes.fuelthemes.net/theme-demo-files/thevoux/adventurelove/demo-content.xml",
            'import_widget_file_url' => "http://themes.fuelthemes.net/theme-demo-files/thevoux/adventurelove/widget_data.json",
            'import_theme_options_url' => "http://themes.fuelthemes.net/theme-demo-files/thevoux/adventurelove/theme-options.txt"
        ),
        array(
            'import_file_name'       => 'FashionMe Now',
            'import_file_url'        => "http://themes.fuelthemes.net/theme-demo-files/thevoux/fashionme/demo-content.xml",
            'import_widget_file_url' => "http://themes.fuelthemes.net/theme-demo-files/thevoux/fashionme/widget_data.json",
            'import_theme_options_url' => "http://themes.fuelthemes.net/theme-demo-files/thevoux/fashionme/theme-options.txt"
        ),
        array(
            'import_file_name'       => 'Avantgarde',
            'import_file_url'        => "http://themes.fuelthemes.net/theme-demo-files/thevoux/avantgarde/demo-content.xml",
            'import_widget_file_url' => "http://themes.fuelthemes.net/theme-demo-files/thevoux/avantgarde/widget_data.json",
            'import_theme_options_url' => "http://themes.fuelthemes.net/theme-demo-files/thevoux/avantgarde/theme-options.txt"
        ),
    );
}
add_filter( 'pt-ocdi/import_files', 'thb_ocdi_import_files' );

function thb_ocdi_before_widgets_import( $selected_import, $selected_import_files ) {

  $options_import_data = $selected_import_files;

	$options = unserialize( ot_decode( $options_import_data ) );
	
	/* get settings array */
	$settings = get_option( ot_settings_id() );
	
	/* has options */
	if ( is_array( $options ) ) {
	  
	  /* validate options */
	  if ( is_array( $settings ) ) {
	  
	    foreach( $settings['settings'] as $setting ) {
	    
	      if ( isset( $options[$setting['id']] ) ) {
	        
	        $content = ot_stripslashes( $options[$setting['id']] );
	        
	        $options[$setting['id']] = ot_validate_setting( $content, $setting['type'], $setting['id'] );
	        
	      }
	    
	    }
	  
	  }
	  
	  /* update the option tree array */
	  update_option( ot_options_id(), $options );
	}
}
add_action( 'pt-ocdi/before_widgets_import', 'thb_ocdi_before_widgets_import', 2, 2 );

function thb_ocdi_after_import( $selected_import ) {
	/* Set Pages */
	update_option( 'show_on_front', 'page' );
	
	if ( 'The Voux' === $selected_import['import_file_name'] ) {
		$home = get_page_by_title('Home - Style 1');
		$blog = get_page_by_title('Blog');
		update_option( 'page_for_posts', $blog->ID );
	} else {
		$home = get_page_by_title('Home');
	}
	
	update_option( 'page_on_front', $home->ID );
	
	/* Set Menus */
	$top_menu = get_term_by('name', 'Top Menu', 'nav_menu');
	$mobile_menu = get_term_by('name', 'Mobile Menu', 'nav_menu');
	
	if (!$mobile_menu->term_id) {
		$mobile_menu = $top_menu;
	}
	set_theme_mod( 'nav_menu_locations' , array('nav-menu' => $top_menu->term_id, 'mobile-menu' => $mobile_menu->term_id ) );
}
add_action( 'pt-ocdi/after_import', 'thb_ocdi_after_import' );