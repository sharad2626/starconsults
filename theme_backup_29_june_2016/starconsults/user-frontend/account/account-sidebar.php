<div class="leftbg">
	  
	  <?php 
	  $usermeta = get_user_meta($user->data->ID, 'user_billing_shipping', true);
$usermeta = unserialize($usermeta);
$userBilling = $usermeta['billing'];
	  
	  
	  $userImage = get_user_meta($user->data->ID, 'wpcf-consultants-image', true);
	  
	  if(!empty($userImage)){
	  	$userImage = get_bloginfo('template_url').'/timthumb.php?src='.$userImage.'&w=350&zc=0&q=95';
	  }

	  
	  if(empty($userImage)){
	  	$userImage = IMAGES_URL.'/left-video-img.png';
	  }
	  
	  ?>
	  
        <div class="left-video" style="text-align:center"> <a href="#"><img src="<?php echo $userImage;?>" /></a></div>
		
		<div class="left-learning">
		
		<h3 style="border:0; padding-bottom:10px"><?php echo $userName;?></h3>
		<?php
			global $current_user, $wpdb;
			$role = $wpdb->prefix . 'capabilities';
			$current_user->role = array_keys($current_user->$role);
			$role = $current_user->role[0];
			//echo"===========". $role;
         ?>
		<?php if($userBilling && !empty($userBilling)){?>
		<p><?php echo $userBilling['city'];?></p>
		<?php }?>
		<?php 
		$section = get_query_var("section");
		?>
		<ul id="myTab" class="nav nav-pills nav-stacked">
			<li <?php if(empty($section)){?>class="active"<?php }?>><a href="<?php echo get_bloginfo("siteurl").'/account';?>">Profile</a></li>
			<?php if($role=='consultant'){ ?>
			<li <?php if($section == "videos"){?>class="active"<?php }?>><a href="<?php echo get_bloginfo("siteurl").'/account/videos'?>">My products (time slots & videos)</a></li>
			<?php } ?>
			<li <?php if($section == "message"){?>class="active"<?php }?>><a href="<?php echo get_bloginfo("siteurl").'/account/message'?>">Message</a></li>
			<!--<li><a href="<?php echo get_bloginfo("siteurl").'/orders'?>">Orders</a></li>-->
			<?php
			if($role=='subscriber'){ ?>
			<li><a href="<?php echo get_bloginfo("siteurl").'/my-purchase'?>">My purchases</a></li>
			<?php } ?>
			<?php
			if($role=='consultant'){ ?>
			<li><a href="<?php echo get_bloginfo("siteurl").'/my-purchase'?>">My purchases</a></li>
			<li><a href="<?php echo get_bloginfo("siteurl").'/my-sale'?>">My sales</a></li>
			<?php } ?>
			
			<?php 
			/*
			$currentuserrole = $user->roles[0];
			if(!empty($user->data) && $currentuserrole == "consultant" ){?>
			<li><a href="<?php echo get_bloginfo("siteurl").'/orders?type=self'?>">My Purchases</a></li>
			<?php }
			*/?>
			
			
			<?php /*?><li <?php if($section == "contact"){?>class="active"<?php }?>><a href="<?php echo get_bloginfo("siteurl").'/account/contact'?>">Contact</a></li><?php */?>
		</ul>
		
		<?php 
			$roles = $user->roles;
			if(!in_array('administrator',$roles) && !in_array('consultant',$roles)){ ?>
		<div class="extra_subscriber_link">Interested in becoming a Star Consultant? <a href="<?php echo get_bloginfo("siteurl").'/contact-us'?>">Click Here!</a>
			
		</div>
		<?php }?>
		
		
		</div>
		
      </div>