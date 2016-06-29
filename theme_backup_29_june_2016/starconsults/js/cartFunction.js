function  wpmp_pp_remove_cart_item(id){

	   if(!confirm('Are you sure?')) return false;
	   jQuery('#cart_item_'+id+' *').css('color','#ccc');
	   jQuery.post('http://demo5.baytechdata.com/starconsult/?wpmp_remove_cart_item='+id
	   ,function(res){ 
	   var obj = jQuery.parseJSON(res);
	   jQuery('#cart_item_'+id).fadeOut().remove(); 
	   jQuery('#wpmp_cart_total').html(obj.cart_total); 
	   jQuery('#wpmp_cart_discount').html(obj.cart_discount); 
	   jQuery('#wpmp_cart_subtotal').html(obj.cart_subtotal); 
	   
	   jQuery('#cart_item_header_'+id).fadeOut().remove(); 
	   jQuery('#wpmp_cart_header_total').html(obj.cart_total); 
	   jQuery('.cart_qty').html(obj.cart_qty); 
	   
	   });
	   

	   
	   return false;
}
