<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product_cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$shop_columns = isset($_GET['shop_columns']) ? htmlspecialchars($_GET['shop_columns']) : ot_get_option('shop_columns', 4);

switch($shop_columns) {
	case '2':
		$columns = 'small-6';
		break;
	case '3':
		$columns = 'small-6 medium-4 large-4';
		break;
	case '4':
		$columns = 'small-6 medium-6 large-3';
		break;	
	case '5':
		$columns = 'small-6 medium-4 large-24';
		break;
	case '6':
		$columns = 'small-6 medium-4 large-2';
		break;
}
$product_categories = false;

$term 				= get_queried_object();
$parent_id 		= empty( $term->term_id ) ? 0 : $term->term_id;
$categories 	= get_terms('product_cat', array('hide_empty' => 0, 'parent' => $parent_id));

/* Shop Page */
if ( is_shop() && (get_option('woocommerce_shop_page_display') == 'subcategories') ) $product_categories = 'only';
if ( is_shop() && (get_option('woocommerce_shop_page_display') == 'both') ) $product_categories = 'both';

/* Category Page */
if ( is_product_category() && (get_option('woocommerce_category_archive_display') == 'subcategories') ) $product_categories = 'only';
if ( is_product_category() && (get_option('woocommerce_category_archive_display') == 'both') ) $product_categories = 'both';

if ( is_product_category() && (get_woocommerce_term_meta($parent_id, 'display_type', true) == 'subcategories' ) ) $product_categories = 'only';
if ( is_product_category() && (get_woocommerce_term_meta($parent_id, 'display_type', true) == 'both') ) $product_categories = 'both';

?>
<?php if (!is_paged() && $categories && ($product_categories === 'only')) { ?>
<div class="item <?php echo esc_attr($columns); ?> columns">
	<article <?php wc_product_cat_class( '', $category ); ?>>
		
		<span><?php echo $category->name; ?></span>
		
		<div class="title">
			<h2><a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>" title="<?php echo esc_attr($category->name); ?>"><?php echo $category->name; ?></a></h2>
		</div>
		
		<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>" title="<?php echo esc_attr($category->name); ?>"><figure><?php do_action( 'woocommerce_before_subcategory_title', $category ); ?></figure></a>
		
			<?php
				/**
				 * woocommerce_after_subcategory_title hook
				 */
				do_action( 'woocommerce_after_subcategory_title', $category );
			?>
	</article>
</div>
<?php } ?>
<?php if ($categories && ($product_categories === 'both')) { ?>
<li>
	<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">
		<?php echo esc_html($category->name); ?>
	</a>
</li>
<?php } ?>