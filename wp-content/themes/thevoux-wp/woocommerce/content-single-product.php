<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
<div class="row">
	<div class="small-12 columns">
<div id="product-<?php the_ID(); ?>" <?php post_class('post product-page'); ?>>
	<div class="row">
			<div class="small-12 large-6 columns product-gallery carousel-container">
				 
		    <?php
		        /**
		         * woocommerce_show_product_images hook
		         *
		         * @hooked woocommerce_show_product_sale_flash - 10
		         * @hooked woocommerce_show_product_images - 20
		         * 
		         */
		        do_action( 'woocommerce_before_single_product_summary' );
		    ?>
		    <?php
	          /**
	           * woocommerce_after_single_product_summary hook
	           *
	           * @hooked woocommerce_output_related_products - 20
	           */
	          do_action( 'woocommerce_after_single_product_summary' );
	      ?>
	      <?php do_action( 'woocommerce_product_thumbnails' ); ?> 
		 	</div>
		  <div class="small-12 large-6 columns product-information">
				<?php
		  		/**
		  		 * woocommerce_before_single_product hook
		  		 *
		  		 * @hooked woocommerce_show_messages - 10
		  		 */
		  		 do_action( 'woocommerce_before_single_product' );
		  	?> 
		  	<?php echo thb_product_nav(); ?>
  			<?php do_action('thb_woocommerce_product_breadcrumb'); ?>
		    <?php
	        /**
	        	 * woocommerce_single_product_summary hook
	        	 *
	        	 * @hooked woocommerce_template_single_title - 5
	        	 * @hooked woocommerce_template_single_rating - 10
	        	 * @hooked woocommerce_template_single_price - 10
	        	 * @hooked woocommerce_template_single_excerpt - 20
	        	 * @hooked woocommerce_template_single_add_to_cart - 30
	        	 * @hooked woocommerce_template_single_meta - 40
	        	 * @hooked woocommerce_template_single_sharing - 50
	        	 */
	        do_action( 'woocommerce_single_product_summary' );
		    ?>
		  </div>
	</div>
	<meta itemprop="url" content="<?php the_permalink(); ?>" />
</div><!-- #product-<?php the_ID(); ?> -->
	</div>
</div>
<?php do_action( 'woocommerce_after_single_product' ); ?> 