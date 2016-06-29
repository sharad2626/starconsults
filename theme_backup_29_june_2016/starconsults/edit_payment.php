<?php 
ob_start();
global $wpdb;
$current_user = wp_get_current_user();
 // echo '<pre>';print_r($current_user);
$data = $current_user->data;
$strTableName = 'payment_modes';
$current_user = wp_get_current_user(); 
if(isset($_POST['addEdit']) && !empty($_POST)){
	// echo "<pre>";print_r($_POST);
	$username  = trim($_POST['username']);
	$password  = trim($_POST['password']);
	$signature = trim($_POST['signature']);
	$app_key   = trim($_POST['app_key']);
	$status = $_POST['status'];
	

	$arrTableData = array(
		'username'  => $username,
		'password'  => $password,
		'signature' => $signature,
		'app_key'   => $app_key,
		'status' => $status,
		
		
	);

	if($status=='Active'){    $status2 = 'Inactive';  }
	if($status=='Inactive'){  $status2 = 'Active';  }

	$arrTableData2 = array(
			'status' => $status2,
			);

if(!empty($_GET['payment_id'])){
		
		$where = array( 'id' => $_GET['payment_id'] );
		
		$update = $wpdb->update( $strTableName, $arrTableData, $where);

		if($_GET['payment_id']==1){ $other_record_id = 2; }
		if($_GET['payment_id']==2){ $other_record_id = 1; }

		$where2 = array( 'id' => $other_record_id );

		$update2 = $wpdb->update($strTableName,$arrTableData2,$where2);


		if($update || $update2){
			$_SESSION['msg'] = 'Updated successfully.';
			?>
			<script >
			window.location.assign("http://www.starconsults.com/wp-admin/admin.php?page=payment-admin-menu");
			</script>
			 <?php
			}else{
			$_SESSION['error'] = 'Ooops, some error has occured.';
		}
	}else{
		$arrTableData['user_id'] = $data->ID;
		// $arrTableData['email'] = $current_user->user_email;
		$result = $wpdb->insert( $strTableName, $arrTableData );

		if($result){
			$_SESSION['msg'] = 'Added successfully.';
			
		}else{
			$_SESSION['error'] = 'Ooops, some error has occure.';
		}
		// $last_inserted_id = $wpdb->insert_id;
	}
}
	if(isset($_GET['payment_id'])) {
	 $pid=$_GET['payment_id'];
$job_result=$wpdb->get_results("SELECT * from payment_modes where id=".$pid);
//print_r($job_result);

?>

<form method="post" name="frmAddJobs" id="frmApproveJob">
	<input type="hidden" name="addEdit" />
	<h3 class="change-pay">Change Payment Mode</h3>
	<table cellspacing="0" class="wp-list-table widefat custom-page" style="margin-top:20px;">
		<tr>
			<th>username</th>
			<td><input type="text" class="validate[required]" name="username" value="<?php echo isset($job_result[0]->username) ? $job_result[0]->username : ''; ?>"/></td>
		</tr>
		<tr>	
			<th>password</th>
			<td><input type="text"  class="validate[required]" id="datepicker" name="password" value="<?php echo isset($job_result[0]->password) ? $job_result[0]->password : ''; ?>"/></td>
		</tr>
		<tr>
			<th>signature</th>
			<td><input type="text"  class="validate[required]" id="datepicker" name="signature" value="<?php  echo isset($job_result[0]->signature) ? $job_result[0]->signature : ''; ?>"/></td>
		</tr>
		<tr>
			<th>app key</th>
			<td><input type="text"  class="validate[required]" id="datepicker" name="app_key" value="<?php echo isset($job_result[0]->app_key) ? $job_result[0]->app_key : ''; ?>"/></td>
		</tr>
		<tr>
			<th>status</th>
			<td>
				<select name="status" class="validate[required]">
					
					<option value="Active"<?php if($job_result[0]->status == 'Active'){echo "selected";}?>>Active</option>
					<option value="Inactive"<?php if($job_result[0]->status == 'Inactive'){echo "selected";}?>>Inactive</option>
					
				</select>
			</td>
		</tr>
		<tr>
			<th>mode</th>
		<!--	<td>
				<select name="mode" class="validate[required]">
					<option value="sand box"<?php if($job_result[0]->mode == 'sand box'){echo "selected";}?>>sand box</option>
					<option value="live"<?php if($job_result[0]->mode == 'live'){echo "selected";}?>>live</option>
					
				</select>
			</td>
			-->
			<?php if($job_result[0]->mode == 'sand box') { ?><td><input type ="text" value="Sand box" size="8"  disabled></td><?php } else { ?><td><input type ="text" value="Live" size="5"  disabled></td> <?php } ?>
		</tr>
		
		<tr>
			<th></th>
			<td>
				<input type="submit" name="submit" value="Submit" class="frmsubmit" />
			</td>
		</tr>		
	</table>
	</form>

<style>
	@media(max-width:350px){
	.custom-page td, .custom-page th{padding: 8px 5px;}	
	.custom-page td input{padding:8px 5px;}
	}
	</style>


<?php }?>