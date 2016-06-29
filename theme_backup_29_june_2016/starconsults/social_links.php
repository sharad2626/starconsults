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
			<h2> Social Media Link Details</h2>
			<!--<h2><a href="">Add</a></h2>-->
		<table cellspacing="0" class="wp-list-table widefat custom-page" style="margin-top:20px;" id="ListJobs">
			<thead>
				<tr>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Id</th>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Name</th>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Link</th>
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
				<?php $result=$wpdb->get_results("SELECT * from tbl_social_media"); 
				 $total_items= count($result);
				 $total_pages = ceil($total_items/$limit);?>
				<?php  $social_result = $wpdb->get_results("SELECT * from tbl_social_media  LIMIT $start , $limit");?>
                			
			<?php foreach($social_result as $social){ ?>
				<tr>
					
					<td><?php echo $social->Id; ?></td>
					<td><?php echo $social->Social_media_name; ?></td>
					<td><?php echo $social->Link; ?></td>
					<td><a class="edit" id="<?php echo $social->id;?>" href="<?php echo home_url(); ?>/wp-admin/admin.php?page=edit_social_media&social_id=<?php echo $social->Id;?>">Edit</a><!--&nbsp; | &nbsp;<a class="delete" id="<?php echo $social->id;?>">Delete</a>-->
					</td> 
					
				</tr>
			<?php  }?>
			</tbody>
			<tfoot>
				<tr>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Id</th>
				   <th style="" class="manage-column column-name" id="name" scope="col" colspan="">Name</th>
					<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Link</th>
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
	