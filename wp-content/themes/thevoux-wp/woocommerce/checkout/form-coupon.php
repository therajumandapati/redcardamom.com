<?php
/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! wc_coupons_enabled() ) {
	return;
}

$info_message = '<div class="checkout-quick-coupon notification-box success"><div class="content">'.apply_filters( 'woocommerce_checkout_coupon_message', __( 'Have a coupon?', 'woocommerce' ) ).' <a href="#" class="showcoupon">' . __( 'Click here to enter your code', 'woocommerce' ) . '</a></div></div>';

echo $info_message;
?>
<div class="row">
	<div class="small-12 medium-centered medium-6 large-6 xlarge-4 columns text-center">
		<form class="checkout_coupon" method="post">
			<input type="text" name="coupon_code" class="input-text full" placeholder="<?php _e( 'Coupon code', 'woocommerce' ); ?>" value="" />
			<input type="submit" class="button outline apply_coupon yellow small" name="apply_coupon" value="<?php _e( 'Apply', 'woocommerce' ); ?>" />
		</form>
	</div>
</div>