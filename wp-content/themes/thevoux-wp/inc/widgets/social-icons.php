<?php
// thb Social counter
class widget_socialicons extends WP_Widget { 

	function __construct() {
		$widget_ops = array(
			'classname'   => 'widget_socialicons',
			'description' => __('Display Social Icons','thevoux')
		);
		
		parent::__construct(
			'thb_socialicons_widget',
			__( 'Fuel Themes - Social Icons' , 'thevoux' ),
			$widget_ops
		);
				
		$this->defaults = array( 
			'title' => 'Social Icons', 
			'Twitter' => false, 
			'Facebook' => false, 
			'Instagram' => false, 
			'Google' => false,
			'SnapChat' => false );
	}
	
	function widget($args, $instance) {
		extract($args);
		$twitter = $instance['Twitter'];
		$facebook = $instance['Facebook'];
		$instagram = $instance['Instagram'];
		$google = $instance['Google'];
		$snapchat = $instance['SnapChat'];
		// Output
		echo $before_widget;
		
		
		?>
			<ul class="row small-up-<?php echo esc_attr(count(array_filter($instance))); ?>">
				<?php foreach ($instance as $ins => $value) { if ($value) {  ?>
					<li class="column"><a href="<?php echo esc_url($value); ?>" class="social <?php echo esc_attr(strtolower($ins)); ?>" target="_blank"><i class="fa fa-<?php echo esc_attr(strtolower($ins)); ?>"></i></a></li>
				<?php } } ?>
			</ul>
		<?php
		echo $after_widget;
	}
	function update( $new_instance, $old_instance ) {  
		$instance = $old_instance; 
		
		$instance['Twitter'] = strip_tags( $new_instance['Twitter'] );
		$instance['Facebook'] = strip_tags( $new_instance['Facebook'] );
		$instance['Instagram'] = strip_tags( $new_instance['Instagram'] );
		$instance['Google'] = strip_tags( $new_instance['Google'] );
		$instance['SnapChat'] = strip_tags( $new_instance['SnapChat'] );
		return $instance;
	}
	// Settings form
	function form($instance) {
		$defaults = array(
			'Twitter' => false,
			'Facebook' => false,
			'Instagram' => false,
			'Google' => false,
			'SnapChat' => false,
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		?>

			<p>
		    <label for="<?php echo $this->get_field_id( 'Twitter' ); ?>">Twitter Link:</label>
		    <input id="<?php echo $this->get_field_id( 'Twitter' ); ?>" name="<?php echo $this->get_field_name( 'Twitter' ); ?>" value="<?php echo $instance['Twitter']; ?>" class="widefat" />
			</p>
			<p>
			  <label for="<?php echo $this->get_field_id( 'Facebook' ); ?>">Facebook Link:</label>
			  <input id="<?php echo $this->get_field_id( 'Facebook' ); ?>" name="<?php echo $this->get_field_name( 'Facebook' ); ?>" value="<?php echo $instance['Facebook']; ?>" class="widefat" />
			</p>
			<p>
			  <label for="<?php echo $this->get_field_id( 'Instagram' ); ?>">Instagram Link:</label>
			  <input id="<?php echo $this->get_field_id( 'Instagram' ); ?>" name="<?php echo $this->get_field_name( 'Instagram' ); ?>" value="<?php echo $instance['Instagram']; ?>" class="widefat" />
			</p>
			<p>
			  <label for="<?php echo $this->get_field_id( 'Google' ); ?>">Google Link:</label>
			  <input id="<?php echo $this->get_field_id( 'Google' ); ?>" name="<?php echo $this->get_field_name( 'Google' ); ?>" value="<?php echo $instance['Google']; ?>" class="widefat" />
			</p>
			<p>
			  <label for="<?php echo $this->get_field_id( 'SnapChat' ); ?>">SnapChat Link:</label>
			  <input id="<?php echo $this->get_field_id( 'SnapChat' ); ?>" name="<?php echo $this->get_field_name( 'SnapChat' ); ?>" value="<?php echo $instance['SnapChat']; ?>" class="widefat" />
			</p>
    <?php
	}
}
function widget_socialicons_init()
{
	register_widget('widget_socialicons');
}
add_action('widgets_init', 'widget_socialicons_init');