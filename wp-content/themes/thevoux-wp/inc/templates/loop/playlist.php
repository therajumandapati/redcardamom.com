<?php 
	$id = get_the_ID();
	$embed = get_post_meta($id , 'post_video', TRUE);
	$vars = $wp_query->query_vars;
	$active = array_key_exists('active', $vars) ? $vars['active'] : false;
?>
<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="video_play <?php echo esc_attr($active); ?>" data-video-url="<?php echo esc_attr($embed); ?>" data-post-id="<?php echo esc_attr($id); ?>">
	<span><i class="fa fa-play"></i></span>
	<?php echo wp_strip_all_tags(get_the_title()); ?>
</a>