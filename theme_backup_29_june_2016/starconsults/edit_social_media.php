<?php 
ob_start();
global $wpdb;
$current_user = wp_get_current_user();
 // echo '<pre>';print_r($current_user);
$data = $current_user->data;
$strTableName = 'tbl_social_media';
$current_user = wp_get_current_user(); 
if(isset($_POST['addEdit']) && !empty($_POST)){
	// echo "<pre>";print_r($_POST);
	$Social_media_name  = trim($_POST['Social_media_name']);
	$Link  = trim($_POST['Link']);
		

	$arrTableData = array(
		'Social_media_name'  => $Social_media_name,
		'Link'  => $Link,
	 		
	);

	
if(!empty($_GET['social_id'])){
		
		$where = array( 'Id' => $_GET['social_id'] );
		
		$update = $wpdb->update( $strTableName, $arrTableData, $where);

	


		if($update){
			$_SESSION['msg'] = 'Updated successfully.';
			?>
			<script >
			window.location.assign("http://www.starconsults.com/wp-admin/admin.php?page=Social-admin-menu");
			</script>
			 <?php
			}else{
			$_SESSION['error'] = 'Ooops, some error has occured.';
		}
	}else{
		//$arrTableData['user_id'] = $data->ID;
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
	if(isset($_GET['social_id'])) {
	 $pid=$_GET['social_id'];
$job_result=$wpdb->get_results("SELECT * from tbl_social_media where Id=".$pid);
//print_r($job_result);
	}
?>
<form method="post" name="frmAddsocial" id="frmAddsocial">
	<input type="hidden" name="addEdit" />
	<h3 class="change-pay">Add Social Media Link</h3>
	<table cellspacing="0" class="wp-list-table widefat custom-page" style="margin-top:20px;">
		<tr>
			<th>Social Media Name</th>
			<td><input type="text" class="validate[required]" name="Social_media_name" value="<?php echo isset($job_result[0]->Social_media_name) ? $job_result[0]->Social_media_name : ''; ?>"/></td>
		</tr>
		<tr>	
			<th>Link</th>
			<td><input type="text"  class="validate[required]" id="Link" name="Link" value="<?php echo isset($job_result[0]->Link) ? $job_result[0]->Link : ''; ?>"/></td>
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
