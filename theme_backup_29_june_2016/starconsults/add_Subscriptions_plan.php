  
  <!-- jQuery Form Validation code -->

<?php 
global $wpdb;
$current_user = wp_get_current_user();
 // echo '<pre>';print_r($current_user);
$data = $current_user->data;
$strTableName = 'subscription_plans';
$current_user = wp_get_current_user(); 

if(isset($_POST['addEdit']) && !empty($_POST)){
	
	$plan_name = $_POST['plan_name'];
	$plan_description = $_POST['plan_description'];
	$Plan_amount = $_POST['Plan_amount'];
	$Plan_duration = $_POST['Plan_duration'];
	$Plan_status = $_POST['Plan_status'];

	$arrTableData = array(
		'plan_name' => $plan_name,
		'plan_description' => $plan_description,
		'Plan_amount' => $Plan_amount,
		'Plan_duration'=> $Plan_duration,
		'Plan_status' => $Plan_status
		
		
	);
	if(!empty($_GET['plan_id'])) {
		
	$where = array( 'plan_id' => $_GET['plan_id'] );
	 $update = $wpdb->update( $strTableName, $arrTableData, $where);
	
	if($update){
		//wp_redirect('http://www.starconsults.com/wp-admin/admin.php?page=view_plan');
		//header("Location: http://www.starconsults.com/wp-admin/admin.php?page=view_plan");exit('jh');
			echo $_SESSION['msg'] = 'updated successfully.';
			//echo get_admin_url();
			?>
			<script >
			window.location.assign("http://www.starconsults.com/wp-admin/admin.php?page=view_plan");
			</script>
			<?php 
			
		}
	}else{
		$update = $wpdb->insert( $strTableName, $arrTableData);
	    if($update){
			echo $_SESSION['msg'] = 'inserted successfully.';
			 wp_redirect( 'http://www.starconsults.com/wp-admin/admin.php?page=view_plan',301);exit;
		}
	}
	
}
	

?>
<?php if(isset($_GET['plan_id'])) {
	 $pid=$_GET['plan_id'];
	
     $job_result=$wpdb->get_results("SELECT * from subscription_plans where plan_id=".$pid);
	 //print_r($job_result);
     echo "<h1>Edit Plan</h1>";
   

}else{?>
<h1>Add Plan</h1>
<?php }?>

<form name="frmAddJobs" id="frmApproveJob" action="#" method="POST"  onsubmit="return submit_request()">
	<input type="hidden" name="addEdit" />
	<table cellspacing="0" class="wp-list-table widefat" style="margin-top:20px;">
		<tr>
			<th>Plan name</th>
			<td><input type="text" class="plan_name" name="plan_name" value="<?php echo isset($job_result[0]->plan_name) ? $job_result[0]->plan_name : ''; ?>"/><lebel id="msg" style="padding-left:105px; padding-bottom:4px;color:red;"></lebel></td>
		</tr>
		<tr>	
			<th>Plan description</th> 
			<td><textarea  class="plan_description" id="datepicker" name="plan_description" ><?php echo isset($job_result[0]->plan_description) ? $job_result[0]->plan_description : ''; ?></textarea><lebel id="msg" style="padding-left:105px; padding-bottom:4px;color:red;"></lebel></td>
		</tr>
		<tr>
			<th>Plan amount</th>
			<td><input type="text"  class="Plan_amount" id="datepicker" name="Plan_amount" value="<?php echo isset($job_result[0]->Plan_amount) ? $job_result[0]->Plan_amount : ''; ?>"/><lebel id="msg" style="padding-left:105px; padding-bottom:4px;color:red;"></lebel><span class="hint">Add amount in $<span class="hint-pointer">&nbsp;</span></span>
</td>
		</tr>
		<tr>
			<th>Plan duration</th> 
			<td><input type="text"  class="Plan_duration" id="datepicker" name="Plan_duration" value="<?php echo isset($job_result[0]->Plan_duration) ? $job_result[0]->Plan_duration : ''; ?>"/><lebel id="msg" style="padding-left:105px; padding-bottom:4px;color:red;"></lebel><span class="hints">Add duration in month<span class="hint-pointer">&nbsp;</span></td>
		</tr>
		<tr>
			<th>Plan status</th> 
			<td>
				<select name="Plan_status" class="Plan_status">
					
					<option value="active"<?php if($job_result[0]->Plan_status == 'active'){echo "selected";}?>>active</option>
					<option value="inactive"<?php if($job_result[0]->Plan_status == 'inactive'){echo "selected";}?>>inactive</option>
					<option value="delete"<?php if($job_result[0]->Plan_status == 'delete'){echo "selected";}?>>delete</option>
					
				</select>
			</td>
		</tr>
		
		
		<tr>
			<th></th>
			<td>
				<input type="submit" name="submit" value="Submit" />
			</td>
		</tr>		
	</table>
	</form>
	<button onclick="goBack()">Go Back</button>
	 <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery/jquery-1.4.4.min.js"></script>
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
	

	<script type="text/javascript" language="javascript">
	
   
	
		function goBack() {
		    window.history.back();
		}

		function submit_request(){ 

			
            
			var plan_name		= $(".plan_name").val(); 
			
			var plan_description = $(".plan_description").val();
			var Plan_amount		= $(".Plan_amount").val();
			var Plan_duration	= $(".Plan_duration").val();


			if(plan_name == "" ){
			$('.plan_name').css("border","1px solid red");
			
				$(".plan_name").next().text( "Please enter plan Name field." );
				//$("#msg").empty(); 
				//$("#msg").html("Please enter plan Name field.");
				//$("#msg").css("color","red");
				
				return false;
			}
			else{
				$('.plan_name').css("border","1px solid #CCC");
				$(".plan_name").next().empty();
				$(".plan_name").empty(); 
			}
			if(plan_description == "" ){
			$('.plan_description').css("border","1px solid red");
			
				$(".plan_description").next().text( "Please enter plan description field." );
				/*$("#msg").empty(); 
				$("#msg").html("Please enter plan description field.");
				$("#msg").css("color","red");*/
				
				return false;
			}
			else{
				//$('.plan_description').css("border","1px solid #CCC");
			//	$(".plan_description").next().empty();
				//$(".plan_description").empty(); 
			}
			if(Plan_amount == "" ){
				$(".Plan_amount").next().text( "Please fill amount No field." );
				$('.Plan_amount').css("border","1px solid red");
				/*$("#msg").empty(); 
				$("#msg").html("Please fill amount No field.");
				$("#msg").css("color","red");*/

				return false;
				
			}
			else{
			 
				var regularExpression = /^\$?(([1-9][0-9]{0,2}(,[0-9]{3})*)|[0-9]+)?(.[0-9]{2})?$/;  

				if(!Plan_amount.match(regularExpression)){
					$(".Plan_amount").next().text( "Please use  digits for Plan amount." );
					/*$("#msg").empty(); 
					$("#msg").html("Please use  digits for Plan amount.");
					$("#msg").css("color","red");*/
					
					return false;

				}else{
					$(".Plan_amount").next().empty();
					$("#msg").empty(); 
					$('.Plan_amount').css("border","1px solid #D4D4D4");
					
				}
			}


			if(Plan_duration == "" ){
			 $(".Plan_duration").next().text( "Please fill amount No field." );
			 $('.Plan_duration').css("border","1px solid red");
				
				/*$("#msg").empty(); 
				$("#msg").html("Please enter Duration field.");
				$("#msg").css("color","red");*/

				
				return false;
			}else{
				var regularExpression = /^[$0-9]/;  

				if(!Plan_duration.match(regularExpression)){
					$(".Plan_duration").next().text( "Please use  digits for Plan amount." );
					/*$("#msg").empty(); 
					$("#msg").html("Please use  digits for Plan duration.");
					$("#msg").css("color","red");*/
					
					return false;

				}else{
					 $(".Plan_duration").next().empty();
				
				$('#message').css("border","1px solid #CCC");
			
			
			}}
		
			
	       $("#frmApproveJob").submit();
 
			
			
		
   
	}
</script>
<script >
$(document).ready( function() {
	
	$(".hint").css({ "display":"none" });
	$(".hints").css({ "display":"none" });
	$( "input.Plan_amount" ).mouseenter(function() {
  	$(".hint").css({ "display":"inline" });
})
	.mouseleave(function() {
    $(".hint").css({ "display":"none" });
  });
	$( "input.Plan_duration" ).mouseenter(function() {
  	$(".hints").css({ "display":"inline" });
})
	.mouseleave(function() {
    $(".hints").css({ "display":"none" });
  });
});
	</script>
	<style>
	.error{
		color: red;
		padding-left: 10px;
	}
	input.error{
		border: 1px solid #FF0107;
	}
	</style>