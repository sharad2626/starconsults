<?php
session_start();
/*
Template Name: My Sale

*/
if ( !is_user_logged_in() ) {
	wp_safe_redirect( home_url( '/login/' ) );
	exit;
}
//print_r($_SESSION);
 $user_ID = get_current_user_id(); 
// echo  $user_ID;
// echo   $user_ID;
?>

<?php get_header();?>

<div class="content-page clearfix">
  <div class="container">
    <div class="main-content full-width">
            <div class="main-content-bg clearfix">
						<h1>My Sale</h1>
			        <p>
<style type="text/css">
.main-content-bg{ position:relative;}
</style>
</p><div class="back_to_account">
	<a href="<?php echo home_url('account'); ?>">Back To Profile</a>
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
<?php $result=$wpdb->get_results("SELECT * from payment_to_consultant where seller_id='". $user_ID."' and payment_status='completed' ORDER BY payment_id DESC"); 
				 $total_items= count($result);
				 //echo $total_items;
				 $total_pages = ceil($total_items/$limit);
				 //echo $total_pages;
				 ?>
				 
<?php $job_result = $wpdb->get_results("SELECT * from payment_to_consultant AS PC LEFT JOIN  wp_users AS U ON PC.buyer_id=U.ID where PC.seller_id='". $user_ID."' and payment_status='completed' ORDER BY payment_id DESC LIMIT $start , $limit");?>

<?php //echo "SELECT * from payment_to_consultant AS PC LEFT JOIN  wp_users AS U ON PC.buyer_id=U.ID where PC.seller_id='". $user_ID."' and payment_status='completed' ORDER BY payment_id DESC LIMIT $start , $limit"; ?>

<?php  //echo"<pre>"; print_r($job_result); ?>

<div  class=" no-footer">
	<table id="my-sale" width="100%" cellspacing="0" class="table table-striped table-bordered  no-footer" role="grid" aria-describedby="orderTable_info" style="width: 100%;">
<thead>
	<tr role="row">
		<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 316px;">Order Id</th>
		<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 316px;">Order Date</th>
		<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 148px;">Price</th>
		<!--<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Buyer</th>
		<th style="" class="manage-column column-name" id="name" scope="col" colspan="">Seller</th>-->
		<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 319px;">Payment Status</th>
	</tr>
</thead>
<tbody>

	<?php foreach($job_result as $job){	?>
	<tr role="row" class="odd">
		<td><!--<a href="http://www.starconsults.com/orders?orderid=<?php echo $job->order_id;?>">-->
		<?php //echo $job->order_id; 


		$order_arr = explode("=",$job->order_id); 

		if(count($order_arr)>1){

			echo   $order_arr[0]." ".$order_arr[1];

		}else{ 

			echo $job->order_id;
		}

		
		?></td>
		<td><?php echo  $job->Payment_date_time; ?></td>
		<td><?php echo "$";echo $job->price; ?></td>
	<!---->
		<td><?php echo $job->payment_status; ?></td>
	</tr>
	<?php }?>
	</tbody>
</table>

<?php //pagination('bottom',$total_items,$total_pages,5); ?>



	
		<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery('#my-sale').dataTable( {
					searching: false,
					ordering: false,
					"pageLength": 4
				});
			} );
		</script>

<p></p>
  </div>
  <?php //echo do_shortcode('[wp_jdt id="my-sale"]');?>
    </div>
  </div>
</div>

<style>
@media(max-width:770px){
	.table-striped , .table-striped  tr, .table-striped  tr td{border:1px solid #ccc !important;}
}
@media(max-width:768px){
	.table-striped {font-size:12px;}
}
@media(max-width:475px){
	.back_to_account a{margin-top:20px; display:block;}
	.table-striped {font-size:10px;}
}
</style>

<?php get_footer();?>
