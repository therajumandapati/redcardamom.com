<article itemscope itemtype="http://schema.org/Article" <?php post_class('post style2'); ?> id="post-<?php the_ID(); ?>" role="article">
	<div class="row">
		<div class="small-12 medium-5 large-6 columns">
			<?php if ( has_post_thumbnail() ) { ?>
			<figure class="post-gallery <?php do_action('thb_is_gallery'); ?><?php do_action('thb_is_review'); ?>">
				<?php do_action('thb_post_review_average'); ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('thevoux-style2',array('itemprop'=>'image')); ?></a>
			</figure>
			<?php } ?>
		</div>
		<div class="small-12 medium-7 large-6 columns">
				<?php if(has_category()) { ?>
				<aside class="post-meta cf"><?php the_category(', '); ?></aside>
				<?php } ?>
				<aside class="post-author cf">
					 - 
					<time class="time" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" itemprop="datePublished" content="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo thb_human_time_diff_enhanced(); ?></time>
				</aside>
				<header class="post-title">
					<h3 itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
				</header>
				<aside class="post-author">
					<em><?php _e('by', 'thevoux'); ?></em> <?php the_author_posts_link(); ?>
				</aside>
				<div class="post-content small">
					<?php get_template_part( 'inc/postformats/post-links' ); ?>
				</div>
		</div>
	</div>
</article>