<?php $extend = $excerpt ? ' extend' : ''; ?>
<article itemscope itemtype="http://schema.org/Article" <?php post_class('post style5' . $extend); ?> id="post-<?php the_ID(); ?>" role="article">
	<?php if ( has_post_thumbnail() ) { ?>
	<figure class="post-gallery">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('thevoux-style2',array('itemprop'=>'image')); ?></a>
	</figure>
	<?php } ?>
	<aside class="post-author cf">
		<time class="time" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" itemprop="datePublished" content="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo thb_human_time_diff_enhanced(); ?></time>
	</aside>
	<header class="post-title entry-header">
		<h4 itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
	</header>
	<?php if ($excerpt) { ?>
	<div class="post-content">
		<?php echo thb_excerpt(150, '&hellip;'); ?>
	</div>
	<?php } ?>
</article>