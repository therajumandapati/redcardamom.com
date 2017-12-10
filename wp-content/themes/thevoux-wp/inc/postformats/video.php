<?php 
	global $wp_embed;
	$id = get_the_ID();
	$embed = get_post_meta($id , 'post_video', TRUE);
?>
<div class="video-container">
	<?php if ($embed !='') { ?>
	  <?php echo $wp_embed->run_shortcode('[embed]'.$embed.'[/embed]'); ?>
	<?php } ?>
</div>