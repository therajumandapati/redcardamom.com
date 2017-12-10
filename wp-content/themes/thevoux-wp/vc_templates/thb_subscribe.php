<?php function thb_subscribe( $atts, $content = null ) {
	$style = 'style1';
  $atts = vc_map_get_attributes( 'thb_subscribe', $atts );
  extract( $atts );
 	ob_start();
 	
 	?>
 	<div class="thb_subscribe <?php echo esc_attr($style); ?>">
 		<?php if ($style == 'style1') { ?>
		 	<?php if ($title) { ?><h3><?php echo esc_html($title); ?></h3><?php } ?>
		 	<?php if ($description) { ?><p><?php echo esc_html($description); ?></p><?php } ?>
			<form class="newsletter-form row" action="#" method="post">   
				<div class="small-12 medium-9 columns"><input placeholder="<?php _e("Your E-Mail",'thevoux'); ?>" type="text" name="widget_subscribe" class="widget_subscribe"></div>
				<div class="small-12 medium-3 columns"><button type="submit" name="submit" class="btn large black"><?php _e("SIGN UP",'thevoux'); ?></button></div>
			</form>
			<div class="result"></div>
		<?php } else { ?>
			<div class="row align-middle">
				<div class="small-12 medium-6 large-7 columns">
					<?php if ($title) { ?><h3><?php echo esc_html($title); ?></h3><?php } ?>
					<?php if ($description) { ?><p><?php echo esc_html($description); ?></p><?php } ?>
				</div>
				<div class="small-12 medium-6 large-5 columns">
					<form class="newsletter-form row" action="#" method="post">   
						<div class="small-12 medium-9 columns"><input placeholder="<?php _e("Your E-Mail",'thevoux'); ?>" type="text" name="widget_subscribe" class="widget_subscribe small"></div>
						<div class="small-12 medium-3 columns"><button type="submit" name="submit" class="btn small black"><?php _e("SIGN UP",'thevoux'); ?></button></div>
					</form>
					<div class="result"></div>
				</div>
			</div>
		<?php } ?>
	</div>
	<?php
   $out = ob_get_contents();
   if (ob_get_contents()) ob_end_clean();
  return $out;
}
thb_add_short('thb_subscribe', 'thb_subscribe');
