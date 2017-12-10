<?php
	$vars = $wp_query->query_vars;
	$thb_image_size = array_key_exists('thb_image_size', $vars) ? $vars['thb_image_size'] : 'thevoux-single';
?>
<?php if ( has_post_thumbnail() ) { ?>
	<?php $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), $thb_image_size); ?>
	<figure class="post-gallery">
		<?php the_post_thumbnail($thb_image_size); ?>
	</figure>
<?php } else { ?>
	<p class="text-center"><strong><?php _e('Please select a featured image for your post', 'thevoux'); ?></strong></p>
<?php } ?>