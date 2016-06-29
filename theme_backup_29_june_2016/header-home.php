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
                           <a href="index.html"><img src="<?php echo get_stylesheet_directory_uri(); ?>/new-home-design-files/images/logo.png" alt="logo"></a> 
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
                                       <li class="active"><a href="index.html">Home</a></li>
                                       <li ><a href="about-us.html">About Us</a></li>
                                       <li ><a href="services.html">Services</a></li>
                                       <li><a href="consultants.html">consultants</a></li>
                                       <li><a href="contact-us.html">Contact Us</a></li>
                                    </ul>
                                 </div>
                              </div>
                           </nav>
                        </div>
                        <div class="login-button">
                           <a href="#">Login</a>
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
                  <div class="item">
                     <div class="banner-container">
                        <div class="baner-caption">
                             
                           <h2>An International Platform <br>
                              to connect with top 
                           </h2>
                           <h3>consultants</h3>
                          
                        </div>
                     </div>
                     <img src="<?php echo get_stylesheet_directory_uri(); ?>/new-home-design-files/images/banner/banner1.jpg" alt="main-baner-img1">
                  </div>
                  <div class="item">
                       <div class="banner-container">
                        <div class="baner-caption">
                            
                           <h2>An International Platform <br>
                              to connect with top 
                           </h2>
                           <h3>consultants</h3>
                           
                        </div>
                     </div>
                     <img src="<?php echo get_stylesheet_directory_uri(); ?>/new-home-design-files/images/banner/banner2.jpg" alt="main-baner-img2">
                  </div>
                  <div class="item">
                       <div class="banner-container">
                        <div class="baner-caption">
                             
                           <h2>An International Platform <br>
                              to connect with top 
                           </h2>
                           <h3>consultants</h3>
                           
                        </div>
                     </div>
                     <img src="<?php echo get_stylesheet_directory_uri(); ?>/new-home-design-files/images/banner/banner3.jpg" alt="main-baner-img3">
                  </div>
                  <div class="item">
                       <div class="banner-container">
                        <div class="baner-caption">
                             
                           <h2>An International Platform <br>
                              to connect with top 
                           </h2>
                           <h3>consultants</h3>
                          
                        </div>
                     </div>
                     <img src="<?php echo get_stylesheet_directory_uri(); ?>/new-home-design-files/images/banner/banner4.jpg" alt="main-baner-img4">
                  </div>
               </div>
            </div>
            <!--main-slider-->
            <div class="search-panel">
               <div class="container">
                  <form>
                     <div class="search-block">
                        <ul>
                           <li class="dept">
                              <div class="select-label">
                                 <p> 'I'm looking for a cardiologist'  </p> 
                              </div>   
                              <span></span>
                              <select class="form-control">
                                 <option>Categories</option>
                                 <option> Departments1</option>
                              </select>
                           </li>
                           
                           <li class="location">
                               <div class="select-label">
                                 <p>'in New York'</p> 
                              </div>  
                              <span></span>
                              <select class="form-control">
                                 <option>Location</option>
                                 <option> loc1</option>
                              </select>
                           </li>
                           <li class="search-button">
                                 
                              <button> Search</button>
                           </li>
                        </ul>
                         <div class="member-button">
                          <div class="member-button-left">
                             <a href="#" class=" btn-1 btn-1b">Become a member</a>
                          </div>
                         <!-- <div class="member-button-right">
                             <a href="#"  class=" btn-1 btn-1b" >Subscription for consultants</a>
                          </div>-->
                       </div>  
                         
                     </div>
                  </form>
               </div>
            </div>
            <!--Search panel--> 
         </section>
         <!--slider-wrapper-->