<?php 



function register_customization() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
      'footer-menu' => __( 'Footer Menu' )
    )
  );
  
  register_sidebar( array(
		'name'          => 'Footer Column 1',
		'id'            => 'footer_column_1',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h2 class="footer_title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => 'Footer Column 2',
		'id'            => 'footer_column_2',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h2 class="footer_title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => 'Footer Column 3',
		'id'            => 'footer_column_3',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h2 class="footer_title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => 'Footer Column 4',
		'id'            => 'footer_column_4',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h2 class="footer_title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => 'Left Sidebar',
		'id'            => 'left_sidebar',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h2 style="display:none">',
		'after_title'   => '</h2>',
	) );
	
	
  
}
add_action( 'init', 'register_customization' );

add_filter( 'wp_nav_menu_objects', 'add_menu_parent_class' );
function add_menu_parent_class( $items ) {
	$parents = array();
	foreach ( $items as $item ) {
		if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
			$parents[] = $item->menu_item_parent;
		}
	}
	foreach ( $items as $item ) {
		if ( in_array( $item->ID, $parents ) ) {
			$item->classes[] = 'dropdown'; 
		}
	}
	
	return $items;    
}

class Nav_Walker_Nav_Menu extends Walker_Nav_Menu {
     function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $class_names = '';
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
        $output .= $indent . '<li' . $id . $class_names .'>';
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		
				
		if (in_array("dropdown", $classes)) {			
			$attributes .= 'class="dropdown-toggle" data-toggle="dropdown"';
		}
		
		

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        
		if (in_array("dropdown", $classes)) {			
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) .'<b class="caret"></b>'. $args->link_after;
		}else{
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		}
        
		
		
		
		if ( 'primary' == $args->theme_location ) {
            $submenus = 0 == $depth || 1 == $depth ? get_posts( array( 'post_type' => 'nav_menu_item', 'numberposts' => 1, 'meta_query' => array( array( 'key' => '_menu_item_menu_item_parent', 'value' => $item->ID, 'fields' => 'ids' ) ) ) ) : false;
            $item_output .= ! empty( $submenus ) ? ( 0 == $depth ? '<span class="arrow"></span>' : '<span class="sub-arrow"></span>' ) : '';
        }
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
	
	function start_lvl(&$output, $depth) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"dropdown-menu\">\n";
	}
	function end_lvl(&$output, $depth) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}
}
add_filter( 'wp_nav_menu_items', 'add_loginout_link', 10, 2 );
function add_loginout_link( $items, $args ) {
	
	if ($args->menu_class == 'nav navbar-nav') {
        $items .= '<li class="search" id="searchLink"><a class="searcha" href="javascript:;"><img src="'.THEME_URL.'/images/search-icon.png" class="search" title="Search"  alt="Search"></a>
		
<div class="search_header_form">
	<form method="post" id="searchform2" class="searchform2" action="'.get_bloginfo("siteurl").'/search-results/">
	  <div>
		<input type="text" name="wpm_searchvalue" id="" placeholder="e.g. Title, Description" />
		<input type="submit" id="searchsubmit" value="Search">
	  </div>
	</form>
</div>
		
		</li>';
    }
    return $items;
}


function custom_rewrite_basic() {
  add_rewrite_rule('consultant/?([^/]*)', 'index.php?pagename=consultant&username=$matches[1]', 'top');
  add_rewrite_rule('viewvideo/?([^/]*)', 'index.php?pagename=viewvideo&videoid=$matches[1]', 'top');
}
add_action('init', 'custom_rewrite_basic');


function checkProductInUserOrder($userId , $pId){
	
	global $wpdb, $sap,$current_user;
	
	$sql = "SELECT * FROM {$wpdb->prefix}mp_orders where uid='".$userId."' order by `date` desc";
	$sql.= ' LIMIT 0,10';
	$orders = $wpdb->get_results($sql);
	
	if ( !is_user_logged_in() ){
		return false;
	}
	if(count($orders)>0){
		$orderedProductIds = array();
		foreach($orders as $order){
			$cart_data = unserialize($order->cart_data);
			$status = $order->order_status;
			if($status !== "Completed"){ continue;}
			if(!empty($cart_data)){
				foreach($cart_data as $cartItems){ 
					$productId = $cartItems['ID'];
					if (!in_array($productId, $orderedProductIds)) {
						$orderedProductIds[] = $productId;
					}
				}
			}
		}
		if(empty($orderedProductIds)){
			return false;
		}else if(!in_array($pId, $orderedProductIds)){
			return false;
		}else{
			return true;
		}
	}else{
		return false;
	}

}

function getVideoIdFromUrl($video_url){
	$uri = explode('/v/',$video_url);
	return $uri[1];
}

function getViddlerData($productId){
	$vUrl = types_render_field("full-video-url",array("post_id"=>$productId));
	$vid = getVideoIdFromUrl($vUrl);
	
	$vdata['thumbnail'] = 'http://thumbs.cdn-ec.viddler.com/thumbnail_2_'.$vid.'_v1.jpg';
	$vdata['id'] = $vid;
	
	return $vdata;
}

function formatDate($date){
	if(!empty($date)){
		return date('d,M Y',strtotime($date));
	}
}

/*
function getCartQty($cart_data){
	if(empty($cart_data)){
		return 0;
	}
	$cartQy = 0;
	foreach($cart_data as $product){
		$productQty = $product['quantity'];
		$cartQy  = $cartQy + $productQty;
	}
	return $cartQy;
}*/

add_action( "wp_ajax_nopriv_delete_avtar", "delete_avtar" ); 
add_action( "wp_ajax_delete_avtar", "delete_avtar" ); 
function delete_avtar() {
	$userId = $_POST['userId'];
	if(!empty($userId)){
		update_user_meta( $userId, 'wpcf-consultants-image', '' );
		print_r(0);
		exit();
	}
}

add_action( 'admin_init', 'admin_custom_filter' );
function admin_custom_filter(){
	add_action('pre_get_posts', 'query_set_only_author' );
}


function query_set_only_author( $wp_query ) {
    global $current_user, $pagenow;
	$userRole = $current_user->roles[0];
	if($userRole == "consultant"){
		$wp_query->set( 'author', $current_user->ID );
		add_filter('views_edit-wpmarketplace', 'fix_post_counts');
	}
}

// Fix post counts
function fix_post_counts($views) {
    global $current_user, $wp_query;
	unset($views['mine']);
    $types = array(
        array( 'status' =>  NULL ),
        array( 'status' => 'publish' ),
        array( 'status' => 'draft' ),
        array( 'status' => 'pending' ),
        array( 'status' => 'trash' )
    );
    foreach( $types as $type ) {
        $query = array(
            'author'      => $current_user->ID,
            'post_type'   => 'wpmarketplace',
            'post_status' => $type['status']
        );
        $result = new WP_Query($query);
        if( $type['status'] == NULL ):
            $class = ($wp_query->query_vars['post_status'] == NULL) ? ' class="current"' : '';
            $views['all'] = sprintf(__('<a href="%s"'. $class .'>All <span class="count">(%d)</span></a>', 'all'),
                admin_url('edit.php?post_type=wpmarketplace'),
                $result->found_posts);
        elseif( $type['status'] == 'publish' ):
            $class = ($wp_query->query_vars['post_status'] == 'publish') ? ' class="current"' : '';
            $views['publish'] = sprintf(__('<a href="%s"'. $class .'>Published <span class="count">(%d)</span></a>', 'publish'),
                admin_url('edit.php?post_status=publish&post_type=wpmarketplace'),
                $result->found_posts);
        elseif( $type['status'] == 'draft' ):
            $class = ($wp_query->query_vars['post_status'] == 'draft') ? ' class="current"' : '';
            $views['draft'] = sprintf(__('<a href="%s"'. $class .'>Draft'. ((sizeof($result->posts) > 1) ? "s" : "") .' <span class="count">(%d)</span></a>', 'draft'),
                admin_url('edit.php?post_status=draft&post_type=wpmarketplace'),
                $result->found_posts);
        elseif( $type['status'] == 'pending' ):
            $class = ($wp_query->query_vars['post_status'] == 'pending') ? ' class="current"' : '';
            $views['pending'] = sprintf(__('<a href="%s"'. $class .'>Pending <span class="count">(%d)</span></a>', 'pending'),
                admin_url('edit.php?post_status=pending&post_type=wpmarketplace'),
                $result->found_posts);
        elseif( $type['status'] == 'trash' ):
            $class = ($wp_query->query_vars['post_status'] == 'trash') ? ' class="current"' : '';
            $views['trash'] = sprintf(__('<a href="%s"'. $class .'>Trash <span class="count">(%d)</span></a>', 'trash'),
                admin_url('edit.php?post_status=trash&post_type=wpmarketplace'),
                $result->found_posts);
        endif;
    }
    return $views;
}

add_action( 'init', 'disablePurchaseForConsultant' );
function disablePurchaseForConsultant(){
	global $current_user;
	$currentuserrole = $current_user->roles[0];
	if(!empty($current_user->data) && $currentuserrole == "consultant"){
		$url = explode('?', 'http://'.$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
		$ID = url_to_postid($url[0]);
		$settings = get_option('_wpmp_settings');  
		$cartPageId = $settings['page_id'];
		$checkoutPageId = $settings['check_page_id'];
		if($ID == $cartPageId || $ID == $checkoutPageId){
			//$cart_data = array();
			$cart_data = wpmp_get_cart_data();
			$currentUserId = $current_user->ID;
			foreach($cart_data as $Id=>$cart_item){
				$product = get_post($Id);
				if($product->post_author == $currentUserId){
					unset($cart_data[$Id]);
				}
			}
			wpmp_update_cart_data($cart_data);
		}	
	}else if(!is_user_logged_in()){
		$url = explode('?', 'http://'.$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
		$ID = url_to_postid($url[0]);
		$settings = get_option('_wpmp_settings');  
		$checkoutPageId = $settings['check_page_id'];
		if($ID == $checkoutPageId){
			wp_safe_redirect( home_url( '/login/?message=logintocheckout' ) );
			exit;
		}
	}
}
/*add_action( 'manage_users_custom_column', 'so_8563103_print_user_columns', 15, 3 );
add_filter( 'manage_users_columns', 'so_8563103_add_user_columns', 15 );
function so_8563103_print_user_columns( $value, $column_name, $id ) 
{
    if( 'my_orders' == $column_name ) 
    {
        $authData = get_userdata( $id );
		$userrole = $authData->roles[0];
		if(strtolower($userrole) == "consultant"){
			$authData = "<a target='_blank' href='".admin_url('edit.php?post_type=wpmarketplace&page=orders&uid='.$id)."'>Orders</a>";	
		}else{
			$authData = "-";
		}
		
        return $authData;
    }
}
function so_8563103_add_user_columns( $defaults ) 
{
     $defaults['my_orders'] = 'Orders';
     return $defaults;
}*/
add_action('admin_menu', 'addAdminMenu');


function addAdminMenu(){
	global $wpdb;
	$current_user = wp_get_current_user();
	
	//$not_Approved = $wpdb->query("SELECT * FROM vp_employements  where job_status = '0' AND expiredate >= curdate()");
	$count = '';
	/*if($not_Approved){
		$count = "<span class='update-plugins count-1'><span class='update-count'>$not_Approved </span></span>";
	}*/

	if ( !($current_user instanceof WP_User) )
    return;

	if (isset( $current_user->roles[0] ) && ($current_user->roles[0]=='administrator' || $current_user->roles[0]=='vitalPartnersadmin')) {
		$capability = 'manage_options';
	}else{
		$capability = 'organize_shop';
	}
	if($current_user->roles[0] == 'editor'){
		$capability = 'ourlatestpost';
	}
	add_menu_page('Subscriptions', 'Subscriptions', $capability, 'starconsults-admin-menu', 'dashboard');
	add_submenu_page( 'starconsults-admin-menu', 'Add Subscription Plan', 'Add Subscriptions Plan', $capability, 'add_Subscriptions_plan', 'add_Subscriptions_plan');
	add_submenu_page( 'starconsults-admin-menu', 'view plan', 'view plan', $capability, 'view_plan', 'view_plan');
	add_menu_page('Payment Modes', 'Payment Modes', $capability, 'payment-admin-menu', 'payment');
	add_submenu_page( 'payment-admin-menu', 'edit payment', 'edit payment', $capability, 'edit_payment', 'edit_payment');
	add_menu_page('View Purchases', ' View Purchases', $capability, 'view-purchases-admin-menu', 'view_purchases');
	//add_submenu_page( 'starconsults-admin-menu', 'Add Subscriptions', 'Add Subscriptions', $capability, 'add-Subscriptions', 'add_Subscriptions');
	//add_submenu_page( 'vitalPartners-admin-menu', 'Add Location', 'Add Locations', 'manage_options', 'add-location', 'add_locations');
	//add_submenu_page( 'vitalPartners-admin-menu', 'Add Vanues', 'Add Venues', 'manage_options', 'add-vanue', 'add_vanues');
	//add_submenu_page( 'vitalPartners-admin-menu', 'Add position', 'Add positions', 'manage_options', 'add-position', 'add_positions');
	//add_submenu_page( 'vitalPartners-admin-menu', 'Applied jobs', 'Applied jobs', 'manage_options', 'applied_job', 'applied_jobs');
	add_menu_page('Social-admin-menu', ' Social Media', $capability, 'Social-admin-menu', 'social_links');
    add_submenu_page( 'social_links', ' ', ' ', $capability, 'edit_social_media', 'edit_social_media');

	
}

function dashboard(){
	include("dashboard.php");
}
function payment(){
	include("payment.php");
}
function edit_payment(){
	include("edit_payment.php");
}
function add_Subscriptions_plan(){
	include("add_Subscriptions_plan.php");
}
function view_plan(){
	include("view_plan.php");
}
function view_purchases(){
	include("view_purchases.php");
}
function social_links(){   
	include('social_links.php');
}
function edit_social_media(){  
	include('edit_social_media.php');
}
add_action('wp_ajax_deleteRow', 'deleteRow' );
function deleteRow(){
	global $wpdb;

	$id = $_POST['data'];
	$tableName = $_POST['tableName'];
	$delete_query = "DELETE FROM ".$tableName." WHERE plan_id = '".trim($id)."'";
	$result = $wpdb->query($delete_query);
	if($result){
		echo "true";
	}else{
		echo "false";		
	}
	
}
add_action('wp_ajax_insert', 'insert' );
function insert(){
	global $wpdb;

	$arrTableData = $_POST['data'];
	$tableName = $_POST['tableName'];
	$delete_query = " INSERT INTO ".$tableName." ".$arrTableData."";
	$result = $wpdb->query($delete_query);
	if($result){
		echo "true";
	}else{
		echo "false";		
	}
	
}
/*
	This Function gets current page number using the request url
*/

function get_pagenum() {
	$pagenum = isset( $_REQUEST['paged'] ) ? absint( $_REQUEST['paged'] ) : 0;
	
	return max( 1, $pagenum );
}
/**
 *This Function sets and returns the number of items to be displayed in per page
 *@access public
 *@return integer $per_page
 */
function get_per_page(){
	$per_page = 1;
	return $per_page;
}
function pagination( $which,$total_items,$total_pages,$per_page = 1) {

			
		$style = "<style>.tablenav-pages{padding:5px;}.tablenav-pages a {
			border-color: #E3E3E3 !important;
			-webkit-border-radius: 3px;
			border-radius: 3px;
			border: 1px solid;
			padding: 3px 6px;
			background-color:lightgray;
			color:#333;
			text-decoration: none;
			}
			.tablenav-pages a.disabled
			{
			cursor:default;
			}
			</style>";

		 $output = '<span class="displaying-num">' . sprintf( _n( '1 item', '%s items', $total_items ), number_format_i18n( $total_items ) ) . '</span>';
		$current = get_pagenum();
		
		$current_url = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		//echo $current_url;
		$current_url = remove_query_arg( array( 'hotkeys_highlight_last', 'hotkeys_highlight_first' ), $current_url );
		$page_links = array();
		$disable_first = $disable_last = '';
		if ( $current == 1 )
			$disable_first = ' disabled';
		if ( $current == $total_pages )
			$disable_last = ' disabled';

			$page_links[] = sprintf( "<a class='%s' title='%s' href='%s'>%s</a>",
			'first-page' . $disable_first,
			esc_attr__( 'Go to the first page' ),
			esc_url( remove_query_arg( 'paged', $current_url ) ),
			'&laquo;'
		);

		$page_links[] = sprintf( "<a class='%s' title='%s' href='%s'>%s</a>",
			'prev-page' . $disable_first,
			esc_attr__( 'Go to the previous page' ),
			esc_url( add_query_arg( 'paged', max( 1, $current-1 ), $current_url ) ),
			'&lsaquo;'
		);

		if ( 'bottom' == $which )
			$html_current_page = $current;
		else
			$html_current_page = sprintf( "<input class='current-page' title='%s' type='text' name='paged' value='%s' size='%d' />",
				esc_attr__( 'Current page' ),
				$current,
				strlen( $total_pages )
			);

		$html_total_pages = sprintf( "<span class='total-pages'>%s</span>", number_format_i18n( $total_pages ) );
		$page_links[] = '<span class="paging-input">' . sprintf( _x( '%1$s of %2$s', 'paging' ), $html_current_page, $html_total_pages ) . '</span>';
		// print_r($page_links);

		$page_links[] = sprintf( "<a class='%s' title='%s' href='%s'>%s</a>",
			'next-page' . $disable_last,
			esc_attr__( 'Go to the next page' ),
			esc_url( add_query_arg( 'paged', min( $total_pages, $current+1 ), $current_url ) ),
			'&rsaquo;'
		);

       //print_r($page_links);

		$page_links[] = sprintf( "<a class='%s' title='%s' href='%s'>%s</a>",
			'last-page' . $disable_last,
			esc_attr__( 'Go to the last page' ),
			esc_url( add_query_arg( 'paged', $total_pages, $current_url ) ),
			'&raquo;'
		);
		$pagination_links_class = 'pagination-links';
		if ( ! empty( $infinite_scroll ) )
			$pagination_links_class = ' hide-if-js';
		$output .= "\n<span class='$pagination_links_class'>" . join( "\n", $page_links ) . '</span>';

		if ( $total_pages )
			$page_class = $total_pages < 2 ? ' one-page' : '';
		else
			$page_class = ' no-pages';

		 //$this->_pagination = "<div class='tablenav-pages{$page_class}'>$output</div>";
		$pagination = $style."<div class='tablenav-pages{$page_class}' style='float:right;'>$output</div>";
		echo $pagination;
	}
	
add_action('wp_ajax_deletePurchaseRow', 'deletePurchaseRow' );
function deletePurchaseRow(){
	global $wpdb;

	$id = $_POST['data'];
	$tableName = $_POST['tableName'];
	$delete_query = "DELETE FROM ".$tableName." WHERE payment_id= '".trim($id)."'";
	$result = $wpdb->query($delete_query);
	if($result){
		echo "true";
	}else{
		echo "false";		
	}
	
}

 add_action( 'init', 'create_post_type' );
function create_post_type() {
  register_post_type( 'home_slider',
    array(
      'labels' => array(
        'name' => __( 'Home Slider' ),
        'singular_name' => __( 'Home Slider' )
      ),
      'public' => true,
      'has_archive' => true,
	  'supports' => array(
		'title',
		'excerpt',
		'editor',
		'thumbnail',
		'revisions'
	)
	     )
  );
} 

add_action( 'wp_ajax_siteConsultantSearch', 'wpse_showresult' );
add_action( 'wp_ajax_nopriv_siteConsultantSearch', 'wpse_showresult' );

function wpse_showresult()
{
	global $wpdb;
    $location=$_POST['loc'];
	$speciality = $_POST['specialist'];

	 
    if($location!="0" &&  $speciality!="0")
	{
         $user_query = new WP_User_Query( array( 'role' => 'consultant',  'number' => $no ,  
		  'meta_query'       => array(
        //comparison between the inner meta fields conditionals
        'relation'    => 'AND',
        //meta field condition one
        array(
            'key'          => 'Location',
            'value'        =>$location,
            'compare'      => '=',
        ),
        //meta field condition one
        array(
            'key'          => 'Specialist',
            'value'        => $speciality,
            //I think you really want != instead of NOT LIKE, fix me if I'm wrong
            //'compare'      => 'NOT LIKE',
            'compare'      => '=',
        )
    )
		 
		 ) );


	


   //echo "Last SQL-Query: {$user_query->request}";
  ?>
<ul>
<?php
   foreach ( $user_query->results as $user ) { 
    
	 // echo"<pre>";
	//   print_r($user);
   $userImage = types_render_usermeta_field( "consultants-image", array("user_id" => $user->ID,"url"=>true ));
		          
					if(empty($userImage)){
						$userImage = IMAGES_URL.'/left-video-img.png';
					 	$userImage = "http://www.starconsults.com/wp-content/uploads/2016/05/left-video-img.png";
					}
 
   ?>
      <li>
   <div class="category-img">
                                        <div class="category-content">
                                           <div class="category-detail-container">
                                              <a href="<?php echo get_bloginfo('siteurl').'/consultant/'.$user->user_login;?>" class="category-title" ><?php echo $user->first_name . ' ' . $user->last_name;?></a> 
                                           </div>
                                        </div>
										<img alt="" src="<?php echo $userImage;?>">
                                         </div>   
                                  <div class="gall-item-title"><?php echo $user->first_name . ' ' . $user->last_name;?></div>
                               </li>
<?php } }
else
	{
	?>
	<ul>
	<?php
            $taxonomy = 'ptype';
            $tax_terms = get_terms($taxonomy , 'hide_empty=0');
			 foreach ($tax_terms as $tax_term) {
                                  $term_taxonomy_id =  $tax_term ->term_id;

								   $taxonomy_slug = $tax_term ->slug;
                                   $term_id =  $tax_term ->term_id;
								   
								  $catImg = get_tax_meta($tax_term->term_id,'tf_tax_image');
	                              $imagesrc = $catImg['src']; 
								 
								 
                               ?>

     <li>
                                 <!-- <div class="gall-item-image">
                                    <div class="product-content">  
                                     <img src="images/cardiology.jpg" alt="category1">
                                       <a href="#" class="wishlist"> <i class="fa fa-heart"></i> Add to wishlist</a>
                                    </div>    
                                  </div>-->
                                   <div class="category-img">
                                        <div class="category-content">
                                           <div class="category-detail-container">
                                              <a href="<?php echo get_bloginfo('siteurl'); ?>/product-category/<?php echo $taxonomy_slug; ?>/" class="category-title" ><?php echo $tax_term->name; ?></a> 
                                           </div>
                                        </div>
                                         <!--<img alt="" src="<?php echo get_stylesheet_directory_uri(); ?>/new-home-design-files/images/cardiology.jpg"> -->
										 <?php
										 if($imagesrc)
								          {
										  ?>
										<img alt="" src="<?php echo $imagesrc; ?>">
										<?php
										  }
										  else
								          {
										?>
                                        <img alt="" src="<?php echo get_stylesheet_directory_uri(); ?>/new-home-design-files/images/cardiology.jpg">
										<?php } ?>
                                     </div>   
                                  <div class="gall-item-title"><?php echo $tax_term->name; ?></div>
                               </li>
							   <?php } ?>
<?php
	}
?>
</ul>
 <?php
    die();
 
}
?>