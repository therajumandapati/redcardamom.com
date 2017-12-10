<?php
	$id = get_queried_object_id();
?>
<!-- Start Archive title -->
<div id="archive-title">
	<div class="row">
		<div class="small-12 medium-10 large-8 medium-centered columns">
				<h1><?php 
						if(class_exists('woocommerce')) {
							if( is_woocommerce() ) {
								woocommerce_page_title(); 
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
<!-- End Archive title -->