<?php
/**
 * Login form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( is_user_logged_in() ) 
	return;
?>

<form method="post" class="login" <?php if ( $hidden ) echo 'style="display:none;"'; ?>>

	<?php do_action( 'woocommerce_login_form_start' ); ?>

	<?php if ( $message ) echo wpautop( wptexturize( $message ) ); ?>
			<div class="row">
				<div class="small-12 medium-6 columns">
					<label for="username"><?php _e( 'Username or email', 'woocommerce' ); ?> <span class="required">*</span></label>
					<input type="text" class="input-text full" name="username" id="username" />
				</div>
				<div class="small-12 medium-6 columns">
					<label for="password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
					<input class="input-text full" type="password" name="password" id="password" />
				</div>
				<?php do_action( 'woocommerce_login_form' ); ?>
	
				<?php wp_nonce_field( 'woocommerce-login' ); ?>
			
				<div class="small-12 columns">
					<input type="submit" class="button small login_button" name="login" value="<?php _e( 'Login', 'woocommerce' ); ?>" />
					<input name="rememberme" type="checkbox" id="rememberme" value="forever" class="custom_check"/><label for="rememberme" class="custom_label"><?php _e( 'Remember me', 'woocommerce' ); ?></label>
					
				</div>
			</div>
			<a href="<?php echo esc_url( wc_lostpassword_url() ); ?>" class="lost_password"><?php _e( 'Lost your password?', 'woocommerce' ); ?></a>
			<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />
			

	<?php do_action( 'woocommerce_login_form_end' ); ?>

</form>
	