<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php do_action('woocommerce_before_customer_login_form'); ?>
<div id="customer_login" class="full-height-content">
	<div class="row">
			<div class="small-12 small-centered medium-6 large-4 xlarge-3 columns">
					<?php wc_print_notices();  ?>
					<div class="login-container">
						<p class="text-center"><?php _e( "I'm an existing customer and would like to login." ,'thevoux' ); ?></p>
						<form method="post" class="login text-center">

								<input type="text" class="input-text full" name="username" id="username" placeholder="<?php _e( 'Username or email address', 'woocommerce' ); ?>"/>

								<input class="input-text full" type="password" name="password" id="password" placeholder="<?php _e( 'Password', 'woocommerce' ); ?>"/>
							<div class="row">
								<div class="small-6 columns">
									<div class="remember">
										<input name="rememberme" type="checkbox" id="rememberme" value="forever" class="custom_check"/> <label for="rememberme" class="checkbox custom_label"><?php _e( 'Remember me','thevoux' ); ?></label>
									</div>
								</div>
								<div class="small-6 columns">
									<a class="lost_password" href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php _e( 'Lost Password?','thevoux' ); ?></a>
								</div>
							</div>

							<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
							<input type="submit" class="button black small" name="login" value="<?php _e( 'Login','thevoux' ); ?>" />
						</form>
						<?php if (get_option('woocommerce_enable_myaccount_registration')=='yes') : ?>
						<div class="text-center">
							<p><strong><?php _e( "I'm a new customer and would like to register." ,'thevoux' ); ?></strong></p>
							<a href="#" class="btn small" id="create-account"><?php _e( 'Create a New Account','thevoux' ); ?></a>
						</div>
						<?php endif; ?>
					</div>
					<?php if (get_option('woocommerce_enable_myaccount_registration')=='yes') : ?>
					<div class="register-container">
						<p class="text-center"><?php _e( "I'm a new customer and would like to register." ,'thevoux' ); ?></p>
						<form method="post" class="register text-center">
							<?php do_action( 'woocommerce_register_form_start' ); ?>
							<?php if (get_option('woocommerce_registration_generate_username')=='no') : ?>
									<input type="text" class="input-text full" name="username" id="reg_username" value="<?php if (isset($_POST['username'])) echo esc_attr($_POST['username']); ?>" placeholder="<?php _e( 'Username', 'woocommerce' ); ?>" />
						
							<?php else : endif; ?>
								<input type="email" class="input-text full" name="email" id="reg_email" value="<?php if (isset($_POST['email'])) echo esc_attr($_POST['email']); ?>" placeholder="<?php _e( 'Email address', 'woocommerce' ); ?>" />
							<?php if (get_option('woocommerce_registration_generate_password')=='no') : ?>
								<input type="password" class="input-text full" name="password" id="reg_password" value="<?php if (isset($_POST['password'])) echo esc_attr($_POST['password']); ?>" placeholder="<?php _e( 'Password', 'woocommerce' ); ?>" />
							<?php endif; ?>
							<!-- Spam Trap -->
							<div style="left:-999em; position:absolute;"><label for="trap"><?php _e( 'Anti-spam','thevoux' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>
						
								<?php do_action( 'woocommerce_register_form' ); ?>
								<?php do_action( 'register_form' ); ?>
						
								<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
								<input type="submit" class="button black small" name="register" value="<?php _e( 'Register','thevoux' ); ?>" />

							<?php do_action( 'woocommerce_register_form_end' ); ?>
						</form>
						<div class="text-center">
							<p><strong><?php _e( "I'm an existing customer and would like to login." ,'thevoux' ); ?></strong></p>
							<a href="#" class="btn small" id="login-account"><?php _e( 'Login to Existing Account','thevoux' ); ?></a>
						</div>
					</div>
					<?php endif; ?>
				<?php do_action('woocommerce_after_customer_login_form'); ?>
			</div>
	</div>
</div>