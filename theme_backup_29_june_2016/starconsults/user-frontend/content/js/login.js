jQuery(document).ready(function() {
	    
	jQuery("#login").validationEngine('attach', {
	    scroll: false,
	    onValidationComplete: function(form, status){           
	        if(status){
	        	jQuery.ajax({
	                url: 'ajax.php',
	                type: 'post',
	                dataType: 'json',
	                data: form.serialize()+"&action=login_user",
	                success: function(result) { 
	                    if(result["success"] == true){
	                       //generateNotification(result['message'],'success');
	                       if(result["user_role"] =='musician'){
								var dashboard = 'musician-dashboard.php';
	                       }
	                       else if(result["user_role"] =='audience'){
	                       		var dashboard = 'audience-dashboard.php';
	                       }
	                       
	                       window.location.href = homeurl+"/"+dashboard;
	                       //window.location.href = homeurl+"/musician-dashboard.php";
                           jQuery("#login").trigger('reset');
	                    } 
	                    else if(result["success"] == false){
	                        generateNotification(result['error'],'error');
	                    }
	                },
	                error: function(){
	                 	generateNotification('Error! Please try again','error');   
	                }
            	});		
			}
		}
	});
});