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
<?php //if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="content-page clearfix">
  <div class="container">
    <div class="main-content">
      <?php /*?><div class="bread"> <a href="#">Home</a> <span>></span> <a href="#">Mathematics</a> <span>></span> <span>step by step learning calculus</span> </div><?php */?>
	  
	 <?php /*?> <h2><?php _e( 'Profile', 'user-frontend-td' ); ?></h2><?php */?>
			<?php echo apply_filters( 'uf_profile_messages', isset( $_GET[ 'message' ] ) ? $_GET[ 'message' ] : '' ); ?>
	  
	  
      <div class="main-content-bg clearfix">
		
		<div>
		  <div id="videos">
			<div class="userProducts">
				<?php 
				if(!empty($user->roles)){
					$userrole = $user->roles;
					$userrole = $userrole[0];
				}
				?>
				<?php 
				if($userrole && $userrole == "consultant"){ 
					//wpmp_frontend_saler();?>
					
					<ul class="nav nav-tabs">
						<li class="active"><a href="#myProduct" data-toggle="tab">My Products</a></li>
						<?php /*?><li><a href="#addProduct" data-toggle="tab">Add Products</a></li><?php */?>
						 <!--<li><a href="#earning" data-toggle="tab">Earning</a></li> -->
					</ul>
					<div class="tab-content">
						<div class="tab-pane fade in active" id="myProduct">
							<div class="myProductnewProfile">
								<h1 >My Products</h1>
								<div class="add_product_button"><a target="_blank" class="consultantsubmitbutton" href="<?php echo get_bloginfo("siteurl");?>/wp-admin/post-new.php?post_type=wpmarketplace">Add Product</a></div>
							</div>
							<?php wpmp_front_product_list();?>
						  </div>
						  <?php /*?><div class="tab-pane fade" id="addProduct">
							<h1>Add Products</h1>
							<?php wpmp_front_add_product();?>
						  </div><?php */?>
						 <!--<div class="tab-pane fade" id="earning">
							<h1>Earning</h1>
							<?php wpmp_earnings();?>
						  </div> -->
					</div>
					
				<?php }else{ ?>
					<h1><?php echo $userName.'&rsquo;s Videos';?></h1>
					<?php wpmp_user_order(); 
				}?>
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
<?php //endwhile; endif;?>
<?php get_footer();?>
