<?php 
/*
	Template Name: Contact Us
*/
?>
<?php get_header();?>

<div id="google_map">
<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3170.8224132419673!2d-121.9206087!3d37.370378699999996!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808fcbeb0c6a69fb%3A0xc3fce81b9206c868!2s1798+Technology+Dr%2C+San+Jose%2C+CA+95110%2C+USA!5e0!3m2!1sen!2sin!4v1425558788162" width="600" height="450" frameborder="0" style="border:0; width:100%; height:auto; min-height:300px;"></iframe>
</div>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="content-page clearfix">
  <div class="container">
    <div class="main-content">
      <?php /*?><div class="bread"> <a href="#">Home</a> <span>></span> <a href="#">Mathematics</a> <span>></span> <span>step by step learning calculus</span> </div><?php */?>
      <div class="main-content-bg clearfix">
		<h1><?php the_title();?></h1>
        <div class="consultant-form consultant-contact-form">
		<?php the_content();?>
		</div>
      </div>
    </div>
    <div class="left-side">
      <div class="leftbg">
        <div class="left-learning contact_us">
          <div class="single_contact_detail">
		  	<h3>OUR ADDRESS</h3>
			<div>1798 Technology Dr, San Jose, CA 95110</div>
		  </div>
		  
		  <div class="single_contact_detail">
		  	<h3>PHONE</h3>
			<div>123.456.7890</div>
		  </div>
		  
		  <div class="single_contact_detail">
		  	<h3>EMAIL</h3>
			<div><a href="mailto:Administrator@starconsult.com">Administrator@starconsult.com</a></div>
		  </div>
          
        </div>
      </div>
    </div>
  </div>
</div>
<?php endwhile; endif;?>
<?php get_footer();?>
