<?php 
/*
	Template Name: success subscription-consultant payment */
?>
<?php get_header();?>
<?php
require('connect.php');
$uid = get_current_user_id();

 //GET THE PAYMENT MODE AND APP ID FROM DATABASE

 $get_app_details = "select * from payment_modes where status='Active'";
 $run_get_app_details = mysql_query($get_app_details);
 $appdata = mysql_fetch_assoc($run_get_app_details);


$paypalAppId = $appdata['app_key'];
$paypalUser = $appdata['username'];
$paypalPassword = $appdata['password'];
$paypalSignature = $appdata['signature'];



/*$paypalAppId ='APP-80W284485P519543T';
$paypalUser = 'sharad.kolhe-facilitator_api1.gmail.com';
$paypalPassword = 'LGBWZ77ANP8HRZMK';
$paypalSignature = 'AiPC9BjkCyDFQXbSkoZcgqH3hpacAr.VjudkRZkFqLBT8s.fbQk04iZo';*/
 //$mode ='SANDBOX';
 $mode = $appdata['mode'];
//set POST URL //svcs
	if($mode == 'sand box')
	{
		$url = 'https://svcs.sandbox.paypal.com/AdaptivePayments/PaymentDetails';
	}
	else
	{
		$url = 'https://svcs.paypal.com/AdaptivePayments/PaymentDetails';
	}

    $get_pay_key_qry = "select * from payment_to_consultant where payment_id=".$_SESSION['last_insert_id'];
	//echo $get_pay_key_qry;
	$run_get_pay_key_qry = mysql_query($get_pay_key_qry);
	$pay_k=mysql_fetch_assoc($run_get_pay_key_qry);
	
	//set POST variables
	$fields = array(
				'payKey'							=> $pay_k['pay_key'],
				'requestEnvelope.errorLanguage' 	=> 'en_US',
			    );

				//print_r($fields);
	
	$fields_string = '';
	//url-ify the data for the POST
	foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
	rtrim($fields_string, '&');
	
	$headers = array('X-PAYPAL-SECURITY-USERID: '.$paypalUser.'',
					 'X-PAYPAL-SECURITY-PASSWORD: '.$paypalPassword.'',
					 'X-PAYPAL-SECURITY-SIGNATURE: '.$paypalSignature.'', 
					 'X-PAYPAL-REQUEST-DATA-FORMAT: NV',
					 'X-PAYPAL-RESPONSE-DATA-FORMAT: NV',
					 'X-PAYPAL-APPLICATION-ID: '.$paypalAppId.'');

  //open connection
	$ch = curl_init();
	
	//set the url, number of POST vars, POST data
	curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch,CURLOPT_POST, count($fields));
	curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	//curl_setopt($ch, CURLOPT_SSLVERSION,2.1);
	
	//execute post
	$res = curl_exec($ch);
	
	curl_close($ch);
	
	 // print_r($res);
	  
 
	
	$res_arr = explode("&",$res);	




	/* capturing amount code start */

	$amount =0;
	for($a=0;$a<count($res_arr);$a++){

	$mystring = $res_arr[$a];
	$findme   = 'amount';
	$pos = strpos($mystring, $findme);

	// Note our use of ===.  Simply == would not work as expected
	// because the position of 'a' was the 0th (first) character.

	if($pos === false){  } else { $amount = $a;  }

	}

	/* capturing amount code end  */

	//$amt = explode("=",$res_arr[8]);

	$amt = explode("=",$res_arr[$amount]);



	/* capturing receiver ( seller) paypal tranction If code start */

	$receiver_trans =0;
	for($a=0;$a<count($res_arr);$a++){

	$mystring = $res_arr[$a];
	$findme   = 'transactionId';
	$pos = strpos($mystring, $findme);

	// Note our use of ===.  Simply == would not work as expected
	// because the position of 'a' was the 0th (first) character.

	if($pos === false){  } else { $receiver_trans = $a;  }
	}

	/* capturing receiver ( seller ) paypal tranction If code start */

	/* capturing sender  paypal tranction If code start */


	$sender_trans =0;
	for($b=0;$b<count($res_arr);$b++){

	$mystring = $res_arr[$b];
	$findme   = 'senderTransactionId';
	$pos      = strpos($mystring, $findme);

	// Note our use of ===.  Simply == would not work as expected
	// because the position of 'a' was the 0th (first) character.

	if($pos === false){  } else { $sender_trans = $b;  }


	}

	/* capturing sender  paypal tranction If code end */


	
   	$trans1 = explode("=",$res_arr[$receiver_trans]);
	
   	$trans2 = explode("=",$res_arr[$sender_trans]);

	$orderid = $trans2[1]."=".$trans1[1];

	

   	//$trans = explode("=",$res_arr[6]);

     //to get ack dynamically 
    $status_index=0;
     for($k=0;$k<count($res_arr);$k++){
        	 $mystring = $res_arr[$k];
	         $findme   = 'ack';
	         $pos = strpos($mystring, $findme);
	if ($pos === false) {  } else { $status_index = $k;  	}
}

if($status_index!=0){
	
	//echo $res_arr[$status_index];
 
    $ack_success_str = $res_arr[$status_index];
	$get_ack_success_arra = explode("=",$ack_success_str);
	echo $get_ack_success_arra[1] ;
 

}else{
  
   echo "ack string does not found in paypal response";
}

   ?>
  <div class="content-page clearfix">
        <div class="container">
            <div class="main-content full-width">
            <div class="main-content-bg clearfix">
 

<?php

if($_SESSION['last_insert_id']==''){
   echo "There seems some issue with Sessions. Vales from session are not avalaible"; exit;
}




if($get_ack_success_arra[1] == 'Success')
	{
		//echo  $get_ack_success_arra[1] ;
    
		echo"<div style='height:100px;'>Payment Successful you will redirect to the order listing</div>";
			//$post_by	= get_userid_from_postid($id);
		 	$paykey 	= explode("=",$res_arr[20]);
			//insert record into orders table
			//$orderid = $trans[1];
			$odate = date('Y-m-d H:i:s');
			$payment_status=$ack[1];
			$price = $amt[1];
			
			
         $update_payment_table = "update payment_to_consultant  set  order_id ='".$orderid."',
			                                                 buyer_id ='".$uid."',
															 price ='".$price."',
															 Payment_date_time ='".$odate."',
															 Paypal_reply_response ='".$res."',
															 payment_status='completed' 								 
															 where  payment_id =".$_SESSION['last_insert_id'];				
															 
		// echo $update_payment_table;
		
	    $run_update_payment_table =mysql_query($update_payment_table);

		//update the old order generated to completed 

        $update_order_table = "update wp_mp_orders set order_status='Completed',payment_status='Completed' where order_id='".$_SESSION['old_generated']."'";

		$run_update_order_table = mysql_query($update_order_table);

		$redirect_url = 'http://www.starconsults.com/my-purchase/';
        ?>
		 <script type="text/javascript">
		 var got = "<?php echo $redirect_url; ?>";
		 setTimeout(function(){location.href= got} , 5000);   
		</script>
		<?php
		//header("location:http://www.starconsults.com/my-orders/");
		
	}
	else
	{
			echo"<div style='height:100px;'>Payment Failed</div>";
			//header('location: http://ckdesignagency.com/shreev1/exchange6/paypal_parallel/cancel.php');
	}
		
?>
 </div>
    </div>
  </div>
</div>
<?php get_footer();?>