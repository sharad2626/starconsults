
<div class="footer clearfix">
<div class="container">
<div class="row">
	<div class="col-sm-3">
		<?php if ( is_active_sidebar( 'footer_column_1' ) ) : ?>
			<?php dynamic_sidebar( 'footer_column_1' ); ?>
		<?php endif; ?>
    </div>
    <div class="col-sm-3">
    	<?php if ( is_active_sidebar( 'footer_column_2' ) ) : ?>
			<?php dynamic_sidebar( 'footer_column_2' ); ?>
		<?php endif; ?>
    </div>
    <div class="col-sm-3">
    	<?php if ( is_active_sidebar( 'footer_column_3' ) ) : ?>
			<?php dynamic_sidebar( 'footer_column_3' ); ?>
		<?php endif; ?>
    </div>
    <div class="col-sm-3">
    	<?php if ( is_active_sidebar( 'footer_column_4' ) ) : ?>
			<?php dynamic_sidebar( 'footer_column_4' ); ?>
		<?php endif; ?>
    </div>
</div>

<div class="bottom-footer clearfix">
<?php
echo include 'connect.php';
$get_social_details_qry = "select * from tbl_social_media";
$run_get_social_details_qry = mysql_query($get_social_details_qry);
while($row = mysql_fetch_assoc($run_get_social_details_qry))
{
    $data[]=$row;
}
?>
<div class="f-right social-link">
<a href="<?php echo $data[0]['Link']; ?>" class="facebook" title="Facebook">Facebook</a>
<a href="<?php echo $data[1]['Link']; ?>" class="twiiter" title="Twiiter">Twiiter</a>
<a href="<?php echo $data[2]['Link']; ?>" class="linkedin" title="Linkedin">Linkedin</a>
<a href="<?php echo $data[3]['Link']; ?>" class="youtube" title="Youtube">Youtube</a>
</div>

<div class="f-left">
<a href="<?php echo get_site_url(); ?>/privacy-policy">Privacy Policy</a><span>|</span><a href="<?php echo get_site_url(); ?>/terms-and-conditions">Terms and Conditions</a><span>|</span><a href="<?php echo get_site_url();?>/partnership-agreement">Consultants Agreement</a>
<p>Copyright &copy; StarConsults, Inc. <?php echo date("Y");?></p>
</div>

</div>
</div>

</div>

<script type="text/javascript">
jQuery(document).ready(function() {
    var owl = jQuery(".featured-consultant-slider");
    owl.owlCarousel({
    itemsCustom : [
    [0, 1],
    [481, 1],
    [600, 2],
    [768, 3],
    [992, 4],
    [1200, 4],
    [1400, 4],
    [1600, 4]
    ],
    });
});
</script>

<?php /*?><script type="text/javascript">
$( document ).ready(function() {
	$('.hom-slider-image').bxSlider({
});
});
</script><?php */?>
<script type="text/javascript">
jQuery( document ).ready(function() {
	jQuery(".nav.navbar-nav li a.dropdown-toggle").click(function(){
		var currentParent = jQuery(this).parent();
		if(currentParent.hasClass("open")){
			currentParent.removeClass("open");
		}else{
			currentParent.addClass("open");
		}
	})
});
</script>


<?php wp_footer(); ?>
</body>
</html>