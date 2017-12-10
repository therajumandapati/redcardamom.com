<?php
/**
 * Cart Page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.8
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<?php get_template_part( 'inc/templates/header/archive-title' ); ?>
<div class="page-padding">
<?php wc_print_notices(); ?>
<?php do_action( 'woocommerce_before_cart' ); ?>
<div class="row">
	
	<div class="small-12 large-8 columns cart-holder">
		<?php wc_print_notices(); ?>
		<form action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post">
			<?php do_action( 'woocommerce_before_cart_table' ); ?>
			<table class="shop_table cart" cellspacing="0">
				<thead>
					<tr>
						<th class="product-thumbnail"><?php _e( 'Product', 'thevoux' ); ?></th>
						<th class="product-name" colspan="2"><?php _e( 'Product', 'thevoux' ); ?></th>
						<th class="product-price"><?php _e( 'Price', 'thevoux' ); ?></th>
						<th class="product-quantity"><?php _e( 'QTY', 'thevoux' ); ?></th>
						<th class="product-subtotal"><?php _e( 'Total', 'thevoux' ); ?></th>
						<th class="product-remove">&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					<?php do_action( 'woocommerce_before_cart_contents' ); ?>
			
					<?php
							foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
								$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
								$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
					
								if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
									?>
								<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
									
			
									<!-- The thumbnail -->
									<td class="product-thumbnail">
										<?php
											$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
											if ( ! $_product->is_visible() )
												echo $thumbnail;
											else
												printf( '<a href="%s">%s</a>', $_product->get_permalink( $cart_item ), $thumbnail );
										?>
									</td>
			
									<!-- Product Name -->
									<td class="product-name">
										<?php
											if ( ! $_product->is_visible() )
												echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
											else
												echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', $_product->get_permalink(), $_product->get_title() ), $cart_item, $cart_item_key );
				
											// Meta data
											echo WC()->cart->get_item_data( $cart_item );
				
				               				// Backorder notification
				               				if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) )
				               					echo '<p class="backorder_notification">' . __( 'Available on backorder','thevoux' ) . '</p>';
										?>
									</td>
									<!-- Quantity inputs -->
									<td class="product-price">
										<?php
											echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
										?>
									</td>
									<!-- Quantity inputs -->
									<td class="product-quantity">
										<?php
											if ( $_product->is_sold_individually() ) {
												$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
											} else {
												$product_quantity = woocommerce_quantity_input( array(
													'input_name'  => "cart[{$cart_item_key}][qty]",
													'input_value' => $cart_item['quantity'],
													'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
												), $_product, false );
											}
				
											echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
										?>
									</td>
			
									<!-- Product subtotal -->
									<td class="product-subtotal">
										<?php
											echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
										?>
									</td>
									<!-- Remove from cart link -->
									<td class="product-remove">
										<?php
											echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
												'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
												esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
												__( 'Remove this item', 'woocommerce' ),
												esc_attr( $product_id ),
												esc_attr( $_product->get_sku() )
											), $cart_item_key );
										?>
									</td>
								</tr>
								<?php
						}
					}
			
					do_action( 'woocommerce_cart_contents' );
					?>
					<?php do_action( 'woocommerce_after_cart_contents' ); ?>
				</tbody>
			</table>
			
			<div class="row">
				<div class="small-12 medium-7 columns">
					<?php if ( WC()->cart->coupons_enabled() ) { ?>
						<aside class="coupon_box">
							<input type="text" name="coupon_code" id="coupon_code" value="" class="full" placeholder="<?php _e( 'Enter Coupon Code', 'thevoux' ); ?>"/>
							<input type="submit" class="apply_coupon green small" name="apply_coupon" value="<?php _e( 'Apply','thevoux' ); ?>" />
							<?php do_action('woocommerce_cart_coupon'); ?>
						</aside>
					<?php } ?>
				</div>
				<div class="small-12 medium-5 columns small-text-center medium-text-right">
					<input type="submit" class="update-button button small black" name="update_cart" value="<?php _e( 'Update Cart', 'woocommerce' ); ?>" />
					<?php do_action( 'woocommerce_cart_actions' ); ?>
		
					<?php wp_nonce_field( 'woocommerce-cart' ); ?>
				</div>
			</div>
			<?php do_action( 'woocommerce_after_cart_table' ); ?>
		</form>
	</div>
	<div class="small-12 large-4 columns">
			<?php do_action('woocommerce_cart_collaterals'); ?>
	</div>
</div>
<?php do_action( 'woocommerce_after_cart' ); ?>
</div>