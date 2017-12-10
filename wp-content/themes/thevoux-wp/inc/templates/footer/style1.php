<?php 
	$footer_columns = ot_get_option('footer_columns', 'threecolumns');
	$footer_center_align = ot_get_option('footer_center_align', 'on') == 'on' ? 'center-align' : '';
	$footer_widget_borders = ot_get_option('footer_widget_borders', 'on') == 'on' ? '' : 'no-borders';
	$footer_widget_text_align = ot_get_option('footer_widget_text_align');
	$footer_grid = (ot_get_option('footer_grid') != 'off' ? '' : 'full-width-row');
	$subfooter_style = (isset($_GET['subfooter_style']) ? htmlspecialchars($_GET['subfooter_style']) : ot_get_option('subfooter_style', 'footer-standard'));
	$subfooter_content = (isset($_GET['subfooter_content']) ? htmlspecialchars($_GET['subfooter_content']) : ot_get_option('subfooter_content', 'footer-text'));
?>
<?php if (ot_get_option('footer') != 'off') { ?>
<!-- Start Footer -->
<!-- Please call pinit.js only once per page -->
<footer id="footer" role="contentinfo" class="<?php echo esc_attr($footer_widget_text_align. ' ' .$footer_widget_borders); ?>">
  	<div class="row no-padding <?php echo esc_attr($footer_grid. ' '. $footer_center_align); ?>">
  		<?php if ($footer_columns == 'fourcolumns') { ?>
	    <div class="small-12 medium-3 columns">
	    	<?php dynamic_sidebar('footer1'); ?>
	    </div>
	    <div class="small-12 medium-3 columns">
	    	<?php dynamic_sidebar('footer2'); ?>
	    </div>
	    <div class="small-12 medium-3 columns">
		    <?php dynamic_sidebar('footer3'); ?>
	    </div>
	    <div class="small-12 medium-3 columns">
		    <?php dynamic_sidebar('footer4'); ?>
	    </div>
	    <?php } elseif ($footer_columns == 'threecolumns') { ?>
	    <div class="small-12 medium-4 columns">
	    	<?php dynamic_sidebar('footer1'); ?>
	    </div>
	    <div class="small-12 medium-4 columns">
	    	<?php dynamic_sidebar('footer2'); ?>
	    </div>
	    <div class="small-12 medium-4 columns">
	        <?php dynamic_sidebar('footer3'); ?>
	    </div>
	    <?php } elseif ($footer_columns == 'twocolumns') { ?>
	    <div class="small-12 medium-6 columns">
	    	<?php dynamic_sidebar('footer1'); ?>
	    </div>
	    <div class="small-12 medium-6 columns">
	    	<?php dynamic_sidebar('footer2'); ?>
	    </div>
	    <?php } elseif ($footer_columns == 'doubleleft') { ?>
	    <div class="small-12 medium-6 columns">
	    	<?php dynamic_sidebar('footer1'); ?>
	    </div>
	    <div class="small-12 medium-3 columns">
	    	<?php dynamic_sidebar('footer2'); ?>
	    </div>
	    <div class="small-12 medium-3 columns">
	        <?php dynamic_sidebar('footer3'); ?>
	    </div>
	    <?php } elseif ($footer_columns == 'doubleright') { ?>
	    <div class="small-12 medium-3 columns">
	    	<?php dynamic_sidebar('footer1'); ?>
	    </div>
	    <div class="small-12 medium-3 columns">
	    	<?php dynamic_sidebar('footer2'); ?>
	    </div>
	    <div class="small-12 medium-6 columns">
	        <?php dynamic_sidebar('footer3'); ?>
	    </div>
	    <?php } elseif ($footer_columns == 'fivecolumns') { ?>
	    <div class="small-12 medium-2 columns">
	    	<?php dynamic_sidebar('footer1'); ?>
	    </div>
	    <div class="small-12 medium-3 columns">
	    	<?php dynamic_sidebar('footer2'); ?>
	    </div>
	    <div class="small-12 medium-2 columns">
	    	<?php dynamic_sidebar('footer3'); ?>
	    </div>
	    <div class="small-12 medium-3 columns">
	    	<?php dynamic_sidebar('footer4'); ?>
	    </div>
	    <div class="small-12 medium-2 columns">
	    	<?php dynamic_sidebar('footer5'); ?>
	    </div>
	    <?php }?>
    </div>
</footer>
<!-- End Footer -->
<?php } ?>
<?php if (ot_get_option('subfooter') != 'off') { ?>
<!-- Start Sub-Footer -->
<aside id="subfooter">
	<div class="row">
		<div class="small-12 columns">
			<?php if($subfooter_content == 'footer-icons') {  ?>
				<?php do_action( 'thb_social' ); ?>
			<?php } else if ($subfooter_content == 'footer-text') { ?>
				<p><?php echo do_shortcode(ot_get_option('subfooter_text')); ?></p>
			<?php } else if ($subfooter_content == 'footer-menu') { ?>
				<?php wp_nav_menu( array( 'menu' => ot_get_option('subfooter_menu'), 'depth' => 1, 'container' => false  ) ); ?>
			<?php } ?>
		</div>
	</div>
</aside>
<!-- End Sub-Footer -->
<?php } ?>