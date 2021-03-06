<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
<?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged,$current_user;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'starconsults' ), max( $paged, $page ) );

	?>
</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<?php wp_head();?>
<?php 
define("THEME_URL",get_bloginfo("template_url"));
define("CSS_URL",get_bloginfo("template_url").'/css');
define("JS_URL",get_bloginfo("template_url").'/js');
define("IMAGES_URL",get_bloginfo("template_url").'/images');

?>
<?php /*?><script type="text/javascript" src="<?php echo JS_URL?>/bootstrap.js"></script><?php */?>
<script type="text/javascript" src="<?php echo JS_URL?>/jquery.bxslider.js"></script>
<script type="text/javascript" src="<?php echo JS_URL?>/owl.carousel.js"></script>
<script type="text/javascript" src="<?php echo JS_URL?>/jquery.dataTables.min.js"></script>


<script type="text/javascript" src="<?php echo JS_URL;?>/jquery.mousewheel.pack.js?v=3.1.3"></script>
<script type="text/javascript" src="<?php echo JS_URL;?>/jquery.fancybox.pack.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="<?php echo CSS_URL;?>/jquery.fancybox.css?v=2.1.5" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo CSS_URL;?>/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
<script type="text/javascript" src="<?php echo JS_URL;?>/jquery.fancybox-buttons.js?v=1.0.5"></script>
<link rel="stylesheet" type="text/css" href="<?php echo CSS_URL;?>/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
<script type="text/javascript" src="<?php echo JS_URL;?>/jquery.fancybox-thumbs.js?v=1.0.7"></script>
<script type="text/javascript" src="<?php echo JS_URL;?>/jquery.fancybox-media.js?v=1.0.6"></script>




<?php /*?><link rel="stylesheet" href="<?php echo CSS_URL?>/bootstrap.css" />
<?php */?>
<link rel="stylesheet" href="<?php echo CSS_URL?>/custom.css" />
<link rel="stylesheet" href="<?php echo CSS_URL?>/jquery.bxslider.css" />
<link rel="stylesheet" href="<?php echo CSS_URL?>/owl.carousel.css" />
<link rel="stylesheet" href="<?php echo get_bloginfo("stylesheet_url");?>" />
<link href='http://fonts.googleapis.com/css?family=Raleway:500,600,700,800,900,400,300' rel='stylesheet' type='text/css'>


<?php 
$settings = get_option('_wpmp_settings');
if(get_permalink($settings['page_id']) !== get_permalink()){ ?>
	<script type="text/javascript" src="<?php echo JS_URL?>/cartFunction.js"></script>
<?php }
?>


</head>
<body <?php body_class();?>>
<div class="header-bg clearfix">
  <div class="container">
    <div class="logo"><a href="<?php echo get_bloginfo("siteurl");?>" title="<?php echo get_bloginfo("name")?>"><img src="<?php echo IMAGES_URL?>/logo.png" /></a></div>
    <div class="header-right">
      <div class="top-links">
        <ul>
          <?php $cartData = wpmp_get_cart_data();
		$cartQy = 0;
		if(!empty($cartData)){
			foreach($cartData as $product){
				$productQty = $product['quantity'];
				$cartQy  = $cartQy + $productQty;
			}
		}
		?>
          <li class="cart" id="cartLink"><a  class="cartLink" href="javascript:;<?php //echo get_bloginfo("siteurl").'/cart';?>"><span class="cart_qty"><?php echo $cartQy;?></span></a>
		  
		  <div class="cart_header_data">
		  		<?php include("header_cart.php");?>
		  </div>
		  
		  
		  
		  </li>
		  
		  <?php 
		  ?>
		  
          <?php if(!is_user_logged_in()):?>
          <li class="login" id="loginLink"><a href="javascript:;<?php //echo get_bloginfo("siteurl").'/login';?>">Login</a>
		  <div class="login_header_form">
		  	<form action="<?php echo uf_get_action_url( 'login' ); ?>" method="post">
				<?php echo apply_filters( 'login_form_top', '', uf_login_form_args() ); ?>
				<?php wp_nonce_field( 'login', 'wp_uf_nonce_login' ); ?> 
				<?php echo isset( $_GET[ 'redirect_to' ] ) ? '<input type="hidden" name="redirect_to" value="' . esc_url( $_GET[ 'redirect_to' ] ) . '">' : ''; ?>
				
				<p>
              <label for="user_login">
              <?php _e( 'Username', 'user-frontend-td' ); ?>
              </label>
              <input type="text" name="user_login" id="user_login">
            </p>
            <p>
              <label for="user_pass">
              <?php _e( 'Password', 'user-frontend-td' ); ?>
              </label>
              <input type="password" name="user_pass" id="user_pass">
            </p>
            <?php echo apply_filters( 'login_form_middle', '', uf_login_form_args() ); ?>
            <p>
              <label for="rememberme">
              <input type="checkbox" name="rememberme" id="rememberme">
              <?php _e( 'Remember', 'user-frontend-td' ); ?>
              </label>
              <input type="submit" name="submit" id="submit" value="<?php _e( 'Submit', 'user-frontend-td' ); ?>">
            </p>
            <p> <a id="header_forget_link" href="<?php echo home_url( '/user-forgot-password/' ); ?>">
              <?php _e( 'Forgot Password?', 'user-frontend-td' ); ?>
              </a>
              <?php
					if ( get_option( 'users_can_register' ) && ( is_multisite() && get_site_option( 'registration' ) != 'none' ) ) :
						$registration_url = sprintf( '<a href="%s">%s</a>', esc_url( home_url( '/user-register/' ) ), __( 'Register' ) );
						/** This filter is documented in wp-includes/general-template.php */
						echo ' | ' . apply_filters( 'register', $registration_url );
					endif;
					?>
            </p>
            <?php echo apply_filters( 'login_form_bottom', '', uf_login_form_args() ); ?>
				
				
			</form>
		  </div>
		  
		  
		  </li>
          <li class="signup"><a href="<?php echo get_bloginfo("siteurl").'/register';?>">Sign Up</a></li>
          <?php else:?>
          <li class="login"><a href="<?php echo get_bloginfo("siteurl").'/account';?>">My Account</a></li>
          <li><a href="<?php echo uf_logout_url();?>">Logout</a></li>
          <?php endif; ?>
        </ul>
      </div>
      <div class="navbar yamm navbar-default">
        <div>
          <div class="navbar-header">
            <button type="button" data-toggle="collapse" data-target="#navbar-collapse-1" class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
          </div>
          <div id="navbar-collapse-1" class="navbar-collapse collapse">
            <?php /*?><ul class="nav navbar-nav">
              <!-- Classic list -->
              <li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle">Categories</a>
                <ul class="dropdown-menu">
                  <li><a href="#">Test Menu1</a></li>
                  <li><a href="#">Test Menu1</a></li>
                  <li><a href="#">Test Menu1</a></li>
                  <li><a href="#">Test Menu1</a></li>
                </ul>
              </li>
              <li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle">Consultant</a>
                <ul class="dropdown-menu">
                  <li><a href="#">Test Menu1</a></li>
                  <li><a href="#">Test Menu1</a></li>
                  <li><a href="#">Test Menu1</a></li>
                  <li><a href="#">Test Menu1</a></li>
                </ul>
              </li>
              <li><a href="#">About us</a></li>
              <li><a href="#">Contact us</a></li>
              <li class="search	"><a href="#">Search</a></li>
            </ul><?php */?>
            <?php

$defaults = array(
	'theme_location' => 'header-menu',
	'container'       => '',
	'menu_class'      => 'nav navbar-nav',
	'walker' => new Nav_Walker_Nav_Menu()
);

wp_nav_menu( $defaults );

?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery("#loginLink a").click(function(){
		
		var forgotId = jQuery(this).attr("id");
		var cartData = jQuery(".cart_header_data").css("display");
		var searchData = jQuery(".search_header_form").css("display");
		if(searchData == "block"){
			jQuery(".search_header_form").hide();
		}
		if(cartData == "block"){
			jQuery(".cart_header_data").hide();
		}
		jQuery(this).parent().find(".login_header_form").slideToggle();
		if(forgotId != "header_forget_link"){
			return false;
		}
		
		
	})
	
	jQuery("#cartLink a.cartLink").click(function(){
		var loginData = jQuery(".login_header_form").css("display");
		var searchData = jQuery(".search_header_form").css("display");
		if(searchData == "block"){
			jQuery(".search_header_form").hide();
		}
		if(loginData == "block"){
			jQuery(".login_header_form").hide();
		}
		jQuery(this).parent().find(".cart_header_data").slideToggle();
		return false;
	})
	
	jQuery("#searchLink a.searcha").click(function(){
		var loginData = jQuery(".login_header_form").css("display");
		var cartData = jQuery(".cart_header_data").css("display");
		if(loginData == "block"){
			jQuery(".login_header_form").hide();
		}
		if(cartData == "block"){
			jQuery(".cart_header_data").hide();
		}
		jQuery(this).parent().find(".search_header_form").slideToggle();
		return false;
	})
	
})
</script>