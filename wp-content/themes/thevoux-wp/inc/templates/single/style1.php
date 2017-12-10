<?php 
	$vars = $wp_query->query_vars;
	$thb_ajax = array_key_exists('thb_ajax', $vars) ? $vars['thb_ajax'] : false;
  $logo = ot_get_option('thb_logo') ? ot_get_option('thb_logo') : THB_THEME_ROOT. '/assets/img/logo.png';
	$fixed = ot_get_option('article_fixed_sidebar', 'on'); 
	$fullwidth = ot_get_option('article_fullwidth', 'off');
	$dropcap = ot_get_option('article_dropcap', 'on');
	$adv_postend = ot_get_option('adv_postend');
	$adv_postend_ajax = ot_get_option('adv_postend_ajax');
?>
<div class="post-detail-row">
	<div class="row"<?php if ($fixed == 'on') { ?> data-equal=">.columns"<?php } ?>>
		<div class="small-12 medium-12 <?php echo ($fullwidth == 'on' ? 'large-12' : 'large-8'); ?>  columns">
			<article itemscope itemtype="http://schema.org/Article" <?php post_class('post post-detail'); ?> id="post-<?php the_ID(); ?>" data-id="<?php the_ID(); ?>" data-url="<?php the_permalink(); ?>">
				<?php if(has_category()) { ?>
				<aside class="post-meta cf"><?php the_category(', '); ?></aside>
				<?php } ?>
				<header class="post-title entry-header">
					<?php if ( $thb_ajax ) { ?>
						<?php the_title('<h1 class="entry-title" itemprop="headline">', '</h1>'); ?>
					<?php } else { ?>
						<?php the_title('<h1 class="entry-title" itemprop="headline"><a href="'.get_permalink().'" title="'.the_title_attribute("echo=0").'">', '</a></h1>'); ?>
					<?php } ?>
				</header>
				<aside class="post-author">
					<time class="time" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" itemprop="datePublished" content="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo thb_human_time_diff_enhanced(); ?></time> <em><?php _e('by', 'thevoux'); ?></em> <span itemprop="author"><?php the_author_posts_link(); ?></span>
				</aside>
				<?php do_action('thb_social_article_detail', false, true, 'show-for-medium'); ?>
				<div class="post-content-container">
					<?php
					  // The following determines what the post format is and shows the correct file accordingly
					  $format = get_post_format();
					  if ($format) {
					  	set_query_var( 'thb_image_size', 'thevoux-single' );
					  	get_template_part( 'inc/templates/postbits/'.$format );
					  }
					?>
					<div class="post-content entry-content cf"<?php if ($dropcap== 'on') { ?> data-first="<?php echo thb_FirstLetter(); ?>"<?php } ?> itemprop="articleBody">
						<?php echo the_content(); ?>
						
						<?php
							wp_link_pages( array(
								'before' => '<div class="page-links">' . __( 'Pages:', 'thevoux' ),
								'after'  => '</div>',
							) );
						?>
						<?php do_action('thb_post_review'); ?>
						<?php get_template_part( 'inc/templates/postbits/tags' ); ?>
						<?php get_template_part( 'inc/templates/postbits/author' ); ?>
					</div>
				</div>
				<?php do_action('thb_social_article_detail', false, false, 'hide-for-medium'); ?>
				<?php do_action('thb_PostMeta'); ?>
			</article>
			<?php comments_template('', true ); ?>
			<?php if (!$thb_ajax && ot_get_option('related_posts', 'on') !== 'off') { ?>
				<?php get_template_part( 'inc/templates/postbits/post-related' ); ?>
			<?php } ?>
		</div>
		<?php if ($fullwidth == 'off') { ?>
			<?php 
				if ( !$thb_ajax ) { 
					get_sidebar('single');
			 	} else {
			 		get_sidebar('single-ajax');
			 	}
			 ?>
		 <?php } ?>
	</div>
	<?php 
		if ( !$thb_ajax && $adv_postend) { 
			echo '<aside class="ad_container_bottom">'.do_shortcode(wp_kses_post($adv_postend)).'</aside>';
	 	} else if ( $thb_ajax && $adv_postend_ajax) {
	 		echo '<aside class="ad_container_bottom">'.do_shortcode(wp_kses_post($adv_postend_ajax)).'</aside>';
	 	}
	 ?>
</div>