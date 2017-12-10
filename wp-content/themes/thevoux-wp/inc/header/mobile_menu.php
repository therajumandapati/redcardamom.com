<?php 
	if (ot_get_option('logo')) { $logo = ot_get_option('logo'); } else { $logo = THB_THEME_ROOT. '/assets/img/logo.png'; }
	$menu_footer = ot_get_option('menu_footer');
?>
<!-- Start Mobile Menu -->
<nav id="mobile-menu">
	<div class="custom_scroll" id="menu-scroll">
		<div>
			<a href="#" class="close">×</a>
			<img src="<?php echo esc_url($logo); ?>" class="logoimg" alt="<?php bloginfo('name'); ?>"/>
			<?php if(has_nav_menu('mobile-menu')) { ?>
			  <?php wp_nav_menu( array( 'theme_location' => 'mobile-menu', 'depth' => 2, 'container' => false, 'menu_class' => 'thb-mobile-menu', 'walker' => new thb_mobileDropdown ) ); ?>
			<?php } ?>
			<?php if (has_nav_menu('secondary-mobile-menu')) { ?>
				<?php wp_nav_menu( array( 'theme_location' => 'secondary-mobile-menu', 'depth' => 1, 'container' => false, 'menu_class' => 'thb-mobile-menu-secondary'  ) ); ?>
			<?php } ?>
			<div class="menu-footer">
				<?php echo do_shortcode($menu_footer); ?>
			</div>
		</div>
	</div>
</nav>
<!-- End Mobile Menu -->