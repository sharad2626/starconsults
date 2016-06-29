<?php get_header();?>
<?php 
$term =	$wp_query->queried_object;
$catImg = get_tax_meta($term->term_id,'tf_banner_image');
$imagesrc = $catImg['src'];
?>
<?php 
	if(!empty($imagesrc)){ ?>
		<div class="top_banner">
			<img src="<?php echo $imagesrc;?>" alt="<?php echo $term->name;?>" />
		</div>
	<?php }
?>
<div class="content-page clearfix">
  <div class="container">
    <div class="main-content full-width">
	
	
	<div class="col-sm-9">
	
	
	
		<div class="page-title"><h1>Category : <span><?php single_cat_title( '', true ); ?></span></h1></div>
	
     
<?php if (have_posts()) : ?>
 <div class="main-content-bg bluebg clearfix">
		<div class="custom_pagination"><?php wp_pagenavi();?></div>
		<?php while (have_posts()) : the_post(); ?>
		<div class="single_category_product">
			<div class="col-sm-4">
				<?php 
				
				$viddlerdata = getViddlerData(get_the_ID());
				if(!empty($viddlerdata['thumbnail']) && !empty($viddlerdata['id'])){
					$image = $viddlerdata['thumbnail'];
				}else{
					$image = types_render_field("preview-image",array("url"=>true));
				}
				
				
				
				
				
				?>
				<a href="<?php the_permalink();?>"><img src="<?php echo $image;?>" alt="<?php the_title();?>" /></a>
			</div>
			<div class="col-sm-8">
				<div class="cat_product_title"><a href="<?php the_permalink();?>"><?php the_title();?></a></div>
				<div class="product_content">
					<?php echo types_render_field("short-description",array("output"=>"raw"));;?>
				</div>
				<div class="cat_product_author_details">
					<div class="pull-left">
						<?php 
						
						$userImage = types_render_usermeta_field( "consultants-image", array("user_id" => get_the_author_ID(),"url"=>true ));
						
						$currentUser = get_userdata( get_the_author_ID() );
						$userDetails = $currentUser->data;
						
						if(!empty($userImage)){ ?>
							<a href="<?php echo get_bloginfo('siteurl').'/consultant/'.$userDetails->user_login;?>"><img src="<?php echo $userImage;?>" alt="<?php echo get_the_author();?>" /></a>
						<?php } ?>
						<a href="<?php echo get_bloginfo('siteurl').'/consultant/'.$userDetails->user_login;?>"><?php echo get_the_author();?></a>
					</div>
					<div class="pull-right">
						<?php $basePrice = get_post_meta(get_the_ID(),'base_price',true);
						$salePrice = get_post_meta(get_the_ID(),'sales_price',true); 
						$currency_sign = get_option('_wpmp_curr_sign','$');
						?>
						
						<div class="price">
						<?php if(!empty($salePrice) && $salePrice !== "0.00" && $salePrice !== "0"){
							echo $currency_sign.number_format($salePrice,2,".","");
						}else{
							echo $currency_sign.number_format($basePrice,2,".","");
						}?>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php endwhile;?></div><?php endif; wp_reset_postdata(); wp_reset_query();?>
      </div>
	  
	  
	  <div class="col-sm-3">
	  	<div class="tax_sidebar">
			<div class="page-title"><h1>&nbsp;</h1></div>
			<div style="clear:both"></div>
			<div class="becomeConsultant">
				<a href="<?php echo get_bloginfo("siteurl");?>/contact-us/">Become Consultant</a>
			</div>
			<div class="category_list">
				<div class="category_title">Category</div>
				<ul>
				<?php 
				$allterms = get_terms("ptype", array('hide_empty'=> false));
				foreach($allterms as $singleterm){ 
				
				?>
					<li><a href="<?php echo get_term_link($singleterm); ?>"><?php echo $singleterm->name; ?></a></li>
				<?php }
				?>
				</ul>
			</div>
		</div>
	  </div>
	  
    </div>
  </div>
</div>

<?php get_footer();?>
