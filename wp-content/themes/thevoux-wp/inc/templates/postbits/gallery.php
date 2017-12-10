<?php
	$vars = $wp_query->query_vars;
	$thb_image_size = array_key_exists('thb_image_size', $vars) ? $vars['thb_image_size'] : 'thevoux-single';
	
	$post_gallery_photos = get_post_meta($id, 'post-gallery-photos', true);
	if ($post_gallery_photos) {
		$post_gallery_photos_arr = explode(',', $post_gallery_photos);
		$count = sizeof($post_gallery_photos_arr);
	}
?>
<?php if ( has_post_thumbnail() ) { ?>
	<figure class="post-gallery">
		<?php $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), $thb_image_size); ?>
		<?php the_post_thumbnail($thb_image_size); ?>
		<?php if ($post_gallery_photos) { ?>
		<a href="#post-gallery-<?php the_ID(); ?>" class="gallery-link" data-class="post-gallery-lightbox">
			<?php get_template_part('assets/svg/gallery.svg'); ?>
			<div>
				<?php _e('View Gallery', 'thevoux'); ?><br>
				<em><?php echo esc_attr($count); ?> <?php _e('Photos', 'thevoux'); ?></em>
			</div>
		</a>
		<?php } else { ?>
		<a href="#" class="gallery-link empty" data-class="post-gallery-lightbox"><div class="rel"><?php _e('Please Add Photos <br> to your Gallery', 'thevoux'); ?></div></a>
		<?php } ?>
	</figure>
<?php } else { ?>
	<p class="text-center"><strong><?php _e('Please select a featured image for your post', 'thevoux'); ?></strong></p>
<?php } ?>
<?php get_template_part( 'inc/templates/postbits/post-gallery' ); ?>