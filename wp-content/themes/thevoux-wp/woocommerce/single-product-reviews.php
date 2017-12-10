<?php
/**
 * Display single product reviews (comments)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.2
 */
global $product;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! comments_open() ) {
	return;
}

?>
<?php if ( comments_open() ) : ?>
<div class="row">
	<div class="small-12 medium-10 medium-centered columns">
<div class="row">
	<div class="small-12 medium-10 medium-centered columns">
		<div id="reviews">
			
		<?php
		
			echo '<div id="comments">';
			
		?>
		<?php
			$commenter = wp_get_current_commenter();
		
			if ( have_comments() ) :
				
				echo '<div class="comment_container"><ol class="commentlist">';
		
				wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) );
		
				echo '</ol>';
		
				if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
						echo '<nav class="woocommerce-pagination">';
						paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
							'prev_text' => '&larr;',
							'next_text' => '&rarr;',
							'type'      => 'list',
						) ) );
						echo '</nav>';
					endif;
				
		
			endif;
			
				
			$comment_form = array(
				'title_reply' => false,
				'comment_notes_before' => '',
				'comment_notes_after' => '',
				'fields' => array(
					'author' => '<div class="row"><div class="small-12 medium-6 columns">' . '<label for="author">' . __( 'Name', 'thevoux' ) . ' <span class="required">*</span></label> ' .
					            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></div>',
					'email'  => '<div class="small-12 medium-6 columns"><label for="email">' . __( 'Email', 'thevoux' ) . ' <span class="required">*</span></label> ' .
					            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></div></div>',
				),
				'label_submit' => __( 'Submit Review', 'thevoux' ),
				'logged_in_as' => '',
				'comment_field' => ''
			);
		
			if ( get_option('woocommerce_enable_review_rating') == 'yes' ) {
		
				$comment_form['comment_field'] = '<p class="comment-form-rating"><label for="rating">' . __( 'Rating', 'thevoux' ) .'</label><select name="rating" id="rating">
					<option value="">'.__( 'Rate&hellip;', 'thevoux' ).'</option>
					<option value="5">'.__( 'Perfect', 'thevoux' ).'</option>
					<option value="4">'.__( 'Good', 'thevoux' ).'</option>
					<option value="3">'.__( 'Average', 'thevoux' ).'</option>
					<option value="2">'.__( 'Not that bad', 'thevoux' ).'</option>
					<option value="1">'.__( 'Very Poor', 'thevoux' ).'</option>
				</select></p>';
				
				
			}
		
			$comment_form['comment_field'] .= '<div class="row"><div class="small-12 columns"><label for="comment">' . __( 'Your Review', 'thevoux' ) . '</label><textarea id="comment" name="comment" aria-required="true"></textarea></div></div>';
			
			echo '</div>';
		?>
		</div>
		<?php comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) ); ?>
	</div>
</div>
	</div>
</div>
<?php endif; ?>