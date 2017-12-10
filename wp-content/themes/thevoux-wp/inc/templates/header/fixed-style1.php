<?php 
	$mobile_icon = ot_get_option('mobile_menu_icon', 'on');
	$header_menu_color = ot_get_option('header_menu_color', 'dark') == 'dark' ? '' : 'light-menu-color';
	$logo = ot_get_option('logo_fixed') ? ot_get_option('logo_fixed') : ot_get_option('logo', THB_THEME_ROOT. '/assets/img/logo.png');
?>

<!-- Start Header -->
<header class="header fixed">
	<div class="header_top cf">
		<div class="row full-width-row">
			<div class="small-3 medium-2 columns toggle-holder">
					<a href="#" class="mobile-toggle <?php if ($mobile_icon !== 'on') { echo 'hide-for-large-up'; } ?>">
						<div>
							<span></span><span></span><span></span>
						</div>
					</a>
			</div>
			<div class="small-6 medium-8 columns logo text-center active">
				<?php if (!is_single()) { ?>
				<a href="<?php echo esc_url(home_url()); ?>" class="logolink" title="<?php bloginfo('name'); ?>">
					<img src="<?php echo esc_url($logo); ?>" class="logoimg" alt="<?php bloginfo('name'); ?>"/>
				</a>
				<?php } else { ?><h6 id="page-title"><?php the_title(); ?></h6><?php } ?>
			</div>
			<div class="small-3 medium-2 columns text-right">
				<div class="social-holder">
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
	<div class="nav_holder show-for-large">
		<div class="row full-width-row no-padding">
			<div class="small-12 columns">
				<nav role="navigation" class="full-menu-container text-center <?php echo esc_attr($header_menu_color); ?>">
					<?php if(has_nav_menu('nav-menu')) { ?>
					  <?php wp_nav_menu( array( 'theme_location' => 'nav-menu', 'depth' => 3, 'container' => false, 'menu_class' => 'full-menu nav', 'walker' => new thb_MegaMenu_tagandcat_Walker ) ); ?>
					<?php } else { ?>
						<ul class="full-menu">
							<li><a href="<?php echo get_admin_url().'nav-menus.php'; ?>">Please assign a menu from Appearance -> Menus</a></li>
						</ul>
					<?php } ?>
				</nav>
			</div>
		</div>
	</div>
</header>
<!-- End Header -->