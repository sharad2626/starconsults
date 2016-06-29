<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>Starconsults</title>
	  <?php wp_head(); ?>
      <!-- Bootstrap Core CSS -->    
      <link href="<?php echo get_stylesheet_directory_uri(); ?>/new-home-design-files/css/owl.carousel.css" rel="stylesheet">
      <link href="<?php echo get_stylesheet_directory_uri(); ?>/new-home-design-files/css/owl.theme.default.css" rel="stylesheet">
      <link href="<?php echo get_stylesheet_directory_uri(); ?>/new-home-design-files/css/bootstrap.css" rel="stylesheet">
      <link href="<?php echo get_stylesheet_directory_uri(); ?>/new-home-design-files/css/font-awesome.min.css" rel="stylesheet">
      <link href="<?php echo get_stylesheet_directory_uri(); ?>/new-home-design-files/css/style.css" rel="stylesheet">
	  <!-- <script src="<?php echo get_stylesheet_directory_uri(); ?>/new-home-design-files/js/jquery-1.11.0.min.js"></script> -->
      <script src="<?php echo get_stylesheet_directory_uri(); ?>/new-home-design-files/js/custom.js"></script>
	  <script src="<?php echo get_stylesheet_directory_uri(); ?>/new-home-design-files/js/owl.carousel.js"></script>
      <script src="<?php echo get_stylesheet_directory_uri(); ?>/new-home-design-files/js/bootstrap.min.js"></script>
   </head>
   <body>
      <div class="wrapper">
         <header>
            <div class="container">
               <div class="header-content">
                  <div class="row">
                     <div class="padding-r col-sm-4 col-md-3 col-lg-3">
                        <div class="logo">
                            <a href="<?php echo site_url(); ?>/home/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/new-home-design-files/images/logo.png" alt="logo"></a> 
                        </div>
                     </div>
                     <div class="padding-left-right col-sm-8 col-md-9 col-lg-9">
                        <div class="main-menu">
                           <nav class="navbar navbar-inverse">
                              <div class="padding-l container-fluid menu_bar">
                                 <div class="navbar-header">
                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>                        
                                    </button>
                                 </div>
                                 <div class="collapse navbar-collapse navigation_custom" id="myNavbar">
                                    <ul class="nav navbar-nav">
                                       <li class="active"><a href="<?php echo site_url(); ?>/home/">Home</a></li>
                                       <li ><a href="<?php echo site_url(); ?>/about-us/">About Us</a></li>
                                       <li ><a href="#">Services</a></li>
                                       <li><a href="<?php echo site_url(); ?>/all-consultants/">consultants</a></li>
                                       <li><a href="<?php echo site_url(); ?>/contact-us/">Contact Us</a></li>
                                    </ul>
                                 </div>
                              </div>
                           </nav>
                        </div>
                        <div class="login-button">
                           <a href="<?php echo site_url(); ?>/login/">Login</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </header>
         <!--header-->
         <section class="slider-wrapper">
            <div class="main-slider">
               <div class="owl-carousel owl-theme baner-slider">
			   <?php
			     $args = array( 'post_type' => 'home_slider', 'posts_per_page' => 4,'order' => 'ASC', );
                 $loop = new WP_Query( $args );
                 while ( $loop->have_posts() ) : $loop->the_post();
				 $myimage = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
			    ?>
                  <div class="item">
                     <div class="banner-container">
                        <div class="baner-caption">
                             
                           <h2>An International Platform <br>
                              to connect with top 
                           </h2>
                           <h3>consultants</h3>
                          
                        </div>
                     </div>
                     <img src="<?php echo $myimage[0]; ?>" alt="main-baner-img1">
                  </div>
                   <?php
				  endwhile;
				  ?>
               </div>
            </div>
            <!--main-slider-->
            <div class="search-panel">
               <div class="container">
                 <!-- <form>-->
                     <div class="search-block">
                        <ul>
                           <li class="dept">
                              <div class="select-label">
                                 <p> 'I'm looking for a cardiologist'  </p> 
                              </div>   
                              <span></span>
                              <select class="form-control" name="Categories" id="Categories">
							  <option value="0">Categories</option>
                              <?php
                               $taxonomy = 'ptype';
                               $tax_terms = get_terms($taxonomy);
							   foreach ($tax_terms as $tax_term) {
                               ?>
                               	  <option value="<?php echo $tax_term->name; ?>"><?php echo $tax_term->name; ?></option> 
								 <?php
							      }
								 ?>
                              </select>
                           </li>
                           
                           <li class="location">
                               <div class="select-label">
                                 <p>'in New York'</p> 
                              </div>  
                              <span></span>
                              <select class="form-control" name="Location" id="Location">
							   <option value="0">Location</option>
							  <?php
								global $wpdb;
								$location_result = $wpdb->get_results("SELECT * from wp_usermeta WHERE  meta_key ='Location' group by meta_key"); 
								foreach ( $location_result as $location )
								{
								 ?>
                               <option value="<?php echo $location->meta_value; ?>"><?php echo $location->meta_value; ?></option> 
                             <?php
                                 } 
                                 ?>
                                  </select>
                           </li>
                           <li class="search-button">
                                 
                              <button id="submit"> Search</button>
                           </li>
                        </ul>
                         <div class="member-button">
                          <div class="member-button-left">
                             <a href="<?php echo site_url(); ?>/register/" class=" btn-1 btn-1b">Become a member</a>
                          </div>
                         <!-- <div class="member-button-right">
                             <a href="#"  class=" btn-1 btn-1b" >Subscription for consultants</a>
                          </div>-->
                       </div>  
                         
                     </div>
                  <!--</form>-->
               </div>
            </div>
            <!--Search panel--> 
         </section>
         <!--slider-wrapper-->     
		 
		 <script type="text/javascript">
jQuery("#submit").click(function(){
     var loc = jQuery("#Location").val();
    var specialist = jQuery("#Categories").val();
    var data = { action:'siteConsultantSearch', loc:loc, specialist:specialist };
    jQuery.post('<?php echo admin_url("admin-ajax.php"); ?>', data, function(response) {
        //alert(response);
     jQuery(".dept-category").html(response);
    });
});
</script>
         