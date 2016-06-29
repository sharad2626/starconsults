<?php 
/*
	Template Name: All Consultant
*/
?>
<?php 
if ( get_query_var('paged') ) {
      $paged = get_query_var('paged');
    } else if ( get_query_var('page') ) {
      $paged = get_query_var('page');
    } else {
		$paged = 1;
		$reqUri = $_SERVER['REQUEST_URI'];
		if(strstr($reqUri,'/page/')){
			$query =  explode('/page/',$reqUri);
			$paged = trim($query[1],'/');
		}
    }
	
?>
<?php get_header();?>
<?php if (have_posts()) : while (have_posts()) : the_post(); 
	$bannerImage = types_render_field("banner-image",array('url'=>true));
	if(!empty($bannerImage)){ ?>
		<div class="top_banner">
			<img src="<?php echo $bannerImage;?>" alt="<?php the_title();?>" />
		</div>
	<?php }
endwhile; endif;?>
<div class="content-page clearfix">
  <div class="container">
    <div class="main-content full-width allconsultants"> 
		
		<div class="main-content-bg clearfix bluebg">
	
	<?php 
	$no=12;// total no of author to display
    //$paged = (get_query_var('page')) ? get_query_var('page') : 1;
    if($paged==1){
      $offset=0;  
    }else {
       $offset= ($paged-1)*$no;
    }

 $user_query = new WP_User_Query( array( 'role' => 'consultant',  'number' => $no, 'offset' => $offset ) );
	?>
	
	<div class="custom_pagination">
	<?php
            $total_user = $user_query->total_users;  
            $total_pages=ceil($total_user/$no);
               echo paginate_links(array(  
                  'base' => get_pagenum_link(1) . '%_%',  
                  'format' => '?paged=%#%',  
                  'current' => $paged,  
                  'total' => $total_pages,  
                  'prev_text' => '<',  
                  'next_text' => '>',
                  'type'     => 'list',
                ));  
?>
	</div>
	
	
	<ul id="ulconsultants">
 <?php 
        if ( ! empty( $user_query->results ) ) {
			foreach ( $user_query->results as $user ) { ?>
				<li class="col-sm-4">
					<?php $userImage = types_render_usermeta_field( "consultants-image", array("user_id" => $user->ID,"url"=>true ));
					if(empty($userImage)){
						$userImage = IMAGES_URL.'/left-video-img.png';
					}
					
					$userImage = THEME_URL."/timthumb.php?src=".$userImage."&h=194&w=350&zc=1";
					
					
					
					?>
					<div class="consultant_image">
						<a href="<?php echo get_bloginfo("siteurl").'/consultant/'.$user->user_login;?>"><img src="<?php echo $userImage;?>" /></a>
					</div>
					<div class="consultant_details">
						<h3><a href="<?php echo get_bloginfo("siteurl").'/consultant/'.$user->user_login;?>"><?php echo $user->first_name . ' ' . $user->last_name;?></a></h3>
						<?php /*?><div class="video_count">
						<?php 
				$args = array('post_type' => 'wpmarketplace','posts_per_page'=> -1,'author' => $user->ID);
				$loop = new WP_Query( $args );
				$totalVideos = $loop->found_posts;
				wp_reset_query();
						?>
							<span class="pull-left">Videos by Consultant</span>
							<span class="pull-right"><?php echo $totalVideos;?></span>
						</div><?php */?>
					</div>
				</li>
			<?php }
        } else {
            echo 'No Consultants found.';
        } 
		wp_reset_query();wp_reset_postdata();
 ?>           
</ul>

	</div>
	</div>
  </div>
</div>
<?php get_footer();?>