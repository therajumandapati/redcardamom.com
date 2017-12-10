<div class="small-12 medium-6 columns">
	<article itemscope itemtype="http://schema.org/BlogPosting" <?php post_class('post blog-list'); ?> id="post-<?php the_ID(); ?>" role="article">
		<?php if ( has_post_thumbnail() ) { ?>
		<figure class="post-gallery">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('thevoux-blog-list',array('itemprop'=>'image')); ?></a>
		</figure>
		<?php } ?>
		<?php if(has_category()) { ?>
		<aside class="post-meta cf"><?php the_category(', '); ?></aside>
		<?php } ?>
		<header class="post-title entry-header">
			<h4 class="entry-title" itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
		</header>
		<aside class="post-author">
			<time class="time" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" itemprop="datePublished" content="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo thb_human_time_diff_enhanced(); ?></time> <em><?php _e('by', 'thevoux'); ?></em> <?php the_author_posts_link(); ?>
		</aside>
		<div class="post-content">
			<?php echo thb_excerpt(200, '...'); ?>
		</div>
	</article>
</div>