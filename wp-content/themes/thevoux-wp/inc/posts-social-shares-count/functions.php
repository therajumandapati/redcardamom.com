<?php
/**
 * Functions file for PSSC
 * @package    WordPress
 * @subpackage Posts Social Shares Count
 * @since      March 2015
 * @author     Bishoy A.
 * @link       http://bishoy.me
 */

/**
 * Marin Function
 * @param  string  $fuction Function to call from the PsscShareCount class
 * @param  integer $post_id post ID
 * @return integer|string count
 */
function pssc_get_count( $function, $post_id = 0 ) {
	$cache = array();
	$cache = get_transient( 'pssc_counts' );
	
	
	if ( ! $post_id )
		$post_id = get_the_ID();

	$count = isset($cache[ $function . '_' . $post_id ]) ? $cache[ $function . '_' . $post_id ] : false;
	
	if ( empty( $count ) && $count !== '0' ) {
		$url = get_permalink( $post_id );

		if ( ! empty( $url ) ) {
			require_once 'classes/share.count.php';
			$share_counter = new PsscShareCount( $url );
			$count = call_user_func( array( $share_counter, $function ) );
		}

		if ( empty( $count ) )
			$count = '0';

		$cache[ $function . '_' . $post_id ] = $count;
		
		$time = '';
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
		
		set_transient( 'pssc_counts', $cache, $time );
	}
	if ($function == 'pssc_all') {
		update_post_meta($post_id, 'thb_pssc_counts', $count);
	}
	return $count;
}

/* Wrapper Functions */

function pssc_facebook( $post_id = 0 ) {
	return pssc_get_count( __FUNCTION__, $post_id );
}

function pssc_twitter( $post_id = 0 ) {
	return pssc_get_count( __FUNCTION__,$post_id );
}

function pssc_linkedin( $post_id = 0 ) {
	return pssc_get_count( __FUNCTION__,$post_id );
}

function pssc_gplus( $post_id = 0 ) {
	return pssc_get_count( __FUNCTION__,$post_id );
}

function pssc_pinterest( $post_id = 0 ) {
	return pssc_get_count( __FUNCTION__,$post_id );
}

function pssc_all( $post_id = 0 ) {
	return pssc_get_count( __FUNCTION__,$post_id );
}