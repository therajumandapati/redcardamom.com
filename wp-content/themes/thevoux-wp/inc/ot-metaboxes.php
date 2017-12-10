<?php
/**
 * Initialize the meta boxes. 
 */
add_action( 'admin_init', '_custom_meta_boxes' );

/**
 * Meta Boxes demo code.
 *
 * You can find all the available option types
 * in demo-theme-options.php.
 *
 * @return    void
 *
 * @access    private
 * @since     2.0
 */


function _custom_meta_boxes() {

  /**
   * Create a custom meta boxes array that we pass to 
   * the OptionTree Meta Box API Class.
   */
  
  $post_metabox = array(  
    'id'          => 'post_meta_style',
    'title'       => 'Post Settings',
    'pages'       => array( 'post' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
    	array(
    	  'id'          => 'tab1',
    	  'label'       => 'Style',
    	  'type'        => 'tab'
    	),
    	array(
    	  'label'       => esc_html__('Override Default Article Style?', 'thevoux'),
    	  'id'          => 'article_style_override',
    	  'type'        => 'on_off',
    	  'desc'        => esc_html__('You can change the article style here', 'thevoux'),
    	  'std'         => 'off'
    	),
      array(
        'label'       => 'Article Style',
        'id'          => 'post-style',
        'type'        => 'radio',
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
        'std'		  => 'style1',
        'desc'        => 'Which post style would you like to use?',
        'condition'   => 'article_style_override:is(on)'
      ),
      array(
        'label'       => 'Top Image',
        'id'          => 'post-top-image',
        'type'        => 'upload',
        'desc'        => 'The image to display on top.',
        'operator' 		=> 'or',
        'condition'   => 'post-style:is(style2),post-style:is(style3)'
      ),
      array(
        'id'          => 'tab2',
        'label'       => 'Review Settings',
        'type'        => 'tab'
      ),
      array(
        'label'       => 'Is this a review post?',
        'id'          => 'is_review',
        'type'        => 'radio',
        'desc'        => 'Select yes, if you would like to display review settings',
        'choices'     => array(
          array(
            'label'       => 'Yes',
            'value'       => 'yes'
          ),
          array(
            'label'       => 'No',
            'value'       => 'no'
          )
        ),
        'std'         => 'no'
      ),
      array(
        'label'       => 'Review Title',
        'id'          => 'post_ratings_title',
        'type'        => 'text',
        'desc'        => 'Title of the review',
        'condition'   => 'is_review:is(yes)'
      ),
      array(
        'label'       => 'Ratings',
        'id'          => 'post_ratings_percentage',
        'type'        => 'list-item',
        'desc'        => 'Please add ratings to rate this review for',
        'settings'    => array(
          array(
            'label'       => 'Score',
            'id'          => 'feature_score',
            'desc'        => 'Value should be between 0-10',
            'std'         => '5',
            'type'        => 'numeric-slider',
            'min_max_step'=> '0,10,1'
          )
        ),
        'condition'   => 'is_review:is(yes)'
      ),
      array(
        'label'       => 'Comments Positive/Negative',
        'id'          => 'post_ratings_comments',
        'type'        => 'list-item',
        'desc'        => 'Please add comments',
        'settings'    => array(
          array(
            'label'       => 'Comment Type',
            'id'          => 'feature_comment_type',
            'type'        => 'radio',
            'desc'        => 'Is this a negative or a positive comment?',
            'choices'     => array(
              array(
                'label'       => 'Positive',
                'value'       => 'positive'
              ),
              array(
                'label'       => 'Negative',
                'value'       => 'negative'
              )
            ),
            'std'         => 'negative'
          ),
        ),
        'condition'   => 'is_review:is(yes)'
      ),
      array(
        'id'          => 'tab3',
        'label'       => 'Video',
        'type'        => 'tab'
      ),
      array(
        'id'          => 'video_post_layout_text',
        'label'       => 'About Video Settings',
        'desc'        => 'These layouts are used for "Video" post format.',
        'type'        => 'textblock'
      ),
      array(
        'label'       => 'Video URL',
        'id'          => 'post_video',
        'type'        => 'text',
        'desc'        => 'Video URL. You can find a list of websites you can embed here: <a href="http://codex.wordpress.org/Embeds">Wordpress Embeds</a>',
        'std'         => ''
      ),
    )
  );
  $post_metabox_gallery = array(  
    'id'          => 'post_meta_gallery',
    'title'       => 'Post Gallery',
    'pages'       => array( 'post' ),
    'context'     => 'side',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'label'       => 'Post Gallery',
        'id'          => 'post-gallery-photos',
        'type'        => 'gallery',
        'desc'        => 'The image captions will be used as image information on the right side.'
      )
    )
  );
  
  /**
   * Register our meta boxes using the 
   * ot_register_meta_box() function.
   */
	ot_register_meta_box( $post_metabox );
  ot_register_meta_box( $post_metabox_gallery );
}