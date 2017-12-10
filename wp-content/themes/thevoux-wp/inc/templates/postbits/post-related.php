<!-- Start Related Posts -->
<?php
	global $post; 
  $postId = get_the_id();
  	$tags = wp_get_post_tags($postId);
  
	if ($tags) {
	  $tag_ids = array();
		foreach($tags as $individual_tag) { $tag_ids[] = $individual_tag->term_id; }
	  $args = array(
	    'tag__in' => $tag_ids,
	    'post__not_in' => array($postId),
	    'posts_per_page' => ot_get_option('related_count', '6'),
	    'ignore_sticky_posts' => 1,
	    'no_found_rows' => true,
	  );
	$related_posts = new WP_Query( $args );
	
	if ($related_posts->have_posts()) : ?>
	<div class="row post">
		<aside class="small-12 columns post-content related">
			<h4><strong><?php _e( 'Related News', 'thevoux' ); ?></strong></h4>
			<div class="row relatedposts hide-on-print">
			  <?php while ($related_posts->have_posts()) : $related_posts->the_post(); ?>             
			    <div class="small-6 medium-4 columns">
			    	<?php get_template_part( 'inc/templates/loop/mega-menu' ); ?>
			    </div>
			  <?php endwhile; ?>
			</div>
		</aside>
	</div>
	<?php endif; 
	}
	wp_reset_postdata();
?>
<!-- End Related Posts -->