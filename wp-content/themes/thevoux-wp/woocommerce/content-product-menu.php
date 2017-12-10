<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}


// Increase loop count
$attachment_ids = $product->get_gallery_attachment_ids();
$catalog_mode = isset($_GET['shop_catalog_mode']) ? htmlspecialchars($_GET['shop_catalog_mode']) : ot_get_option('shop_catalog_mode', 'off');
?>

<div <?php post_class("post product"); ?>>

<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
	<?php
		$image_html = "";
		if ( has_post_thumbnail() ) {
			$image_html = wp_get_attachment_image( get_post_thumbnail_id(), 'thevoux-megamenu' );					
		} else if ( wc_placeholder_img_src() ) {
			$image_html = wc_placeholder_img( 'shop_catalog' );
		}
	?>
	<figure class="product-image">
		<?php do_action( 'thb_product_badge'); ?>
		<?php 
			if ($attachment_ids) {
					
					echo '<a href="'.get_the_permalink().'" title="'. the_title_attribute(array('echo' => 0)).'" class="fade">'.$image_html.'</a>';	

						
					if ( get_post_meta( $attachment_ids[0], '_woocommerce_exclude_image', true ) ) { continue; }
						
					echo '<a href="'.get_the_permalink().'" title="'. the_title_attribute(array('echo' => 0)).'" class="fade">'.wp_get_attachment_image( $attachment_ids[0], 'shop_catalog' ).'</a>';	

								
			} else {
					echo '<a href="'.get_the_permalink().'" title="'. the_title_attribute(array('echo' => 0)).'">'.$image_html.'</a>';	
			}
		?>
	</figure>
	<header class="post-title<?php if ($catalog_mode == 'on') { echo ' catalog-mode'; } ?>">
		<h6><?php the_title(); ?></h6>
		<?php if ($catalog_mode != 'on') { ?>
			<?php
				/**
				 * woocommerce_after_shop_loop_item_title hook
				 *
				 * @hooked woocommerce_template_loop_price - 10
				 */
				do_action( 'woocommerce_after_shop_loop_item_title' );
			?>
			<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
		<?php } ?>
	</header>
	
</div><!-- end product -->