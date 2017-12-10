<article itemscope itemtype="http://schema.org/Article" <?php post_class('post style8'); ?> id="post-<?php the_ID(); ?>" role="article">
	<figure class="post-gallery <?php do_action('thb_is_gallery'); ?><?php do_action('thb_is_review'); ?>">
		<?php do_action('thb_post_review_average'); ?>
		<?php the_post_thumbnail('thevoux-featured',array('itemprop'=>'image')); ?>
		<div class="post-info-vertical">
			<aside class="post-author cf">
				<time class="time" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" itemprop="datePublished" content="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo thb_human_time_diff_enhanced(); ?></time>
			</aside>
			<header class="post-title entry-header">
				<h1 itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
			</header>
		</div>
	</figure>
</article>