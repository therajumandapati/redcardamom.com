<!-- Start Related Posts -->
<?php
	global $post; 
  $postId = $post->ID;
  
  if (is_singular('post')) {
  	$query = get_blog_posts_related_by_category($postId); 
  }
?>
<?php if ($query->have_posts()) : ?>
<div class="row post">
	<aside class="small-12 columns post-content related">
		<h4><strong><?php _e( 'Related News', 'thevoux' ); ?></strong></h4>
		<div class="row relatedposts hide-on-print" data-equal=">.columns">
		  <?php while ($query->have_posts()) : $query->the_post(); ?>             
		    <div class="small-6 medium-4 columns">
		    	<?php get_template_part( 'inc/loop/mega-menu' ); ?>
		    </div>
		  <?php endwhile; ?>
		</div>
	</aside>
</div>
<?php endif; ?>
<?php wp_reset_query(); ?>
<!-- End Related Posts -->