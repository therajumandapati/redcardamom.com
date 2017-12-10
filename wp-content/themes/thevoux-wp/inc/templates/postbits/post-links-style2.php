<?php $hide_zero_shares = ot_get_option('hide_zero_shares', 'off'); ?>
<footer class="post-style2-links">
	<a href="<?php echo get_comments_link( $post->ID ); ?>" title="<?php the_title_attribute(); ?>" class="post-link comment-link">
		<?php get_template_part('assets/svg/comment.svg'); ?>
		<?php comments_number(__('0 Comments', 'thevoux'), __('1 Comment', 'thevoux'), __('% Comments', 'thevoux') ); ?>
	</a> 
	<?php if ($hide_zero_shares === 'off' || thb_social_article_totalshares(get_the_ID()) !== '0') { ?>
	<span><?php get_template_part('assets/svg/share.svg'); ?> <?php echo thb_social_article_totalshares(get_the_ID()); ?> <?php _e('Shares', 'thevoux'); ?></span>
	<?php } ?>
</footer>