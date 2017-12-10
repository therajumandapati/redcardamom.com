<?php
// thb Social counter
class widget_socialcounter extends WP_Widget { 

	function __construct() {
		$widget_ops = array(
			'classname'   => 'widget_socialcounter',
			'description' => __('Display a Social Counter','thevoux')
		);
		
		parent::__construct(
			'thb_socialcounter_widget',
			__( 'Fuel Themes - Social Counter' , 'thevoux' ),
			$widget_ops
		);
				
		$this->defaults = array( 
			'title' => 'Social Counter', 
			'show' => '3', 
			'Twitter' => false, 
			'Facebook' => false, 
			'Instagram' => false, 
			'Google' => false, 
			'Debug' => false );
	}
	
	function widget($args, $instance) {
		extract($args);
		$twitter = $instance['Twitter'];
		$facebook = $instance['Facebook'];
		$instagram = $instance['Instagram'];
		$google = $instance['Google'];
		$debug = isset($instance['Debug']) ? $instance['Debug'] : false;
		// Output
		echo $before_widget;
		?>
			<ul>
				<?php if ($facebook) { ?>
				<li><a href="http://facebook.com/<?php echo ot_get_option('facebook_page_username'); ?>" class="facebook" target="_blank"><i class="fa fa-facebook"></i> <?php do_action('thb_fbLikeCount', ot_get_option('facebook_page_id'), $debug); ?> <em><?php _e('Likes', 'thevoux'); ?></em> <span><?php _e('LIKE', 'thevoux'); ?></span></a></li>
				<?php } ?>
				<?php if ($twitter) { ?>
				<li><a href="http://twitter.com/<?php echo ot_get_option('twitter_bar_username'); ?>" class="twitter" target="_blank"><i class="fa fa-twitter"></i> <?php do_action('thb_twFollowerCount', $debug); ?> <em><?php _e('Followers', 'thevoux'); ?></em> <span><?php _e('FOLLOW', 'thevoux'); ?></span></a></li>
				<?php } ?>
				<?php if ($instagram) { ?>
				<li><a href="http://instagram.com/<?php echo ot_get_option('instagram_username'); ?>" class="instagram" target="_blank"><i class="fa fa-instagram"></i> <?php do_action('thb_insFollowerCount'); ?> <em><?php _e('Followers', 'thevoux'); ?></em> <span><?php _e('FOLLOW', 'thevoux'); ?></span></a></li>
				<?php } ?>
				<?php if ($google) { ?>
				<li><a href="https://plus.google.com/<?php echo ot_get_option('gp_username'); ?>" class="google-plus" target="_blank"><i class="fa fa-google-plus"></i> <?php do_action('thb_gpFollowerCount'); ?> <em><?php _e('Fans', 'thevoux'); ?></em> <span><?php _e('LIKE', 'thevoux'); ?></span></a></li>
				<?php } ?>
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
		$instance['Debug'] = strip_tags( $new_instance['Debug'] );
		return $instance;
	}
	// Settings form
	function form($instance) {
		$defaults = array(
			'Twitter' => false,
			'Facebook' => false,
			'Instagram' => false,
			'Google' => false,
			'Debug' => false,
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		?>

			<p>
		    <input id="<?php echo $this->get_field_id('Twitter'); ?>" name="<?php echo $this->get_field_name('Twitter'); ?>" type="checkbox" <?php if ($instance['Twitter']) { ?>checked="checked" <?php } ?> />
		    <label for="<?php echo $this->get_field_id('Twitter'); ?>"><?php _e('Display Twitter Counter?', 'thevoux'); ?></label>
		    <small><?php _e('Please make sure you fill out the settings inside Theme Options -> Twitter Oauth for Twitter Counts', 'thevoux'); ?></small>
			</p>
			<p>
			  <input id="<?php echo $this->get_field_id('Facebook'); ?>" name="<?php echo $this->get_field_name('Facebook'); ?>" type="checkbox" <?php if ($instance['Facebook']) { ?>checked="checked" <?php } ?> />
			  <label for="<?php echo $this->get_field_id('Facebook'); ?>"><?php _e('Display Facebook Counter?', 'thevoux'); ?></label>
			  <small><?php _e('Please make sure you fill out the settings inside Theme Options -> Facebook Oauth for Facebook Counts', 'thevoux'); ?></small>
			</p>
			<p>
			  <input id="<?php echo $this->get_field_id('Instagram'); ?>" name="<?php echo $this->get_field_name('Instagram'); ?>" type="checkbox" <?php if ($instance['Instagram']) { ?>checked="checked" <?php } ?> />
			  <label for="<?php echo $this->get_field_id('Instagram'); ?>"><?php _e('Display Instagram Counter?', 'thevoux'); ?></label>
			  <small><?php _e('Please make sure you fill out the settings inside Theme Options -> Instagram Oauth for Instagram Counts', 'thevoux'); ?></small>
			</p>
			<p>
			  <input id="<?php echo $this->get_field_id('Google'); ?>" name="<?php echo $this->get_field_name('Google'); ?>" type="checkbox" <?php if ($instance['Google']) { ?>checked="checked" <?php } ?> />
			  <label for="<?php echo $this->get_field_id('Google'); ?>"><?php _e('Display Google+ Counter?', 'thevoux'); ?></label>
			  <small><?php _e('Please make sure you fill out the settings inside Theme Options -> Google+ Oauth for Google Counts', 'thevoux'); ?></small>
			</p>
			<p>
			  <input id="<?php echo $this->get_field_id('Debug'); ?>" name="<?php echo $this->get_field_name('Debug'); ?>" type="checkbox" <?php if ($instance['Debug']) { ?>checked="checked" <?php } ?> />
			  <label for="<?php echo $this->get_field_id('Debug'); ?>"><?php _e('Debug Mode','thevoux'); ?></label>
			  <small><?php _e('Enable this to see what is returned from social network sites.','thevoux'); ?></small>
			</p>
    <?php
	}
}
function widget_socialcounter_init()
{
	register_widget('widget_socialcounter');
}
add_action('widgets_init', 'widget_socialcounter_init');