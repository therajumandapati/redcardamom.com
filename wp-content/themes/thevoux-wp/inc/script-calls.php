<?php
/* De-register Contact Form 7 styles */
add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );

// Main Styles
function thb_main_styles() {	
	global $post;
	// Enqueue 
	wp_enqueue_style("thb-fa", 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css', null, null);
	wp_enqueue_style("thb-app", THB_THEME_ROOT .  "/assets/css/app.css", null, null);
	wp_enqueue_style('thb-style', get_stylesheet_uri(), null, null);	
	
	wp_enqueue_style( 'thb-google-fonts', thb_google_webfont() );
	wp_add_inline_style( 'thb-app', thb_selection() );
	
	if ($post) {
		if ( has_shortcode($post->post_content, 'contact-form-7') ) {
			if ( function_exists( 'wpcf7_enqueue_styles' ) ) {
				wpcf7_enqueue_styles();
			}
		}
	}
}

add_action('wp_enqueue_scripts', 'thb_main_styles');

// Main Scripts
function thb_register_js() {
	
	if (!is_admin()) {
		global $post;
		$thb_api_key = ot_get_option('map_api_key');
		
		// Register 
		wp_register_script('gmapdep', 'https://maps.google.com/maps/api/js?key='.$thb_api_key.'', false, null, false);
		wp_register_script('vendor', THB_THEME_ROOT . '/assets/js/vendor.min.js', array('jquery'), null, TRUE);
		wp_register_script('app', THB_THEME_ROOT . '/assets/js/app.min.js', array('jquery', 'vendor'), null, TRUE);
		
		// Enqueue
		if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
			wp_enqueue_script('comment-reply');
		}
		if ($post) {
			if ( has_shortcode($post->post_content, 'thb_contactmap') ) {
				wp_enqueue_script('gmapdep');
			}
			if ( has_shortcode($post->post_content, 'contact-form-7') ) {
				if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
					wpcf7_enqueue_scripts();
				}
			}
		}
		// Typekit 
		if ($typekit_id = ot_get_option('typekit_id')) {
			wp_enqueue_script('thb-typekit', 'https://use.typekit.net/'.$typekit_id.'.js', array(), NULL, FALSE );
			wp_add_inline_script( 'thb-typekit', 'try{Typekit.load({ async: true });}catch(e){}' );
		}
		
		wp_enqueue_script('vendor');
		wp_enqueue_script('underscore');
		wp_enqueue_script('app');
		wp_localize_script( 'app', 'themeajax', array( 
			'url' => admin_url( 'admin-ajax.php' ),
			'l10n' => array (
				'close' => __("Close", 'thevoux')
			),
			'left_arrow' => thb_load_template_part('assets/svg/left-arrow.svg'),
			'right_arrow' => thb_load_template_part('assets/svg/right-arrow.svg'),
		) );
	}
}
add_action('wp_enqueue_scripts', 'thb_register_js');

// Admin Scripts
function thb_admin_scripts() {
	wp_enqueue_script('thb-admin-meta', THB_THEME_ROOT .'/assets/js/admin-meta.min.js', array('jquery'));
	
	wp_enqueue_style("thb-admin-css", THB_THEME_ROOT . "/assets/css/admin.css");
	
	if (class_exists('WPBakeryVisualComposerAbstract')) {
		wp_enqueue_style( 'vc_extra_css', THB_THEME_ROOT . '/assets/css/vc_extra.css' );
	}
}
add_action('admin_enqueue_scripts', 'thb_admin_scripts');

/* WooCommerce */
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

/* WooCommerce */
if(class_exists('woocommerce')) {
	function thb_woocommerce_scripts() {
		wp_dequeue_script( 'prettyPhoto' );
		wp_dequeue_script( 'prettyPhoto-init' );
	}
	add_action('wp_enqueue_scripts', 'thb_woocommerce_scripts');
}