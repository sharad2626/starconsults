jQuery(document).ready(function() {

	jQuery("#register").validationEngine('attach', {
	    scroll: false,
	    onValidationComplete: function(form, status){           
	        if(status){
	        	jQuery.ajax({
	                url: 'ajax.php',
	                type: 'post',
	                dataType: 'json',
	                data: form.serialize()+"&action=register_user",
	                success: function(result) { 
	                    if(result["success"] == true){
	                       //generateNotification(result['message'],'success'); 
                           jQuery("#register").trigger('reset');
                           window.location.href = homeurl+"/thankyou.php";
	                    } else if(result["success"] == false){
	                        generateNotification(result['error'],'error'); 
	                    }
	                },
	                error: function(){
	                 	generateNotification(result['error'],'error');    
	                }
            	});		
			}
		}
	});

	jQuery(".refresh").click(function () {
    	jQuery(".imgcaptcha").attr("src","captcha.php?_="+((new Date()).getTime()));
	});
});