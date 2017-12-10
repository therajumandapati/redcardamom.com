<?php 
	$vars = $wp_query->query_vars;
	$excerpts = array_key_exists('excerpts', $vars) ? $vars['excerpts'] : false;
?>
<article itemscope itemtype="http://schema.org/Article" <?php post_class('post style4 cf'); ?> id="post-<?php the_ID(); ?>" role="article">
	<?php if ( has_post_thumbnail() ) { ?>
	<figure class="post-gallery">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php the_post_thumbnail('thumbnail', array('itemprop'=>'image')); ?>
		</a>
	</figure>
	<?php } ?>
	<div class="style4-container">
		<aside class="post-author">
			<time class="time" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" itemprop="datePublished" content="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo thb_human_time_diff_enhanced(); ?></time>
		</aside>
		<header class="post-title entry-header">
			<h5 itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
		</header>
		<?php if ($excerpts) { ?>
		<div class="post-content small">
			<?php echo thb_excerpt(70, '&hellip;'); ?>
		</div>
		<?php } ?>
	</div>
</article>