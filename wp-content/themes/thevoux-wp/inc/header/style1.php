<?php 
	$id = get_queried_object_id();
	$mobile_icon = ot_get_option('mobile_menu_icon', 'on');
	$header_menu_color = ot_get_option('header_menu_color', 'dark') == 'dark' ? '' : 'light-menu-color';
	if (ot_get_option('logo')) { $logo = ot_get_option('logo'); } else { $logo = THB_THEME_ROOT. '/assets/img/logo.png'; }
?>

<!-- Start Header -->
<div class="header_container style1">
	<header class="header style1" role="banner">
		<div class="header_top cf">
			<div class="row full-width-row">
				<div class="small-3 large-4 columns toggle-holder">
					<div>
						<a href="#" class="mobile-toggle <?php if ($mobile_icon !== 'on') { echo 'hide-for-large-up'; } ?>">
							<div>
								<span></span><span></span><span></span>
							</div>
						</a>
						<a href="<?php echo esc_url(home_url()); ?>" class="logolink" title="<?php bloginfo('name'); ?>"><img src="<?php echo esc_url($logo); ?>" class="logofixed" alt="<?php bloginfo('name'); ?>"/></a>
					</div>
				</div>
				<div class="small-6 large-4 columns logo text-center">
					<?php if (is_single()) { ?><h6 id="page-title"><?php the_title(); ?></h6><?php } ?>
					<a href="<?php echo home_url(); ?>" class="logolink" title="<?php bloginfo('name'); ?>">
						<img src="<?php echo esc_url($logo); ?>" class="logoimg" alt="<?php bloginfo('name'); ?>"/>
					</a>
				</div>
				<div class="small-3 large-4 columns social-holder <?php echo esc_attr($social_style = ot_get_option('header_socialstyle', 'style1')); ?>">
					<div>
						<?php do_action( 'thb_social_header' ); ?>
						<?php do_action( 'thb_quick_search' ); ?>
						<?php do_action( 'thb_quick_cart' ); ?>
					</div>
				</div>
			</div>
			<?php if(ot_get_option('reading_indicator', 'on') !== 'off') { ?>
			<span class="progress"></span>
			<?php } ?>
		</div>
		<?php if (ot_get_option('full_menu', 'on') !== 'off') { ?>
		<nav id="full-menu" role="navigation" class="<?php echo esc_attr($header_menu_color); ?>">
			<?php if(has_nav_menu('nav-menu')) { ?>
			  <?php wp_nav_menu( array( 'theme_location' => 'nav-menu', 'depth' => 3, 'container' => false, 'menu_class' => 'full-menu nav', 'walker' => new thb_MegaMenu_tagandcat_Walker ) ); ?>
			<?php } else { ?>
				<ul class="full-menu">
					<li><a href="<?php echo get_admin_url().'nav-menus.php'; ?>">Please assign a menu from Appearance -> Menus</a></li>
				</ul>
			<?php } ?>
		</nav>
		<?php } ?>
	</header>
</div>
<!-- End Header -->