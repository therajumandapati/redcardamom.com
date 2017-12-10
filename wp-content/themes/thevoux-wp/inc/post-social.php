<?php
//Get Facebook Likes Count of a page
function thb_fbLikeCount($pageID, $debug = false) {
	$cache = get_transient( 'thb_page_fbcount' );
	switch (ot_get_option('sharing_cache', '1')) {
		case '1h':
			$time = 3600;
			break;
		case '1':
			$time = DAY_IN_SECONDS;
			break;
		case '7':
			$time = WEEK_IN_SECONDS;
			break;
		case '30':
			$time = DAY_IN_SECONDS * 30;
			break;
	}
	if ( empty( $cache ) ) {
		$url_prefix = is_ssl() ? 'https:' : 'http:';
		
		$thb_fb_secret_cache = get_transient( 'thb_fb_secret_cache' );
		
		if (empty($thb_fb_secret_cache)) {
			//Construct a Facebook URL
			$secret = wp_remote_get('https://graph.facebook.com/oauth/access_token?type=client_cred&client_id='.ot_get_option('facebook_app_id').'&client_secret='.ot_get_option('facebook_app_secret').'');
			if ( is_wp_error( $secret ) ) {
				echo $error_string = $secret->get_error_message();
				return;
			}
			$thb_fb_secret_cache = wp_remote_retrieve_body( $secret );
			
			set_transient( 'thb_fb_secret_cache', $thb_fb_secret_cache, 3600 );
		}
		
		$json_url = 'https://graph.facebook.com/v2.7/'.$pageID.'?'.$thb_fb_secret_cache.'&fields=id,fan_count';
		$json = wp_remote_get($json_url);
		// Check for error
		if ( is_wp_error( $json ) ) {
			echo $error_string = $json->get_error_message();
			return;
		}
		$data = wp_remote_retrieve_body( $json );
		$json_output = json_decode($data);
	 	set_transient( 'thb_page_fbcount', $json_output->fan_count, $time );
	 	
		//Extract the likes count from the JSON object
		$likes = $json_output->fan_count ? $json_output->fan_count : 0;
		
	} else {
		$likes = $cache;
	}
	if ($debug) {
		$secret = wp_remote_get('https://graph.facebook.com/oauth/access_token?type=client_cred&client_id='.ot_get_option('facebook_app_id').'&client_secret='.ot_get_option('facebook_app_secret').'');
		if ( is_wp_error( $secret ) ) {
			echo $error_string = $secret->get_error_message();
			return;
		}
		$secret = wp_remote_retrieve_body( $secret );
		$json_url = 'https://graph.facebook.com/v2.7/'.$pageID.'?'.$secret.'&fields=id,name,likes,fan_count';
		$json = wp_remote_get($json_url);
		// Check for error
		if ( is_wp_error( $json ) ) {
			echo $error_string = $json->get_error_message();
			return;
		}
		$data = wp_remote_retrieve_body( $json );
		$json_output = json_decode($data);
		var_dump($json_output);	
	}
	echo thb_numberAbbreviation($likes);
}
add_filter( 'thb_fbLikeCount', 'thb_fbLikeCount', 99, 2 );

//Get Twitter Follower Count of a page
function thb_getTwitterFollowers($debug = false) {
    $settings = array(
        'oauth_access_token' => ot_get_option('twitter_bar_accesstoken'),
        'oauth_access_token_secret' => ot_get_option('twitter_bar_accesstokensecret'),
        'consumer_key' => ot_get_option('twitter_bar_consumerkey'),
        'consumer_secret' => ot_get_option('twitter_bar_consumersecret')
    );
    $url = 'https://api.twitter.com/1.1/users/show.json';
    $requestMethod = 'GET';
    $getfield = '?screen_name='.ot_get_option('twitter_bar_username');
    
    $cache = get_transient( 'thb_page_twcount' );
    
    switch (ot_get_option('sharing_cache', '1')) {
    	case '1h':
    		$time = 3600;
    		break;
    	case '1':
    		$time = DAY_IN_SECONDS;
    		break;
    	case '7':
    		$time = WEEK_IN_SECONDS;
    		break;
    	case '30':
    		$time = DAY_IN_SECONDS * 30;
    		break;
    }
    if ( empty( $cache ) ) {
	    $twitter = new thb_TwitterAPIExchange($settings);
	    $twitter_data = json_decode($twitter->set_get_field($getfield)
	                 ->build_oauth($url, $requestMethod)
	                 ->process_request());
	    if (isset($twitter_data->errors)) {
	    	echo $twitter_data->errors[0]->message;
	    	return;
	    } else {
	      $followers = $twitter_data->followers_count;
	      set_transient( 'thb_page_twcount', $followers, $time );
	    }
    } else {
    	$followers = $cache;
    }
    if ($debug) {
    	$twitter = new thb_TwitterAPIExchange($settings);
    	$twitter_data = json_decode($twitter->set_get_field($getfield)
    	             ->build_oauth($url, $requestMethod)
    	             ->process_request());
    	var_dump($twitter_data);	
    }
    echo thb_numberAbbreviation($followers);
}
add_filter( 'thb_twFollowerCount', 'thb_getTwitterFollowers', 99, 1 );

//Get Instagram Follower Count
function thb_getInstagramFollowers() {
    $id = ot_get_option('instagram_id');
    $api_key = ot_get_option('instagram_accesstoken');
    
    $cache = get_transient( 'thb_page_inscount' );
    
    switch (ot_get_option('sharing_cache', '1')) {
    	case '1h':
    		$time = 3600;
    		break;
    	case '1':
    		$time = DAY_IN_SECONDS;
    		break;
    	case '7':
    		$time = WEEK_IN_SECONDS;
    		break;
    	case '30':
    		$time = DAY_IN_SECONDS * 30;
    		break;
    }
    
    if ( empty( $cache ) ) {
	    $request = @wp_remote_get( 'https://api.instagram.com/v1/users/' . $id . '?access_token=' . $api_key );
	    
      if ( false == $request ) {
        return null;
      }
  
      $response = json_decode( @wp_remote_retrieve_body( $request ) );
  
      if ( isset( $response->data ) && isset( $response->data->counts ) && isset( $response->data->counts->followed_by ) ) {
      	
      	$followers = $response->data->counts->followed_by;
        set_transient( 'thb_page_inscount', $followers, $time );
      }
        
        
    } else {
    	$followers = $cache;
    }
    echo thb_numberAbbreviation($followers);
}
add_filter( 'thb_insFollowerCount', 'thb_getInstagramFollowers', 99, 1 );

//Get Google+ Follower Count
function thb_getGplusFollowers() {
    $id = ot_get_option('gp_username');
    $apikey = ot_get_option('gp_apikey');
    
    $cache = get_transient( 'thb_page_gpcount' );
    
    switch (ot_get_option('sharing_cache', '1')) {
    	case '1h':
    		$time = 3600;
    		break;
    	case '1':
    		$time = DAY_IN_SECONDS;
    		break;
    	case '7':
    		$time = WEEK_IN_SECONDS;
    		break;
    	case '30':
    		$time = DAY_IN_SECONDS * 30;
    		break;
    }
    
    if ( empty( $cache ) ) {
	    $request = @wp_remote_get( 'https://www.googleapis.com/plus/v1/people/' . $id . '?key=' . $apikey );
	    
			if ( false == $request ) {
			 return null;
			}
  
			$response = json_decode( @wp_remote_retrieve_body( $request ) );
      
      if ( isset( $response->circledByCount ) ) {
      	
      	$followers = $response->circledByCount;
        set_transient( 'thb_page_gpcount', $followers, $time );
      }
        
        
    } else {
    	$followers = $cache;
    }
    echo thb_numberAbbreviation($followers);
}
add_filter( 'thb_gpFollowerCount', 'thb_getGplusFollowers', 99, 1 );

function thb_social_article_totalshares($id) {
	$id = $id ? $id : get_the_ID();
	
	$total = pssc_all($id);
	
	return thb_numberAbbreviation($total);
}
add_action( 'thb_social_article_totalshares', 'thb_social_article_totalshares',3 );

function thb_social_article($id) {
	$id = $id ? $id : get_the_ID();
	$permalink = get_permalink($id);
	$title = the_title_attribute(array('echo' => 0, 'post' => $id) );
	$image_id = get_post_thumbnail_id($id);
	$image = wp_get_attachment_image_src($image_id,'full');
	$twitter_user = ot_get_option('twitter_bar_username', 'anteksiler');
	$sharing_type = ot_get_option('sharing_buttons') ? ot_get_option('sharing_buttons') : array();
 ?>
 	<?php if (!empty($sharing_type)) { ?>
 		<?php get_template_part('assets/svg/share.svg'); ?>
		<?php if (in_array('facebook',$sharing_type)) { ?>
		<a href="<?php echo 'http://www.facebook.com/sharer.php?u=' . urlencode( esc_url( $permalink ) ).''; ?>" class="boxed-icon social fill facebook"><i class="fa fa-facebook"></i></a>
		<?php } ?>
		<?php if (in_array('twitter',$sharing_type)) { ?>
		<a href="<?php echo 'https://twitter.com/intent/tweet?text=' . htmlspecialchars(urlencode(html_entity_decode($title, ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8') . '&url=' . urlencode( esc_url( $permalink ) ) . '&via=' . urlencode( $twitter_user ? $twitter_user : get_bloginfo( 'name' ) ) . ''; ?>" class="boxed-icon social fill twitter"><i class="fa fa-twitter"></i></a>
		<?php } ?>
		<?php if (in_array('google-plus',$sharing_type)) { ?>
		<a href="<?php echo 'http://plus.google.com/share?url=' . esc_url( $permalink ) . ''; ?>" class="boxed-icon social fill google-plus"><i class="fa fa-google-plus"></i></a>
		<?php } ?>
		<?php if (in_array('pinterest',$sharing_type)) { ?>
		<a href="<?php echo 'http://pinterest.com/pin/create/link/?url=' . esc_url( $permalink ) . '&media=' . ( ! empty( $image[0] ) ? $image[0] : '' ) . '&description='.htmlspecialchars(urlencode(html_entity_decode($title, ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8'); ?>" class="boxed-icon social fill pinterest" data-pin-no-hover="true"><i class="fa fa-pinterest"></i></a>
		<?php } ?>
		<?php if (in_array('linkedin',$sharing_type)) { ?>
		<a href="<?php echo 'https://www.linkedin.com/cws/share?url=' . esc_url( $permalink ) . ''; ?>" class="boxed-icon social fill linkedin"><i class="fa fa-linkedin"></i></a>
		<?php } ?>
	<?php } ?>
<?php
}
add_action( 'thb_social_article', 'thb_social_article', 3 );

function thb_social_article_detail($id = false, $fixed = false, $class = false) {
	$id = $id ? $id : get_the_ID();
	$permalink = get_permalink($id);
	$title = the_title_attribute(array('echo' => 0, 'post' => $id) );
	$image_id = get_post_thumbnail_id($id);
	$image = wp_get_attachment_image_src($image_id,'full');
	$twitter_user = ot_get_option('twitter_bar_username', 'anteksiler');
	$sharing_type = ot_get_option('sharing_buttons') ? ot_get_option('sharing_buttons') : array();
	
	$hide_zero_shares = ot_get_option('hide_zero_shares', 'off'); 
 ?>
	<aside class="share-article hide-on-print<?php if ($fixed) { ?> fixed-me<?php } ?> <?php echo esc_attr($class); ?>">
		
		<?php if (in_array('facebook',$sharing_type)) { ?>
		<a href="<?php echo 'http://www.facebook.com/sharer.php?u=' . urlencode( esc_url( $permalink ) ).''; ?>" class="boxed-icon facebook social"><i class="fa fa-facebook"></i>
			<?php if ($hide_zero_shares === 'off' || pssc_facebook($id) !== '0') { ?>
			<span><?php echo thb_numberAbbreviation(pssc_facebook($id)); ?></span>
			<?php } ?>
		</a>
		<?php } ?>
		<?php if (in_array('twitter',$sharing_type)) { ?>
		<a href="<?php echo 'https://twitter.com/intent/tweet?text=' . htmlspecialchars(urlencode(html_entity_decode($title, ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8') . '&url=' . urlencode( esc_url( $permalink ) ) . '&via=' . urlencode( $twitter_user ? $twitter_user : get_bloginfo( 'name' ) ) . ''; ?>" class="boxed-icon twitter social "><i class="fa fa-twitter"></i>
			<?php if ($hide_zero_shares === 'off' || pssc_twitter($id) !== '0') { ?>
			<span><?php echo thb_numberAbbreviation(pssc_twitter($id)); ?></span>
			<?php } ?>
		</a>
		<?php } ?>
		<?php if (in_array('google-plus',$sharing_type)) { ?>
		<a href="<?php echo 'http://plus.google.com/share?url=' . esc_url( $permalink ) . ''; ?>" class="boxed-icon google-plus social"><i class="fa fa-google-plus"></i>
			<?php if ($hide_zero_shares === 'off' || pssc_gplus($id) !== '0') { ?>
			<span><?php echo thb_numberAbbreviation(pssc_gplus($id)); ?></span>
			<?php } ?>
		<?php } ?>
		<?php if (in_array('pinterest',$sharing_type)) { ?>
		<a href="<?php echo 'http://pinterest.com/pin/create/link/?url=' . esc_url( $permalink ) . '&media=' . ( ! empty( $image[0] ) ? $image[0] : '' ) . '&description='.htmlspecialchars(urlencode(html_entity_decode($title, ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8'); ?>" class="boxed-icon pinterest social" data-pin-no-hover="true"><i class="fa fa-pinterest"></i>
			<?php if ($hide_zero_shares === 'off' || pssc_pinterest($id) !== '0') { ?>
			<span><?php echo thb_numberAbbreviation(pssc_pinterest($id)); ?></span>
			<?php } ?>
		<?php } ?>
		<?php if (in_array('linkedin',$sharing_type)) { ?>
		<a href="<?php echo 'https://www.linkedin.com/cws/share?url=' . esc_url( $permalink ) . ''; ?>" class="boxed-icon linkedin social"><i class="fa fa-linkedin"></i>
			<?php if ($hide_zero_shares === 'off' || pssc_linkedin($id) !== '0') { ?>
			<span><?php echo thb_numberAbbreviation(pssc_linkedin($id)); ?></span>
			<?php } ?>
		</a>
		<?php } ?>
		<a href="<?php the_permalink(); ?>" class="boxed-icon comment"><?php get_template_part('assets/svg/comment.svg'); ?><span><?php echo get_comments_number(); ?></span></a>
	</aside>
<?php
}
add_action( 'thb_social_article_detail', 'thb_social_article_detail', 3, 3 );

function thb_social_product($id = false) {
	$id = $id ? $id : get_the_ID();
	$permalink = get_permalink($id);
	$title = the_title_attribute(array('echo' => 0, 'post' => $id) );
	$image_id = get_post_thumbnail_id($id);
	$image = wp_get_attachment_image_src($image_id,'full');
	$twitter_user = ot_get_option('twitter_bar_username', 'anteksiler');
	$sharing_type = ot_get_option('sharing_buttons') ? ot_get_option('sharing_buttons') : array();
 ?>
 <?php if (!empty($sharing_type)) { ?>
 <aside class="share-article">
 	<?php if (in_array('facebook',$sharing_type)) { ?>
 	<a href="<?php echo 'http://www.facebook.com/sharer.php?u=' . urlencode( esc_url( $permalink ) ).''; ?>" class="boxed-icon facebook social"><i class="fa fa-facebook"></i><span><?php echo thb_numberAbbreviation(pssc_facebook($id)); ?></span></a>
 	<?php } ?>
 	<?php if (in_array('twitter',$sharing_type)) { ?>
 	<a href="<?php echo 'https://twitter.com/intent/tweet?text=' . htmlspecialchars(urlencode(html_entity_decode($title, ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8') . '&url=' . urlencode( esc_url( $permalink ) ) . '&via=' . urlencode( $twitter_user ? $twitter_user : get_bloginfo( 'name' ) ) . ''; ?>" class="boxed-icon twitter social "><i class="fa fa-twitter"></i><span><?php echo thb_numberAbbreviation(pssc_twitter($id)); ?></span></a>
 	<?php } ?>
 	<?php if (in_array('google-plus',$sharing_type)) { ?>
 	<a href="<?php echo 'http://plus.google.com/share?url=' . esc_url( $permalink ) . ''; ?>" class="boxed-icon google-plus social"><i class="fa fa-google-plus"></i><span><?php echo thb_numberAbbreviation(pssc_gplus($id)); ?></span></a>
 	<?php } ?>
 	<?php if (in_array('pinterest',$sharing_type)) { ?>
 	<a href="<?php echo 'http://pinterest.com/pin/create/link/?url=' . esc_url( $permalink ) . '&amp;media=' . ( ! empty( $image[0] ) ? $image[0] : '' ) . ''; ?>" class="boxed-icon pinterest social" nopin="nopin" data-pin-no-hover="true"><i class="fa fa-pinterest"></i><span><?php echo thb_numberAbbreviation(pssc_pinterest($id)); ?></span></a>
 	<?php } ?>
 </aside>
 <?php } ?>
<?php
}
add_action( 'thb_social_product', 'thb_social_product', 3, 3 );
