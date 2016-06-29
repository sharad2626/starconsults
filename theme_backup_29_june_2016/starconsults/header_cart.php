<?php $cartData = wpmp_get_cart_data();
$settings = get_option('_wpmp_settings');

$cartQy = 0;
if(!empty($cartData)){ ?>
<div class="header_cart_item_list">
  <ul>
    <?php foreach($cartData as $product){ ?>
    <li id="cart_item_header_<?php echo $product['ID'];?>">
	<div class="col-xs-11">
	<a href="<?php echo get_the_permalink($product['ID']);?>"><?php echo $product['post_title'];?></a>
	</div>
	<div class="col-xs-1" style="padding:0">
		<a class="wpmp_cart_delete_item" href="#" onclick="return wpmp_pp_remove_cart_item(<?php echo $product['ID'];?>)"><i class="icon icon-trash glyphicon glyphicon-trash"></i></a>
	</div>
	
	</li>
    <?php 
		$productQty = $product['quantity'];
		$cartQy  = $cartQy + $productQty;
	}?>
  </ul>
  <div class="cart_button_link">
  		<a class="pull-left" style="width:auto" href="<?php echo get_permalink($settings['page_id']);?>">View Cart</a>
		<div class="pull-right">(<span class="cart_qty"><?php echo $cartQy;?></span> Items)&nbsp;<?php echo get_option('_wpmp_curr_sign','$').'<span id="wpmp_cart_header_total">'.wpmp_get_cart_total().'</span>';?></div>
  </div>
  
  <div class="checkout_button_link">
  		<a class="pull-right" style="width:auto" href="<?php echo get_permalink($settings['check_page_id']);?>">Checkout</a>
  </div>
  
  
</div>
<?php 
}else{
 echo "No item in cart.";
}
?>
