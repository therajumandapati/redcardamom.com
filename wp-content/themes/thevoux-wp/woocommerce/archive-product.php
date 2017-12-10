<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header('shop'); 

$shop_sidebar = isset($_GET['sidebar']) ? $_GET['sidebar'] : ot_get_option('shop_sidebar', 'no');

?>
<?php get_template_part( 'inc/templates/header/archive-title' ); ?>

<div class="row">
	<div class="small-12 columns small-order-1 large-order-2<?php if ($shop_sidebar !== 'no') { echo ' large-9'; } ?>">
	<?php
		/**
		 * woocommerce_before_main_content hook
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 */
		do_action('woocommerce_before_main_content');
	?>
		<section id="shop-page">
		
	
			<div class="shop_bar cf">
			    <div class="row">
			        <div class="small-12 medium-6 columns breadcrumbs">
			            <?php if ( have_posts() ) : ?>
			            		<?php do_action( 'thb_before_shop_loop_result_count' ); ?>
			            <?php endif; ?>
			        </div>
			        <div class="small-12 medium-6 columns ordering">
	                <?php if ( have_posts() ) : ?>
	                    <?php do_action( 'thb_before_shop_loop_catalog_ordering' ); ?>
	                <?php endif; ?>
			        </div>
			    </div>
			</div>
			
			<?php if ( have_posts() ) : ?>
			<?php
				/**
				 * woocommerce_before_shop_loop hook.
				 *
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
			?>
	
			<?php woocommerce_product_loop_start(); ?>
	
				<?php woocommerce_product_subcategories(); ?>
	
				<?php while ( have_posts() ) : the_post(); ?>
	
					<?php
						/**
						 * woocommerce_shop_loop hook.
						 *
						 * @hooked WC_Structured_Data::generate_product_data() - 10
						 */
						do_action( 'woocommerce_shop_loop' );
					?>
	
					<?php wc_get_template_part( 'content', 'product' ); ?>
	
				<?php endwhile; // end of the loop. ?>
	
			<?php woocommerce_product_loop_end(); ?>
	
			<?php
				/**
				 * woocommerce_after_shop_loop hook.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>
	
			<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
			
			<?php
				/**
				 * woocommerce_no_products_found hook.
				 *
				 * @hooked wc_no_products_found - 10
				 */
				do_action( 'woocommerce_no_products_found' );
			?>
	
			<?php endif; ?>
             
	 	</section>
	</div>
	<?php
		if ($shop_sidebar !== 'no') {
		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action( 'woocommerce_sidebar' );
		}
	?>
	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action('woocommerce_after_main_content');
	?>
</div><!-- end row -->

<?php get_footer('shop'); ?>