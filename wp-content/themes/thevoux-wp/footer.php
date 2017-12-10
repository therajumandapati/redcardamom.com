<?php 
	$selection_sharing_type = ot_get_option('selection_sharing_buttons') ? ot_get_option('selection_sharing_buttons') : array();
	$twitter_user = ot_get_option('twitter_bar_username', 'anteksiler');
?>
		</div><!-- End role["main"] -->
	<?php get_template_part('inc/templates/footer/social_bar'); ?>
	<?php get_template_part('inc/templates/footer/'.ot_get_option('footer_style', 'style1')); ?>
	</section> <!-- End #content-container -->
</div> <!-- End #wrapper -->
<?php if (ot_get_option('scroll_totop') != 'off') { ?>
	<a href="#" id="scroll_totop"><?php get_template_part('assets/svg/scroll_totop.svg'); ?></a>
<?php } ?>
<?php if (ot_get_option('selection_sharing') == 'on') { ?>
<div id="thbSelectionSharerPopover" class="thb-selectionSharer" data-appid="<?php echo ot_get_option('selection_sharing_appid'); ?>" data-user="<?php echo esc_attr($twitter_user); ?>">
  <div id="thb-selectionSharerPopover-inner">
    <ul>
    	<?php if (in_array('twitter',$selection_sharing_type)) { ?>
      <li><a class="action twitter" href="#" title="<?php _e('Share this selection on Twitter', 'thevoux'); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
      <?php } ?>
      <?php if (in_array('facebook',$selection_sharing_type)) { ?>
      <li><a class="action facebook" href="#" title="<?php _e('Share this selection on Facebook', 'thevoux'); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
      <?php } ?>
      <?php if (in_array('email',$selection_sharing_type)) { ?>
      <li><a class="action email" href="#" title="<?php _e('Share this selection by Email', 'thevoux'); ?>" target="_blank"><i class="fa fa-envelope"></i></a></li>
      <?php } ?>
    </ul>
  </div>
</div>
<?php } ?>
<?php 
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */
	 wp_footer(); 
?>
<script>

  <?php 
    $google_fonts_config = redcardamom_get_google_fonts_list(); 
    $fonts_text = '';
    foreach($google_fonts_config['families'] as $family){ 
      $fonts_text .= $family.'|';
    }
    $fonts_text .= '&subset=latin,latin-ext&ver=1.0.0';
  ?>

   WebFontConfig = {
    google: {
      families: ['<?php echo urlencode($fonts_text); ?>'],
    }
   };

   (function(d) {
      var wf = d.createElement('script'), s = d.scripts[0];
      wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
      wf.async = true;
      s.parentNode.insertBefore(wf, s);
   })(document);
</script>
</body>
</html>