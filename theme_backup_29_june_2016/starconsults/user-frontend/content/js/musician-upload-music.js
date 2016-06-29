function deleteTrack(id, action) 
{
	if (action == 'delete') {
		noty({
	        text: "Are you sure you want to delete this Track?",
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
				            data: "trackid="+id+"&action=delete_track",
				            success: function(result) { 
				                if(result["success"] == true){
				                   //generateNotification(result['message'],'success'); 
				                   location.reload();
				                } else if(result["success"] == false){
				                    //generateNotification(result['error'],'error');     

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

function deleteAlbum(id, action) 
{
	if (action == 'delete') {
		noty({
	        text: "Are you sure you want to delete this Album?",
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
				            data: "albumid="+id+"&action=delete_album",
				            success: function(result) { 
				                if(result["success"] == true){
				                   //generateNotification(result['message'],'success'); 
				                   location.reload();
				                } else if(result["success"] == false){
				                    //generateNotification(result['error'],'error');     

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
	jQuery("input[name=trackimage]").change(function() {
		var trackimage =  jQuery(this).filter(':checked').val();
		//alert(trackimage);
		if(trackimage == 'yes'){
			jQuery("#coveruploadFile").addClass('validate[required]');
			jQuery("#coveruploadFile,#coveruploadBtn").removeAttr('disabled');
		}
		else{
			jQuery("#coveruploadFile,#coveruploadBtn").addAttr('disabled');
			jQuery("#coveruploadFile").removeClass('validate[required]');
		}
	});

	jQuery("#uploadBtn").change(function () {
		jQuery("#uploadFile").val(this.value);
	});
	jQuery("#coveruploadBtn").change(function () {
		jQuery("#coveruploadFile").val(this.value);
	});
	jQuery("#mp3uploadBtn").change(function () {
		jQuery("#mp3uploadFile").val(this.value);
	});

	jQuery(".play").click(function () {
		jQuery(this).parent().parent().siblings(".mp3playaudio").show();
		jQuery('.mp3playaudioouter').css('display','block');
	});
	
	jQuery(".exitmp3playaudio").click(function () {
		jQuery(".mp3playaudio").hide();
		
	  	//pause playing
		jQuery('.mp3playaudio audio').trigger('pause');
	  	//set play time to 0
	  	jQuery(".mp3playaudio audio").prop("currentTime",0);

		jQuery('.mp3playaudioouter').css('display','none');
	});
});

