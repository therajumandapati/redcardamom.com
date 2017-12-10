<?php get_header(); ?>
<?php $VC = class_exists('WPBakeryVisualComposerAbstract'); ?>
<section class="<?php if (!$VC) { ?> non-VC-page<?php } ?>">
  <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
	  <article <?php post_class('post'); ?> id="post-<?php the_ID(); ?>">
			<div class="post-content">
				<?php if ($VC) { ?>
					<?php the_content('Read More'); ?>
				<?php } else { ?>
					<div class="row">
						<div class="small-12 columns">
							<header class="post-title">
								<h1 itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
							</header>
							<div class="post-content">
							<?php the_content('Read More'); ?>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
	  </article>
	  <?php if ( comments_open() || get_comments_number() ) : ?>
	  <!-- Start #comments -->
	  <?php comments_template('', true); ?>
	  <!-- End #comments -->
	  <?php endif; ?>
  <?php endwhile; else : endif; ?>
</section>
<?php get_footer(); ?>