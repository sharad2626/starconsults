function deleteComposer(id, action) 
{
	if (action == 'delete') {
		noty({
	        text: "Are you sure you want to delete this Band?",
	        layout: 'center',
	        theme: 'defaultTheme',
	        buttons: [
	            {
					addClass: 'btn btn-primary', text: 'Ok', onClick: function($noty) {
						$noty.close();
						jQuery.ajax({
							url: 'ajax.php',
							type: 'post',
							dataType: 'json',
				            data: "composerid="+id+"&action=delete_composer",
				            success: function(result) { 
				                if(result["success"] == true){
				                   //generateNotification(result['message'],'success'); 
				                   location.reload();
				                } else if(result["success"] == false){
				                    generateNotification(result['error'],'error');     

				                }
				            },
				            error: function(){
				             	generateNotification('Error! Please try again','error');         
				            }
				    	});		
	                }
	            },
	            {
	                addClass: 'btn btn-danger', text: 'Cancel', onClick: function($noty) {
						$noty.close();
						//noty({text: 'You clicked "Cancel" button', type: 'error'});
	                }
	            }
	        ]
	    });
    }
    return false;
}

jQuery(document).ready(function() {

	jQuery("#account_details").validationEngine('attach', {
	    scroll: false,
	    onValidationComplete: function(form, status){           
	        if(status){
	        	jQuery.ajax({
	                url: 'ajax.php',
	                type: 'post',
	                dataType: 'json',
	                data: form.serialize()+"&action=update_user",
	                success: function(result) { 
	                    if(result["success"] == true){
	                       generateNotification(result['message'],'success'); 
	                    } else if(result["success"] == false){
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

	jQuery("#old_password").change(function(){
		var pass = jQuery(this).val();
		//alert(pass);
		 	if(pass){
	        	jQuery.ajax({
	                url: 'ajax.php',
	                type: 'post',
	                dataType: 'json',
	                data: "pass="+pass+"&action=check_old_password",
	                success: function(result) { 
	                    if(result["success"] == true){
	                       jQuery("#change_password").validationEngine('attach', {
							    scroll: false,
							    onValidationComplete: function(form, status){           
							        if(status){
							        	jQuery.ajax({
							                url: 'ajax.php',
							                type: 'post',
							                dataType: 'json',
							                data: form.serialize()+"&action=change_password",
							                success: function(result) { 
							                    if(result["success"] == true){
							                       generateNotification(result['message'],'success'); 
							                    } else if(result["success"] == false){
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
	});

	jQuery("#payment_details").validationEngine('attach', {
	    scroll: false,
	    onValidationComplete: function(form, status){           
	        if(status){
	        	jQuery.ajax({
	                url: 'ajax.php',
	                type: 'post',
	                dataType: 'json',
	                data: form.serialize()+"&action=payment_details",
	                success: function(result) { 
	                    if(result["success"] == true){
	                       generateNotification(result['message'],'success');  
	                    } else if(result["success"] == false){
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
	
	jQuery("#composer_details").validationEngine('attach', {
	    scroll: false,
	    onValidationComplete: function(form, status){           
	        if(status){
	        	jQuery.ajax({
	                url: 'ajax.php',
	                type: 'post',
	                dataType: 'json',
	                data: form.serialize()+"&action=composer_details",
	                success: function(result) { 
	                    if(result["success"] == true){
	                       //generateNotification(result['message'],'success'); 
	                       location.reload();
	                    } else if(result["success"] == false){
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

