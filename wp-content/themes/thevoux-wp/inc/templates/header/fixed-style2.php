<?php 
	$mobile_icon = ot_get_option('mobile_menu_icon', 'on');
	$header_menu_color = ot_get_option('header_menu_color', 'dark') == 'dark' ? '' : 'light-menu-color';
?>

<!-- Start Header -->
<header class="header fixed style4">
	<div class="nav_holder show-for-large">
		<div class="row full-width-row">
			<div class="small-12 columns">
				<div class="center-column">
					<div class="toggle-holder">
						<a href="#" class="mobile-toggle small <?php if ($mobile_icon !== 'on') { echo 'hide-for-large-up'; } ?>">
							<div>
								<span></span><span></span><span></span>
							</div>
						</a>
					</div>
					<nav role="navigation" class="full-menu-container <?php echo esc_attr($header_menu_color); ?>">
						<?php if(has_nav_menu('nav-menu')) { ?>
						  <?php wp_nav_menu( array( 'theme_location' => 'nav-menu', 'depth' => 3, 'container' => false, 'menu_class' => 'full-menu nav', 'walker' => new thb_MegaMenu_tagandcat_Walker ) ); ?>
						<?php } else { ?>
							<ul class="full-menu">
								<li><a href="<?php echo get_admin_url().'nav-menus.php'; ?>">Please assign a menu from Appearance -> Menus</a></li>
							</ul>
						<?php } ?>
					</nav>
					
					<div class="social-holder <?php echo esc_attr($social_style = ot_get_option('header_socialstyle', 'style1')); ?>">
						<?php do_action( 'thb_social_header' ); ?>
						<?php do_action( 'thb_quick_search' ); ?>
						<?php do_action( 'thb_quick_cart' ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
<!-- End Header -->