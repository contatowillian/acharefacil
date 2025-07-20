<?php
/**
 * searchform.php
 * @package WordPress
 * @subpackage Bevesi
 * @since Bevesi 1.0
 * 
 */
 ?>

<form class="search_form">
	<input type="search" class="form-control search-input size-lg" name="s" placeholder="<?php esc_attr_e('Procure os melhores serviços próximos à você', 'bevesi') ?>" autocomplete="off">
	<input type="hidden" class='us_pos' name="us_pos">

	<button type="submit" class="btn unset search-button color-black"><i class="klb-icon-search"></i></button>
</form>
