<?php 
/*
	Template Name: All Categories
*/
?>
<?php get_header();?>
<?php if (have_posts()) : while (have_posts()) : the_post(); 
	$bannerImage = types_render_field("banner-image",array('url'=>true));
	if(!empty($bannerImage)){ ?>

<div class="top_banner"> <img src="<?php echo $bannerImage;?>" alt="<?php the_title();?>" /> </div>
<?php }
endwhile; endif;?>
<div class="content-page clearfix">
  <div class="container">
    <div class="main-content full-width">
      <?php /*?><div class="bread"> <a href="#">Home</a> <span>></span> <a href="#">Mathematics</a> <span>></span> <span>step by step learning calculus</span> </div><?php */?>
      <div class="main-content-bg clearfix" style="  background: #F2EEE8;">
        <h1>
          <?php the_title();?>
        </h1>
        <div class="services-bg clearfix">
            <ul>
              <?php 
$categories = get_terms("ptype", 'hide_empty=0&orderby=date');
$i=1;
foreach($categories as $category){
	$catImg = get_tax_meta($category->term_id,'tf_tax_image');
	$imagesrc = $catImg['src']; ?>
              <li style="margin:15px 0;"> <a class="setServiceImageHeight" href="<?php echo get_term_link( $category );?>"><img src="<?php echo $imagesrc;?>" alt="<?php echo $category->name;?>"  width="144" height="147" /></a>
                <h4><a href="<?php echo get_term_link( $category );?>"><?php echo $category->name;?></a></h4>
              </li>
              <?php }
?>
            </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<?php get_footer();?>
