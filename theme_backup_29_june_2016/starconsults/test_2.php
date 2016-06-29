<?php error_reporting(E_ALL); ini_set("display_error","ON");


 $res= "responseEnvelope.timestamp=2016-04-20T01%3A41%3A12.469-07%3A00&responseEnvelope.ack=Failure&responseEnvelope.correlationId=f2e45d940f914&responseEnvelope.build=20420247&error(0).errorId=560022&error(0).domain=PLATFORM&error(0).subdomain=Application&error(0).severity=Error&error(0).category=Application&error(0).message=The+X-PAYPAL-APPLICATION-ID+header+contains+an+invalid+value&error(0).parameter(0)=X-PAYPAL-APPLICATION-ID";


 $res="responseEnvelope.timestamp=2016-04-21T21%3A50%3A17.955-07%3A00&responseEnvelope.ack=Success&responseEnvelope.correlationId=79f3f184216a1&responseEnvelope.build=20420247&payKey=AP-6TH96557570791407&paymentExecStatus=CREATED";

$res_arr = explode("&",$res);  echo "<pre>"; print_r($res_arr); exit;	



	


	$status_index=0;
	for($k=0;$k<count($res_arr);$k++){

	$mystring = $res_arr[$k];
	$findme   = 'ack';
	$pos = strpos($mystring, $findme);

	// Note our use of ===.  Simply == would not work as expected
	// because the position of 'a' was the 0th (first) character.

	if ($pos === false) {  } else { $status_index = $k;  	}


	}

if($status_index!=0){
	
	echo $res_arr[$status_index]; echo "<br>";

	echo $res_arr[$receiver_trans]; echo "<br>";

	echo $res_arr[$sender_trans];  echo "<br>";

}else{
  
   echo "ack string does not found in paypal response";
}

