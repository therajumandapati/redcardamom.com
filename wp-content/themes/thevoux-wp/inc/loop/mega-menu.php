<div <?php post_class('post mega-menu-post'); ?> id="post-<?php the_ID(); ?>" role="article">
	<figure class="post-gallery">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php the_post_thumbnail('thevoux-megamenu'); ?>
		</a>
	</figure>
	<header class="post-title entry-header">
		<h6 itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h6>
	</header>
</div>