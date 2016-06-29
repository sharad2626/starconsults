
//$( document ).ready(function() {
	
jQuery(document).ready(function($){
       $('.baner-slider').owlCarousel({
			loop:true,
			margin:20,
			responsiveClass:true,
            animateOut: 'fadeOut',
            autoplay:true,
            autoplayTimeout:5000,
            autoplayHoverPause:false,
           
            nav:true,
			responsive:{
				0:{
					items:1,
					nav:true
				},
				600:{
					items:1,
					nav:true
				},
				1000:{
					items:1,
					nav:true,
					loop:true
				}
			}
		});
     $('.feature-slider').owlCarousel({
			loop:true,
			margin:50,
			responsiveClass:true,
            animateOut: 'fadeOut',
            autoplay:true,
            autoplayTimeout:5000,
            autoplayHoverPause:false,
           
            nav:true,
			responsive:{
				0:{
					items:1,
					nav:true
				},
				600:{
					items:2,
					nav:true,
                    margin:20
				},
				1000:{
					items:3,
					nav:true,
					loop:true
				}
			}
		});
    
  /*   $(window).scroll(function(){
         var scrolltop=$(this).scrollTop();
         
         if(scrolltop >= 50){
             $('header').addClass('sticky');
         }
         else{
             $('header').removeClass('sticky');        }
     });*/
    
    
});
	