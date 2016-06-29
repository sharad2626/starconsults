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
    <div class="main-content full-width">
      <?php /*?><div class="bread"> <a href="#">Home</a> <span>></span> <a href="#">Mathematics</a> <span>></span> <span>step by step learning calculus</span> </div><?php */?>
      <div class="main-content-bg clearfix">
		<?php 
		$content = get_the_content();
		if(strstr($content,'[my-orders]')){
			if($_REQUEST['orderid'] && !empty($_REQUEST['orderid'])){
			?>
				<h1 style="  padding-bottom: 0px;">Order #<span style="font-family:Arial, Helvetica, sans-serif"><?php echo $_REQUEST['orderid'];?></span></h1>
			<?php }else{?>
				<h1><?php the_title();?></h1>
			<?php }
		}else{?>
		<h1><?php the_title();?></h1>
		<?php }?>
        <?php the_content(); ?>
      </div>
    </div>
  </div>
</div>
<?php endwhile; endif;?>
<?php get_footer();?>
