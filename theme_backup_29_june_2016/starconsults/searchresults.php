<?php 
/*
	Template Name: Search Page
*/
?>
<?php get_header();?>

<div class="content-page clearfix">
  <div class="container">
    <div class="main-content full-width">
      
	  <div class="main-content-bg clearfix" style="margin-bottom:20px;"> 
	  	<div class="custom_search_form">
		<form action="" method="post" id="">
			<div class="col-sm-10" style="padding:0;">
				<div class="col-sm-4">
					<select name="wpm_consultants">
						<option value="">Select Consultant</option>
						<?php $userargs = array(
								'role'         => 'consultant',
							 );
							 $consultants = get_users( $userargs );
							 if(!empty($consultants)){
								foreach($consultants as $consultant){ 
									$userDetails = $consultant->data;
								?>
									<option value="<?php echo $userDetails->ID;?>" <?php if($_POST['wpm_consultants'] && $_POST['wpm_consultants'] == $userDetails->ID){?> selected="selected"<?php }?>><?php echo $userDetails->display_name;?></option>
								<?php }
								}?>
					</select>
				</div>
				<div class="col-sm-4">
					<select name="wpm_category">
						<option value="">Select Category</option>
						<?php 
						$categories = get_terms("ptype", 'hide_empty=0&orderby=date');
						$i=1;
						foreach($categories as $category){ ?>
							<option value="<?php echo $category->term_id;?>" <?php if($_POST['wpm_category'] && $_POST['wpm_category'] == $category->term_id){?> selected="selected"<?php }?>><?php echo $category->name;?></option>
						<?php }
						?>	
					</select>
				</div>
				<div class="col-sm-4">
					<input type="text" name="wpm_searchvalue" placeholder="Title, Description" value="<?php if($_POST['wpm_searchvalue'] && !empty($_POST['wpm_searchvalue'])){ echo $_POST['wpm_searchvalue']; }?>" />
				</div>
			</div>
			<div class="col-sm-2"><input type="submit" name="custom_search" value="Search" /></div>
		</form>
		</div>
	  </div>
	  
	  
	  <div class="main-content-bg clearfix"> 
	  	<div class="search-results">
		<?php 
		
		
		
		
		if(!empty($_POST['wpm_searchvalue']) && empty($_POST['wpm_consultants']) & empty($_POST['wpm_category'])){?>
			<h1>Search Results for "<?php echo $_POST['wpm_searchvalue'];?>"</h1>
			<?php 
			
			
			
			
			
			$searchvalue = $_POST['wpm_searchvalue'];
			$args= array(
			  'search' => $searchvalue, // or login or nicename in this example
			  'search_fields' => array('user_login','user_nicename','display_name')
			);
			$authorId = "";
			$userBySearchValue = new WP_User_Query($args);
			if ( ! empty( $userBySearchValue->results ) ) {
				foreach ( $userBySearchValue->results as $singleUser ) {
					$authorId = $singleUser->ID;
				}
			}
			
			$taxonomyTerms = get_terms( array('ptype'));
			$wpmCategory = array();
			foreach($taxonomyTerms as $category){
				$categoryName = strtolower($category->name);
				if (strpos($searchvalue, $categoryName) === FALSE) {
				   continue;
				}
				$wpmCategory[] = $category->term_id;
			}
			
			
			
			$args = array('post_type' => 'wpmarketplace','posts_per_page'=> -1);
			if(!empty($authorId)){
				$args['author'] = $authorId; 
			}if(!empty($wpmCategory)){
				$args['tax_query'] = array(
											array(
												'taxonomy' => 'ptype',
												'field' => 'id',
												'terms' => $wpmCategory
											)
										);
			}
			
			if(empty($authorId) && empty($wpmCategory)){
				$args['s'] = $searchvalue; 
			}
			//$args = array('post_type' => 'wpmarketplace','posts_per_page'=> -1,'s' => $searchvalue);
			$loop = new WP_Query( $args );
			
		}
		
		
		
		
		
		
		
		
		
		else if($_POST['custom_search'] &&(!empty($_POST['wpm_consultants']) || !empty($_POST['wpm_category']) || !empty($_POST['wpm_searchvalue']))){

		
		
		
		
		
		
		 ?>
				<h1>Search Results</h1>
				<?php 
					$args = array('post_type' => 'wpmarketplace','posts_per_page'=> -1);
					if($_POST['wpm_searchvalue'] && !empty($_POST['wpm_searchvalue'])){
						$args['s'] = $_POST['wpm_searchvalue'];
					}
					if($_POST['wpm_category'] && !empty($_POST['wpm_category'])){
						$args['tax_query'] = array(
													array(
														'taxonomy' => 'ptype',
														'field' => 'id',
														'terms' => $_POST['wpm_category']
													)
												);
					}
					if($_POST['wpm_consultants'] && !empty($_POST['wpm_consultants'])){
						$args['author'] = $_POST['wpm_consultants'];
					}
					$loop = new WP_Query( $args );
		 }
		
		
		
		if($loop && $loop->have_posts()){ ?>
		
		
		<div class="custom_pagination"><?php wp_pagenavi( array( 'query' => $loop ) );?></div>
		
		
		
		<?php $i = 1;while ( $loop->have_posts() ) : $loop->the_post(); 		 ?>
				
				<div class="col-md-3 singleSearchResult" <?php if($i == 1){?> style="clear:left;" <?php }?>>
					<?php  $image = types_render_field("preview-image",array("url"=>true));
					
					
					$image = types_render_field("preview-image",array("url"=>true));
					$image = THEME_URL."/timthumb.php?src=".$image."&h=275&w=366&zc=0";
					
					?>
					<a href="<?php the_permalink();?>" class="video-img"><img src="<?php echo $image;?>" /></a>
					<div class="details">
					<h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
					<?php $term_list = wp_get_post_terms(get_the_ID(), 'ptype', array("fields" => "names"));
					if(!empty($term_list)){
						echo "<p>".implode(", ",$term_list).'</p>';
					}
					?>
					<div class="bottom"><span><?php echo get_the_author();?></span> <span class="dates"><?php echo get_the_date('M.j Y', '', ''); ?></span></div>
					</div>
				</div>
				
			<?php $i++; if($i > 4){ $i = 1;}endwhile;wp_reset_query();
			}else{
				echo "No Results Found";
			}
			?>
			</div>
			
			
	  </div>
    </div>
  </div>
</div>
<?php get_footer();?>
