<?php get_header(); ?>
<?php 
	$blog_featured = ot_get_option('blog_featured');
?>
<?php if ($blog_featured) { ?>
	<div class="row header_content">
		<div class="small-12 columns">
			<?php 
				$args = array(
					'p' => $blog_featured,
					'post_type' => 'any'
				);
				$featured_post = new WP_Query($args);
			?>
			
			<?php if ($featured_post->have_posts()) :  while ($featured_post->have_posts()) : $featured_post->the_post(); ?>
			<?php get_template_part( 'inc/templates/loop/blog-featured' ); ?>
			<?php endwhile; else : endif; ?>
		</div>
	</div>	
<?php } ?>
<div class="row">
	<section class="blog-section small-12 medium-8 columns">
		<div class="row">
			<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
				<?php get_template_part( 'inc/templates/loop/blog-list' ); ?>
			<?php endwhile; else : ?>
			  	<?php get_template_part( 'inc/templates/loop/notfound' ); ?>
			<?php endif; ?>
		</div>
		<?php if ( get_next_posts_link() || get_previous_posts_link()) { ?>
		<div class="blog_nav">
			<?php if ( get_next_posts_link() ) : ?>
				<a href="<?php echo next_posts(); ?>" class="next"><i class="fa fa-angle-left"></i> <?php _e( 'Older Posts', 'thevoux' ); ?></a>
			<?php endif; ?>
		
			<?php if ( get_previous_posts_link() ) : ?>
				<a href="<?php echo previous_posts(); ?>" class="prev"><?php _e( 'Newer Posts', 'thevoux' ); ?> <i class="fa fa-angle-right"></i></a>
			<?php endif; ?>
		</div>
		<?php } ?>
	</section>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>