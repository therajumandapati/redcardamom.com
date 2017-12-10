<article itemscope itemtype="http://schema.org/BlogPosting" <?php post_class('post blog-featured text-center'); ?> id="post-<?php the_ID(); ?>" role="article">
	<meta itemprop="datePublished" content="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"/>
	<?php if ( has_post_thumbnail() ) { ?>
	<figure class="post-gallery <?php do_action('thb_is_gallery'); ?><?php do_action('thb_is_review'); ?>">
		<?php do_action('thb_post_review_average'); ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('thevoux-featured',array('itemprop'=>'image')); ?></a>
	</figure>
	<?php } ?>
	<?php if(has_category()) { ?>
	<aside class="post-meta cf"><?php the_category(', '); ?></aside>
	<?php } ?>
	<div class="row">
		<div class="small-12 medium-10 large-8 columns medium-centered">
			<header class="post-title entry-header">
				<h2 itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
			</header>
			<div class="post-content">
				<?php echo thb_excerpt(150, '&hellip;'); ?>
			</div>
		</div>
	</div>
</article>