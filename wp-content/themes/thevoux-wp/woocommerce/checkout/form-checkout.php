<?php
/**
 * Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );
	return;
}

// filter hook for include new pages inside the payment method
$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', WC()->cart->get_checkout_url() ); ?>
<?php get_template_part( 'inc/templates/header/archive-title' ); ?>
<div class="page-padding">
	<div class="row">
		<div class="small-12 medium-10 medium-centered large-8 columns">
			<?php do_action( 'woocommerce_before_checkout_form', $checkout ); ?>
		</div>
	</div>
	<div class="row">
		<div class="small-12 medium-10 medium-centered large-8 columns">
			<form name="checkout" method="post" class="checkout" action="<?php echo esc_url( $get_checkout_url ); ?>" enctype="multipart/form-data">

				<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>
					<?php do_action( 'woocommerce_checkout_before_customer_details'); ?>
					<?php do_action( 'woocommerce_checkout_billing'); ?>
					<?php do_action( 'woocommerce_checkout_shipping'); ?>
					<?php do_action( 'woocommerce_checkout_after_customer_details'); ?>
				<?php endif; ?>

				<section class="section woocommerce-checkout-review-order cf" id="order_review">
					<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
					<?php do_action('woocommerce_checkout_order_review'); ?>
					<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
				</section>
			</form>
		</div>
	</div>
	<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
</div>