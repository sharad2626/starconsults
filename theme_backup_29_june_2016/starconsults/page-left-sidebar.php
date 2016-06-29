<?php 
/*
	Template Name: Left Sidebar
*/
?>
<?php get_header();?>
<?php if (have_posts()) : while (have_posts()) : the_post(); 
	$bannerImage = types_render_field("banner-image",array('url'=>true));
	if(!empty($bannerImage)){ ?>

<div class="top_banner"> <img src="<?php echo $bannerImage;?>" alt="<?php the_title();?>" /> </div>
<?php }
endwhile; endif;?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="content-page clearfix">
  <div class="container">
    <div class="main-content full-width">
      <?php /*?><div class="bread"> <a href="#">Home</a> <span>></span> <a href="#">Mathematics</a> <span>></span> <span>step by step learning calculus</span> </div><?php */?>
      <div class="col-sm-3 left_sidebar">
	  	<?php if ( is_active_sidebar( 'left_sidebar' ) ) : ?>
			<?php dynamic_sidebar( 'left_sidebar' ); ?>
		<?php endif; ?>
	  </div>
      <div class="col-sm-9">
        <div class="main-content-bg clearfix bluebg">
          <h1 style="color:#fff">
            <?php the_title();?>
          </h1>
          <?php the_content(); ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endwhile; endif;?>
<?php get_footer();?>
