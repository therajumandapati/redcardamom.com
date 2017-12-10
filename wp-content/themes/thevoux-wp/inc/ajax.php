<?php
add_action("wp_ajax_nopriv_thb_infinite_ajax", "thb_infinite_ajax");
add_action("wp_ajax_thb_infinite_ajax", "thb_infinite_ajax");
function thb_infinite_ajax() {
	global $post;
	$id = isset($_POST['post_id']) ? $_POST['post_id'] : false;
	
  $post = get_post( $id );
	$previous_post = get_previous_post();
	if ($id && $previous_post) {
		$args = array(
		    'p' => $previous_post->ID,
		    'no_found_rows' => true,
		    'posts_per_page' => 1,
		    'post_status' => 'publish'
		);
		$query = new WP_Query($args);
		do_action("thb_vc_ajax");
		if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
			global $more;
			$more = -1;
			$style = ot_get_option('article_style', 'style1');
			
			if (get_post_meta($previous_post->ID, 'article_style_override', true) === 'on') {
				$style = get_post_meta($previous_post->ID, 'post-style', true);
			}
			set_query_var( 'thb_ajax', true );
			get_template_part( 'inc/templates/single/'.$style );
		endwhile; else : endif;
	}
	wp_die();
}

add_action("wp_ajax_thb-parse-embed", "thb_ajax_parse_embed", 1);
add_action("wp_ajax_nopriv_thb-parse-embed", "thb_ajax_parse_embed", 1);

function thb_ajax_parse_embed() {
	global $post, $wp_embed;
	if ( ! $post = get_post( (int) $_POST['post_ID'] ) ) {
		wp_send_json_error();
	}
	if ( empty( $_POST['shortcode'] ) ) {
		wp_send_json_error();
	}
	$shortcode = wp_unslash( $_POST['shortcode'] );
	preg_match( '/' . get_shortcode_regex() . '/s', $shortcode, $matches );
	$atts = shortcode_parse_atts( $matches[3] );
	if ( ! empty( $matches[5] ) ) {
		$url = $matches[5];
	} elseif ( ! empty( $atts['src'] ) ) {
		$url = $atts['src'];
	} else {
		$url = '';
	}
	$parsed = false;
	setup_postdata( $post );
	$wp_embed->return_false_on_fail = true;
	if ( is_ssl() && 0 === strpos( $url, 'http://' ) ) {
		// Admin is ssl and the user pasted non-ssl URL.
		// Check if the provider supports ssl embeds and use that for the preview.
		$ssl_shortcode = preg_replace( '%^(\\[embed[^\\]]*\\])http://%i', '$1https://', $shortcode );
		$parsed = $wp_embed->run_shortcode( $ssl_shortcode );
		if ( ! $parsed ) {
			$no_ssl_support = true;
		}
	}
	if ( $url && ! $parsed ) {
		$parsed = $wp_embed->run_shortcode( $shortcode );
	}
	if ( ! $parsed ) {
		wp_send_json_error( array(
			'type' => 'not-embeddable',
			'message' => sprintf( esc_html__( '%s failed to embed.', 'thevoux' ), '<code>' . esc_html( $url ) . '</code>' ),
		) );
	}
	if ( has_shortcode( $parsed, 'audio' ) || has_shortcode( $parsed, 'video' ) ) {
		$styles = '';
		$mce_styles = wpview_media_sandbox_styles();
		foreach ( $mce_styles as $style ) {
			$styles .= sprintf( '<link rel="stylesheet" href="%s"/>', $style );
		}
		$html = do_shortcode( $parsed );
		global $wp_scripts;
		if ( ! empty( $wp_scripts ) ) {
			$wp_scripts->done = array();
		}
		ob_start();
		wp_print_scripts( 'wp-mediaelement' );
		$scripts = ob_get_clean();
		$parsed = $styles . $html . $scripts;
	}
	if ( ! empty( $no_ssl_support ) || ( is_ssl() && ( preg_match( '%<(iframe|script|embed) [^>]*src="http://%', $parsed ) ||
		preg_match( '%<link [^>]*href="http://%', $parsed ) ) ) ) {
		// Admin is ssl and the embed is not. Iframes, scripts, and other "active content" will be blocked.
		wp_send_json_error( array(
			'type' => 'not-ssl',
			'message' => esc_html__( 'This preview is unavailable in the editor.', 'thevoux' ),
		) );
	}
	wp_send_json_success( array(
		'body' => $parsed,
		'attr' => $wp_embed->last_attr
	) );
}