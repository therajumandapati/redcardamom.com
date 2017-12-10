<?php
if ( !thb_wc_supported() ) {
	return;
}
/* Reviews Tab */
function thb_reviews_setup() {
	if ( ot_get_option('shop_reviews_tab') == 'off' ) {
		add_filter( 'woocommerce_product_tabs', 'thb_remove_reviews_tab', 98);
		function thb_remove_reviews_tab($tabs) {
			unset($tabs['reviews']);
			return $tabs;
		}
	}
}
add_action( 'after_setup_theme', 'thb_reviews_setup' );

/* Hide Admin bar for users */
function thb_remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
	  	show_admin_bar(false);
	}
}

add_action('after_setup_theme', 'thb_remove_admin_bar');

/* Header Cart */
function thb_quick_cart() {
 ?>
	<a class="quick_cart" data-target="open-cart" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart','thevoux'); ?>">
		<?php get_template_part('assets/svg/cart.svg'); ?>
		<span class="cart_count" id="cart_count"><?php echo WC()->cart->cart_contents_count; ?></span>
	</a>
<?php
}
add_action( 'thb_quick_cart', 'thb_quick_cart',3 );

/* Product Badges */
function thb_product_badge() {
 global $post, $product;
 	if (thb_out_of_stock()) {
		echo '<span class="badge out-of-stock">' . __( 'Out of Stock', 'thevoux' ) . '</span>';
	} else if ( $product->is_on_sale() ) {
		if (ot_get_option('shop_sale_badge', 'text') == 'discount') {
			if ($product->product_type == 'variable') {
				$available_variations = $product->get_available_variations();								
				$maximumper = 0;
				for ($i = 0; $i < count($available_variations); ++$i) {
					$variation_id=$available_variations[$i]['variation_id'];
					$variable_product1= new WC_Product_Variation( $variation_id );
					$regular_price = $variable_product1 ->regular_price;
					$sales_price = $variable_product1 ->sale_price;
					$percentage = $sales_price ? round( ( ( $regular_price - $sales_price ) / $regular_price ) * 100) : 0;
					if ($percentage > $maximumper) {
						$maximumper = $percentage;
					}
				}
				echo apply_filters('woocommerce_sale_flash', '<span class="badge onsale perc">&darr; '.$maximumper.'%</span>', $post, $product);
			} else if ($product->product_type == 'simple'){
				$percentage = round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 );
				echo apply_filters('woocommerce_sale_flash', '<span class="badge onsale perc">&darr; '.$percentage.'%</span>', $post, $product);
			}
		} else {
			echo apply_filters('woocommerce_sale_flash', '<span class="badge onsale">'.__( 'Sale','thevoux' ).'</span>', $post, $product);
		}
	} else {
		$postdate 		= get_the_time( 'Y-m-d' );			// Post date
		$postdatestamp 	= strtotime( $postdate );			// Timestamped post date
		$newness = ot_get_option('shop_newness', 7);
		if ( ( time() - ( 60 * 60 * 24 * $newness ) ) < $postdatestamp) { // If the product was published within the newness time frame display the new badge
			echo '<span class="badge new">' . __( 'Just Arrived', 'thevoux' ) . '</span>';
		}
		
	}
}
add_action( 'thb_product_badge', 'thb_product_badge',3 );

/* WOOCOMMERCE CART LINK */
function thb_woocomerce_ajax_cart_update($fragments) {

	ob_start();
	?>
		<span class="cart_count"><?php echo WC()->cart->cart_contents_count; ?></span>
	<?php
	$fragments['.cart_count'] = ob_get_clean();
	return $fragments;
}
add_filter('add_to_cart_fragments', 'thb_woocomerce_ajax_cart_update');


/* Image Dimensions */
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) add_action( 'init', 'thb_woocommerce_image_dimensions', 1 );

function thb_woocommerce_image_dimensions() {
  $catalog = array(
		'width' 	=> '270',	// px
		'height'	=> '320',	// px
		'crop'		=> 1 		// true
	);

	$single = array(
		'width' 	=> '570',	// px
		'height'	=> '540',	// px
		'crop'		=> 1 		// true
	);

	$thumbnail = array(
		'width' 	=> '135',	// px
		'height'	=> '130',	// px
		'crop'		=> 1 		// false
	);

	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
}

/* Products per Page */
function thb_ppp_setup() {
	if( isset( $_GET['show_products']) ){
		$getproducts = $_GET['show_products'];
		if ($getproducts == "all") {
	    	add_filter( 'loop_shop_per_page', create_function( '$cols', 'return -1;' ) );
	    } else {
	    	add_filter( 'loop_shop_per_page', create_function( '$cols', 'return '.$getproducts.';' ) );
	    }
	} else {
	    $products_per_page = ot_get_option('products_per_page', 12);
	    add_filter( 'loop_shop_per_page', create_function( '$cols', 'return ' . $products_per_page . ';' ), 20 );
	}
}
add_action( 'after_setup_theme', 'thb_ppp_setup' );

/* Shop Page - Remove orderby & breadcrumb */
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
add_action( 'thb_before_shop_loop_result_count', 'woocommerce_result_count', 20 );
add_action( 'thb_before_shop_loop_catalog_ordering', 'woocommerce_catalog_ordering', 30 );

/* Product Page - Move tabs */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
add_action( 'woocommerce_after_single_product', 'woocommerce_output_product_data_tabs', 10 );

/* Product Page - Move breadcrumbs */
remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);
add_action( 'thb_woocommerce_product_breadcrumb', 'woocommerce_breadcrumb', 20, 0 );

/* Product Page - Remove Sale Flash */
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash' , 10);

/* Product Page - Remove Related Products */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

/* Product Page - Move Upsells */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_after_single_product', 'woocommerce_upsell_display', 70 );

/* Product Page - Move Sharing to top */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 35 );

/* Product Page - Move Rating to top */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 15 );

/* Product Page - Add Social Sharing */
add_action( 'woocommerce_single_product_summary', 'thb_social_product', 59 );

/* Cart Page - Move Cross Sells */
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'woocommerce_after_cart_table', 'woocommerce_cross_sell_display' );


/* Product Page - Catalog Mode */
function thb_catalog_setup() {
	$catalog_mode = ot_get_option('shop_catalog_mode', 'off');
	if ($catalog_mode == 'on') {
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
	}
}
add_action( 'after_setup_theme', 'thb_catalog_setup' );

/* Out of Stock Check */
function thb_out_of_stock() {
  global $post;
  $id = $post->ID;
  $status = get_post_meta($id, '_stock_status',true);
  
  if ($status == 'outofstock') {
  	return true;
  } else {
  	return false;
  }
}

/* Product Nav */
function thb_product_nav() {
	global $wp_query, $post;

	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	?>
	<nav role="navigation" class="post_nav">      
     <?php previous_post_link( '%link', '<i class="fa fa-angle-left"></i>'. __( 'PREV', 'thevoux') ); ?>
     <?php next_post_link( '%link', __( 'NEXT', 'thevoux').'<i class="fa fa-angle-right"></i>' ); ?>
	</nav>
	<?php
}

/* Change breadcrumb delimiter */
add_filter( 'woocommerce_breadcrumb_defaults', 'thb_change_breadcrumb_delimiter' );
function thb_change_breadcrumb_delimiter( $defaults ) { 
    $defaults['delimiter'] = ' <span>&mdash;</span> ';
    return $defaults;
}

/* Redirect to Homepage when customer log out */
add_filter('logout_url', 'thb_new_logout_url', 10, 2);
function thb_new_logout_url($logouturl, $redir) {
	$redirect = get_option('siteurl');
	return $logouturl . '&amp;redirect_to=' . urlencode($redirect);
}