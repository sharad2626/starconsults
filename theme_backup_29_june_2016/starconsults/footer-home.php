 <footer> 
             <div class="footer-top">
               <div class="container">
               <div class="row">
                  <div class="footer-link col-sm-3 col-md-4 col-lg-3 col-xs-3 ">
                       <div class="footer-list  ">
                        <h2>Links</h2>
                        <ul>
                           <li><a href="<?php echo site_url(); ?>/home/" >Home</a></li>
                           <li><a href="<?php echo site_url(); ?>/about-us/" >About us</a></li>                         
                           <li><a href="#">Services</a></li>
                           <li><a href="<?php echo site_url(); ?>/all-consultants/">Doctors</a></li>
                           <li><a href="<?php echo site_url(); ?>/contact-us/">Contact us</a></li>
                          
                        </ul>
                     </div>
                  </div>
                  <div class=" footer-link col-sm-5 col-md-5 col-lg-5 col-xs-5  ">
                     <div class="contact-us">
                        <h2>Contact Us</h2>
                        <ul>
                           <li><span class="map1 bg-contact"></span> <span>1798 Technology Dr, San Jose, CA 95110.</span></li>
                            <li><span class="call1 bg-contact"></span><span >123.456.7890</span></li>
                            <li><span class="mail1 bg-contact"></span>
                              <a href="mailto:Administrator@starconsult.com" class="mailto">Administrator@starconsult.com</a>
                           </li>
                        </ul>
                     </div>
                  </div>                
                  <div class="footer-link col-sm-4 col-md-3 col-lg-4 col-xs-4 ">
                     <div class="footer-cust-link    ">
                        <h2>Links</h2>
                        <ul>
                           <li><a href="<?php echo site_url(); ?>/privacy-policy/" >Privacy Policy</a></li>
                           <li><a href="<?php echo site_url(); ?>/terms-and-conditions/" >Terms and Conditions</a></li>
                           <li><a href="<?php echo site_url(); ?>/partnership-agreement/">Consultants Agreement</a></li>                           
                          
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
          <div class="footer-bottom">
                <div class="container">
                   <div class="row">
                      <div class="col-lg-6 col-sm-6">
                        <div class="copy-rights">  
                         <p>Copyright &copy; Starconsults, Inc . 2016</p>
                        </div>    
                      </div>

                        <?php
						echo include 'connect.php';
						$get_social_details_qry = "select * from tbl_social_media";
						$run_get_social_details_qry = mysql_query($get_social_details_qry);
						while($row = mysql_fetch_assoc($run_get_social_details_qry))
						{
							$data[]=$row;
						}
						?>

                        <div class="col-lg-6 col-sm-6">                       
                            <div class="social-icon">
                                 <ul>
                                   <li class="icon foot-twitter"><a href="<?php echo $data[1]['Link']; ?>">twitter</a></li> 
                                   <li  class="icon foot-fb"><a href="<?php echo $data[0]['Link']; ?>" >FB </a></li> 
                                   <li class="icon foot-in"><a href="<?php echo $data[2]['Link']; ?>"  >Linkedin</a></li> 
                                   <li class="icon foot-yt"><a href="<?php echo $data[3]['Link']; ?>">Youtube</a></li>
                                </ul>
                            </div>
                      </div>
                   </div>
                </div>
         </div>   
         </footer>
         <!--Footer-->
      </div>
      <!-- Script-->
      
       </body>
</html>
