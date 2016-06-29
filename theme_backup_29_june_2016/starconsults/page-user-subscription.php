<?php 
session_set_cookie_params(0);
session_start();
ob_start();	
/*
	Template Name: User Subscription
*/
?>
<?php get_header();?>
<?php global $current_user;
  get_currentuserinfo();
  $user_ID = get_current_user_id(); 
  require('connect.php');

 if(isset($_POST['submit']))
{
// $item_amount = $_POST['subscrip']; 
$currency_code = "USD";
$payer_email= $current_user->user_email;


//$url = 'https://svcs.sandbox.paypal.com/AdaptivePayments/Pay';


//FETCH AMOUNT FROM THE PALN ID

$get_amount_from_plan = "select Plan_amount from subscription_plans where plan_id='".$_POST['subscrip']."'";
$run_get_amount_from_plan=mysql_query($get_amount_from_plan);
$plan_amt=mysql_fetch_assoc($run_get_amount_from_plan);

$item_amount= $plan_amt['Plan_amount'];
$sub_plan_id=$_POST['subscrip'];


//GET THE PAYMENT MODE AND APP ID FROM DATABASE

 $get_app_details = "select * from payment_modes where status='Active'";
 $run_get_app_details = mysql_query($get_app_details);
 $appdata = mysql_fetch_assoc($run_get_app_details);


$paypalAppId = $appdata['app_key'];
$paypalUser = $appdata['username'];
$paypalPassword = $appdata['password'];
$paypalSignature = $appdata['signature'];

 $mode = $appdata['mode'];

	if($mode == 'sand box')
	{
		 $url = 'https://svcs.sandbox.paypal.com/AdaptivePayments/Pay';
		 $receiver = 'sharad.kolhe-facilitator@gmail.com';


	}
	else
	{
		 $url = 'https://svcs.paypal.com/AdaptivePayments/Pay';
		 $receiver = "kumardoc1234@yahoo.com";
	}



/*
$paypalAppId ='APP-80W284485P519543T';
$paypalUser = 'sharad.kolhe-facilitator_api1.gmail.com';
$paypalPassword = 'LGBWZ77ANP8HRZMK';
$paypalSignature = 'AiPC9BjkCyDFQXbSkoZcgqH3hpacAr.VjudkRZkFqLBT8s.fbQk04iZo';
*/

 
//set POST variables
	$fields = array(
				'actionType'		=> 'PAY',
				'clientDetails.applicationId' 		=> $paypalAppId,
				'clientDetails.ipAddress' 	  		=> $_SERVER['REMOTE_ADDR'],				
				'currencyCode'				  		=> 'USD',
		        'item_name'                            =>'Subscription Plan',
				'receiverList.receiver(0).amount' 	=> $item_amount,
				'receiverList.receiver(0).email'  	=> $receiver,				
				'requestEnvelope.errorLanguage'	  	=> 'en_US',
				'cancelUrl'  	=> 'http://www.starconsults.com/cancel.php',
				'returnUrl' =>'http://www.starconsults.com/success/',
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

	//print_r($fields);
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
	
	  $info = curl_errno($ch);
	
	//echo "<pre>";
	//print_r($info);
	
    $err = curl_error($ch);
	
	//close connection
	curl_close($ch);
  

	
	$res_arr = explode("&",$res);	

   
    /* capturing paykey from response  */
	
	$payKey_index=0;
	for($k=0;$k<count($res_arr);$k++){

		$mystring = $res_arr[$k];
		$findme   = 'payKey';
		$pos = strpos($mystring, $findme);

		if ($pos === false) {  } else { $payKey_index = $k;  	}
	}
	
    //$resp_arr_pay_key  = explode("=",$res_arr[4]); 

	$resp_arr_pay_key  = explode("=",$res_arr[$payKey_index]);

	/* capturing paykey from response  */


    
	/* capturing success */

	$status=0;
	for($k=0;$k<count($res_arr);$k++){

	$mystring = $res_arr[$k];
	$findme   = 'ack';
	$pos = strpos($mystring, $findme);

	// Note our use of ===.  Simply == would not work as expected
	// because the position of 'a' was the 0th (first) character.

	if ($pos === false) {  } else { $status = $k;  	}


	}


	$resp_arr2  = explode("=",$res_arr[$status]);


    //$resp_arr2  = explode("=",$res_arr[1]);

	//$_SESSION['pay_key'] = $resp_arr_pay_key[1];
	
	
  // $mode ='SANDBOX';

  //  $mode = $appdata['mode'];

	$insert_qry="insert into subscriptions(subscription_plan_id,pay_key,paypal_request_response)values('$sub_plan_id','$resp_arr_pay_key[1]','$res')";
	$run_qry=mysql_query($insert_qry);
	$lastid=mysql_insert_id();
	$_SESSION['lastInsertId'] =  $lastid;
 
	echo "===".$_SESSION['lastInsertId'];
 
	
	if($resp_arr2[1] == 'Success'){
      
		if($mode == 'sand box')
		{
			 
			$redirect_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_ap-payment&paykey='.$resp_arr_pay_key[1];
			
		}
		else
		{
			$redirect_url = 'https://www.paypal.com/cgi-bin/webscr?cmd=_ap-payment&paykey='.$resp_arr_pay_key[1];
		}
		
		header('location: '.$redirect_url); 
		
	}
	else
	{

	}
}
 

?>
<?php   if($user_ID) { 
	$plans=$wpdb->get_results ( "SELECT * FROM subscription_plans where Plan_status='active'" ); 
	
?>
<div style="padding:20px" class="responsive-table resp-table">
	
	<table border="1" cellpadding="2"  cellspacing="4" width="50%" align="center" class="table">
		<tr>
		    <td colspan="4"><b> Subscription plan details:</b></td>
		</tr>
		<tr>
			<td align="center"><b>Plan Name</b></td>
			<td align="center"><b>Plan Description</b></td>
			<td align="center"><b>Plan Amount</b></td>
			<td align="center"><b>Plan Duration</b></td>
		</tr>
	   <?php for($k=0;$k<count($plans);$k++){?>
		
		<tr>
			<td align="center"><?php  echo $plans[$k]->plan_name; ?></td>
			<td align="center"><?php  echo $plans[$k]->plan_description; ?></td>
			<td align="center">$<?php  echo $plans[$k]->Plan_amount; ?></td>
			<td align="center"><?php echo $plans[$k]->Plan_duration; ?>months</td>
		</tr>

		<?php } ?>
		
	</table>



</div>
<div style="padding:20px;height:200px;" class="responsive-table resp-table">
<form name="frmsubcription" id="frmsubcription" method="POST" action="">
<table border="1" cellpadding="2"  cellspacing="4" width="50%" align="center" class="table">
<tr>
    <td colspan="2"><b>Please choose plan from drop-down as submit form to subscribe plan.</b></td>
</tr>
<tr>
<td align="center">Username: </td>
<td><?php echo $current_user->user_login; ?></td>
</tr>
<tr>
<td align="center">Select Subscription Plan:</td>
<td>
<select name="subscrip" id="subscrip">
<?php foreach ($plans as $key ) {?>
      <option value="<?php echo $key->plan_id;?>"><?php echo $key->plan_name;?></option>
<?php }?>
</select>
</td>
</tr>
<tr>
<td colspan="2" align="center"><input type="submit" name="submit" value="submit"></td>
</tr>
</table>
 </form> 
</div>
<?php }
else { 
?>
<div style="padding:20px 0 0 20px;color: #008000; font-size: 20px;">1. Please log in as a member then click on the subscription button for consultants.
</div>
<div style="padding:20px 0 0 20px;height:200px;color: #008000; font-size: 15px;">2. If you are not a consultant, you are free to use the site without a subscription.

</div>
<?php
 
} ?>

<style>
table{border:1px;}
@media(max-width:770px){
.resp-table table, .resp-table table tr, .resp-table table tr td{border:1px solid #ccc !important; 
}
@media(max-width:640px){
.resp-table table {font-size:14px;}
}
@media(max-width:340px){
.resp-table table {font-size:12px;}
}
</style>


<?php get_footer();?>