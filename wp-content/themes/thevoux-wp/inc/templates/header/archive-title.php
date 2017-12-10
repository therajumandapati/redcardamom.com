<?php
	$id = get_queried_object_id();
	$header_boxed = ot_get_option('header_boxed', 'off');
?>
<!-- Start Archive title -->
<?php if ($header_boxed === 'on') { ?>
<div class="row">
	<div class="small-12 columns">
<?php } ?>
<div id="archive-title">
	<div class="row">
		<div class="small-12 medium-10 large-8 medium-centered columns">
				<h1><?php 
						if( thb_wc_supported() ) {
							if( thb_is_woocommerce() ) {
								if (is_account_page() || is_cart() || is_checkout()) {
									echo get_the_title();	
								} else {
								woocommerce_page_title(); 
								}
							} else if (is_archive()) {
								echo get_the_archive_title();
							} else if (is_search()) {
								echo __('Search Results for: ', 'thevoux');
								the_search_query();
							} else {
								echo get_the_title($id);
							}
						} else if (is_archive()) {
							echo get_the_archive_title();
						} else if (is_search()) {
							echo __('Search Results for: ', 'thevoux');
							the_search_query();
						} else {
							echo get_the_title();
						}
					?></h1>
			 <?php if ($desc = tag_description()) { echo $desc; }?> 
		</div>
	</div>
</div>
<?php if ($header_boxed === 'on') { ?>
	</div>
</div>
<?php } ?>
<!-- End Archive title -->