<?php 
	$logo = ot_get_option('logo', THB_THEME_ROOT. '/assets/img/logo.png');
?>
<?php if (ot_get_option('footer', 'on') != 'off') { ?>
<!-- Start Footer -->
<!-- Please call pinit.js only once per page -->
<div class="row">
	<div class="small-12 columns">
<footer id="footer" role="contentinfo" class="style3 no-borders">
  	<div class="row align-middle">
	    <div class="small-12 medium-3 columns logo-section">
	    	<a href="<?php echo esc_url(home_url()); ?>" class="logolink" title="<?php bloginfo('name'); ?>"><img src="<?php echo esc_url($logo); ?>" class="logo" alt="<?php bloginfo('name'); ?>"/></a>
	    </div>
	    <div class="small-12 medium-6 columns text-center">
	    	<?php if ($footer_menu = ot_get_option('footer_menu')) { ?>
	    		<?php wp_nav_menu( array( 'menu' => $footer_menu, 'depth' => 1, 'container' => false  ) ); ?>
	    	<?php } ?>
	    </div>
	    <div class="small-12 medium-3 columns social-section">
	    	<?php do_action( 'thb_social' ); ?>
	    </div>
    </div>
</footer>
	</div>
</div>
<!-- End Footer -->
<?php } ?>