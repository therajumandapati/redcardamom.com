<?php
	$post_gallery_photos = get_post_meta($id, 'post-gallery-photos', true);
	if ($post_gallery_photos) {
		$post_gallery_photos_arr = explode(',', $post_gallery_photos);
		$count = sizeof($post_gallery_photos_arr);
	}
?>
<?php if ( has_post_thumbnail() ) { ?>
	<figure class="post-gallery" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
		<?php $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thevoux-single'); ?>
		<?php the_post_thumbnail('thevoux-single', array('itemprop'=>'url')); ?>
		<meta itemprop="width" content="<?php echo esc_attr($featured_image[1]); ?>" />
		<meta itemprop="height" content="<?php echo esc_attr($featured_image[2]); ?>" />
		<?php if ($post_gallery_photos) { ?>
		<a href="#post-gallery-<?php the_ID(); ?>" class="gallery-link" data-class="post-gallery-lightbox"><div class="rel"><?php _e('View Gallery', 'thevoux'); ?><br>
		<em><?php echo $count; ?> <?php _e('Photos', 'thevoux'); ?></em></div></a>
		<?php } else { ?>
		<a href="#" class="gallery-link empty" data-class="post-gallery-lightbox"><div class="rel"><?php _e('Please Add Photos <br> to your Gallery', 'thevoux'); ?></div></a>
		<?php } ?>
	</figure>
<?php } else { ?>
	<p class="text-center"><strong><?php _e('Please select a featured image for your post', 'thevoux'); ?></strong></p>
<?php } ?>
<?php get_template_part( 'inc/postformats/post-gallery' ); ?>