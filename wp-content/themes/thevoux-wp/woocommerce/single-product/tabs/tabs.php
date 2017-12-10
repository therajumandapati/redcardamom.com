<?php
/**
 * Single Product tabs
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>

<div class="woocommerce-tabs thb_tabs">
	<dl class="tabs" role="tablist">
		<?php foreach ( $tabs as $key => $tab ) : ?>
			<dd role="presentation" class="<?php echo $key ?>_tab">
				<h5><a href="#<?php echo $key ?>" role="tab"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ) ?></a></h5>
			</dd>
		<?php endforeach; ?>
	</dl>
	<ul class="tabs-content">
	<?php foreach ( $tabs as $key => $tab ) : ?>
	
			<li role="tabpanel" id="<?php echo esc_attr( $key ); ?>Tab">
				<?php call_user_func( $tab['callback'], $key, $tab ); ?>
			</li>

	<?php endforeach; ?>
	</ul>
</div>
<?php endif; ?>