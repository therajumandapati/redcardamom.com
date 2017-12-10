<?php function thb_postcategory( $atts, $content = null ) {
  $atts = vc_map_get_attributes( 'thb_postcategory', $atts );
	extract( $atts );
	
	switch($style) {
		case 'style5':
			$ppp = 4;
			break;
		default:
			$ppp = 5;
			break;
	}
	$args = array(
		'cat' => $cat,
		'posts_per_page' => $ppp,
		'ignore_sticky_posts' => 1,
		'no_found_rows' => true
	);
	if ($offset) {
		$args = wp_parse_args( 
			array(
				'offset' => $offset,
			)
		, $args );
	}
	$posts = new WP_Query( $args );
 	$i = 0;
 	ob_start();
	
	$title_el = $title_style == 'style3' ? '<span>' : '<h2>'; 
	$title_el_close = $title_style == 'style3' ? '</span>' : '</h2>';
	if ( $posts->have_posts() ) { ?>
		<div class="row endcolumn catelement-<?php echo esc_attr($style); ?>">
			<?php if ($style !== 'style4') { ?>
					<div class="small-12 columns">
						<div class="category_title catstyle-<?php echo esc_attr($style. ' '.$title_style); ?>">
							<?php echo $title_el; ?><a href="<?php echo get_category_link($cat); ?>" title="<?php echo get_cat_name( $cat ); ?>"><?php echo get_cat_name( $cat ); ?></a><?php echo $title_el_close; ?>
						</div>
					</div>
			<?php } ?>
	  		<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
	  			<?php if ($style == 'style1') { ?>
		  			<?php if ($i == 0) { ?>
		  				<div class="small-12 medium-6 columns">
		  					<?php get_template_part( 'inc/templates/loop/style3' ); ?>
		  				</div>
		  				<div class="small-12 medium-6 columns">
		  			<?php } ?>
			  			<?php if ($i == 1 || $i == 3) { ?>
			  					<div class="row">
			  			<?php } ?>
			  			<?php if ($i > 0) { ?>
			  						<div class="small-12 medium-6 columns">
			  							<?php get_template_part( 'inc/templates/loop/style3-small' ); ?>
			  						</div>
			  			<?php } ?>
			  			<?php if ($i + 1 == $posts->post_count ||$i == 2 || $i == 4) { ?>
			  					</div>
			  			<?php } ?>
		  			<?php if ($i + 1 == $posts->post_count) { ?>
	  					</div>
	  				<?php } ?>	
	  			<?php } else if ($style == 'style2') { ?>
	  				<?php if ($i == 0) { ?>
  						<div class="small-12 medium-6 columns">
  							<?php get_template_part( 'inc/templates/loop/style3' ); ?>
  						</div>
  					<?php } ?>
  					<?php if ($i > 0) { ?>
  						<?php if ($i == 1) { ?>
  							<div class="small-12 medium-6 columns">
  						<?php } ?>
  						<?php if ($i > 0) { ?>
  							<?php set_query_var( 'excerpts', true ); ?>
  							<?php get_template_part( 'inc/templates/loop/style4' ); ?>
  						<?php } ?>
  						<?php if ($i + 1 == $posts->post_count) { ?>
  							</div>
  						<?php } ?>	
  					<?php } ?>
	  			<?php } else if ($style == 'style3') { ?>
	  				
	  				<?php if ($i == 0) { ?>
	  					<div class="small-12 columns">
	  						<?php get_template_part( 'inc/templates/loop/style3' ); ?>
	  				<?php } ?>
	  					<?php if ($i > 0) { ?>
	  						<?php set_query_var( 'excerpts', true ); ?>
  							<?php get_template_part( 'inc/templates/loop/style4' ); ?>
	  					<?php } ?>
	  				<?php if ($i + 1 == $posts->post_count) { ?>
  						</div>
  					<?php } ?>
	  			<?php } else if ($style == 'style3-alt') { ?>
	  				
	  				<?php if ($i == 0) { ?>
	  					<div class="small-12 columns">
	  						<?php get_template_part( 'inc/templates/loop/style3' ); ?>
	  				<?php } ?>
	  					<?php if ($i > 0) { ?>
	  						<?php set_query_var( 'excerpts', false ); ?>
	  						<?php get_template_part( 'inc/templates/loop/style4' ); ?>
	  					<?php } ?>
	  				<?php if ($i + 1 == $posts->post_count) { ?>
	  					</div>
	  				<?php } ?>
	  			<?php } else if ($style == 'style4') { ?>
	  				<?php if ($i == 0) { ?>
	  					<div class="small-12 columns">
		  					<div class="category_container">
		  						<div class="inner">
		  							<div class="category_title catstyle-<?php echo $style; ?>">
		  								<h2><a href="<?php echo get_category_link($cat); ?>" title="<?php echo get_cat_name( $cat ); ?>"><?php echo get_cat_name( $cat ); ?></a></h2>
		  							</div>
		  							<div class="small-12 medium-3 columns">
		  								<?php set_query_var( 'thb_excerpt', false ); get_template_part( 'inc/templates/loop/style5' ); ?>
  					<?php } ?>
	  					<?php if ($i == 1) { ?>
	  							<?php set_query_var( 'thb_excerpt', false ); get_template_part( 'inc/templates/loop/style5' ); ?>
	  						</div>
	  					<?php } ?>
	  					<?php if ($i == 2) { ?>
	  						<div class="small-12 medium-6 columns">
								<?php set_query_var( 'thb_excerpt', true ); get_template_part( 'inc/templates/loop/style5' ); ?>
							</div>
						<?php } ?>
						<?php if ($i == 3) { ?>
							<div class="small-12 medium-3 columns">
								<?php set_query_var( 'thb_excerpt', false ); get_template_part( 'inc/templates/loop/style5' ); ?>
						<?php } ?>
						<?php if ($i == 4) { ?>
								<?php set_query_var( 'thb_excerpt', false ); get_template_part( 'inc/templates/loop/style5' ); ?>
							</div>
						<?php } ?>
  					<?php if ($i + 1 == $posts->post_count) { ?>
								
								</div>
							</div>
						</div>
						<?php } ?>
	  			<?php } else if ($style == 'style5') { ?>
	  				<?php if ($i == 0) { ?>
	  					<div class="small-12 columns">
	  						<?php get_template_part( 'inc/templates/loop/style8' ); ?>
	  					</div>
	  				<?php } ?>
  					<?php if ($i > 0) { ?>
  						<div class="small-12 medium-4 columns">
  						<?php get_template_part( 'inc/templates/loop/style3-small' ); ?>
  						</div>
  					<?php } ?>
	  			<?php } ?>
	  		<?php $i++; endwhile; // end of the loop. ?>
	  	</div>
	<?php }

   $out = ob_get_contents();
   if (ob_get_contents()) ob_end_clean();
   
   wp_reset_query();
   wp_reset_postdata();
     
  return $out;
}
thb_add_short('thb_postcategory', 'thb_postcategory');
