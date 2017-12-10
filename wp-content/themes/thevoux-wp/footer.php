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
</body>
</html>