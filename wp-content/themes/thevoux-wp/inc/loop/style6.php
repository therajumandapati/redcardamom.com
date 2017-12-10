<?php 
	$vars = $wp_query->query_vars;
	$disable_excerpts = array_key_exists('disable_excerpts', $vars) ? $vars['disable_excerpts'] : false;
	$disable_postmeta = array_key_exists('disable_postmeta', $vars) ? $vars['disable_postmeta'] : false;
?>
<article itemscope itemtype="http://schema.org/Article" <?php post_class('post style6'); ?> id="post-<?php the_ID(); ?>" role="article">
	<?php if ( has_post_thumbnail() ) { ?>
	<figure class="post-gallery <?php do_action('thb_is_gallery'); ?><?php do_action('thb_is_review'); ?>">
		<?php do_action('thb_post_review_average'); ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('thevoux-single',array('itemprop'=>'image')); ?></a>
	</figure>
	<?php } ?>
	<?php if ($disable_postmeta !== 'true') { ?>
	<?php if(has_category()) { ?>
	<aside class="post-meta cf"><?php the_category(', '); ?></aside>
	<?php } ?>
	<aside class="post-author cf">
		- <time class="time" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" itemprop="datePublished" content="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo thb_human_time_diff_enhanced(); ?></time>
	</aside>
	<?php } ?>
	<header class="post-title entry-header">
		<h5 itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
	</header>
	<?php if ($disable_excerpts !== 'true') { ?>
	<div class="post-content small">
		<?php echo thb_excerpt(150, '&hellip;'); ?>
	</div>
	<?php } ?>
</article>