<?php
session_start();
/*
Template Name: My Purchase

*/
if ( !is_user_logged_in() ) {
	wp_safe_redirect( home_url( '/login/' ) );
	exit;
}
//print_r($_SESSION);
 $user_ID = get_current_user_id(); 

 global $current_user;
 get_currentuserinfo();
  //echo   $user_ID;
?>

<?php get_header();?>

<div class="content-page clearfix">

<!--  html taken from order page-->


  <div class="container">
    <div class="main-content full-width">
            <div class="main-content-bg clearfix">
						<h1> My Purchase </h1>
			        <p>
<style type="text/css">
.main-content-bg{ position:relative;}
</style>
</p><div class="back_to_account">
	<a href="<?php echo home_url('account'); ?>">Back To Profile</a>
</div>
<?php

$page = get_query_var('paged');
$limit= 10;
if($paged == ''){
	$start=0;
}
else{
	$start=($page-1) *$limit; 
	
}

$job_result = $wpdb->get_results("SELECT * from payment_to_consultant AS PC LEFT JOIN  wp_users AS U ON PC.buyer_id=U.ID where PC.buyer_id='". $user_ID."' and payment_status='completed'  ORDER BY payment_id DESC LIMIT $start , $limit");

//echo "<pre>";
//print_r($job_result);

?>


<div class="dataTables_wrapper no-footer" id="orderTable_wrapper">
	
	<!-- <div id="orderTable_length" class="dataTables_length">
		<label>Show <select class="" aria-controls="orderTable" name="orderTable_length">
		<option value="5">5</option>
		<option value="10">10</option>
		<option value="25">25</option>
		<option value="50">50</option>
		<option value="100">100</option>
		</select> entries</label>
	</div> -->

<table style="width: 100%;" aria-describedby="orderTable_info" role="grid" id="my-purchase" class="table table-striped table-bordered dataTable no-footer" width="100%" cellspacing="0">
<thead>
	

	
			<tr role="row">
				<th style="width: 312px;" colspan="1" rowspan="1" class="sorting_disabled">Order No</th>
				 <th style="width: 297px;" colspan="1" rowspan="1" class="sorting_disabled">Order Date</th>
				<th style="width: 154px;" colspan="1" rowspan="1" class="sorting_disabled">Price</th> 
				<th style="width: 330px;" colspan="1" rowspan="1" class="sorting_disabled">Order Status</th>
			</tr>



</thead>
<tbody>
					
				<?php foreach($job_result as $job){ ?>	
				
				<tr class="even" role="row">
                 <?php
				 if($current_user->roles[0]=='consultant')
					{
					?>
					<td><a href="<?php echo get_bloginfo("siteurl").'/orders?type=self&orderid='.$job->marketplace_order_id;?>">
					<?php 
					
					//echo $job->order_id; 

					$order_arr = explode("=",$job->order_id); 

					 if(count($order_arr)>1){

					echo   $order_arr[0]." ".$order_arr[1];

					}else{ 
						
						echo $job->order_id;
					}
					
					?></a></td>
					<?php 
					}
					else
					{
					?>
				<td><a href="<?php echo get_bloginfo("siteurl").'/orders?orderid='.$job->marketplace_order_id;?>"><?php echo $job->order_id; 
				

				$order_arr = explode("=",$job->order_id); 

				 if(count($order_arr)>1){

				echo   $order_arr[0]." ".$order_arr[1];

				}else{ 
					
					echo $job->order_id;
				}
					
				
				
				?></a></td>
				<?php } ?>
				<td><?php echo  $job->Payment_date_time; ?></td>
				<td><?php echo "$";echo $job->price; ?></td> 
				<td><?php echo $job->payment_status; ?></td>
				</tr>

				<?php }?>

				</tbody>
</table>


<!-- <div aria-live="polite" role="status" id="orderTable_info" class="dataTables_info">
Showing 1 to 4 of 4 entries</div>
<div id="orderTable_paginate" class="dataTables_paginate paging_simple_numbers">
<a id="orderTable_previous" tabindex="0" data-dt-idx="0" aria-controls="orderTable" class="paginate_button previous disabled">Previous</a>
<span><a tabindex="0" data-dt-idx="1" aria-controls="orderTable" class="paginate_button current">1</a></span>
<a id="orderTable_next" tabindex="0" data-dt-idx="2" aria-controls="orderTable" class="paginate_button next disabled">Next</a>
</div> -->

<style>
@media(max-width:770px){
	.table-striped , .table-striped  tr, .table-striped  tr td{border:1px solid #ccc !important;}
}
@media(max-width:768px){
	.table-striped {font-size:12px;}
}
@media(max-width:475px){
	.back_to_account a{margin-top:20px; display:block;}
	.table-striped {font-size:8px;}
}
</style>

</div>

		<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery('#my-purchase').dataTable( {
					searching: false,
					ordering: false,
					"pageLength": 4
				});
			} );
		</script>

<p></p>
      </div>
    </div>
  </div>




<!--  html taken from order page  -->

</div> <!-- end of content-page -->
<?php //echo do_shortcode('[wp_jdt id="my-purchase"]');?>
<?php get_footer();?>
