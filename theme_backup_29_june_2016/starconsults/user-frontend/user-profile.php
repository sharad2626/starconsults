<?php 

if ( ! is_user_logged_in() ) {
	wp_safe_redirect( home_url( '/login/' ) );
	exit;
}


$user = get_userdata( get_current_user_id() );
$user->filter = 'edit';
$profileuser = $user;
$user_id=$user->ID;


$payment_account = get_user_meta( $user_id, 'payment_account','TRUE'); 
$Specialist = get_user_meta( $user_id, 'Specialist','TRUE'); 
$Location =   get_user_meta( $user_id, 'Location','TRUE'); 
//echo "payment_account ":$payment_account;
//die();
// if ($payment_account) {
// 	$payment_account=$payment_account
// }
// else
// {
// 	$payment_account="None";
// }
$userName = $user->data->user_nicename;





get_header();?>
<div class="content-page clearfix">
  <div class="container">
    <div class="main-content">
      <?php /*?><div class="bread"> <a href="#">Home</a> <span>></span> <a href="#">Mathematics</a> <span>></span> <span>step by step learning calculus</span> </div><?php */?>
	  
      <div class="main-content-bg clearfix">
		<form action="<?php echo uf_get_action_url( 'profile' ); ?>" method="post" <?php do_action( 'user_edit_form_tag' ); ?> enctype="multipart/form-data" id="userProfileForm">
				<?php wp_nonce_field( 'profile', 'wp_uf_nonce_profile' ); ?>
		<?php echo apply_filters( 'uf_profile_messages', isset( $_GET[ 'message' ] ) ? $_GET[ 'message' ] : '' ); ?>
		
		<ul class="nav nav-tabs">
			<li class="active"><a href="#profile" data-toggle="tab">My Profile</a></li>
			<li><a href="#avtar" data-toggle="tab">Change Profile Photo</a></li>
		</ul>
		
		
		
		<div id="profileTabContent" class="tab-content">
		  <div class="tab-pane fade in active" id="profile">
			<?php /*?><h2><?php _e( 'Profile', 'user-frontend-td' ); ?></h2><?php */?>
			
			<div class="consultant-form consultant-contact-form">
			
				
				
				<ul>
					<li>
						<label for="user_login"><?php _e( 'Username' ); ?></label>
						<input type="text" name="user_login" id="user_login" value="<?php echo esc_attr( $profileuser->user_login ); ?>" disabled="disabled" class="regular-text" /><span class="description"><?php _e( 'Usernames cannot be changed.' ); ?></span>
						
						
						<input type="hidden" name="nickname" id="nickname" value="<?php echo esc_attr( $profileuser->user_login ); ?>" class="regular-text" />
						
						
					</li>
					<li>
					<label for="first_name"><?php _e( 'First Name' ) ?></label>
					<input type="text" name="first_name" id="first_name" value="<?php echo esc_attr( $profileuser->first_name ) ?>" class="regular-text" /></li>
					<li>
						<label for="last_name"><?php _e( 'Last Name' ) ?></label>
					<input type="text" name="last_name" id="last_name" value="<?php echo esc_attr( $profileuser->last_name ) ?>" class="regular-text" /></li>
					
					<li>
						<label for="email"><?php _e( 'E-mail' ); ?></label>
					<input type="text" name="email" id="email" value="<?php echo esc_attr( $profileuser->user_email ) ?>" class="regular-text" /></li>

					<li>
						<label for="email"><?php _e( 'PayPal Account: ' ); ?></label>
					<input type="text" name="payment_account" id="payment_account" value="<?php echo $payment_account?>" class="regular-text" /></li>
					

                   <li>
						<label for="email"><?php _e( 'Specialist: ' ); ?></label>
					<input type="text" name="Specialist" id="Specialist" value="<?php echo $Specialist?>" class="regular-text" /></li>

					<li>
						<label for="email"><?php _e( 'Location: ' ); ?></label>
					<input type="text" name="Location" id="Location" value="<?php echo $Location?>" class="regular-text" /></li>

					
					<?php
					$show_password_fields = apply_filters( 'show_password_fields', TRUE, $profileuser );
					if ( $show_password_fields ) { ?>
						
						
						<li>
						<label for="pass1"><?php _e( 'New Password' ); ?></label>
					<input type="password" name="pass1" id="pass1" size="16" value="" autocomplete="off" /> <span class="description"><?php _e( 'If you would like to change the password type a new one. Otherwise leave this blank.' ); ?></span></li>
					
					
					
						<li>
							<label for="email"><?php _e( 'Confirm Password' ); ?></label>
						<input type="password" name="pass2" id="pass2" size="16" value="" autocomplete="off" /> <span class="description"><?php _e( 'Type your new password again.' ); ?></span>
						
						<div id="pass-strength-result"><?php _e( 'Strength indicator' ); ?></div>
								<p class="description indicator-hint"><?php _e( 'Hint: The password should be at least seven characters long. To make it stronger, use upper and lower case letters, numbers and symbols like ! " ? $ % ^ &amp; ).' ); ?>
						
						
						</li>
						
						
					<?php } ?>
					
					
					<li class="button">
					<button type="submit" id="submit" name="submit" class="button"><?php _e( 'Update Profile' ); ?></button>
					</li>
					
					
				</ul>
				
				
				
				<?php //do_action( 'show_user_profile', $profileuser ); ?>
				<?php /*?><!--<input type="submit" name="submit" id="submit" value="<?php _e( 'Update Profile' ); ?>">--><?php */?>
			
				</div>
		  </div>
		  
		  
		   <div class="tab-pane fade out" id="avtar">
		   	<h2><?php _e( 'Change Avtar', 'user-frontend-td' ); ?></h2>
			<p>Your avatar will be used on your profile and throughout the site. If there is a Gravatar associated with your account email we will use that, or you can upload an image from your computer.</p>
			<p>Click below to select a JPG, GIF or PNG format photo from your computer and then click 'Upload Image' to proceed.</p>
			<div class="consultant-form consultant-contact-form">
			
			
			
			<ul>
			<li>
					<input type="file" name="avtar" id="avtar" style="border:0; width:auto" /> </li>
			
			<li class="button">
					<button type="submit" id="submit2" name="submit2" class="button"><?php _e( 'Upload Image' ); ?></button>
			</li>
			
			<li><p>If you'd like to delete your current avatar but not upload a new one, please use the delete avatar button.
</p></li>


			<li class="button">
				<button type="button" id="delavtar" name="delavtar" class="button"><?php _e( 'Delete Avtar' ); ?></button>
				<input type="hidden" name="fulldeleteAvtar" value="0" id="fulldeleteAvtar" />
			</li>

			
			</ul>
			
			
			</div>
		   </div>
		  
		  
		  
		  
		  
		  
		</div>
</form>
		
		
      </div>
    </div>
    <div class="left-side">
      <?php require "account/account-sidebar.php";?>
    </div>
  </div>
</div>
<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery("#delavtar").click(function(){
			var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
			 jQuery.post( ajaxurl, 
			  { 
				action: 'delete_avtar',
				userId: <?php echo get_current_user_id();?>,  
			  }, function( response ) {
				var url = "<?php echo get_bloginfo("siteurl").'/account/?message=updated'?>";
				window.location.href = url; 
			  });
		})
	})
</script>
<?php get_footer();?>
