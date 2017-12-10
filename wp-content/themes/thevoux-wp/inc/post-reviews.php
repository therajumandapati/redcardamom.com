<?php 
/* Review Box */
function thb_is_review() {
	$id = get_the_ID();
	if (get_post_meta($id, 'is_review', TRUE) == 'yes') {
		echo ' has-review';
	} else {
		return false;
	}
}
add_action( 'thb_is_review', 'thb_is_review', 1 );
function thb_post_review_average() {
	$id = get_the_ID();
	if (get_post_meta($id, 'is_review', TRUE) == 'yes') {
		$features = get_post_meta($id, 'post_ratings_percentage', TRUE);
		$count = sizeof($features);
		$total = 0;
		$return = '';
		if ($count > 0 && !empty($features)) {
			foreach($features as $feature) {
				$total += $feature['feature_score'];
			}
			$return = round($total / $count, 1);
		} else {
			$return = '<i class="fa fa-star"></i>';	
		}
		echo '<span class="ave">'.$return.'</span>';
	}
}
add_action( 'thb_post_review_average', 'thb_post_review_average' );
function thb_post_review() {
	$id = get_the_ID();
	if (get_post_meta($id, 'is_review', TRUE) == 'yes') {
		$review_title = get_post_meta($id, 'post_ratings_title', TRUE);
		$comments = get_post_meta($id, 'post_ratings_comments', TRUE);
		$features = get_post_meta($id, 'post_ratings_percentage', TRUE); 
		$count = count($features);
		$comment_count = count($comments);
		$total = 0;
		?>
		<div class="post-review cf" itemscope itemtype="http://schema.org/Review">
			<?php if ($review_title) { ?><strong itemprop="itemReviewed" itemscope itemtype="http://schema.org/Thing"><span itemprop="name"><?php echo esc_html($review_title); ?></span></strong><?php } ?>
			<ul>
			<?php if ($features) { foreach($features as $feature) {
				$total += $feature['feature_score'];
				?>
				<li>
					<div class="row cf">
						<div class="small-12 medium-9 columns"><?php echo esc_attr($feature['title']); ?></div>
						<div class="small-12 medium-3 columns show-for-medium"><?php echo esc_attr($feature['feature_score']); ?></div>
					</div>
					<div class="progress">
						<span style="width: <?php echo 10*$feature['feature_score'] ?>%;"></span>
					</div>
				</li>
			<?php } }?>
			</ul>
			<div class="row">
				<div class="small-12 medium-9 columns">
					<div class="row">
						<div class="small-12 medium-6 columns comment_section">
							<span class="post_comment good"><?php _e('The Good', 'thevoux'); ?></span>
							<?php if ($comments) { foreach($comments as $comment) { ?>
								<?php if ($comment['feature_comment_type'] == 'positive') { ?>
								<p class="positive"><?php echo esc_attr($comment['title']); ?></p>
								<?php } ?>
							<?php } } ?>
						</div>
						<div class="small-12 medium-6 columns comment_section">
							<span class="post_comment bad"><?php _e('The Bad', 'thevoux'); ?></span>
							<?php if ($comments) { foreach($comments as $comment) { ?>
								<?php if ($comment['feature_comment_type'] == 'negative') { ?>
								<p class="negative"><?php echo esc_attr($comment['title']); ?></p>
								<?php } ?>
							<?php } } ?>
						</div>
					</div>
				</div>
				<?php if ($features) { ?>
				<div class="small-12 medium-3 columns">
					<figure class="average" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating"><span itemprop="ratingValue"><?php echo round($total / $count, 1); ?></span><span class="hide" itemprop="bestRating">10</span></figure>
				</div>
				<?php } ?>
				<span class="hide" itemprop="author" itemscope itemtype="http://schema.org/Person">
			    <span itemprop="name"><?php the_author_meta('display_name', $id ); ?></span>
			  </span>
			</div>
		</div>
		<?php
	}
}
add_action( 'thb_post_review', 'thb_post_review' );