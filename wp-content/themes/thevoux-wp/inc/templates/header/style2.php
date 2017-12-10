<?php 
	$mobile_icon = ot_get_option('mobile_menu_icon', 'on');
	$header_boxed = ot_get_option('header_boxed', 'off');
	$header_menu_color = ot_get_option('header_menu_color', 'dark') == 'dark' ? '' : 'light-menu-color';
	$logo = ot_get_option('logo', THB_THEME_ROOT. '/assets/img/logo.png');
?>

<!-- Start Header -->
<?php if ($header_boxed === 'on') { ?>
<div class="row">
	<div class="small-12 columns">
<?php } ?>
<header class="header style2 <?php echo ($header_boxed === 'on' ? 'boxed' : ''); ?>">
	<div class="header_top cf">
		<div class="row full-width-row align-middle">
			<div class="small-3 medium-10 columns logo">
				<a href="#" class="mobile-toggle <?php if ($mobile_icon !== 'on') { echo 'hide-for-large'; } ?>">
					<div>
						<span></span><span></span><span></span>
					</div>
				</a>
				<a href="<?php echo esc_url(home_url()); ?>" class="logolink" title="<?php bloginfo('name'); ?>">
					<img src="<?php echo esc_url($logo); ?>" class="logoimg" alt="<?php bloginfo('name'); ?>"/>
				</a>
				
				<nav role="navigation" class="full-menu-container <?php echo esc_attr($header_menu_color); ?>">
					<?php if(has_nav_menu('nav-menu')) { ?>
					  <?php wp_nav_menu( array( 'theme_location' => 'nav-menu', 'depth' => 3, 'container' => false, 'menu_class' => 'full-menu nav', 'walker' => new thb_MegaMenu_tagandcat_Walker ) ); ?>
					<?php } else { ?>
						<ul class="full-menu">
							<li><a href="<?php echo get_admin_url().'nav-menus.php'; ?>">Please assign a menu from Appearance -> Menus</a></li>
						</ul>
					<?php } ?>
				</nav>
			</div>
			<div class="small-6 columns logo mobile">
					<a href="<?php echo home_url(); ?>" class="logolink" title="<?php bloginfo('name'); ?>">
						<img src="<?php echo esc_url($logo); ?>" class="logoimg" alt="<?php bloginfo('name'); ?>"/>
					</a>
			</div>
			<div class="small-3 medium-2 columns social-holder <?php echo esc_attr($social_style = ot_get_option('header_socialstyle', 'style1')); ?>">
					<?php do_action( 'thb_social_header' ); ?>
					<?php do_action( 'thb_quick_search' ); ?>
					<?php do_action( 'thb_quick_cart' ); ?>
			</div>
		</div>
	</div>
</header>
<?php if ($header_boxed === 'on') { ?>
	</div>
</div>
<?php } ?>
<!-- End Header -->