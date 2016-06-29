<?php
global $wpdb;
$strTableName = 'payment_modes';
$current_user = wp_get_current_user();
$roles = $current_user->roles;
$data = $current_user->data;
?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/data_table.css" />
<div class="wrap">
		<div class="icon32 icon32-posts-page" id="icon-edit-pages"><br></div>
			<h2> Payment Details

				
			</h2>
			
		<table cellspacing="0" class="wp-list-table widefat custom-payments" style="margin-top:20px;" id="ListJobs">
			<thead>
				<tr>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Payment Id</th>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Username</th>
					<th style="" class="manage-column column-name col-hide" id="name" scope="col" colspan="">Password</th>
					<th style="" class="manage-column column-name col-hide" id="name" scope="col" colspan="">Signature</th>
					<th style="" class="manage-column column-name col-hide" id="name" scope="col" colspan="">App Key</th>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Status</th>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Mode</th>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Action</th>
				</tr>
			</thead>
			<tbody>
				
				<?php $job_result = $wpdb->get_results("SELECT * from payment_modes ");?>
				
				
			<?php foreach($job_result as $job){ ?>
				<tr>
					<td><?php echo $job->id; ?></td>
					<td><?php echo $job->username; ?></td>
					<td class="col-hide"><?php echo $job->password; ?></td>
					<td class="col-hide"><?php echo $job->signature; ?></td>
					<td class="col-hide"><?php echo $job->app_key; ?></td>
					<td><?php echo $job->status; ?></td>
					<td><?php echo $job->mode; ?></td>
					 <td><a href="<?php echo home_url(); ?>/wp-admin/admin.php?page=edit_payment&payment_id=<?php echo $job->id;?>"> Edit</a>
					</td> 
					
				</tr>
			<?php  }?>
			</tbody>
			<tfoot>
				<tr>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Payment Id</th>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Username</th>
					<th style="" class="manage-column column-name col-hide" id="name" scope="col" colspan="">Password</th>
					<th style="" class="manage-column column-name col-hide" id="name" scope="col" colspan="">Signature</th>
					<th style="" class="manage-column column-name col-hide" id="name" scope="col" colspan="">App Key</th>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Status</th>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Mode</th>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Action</th>
				</tr>
				
			</tfoot>
		</table>
		
	</div>
	<?php //pagination('bottom',$total_items,$total_pages,5); ?>
		
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

	@media(min-width:320px){
	.custom-payments .col-hide{display:none !important;}
}


@media(max-width:782px){
	.custom-payments tr th{display:none;}
	.custom-payments tr th:first-child{display:block;width:100%;border-right: 1px solid rgb(221, 221, 221);}

}
	
	</style>