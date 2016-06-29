<?php get_header();?>
<?php /*?><div class="main-banner clearfix">
	<ul class="hom-slider-image">
    <li><a href="#"><img src="<?php echo IMAGES_URL?>/banner1.jpg" /></a></li>
    <li><a href="#"><img src="<?php echo IMAGES_URL?>/banner2.jpg" /></a></li>
    <li><a href="#"><img src="<?php echo IMAGES_URL?>/banner3.jpg" /></a></li>
    <li><a href="#"><img src="<?php echo IMAGES_URL?>/banner4.jpg" /></a></li>
    </ul>
</div><?php */?>


<?php layerslider(1) ?>






<div class="services-bg clearfix">
<div class="container">
<ul>

<?php 
$categories = get_terms("ptype", 'hide_empty=0&orderby=date');
$i=1;
foreach($categories as $category){
	$catImg = get_tax_meta($category->term_id,'tf_tax_image');
	$imagesrc = $catImg['src']; ?>
	
	<li>
		<a class="setServiceImageHeight" href="<?php echo get_term_link( $category );?>"><img src="<?php echo $imagesrc;?>" alt="<?php echo $category->name;?>" width="144" height="147" /></a>
		<h4><a href="<?php echo get_term_link( $category );?>"><?php echo $category->name;?></a></h4>
	</li>
	
<?php }
?>

</ul>
</div>
</div>




<div class="featured-consultant">
<div class="container">
<h2>Featured Consultant</h2>
<ul class="featured-consultant-slider">


<?php $userargs = array(
	'role'         => 'consultant',
 );
 $consultants = get_users( $userargs );
 if(!empty($consultants)){
 	foreach($consultants as $consultant){ 
	
		$userDetails = $consultant->data;
		$userImage = types_render_usermeta_field( "consultants-image", array("user_id" => $userDetails->ID,"url"=>true ));
		$userImage = THEME_URL."/timthumb.php?src=".$userImage."&h=220&w=290&zc=1";
		
		$featured = types_render_usermeta_field( "featured-user", array("user_id" => $userDetails->ID));
		if($featured == "no" || empty($featured) || !$featured){ continue;}
	
	?>
		<li>
			<a href="<?php echo get_bloginfo('siteurl').'/consultant/'.$userDetails->user_login;?>"><img src="<?php echo $userImage;?>" alt="<?php echo $userDetails->user_nicename;?>" width="290" height="220" /></a>
			<h3><a href="<?php echo get_bloginfo('siteurl').'/consultant/'.$userDetails->user_login;?>"><?php echo $userDetails->user_nicename;?></a></h3>
		</li>
	<?php }
 }
 
 
  ?>


</ul>
</div>

</div>






<div class="clearfix video-section">

<div class="container">
<div class="row">
	<div class="col-sm-6">
    <h2>Popular video</h2>
    <ul>
    	
		<?php 
			$args = array('post_type' => 'wpmarketplace','posts_per_page'=> -1);
			$loop = new WP_Query( $args );
			$count = 1;
			while ( $loop->have_posts() ) : $loop->the_post();
				
				$isFeatured = types_render_field("featured-product",array());  
				if($isFeatured == "no" || empty($isFeatured) || !$isFeatured){ continue;}
				if($count > 3){ continue;}
				?>
				
				<li class="clearfix">
					
					<?php 
					
					$viddlerdata = getViddlerData(get_the_ID());
					if(!empty($viddlerdata['thumbnail']) && !empty($viddlerdata['id'])){
						$image = $viddlerdata['thumbnail'];
						//$image = THEME_URL."/timthumb.php?src=".$image."&h=275&w=366&zc=0";
					}else{
						$image = types_render_field("preview-image",array("url"=>true));
						$image = THEME_URL."/timthumb.php?src=".$image."&h=275&w=366&zc=0";
					}
					?>
				<a href="<?php the_permalink();?>" class="video-img"><img src="<?php echo $image;?>" alt="<?php the_title();?>" /></a>
					
					
					<div class="details">
					<h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
					<?php $term_list = wp_get_post_terms(get_the_ID(), 'ptype', array("fields" => "names"));
					if(!empty($term_list)){
						echo "<p>".implode(", ",$term_list).'</p>';
					}
					?>
					<div class="bottom"><span><?php echo get_the_author();?></span> <span class="dates"><?php echo get_the_date('M.j Y', '', ''); ?></span></div>
					</div>
				</li>
				
				
			<?php $count++;endwhile; wp_reset_query();
		  ?>
    </ul>
    </div>
    
    	<div class="col-sm-6">
    <h2>Last Post</h2>
    <ul>
    	
		
		<?php 
			$args = array('post_type' => 'wpmarketplace','posts_per_page'=> 3);
			$loop = new WP_Query( $args );
			while ( $loop->have_posts() ) : $loop->the_post();?>
				
				<li class="clearfix">
					
					<?php 
					
					$viddlerdata = getViddlerData(get_the_ID());
					if(!empty($viddlerdata['thumbnail']) && !empty($viddlerdata['id'])){
						$image = $viddlerdata['thumbnail'];
						//$image = THEME_URL."/timthumb.php?src=".$image."&h=275&w=366&zc=0";
					}else{
						$image = types_render_field("preview-image",array("url"=>true));
						$image = THEME_URL."/timthumb.php?src=".$image."&h=275&w=366&zc=0";
					}
					
					?>
					
					
				<a href="<?php the_permalink();?>" class="video-img"><img src="<?php echo $image;?>" alt="<?php the_title();?>" /></a>
					
					<div class="details">
					<h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
					<?php $term_list = wp_get_post_terms(get_the_ID(), 'ptype', array("fields" => "names"));
					if(!empty($term_list)){
						echo "<p>".implode(", ",$term_list).'</p>';
					}
					?>
					<div class="bottom"><span><?php echo get_the_author();?></span> <span class="dates"><?php echo get_the_date('M.j Y', '', ''); ?></span></div>
					</div>
				</li>
				
				
			<?php endwhile; wp_reset_query();
		  ?>
		
    </ul>
    </div>
</div>
</div>


</div>




<div class="consultant-form clearfix">
<div class="container">
<div class="row">
	<div class="col-sm-6">
    <h2>Become a consultant</h2>
	<?php echo do_shortcode('[contact-form-7 id="56" title="Become a consultant"]');?>
    </div>
    	<div class="col-sm-6">
        <h2>Contact us to become a partner </h2>
        <?php echo do_shortcode('[contact-form-7 id="57" title="Contact us to become a partner"]');?>
        </div>
</div>
</div>
</div>

<?php get_footer();?>
