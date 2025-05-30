<?php
/**
 * footer.php
 * @package WordPress
 * @subpackage Bevesi
 * @since Bevesi 1.0
 * 
 */
 ?>
 
 
		</div><!-- main-content -->
		
		<?php bevesi_do_action( 'bevesi_before_main_footer'); ?>

		<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) { ?>
		
			<?php
			/**
			* Hook: bevesi_main_footer
			*
			* @hooked bevesi_main_footer_function - 10
			*/
			do_action( 'bevesi_main_footer' );
		
			?>
			
		<?php } ?>
		
		<?php bevesi_do_action( 'bevesi_after_main_footer'); ?>	
		
	</div><!-- page-content -->
  
	<?php wp_footer(); ?>
  
    </body>
    
    <div id="container">
        <a href="https://wa.me/5511993112353?text=Ol%C3%A1,%20vi%20seu%20an%C3%BAncio%20no%20site%20Achar%20%C3%A9%20F%C3%A1cil%20www.acharefacil.com.br%20e%20gostaria%20de%20mais%20informa%C3%A7%C3%B5es." target="_blank">
            <div class="corpo">
                <div class="painelvermelho"></div>
            </div>
        </a>
    </div>

</html>
<script src="/wp-content/themes/bevesi/assets/js/jquery.mask.js"></script>

<?php include('styles_personalizados.php') ?>
<?php include('scripts_personalizados.php') ?>
