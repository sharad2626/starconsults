<?php 
/*
	Template Name: View Video
*/
if ( !is_user_logged_in() ) {
	wp_safe_redirect( home_url( '/login/' ) );
	exit;
}
$queryVarVideo = get_query_var("videoid");
if($_REQUEST['videoid'] && !empty($_REQUEST['videoid'])){
	$videoId = $_REQUEST['videoid'];
}else if($queryVarVideo && !empty($queryVarVideo)){
	$videoId = $queryVarVideo;
}else{
	wp_safe_redirect( home_url( '/account/videos/' ) );
	exit;
}



?>

<?php 
	if($current_user || !empty($current_user->data)){
		$userOrdered = checkProductInUserOrder($current_user->data->ID , $videoId);
		//print_r($userOrdered);
		if(!$userOrdered){

			wp_safe_redirect( home_url( '/account/videos/' ) );
			exit;
		}
	}else{
		wp_safe_redirect( home_url( '/account/videos/' ) );
		exit;
	}
	?>



<?php get_header();?>
<?php $videoProduct = get_post($videoId); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="content-page clearfix">
  <div class="container videoIframeContainer">
  	<h1><?php echo $videoProduct->post_title; ?></h1>
    <?php 
		if($userOrdered){
			$vdata = getViddlerData($videoId);
			 //echo "<pre>"; print_r($vdata); exit;
		}
	?>
	<?php if(!empty($vdata)):?>
			<script type="text/javascript" src="//static.cdn-ec.viddler.com/js/arpeggio/v2/build/main-built.js"></script>
			<div class="viddler-auto-embed" data-video-id="<?php echo $vdata['id']; ?>"></div>
	<?php endif; ?>
	
  </div>
</div>
<?php endwhile; endif;?>

<?php get_footer();?>
