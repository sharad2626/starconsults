<?php
global $wpdb;
$strTableName = 'subscription_plans';
$current_user = wp_get_current_user();
$roles = $current_user->roles;
$data = $current_user->data;
?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/data_table.css" />
<div class="wrap">
		<div class="icon32 icon32-posts-page" id="icon-edit-pages"><br></div>
			<h2> Plans

				
			</h2>
			
		<table cellspacing="0" class="wp-list-table widefat custom-page" style="margin-top:20px;" id="ListJobs">
			<thead>
				<tr>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Plan Id</th>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Plan Name</th>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Plan Description</th>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Plan Amount</th>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Plan Duration</th>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Plan Status</th>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Action</th>
				</tr>
			</thead>
			<tbody>
				
				<?php $job_result = $wpdb->get_results("SELECT * from subscription_plans ");?>
				
				
			<?php foreach($job_result as $job){ ?>
				<tr>
					<td><?php echo $job->plan_id; ?></td>
					<td><?php echo $job->plan_name; ?></td>
					<td><?php echo $job->plan_description; ?></td>
					<td><?php echo $job->Plan_amount; ?></td>
					<td><?php echo $job->Plan_duration; ?></td>
					<td><?php echo $job->Plan_status; ?></td>
				    <td>
				    <a href="<?php echo home_url(); ?>/wp-admin/admin.php?page=add_Subscriptions_plan&plan_id=<?php echo $job->plan_id;?>"> Edit</a>|<a href="javascript:void(0);" class="deleteRecord" id="<?php echo $job->plan_id;;?>">Delete</a>
					</td> 
					
				</tr>
			<?php  }?>
			</tbody>
			<tfoot>
				<tr>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Plan Id</th>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Plan Name</th>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Plan Description</th>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Plan Amount</th>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Plan Duration</th>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Plan Status</th>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Action</th>
				</tr>
				
			</tfoot>
		</table>
		
	</div>
	<?php //pagination('bottom',$total_items,$total_pages,5); ?>
		
	<script>
	jQuery(function() {

         jQuery('.deleteRecord').click(function(){
         	var  bid = this.id; 
         	 var checkstr =  confirm('are you sure you want to delete this?');
              if(checkstr == true){
              	var data = {
					action: 'deleteRow',
					data: bid,
					tableName: 'subscription_plans'
				}
				var ajaxurl = "<?php echo site_url(); ?>/wp-admin/admin-ajax.php";
				jQuery.post(ajaxurl, data, function(response) {
					
						jQuery("a#"+bid).closest('tr').remove();
			});
			}
         	  
     });
  });

	</script>
	<style>
	@media(max-width:782px){
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
	
	