<?php
/**
 * Initialize the options before anything else. 
 */
add_action( 'admin_init', 'thb_custom_theme_options', 1 );

/**
 * Theme Mode demo code of all the available option types.
 *
 * @return    void
 *
 * @access    private
 * @since     2.0
 */
function thb_custom_theme_options() {
  
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( 'option_tree_settings', array() );
  
  /**
   * Create a custom settings array that we pass to 
   * the OptionTree Settings API Class.
   */
  $custom_settings = array(
    'sections'        => array(
      array(
        'title'       => esc_html__('General', 'thevoux'),
        'id'          => 'general'
      ),
      array(
        'title'       => esc_html__('Header Settings', 'thevoux'),
        'id'          => 'header'
      ),
      array(
        'title'       => esc_html__('Footer Settings', 'thevoux'),
        'id'          => 'footer'
      ),
      array(
        'title'       => esc_html__('Category Settings', 'thevoux'),
        'id'          => 'category'
      ),
      array(
        'title'       => esc_html__('Shop Settings', 'thevoux'),
        'id'          => 'shop'
      ),
      array(
        'title'       => esc_html__('Customization', 'thevoux'),
        'id'          => 'customization'
      ),
      array(
        'title'       => esc_html__('Advertising', 'thevoux'),
        'id'          => 'advertising'
      ),
      array(
        'title'       => esc_html__('Misc', 'thevoux'),
        'id'          => 'misc'
      ),
      array(
        'title'       => esc_html__('Demo Content', 'thevoux'),
        'id'          => 'import'
      )
    ),
    'settings'        => array(
    	array(
    	  'id'          => 'general_tab0',
    	  'label'       => esc_html__('General', 'thevoux'),
    	  'type'        => 'tab',
    	  'section'     => 'general'
    	),
    	array(
    	  'label'       => esc_html__('Widget Styles', 'thevoux'),
    	  'id'          => 'widget_style',
    	  'type'        => 'radio',
    	  'desc'        => esc_html__('Changes the widget Style', 'thevoux'),
    	  'choices'     => array(
    	  	array(
    	  	  'label'       => esc_html__('Style 1', 'thevoux'),
    	  	  'value'       => 'style1'
    	  	),
    	    array(
    	      'label'       => esc_html__('Style 2', 'thevoux'),
    	      'value'       => 'style2'
    	    ),
    	    array(
    	      'label'       => esc_html__('Style 3', 'thevoux'),
    	      'value'       => 'style3'
    	    ),
    	    array(
    	      'label'       => esc_html__('Style 4', 'thevoux'),
    	      'value'       => 'style4'
    	    )
    	  ),
    	  'std'         => 'style1',
    	  'section'     => 'general'
    	),
    	array(
    	  'label'       => esc_html__('Display Mobile Menu Icon on Desktops?', 'thevoux'),
    	  'id'          => 'mobile_menu_icon',
    	  'type'        => 'on_off',
    	  'desc'        => esc_html__('You can disable mobile menu icon on desktop screens', 'thevoux'),
    	  'std'         => 'on',
    	  'section'     => 'general'
    	),
    	array(
    	  'label'       => esc_html__('Display Full Menu?', 'thevoux'),
    	  'id'          => 'full_menu',
    	  'type'        => 'on_off',
    	  'desc'        => esc_html__('You can hide the full navigation menu if needed', 'thevoux'),
    	  'std'         => 'on',
    	  'section'     => 'general'
    	),
    	array(
    	  'label'       => esc_html__('Scroll to Top Arrow', 'thevoux'),
    	  'id'          => 'scroll_totop',
    	  'type'        => 'on_off',
    	  'desc'        => esc_html__('You can disable scroll to top arrow from here', 'thevoux'),
    	  'std'         => 'on',
    	  'section'     => 'general'
    	),
    	array(
    	  'label'       => esc_html__('Use Relative Dates?', 'thevoux'),
    	  'id'          => 'relative_dates',
    	  'type'        => 'on_off',
    	  'desc'        => esc_html__('This will display dates as "1 day ago", etc.', 'thevoux'),
    	  'std'         => 'on',
    	  'section'     => 'general'
    	),
    	array(
    	  'label'       => esc_html__('Black Share/Social Icons?', 'thevoux'),
    	  'id'          => 'social_black',
    	  'type'        => 'on_off',
    	  'desc'        => esc_html__('This changes the color of the social icons to add a black/white feel.', 'thevoux'),
    	  'std'         => 'off',
    	  'section'     => 'general'
    	),
    	array(
    	  'label'       => esc_html__('Blog Featured Post', 'thevoux'),
    	  'id'          => 'blog_featured',
    	  'type'        => 'text',
    	  'desc'        => esc_html__('If you would like to feature a blog post above all post inside blog, enter its ID here.', 'thevoux'),
    	  'section'     => 'general'
    	),
    	array(
    	  'id'          => 'general_tab1',
    	  'label'       => esc_html__('Articles', 'thevoux'),
    	  'type'        => 'tab',
    	  'section'     => 'general'
    	),
    	array(
    	  'label'       => esc_html__('Default Article Style', 'thevoux'),
    	  'id'          => 'article_style',
    	  'type'        => 'radio',
    	  'desc'        => esc_html__('Which article style would you like to use by default?', 'thevoux'),
    	  'choices'     => array(
    	  	array(
    	  		'label'       => 'Style 1 (Classic)',
    	  		'value'       => 'style1'
    	  	),
    	  	array(
    	  		'label'       => 'Style 2 (Large Top Image)',
    	  		'value'       => 'style2'
    	  	),
    	  	array(
    	  		'label'       => 'Style 3 (Center Content - Large Top Image)',
    	  		'value'       => 'style3'
    	  	),
    	  	array(
    	  		'label'       => 'Style 4 (Center Content - Classic)',
    	  		'value'       => 'style4'
    	  	)
    	  ),
    	  'std'         => 'style1',
    	  'section'	 		=> 'general'
    	),
    	array(
    	  'label'       => esc_html__('Display Reading Indicator?', 'thevoux'),
    	  'id'          => 'reading_indicator',
    	  'type'        => 'on_off',
    	  'desc'        => esc_html__('You can disable the reading progress indicator here', 'thevoux'),
    	  'std'         => 'on',
    	  'section'     => 'general'
    	),
    	array(
    	  'label'       => esc_html__('Full Width Posts', 'thevoux'),
    	  'id'          => 'article_fullwidth',
    	  'type'        => 'on_off',
    	  'desc'        => esc_html__('This will display articles in full width, the sidebars will be removed', 'thevoux'),
    	  'std'         => 'off',
    	  'section'     => 'general'
    	),
    	array(
    	  'label'       => esc_html__('Related Posts', 'thevoux'),
    	  'id'          => 'related_posts',
    	  'type'        => 'on_off',
    	  'desc'        => esc_html__('You can disable related posts on article pages', 'thevoux'),
    	  'std'         => 'on',
    	  'section'     => 'general'
    	),
    	array(
    	  'label'       => esc_html__('Number of Related Posts', 'thevoux'),
    	  'id'          => 'related_count',
    	  'type'        => 'text',
    	  'desc'        => esc_html__('Number of related posts to show, default is 6.', 'thevoux'),
    	  'section'     => 'general',
    	  'condition'   => 'related_posts:is(on)'
    	),
    	array(
    	  'label'       => esc_html__('Infinite loading on Article Pages', 'thevoux'),
    	  'id'          => 'infinite_load',
    	  'type'        => 'on_off',
    	  'desc'        => esc_html__('You can disable infinite scrolling on article pages', 'thevoux'),
    	  'std'         => 'on',
    	  'section'     => 'general'
    	),
    	array(
    	  'label'       => esc_html__('Fixed Sidebars', 'thevoux'),
    	  'id'          => 'article_fixed_sidebar',
    	  'type'        => 'on_off',
    	  'desc'        => esc_html__('You can disable fixed sidebars on article pages', 'thevoux'),
    	  'std'         => 'on',
    	  'section'     => 'general'
    	),
    	array(
    	  'label'       => esc_html__('Author Information', 'thevoux'),
    	  'id'          => 'article_author',
    	  'type'        => 'on_off',
    	  'desc'        => esc_html__('You can disable author information on article pages', 'thevoux'),
    	  'std'         => 'on',
    	  'section'     => 'general'
    	),
    	array(
    	  'label'       => esc_html__('Dropcap', 'thevoux'),
    	  'id'          => 'article_dropcap',
    	  'type'        => 'on_off',
    	  'desc'        => esc_html__('You can disable the large dropcap at the start of article pages using this setting', 'thevoux'),
    	  'std'         => 'on',
    	  'section'     => 'general'
    	),
    	array(
    	  'id'          => 'general_tab2',
    	  'label'       => esc_html__('Social Sharing', 'thevoux'),
    	  'type'        => 'tab',
    	  'section'     => 'general'
    	),
    	array(
    	  'label'       => esc_html__('Sharing Cache', 'thevoux'),
    	  'id'          => 'sharing_cache',
    	  'type'        => 'radio',
    	  'desc'        => esc_html__('Amount of time before the new counts are fetched.', 'thevoux'),
    	  'choices'     => array(
    	  	array(
    	  	  'label'       => esc_html__('1 Hour', 'thevoux'),
    	  	  'value'       => '1h'
    	  	),
    	    array(
    	      'label'       => esc_html__('1 Day', 'thevoux'),
    	      'value'       => '1'
    	    ),
    	    array(
    	      'label'       => esc_html__('7 Days', 'thevoux'),
    	      'value'       => '7'
    	    ),
    	    array(
    	      'label'       => esc_html__('30 Days', 'thevoux'),
    	      'value'       => '30'
    	    )
    	  ),
    	  'std'         => '1',
    	  'section'     => 'general'
    	),
    	array(
    	  'label'       => esc_html__('Sharing buttons', 'thevoux'),
    	  'id'          => 'sharing_buttons',
    	  'type'        => 'checkbox',
    	  'desc'        => esc_html__('You can choose which social networks to display. Please fill out your Twitter username from Misc -> Twitter oAuth', 'thevoux'),
    	  'choices'     => array(
    	    array(
    	      'label'       => esc_html__('Facebook', 'thevoux'),
    	      'value'       => 'facebook'
    	    ),
    	    array(
    	      'label'       => esc_html__('Twitter', 'thevoux'),
    	      'value'       => 'twitter'
    	    ),
    	    array(
    	      'label'       => esc_html__('Google Plus', 'thevoux'),
    	      'value'       => 'google-plus'
    	    ),
    	    array(
    	      'label'       => esc_html__('Pinterest', 'thevoux'),
    	      'value'       => 'pinterest'
    	    ),
    	    array(
    	      'label'       => esc_html__('Linkedin', 'thevoux'),
    	      'value'       => 'linkedin'
    	    )
    	  ),
    	  'section'     => 'general'
    	),
    	array(
    	  'label'       => esc_html__('Hide Shares Text If Shares Are 0 ?', 'thevoux'),
    	  'id'          => 'hide_zero_shares',
    	  'type'        => 'on_off',
    	  'desc'        => esc_html__('When enabled, you wont see share counts or texts for 0 shares.', 'thevoux'),
    	  'std'         => 'off',
    	  'section'     => 'general'
    	),
    	array(
    	  'label'       => esc_html__('Disable OG: Tags', 'thevoux'),
    	  'id'          => 'general_disable_og_tags',
    	  'type'        => 'on_off',
    	  'desc'        => esc_html__('If you want, you can disable the theme added Facebook OG tags if you are using a plugin like Yoast SEO or similar.', 'thevoux'),
    	  'std'         => 'off',
    	  'section'     => 'general'
    	),
    	array(
    	  'id'          => 'general_tab3',
    	  'label'       => esc_html__('Selection Sharing', 'thevoux'),
    	  'type'        => 'tab',
    	  'section'     => 'general'
    	),
    	array(
    	  'label'       => esc_html__('Selection Sharing', 'thevoux'),
    	  'id'          => 'selection_sharing',
    	  'type'        => 'on_off',
    	  'desc'        => esc_html__('You can disable selection sharing on pages & posts', 'thevoux'),
    	  'std'         => 'on',
    	  'section'     => 'general'
    	),
    	array(
    	  'label'       => esc_html__('Facebook APP ID', 'thevoux'),
    	  'id'          => 'selection_sharing_appid',
    	  'type'        => 'text',
    	  'desc'        => esc_html__('Facebook Application ID, more info <a href="https://help.yahoo.com/kb/yahoo-merchant-solutions/facebook-application-sln18861.html" target="_blank">here</a>', 'thevoux'),
    	  'section'     => 'general',
    	  'condition'   => 'selection_sharing:is(on)'
    	),
    	array(
    	  'label'       => esc_html__('Selection Sharing buttons', 'thevoux'),
    	  'id'          => 'selection_sharing_buttons',
    	  'type'        => 'checkbox',
    	  'desc'        => esc_html__('You can choose which options to display.', 'thevoux'),
    	  'choices'     => array(
    	    array(
    	      'label'       => esc_html__('Facebook', 'thevoux'),
    	      'value'       => 'facebook'
    	    ),
    	    array(
    	      'label'       => esc_html__('Twitter', 'thevoux'),
    	      'value'       => 'twitter'
    	    ),
    	    array(
    	      'label'       => esc_html__('Email', 'thevoux'),
    	      'value'       => 'email'
    	    )
    	  ),
    	  'section'     => 'general',
    	  'condition'   => 'selection_sharing:is(on)'
    	),
      array(
        'id'          => 'header_tab4',
        'label'       => esc_html__('Menu Settings', 'thevoux'),
        'type'        => 'tab',
        'section'     => 'general'
      ),
      array(
        'label'       => esc_html__('Mobile Menu Footer', 'thevoux'),
        'id'          => 'menu_footer',
        'type'        => 'textarea',
        'desc'        => esc_html__('This content appears at the bottom of the menu. You can use your shortcodes here.', 'thevoux'),
        'rows'        => '4',
        'section'     => 'general'
      ),
      array(
        'id'          => 'header_tab1',
        'label'       => esc_html__('Header Settings', 'thevoux'),
        'type'        => 'tab',
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Fixed Header Style', 'thevoux'),
        'id'          => 'header_fixed_style',
        'type'        => 'radio',
        'desc'        => esc_html__('Which fixed header style would you like to use?', 'thevoux'),
        'choices'     => array(
      		array(
      			'label'       => esc_html__('Style 1 (Center Logo)', 'thevoux'),
      			'value'       => 'style1'
      		),
      		array(
      			'label'       => esc_html__('Style 2 (Just Menu)', 'thevoux'),
      			'value'       => 'style2'
      		)
        ),
        'std'         => 'style1',
        'section'	  => 'header'
      ),
      array(
        'label'       => esc_html__('Header Style', 'thevoux'),
        'id'          => 'header_style',
        'type'        => 'radio',
        'desc'        => esc_html__('Which header style would you like to use?', 'thevoux'),
        'choices'     => array(
      		array(
      			'label'       => esc_html__('Style 1 (Center Logo)', 'thevoux'),
      			'value'       => 'style1'
      		),
      		array(
      			'label'       => esc_html__('Style 2 (Left Logo)', 'thevoux'),
      			'value'       => 'style2'
      		),
      		array(
      			'label'       => esc_html__('Style 3 (Top Logo)', 'thevoux'),
      			'value'       => 'style3'
      		),
      		array(
      			'label'       => esc_html__('Style 4 (Top Menu)', 'thevoux'),
      			'value'       => 'style4'
      		)
        ),
        'std'         => 'style1',
        'section'	  => 'header'
      ),
      array(
        'label'       => 'Boxed Header',
        'id'          => 'header_boxed',
        'type'        => 'on_off',
        'desc'        => 'This will make sure your header max width is restricted to the grid',
        'std'         => 'off',
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Header Menu Color', 'thevoux'),
        'id'          => 'header_menu_color',
        'type'        => 'radio',
        'desc'        => esc_html__('You can choose your menu color here. This changes link color behaviour, so if you set a dark background for the menu, you can select light here.', 'thevoux'),
        'choices'     => array(
          array(
            'label'       => esc_html__('Light', 'thevoux'),
            'value'       => 'light'
          ),
          array(
            'label'       => esc_html__('Dark', 'thevoux'),
            'value'       => 'dark'
          )
        ),
        'std'         => 'dark',
        'section'     => 'header',
        'condition'   => 'header_style:not(style3)'
      ),
      
      array(
        'label'       => esc_html__('Header Social Style', 'thevoux'),
        'id'          => 'header_socialstyle',
        'type'        => 'radio',
        'desc'        => esc_html__('Which header social style would you like to use?', 'thevoux'),
        'choices'     => array(
      		array(
      			'label'       => esc_html__('Style 1 - Collapsed using @ icon', 'thevoux'),
      			'value'       => 'style1'
      		),
      		array(
      			'label'       => esc_html__('Style 2 - Shows icons by default', 'thevoux'),
      			'value'       => 'style2'
      		)
        ),
        'std'         => 'style1',
        'section'	  => 'header'
      ),
      array(
        'id'          => 'header_tab2',
        'label'       => esc_html__('Logo Settings', 'thevoux'),
        'type'        => 'tab',
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Mobile Logo Height', 'thevoux'),
        'id'          => 'logo_height_mobile',
        'type'        => 'measurement',
        'desc'        => esc_html__('You can modify the logo height for mobile screens from here. This is maximum height, so your logo may get smaller depending on spacing inside header', 'thevoux'),
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Logo Height', 'thevoux'),
        'id'          => 'logo_height',
        'type'        => 'measurement',
        'desc'        => esc_html__('You can modify the logo height from here. This is maximum height, so your logo may get smaller depending on spacing inside header', 'thevoux'),
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Logo Upload', 'thevoux'),
        'id'          => 'logo',
        'type'        => 'upload',
        'desc'        => esc_html__('You can upload your own logo here. Since this theme is retina-ready, <strong>please upload a double the size you set above.</strong>', 'thevoux'),
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Fixed Logo Upload', 'thevoux'),
        'id'          => 'logo_fixed',
        'type'        => 'upload',
        'desc'        => esc_html__('You can upload your logo here for the fixed header. This should be 80px in height for retina screens.', 'thevoux'),
        'section'     => 'header'
      ),
      array(
        'id'          => 'header_tab3',
        'label'       => esc_html__('Social Icons in Header', 'thevoux'),
        'type'        => 'tab',
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Facebook Link', 'thevoux'),
        'id'          => 'fb_link_header',
        'type'        => 'text',
        'desc'        => esc_html__('Facebook profile/page link', 'thevoux'),
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Pinterest Link', 'thevoux'),
        'id'          => 'pinterest_link_header',
        'type'        => 'text',
        'desc'        => esc_html__('Pinterest profile/page link', 'thevoux'),
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Twitter Link', 'thevoux'),
        'id'          => 'twitter_link_header',
        'type'        => 'text',
        'desc'        => esc_html__('Twitter profile/page link', 'thevoux'),
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Google Plus Link', 'thevoux'),
        'id'          => 'googleplus_link_header',
        'type'        => 'text',
        'desc'        => esc_html__('Google Plus profile/page link', 'thevoux'),
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Linkedin Link', 'thevoux'),
        'id'          => 'linkedin_link_header',
        'type'        => 'text',
        'desc'        => esc_html__('Linkedin profile/page link', 'thevoux'),
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Instagram Link', 'thevoux'),
        'id'          => 'instragram_link_header',
        'type'        => 'text',
        'desc'        => esc_html__('Instagram profile/page link', 'thevoux'),
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Xing Link', 'thevoux'),
        'id'          => 'xing_link_header',
        'type'        => 'text',
        'desc'        => esc_html__('Xing profile/page link', 'thevoux'),
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Tumblr Link', 'thevoux'),
        'id'          => 'tumblr_link_header',
        'type'        => 'text',
        'desc'        => esc_html__('Tumblr profile/page link', 'thevoux'),
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Vkontakte Link', 'thevoux'),
        'id'          => 'vk_link_header',
        'type'        => 'text',
        'desc'        => esc_html__('Vkontakte profile/page link', 'thevoux'),
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('SoundCloud Link', 'thevoux'),
        'id'          => 'soundcloud_link_header',
        'type'        => 'text',
        'desc'        => esc_html__('SoundCloud profile/page link', 'thevoux'),
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Dribbble Link', 'thevoux'),
        'id'          => 'dribbble_link_header',
        'type'        => 'text',
        'desc'        => esc_html__('Dribbbble profile/page link', 'thevoux'),
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('YouTube Link', 'thevoux'),
        'id'          => 'youtube_link_header',
        'type'        => 'text',
        'desc'        => esc_html__('Youtube profile/page link', 'thevoux'),
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Spotify Link', 'thevoux'),
        'id'          => 'spotify_link_header',
        'type'        => 'text',
        'desc'        => esc_html__('Spotify profile/page link', 'thevoux'),
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Behance Link', 'thevoux'),
        'id'          => 'behance_link_header',
        'type'        => 'text',
        'desc'        => esc_html__('Behance profile/page link', 'thevoux'),
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('DeviantArt Link', 'thevoux'),
        'id'          => 'deviantart_link_header',
        'type'        => 'text',
        'desc'        => esc_html__('DeviantArt profile/page link', 'thevoux'),
        'section'     => 'header'
      ),
      array(
        'id'          => 'footer_tab0',
        'label'       => esc_html__('Footer Social Bar Settings', 'thevoux'),
        'type'        => 'tab',
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__('Display Footer Social Bar?', 'thevoux'),
        'id'          => 'footer_social_bar',
        'type'        => 'on_off',
        'desc'        => esc_html__('Would you like to display the Footer Social Bar?', 'thevoux'),
        'std'         => 'on',
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__('Social Links to display', 'thevoux' ),
        'id'          => 'footer_social_buttons',
        'type'        => 'social-links',
        'desc'        => esc_html__('Add your desired Social Links for social bar here', 'thevoux' ),
        'section'     => 'footer'
      ),
      array(
        'id'          => 'footer_tab1',
        'label'       => esc_html__('Footer Settings', 'thevoux'),
        'type'        => 'tab',
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__('Display Footer', 'thevoux'),
        'id'          => 'footer',
        'type'        => 'on_off',
        'desc'        => esc_html__('Would you like to display the Footer?', 'thevoux'),
        'std'         => 'on',
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__('Footer Style', 'thevoux'),
        'id'          => 'footer_style',
        'type'        => 'radio',
        'desc'        => esc_html__('Which footer style would you like to use? Horizantal uses the "Social Icons in Subfooter"', 'thevoux'),
        'choices'     => array(
      		array(
      			'label'       => esc_html__('Classic with columns and subfooter', 'thevoux'),
      			'value'       => 'style1'
      		),
      		array(
      			'label'       => esc_html__('Minimal with logo', 'thevoux'),
      			'value'       => 'style2'
      		),
      		array(
      			'label'       => esc_html__('Horizontal with logo, menu & social icons', 'thevoux'),
      			'value'       => 'style3'
      		)
        ),
        'std'         => 'style1',
        'section'	  => 'footer'
      ),
      array(
        'label'       => esc_html__('Footer Columns', 'thevoux'),
        'id'          => 'footer_columns',
        'type'        => 'radio-image',
        'desc'        => esc_html__('You can change the layout of footer columns here', 'thevoux'),
        'std'         => 'threecolumns',
        'section'     => 'footer',
        'condition'   => 'footer_style:is(style1)'
      ),
      array(
        'label'       => esc_html__('Boxed Footer', 'thevoux'),
        'id'          => 'footer_grid',
        'type'        => 'on_off',
        'desc'        => esc_html__('If Off is selected, the footer contents will be full width.', 'thevoux'),
        'std'         => 'on',
        'section'     => 'footer',
        'condition'   => 'footer_style:is(style1)'
      ),
      array(
        'label'       => esc_html__('Footer Menu', 'thevoux'),
        'id'          => 'footer_menu',
        'type'        => 'menu_select',
        'section'     => 'footer',
        'operator' 		=> 'or',
        'condition'   => 'footer_style:is(style2),footer_style:is(style3)'
      ),
      array(
        'label'       => esc_html__('Footer Text Content', 'thevoux'),
        'id'          => 'footer_text',
        'type'        => 'text',
        'desc'        => esc_html__('Enter your desired text for footer', 'thevoux'),
        'section'     => 'footer',
        'condition'   => 'footer_style:is(style2)'
      ),
      array(
        'id'          => 'footer_tab2',
        'label'       => esc_html__('Sub-Footer Settings', 'thevoux'),
        'type'        => 'tab',
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__('Display Sub-Footer', 'thevoux'),
        'id'          => 'subfooter',
        'type'        => 'on_off',
        'desc'        => esc_html__('Would you like to display the Sub Footer?', 'thevoux'),
        'std'         => 'on',
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__('Sub-Footer Content', 'thevoux'),
        'id'          => 'subfooter_content',
        'type'        => 'radio',
        'desc'        => esc_html__('What type of content would you like to use for subfooter?', 'thevoux'),
        'choices'     => array(
          array(
            'label'       => esc_html__('Social Icons', 'thevoux'),
            'value'       => 'footer-icons'
          ),
          array(
            'label'       => esc_html__('Text', 'thevoux'),
            'value'       => 'footer-text'
          ),
          array(
            'label'       => esc_html__('Menu', 'thevoux'),
            'value'       => 'footer-menu'
          )
        ),
        'std'         => 'footer-text',
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__('Footer Menu', 'thevoux'),
        'id'          => 'subfooter_menu',
        'type'        => 'menu_select',
        'section'     => 'footer',
        'condition'   => 'subfooter_content:is(footer-menu)'
      ),
      array(
        'label'       => esc_html__('Footer Text Content', 'thevoux'),
        'id'          => 'subfooter_text',
        'type'        => 'text',
        'desc'        => esc_html__('Enter your desired text for footer', 'thevoux'),
        'section'     => 'footer',
        'condition'   => 'subfooter_content:is(footer-text)'
      ),
      array(
        'id'          => 'footer_tab3',
        'label'       => esc_html__('Social Icons in Sub Footer', 'thevoux'),
        'type'        => 'tab',
        'section'     => 'footer'
      ),
      array(
        'id'          => 'subfooter_socialtext',
        'label'       => esc_html__('About Social Icons', 'thevoux'),
        'desc'        => esc_html__('These icons will be used on the SubFooter if you select it from the previous tab', 'thevoux'),
        'type'        => 'textblock',
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__('Facebook Link', 'thevoux'),
        'id'          => 'fb_link',
        'type'        => 'text',
        'desc'        => esc_html__('Facebook profile/page link', 'thevoux'),
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__('Pinterest Link', 'thevoux'),
        'id'          => 'pinterest_link',
        'type'        => 'text',
        'desc'        => esc_html__('Pinterest profile/page link', 'thevoux'),
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__('Twitter Link', 'thevoux'),
        'id'          => 'twitter_link',
        'type'        => 'text',
        'desc'        => esc_html__('Twitter profile/page link', 'thevoux'),
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__('Google Plus Link', 'thevoux'),
        'id'          => 'googleplus_link',
        'type'        => 'text',
        'desc'        => esc_html__('Google Plus profile/page link', 'thevoux'),
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__('Linkedin Link', 'thevoux'),
        'id'          => 'linkedin_link',
        'type'        => 'text',
        'desc'        => esc_html__('Linkedin profile/page link', 'thevoux'),
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__('Instagram Link', 'thevoux'),
        'id'          => 'instragram_link',
        'type'        => 'text',
        'desc'        => esc_html__('Instagram profile/page link', 'thevoux'),
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__('Xing Link', 'thevoux'),
        'id'          => 'xing_link',
        'type'        => 'text',
        'desc'        => esc_html__('Xing profile/page link', 'thevoux'),
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__('Tumblr Link', 'thevoux'),
        'id'          => 'tumblr_link',
        'type'        => 'text',
        'desc'        => esc_html__('Tumblr profile/page link', 'thevoux'),
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__('Vkontakte Link', 'thevoux'),
        'id'          => 'vk_link',
        'type'        => 'text',
        'desc'        => esc_html__('Vkontakte profile/page link', 'thevoux'),
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__('SoundCloud Link', 'thevoux'),
        'id'          => 'soundcloud_link',
        'type'        => 'text',
        'desc'        => esc_html__('SoundCloud profile/page link', 'thevoux'),
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__('Dribbble Link', 'thevoux'),
        'id'          => 'dribbble_link',
        'type'        => 'text',
        'desc'        => esc_html__('Dribbbble profile/page link', 'thevoux'),
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__('YouTube Link', 'thevoux'),
        'id'          => 'youtube_link',
        'type'        => 'text',
        'desc'        => esc_html__('Youtube profile/page link', 'thevoux'),
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__('Spotify Link', 'thevoux'),
        'id'          => 'spotify_link',
        'type'        => 'text',
        'desc'        => esc_html__('Spotify profile/page link', 'thevoux'),
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__('Behance Link', 'thevoux'),
        'id'          => 'behance_link',
        'type'        => 'text',
        'desc'        => esc_html__('Behance profile/page link', 'thevoux'),
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__('DeviantArt Link', 'thevoux'),
        'id'          => 'deviantart_link',
        'type'        => 'text',
        'desc'        => esc_html__('DeviantArt profile/page link', 'thevoux'),
        'section'     => 'footer'
      ),
      array(
        'id'          => 'footer_tab4',
        'label'       => esc_html__('Footer Widget Settings', 'thevoux'),
        'type'        => 'tab',
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__('Footer Widget Borders', 'thevoux'),
        'id'          => 'footer_widget_borders',
        'type'        => 'on_off',
        'desc'        => esc_html__('You can toggle footer widget borders here', 'thevoux'),
        'std'         => 'on',
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__('Footer Widget Padding', 'thevoux'),
        'id'          => 'footer_widget_padding',
        'type'        => 'spacing',
        'desc'        => esc_html__('You can modify the footer widget padding here', 'thevoux'),
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__('Vertical-Center Align Widget Content?', 'thevoux'),
        'id'          => 'footer_center_align',
        'type'        => 'on_off',
        'desc'        => esc_html__('You can set widget alignmen here', 'thevoux'),
        'std'         => 'on',
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__('Widget text alignment', 'thevoux'),
        'id'          => 'footer_widget_text_align',
        'type'        => 'radio',
        'desc'        => esc_html__('You can set widget text alignment here', 'thevoux'),
        'choices'     => array(
          array(
            'label'       => esc_html__('Center', 'thevoux'),
            'value'       => 'center-align-text'
          ),
          array(
            'label'       => esc_html__('Left', 'thevoux'),
            'value'       => 'left-align-text'
          )
        ),
        'std'         => 'center-align-text',
        'section'     => 'footer'
      ),
      array(
        'id'          => 'misc_tab0',
        'label'       => esc_html__('General', 'thevoux'),
        'type'        => 'tab',
        'section'     => 'misc'
      ),
      array(
        'label'       => esc_html__('Google Maps API Key', 'thevoux'),
        'id'          => 'map_api_key',
        'type'        => 'text',
        'desc'        => esc_html__('Please enter the Google Maps Api Key. <small>You need to create a browser API key. For more information, please visit: <a href="https://developers.google.com/maps/documentation/javascript/get-api-key">https://developers.google.com/maps/documentation/javascript/get-api-key</a></small>', 'thevoux'),
        'section'     => 'misc'
      ),
      array(
        'label'       => esc_html__('Extra CSS', 'thevoux'),
        'id'          => 'extra_css',
        'type'        => 'css',
        'desc'        => esc_html__('Any CSS that you would like to add to the theme.', 'thevoux'),
        'section'     => 'misc'
      ),
      array(
        'id'          => 'misc_tab1',
        'label'       => esc_html__('404 Page', 'thevoux'),
        'type'        => 'tab',
        'section'     => 'misc'
      ),
      array(
        'label'       => esc_html__('404 Page Image', 'thevoux'),
        'id'          => '404_bg',
        'type'        => 'upload',
        'desc'        => esc_html__('Upload image for 404 page', 'thevoux'),
        'section'     => 'misc'
      ),
      array(
        'id'          => 'misc_tab',
        'label'       => esc_html__('Facebook OAuth', 'thevoux'),
        'type'        => 'tab',
        'section'     => 'misc'
      ),
      array(
        'label'       => esc_html__('Facebook Page ID', 'thevoux'),
        'id'          => 'facebook_page_id',
        'type'        => 'text',
        'desc'        => esc_html__('Facebook Page ID, you can use <a href="http://findmyfbid.com/" target="_blank">this page</a> to find your id', 'thevoux'),
        'section'     => 'misc'
      ),
      array(
        'label'       => esc_html__('Facebook Username', 'thevoux'),
        'id'          => 'facebook_page_username',
        'type'        => 'text',
        'desc'        => esc_html__('Your Facebook page username', 'thevoux'),
        'section'     => 'misc'
      ),
      array(
        'label'       => esc_html__('Facebook App ID', 'thevoux'),
        'id'          => 'facebook_app_id',
        'type'        => 'text',
        'desc'        => esc_html__('Facebook Application ID, available <a href="https://developers.facebook.com/apps/" target="_blank">here</a>', 'thevoux'),
        'section'     => 'misc'
      ),
      array(
        'label'       => esc_html__('Facebook App Secret', 'thevoux'),
        'id'          => 'facebook_app_secret',
        'type'        => 'text',
        'desc'        => esc_html__('Facebook Application Secret, available <a href="https://developers.facebook.com/apps/" target="_blank">here</a>', 'thevoux'),
        'section'     => 'misc'
      ),
      array(
        'id'          => 'misc_tab2',
        'label'       => esc_html__('Twitter OAuth', 'thevoux'),
        'type'        => 'tab',
        'section'     => 'misc'
      ),
      array(
        'id'          => 'twitter_text',
        'label'       => esc_html__('About the Twitter Settings', 'thevoux'),
        'desc'        => esc_html__('You should fill out these settings if you want to use the Twitter related widgets or Visual Composer Elements', 'thevoux'),
        'type'        => 'textblock',
        'section'     => 'misc'
      ),
      array(
        'label'       => esc_html__('Twitter Username', 'thevoux'),
        'id'          => 'twitter_bar_username',
        'type'        => 'text',
        'desc'        => esc_html__('Your Twitter Username', 'thevoux'),
        'section'     => 'misc'
      ),
      array(
        'label'       => esc_html__('Consumer Key', 'thevoux'),
        'id'          => 'twitter_bar_consumerkey',
        'type'        => 'text',
        'desc'        => esc_html__('Visit <a href="https://dev.twitter.com/apps">this link</a> in a new tab, sign in with your account, click on Create a new application and create your own keys in case you dont have already', 'thevoux'),
        'section'     => 'misc'
      ),
      array(
        'label'       => esc_html__('Consumer Secret', 'thevoux'),
        'id'          => 'twitter_bar_consumersecret',
        'type'        => 'text',
        'desc'        => esc_html__('Visit <a href="https://dev.twitter.com/apps">this link</a> in a new tab, sign in with your account, click on Create a new application and create your own keys in case you dont have already', 'thevoux'),
        'section'     => 'misc'
      ),
      array(
        'label'       => esc_html__('Access Token', 'thevoux'),
        'id'          => 'twitter_bar_accesstoken',
        'type'        => 'text',
        'desc'        => esc_html__('Visit <a href="https://dev.twitter.com/apps">this link</a> in a new tab, sign in with your account, click on Create a new application and create your own keys in case you dont have already', 'thevoux'),
        'section'     => 'misc'
      ),
      array(
        'label'       => esc_html__('Access Token Secret', 'thevoux'),
        'id'          => 'twitter_bar_accesstokensecret',
        'type'        => 'text',
        'desc'        => esc_html__('Visit <a href="https://dev.twitter.com/apps">this link</a> in a new tab, sign in with your account, click on Create a new application and create your own keys in case you dont have already', 'thevoux'),
        'section'     => 'misc'
      ),
      array(
        'id'          => 'misc_tab3',
        'label'       => esc_html__('Instagram OAuth', 'thevoux'),
        'type'        => 'tab',
        'section'     => 'misc'
      ),
      array(
        'id'          => 'instagram_text',
        'label'       => esc_html__('About the Instagram Settings', 'thevoux'),
        'desc'        => esc_html__('You should fill out these settings if you want to use the Instagram related VC elements or widgets', 'thevoux'),
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'misc'
      ),
      array(
        'label'       => esc_html__('Instagram ID', 'thevoux'),
        'id'          => 'instagram_id',
        'type'        => 'text',
        'desc'        => esc_html__('Your Instagram ID, you can find your ID from here: <a href="http://www.otzberg.net/iguserid/">http://www.otzberg.net/iguserid/</a>', 'thevoux'),
        'section'     => 'misc'
      ),
      array(
        'label'       => esc_html__('Instagram Username', 'thevoux'),
        'id'          => 'instagram_username',
        'type'        => 'text',
        'desc'        => esc_html__('Your Instagram Username', 'thevoux'),
        'section'     => 'misc'
      ),
      array(
        'label'       => esc_html__('Access Token', 'thevoux'),
        'id'          => 'instagram_accesstoken',
        'type'        => 'text',
        'desc'        => esc_html__('Visit <a href="http://instagr.am/developer/register/">this link</a> in a new tab, sign in with your Instagram account, click on Create a new application and create your own keys in case you dont have already. After that, you can get your Access Token using <a href="http://labs.themeinity.com/plugins/tools/instagram/">http://labs.themeinity.com/plugins/tools/instagram/</a>', 'thevoux'),
        'section'     => 'misc'
      ),
      array(
        'id'          => 'misc_tab4',
        'label'       => esc_html__('Google+ OAuth', 'thevoux'),
        'type'        => 'tab',
        'section'     => 'misc'
      ),
      array(
        'id'          => 'gp_text',
        'label'       => esc_html__('About the Google+ Settings', 'thevoux'),
        'desc'        => esc_html__('You should fill out these settings if you want to use the Google+ related VC elements or widgets', 'thevoux'),
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'misc'
      ),
      array(
        'label'       => esc_html__('Google+ Username', 'thevoux'),
        'id'          => 'gp_username',
        'type'        => 'text',
        'desc'        => esc_html__('Your Google+ Username with leading <strong>+</strong>', 'thevoux'),
        'section'     => 'misc'
      ),
      array(
        'label'       => esc_html__('Google+ API Key', 'thevoux'),
        'id'          => 'gp_apikey',
        'type'        => 'text',
        'desc'        => esc_html__('Visit <a href="https://console.developers.google.com/project">https://console.developers.google.com/project</a> using your Google account, click on the Create Project button and fill the form to create a project.', 'thevoux'),
        'section'     => 'misc'
      ),
      array(
        'id'          => 'misc_tab5',
        'label'       => esc_html__('Create Additional Sidebars', 'thevoux'),
        'type'        => 'tab',
        'section'     => 'misc'
      ),
      array(
        'id'          => 'sidebars_text',
        'label'       => esc_html__('About the sidebars', 'thevoux'),
        'desc'        => esc_html__('All sidebars that you create here will appear both in the Widgets Page(Appearance > Widgets), from where you will have to configure them, and in the pages, where you will be able to choose a sidebar for each page', 'thevoux'),
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'misc'
      ),
      array(
        'label'       => esc_html__('Create Sidebars', 'thevoux'),
        'id'          => 'sidebars',
        'type'        => 'list-item',
        'desc'        => esc_html__('Please choose a unique title for each sidebar!', 'thevoux'),
        'section'     => 'misc',
        'settings'    => array(
          array(
            'label'       => esc_html__('ID', 'thevoux'),
            'id'          => 'id',
            'type'        => 'text',
            'desc'        => esc_html__('Please write a lowercase id, with <strong>no spaces</strong>', 'thevoux')
          )
        )
      ),
      array(
        'label'       => esc_html__('Select Your Demo', 'thevoux'),
        'id'          => 'demo-select',
        'type'        => 'radio-image',
        'std'         => '0',
        'section'     => 'import'
      ),
      array(
        'id'          => 'demo_import',
        'label'       => esc_html__('About Importing Demo Content', 'thevoux'),
        'desc'        => esc_html__('
        <div id="thb-import-messages"></div>
        <p style="text-align:center;"><a class="button button-primary button-hero" id="import-demo-content" href="#">Import Demo Content</a><br /><br />
        <small>Please press only once, and wait till you get the success message above.<br />If you \'re having trouble with import, please see: <a href="https://fuelthemes.ticksy.com/article/2706/">What To Do If Demo Content Import Fails</a></p>', 'thevoux'),
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'import'
      ),
      array(
        'id'          => 'category_tab0',
        'label'       => esc_html__('Category Colors', 'thevoux'),
        'type'        => 'tab',
        'section'     => 'category'
      ),
      array(
        'id'          => 'category_categorycolors',
        'label'       => esc_html__('About Category Colors', 'thevoux'),
        'desc'        => esc_html__('These colors are used for category link colors', 'thevoux'),
        'type'        => 'textblock',
        'section'     => 'category'
      ),
      array(
        'label'       => esc_html__('Parent Category Colors', 'thevoux'),
        'id'          => 'category_colors',
        'type'        => 'category_colorpicker',
        'desc'        => esc_html__('Category Colors', 'thevoux'),
        'section'     => 'category'
      ),
      array(
        'id'          => 'category_tab1',
        'label'       => esc_html__('Category Headers', 'thevoux'),
        'type'        => 'tab',
        'section'     => 'category'
      ),
      array(
        'id'          => 'category_categoryheaders',
        'label'       => esc_html__('About Category Headers', 'thevoux'),
        'desc'        => esc_html__('These settings are used for headers on category pages. Child categories will use their parent category header settings', 'thevoux'),
        'type'        => 'textblock',
        'section'     => 'category'
      ),
      array(
        'label'       => esc_html__('Parent Category Headers', 'thevoux'),
        'id'          => 'category_headers',
        'type'        => 'category_header',
        'desc'        => esc_html__('Category Header Colors', 'thevoux'),
        'section'     => 'category'
      ),
      array(
        'label'       => esc_html__('Shop Sidebar', 'thevoux' ),
        'id'          => 'shop_sidebar',
        'type'        => 'radio',
        'desc'        => esc_html__('Would you like to display sidebar on shop main and category pages?', 'thevoux'),
        'choices'     => array(
          array(
            'label'       => esc_html__('No Sidebar', 'thevoux'),
            'value'       => 'no'
          ),
          array(
            'label'       => esc_html__('Right Sidebar', 'thevoux'),
            'value'       => 'right'
          ),
          array(
            'label'       => esc_html__('Left Sidebar', 'thevoux'),
            'value'       => 'left'
          )
        ),
        'std'         => 'no',
        'section'     => 'shop'
      ),
      array(
        'label'       => esc_html__('Products Per Page', 'thevoux' ),
        'id'          => 'products_per_page',
        'type'        => 'text',
        'section'     => 'shop',
        'std' 				=> '12'
      ),
      array(
      	'label'       => esc_html__('Products Per Row', 'thevoux' ),
        'id'          => 'products_per_row',
        'std'         => '4',
        'type'        => 'numeric-slider',
        'section'     => 'shop',
        'min_max_step'=> '2,6,1'
      ),
      array(
        'id'          => 'customization_tab1',
        'label'       => esc_html__('Colors', 'thevoux'),
        'type'        => 'tab',
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Accent Color', 'thevoux'),
        'id'          => 'accent_color',
        'type'        => 'colorpicker',
        'desc'        => esc_html__('Change the accent color used throughout the theme', 'thevoux'),
        'section'     => 'customization',
        'std'		  => ''
      ),
      array(
        'label'       => esc_html__('Mobile Menu Icon Color', 'thevoux'),
        'id'          => 'mobileicon_color',
        'type'        => 'colorpicker',
        'desc'        => esc_html__('Change the icon color for the mobile icon', 'thevoux'),
        'section'     => 'customization',
        'std'		  => ''
      ),
      array(
        'label'       => esc_html__('Search & Social Icon Colors', 'thevoux'),
        'id'          => 'headericon_color',
        'type'        => 'colorpicker',
        'desc'        => esc_html__('Change the icon colors for the social and the search on the header', 'thevoux'),
        'section'     => 'customization',
        'std'		  => ''
      ),
      array(
        'label'       => esc_html__('Main Menu Top Level Link Colors', 'thevoux'),
        'id'          => 'menu_link_color',
        'type'        => 'link_color',
        'desc'        => esc_html__('This changes link colors on the full menu', 'thevoux'),
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Widget Title Color', 'thevoux'),
        'id'          => 'widgettitle_color',
        'type'        => 'colorpicker',
        'desc'        => esc_html__('Change the title color for the widgets', 'thevoux'),
        'section'     => 'customization',
        'std'		  => ''
      ),
      array(
        'id'          => 'customization_tab2',
        'label'       => esc_html__('Typography', 'thevoux'),
        'type'        => 'tab',
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Font Subsets', 'thevoux'),
        'id'          => 'font_subsets',
        'type'        => 'radio',
        'desc'        => esc_html__('You can add additional character subset specific to your language.', 'thevoux'),
        'choices'     => array(
        	array(
        	  'label'       => esc_html__('No Subset', 'thevoux'),
        	  'value'       => 'no-subset'
        	),
          array(
            'label'       => esc_html__('Greek', 'thevoux'),
            'value'       => 'greek'
          ),
          array(
            'label'       => esc_html__('Cyrillic', 'thevoux'),
            'value'       => 'cyrillic'
          ),
          array(
            'label'       => esc_html__('Vietnamese', 'thevoux'),
            'value'       => 'vietnamese'
          )
        ),
        'std'         => 'no-subset',
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Title Typography', 'thevoux'),
        'id'          => 'title_type',
        'type'        => 'typography',
        'desc'        => esc_html__('Font Settings for the titles', 'thevoux'),
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Body Text Typography', 'thevoux'),
        'id'          => 'body_type',
        'type'        => 'typography',
        'desc'        => esc_html__('Font Settings for general body font', 'thevoux'),
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Article Title Typography', 'thevoux'),
        'id'          => 'article_title_type',
        'type'        => 'typography',
        'desc'        => esc_html__('Font Settings for the article title font. Only affects the article pages', 'thevoux'),
        'section'     => 'customization'
      ),
	  	array(
        'label'       => esc_html__('Main Menu Typography', 'thevoux'),
        'id'          => 'menu_type',
        'type'        => 'typography',
        'desc'        => esc_html__('Font Settings for the main menu, only affects the top level elements', 'thevoux'),
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Sub Menu Typography', 'thevoux'),
        'id'          => 'submenu_type',
        'type'        => 'typography',
        'desc'        => esc_html__('Font Settings for the sub-menu', 'thevoux'),
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Widget Title Typography', 'thevoux'),
        'id'          => 'widget_title_type',
        'type'        => 'typography',
        'desc'        => esc_html__('Font Settings for the widget titles', 'thevoux'),
        'section'     => 'customization'
      ),
      array(
        'id'          => 'customization_tab3',
        'label'       => esc_html__('Typekit Support', 'thevoux'),
        'type'        => 'tab',
        'section'     => 'customization'
      ),
      array(
        'id'          => 'typekit_text',
        'label'       => esc_html__('About Typekit Support', 'thevoux'),
        'desc'        => esc_html__('Please make sure that you enter your Typekit ID or the fonts wont work. After adding Typekit Font Names, these names will appear on the font selection dropdown on the Typography tab.', 'thevoux'),
        'type'        => 'textblock',
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Typekit Kit ID', 'thevoux'),
        'id'          => 'typekit_id',
        'type'        => 'text',
        'desc'        => esc_html__('Paste the provided Typekit Kit ID. <small>Usually 6-7 random letters</small>', 'thevoux'),
        'section'     => 'customization',
      ),
      array(
        'label'       => esc_html__('Typekit Font Names', 'thevoux'),
        'id'          => 'typekit_fonts',
        'type'        => 'text',
        'desc'        => esc_html__('Enter your Typekit Font Name, seperated by comma. For example: futura-pt,aktiv-grotesk <strong>Do not leave spaces between commas</strong>', 'thevoux'),
        'section'     => 'customization',
      ),
      array(
        'id'          => 'customization_tab4',
        'label'       => esc_html__('Backgrounds', 'thevoux'),
        'type'        => 'tab',
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Header Background', 'thevoux'),
        'id'          => 'header_bg',
        'type'        => 'background',
        'desc'        => esc_html__('Background settings for the menu.', 'thevoux'),
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Menu Background', 'thevoux'),
        'id'          => 'menu_bg',
        'type'        => 'background',
        'desc'        => esc_html__('Background settings for the menu.', 'thevoux'),
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Mega Menu / Sub Menu Background', 'thevoux'),
        'id'          => 'megamenu_bg',
        'type'        => 'background',
        'desc'        => esc_html__('Background settings for the mega menu and the submenus.', 'thevoux'),
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Footer Background', 'thevoux'),
        'id'          => 'footer_bg',
        'type'        => 'background',
        'desc'        => esc_html__('Background settings for the footer', 'thevoux'),
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Sub - Footer Background', 'thevoux'),
        'id'          => 'subfooter_bg',
        'type'        => 'background',
        'desc'        => esc_html__('Background settings for the sub-footer', 'thevoux'),
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Widget Title Background', 'thevoux'),
        'id'          => 'widgettitle_bg',
        'type'        => 'colorpicker',
        'desc'        => esc_html__('Background color for the widget title', 'thevoux'),
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Header Style 3', 'thevoux'),
        'id'          => 'adv_headerstyle3',
        'type'        => 'textarea',
        'desc'        => esc_html__('This content appears inside Header Style-3', 'thevoux'),
        'rows'        => '4',
        'section'     => 'advertising'
      ),
      array(
        'label'       => esc_html__('Post End', 'thevoux'),
        'id'          => 'adv_postend',
        'type'        => 'textarea',
        'desc'        => esc_html__('This content appears at the bottom of the articles.', 'thevoux'),
        'rows'        => '4',
        'section'     => 'advertising'
      ),
      array(
        'label'       => esc_html__('Post End for Ajax loaded articles', 'thevoux'),
        'id'          => 'adv_postend_ajax',
        'type'        => 'textarea',
        'desc'        => esc_html__('This content appears at the bottom of the articles of ajax loaded articles.', 'thevoux'),
        'rows'        => '4',
        'section'     => 'advertising'
      ),
      array(
        'label'       => esc_html__('Gallery Header', 'thevoux'),
        'id'          => 'adv_gallery_header',
        'type'        => 'textarea',
        'desc'        => esc_html__('This content appears at the top of the galleries', 'thevoux'),
        'rows'        => '4',
        'section'     => 'advertising'
      )
    )
  );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( 'option_tree_settings', $custom_settings ); 
  }
}
/**
 * Category Colorpicker option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_category_colorpicker' ) ) {
  
  function ot_type_category_colorpicker( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
    
    /* verify a description */
    $has_desc = $field_desc ? true : false;
    
    $args = array(
    	'type'                     => 'post',
    	'child_of'                 => 0,
    	'parent'                   => '',
    	'orderby'                  => 'name',
    	'order'                    => 'ASC',
    	'hide_empty'               => 0,
    	'hierarchical'             => 0,
    	'exclude'                  => '',
    	'include'                  => '',
    	'number'                   => '',
    	'taxonomy'                 => 'category',
    	'pad_counts'               => false 
    
    );
    global $sitepress;
    
    if ($sitepress) {
    	remove_filter('terms_clauses', array($sitepress, 'terms_clauses'));
    }
    $categories = get_terms( 'category', array( 'hide_empty'    => false, ) );
    
    foreach ($categories as $category) {
    	$field_id = 'category_colors-'.$category->term_id.'';
    	$field_name = 'option_tree[category_colors]['.$category->term_id.']';
    	
    	/* format setting outer wrapper */
	    echo '<div class="format-setting type-colorpicker has-desc format-settings">';
	      
	      /* description */
	      echo '<div class="description">Category color for <strong>' . $category->name . '</strong></div>';
	      
	      /* format setting inner wrapper */
	      echo '<div class="format-setting-inner">'; 
	        
	        /* build colorpicker */  
	        echo '<div class="option-tree-ui-colorpicker-input-wrap">';
	          
	          /* colorpicker JS */      
	          echo '<script>jQuery(document).ready(function($) { OT_UI.bind_colorpicker("' . esc_attr( $field_id ) . '"); });</script>';
	          
	          /* set the default color */
	          $std = $field_std ? 'data-default-color="' . $field_std . '"' : '';
	          
	          /* input */
	          echo '<input type="text" name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" value="' . esc_attr( isset($field_value[$category->term_id]) ? $field_value[$category->term_id] : '' ) . '" class="hide-color-picker ' . esc_attr( $field_class ) . '" ' . $std . ' />';
	        
	        echo '</div>';
	      
	      echo '</div>';
	
	    echo '</div>';
    }
    
    
  }
  
}
/**
 * Category Header option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_category_header' ) ) {
  
  function ot_type_category_header( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
    
    /* verify a description */
    $has_desc = $field_desc ? true : false;
    
    $args = array(
    	'type'                     => 'post',
    	'child_of'                 => 0,
    	'parent'                   => '',
    	'orderby'                  => 'name',
    	'order'                    => 'ASC',
    	'hide_empty'               => 0,
    	'hierarchical'             => 0,
    	'exclude'                  => '',
    	'include'                  => '',
    	'number'                   => '',
    	'taxonomy'                 => 'category',
    	'pad_counts'               => false 
    
    );
    global $sitepress;
    
    if ($sitepress) {
    	remove_filter('terms_clauses', array($sitepress, 'terms_clauses'));
    }
    $categories = get_terms( 'category', array( 'hide_empty'    => false, ) );

    foreach ($categories as $category) {
	    	$field_id = 'category_header-'.$category->term_id;
	    	$field_id_color = 'category_header-'.$category->term_id.'-color';
	    	$field_name_bg = 'option_tree[category_headers]['.$category->term_id.'][bg]';
	    	$field_name_color = 'option_tree[category_headers]['.$category->term_id.'][color]';
	    	
	    	$background = isset( $field_value[$category->term_id]['bg'] ) ? $field_value[$category->term_id]['bg'] : '';
	    	$color = isset( $field_value[$category->term_id]['color'] ) ? $field_value[$category->term_id]['color'] : '';
				
				/* format setting outer wrapper */
		    echo '<div class="format-setting type-colorpicker has-desc format-settings">';
		      
		      /* description */
		      echo '<div class="description">Category Title Color for <strong>' . $category->name . '</strong></div>';
		      
		      /* format setting inner wrapper */
		      echo '<div class="format-setting-inner">'; 
		        
		        /* build colorpicker */  
		        echo '<div class="option-tree-ui-colorpicker-input-wrap">';
		          
		          /* colorpicker JS */      
		          echo '<script>jQuery(document).ready(function($) { OT_UI.bind_colorpicker("' . esc_attr( $field_id_color ) . '"); });</script>';
		          
		          /* set the default color */
		          $std = $field_std ? 'data-default-color="' . $field_std . '"' : '';
		          
		          /* input */
		          echo '<input type="text" name="' . esc_attr( $field_name_color ) . '" id="' . esc_attr( $field_id_color ) . '" value="' . esc_attr( $color ) . '" class="hide-color-picker ' . esc_attr( $field_class ) . '" ' . $std . ' />';
		        
		        echo '</div>';
		      
		      echo '</div>';
		
		    echo '</div>';
				    
	    	/* If an attachment ID is stored here fetch its URL and replace the value */
	    	if ( $background && wp_attachment_is_image( $background ) ) {
	    	
	    	  $attachment_data = wp_get_attachment_image_src( $background, 'original' );
	    	  
	    	  /* check for attachment data */
	    	  if ( $attachment_data ) {
	    	  
	    	    $field_src = $attachment_data[0];
	    	    
	    	  }
	    	  
	    	}
	    	
	    	/* format setting outer wrapper */
	    	echo '<div class="format-setting-wrap"><div class="format-setting type-upload ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
	    	  
	    	  /* description */
	    	  echo $has_desc ? '<div class="description">Category header for <strong>' . $category->name . '</strong></div>' : '';
	    	  
	    	  /* format setting inner wrapper */
	    	  echo '<div class="format-setting-inner">';
	    	  
	    	    /* build upload */
	    	    echo '<div class="option-tree-ui-upload-parent">';
	    	     
	    	     	
	    	     	
	    	      /* input */
	    	      echo '<input type="text" name="' . esc_attr( $field_name_bg ) . '" id="' . esc_attr( $field_id ) . '" value="' . esc_attr( $background ) . '" class="widefat option-tree-ui-upload-input ' . esc_attr( $field_class ) . '" />';
	    	      
	    	      /* add media button */
	    	      echo '<a href="javascript:void(0);" class="ot_upload_media option-tree-ui-button button button-primary light" rel="' . $post_id . '" title="' . __( 'Add Media', 'thevoux' ) . '"><span class="icon ot-icon-plus-circle"></span>' . __( 'Add Media', 'thevoux' ) . '</a>';
	    	    
	    	    echo '</div>';
	    	    
	    	    /* media */
	    	    if ( $background ) {
	    	        
	    	      echo '<div class="option-tree-ui-media-wrap" id="' . esc_attr( $field_id ) . '_media">';
	    	        
	    	        /* replace image src */
	    	        if ( isset( $field_src ) )
	    	          $field_value = $field_src;
	    	          
	    	        if ( preg_match( '/\.(?:jpe?g|png|gif|ico)$/i', $background ) )
	    	          echo '<div class="option-tree-ui-image-wrap"><img src="' . esc_url( $background ) . '" alt="" /></div>';
	    	        
	    	        echo '<a href="javascript:(void);" class="option-tree-ui-remove-media option-tree-ui-button button button-secondary light" title="' . __( 'Remove Media', 'thevoux' ) . '"><span class="icon ot-icon-minus-circle"></span>' . __( 'Remove Media', 'thevoux' ) . '</a>';
	    	        
	    	      echo '</div>';
	    	      
	    	    }
	    	    
	    	  echo '</div>';
	    	
	    	echo '</div></div>';
    }
    
    
  }
  
}

/**
 * Menu Select option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_menu_select' ) ) {
  
  function ot_type_menu_select( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
    
    /* verify a description */
    $has_desc = $field_desc ? true : false;
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-category-select ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
      
      /* description */
      echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '';
      
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
      
        /* build category */
        echo '<select name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" class="option-tree-ui-select ' . $field_class . '">';
        
        /* get category array */
        $menus = get_terms( 'nav_menu');
        
        /* has cats */
        if ( ! empty( $menus ) ) {
          echo '<option value="">-- ' . __( 'Choose One', 'thevoux' ) . ' --</option>';
          foreach ( $menus as $menu ) {
            echo '<option value="' . esc_attr( $menu->slug ) . '"' . selected( $field_value, $menu->slug, false ) . '>' . esc_attr( $menu->name ) . '</option>';
          }
        } else {
          echo '<option value="">' . __( 'No Menus Found', 'thevoux' ) . '</option>';
        }
        
        echo '</select>';
      
      echo '</div>';
    
    echo '</div>';
    
  }
  
}