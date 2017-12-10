<?php add_filter( 'excerpt_length', 'thb_short_excerpt_length' ); ?>
<div class="small-12 medium-6 columns">
	<article <?php post_class('post blog-list'); ?> id="post-<?php the_ID(); ?>"itemscope itemtype="http://schema.org/Article">
		<?php if ( has_post_thumbnail() ) { ?>
		<figure class="post-gallery">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('thevoux-blog-list'); ?></a>
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
			<?php the_excerpt(); ?>
		</div>
		<?php do_action('thb_PostMeta'); ?>
	</article>
</div>