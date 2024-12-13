<?php
if ( ! function_exists( 'bevesi_compare_icon' ) ) {
	function bevesi_compare_icon(){
	?>

	<?php $compareheader = get_theme_mod('bevesi_header_compare',0); ?>
	<?php if($compareheader == 1){ ?>

		<?php if ( class_exists( 'KlbCompare' ) ) { ?>
			<div class="site-quick-button compare-button">
                <a href="<?php echo KlbCompare::get_page_url(); ?>" class="quick-button-link">
                  <div class="quick-button-icon">
					<i class="klb-icon-repeat"></i> 
				  </div>
                </a>
            </div><!-- quick-button -->   
		<?php } ?>
		
	<?php } ?>
	
	<?php 
	
	}
}