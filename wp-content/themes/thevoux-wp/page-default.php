<?php
/*
Template Name: Standard Page Layout
*/
?>
<?php get_header(); ?>
<section class="non-VC-page">
<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
<article <?php post_class('post'); ?> id="post-<?php the_ID(); ?>">
	<div class="post-content">
		<div class="row">
			<div class="small-12 columns">
				<header class="post-title">
					<h1 itemprop="headline"><?php the_title(); ?></h1>
				</header>
				<div class="post-content">
				<?php the_content('Read More'); ?>
				</div>
			</div>
		</div>
	</div>
</article>
<?php endwhile; else : endif; ?>
</section>
<?php get_footer(); ?>