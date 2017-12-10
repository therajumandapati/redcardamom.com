<?php function thb_postgrid( $atts, $content = null ) {
  $atts = vc_map_get_attributes( 'thb_postgrid', $atts );
  extract( $atts );
    
  $featured_index = empty($featured_index) ? array() : explode(',',$featured_index);
	$args = array(
		'post_type'=>'post', 
		'post_status' => 'publish', 
		'ignore_sticky_posts' => 1
	);
	if ($offset) {
		if ( $pagination !== 'true') {
			$args = wp_parse_args( 
				array(
					'offset' => $offset,
				)
			, $args );
		}
	}
	if ($source == 'most-recent') {
		$excluded_tag_ids = explode(',',$excluded_tag_ids);
		$excluded_cat_ids = explode(',',$excluded_cat_ids);
		$paged = is_front_page() ? get_query_var( 'page', 1 ) : get_query_var( 'paged', 1 );
		$args = wp_parse_args( 
			array(
				'posts_per_page' => $item_count,
				'tag__not_in' => $excluded_tag_ids,
				'category__not_in' => $excluded_cat_ids
			)
		, $args );
		
		if ( $pagination == 'true') {
			$args = wp_parse_args( 
				array(
					'paged' => $paged
				)
			, $args );
		}
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

 	$posts = query_posts( $args );
 	ob_start();
 	$title_el = $title_style == 'style3' ? '<span>' : '<h2>'; 
 	$title_el_close = $title_style == 'style3' ? '</span>' : '</h2>';
	if ( have_posts() ) { ?>
		<?php switch($columns) {
			case 2:
				$col = 'medium-6 large-6';
				break;
			case 3:
				$col = 'medium-4 large-4';
				break;
			case 4:
				$col = 'medium-6 large-3';
				break;
			case 6:
				$col = 'medium-4 large-2';
				break;
		} ?>
		<?php if ($add_title === 'true') { ?>
			<div class="category_title <?php echo esc_attr($title_style); ?>">
				<?php echo $title_el; ?><?php echo esc_attr($title); ?><?php echo $title_el_close; ?>
			</div>
		<?php }?>
		<?php if ($style == 'style1') { ?>
			<div class="row posts <?php if ($source == 'most-recent') { echo 'ajaxify-pagination'; } ?> <?php echo esc_attr('columns-'.$columns); ?>">
				<?php while ( have_posts() ) : the_post(); ?>
					<div class="small-12 <?php echo esc_attr($col); ?> columns">
					
						<?php 
							set_query_var( 'disable_excerpts', $disable_excerpts );
							set_query_var( 'disable_postmeta', $disable_postmeta );
							get_template_part( 'inc/templates/loop/style6' ); 
						?>
					</div>
				<?php endwhile; // end of the loop. ?>
				<?php 
					if ($source == 'most-recent' && $pagination == 'true') {
						the_posts_pagination(array(
							'prev_text' 	=> '<span>'.esc_html__( "&larr;", 'thevoux' ).'</span>',
							'next_text' 	=> '<span>'.esc_html__( "&rarr;", 'thevoux' ).'</span>',
							'mid_size'		=> 2
						));
					}
				?>
			</div>
		<?php } else if ($style == 'style4') { ?>
			<div class="row posts <?php if ($source == 'most-recent') { echo 'ajaxify-pagination'; } ?> <?php echo esc_attr('columns-'.$columns); ?>">
				<?php while ( have_posts() ) : the_post(); ?>
					<div class="small-12 <?php echo esc_attr($col); ?> columns">
					
						<?php 
							get_template_part( 'inc/templates/loop/style7' ); 
						?>
					</div>
				<?php endwhile; // end of the loop. ?>
				<?php 
					if ($source == 'most-recent' && $pagination == 'true') {
						the_posts_pagination(array(
							'prev_text' 	=> '<span>'.esc_html__( "&larr;", 'thevoux' ).'</span>',
							'next_text' 	=> '<span>'.esc_html__( "&rarr;", 'thevoux' ).'</span>',
							'mid_size'		=> 2
						));
					}
				?>
			</div>
		<?php } else if ($style == 'style2') { ?>
			<div class="posts border <?php if ($source == 'most-recent') { echo 'ajaxify-pagination'; } ?>">
				<?php $i = 1; while ( have_posts() ) : the_post(); ?>
					<?php if (in_array($i, $featured_index )) { ?>
						<?php get_template_part( 'inc/templates/loop/style7' ); ?>
					<?php } else { ?>
						<?php get_template_part( 'inc/templates/loop/style1' ); ?>
					<?php } ?>
				<?php $i++; endwhile; // end of the loop. ?>
				<?php 
					if ($source == 'most-recent' && $pagination == 'true') {
						the_posts_pagination(array(
							'prev_text' 	=> '<span>'.esc_html__( "&larr;", 'thevoux' ).'</span>',
							'next_text' 	=> '<span>'.esc_html__( "&rarr;", 'thevoux' ).'</span>',
							'mid_size'		=> 2
						));
					}
				?>
			</div>
		<?php } else if ($style == 'style3') { ?>
			<div class="posts border-vertical <?php if ($source == 'most-recent') { echo 'ajaxify-pagination'; } ?>">
				<div class="row no-padding full-width-row">
					<?php $i = 1; while ( have_posts() ) : the_post(); ?>
						<div class="small-12 large-6 columns <?php if ($i % 2 == 0) { ?>even<?php } ?>">
							<?php get_template_part( 'inc/templates/loop/style2' ); ?>
						</div>
					<?php $i++; endwhile; // end of the loop. ?>
				</div>
				<?php 
					if ($source == 'most-recent' && $pagination == 'true') {
						the_posts_pagination(array(
							'prev_text' 	=> '<span>'.esc_html__( "&larr;", 'thevoux' ).'</span>',
							'next_text' 	=> '<span>'.esc_html__( "&rarr;", 'thevoux' ).'</span>',
							'mid_size'		=> 2
						));
					}
				?>
			</div>
		<?php } else if ($style == 'style5') { ?>
			<div class="posts border <?php if ($source == 'most-recent') { echo 'ajaxify-pagination'; } ?>">
					<?php $i = 1; while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'inc/templates/loop/style9' ); ?>
					<?php $i++; endwhile; // end of the loop. ?>
				<?php 
					if ($source == 'most-recent' && $pagination == 'true') {
						the_posts_pagination(array(
							'prev_text' 	=> '<span>'.esc_html__( "&larr;", 'thevoux' ).'</span>',
							'next_text' 	=> '<span>'.esc_html__( "&rarr;", 'thevoux' ).'</span>',
							'mid_size'		=> 2
						));
					}
				?>
			</div>
		<?php }else if ($style == 'style6') { ?>
			<div class="posts style6-posts <?php if ($source == 'most-recent') { echo 'ajaxify-pagination'; } ?>">
					<?php $i = 1; while ( have_posts() ) : the_post(); ?>
							<?php 
								set_query_var( 'thb_image_size', 'thevoux-large' );
								get_template_part( 'inc/templates/loop/style7' ); 
							?>
					<?php $i++; endwhile; // end of the loop. ?>
				<?php 
					if ($source == 'most-recent' && $pagination == 'true') {
						the_posts_pagination(array(
							'prev_text' 	=> '<span>'.esc_html__( "&larr;", 'thevoux' ).'</span>',
							'next_text' 	=> '<span>'.esc_html__( "&rarr;", 'thevoux' ).'</span>',
							'mid_size'		=> 2
						));
					}
				?>
			</div>
		<?php } ?>
	<?php }

   $out = ob_get_contents();
   if (ob_get_contents()) ob_end_clean();
   
   wp_reset_query();
   wp_reset_postdata();
     
  return $out;
}
thb_add_short('thb_postgrid', 'thb_postgrid');
