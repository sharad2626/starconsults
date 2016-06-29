<?php 
session_start();
/*
	Template Name: Subscription success
*/
?>
<?php get_header();?>
<?php
//print_r($_SESSION);

require('connect.php');
$user_id = get_current_user_id();
 
//GET THE PAYMENT MODE AND APP ID FROM DATABASE

 $get_app_details = "select * from payment_modes where status='Active'";
 $run_get_app_details = mysql_query($get_app_details);
 $appdata = mysql_fetch_assoc($run_get_app_details);


$paypalAppId = $appdata['app_key'];
$paypalUser = $appdata['username'];
$paypalPassword = $appdata['password'];
$paypalSignature = $appdata['signature'];

 $mode = $appdata['mode'];


    $get_pay_key = "select * from subscriptions where subscription_id=".$_SESSION['lastInsertId'];
	//echo $get_pay_key_qry;
	$run_get_pay_key = mysql_query($get_pay_key);
	$paykeysub=mysql_fetch_assoc($run_get_pay_key);

   

/*$paypalAppId ='APP-80W284485P519543T';
$paypalUser = 'sharad.kolhe-facilitator_api1.gmail.com';
$paypalPassword = 'LGBWZ77ANP8HRZMK';
$paypalSignature = 'AiPC9BjkCyDFQXbSkoZcgqH3hpacAr.VjudkRZkFqLBT8s.fbQk04iZo';
 $mode ='SANDBOX';*/


//set POST URL //svcs
	if($mode == 'sand box')
	{
		$url = 'https://svcs.sandbox.paypal.com/AdaptivePayments/PaymentDetails';
	}
	else
	{
		$url = 'https://svcs.paypal.com/AdaptivePayments/PaymentDetails';
	}

	//set POST variables
	$fields = array(
				'payKey'							=> $paykeysub['pay_key'],
				'requestEnvelope.errorLanguage' 	=> 'en_US',
			    );
	
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

   //print_r($res);
	
	$res_arr = explode("&",$res);	
    //echo"<pre>";
	 //print_r($res_arr);


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

	$amt = explode("=",$res_arr[$amount]);
	
	//$amt = explode("=",$res_arr[8]);
	
	$ack = explode("=",$res_arr[20]);

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
	

}else{
  
   echo "ack string does not found in paypal response";
}

//echo $get_ack_success_arra[1];
 
  //end 
?>
   
	 
 <div class="content-page clearfix">
        <div class="container">
            <div class="main-content full-width">
            <div class="main-content-bg clearfix">
<?php

/* tracking Error */


if($user_id ==''){ echo "User Id is blank"; }

if($orderid ==''){ echo "ORDER Id is blank"; }

if($_SESSION['lastInsertId']==''){     
  echo "There seems some issue with Sessions. Vales from session are not avalaible"; exit;
  }

 
	//if($ack[1] == 'COMPLETED')
	if($get_ack_success_arra[1] == 'Success')
	{
		 	//$post_by	= get_userid_from_postid($id);
			$paykey 	= explode("=",$res_arr[20]);
			//insert record into orders table
			//$orderid = $trans[1];
			$paydate = date('Y-m-d H:i:s');
			$payment_status=$ack[1];

			$update_qry ="update subscriptions set User_Id = '".$user_id."' ,
			                           payment_status ='completed',
                                       order_id = '".$orderid."',
			                           paypal_response='".$res."',
									   subscription_date='".$paydate."',
									   amount='".$amt[1]."'
			where subscription_id=".$_SESSION['lastInsertId'];

			//echo $update_qry;

			$run_update_subscription_qry=mysql_query($update_qry);

			echo"<div style='height:100px;'>Subscription Successful</div>";

		
	}
	else
	{	


		//$post_by	= get_userid_from_postid($id);
			$paykey 	= explode("=",$res_arr[20]);
			//insert record into orders table
			//$orderid = $trans[1];
			$paydate = date('Y-m-d H:i:s');
			$payment_status = $get_ack_success_arra[1];

			$update_qry ="update subscriptions set User_Id = '".$user_id."' ,
			                           payment_status ='".$payment_status."',
                                       order_id = '".$orderid."',
			                           paypal_response='".$res."',
									   subscription_date='".$paydate."',
									   amount='".$amt[1]."'
			where subscription_id=".$_SESSION['lastInsertId'];

			//echo $update_qry;

			$run_update_subscription_qry=mysql_query($update_qry);




			echo"<div style='height:100px;'>Subscription Failed</div>";
			//header('location: http://ckdesignagency.com/shreev1/exchange6/paypal_parallel/cancel.php');
	}
	
	?>
	
 </div>
    </div>
  </div>
</div>
<?php get_footer();?>
	
 