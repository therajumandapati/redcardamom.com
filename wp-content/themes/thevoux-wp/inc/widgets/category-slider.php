<?php
// thb Category Slider
class widget_categoryslider extends WP_Widget {
	function __construct() {
		$widget_ops = array(
		'classname'   => 'widget_categoryslider',
		'description' => __('Display category posts in a slider','thevoux')
		);
		
		parent::__construct(
		'thb_categoryslider_widget',
		__( 'Fuel Themes - Category Slider' , 'thevoux' ),
		$widget_ops
		);
			
		$this->defaults = array( 'title' => 'Category', 'show' => '3', 'category' => '' );
	}

       function widget($args, $instance) {
			extract($args);
			$title = apply_filters('widget_title', $instance['title']);
			$show = $instance['show'];
			$category = $instance['category'];
			
			$args = array(
				'nopaging' => 0,
				'cat' => $category,
				'post_type'=>'post', 
				'post_status' => 'publish', 
				'ignore_sticky_posts' => 1,
				'no_found_rows' => true,
				'suppress_filters' => 0,
				'posts_per_page' => $show
			);
			
			$posts = new WP_Query( $args );

               echo $before_widget;
               echo ($title ? $before_title . $title . $after_title : '');
               echo '<div class="slick dark-pagination" data-columns="1" data-pagination="true" data-navigation="false">';
               while  ($posts->have_posts()) : $posts->the_post(); ?>
               <?php add_filter( 'excerpt_length', 'thb_widget_excerpt_length' ); ?>
	           <div class="post text-center">
	           	   <figure class="post-gallery">
		               	<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thevoux-style3'); ?></a>
	               </figure>
	               <header class="post-title">
	               		<h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
	               </header>
	               <div class="post-content small">
	               		<?php the_excerpt(); ?>
	               </div>
	           </div>
	           <?php endwhile;
               echo '</div>';
               echo $after_widget;
               
               wp_reset_query();
       }
       function update( $new_instance, $old_instance ) {
               $instance = $old_instance;

               /* Strip tags (if needed) and update the widget settings. */
               $instance['title'] = strip_tags( $new_instance['title'] );
               $instance['show'] = strip_tags( $new_instance['show'] );
			   $instance['category'] = strip_tags( $new_instance['category'] );
               return $instance;
       }
       function form($instance) {
               $defaults = $this->defaults;
               $instance = wp_parse_args( (array) $instance, $defaults ); 
               $categories = get_categories(); ?>
               					
               				 
               				 
               <p>
                       <label for="<?php echo $this->get_field_id( 'title' ); ?>">Widget Title:</label>
                       <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
               </p>
               
               <p>
               	         <label for="<?php echo $this->get_field_id( 'category' ); ?>">Category:</label>
               	         <select id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>" style="width:100%;">
               	         	<?php foreach( $categories as $category) { ?>
               	         	<option value="<?php echo $category->cat_ID; ?>" <?php if ($category->cat_ID == $instance['category']) { echo 'selected="selected"';} ?>><?php echo $category->cat_name; ?></option>
               	         	<?php } ?>
               	         </select>
               	 </p>

               <p>
                       <label for="<?php echo $this->get_field_id( 'name' ); ?>">Number of Posts:</label>
                       <input id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'show' ); ?>" value="<?php echo $instance['show']; ?>" style="width:100%;" />
               </p>
   <?php
       }
}
function widget_categoryslider_init()
{
       register_widget('widget_categoryslider');
}
add_action('widgets_init', 'widget_categoryslider_init');