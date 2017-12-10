<?php if (ot_get_option('article_author', 'on') == 'on') { ?> 
<div class="category_container author-information">
	<div class="inner">
		<section id="authorpage" class="authorpage">
			<?php do_action('thb_author'); ?>
		</section>
	</div>
</div>
<?php } ?>