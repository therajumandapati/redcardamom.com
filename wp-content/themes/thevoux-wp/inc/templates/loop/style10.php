<?php add_filter( 'excerpt_length', 'thb_short_excerpt_length' ); ?>
<article itemscope itemtype="http://schema.org/Article" <?php post_class('post style1 style9'); ?> id="post-<?php the_ID(); ?>">
	<div class="row">
		<div class="small-12 medium-6 large-5 columns small-order-2 medium-order-1">
				<?php if(has_category()) { ?>
				<aside class="post-meta cf"><?php the_category(', '); ?></aside>
				<?php } ?>
				<aside class="post-author cf">
					 - 
					<time class="time" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" itemprop="datePublished" content="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo thb_human_time_diff_enhanced(); ?></time>
				</aside>
				<header class="post-title entry-header">
					<h3 itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
				</header>
				<div class="post-content small">
					<?php the_excerpt(); ?>
				</div>
				<aside class="post-author">
					<em><?php _e('by', 'thevoux'); ?></em> <?php the_author_posts_link(); ?>
				</aside>
				<?php get_template_part( 'inc/templates/postbits/post-links' ); ?>
		</div>
		<div class="small-12 medium-6 large-7 columns small-order-1 medium-order-2">
			<?php if ( has_post_thumbnail() ) { ?>
			<figure class="post-gallery <?php do_action('thb_is_gallery'); ?><?php do_action('thb_is_review'); ?>">
				<?php do_action('thb_post_review_average'); ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('thevoux-style9'); ?></a>
			</figure>
			<?php } ?>
		</div>
	</div>
	<?php do_action('thb_PostMeta'); ?>
</article>