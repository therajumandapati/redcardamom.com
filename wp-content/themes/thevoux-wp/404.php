<?php get_header(); ?>
<section class="content404">
	<div class="row">
		<div class="small-12 medium-5 columns text-left">
			<h1><?php _e( "USE THE <span>SUN'S</span> <br>POWER", 'thevoux' ); ?></h1>
			<p><?php _e( "We are sorry. But the page you are looking for cannot be found. You might try searching our site.", 'thevoux' ); ?></p>

			<?php get_search_form(); ?> 
			
			<a href="<?php echo get_home_url(); ?>" class="btn"><?php _e('Back To Home', 'thevoux'); ?></a>
		</div>
	</div>
</section>
<?php get_footer(); ?>