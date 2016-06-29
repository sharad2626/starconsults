<?php
global $wpdb;
$strTableName = 'wp_payment_to_consultant';
$current_user = wp_get_current_user();
$roles = $current_user->roles;
$data = $current_user->data;
?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/data_table.css" />
<div class="wrap">
		<div class="icon32 icon32-posts-page" id="icon-edit-pages"><br></div>
			<h2> Purchase Details</h2>
			
		<table cellspacing="0" class="wp-list-table widefat custom-page" style="margin-top:20px;" id="ListJobs">
			<thead>
				<tr>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Payment Id</th>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Order Id</th>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Price</th>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Buyer</th>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Seller</th>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Payment Date</th>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Payment Status</th>
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
				<?php $result=$wpdb->get_results("SELECT * from payment_to_consultant"); 
				 $total_items= count($result);
				 $total_pages = ceil($total_items/$limit);?>
				<?php  $job_result = $wpdb->get_results("SELECT * from payment_to_consultant AS PC LEFT JOIN  wp_users AS U ON PC.buyer_id=U.ID  order by payment_id DESC LIMIT $start , $limit");?>
                			
			<?php foreach($job_result as $job){ ?>
				<tr>
					
					<td><?php echo $job->payment_id; ?></td>
					<td><?php //echo $job->order_id; 
					
					
					$order_arr = explode("=",$job->order_id); 

					 if(count($order_arr)>1){

					echo   $order_arr[0]." ".$order_arr[1];

					}else{ 
						
						echo $job->order_id;
					}
					
					?></td>
					<td><?php echo "$";echo $job->price; ?></td>
					<td><?php echo $job->user_login; ?></td>
					 <?php  $seller = $wpdb->get_results("SELECT * from payment_to_consultant AS PC LEFT JOIN  wp_users AS U ON PC.seller_id=U.ID where PC.payment_id=".$job->payment_id." LIMIT $start , $limit"); 
					foreach($seller as $sell){ 
					?>
					<td><?php echo $sell->display_name; ?></td>
					<?php } ?>
					<td><?php echo $job->Payment_date_time; ?></td>
					<td><?php echo $job->payment_status; ?></td>
					 <td><a class="delete" id="<?php echo $job->payment_id;?>">Delete</a>
					</td> 
					
				</tr>
			<?php  }?>
			</tbody>
			<tfoot>
				<tr>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Payment Id</th>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Order Id</th>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Price</th>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Buyer</th>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Seller</th>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Payment Date</th>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Payment Status</th>
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
					action: 'deletePurchaseRow',
					data: bid,
					tableName: 'payment_to_consultant'
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
	