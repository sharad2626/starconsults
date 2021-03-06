<?php 
/*
	Template Name: Meet The Consultant
*/
?>


<?php 
$queryvarArgs = get_query_var("username");
if($_GET['username'] && !empty($_GET['username'])){
	$username = $_GET['username'];
}else if($queryvarArgs && !empty($queryvarArgs)){
	$username = get_query_var("username");
}else{
	wp_safe_redirect( home_url( '/' ) );
	exit;	
}


$userDetails = get_user_by( 'slug', $username ); 
if(!empty($userDetails)){
	$userDetails = $userDetails->data;
	$userImage = types_render_usermeta_field( "consultants-image", array("user_id" => $userDetails->ID,"url"=>true ));		
	$userId = $userDetails->ID;
	$userEmail = $userDetails->user_email;
	$userDatas = get_user_meta($userId,'user_billing_shipping',true);
	$userBilling = unserialize($userDatas);
	$userBilling = $userBilling['billing'];
	//$userProfile = types_render_usermeta_field( "user-profile", array("user_id" => $userDetails->ID));
	$userPrfile = get_user_meta($userId,'wpcf-user-profile',true);
	
	$userName =  $userDetails->display_name;
}else{
	wp_safe_redirect( home_url( '/' ) );
	exit;
}

?>


<?php get_header();?>
<?php 
global $user;

?>
<?php if (have_posts()) : while (have_posts()) : the_post(); 
	$bannerImage = types_render_field("banner-image",array('url'=>true));
	if(!empty($bannerImage)){ ?>
		<div class="top_banner">
			<img src="<?php echo $bannerImage;?>" alt="<?php the_title();?>" />
		</div>
	<?php }
endwhile; endif;?>
<div class="content-page clearfix">
  <div class="container">
    <div class="main-content">
      <?php /*?><div class="bread"> <a href="#">Home</a> <span>></span> <a href="#">Mathematics</a> <span>></span> <span>step by step learning calculus</span> </div><?php */?>
      <div class="main-content-bg nobg clearfix">

		<div id="myTabContent" class="tab-content">
		  <div class="tab-pane" id="profile">
			<h1><?php echo $userName;?></h1>
			<?php echo apply_filters('the_content',$userPrfile);?>
		  </div>
		  <div class="tab-pane fade in active" id="videos">
			<h1><?php echo $userName.'&rsquo;s Videos';?></h1>
			
			<div class="special_videos">
				<?php 
			$args = array('post_type' => 'wpmarketplace','posts_per_page'=> 2,'author' => $userId,
							'meta_query' => array(
								array(
									'key'     => 'wpcf-featured-product',
									'value'   => 'yes',
									'compare' => '=',
								),
							),
			);
			$loop = new WP_Query( $args );
			
			if($loop->found_posts > 0){ ?>
				<h2 class="special_video_title">Special Consultant Video with Phone</h2>
			<?php }
			$count = 1;
			while ( $loop->have_posts() ) : $loop->the_post(); ?>
			
			<div class="col-sm-6 <?php if($count == 1){ echo "first";}else{ echo "last";}?>">
				<div class="video_image">
				
				<?php 
				
				$viddlerdata = getViddlerData(get_the_ID());
				if(!empty($viddlerdata['thumbnail']) && !empty($viddlerdata['id'])){
					$image = $viddlerdata['thumbnail'];
					$image = THEME_URL."/timthumb.php?src=".$image."&h=275&w=366&zc=0";
				}else{
					$image = types_render_field("preview-image",array("url"=>true));
					$image = THEME_URL."/timthumb.php?src=".$image."&h=275&w=366&zc=0";
				}

				
				
				
				?>
				
					<a href="<?php the_permalink();?>" class="video-img"><img src="<?php echo $image;?>" alt="<?php the_title();?>" /></a>
				</div>
			</div>
			<?php endwhile; wp_reset_query();?>
			</div>
			
			
			
			
			
			
			
			
			
			<div class="userProducts bluebg">
			<?php 
			$pageds = get_query_var('paged') ? get_query_var('paged') : 1;
			$argss = array('post_type' => 'wpmarketplace','author' => $userId,'paged' => $pageds,);
			$loop2 = new WP_Query( $argss ); ?>
			
			<div class="custom_pagination"><?php wp_pagenavi( array( 'query' => $loop2 ) );?></div>
			
			<?php while ( $loop2->have_posts() ) : $loop2->the_post(); 
			
			?>
			
			<div class="col-sm-4 singleVideodetails">
				<div class="video_image">
					<?php 
					
					$viddlerdata = getViddlerData(get_the_ID());
					if(!empty($viddlerdata['thumbnail']) && !empty($viddlerdata['id'])){
						$image = $viddlerdata['thumbnail'];
					}else{
						$image = types_render_field("preview-image",array("url"=>true));
						$image = THEME_URL."/timthumb.php?src=".$image."&h=165&w=220&zc=0";
					}

					?>
				
					<a href="<?php the_permalink();?>" class="video-img"><img src="<?php echo $image;?>" alt="<?php the_title();?>" /></a>
				</div>
				<div class="video_details">
					<h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
					<?php $basePrice = get_post_meta(get_the_ID(),'base_price',true);
						$salePrice = get_post_meta(get_the_ID(),'sales_price',true); 
						$currency_sign = get_option('_wpmp_curr_sign','$');
					?>
					<div class="video_bottom">
					<span>
					<?php if(!empty($salePrice) && $salePrice !== "0.00" && $salePrice !== "0"){
								echo $currency_sign.number_format($salePrice,2,".","");
							}else{
								echo $currency_sign.number_format($basePrice,2,".","");
							}?>
					</span>
					</div>
				</div>
			</div>
			
			
			<?php endwhile; wp_reset_query();
			?>
			
			</div>
			
		  </div>
		  <div class="tab-pane fade" id="contact">
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
		  
		  <?php if ( is_user_logged_in() ) {?>
				 <div class="tab-pane fade" id="message">
					<h1><?php echo 'Message '.$userName;?></h1>
					<div class="messages_wrapper">
						<div class="col-sm-12">
							<?php echo do_shortcode('[private_message]');?>
						</div>
					</div>	
				  </div>
		<?php }?>
		  
		  
		  
		</div>
		
		
		
		

		
		
      </div>
    </div>
    <div class="left-side">
      <div class="leftbg">
	  
	  <?php if(empty($userImage)){
	  	$userImage = IMAGES_URL.'/left-video-img.png';
	  }
	  
	  $userImage = THEME_URL."/timthumb.php?src=".$userImage."&h=194&w=350&zc=0";
	  
	  ?>
	  
        <div class="left-video" style="text-align:center"> <a href="#"><img src="<?php echo $userImage;?>" /></a></div>
		
		<div class="left-learning">
		
		<h3 style="border:0; padding-bottom:10px"><?php echo $userName;?></h3>
		<?php if($userBilling && !empty($userBilling)){?>
		<p><?php echo $userBilling['city'];?></p>
		<?php }?>
		
		<ul id="myTab" class="nav nav-pills nav-stacked">
			<li><a href="#profile" data-toggle="tab">Profile</a></li>
			<li class="active"><a href="#videos" data-toggle="tab">Videos</a></li>
			<li><a href="#contact" data-toggle="tab">Email</a></li>
			<?php 
			
			if ( is_user_logged_in() ) {?>
				<li><a href="#message" data-toggle="tab">Message</a></li>
			<?php }?>
				
			
		</ul>
		</div>
		
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery("#consultant_email").attr("value","<?php echo $userEmail;?>");
})
</script>
<?php get_footer();?>
