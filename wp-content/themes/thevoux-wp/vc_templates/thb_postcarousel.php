<?php function thb_postcarousel( $atts, $content = null ) {
  $atts = vc_map_get_attributes( 'thb_postcarousel', $atts );
  extract( $atts );
	
	ob_start();
	switch($style) {
		case 'style1':
			$style_class = 'featured-style4';
			break;
		case 'style2':
			$style_class = 'featured-style5';
			break;
		case 'style3':
			$style_class = 'featured-style6';
			break;
		case 'style4':
			$style_class = $style;
			break;
		case 'style5':
			$style_class = 'featured-style-carousel';
			break;
	}
	$pagi = ($pagination == 'true' ? 'true' : 'false');
	$nav = ($navigation == 'true' ? 'true' : 'false');
	
	if ($style === 'style5') {
		$pagi = 'false';
		$nav = 'true';
	}
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
				'posts_per_page' => 99
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
	
	$classes[] = 'slick';
	$classes[] = $style_class;
	$classes[] = $pagi === 'true' ? 'dark-pagination bottom-margin' : false;
	$classes[] = ($style == 'style3' && $nav == 'true') ? 'outset-nav' : '';
	$classes[] = ($style == 'style5') ? 'outset-nav' : '';
	$classes[] = $style == 'style3' ? 'mini-columns' : '';
	$classes[] = $style == 'style6' ? 'row' : '';
	if ( $posts->have_posts() ) { ?>
		<div class="<?php echo implode(' ', $classes); ?>" data-center="<?php echo in_array($style, array('style3','style4','style5', 'style6')) ? 'false' : 'true'; ?>" data-columns="<?php echo esc_attr($columns); ?>" data-pagination="<?php echo esc_attr($pagi); ?>" data-navigation="<?php echo esc_attr($nav); ?>">
			<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
				<?php if ($style == 'style1') {?>
					<?php add_filter( 'excerpt_length', 'thb_supershort_excerpt_length' ); ?>
					<article <?php post_class('post featured-style4'); ?> itemscope itemtype="http://schema.org/Article" id="post-<?php the_ID(); ?>">
						<?php the_post_thumbnail('thevoux-single'); ?>
						<div class="featured-title">
							<aside class="post-meta cf"><?php the_category(', '); ?></aside>
							<div class="post-title">
								<h3 itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
							</div>
							<div class="post-excerpt">
								<?php the_excerpt(); ?>
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="more"><?php _e('Read More &rarr;', 'thevoux' ); ?></a>
							</div>
						</div>
						<?php do_action('thb_PostMeta'); ?>
					</article>
				<?php } else if ($style == 'style2') {?>
					<div class="columns">
						<article <?php post_class('post featured-style5'); ?> itemscope itemtype="http://schema.org/Article" id="post-<?php the_ID(); ?>">
							<figure class="post-gallery">
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('thevoux-single'); ?></a>
							</figure>
							<div class="post-title">
								<h5 itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
							</div>
							<div class="post-excerpt">
								<?php get_template_part( 'inc/templates/postbits/post-just-shares' ); ?>
							</div>
							<?php do_action('thb_PostMeta'); ?>
						</article>
					</div>
				<?php } else if ($style == 'style3') {?>
					<div class="columns">
						<article <?php post_class('post featured-style5'); ?> itemscope itemtype="http://schema.org/Article" id="post-<?php the_ID(); ?>">
							<figure class="post-gallery">
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('thevoux-single'); ?></a>
							</figure>
							<div class="post-title text-center">
								<h5 itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
							</div>
							<?php do_action('thb_PostMeta'); ?>
						</article>
					</div>
				<?php } else if ($style == 'style4') {?>
					<div class="columns">
						<article <?php post_class('post featured-style7'); ?> itemscope itemtype="http://schema.org/Article" id="post-<?php the_ID(); ?>">
							<figure class="post-gallery">
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('thevoux-vertical'); ?></a>
							</figure>
							<aside class="post-meta cf"><?php the_category(', '); ?></aside>
							<div class="post-title">
								
								<h4 itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
								<aside class="post-author">
									<em><?php _e('by', 'thevoux'); ?></em> <?php the_author_posts_link(); ?>
								</aside>
							</div>
							<?php do_action('thb_PostMeta'); ?>
						</article>
					</div>
				<?php } else if ($style == 'style5') {?>
					<article <?php post_class('post featured-style-carousel'); ?> itemscope itemtype="http://schema.org/Article" id="post-<?php the_ID(); ?>">
						<figure class="post-gallery">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?></a>
						</figure>
						<div class="post-title">
							<h6 itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h6>
						</div>
						<?php do_action('thb_PostMeta'); ?>
					</article>
				<?php } else if ($style == 'style6') {?>
					<div class="columns">
						<article <?php post_class('post featured-style7 inline-category-style text-center'); ?> itemscope itemtype="http://schema.org/Article" id="post-<?php the_ID(); ?>">
							<figure class="post-gallery">
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('thevoux-single'); ?></a>
							</figure>
							<?php if(has_category()) { ?>
							<aside class="post-meta cf"><?php the_category(', '); ?></aside>
							<?php } ?>
							<aside class="post-author cf">
								 - 
								<time class="time" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" itemprop="datePublished" content="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo thb_human_time_diff_enhanced(); ?></time>
							</aside>
							<div class="post-title">
								<h4 itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
							</div>
							<?php do_action('thb_PostMeta'); ?>
						</article>
					</div>
				<?php } ?>
			<?php endwhile; ?>
		</div>
	<?php }
 $out = ob_get_contents();
 if (ob_get_contents()) ob_end_clean();
 
 wp_reset_query();
 wp_reset_postdata();
return $out;
}
thb_add_short('thb_postcarousel', 'thb_postcarousel');
