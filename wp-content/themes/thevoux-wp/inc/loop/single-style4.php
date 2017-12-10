<?php 
  $logo = ot_get_option('thb_logo') ? ot_get_option('thb_logo') : THB_THEME_ROOT. '/assets/img/logo.png';
	$fixed = ot_get_option('article_fixed_sidebar', 'on'); 
	$fullwidth = ot_get_option('article_fullwidth', 'off');
	$dropcap = ot_get_option('article_dropcap', 'on');
	$adv_postend = ot_get_option('adv_postend');
	$adv_postend_ajax = ot_get_option('adv_postend_ajax');
?>
<div class="post-detail-row">
	<div class="row">
		<div class="small-12 medium-12 large-offset-1 large-10 columns">
			<article itemscope itemtype="http://schema.org/Article" <?php post_class('post post-detail post-detail-style4'); ?> id="post-<?php the_ID(); ?>" role="article" data-id="<?php the_ID(); ?>" data-url="<?php the_permalink(); ?>">
				<?php if(has_category()) { ?>
				<aside class="post-meta cf"><?php the_category(', '); ?></aside>
				<?php } ?>
				<header class="post-title entry-header">
					<?php if ( $ajax == '0' ) { ?>
						<?php the_title('<h1 class="entry-title" itemprop="headline">', '</h1>'); ?>
					<?php } else { ?>
						<?php the_title('<h1 class="entry-title" itemprop="headline"><a href="'.get_permalink().'" title="'.the_title_attribute("echo=0").'">', '</a></h1>'); ?>
					<?php } ?>
				</header>
				<aside class="post-author">
					<meta itemprop="dateModified" content="<?php the_modified_date('c'); ?>">
					<time class="time" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" itemprop="datePublished" content="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo thb_human_time_diff_enhanced(); ?></time> <em><?php _e('by', 'thevoux'); ?></em> <span itemprop="author"><?php the_author_posts_link(); ?></span>
					<span class="hide" itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
						<meta itemprop="name" content="<?php echo esc_attr(get_bloginfo('name')); ?>">
						<span itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
							<meta itemprop="url" content="<?php echo esc_url($logo); ?>">
						</span>
					</span>
					<meta itemscope itemprop="mainEntityOfPage" itemtype="https://schema.org/WebPage" itemid="<?php the_permalink(); ?>">
				</aside>
				<?php
				  // The following determines what the post format is and shows the correct file accordingly
				  $format = get_post_format();
				  if ($format) {
				  	get_template_part( 'inc/postformats/'.$format );
				  }
				?>
				<?php do_action('thb_social_article_detail', false, true, 'hide-for-small'); ?>
				<div class="post-content-container">
					<div class="post-content entry-content cf"<?php if ($dropcap== 'on') { ?> data-first="<?php echo thb_FirstLetter(); ?>"<?php } ?> itemprop="articleBody">
						<?php echo the_content(); ?>
						
						<?php
							wp_link_pages( array(
								'before' => '<div class="page-links">' . __( 'Pages:', 'thevoux' ),
								'after'  => '</div>',
							) );
						?>
						<?php do_action('thb_post_review'); ?>
						<?php $posttags = get_the_tags(); ?>
						<?php if (!empty($posttags)) { ?>
						<footer class="article-tags entry-footer">
							<strong><?php _e('Tags:', 'thevoux'); ?></strong> 
							<?php
							if ($posttags) {
								$return = '';
								foreach($posttags as $tag) {
									$return .= '<a href="'. get_tag_link($tag->term_id).'" title="'. get_tag_link($tag->name).'">' . $tag->name . '</a>, ';
								}
								echo substr($return, 0, -2);
							} ?>
						</footer>
						<?php } ?>
						<?php if (ot_get_option('article_author', 'on') == 'on') { ?> 
						<div class="category_container author-information">
							<div class="inner">
								<section id="authorpage" class="authorpage">
									<?php do_action('thb_author'); ?>
								</section>
							</div>
						</div>
						<?php } ?>
					</div>
					<div class="cf"></div>
				</div>
				<?php do_action('thb_social_article_detail', false, false, 'show-for-small'); ?>
			</article>
			<?php if ( $ajax == '0' ) { ?>
			<!-- Start #comments -->
			<section id="comments" class="cf full">
				<?php comments_template('', true ); ?>
			</section>
			<!-- End #comments -->
			<?php } ?>
			<?php if ($ajax == '0' && ot_get_option('related_posts', 'on') !== 'off') { ?>
				<?php get_template_part( 'inc/postformats/post-related' ); ?>
			<?php } ?>
		</div>
	</div>
	<?php 
		if ( $ajax == '0' && $adv_postend) { 
			echo '<aside class="ad_container_bottom">'.do_shortcode(wp_kses_post($adv_postend)).'</aside>';
	 	} else if ( $ajax == '1' && $adv_postend_ajax) {
	 		echo '<aside class="ad_container_bottom">'.do_shortcode(wp_kses_post($adv_postend_ajax)).'</aside>';
	 	}
	 ?>
</div>