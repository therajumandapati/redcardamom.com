<?php
// thb Featured Video
class widget_thbabout extends WP_Widget { 
	function __construct() {
	   $widget_ops = array(
	   		'classname'   => 'widget_about',
	   		'description' => __('Display your information','thevoux')
	   	);
	   
	   	parent::__construct(
	   		'thb_about_widget',
	   		__( 'Fuel Themes - About Me' , 'thevoux' ),
	   		$widget_ops
	   	);
	   			
	   	$this->defaults = array( 'title' => 'About Me', 'image' => '', 'image_alt' => '', 'description' => '' );
	   	
	   	add_action('admin_enqueue_scripts', array($this, 'thb_assets'));
	}
	
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$description = $instance['description'];
		$image = $instance['image'];
		$image_alt = $instance['image_alt'];
		// Output
		echo $before_widget;
		echo ($title ? $before_title . $title . $after_title : '');
		
		?>
			<figure>
				<img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($image_alt); ?>" />
			</figure>
		<?php
		if ($description) {
			echo wpautop($description);	
		}
		
		echo $after_widget;
	}
	function thb_assets() {
	    wp_enqueue_media();
	    
	    wp_localize_script( 'thb-admin-meta', 'ThbImageWidget', array(
	    	'frame_title' => __( 'Select an Image', 'thevoux' ),
	    	'button_title' => __( 'Insert Into Widget', 'thevoux' ),
	    ) );
	}
	function update( $new_instance, $old_instance ) {  
		$instance = $old_instance; 
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['image'] = strip_tags( $new_instance['image'] );
		$instance['image_alt'] = strip_tags( $new_instance['image_alt'] );
		$instance['description'] = $new_instance['description'];

		return $instance;
	}
	// Settings form
	function form($instance) {
		$defaults = $this->defaults;
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
    
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Widget Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		<p>
	    <label for="<?php echo $this->get_field_name( 'image' ); ?>"><?php _e( 'Image:' ); ?></label>
	    <input name="<?php echo $this->get_field_name( 'image' ); ?>" id="<?php echo $this->get_field_id( 'image' ); ?>" class="widefat" type="text" size="36"  value="<?php echo $instance['image']; ?>" />
	    <input class="thb-upload-image button" type="button" value="Upload Image" onclick="ThbImage.uploader( '<?php echo $this->id; ?>', '<?php echo $this->get_field_id( 'image' ); ?>', '<?php echo $this->get_field_id( 'image_alt' ); ?>' ); return false;" />
	    <input name="<?php echo $this->get_field_name( 'image_alt' ); ?>" id="<?php echo $this->get_field_id( 'image_alt' ); ?>"  type="hidden" value="<?php echo $instance['image_alt']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'description' ); ?>">Your Description:</label>
			<textarea id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>" class="widefat" rows="5"><?php echo esc_textarea($instance['description']); ?></textarea>
		</p>
    <?php
	}
}
function widget_thbabout_init()
{
	register_widget('widget_thbabout');
}
add_action('widgets_init', 'widget_thbabout_init');