<?php
// **********************************************************
// If you want to have an own template for this action
// just copy this file into your current theme folder
// and change the markup as you want to
// **********************************************************
if ( is_user_logged_in() ) {
	wp_safe_redirect( home_url( '/account/' ) );
	exit;
}

?>
<?php get_header(); ?>

<div class="content-page clearfix">
  <div class="container">
    <div id="main-content" class="main-content full-width">
      <div id="primary" class="content-area main-content-bg clearfix">
        <div id="content" class="site-content" role="main">
          <h3>
            <?php _e( 'Lost your password?', 'user-frontend-td' ); ?>
          </h3>
          <?php echo apply_filters( 'uf_forgot_password_messages', isset( $_GET[ 'message' ] ) ? $_GET[ 'message' ] : '' ); ?>
          <form action="<?php echo uf_get_action_url( 'forgot_password' ); ?>" method="post" id="user_forgot_form">
            <?php wp_nonce_field( 'forgot_password', 'wp_uf_nonce_forgot_password' ); ?>
           
		    <p><?php _e( 'Please enter your username or email address. You will receive a link to create a new password via email.' ) ?></p>
			<p>
			  <label for="user_login"><?php _e( 'Username or E-mail:' ); ?></label>
			  <input type="text" name="user_login" id="user_login" required/> 
            </p>
           
			
            <p><input type="submit" name="submit" id="submit" class="consultantsubmitbutton" value="<?php _e( 'Get New Password' ); ?>"></p>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery( "#user_forgot_form" ).validate({
	  messages: {
		user_login: "Please fill in the required field.",
	  }
	});
});
</script>
<?php get_footer(); ?>
