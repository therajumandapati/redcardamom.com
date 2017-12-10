<?php
	if (is_category()) {
		$cat = get_queried_object();
		$cat_id = $cat->term_id;	
		$category_header = ot_get_option('category_headers');
		$category_bg = isset($category_header[$cat_id]['bg']) ? $category_header[$cat_id]['bg'] : THB_THEME_ROOT .'/assets/img/archive-title.jpg';
		$category_color = isset($category_header[$cat_id]['color']) ? $category_header[$cat_id]['color'] : '#fff';
	}
?>
<!-- Start Archive title -->
<div id="category-title" class="parallax_bg" style="background-image: url('<?php echo esc_attr($category_bg); ?>');">
	<div class="row">
		<div class="small-12 medium-10 large-8 medium-centered columns">
				<?php echo '<h1 style="color:'.$category_color.';">'.single_cat_title('', false).'</h1>'; ?>
			 <?php if ($desc = category_description()) { echo $desc; }?> 
		</div>
	</div>
</div>
<!-- End Archive title -->