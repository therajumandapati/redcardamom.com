<?php
//custom excerpt ending

function thb_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter('excerpt_more', 'thb_excerpt_more');

function thb_excerpt($excerpt_length, $added = false, $autop = true) {
    $text = wp_strip_all_tags(apply_filters( 'the_excerpt', get_the_excerpt() ));
    $text = strip_shortcodes( $text );
    $text = str_replace('[…]', '', $text );
    $text = str_replace('[&hellip;]', '', $text );
    $text = mb_substr($text,0,$excerpt_length, "utf-8");
    if ($autop) {
    	$text = wpautop($text.$added);
    } else {
    	$text = $text.$added;
    }
    return $text;
}