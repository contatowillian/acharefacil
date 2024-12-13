<?php 
/*************************************************
## Bevesi Nav Menu Endpoints
*************************************************/ 

function bevesi_add_nav_menu_meta_boxes() {
	add_meta_box( 'bevesi_endpoints_nav_link', esc_html__( 'Bevesi endpoints', 'bevesi-core' ), 'bevesi_nav_menu_links' , 'nav-menus', 'side', 'low' );
}
add_action( 'admin_head-nav-menus.php', 'bevesi_add_nav_menu_meta_boxes');

function bevesi_nav_menu_links() {
	?>
	<div id="posttype-bevesi-endpoints" class="posttypediv">
		<div id="tabs-panel-bevesi-endpoints" class="tabs-panel tabs-panel-active">
			<ul id="bevesi-endpoints-checklist" class="categorychecklist form-no-clear">

				<li>
					<label class="menu-item-title">
						<input type="checkbox" class="menu-item-checkbox" name="menu-item[-1][menu-item-object-id]" value="0" /> <?php esc_html_e('Elementor Template', 'bevesi-core'); ?>
					</label>
					<input type="hidden" class="menu-item-type" name="menu-item[-1][menu-item-type]" value="custom" />
					<input type="hidden" class="menu-item-title" name="menu-item[-1][menu-item-title]" value="Elementor Template" />
					<input type="hidden" class="menu-item-url" name="menu-item[-1][menu-item-url]" value="#" />
					<input type="hidden" class="menu-item-classes" name="menu-item[-1][menu-item-classes]" value="klb-elementor-template" />
				</li>

			</ul>
		</div>
		<p class="button-controls">
			<span class="list-controls">
				<a href="<?php echo esc_url( admin_url( 'nav-menus.php?page-tab=all&selectall=1#posttype-bevesi-endpoints' ) ); ?>" class="select-all"><?php esc_html_e( 'Select all', 'bevesi-core' ); ?></a>
			</span>
			<span class="add-to-menu">
				<button type="submit" class="button-secondary submit-add-to-menu right" value="<?php esc_attr_e( 'Add to menu', 'bevesi-core' ); ?>" name="add-post-type-menu-item" id="submit-posttype-bevesi-endpoints"><?php esc_html_e( 'Add to menu', 'bevesi-core' ); ?></button>
				<span class="spinner"></span>
			</span>
		</p>
	</div>
	<?php
}

/*************************************************
## Mega Menu
*************************************************/ 
require_once( __DIR__ . '/mega-menu/mega-menu.php' );