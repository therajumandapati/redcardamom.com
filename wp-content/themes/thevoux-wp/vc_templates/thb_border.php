<?php function thb_border( $atts, $content = null) {
	$atts = vc_map_get_attributes( 'thb_border', $atts );
	extract( $atts );
	$out ='';
	ob_start();
	
	?>
	<div class="category_container <?php echo esc_attr($style); ?>">
		<div class="inner">
			<?php echo do_shortcode($content); ?>
		</div>
	</div>
	
	<?php
	$out = ob_get_contents();
	if (ob_get_contents()) ob_end_clean();
	return $out;

}
thb_add_short('thb_border', 'thb_border');