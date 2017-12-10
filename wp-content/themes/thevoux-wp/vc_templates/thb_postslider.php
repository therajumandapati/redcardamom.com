<?php function thb_postslider( $atts, $content = null ) {
  $atts = vc_map_get_attributes( 'thb_postslider', $atts );
  extract( $atts );
  
 	ob_start();
 	$pagi = ($pagination == 'true' ? 'true' : 'false');
 	$nav = ($navigation == 'true' ? 'true' : 'false');
 	
 	$args = array(
 		'nopaging' => 0, 
 		'post_type'=>'post', 
 		'post_status' => 'publish', 
 		'ignore_sticky_posts' => 1,
 		'no_found_rows' => true,
 		'suppress_filters' => 0
 	);
 	if ($offset) {
 		$args = wp_parse_args( 
 			array(
 				'offset' => $offset,
 			)
 		, $args );
 	}
 	if ($source == 'most-recent') {
 		$excluded_tag_ids = explode(',',$excluded_tag_ids);
 		$excluded_cat_ids = explode(',',$excluded_cat_ids);
 		$args = wp_parse_args( 
 			array(
 				'posts_per_page' => $item_count,
 				'tag__not_in' => $excluded_tag_ids,
 				'category__not_in' => $excluded_cat_ids
 			)
 		, $args );
 	} else if ($source == 'by-category') {
 	 	if (!empty($cat)) {
 	 		$cats = explode(',',$cat);
 	 		$args = wp_parse_args( 
 	 			array(
 	 				'posts_per_page' => $item_count,
 	 				'category__in' => $cats
 	 			)
 	 		, $args );	
 	 	}
 	} else if ($source == 'by-id') {
 		$post_id_array = explode(',', $post_ids);
 		
 		$args = wp_parse_args( 
 			array(
 				'post__in' => $post_id_array,
 				'posts_per_page' => 99,
 			)
 		, $args );	
 	} else if ($source == 'by-tag') {
 		$post_tag_array = explode(',', $tag_slugs);
 		
 		$args = wp_parse_args( 
 			array(
 				'posts_per_page' => $item_count,
 				'tag_slug__in' => $post_tag_array
 			)
 		, $args );	
 	} else if ($source == 'by-share') {
 		
 		$args = wp_parse_args( 
 			array(
 				'posts_per_page' => $item_count,
 				'meta_key' => 'thb_pssc_counts',  
 				'orderby' => 'meta_value_num'
 			)
 		, $args );	
 	} else if ($source == 'by-author') {
 		$post_author_array = explode(',', $author_ids);
 		
 		$args = wp_parse_args( 
 			array(
 				'posts_per_page' => $item_count,
 				'author__in' => $post_author_array
 			)
 		, $args );	
 	}
 	$posts = new WP_Query( $args );
 	if ( $posts->have_posts() ) { ?>
	<div class="slick <?php echo esc_attr($style); ?> <?php echo ($style == 'featured-style3' || $style == 'featured-style9') ? 'dark-pagination' : ''; ?> <?php echo ($style == 'featured-style10') ? 'fly-nav' : ''; ?>" data-columns="1" data-pagination="<?php echo esc_attr($pagi); ?>" data-navigation="<?php echo esc_attr($nav); ?>">
		<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
			<?php
			    $image_id = get_post_thumbnail_id();
			    $image_link = wp_get_attachment_image_src($image_id,'full');
					$image = wpb_resize( $image_id, null, $width, $height, true);  // Blog
					$image = $image['url'];
					if (function_exists('jetpack_photon_url')) {
						$image = jetpack_photon_url( $image_link[0], $args = array(
		            'resize'   => $width.','.$height,
		        ));
					}
			?>
			<article <?php post_class('post '.$style); ?>>
				<figure class="post-gallery <?php do_action('thb_is_gallery'); ?>">
					<?php if ( has_post_thumbnail() ) { ?>
					<img src="<?php echo esc_url($image); ?>" width="<?php echo esc_attr($width); ?>px" height="<?php echo esc_attr($height); ?>px" />
					<?php } ?>
				</figure>
				<div class="featured-title">
					<aside class="post-meta cf"><?php the_category(', '); ?></aside>
					<div class="post-title">
						<h3 itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
					</div>
					<aside class="post-author">
						<em><?php _e('by', 'thevoux'); ?></em> <?php the_author_posts_link(); ?>
					</aside>
					<?php if ($style === 'featured-style10') { get_template_part( 'inc/templates/postbits/post-links-style2' );  } ?>
				</div>
			</article>
		<?php endwhile; ?>
	</div>
	<?php }
   $out = ob_get_contents();
   if (ob_get_contents()) ob_end_clean();
   
   wp_reset_query();
   wp_reset_postdata();
  return $out;
}
thb_add_short('thb_postslider', 'thb_postslider');