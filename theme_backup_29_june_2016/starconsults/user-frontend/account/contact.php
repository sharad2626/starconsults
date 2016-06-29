<?php 

if ( ! is_user_logged_in() ) {
	wp_safe_redirect( home_url( '/login/' ) );
	exit;
}


$user = get_userdata( get_current_user_id() );
$user->filter = 'edit';
$profileuser = $user;

$userName = $user->data->user_nicename;

get_header();?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="content-page clearfix">
  <div class="container">
    <div class="main-content">
      <?php /*?><div class="bread"> <a href="#">Home</a> <span>></span> <a href="#">Mathematics</a> <span>></span> <span>step by step learning calculus</span> </div><?php */?>
	  
	  <?php /*?><h2><?php _e( 'Profile', 'user-frontend-td' ); ?></h2><?php */?>
			<?php echo apply_filters( 'uf_profile_messages', isset( $_GET[ 'message' ] ) ? $_GET[ 'message' ] : '' ); ?>
	  
	  
      <div class="main-content-bg clearfix">
		
		<div id="myTabContent" class="tab-content">
		  <div class="tab-pane active" id="contact">
		  	<h1><?php echo 'Contact '.$userName;?></h1>
			<div class="consultant-form consultant-contact-form">
				<div class="col-sm-8">
					<?php echo do_shortcode('[contact-form-7 id="99" title="Meet The Consultant"]');?>
				</div>
				<div class="col-sm-4">
					<?php if(empty($userImage)){
						$userImage = IMAGES_URL.'/left-video-img.png';
					  }?>
					<img src="<?php echo $userImage;?>" alt="" />
				</div>
			</div>
		  </div>
		</div>

		
		
      </div>
    </div>
    <div class="left-side">
      <?php require "account-sidebar.php";?>
    </div>
  </div>
</div>
<?php endwhile; endif;?>
<?php get_footer();?>
