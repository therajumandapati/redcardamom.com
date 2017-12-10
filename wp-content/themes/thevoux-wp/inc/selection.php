<?php function thb_selection() {
	$id = get_queried_object_id();
	ob_start();
?>
/* Options set in the admin page */
body { 
	color: <?php echo ot_get_option('text_color'); ?>;
	<?php thb_typeecho(ot_get_option('body_type'), false, 'Lora'); ?>
}

/* Logo Height */
@media only screen and (max-width: 40.063em) {
	.header .logo .logoimg {
		max-height: <?php thb_measurementecho(ot_get_option('logo_height_mobile')); ?>;
	}
}
@media only screen and (min-width: 40.063em) {
	.header .logo .logoimg {
		max-height: <?php thb_measurementecho(ot_get_option('logo_height')); ?>;
	}
}
/* Title Type */
<?php if(ot_get_option('title_type')) { ?>
h1, h2, h3, h4, h5, h6, .mont, .post .post-author em, .wpcf7-response-output, label, .select-wrapper select, .wp-caption .wp-caption-text, .smalltitle, .toggle .title, q, blockquote p, cite, table tr th, table tr td, #footer.style3 .menu, #footer.style2 .menu, .product-title, .social_bar {
	<?php thb_typeecho(ot_get_option('title_type')); ?>	
}
<?php } ?>

/* Colors */
<?php if ($accent_color = ot_get_option('accent_color')) { ?>
a, .full-menu-container .full-menu > li.active > a, .full-menu-container .full-menu > li.sfHover > a, .full-menu-container .full-menu > li > a:hover, .full-menu-container .full-menu > li > a:hover, .full-menu-container .full-menu > li.menu-item-has-children.menu-item-mega-parent .thb_mega_menu_holder .thb_mega_menu li.active a, .full-menu-container .full-menu > li.menu-item-has-children.menu-item-mega-parent .thb_mega_menu_holder .thb_mega_menu li.active a .fa, .post .article-tags a, .post .post-title a:hover, #archive-title h1 span, .widget > strong, .widget.widget_recent_entries ul li .url, .widget.widget_recent_comments ul li .url, .widget.widget_sharedimages .post-links.just-shares, .widget.widget_sharedimages .post-links.just-shares span, .slick.dark-pagination .slick-dots li.slick-active button, .slick-nav:hover, .thb-mobile-menu li a.active, .post .post-content .wpb_accordion .wpb_accordion_section .wpb_accordion_header.ui-accordion-header-active a, .tabs .active a, .tabs .active a:hover, .tabs dd a:hover, .tabs li a:hover, .toggle .title.wpb_toggle_title_active, .toggle .title.wpb_toggle_title_active:hover, q, blockquote p, cite, .notification-box a, .thb-selectionSharer a.email:hover,.cart_totals table tr.order-total td, .payment_methods li .about_paypal, .terms label a, .thb-mobile-menu-secondary li a:hover, .price .amount, .price.single-price ins .amount,.product .product-information .product_meta>span a, .product .product-information .product_meta>span .sku, .woocommerce-tabs .tabs dd.active a {
  color: <?php echo esc_attr($accent_color); ?>;
}

.slick.dark-pagination .slick-dots li.slick-active button,
.custom_check + .custom_label:hover:before,
.post .post-content .atvImg:hover .image_link {
	border-color: <?php echo esc_attr($accent_color); ?>;
}
.post .post-gallery.has-gallery:after {
	background-color: <?php echo esc_attr($accent_color); ?>;	
}
blockquote:before,
blockquote:after {
	background: rgba(<?php echo thb_hex2rgb($accent_color); ?>, 0.2);
}
@media only screen and (max-width: 40.063em) {
	.post.featured-style4 .featured-title {
		background: <?php echo esc_attr($accent_color); ?>;
	}
}
.header.fixed .header_top .progress, .post .post-gallery .gallery-link, .post.featured-style4:hover .featured-title, .slick.dark-pagination .slick-dots li.slick-active button, [class^="tag-link"]:hover, .post-gallery-content .row .columns .arrow:hover,.mobile-toggle span, .btn, .btn:focus, .button, input[type=submit], .btn.black:hover, .btn:focus.black:hover, .button.black:hover, input[type=submit].black:hover, .post .post-content .vc_toggle.vc_toggle_active .vc_toggle_title .vc_toggle_icon:after, .highlight.accent, .header .social-holder .quick_cart .cart_count, .custom_check + .custom_label:after, #archive-title, .video_playlist .video_play.video-active, .widget .count-image .count {
	background: <?php echo esc_attr($accent_color); ?>;	
}
.header .social-holder .social_header:hover .social_icon,
.post .post-content .atvImg .title svg, .post .post-content .atvImg .arrow svg {
	fill: <?php echo esc_attr($accent_color); ?>;
}
<?php } ?>
<?php if ($menu_link_color = ot_get_option('menu_link_color')) { ?>
	<?php thb_linkcolorecho($menu_link_color, '.full-menu-container .full-menu > li >'); ?>
<?php } ?>
<?php if ($mobileicon_color = ot_get_option('mobileicon_color')) { ?>
	.mobile-toggle span {
		background: <?php echo esc_attr($mobileicon_color); ?>;
	}
<?php } ?>
<?php if ($headericon_color = ot_get_option('headericon_color')) { ?>
	.header .logo #page-title {
		color: <?php echo esc_attr($headericon_color); ?>;
	}
	.quick_search .search_icon,
	.header .social-holder .social_header .social_icon {
		fill: <?php echo esc_attr($headericon_color); ?>;
	}
<?php } ?>
<?php if ($widgettitle_color = ot_get_option('widgettitle_color')) { ?>
	.widget > strong {
		color: <?php echo esc_attr($widgettitle_color); ?>;
	}
<?php } ?>
/* Backgrounds */
<?php if ($header_bg = ot_get_option('header_bg')) { ?>
	.header_top {
		<?php thb_bgecho($header_bg); ?>
	}
<?php	} ?>
<?php if ($menu_bg = ot_get_option('menu_bg')) { ?>
	.full-menu-container {
		<?php thb_bgecho($menu_bg); ?>
	}
<?php	} ?>
<?php if ($megamenu_bg = ot_get_option('megamenu_bg')) { ?>
	.full-menu-container .full-menu > li.menu-item-has-children.menu-item-mega-parent .thb_mega_menu_holder,
	.full-menu-container .full-menu > li.menu-item-has-children > .sub-menu {
		<?php thb_bgecho($megamenu_bg); ?>
	}
<?php	} ?>
<?php if ($footer_bg = ot_get_option('footer_bg')) { ?>
	#footer {
		<?php thb_bgecho($footer_bg); ?>
	}
<?php	} ?>
<?php if ($subfooter_bg = ot_get_option('subfooter_bg')) { ?>
	#subfooter {
		<?php thb_bgecho($subfooter_bg); ?>
	}
<?php	} ?>
<?php if ($widgettitle_bg = ot_get_option('widgettitle_bg')) { ?>
	.widget.style1 > strong span {
		background: <?php echo esc_attr($widgettitle_bg); ?>;
	}
<?php	} ?>
/* Typography */
<?php if ($menu_type= ot_get_option('menu_type')) { ?>
.full-menu-container .full-menu > li > a,
#footer.style3 .menu, 
#footer.style2 .menu {
	<?php thb_typeecho($menu_type); ?>	
}
<?php } ?>
<?php if ($submenu_type= ot_get_option('submenu_type')) { ?>
.full-menu-container .full-menu > li .sub-menu a {
	<?php thb_typeecho($submenu_type); ?>	
}
<?php } ?>
<?php if ($article_title_type = ot_get_option('article_title_type')) { ?>
.post .post-title h1 {
	<?php thb_typeecho($article_title_type); ?>	
}
<?php } ?>
<?php if ($widget_title_type= ot_get_option('widget_title_type')) { ?>
.widget > strong {
	<?php thb_typeecho($widget_title_type); ?>	
}
<?php } ?>
/* Category Colors */
<?php 
	if ($category_colors = ot_get_option('category_colors')) {
		thb_catcolorecho($category_colors);
	} 
?>
/* 404 Image */
<?php if ($bg_404 = ot_get_option('404_bg')) { ?>
@media only screen and (min-width: 40.063em) {
	.content404 > .row {
		background-image: url('<?php echo esc_attr($bg_404); ?>');
	}
}
<?php } ?>
/* Measurements */
<?php if ($footer_widget_padding = ot_get_option('footer_widget_padding')) { ?>
#footer .widget {
	<?php thb_spacingecho($footer_widget_padding, false, 'padding'); ?>;
}
<?php } ?>
/* Extra CSS */
<?php 
echo ot_get_option('extra_css');
?>
<?php 
	$out = ob_get_contents();
	if (ob_get_contents()) ob_end_clean();
	// Remove comments
	$out = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $out);
	// Remove space after colons
	$out = str_replace(': ', ':', $out);
	// Remove whitespace
	$out = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $out);
	
	return $out;
}