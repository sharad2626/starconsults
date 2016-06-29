<?php
session_start();
// **********************************************************
// If you want to have an own template for this action
// just copy this file into your current theme folder
// and change the markup as you want to
// **********************************************************
if ( is_user_logged_in() ) {
	wp_safe_redirect( home_url( '/account/' ) );
	exit;
}
function random($length){
//create a or array string called chars
        $chars ="abcdefghijklmnopqrstuvwxyz23456789";
         $str = "";
        //is the variable which is equal to the length of the string called chars
        $size = strlen($chars);
        for($i=0; $i<$length; $i++){
             $str .= $chars[rand(0, $size-1)];

    }
	$_SESSION['captacha_text']=$str;
    return $str;
}

$abc=random(5);
?>
<?php get_header(); ?>

<div class="content-page clearfix">
  <div class="container">
    <div id="main-content" class="main-content full-width">
      <div id="primary" class="content-area main-content-bg clearfix">
        <div id="content" class="site-content" role="main">
          <h3>
            <?php _e( 'Register', 'user-frontend-td' ); ?>
          </h3>
          <?php echo apply_filters( 'uf_register_messages', isset( $_GET[ 'message' ] ) ? $_GET[ 'message' ] : '' ); ?>
          <form action="<?php echo uf_get_action_url( 'register' ); ?>" method="post" id="user_register_form">
            <?php echo apply_filters( 'login_form_top', '', uf_login_form_args() ); ?>
            <?php wp_nonce_field( 'register', 'wp_uf_nonce_register' ); ?>
            <?php //echo isset( $_GET[ 'redirect_to' ] ) ? '<input type="hidden" name="redirect_to" value="' . esc_url( $_GET[ 'redirect_to' ] ) . '">' : ''; ?>
            <p>
			  <label for="user_login"><?php _e( 'Username*' ); ?></label>
			  <input type="text" name="user_login" id="user_login" required/> 
            </p><?php /*?><span class="description"><?php _e( 'Usernames cannot be changed.' ); ?></span><?php */?>
            <p>
              <label for="email"><?php _e( 'Email Address*' ); ?> </label>
              <input type="email" name="email" id="email" required /><?php /*?><span class="description"><?php _e( ' (required)' ); ?></span><?php */?>
            </p>
			<p>
			  <label for="chs_pass"><?php _e( 'Choose a Password*' ); ?></label>
			  <input type="password" name="user_password" id="password" required /> <?php /*?><span class="description"><?php _e( ' (required)' ); ?></span><?php */?>
            </p>
			<p>
			  <label for="cfm_pass"><?php _e( 'Confirm Password*' ); ?></label>
			  <input type="password" name="cfm_password" id="cfm_password" required /> <?php /*?><span class="description"><?php _e( ' (required)' ); ?></span><?php */?>
            </p>
			<p>
			  <label for="location"><?php _e( 'Location*' ); ?></label>
			  <input type="text" name="location" id="location" required /> 
            </p>
			<p class="terms_checkbox">
              <input type="checkbox" name="terms" id="terms" required>
			  <label for="terms" class="termLabel">
			  I read and agree the terms and conditions  <?php echo $_SESSION['vercode']; ?>
			  </label>
            </p>
         <p>
			  <label for="captcha"><?php _e( 'Captcha' ); ?></label>
			  
			  <input style="color:#01479F;font-size:18px;border:0;background-color:#BDBDBD;" type="text" name="cap" id="cap" value="<?php echo $abc; ?>" readonly="true" size="5" id="searchFieldText" onfocus="this.blur();" class="valid">
			  
            </p>
			<p>
			  <label for="captcha"><?php _e( 'Enter the captcha code here*' ); ?></label>
			  <input type="text" name="captcha" id="captcha" required /> 
            </p>
            <p><input type="submit" name="submit" id="submit" class="consultantsubmitbutton" value="<?php _e( 'Register', 'user-frontend-td' ); ?>"></p>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!--<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery( "#user_register_form" ).validate({
	  rules: {
		password: "required",
		cfm_password: {
		  equalTo: "#password"
		}
	  },
	  messages: {
		user_login: "Please fill in the required field.",
		email: {
		  required: "Please fill in the required field.",
		  email: "Email address seems invalid."
		},
		user_password: "Please fill in the required field.",
		cfm_password: "Please fill in the required field.",
		location: "Please fill in the required field.",
		terms: "Please indicate that you accept the Terms and Conditions.",
	  }
	});
});
</script>-->
<script type="text/javascript">
jQuery(document).ready(function () {
jQuery('#cap').unbind();
jQuery.validator.addMethod("ContainsAtLeastOnespecialchar", function (value) { 
      return /[!@#$%^&*.:;()<>\/?+-]/.test(value);
}, 'Your input must contain at least 1 special character');
jQuery.validator.addMethod(
        'ContainsAtLeastOneCapitalLetter',
        function (value) { 
            return /[A-Z]/.test(value); 
        },  
        'Your password must contain at least one capital letter.'
    );
 jQuery.validator.addMethod(
        'ContainsAtLeastOneDigit',
        function (value) { 
            return /[0-9]/.test(value); 
        },  
        'Your password must contain at least one digit.'
    );  
	jQuery.validator.addMethod(
        'ContainsAtLeastOnelLetter',
        function (value) { 
            return /[a-z]/.test(value); 
        },  
        'Your password must contain at least one  letter.'
    );
      jQuery('#user_register_form').validate({ // initialize the plugin
   errorElement: "div",
        rules: {
            user_login: {
                required: true
                
            },
			email: {
                required: true,
				email:true
                
            },
			user_password: {
                required: true,
				minlength: 8,
				ContainsAtLeastOnespecialchar : true,
				ContainsAtLeastOneCapitalLetter : true,
				ContainsAtLeastOneDigit : true,
			    ContainsAtLeastOnelLetter : true
                
            },
			cfm_password: {
                required: true,
				equalTo: "#password"
                
            },
			terms: {
                required: true
                
            } ,
			 captcha:{
                 required: true,
				 equalTo: "#cap"
 
			}
			


		},

		messages:{

              user_login: {
			  required:"Please fill in the required field."
             },
			  email: {
			  required:"Please fill in the required field.",
			  email:"Please fill in the required field."
             },
			  user_password: {
			  required:"Please fill in the required field."
             },
			  cfm_password: {
			  required:"Please fill in the required field."
             },
			  terms: {
			  required:"Please indicate that you accept the Terms and Conditions."
             }

        }
    });

});	
</script>

<?php get_footer(); ?>
