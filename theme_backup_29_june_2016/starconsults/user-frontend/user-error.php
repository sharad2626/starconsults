<?php get_header();?>
<div class="content-page clearfix">
  <div class="container">
    <div class="main-content full-width">
      <div class="main-content-bg clearfix">
		<h3><?php _e( 'Error', 'user-frontend-td' ); ?></h3>
		<p><?php echo apply_filters( 'uf_error_messages', isset( $_GET[ 'message' ] ) ? $_GET[ 'message' ] : '' ); ?></p>
      </div>
    </div>
  </div>
</div>
<?php get_footer();?>