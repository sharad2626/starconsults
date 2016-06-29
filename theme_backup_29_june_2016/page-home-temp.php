<?php 
/*
	Template Name: Home Page Temp 
*/
?>

<?php

get_template_part('header-home');

?>
         <section class="content">
          <div class="department">     
                <div class="container">
                   <div class="row">
                      <div class="col-sm-12 col-md-12 col-lg-12">
                         <h1 class="heading">Categories</h1>
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-sm-12 col-md-12 col-lg-12">
                         <div class=" dept-category">
                            <ul>
                               <li>
                                 <!-- <div class="gall-item-image">
                                    <div class="product-content">  
                                     <img src="images/cardiology.jpg" alt="category1">
                                       <a href="#" class="wishlist"> <i class="fa fa-heart"></i> Add to wishlist</a>
                                    </div>    
                                  </div>-->
                                   <div class="category-img">
                                        <div class="category-content">
                                           <div class="category-detail-container">
                                              <a href="#" class="category-title" >cardiology</a> 
                                           </div>
                                        </div>
                                        <img alt="" src="<?php echo get_stylesheet_directory_uri(); ?>/new-home-design-files/images/cardiology.jpg">                                    
                                     </div>   
                                  <div class="gall-item-title">cardiology</div>
                               </li>
                               <li>
                                  <div class="category-img">
                                        <div class="category-content">
                                           <div class="category-detail-container">
                                              <a href="#" class="category-title" >pediatrics</a> 
                                           </div>
                                        </div>
                                         <img src="<?php echo get_stylesheet_directory_uri(); ?>/new-home-design-files/images/pediatrics.jpg" alt="category2">
                                     </div>     
                                
                                  <div class="gall-item-title">pediatrics</div>
                               </li>
                               <li>
                                   <div class="category-img">
                                        <div class="category-content">
                                           <div class="category-detail-container">
                                              <a href="#" class="category-title" >neurology</a> 
                                           </div>
                                        </div>
                                         <img src="<?php echo get_stylesheet_directory_uri(); ?>/new-home-design-files/images/neurology.jpg" alt="category3">
                                     </div>  
                                  
                                  <div class="gall-item-title">neurology</div>
                               </li>
                               <li>
                                   <div class="category-img">
                                        <div class="category-content">
                                           <div class="category-detail-container">
                                              <a href="#" class="category-title" >ophthalmology</a> 
                                           </div>
                                        </div>
                                         <img src="<?php echo get_stylesheet_directory_uri(); ?>/new-home-design-files/images/ophthalmology.jpg" alt="category4">
                                     </div> 
                                
                                  <div class="gall-item-title">ophthalmology</div>
                               </li>
                               <li>
                                    <div class="category-img">
                                        <div class="category-content">
                                           <div class="category-detail-container">
                                              <a href="#" class="category-title" >Education</a> 
                                           </div>
                                        </div>
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/new-home-design-files/images/Education.jpg" alt="category5">
                                     </div> 
                                 
                                  <div class="gall-item-title">Education</div>
                               </li>
                               <li>
                                   <div class="category-img">
                                        <div class="category-content">
                                           <div class="category-detail-container">
                                              <a href="#" class="category-title" >business</a> 
                                           </div>
                                        </div>
                                      <img src="<?php echo get_stylesheet_directory_uri(); ?>/new-home-design-files/images/Education.jpg" alt="category6">
                                     </div>
                                  
                                  <div class="gall-item-title">business</div>
                               </li>
                               <li>
                                    <div class="category-img">
                                        <div class="category-content">
                                           <div class="category-detail-container">
                                              <a href="#" class="category-title" >legal</a> 
                                           </div>
                                        </div>
                                       <img src="<?php echo get_stylesheet_directory_uri(); ?>/new-home-design-files/images/Education.jpg" alt="category7">
                                     </div>
                                  
                                  <div class="gall-item-title">legal</div>
                               </li>
                               <li>
                                   <div class="category-img">
                                        <div class="category-content">
                                           <div class="category-detail-container">
                                              <a href="#" class="category-title" >architecture</a> 
                                           </div>
                                        </div>
                                       <img src="<?php echo get_stylesheet_directory_uri(); ?>/new-home-design-files/images/Education.jpg" alt="category8">
                                     </div>
                                 
                                  <div class="gall-item-title">architecture</div>
                               </li>
                               <li>
                                   <div class="category-img">
                                        <div class="category-content">
                                           <div class="category-detail-container">
                                              <a href="#" class="category-title" >PSYCHAITRY</a> 
                                           </div>
                                        </div>
                                      <img src="<?php echo get_stylesheet_directory_uri(); ?>/new-home-design-files/images/Education.jpg" alt="category9">
                                     </div>
                                 
                                  <div class="gall-item-title">PSYCHAITRY</div>
                               </li>
                            </ul>
                         </div>
                      </div>
                   </div>

                    <div class="view-more">
                       <a href="#">View More</a>
                    </div> 
                </div>
            </div> 
           <!--department-->
            <div class="featured">
                <div class="container">
                <h2>
                    FEATURED CONSULTANTS    
                </h2>    
                 <div class="feature-slide">
                      <div class="owl-carousel owl-theme feature-slider">
					  <?php
					 $userargs = array('role'         => 'consultant', );
 $consultants = get_users( $userargs );
 if(!empty($consultants)){
 	foreach($consultants as $consultant){ 
	
		$userDetails = $consultant->data;
		$userImage = types_render_usermeta_field( "consultants-image", array("user_id" => $userDetails->ID,"url"=>true ));
		//$userImage = THEME_URL."/timthumb.php?src=".$userImage."&h=220&w=290&zc=1";
		
		$featured = types_render_usermeta_field( "featured-user", array("user_id" => $userDetails->ID));
		if($featured == "no" || empty($featured) || !$featured){ continue;}
	
	?>
					  
                          <div class="item">
                            <div class="featured-inner">
                            <a href="<?php echo get_bloginfo('siteurl').'/consultant/'.$userDetails->user_login;?>"><img src="<?php echo $userImage;?>" alt="feature-baner-img1" width="290" height="220"></a>
                            <div class="dr-name">
                                <p><a href="<?php echo get_bloginfo('siteurl').'/consultant/'.$userDetails->user_login;?>"><?php echo $userDetails->user_nicename;?></a></p>    
                            </div>  
                            </div>
                          </div>
					  	<?php }
                                }
                           ?>
                          
                       </div>
                 </div>
               </div>
            </div>
            <!--featured-->          
            <div class="consult-form">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <h3>Become a consultant or <br> 
apply to become a partner</h3>
                        <!-- <form>
                           <div class="form-group">
                              <input type="text" class="form-control" placeholder="Name"> 
                           </div>   
                            <div class="form-group">
                              <input type="text" class="form-control" placeholder="Email"> 
                           </div> 
                            <div class="form-group">
                              <input type="text" class="form-control" placeholder="Phone"> 
                           </div> 
                            <div class="marin-bottom-15 form-group">
                              <textarea type="text" class="form-control" placeholder="Explain why do you think you are expert"></textarea> 
                           </div> 
                             <div class="form-group">
                                <div class="check-panel"> 
                                <input type="checkbox" value="" class="form-control">
                                </div> 
                                <div class="aggreement"> 
                                 <span>I have read and agree to the terms/conditions and privacy policy.<br>
If I am granted a consultant status I also agree to the consultants 
agreement and abide by its rules</span>
                                </div>    
                            </div>
                            <button>Apply Now</button>
                            <button>Subscription for consultants</button>
                        </form> -->    
							
							<?php echo do_shortcode('[contact-form-7 id="1003" title="Become a consultant"]');?>

                        </div>
                    </div>
                </div> 
            </div> 
            <!--consult-form-->
         </section> 
         <!--Content-->
        <?php get_template_part('footer-home'); ?>
