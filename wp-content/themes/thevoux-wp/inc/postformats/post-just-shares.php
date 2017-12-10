<?php $hide_zero_shares = ot_get_option('hide_zero_shares', 'off'); ?>
<?php if ($hide_zero_shares === 'off' || thb_social_article_totalshares(get_the_ID()) !== 0) { ?>
<footer class="post-links just-shares">
	<span><?php echo thb_social_article_totalshares(get_the_ID()); ?> <?php _e('Shares', 'thevoux'); ?></span>
</footer>
<?php } ?>