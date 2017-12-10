<?php $posttags = get_the_tags(); ?>
<?php if (!empty($posttags)) { ?>
<footer class="article-tags entry-footer">
	<strong><?php _e('Tags:', 'thevoux'); ?></strong> 
	<?php
	if ($posttags) {
		$return = '';
		foreach($posttags as $tag) {
			$return .= '<a href="'. get_tag_link($tag->term_id).'" title="'. get_tag_link($tag->name).'">' . $tag->name . '</a>, ';
		}
		echo substr($return, 0, -2);
	} ?>
</footer>
<?php } ?>