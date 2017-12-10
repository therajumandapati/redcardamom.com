<?php 
	$fixed = ot_get_option('article_fixed_sidebar', 'on') == 'on' ? 'fixed-me' : '';
	$style = get_post_meta($id, 'post-style', true) ? get_post_meta($id, 'post-style', true) : 'style1'; 
?>
<aside class="sidebar small-12 medium-4 columns">
	<div class="sidebar_inner <?php echo esc_attr($fixed. ' ' .$style); ?>">
	<?php 
	
		##############################################################################
		# Single Ajax Sidebar
		##############################################################################
	
	 	?>
	<?php dynamic_sidebar('single-ajax'); ?>
	</div>
</aside>