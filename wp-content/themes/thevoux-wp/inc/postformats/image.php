<?php if ( has_post_thumbnail() ) { ?>
	<?php $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thevoux-single'); ?>
	<figure class="post-gallery" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
		<?php the_post_thumbnail('thevoux-single', array('itemprop'=>'url')); ?>
		<meta itemprop="width" content="<?php echo esc_attr($featured_image[1]); ?>" />
		<meta itemprop="height" content="<?php echo esc_attr($featured_image[2]); ?>" />
	</figure>
<?php } else { ?>
	<p class="text-center"><strong><?php _e('Please select a featured image for your post', 'thevoux'); ?></strong></p>
<?php } ?>