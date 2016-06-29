<?php
/*
Template Name: My orders

*/
?>

<?php get_header();?>

<div class="content-page clearfix">
  <div class="container">
    <div class="main-content full-width">
            <div class="main-content-bg clearfix">
						<h1>Orders</h1>
			        <p>
<style type="text/css">
.main-content-bg{ position:relative;}
</style>
</p><div class="back_to_account">
	<a href="http://www.starconsults.com/account">Back To Profile</a>
</div>
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
<?php $job_result = $wpdb->get_results("SELECT * from payment_to_consultant AS PC LEFT JOIN  wp_users AS U ON PC.buyer_id=U.ID ORDER BY payment_id LIMIT $start , $limit");?>

<div  class=" no-footer">
	<table width="100%" cellspacing="0" class="table table-striped table-bordered  no-footer" role="grid" aria-describedby="orderTable_info" style="width: 100%;">
<thead>
	<tr role="row">
		<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 316px;">Order Id</th>
		<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 316px;">Order Date</th>
		<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 148px;">Price</th>
		<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Buyer</th>
		<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Seller</th>
		<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 319px;">Payment Status</th>
	</tr>
</thead>
<tbody>

	<?php foreach($job_result as $job){ ?>
	<tr role="row" class="odd">
		<td><!--<a href="http://www.starconsults.com/orders?orderid=<?php echo $job->order_id;?>">--><?php echo $job->order_id; ?></td>
		<td><?php echo  $job->Payment_date_time; ?></td>
		<td><?php echo "$";echo $job->price; ?></td>
		<td><?php echo $job->user_login; ?></td>
		 <?php  $seller = $wpdb->get_results("SELECT * from payment_to_consultant AS PC LEFT JOIN  wp_users AS U ON PC.seller_id=U.ID where PC.payment_id=".$job->payment_id." LIMIT $start , $limit"); 
		foreach($seller as $sell){ 
			?>
		<td><?php echo $sell->display_name; ?></td>
		<?php } ?>
		<td><?php echo $job->payment_status; ?></td>
	</tr>
	<?php }?>
	</tbody>
</table>

<?php pagination('bottom',$total_items,$total_pages,5); ?>



	
		<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery('#orderTable').dataTable( {
					searching: false,
					ordering: false
				});
			} );
		</script>

<p></p>
      </div>
    </div>
  </div>
</div>


<?php get_footer();?>
