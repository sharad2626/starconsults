<?php get_header();?>

<?php if (have_posts()) : while (have_posts()) : the_post(); 
	$bannerImage = types_render_field("banner-image",array('url'=>true));
	if(!empty($bannerImage)){ ?>
		<div class="top_banner">
			<img src="<?php echo $bannerImage;?>" alt="<?php the_title();?>" />
		</div>
	<?php }
endwhile; endif;?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="content-page clearfix">
  <div class="container">
    <div class="main-content">
      <div class="bread"> <a href="#">Home</a> <span>></span> <a href="#">Mathematics</a> <span>></span> <span>step by step learning calculus</span> </div>
      <div class="main-content-bg clearfix">
		<h1><?php the_title();?></h1>
        <?php $mainContent = get_the_content();
		
		echo $mainContent;
		
		?>
      </div>
    </div>
    <div class="left-side">
      <div class="bread">&nbsp;</div>
      <div class="leftbg">
        <div class="left-video"> 
		
		<?php 
		
		
		
		$viddlerdata = getViddlerData(get_the_ID());
		if(!empty($viddlerdata['thumbnail']) && !empty($viddlerdata['id'])){
			$image = $viddlerdata['thumbnail'];
			//$image = THEME_URL."/timthumb.php?src=".$image."&h=275&w=366&zc=0";
		}else{
			$image = types_render_field("preview-image",array("url"=>true));
			$image = THEME_URL."/timthumb.php?src=".$image."&h=275&w=366&zc=0";
		}
		
		$previewVideoUrl = types_render_field("preview-video-url",array("url"=>true));
		
		if(!empty($previewVideoUrl)){
			if(strstr($previewVideoUrl,'?v=') && strstr($previewVideoUrl,'youtube.com')){
				$videoUrl = explode('?v=',$previewVideoUrl);
				$previewVideoUrl = 'http://www.youtube.com/embed/'.$videoUrl[1];
			}else{
				$videoUrl = explode('/v/',$previewVideoUrl);
				$previewVideoUrl = 'http://www.viddler.com/embed/'.$videoUrl[1].'/?f=1&player=full&make_responsive=0';
			}
		
			?>
		<a href="<?php echo $previewVideoUrl;?>" class="video-fancybox"><img src="<?php echo $image;?>" alt="<?php the_title();?>" /></a>
		 <a href="<?php echo $previewVideoUrl;?>" class="video-preview video-fancybox">Click to Preview</a> 
		<?php }else{?>
		
		<img src="<?php echo $image;?>" alt="<?php the_title();?>" />
		<?php /*?> <span class="video-preview">Click to Preview</span><?php */?> 
		
		<?php }?>

		</div>
        <div class="left-learning">
          <?php $term_list = wp_get_post_terms(get_the_ID(), 'ptype', array("fields" => "names"));
					if(!empty($term_list)){
						echo "<h2>".implode(", ",$term_list).'</h2>';
					}
					?>
          <h3><?php the_title();?></h3>
          <div class="product-details">
		  <?php 
		  $authorId = get_the_author_ID();
		  $userImage = types_render_usermeta_field( "consultants-image", array("user_id" => $authorId,"url"=>true ));
		  ?>
		  
            <div class="img"><img src="<?php echo $userImage;?>" /></div>
            <div class="left-details">
              <h4>Instructor</h4>
			  <?php $consultantdetails = get_userdata( $authorId ); 
			  $username = $consultantdetails->data->user_login;
			  ?>
              <p><a href="<?php echo get_bloginfo('siteurl').'/consultant/'.$username;?>"><?php echo get_the_author();?></a></p>
            </div>
			
			
			<?php $basePrice = get_post_meta(get_the_ID(),'base_price',true);
			$salePrice = get_post_meta(get_the_ID(),'sales_price',true); 
			$currency_sign = get_option('_wpmp_curr_sign','$');
			?>
			
            <div class="clearfix price">
			<?php if(!empty($salePrice) && $salePrice !== "0.00" && $salePrice !== "0"){
				echo $currency_sign.number_format($salePrice,2,".","");
			}else{
				echo $currency_sign.number_format($basePrice,2,".","");
			}?>
			</div>
            
			<?php 
			$currentuserrole = $current_user->roles[0];
			if(!empty($current_user->data) && $currentuserrole == "consultant" && $authorId == $current_user->ID){
				//Hide Purchase for consultant
			}else if($current_user || !empty($current_user->data)){
			
						
				$userOrdered = checkProductInUserOrder($current_user->data->ID , get_the_ID());
				
				if($userOrdered){ ?>
					<button type="button" class="button" onclick="location.href='<?php echo get_bloginfo('siteurl').'/viewvideo/'.get_the_ID();?>'">View Video</button>
				<?php }else{ ?>
				
				
				<?php $productType = types_render_field("product-type",array("output"=>"raw"));
				
				
				
				?>
				
					<form method="post" id="addToCart" action="">
						<input type="hidden" name="add_to_cart" id="add_to_cart" value="add" />
						<input type="hidden" name="pid" id="pid" value="<?php echo get_the_ID();?>" />
						<?php if($productType == "time_slot"){?>
							<label for="quantity">Qty: </label><input type="text" name="quantity" id="quantity" style=" width: 40px;margin-bottom: 20px;  margin-left: 10px;  text-align: center;"  />
						<?php }else{?>
							<input type="hidden" name="quantity" id="quantity" value="1" />
						<?php }?>
						<button type="submit" class="button">Pay to view the full video</button>
					</form>
				<?php }
			}else{
			?>
			<form method="post" id="addToCart" action="">
				<input type="hidden" name="add_to_cart" id="add_to_cart" value="add" />
				<input type="hidden" name="pid" id="pid" value="<?php echo get_the_ID();?>" />
				<?php if($productType == "time_slot"){?>
						<label for="quantity">Qty: </label><input type="text" name="quantity" id="quantity" style=" width: 40px;margin-bottom: 20px;  margin-left: 10px;  text-align: center;"  />
					<?php }else{?>
						<input type="hidden" name="quantity" id="quantity" value="1" />
					<?php }?>
				<button type="submit" class="button">Pay to view the full video</button>
			</form>
			<?php }?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endwhile; endif;?>
<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery(".video-fancybox").fancybox({
			type: "iframe",
			maxWidth:470,
			maxHeight:450,
			iframe : {
			  preload: false
			}
		});
		
		
		
		
	});
</script>
<?php get_footer();?>
