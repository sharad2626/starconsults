<?php
global $wpdb;
$strTableName = 'subscriptions';
$current_user = wp_get_current_user();
$roles = $current_user->roles;
$data = $current_user->data;
?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/data_table.css" />
<div class="wrap">
		<div class="icon32 icon32-posts-page" id="icon-edit-pages"><br></div>
			<h2> subscriptions Details

				
			</h2>
			
		<table cellspacing="0" class="wp-list-table widefat custom-page" style="margin-top:20px;" id="ListJobs">
			<thead>
				<tr>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Subscription Amount</th>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">User Name</th>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Payment Status</th>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Order id</th>
					<!-- <th style="" class="manage-column column-name" id="name" scope="col" colspan="">Paypal Response</th> -->
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Subscription Plan Id</th>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Subscription Date</th>
					 <th style="" class="manage-column column-name" id="name" scope="col" colspan="">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php $paged= $_GET['paged'];
				$limit= 10;
				if($paged == ''){
					$start=0;
				}
				else{
					$start=($paged-1) *10; 
					
				}
				?>
				<?php $result=$wpdb->get_results("SELECT * from subscriptions"); 
				//echo "<pre>";print_r($result);
				 $total_items= count($result);
				 $total_pages = ceil($total_items/$limit);?>
				<?php $job_result = $wpdb->get_results("SELECT subscription_plans.Plan_amount,wp_users.display_name,subscriptions.subscription_id,subscriptions.User_Id,subscriptions.payment_status,subscriptions.order_id,subscriptions.subscription_plan_id,subscriptions.subscription_date from subscriptions 
					INNER JOIN wp_users ON subscriptions.User_Id=wp_users.ID  
					JOIN subscription_plans ON subscription_plans.plan_id=subscriptions.subscription_plan_id ORDER BY subscription_id DESC
				 LIMIT $start , $limit");?>

				
			<?php foreach($job_result as $job){ ?>
				<tr>
					
					<td><?php echo "$";echo $job->Plan_amount; ?></td>
					<td><?php echo $job->display_name; ?></td>
					<td><?php echo $job->payment_status; ?></td>
					<td><?php //echo $job->order_id; 
					
						$order_arr = explode("=",$job->order_id); 

						if(count($order_arr)>1){

						echo   $order_arr[0]." ".$order_arr[1];

						}else{ 

						echo $job->order_id;
						}					
					
					?></td>
					<!-- <td><?php echo $job->paypal_response; ?></td> -->
					<td><?php echo $job->subscription_plan_id; ?></td>
					<td><?php echo $job->subscription_date; ?></td>
					 <td><a class="delete" id="<?php echo $job->id;?>">Delete</a>
					</td> 
					
				</tr>
			<?php  }?>
			</tbody>
			<tfoot>
				<tr>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Subscription Id</th>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">User Id</th>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Payment Status</th>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Order id</th>
					<!-- <th style="" class="manage-column column-name" id="name" scope="col" colspan="">Paypal Response</th> -->
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Subscription Plan Id</th>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Subscription Dates</th>
					 <th style="" class="manage-column column-name" id="name" scope="col" colspan="">Action</th>
				</tr>
				
			</tfoot>
		</table>
		
	</div>
	<?php pagination('bottom',$total_items,$total_pages,5); ?>
		
	<script>
	jQuery(function() {

         jQuery('.delete').click(function(){
         	 bid = (this.id) ; 
         	 var checkstr =  confirm('are you sure you want to delete this?');
              if(checkstr == true){
              	var data = {
					action: 'deleteRow',
					data: bid,
					tableName: 'add_jobs'
				}
				var ajaxurl = "<?php echo site_url(); ?>/wp-admin/admin-ajax.php";
				jQuery.post(ajaxurl, data, function(response) {
					alert('success');
						a.closest('tr').remove();
			});
			}
         	  
     });
  });

	</script>

	<style>
	@media(max-width:1140px){
		.custom-page tr th{display:none;}
		.custom-page tr th:first-child{display:block;width:100%;border-right: 1px solid rgb(221, 221, 221);}
		.custom-page .tbody tr td:nth-child(2n){font-size:10px;}
	}
	@media(min-width:783px) and (max-width:990px){
		.custom-page tr td{font-size:11px;}
	}
	/*@media(max-width:767px){
		.custom-page tr td{font-size:13px;}
	}*/
	</style>
	