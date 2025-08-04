<?php
# One Click Demo Content Import
function pm_ocdi_import_files() {
    return array(
        array(
            'import_file_name'             => 'Photberry',
            'categories'                   => array('With Images'),
            'import_file_url'            => trailingslashit(get_template_directory_uri()) . 'core/import/import.xml',
            'import_widget_file_url'     => trailingslashit(get_template_directory_uri()) . 'core/import/widgets.xml',
            'import_customizer_file_url'    => trailingslashit(get_template_directory_uri()) . 'core/import/customizer.xml',
            'import_preview_image_url'     => trailingslashit(get_template_directory_uri()) . 'screenshot.jpg',
            'preview_url'                  => 'http://pixel-mafia.com/demo/wordpress-themes/photberry/',
        ),
    );
    #'import_notice'                => esc_attr__( 'After you import this demo, you will have to setup the slider separately. Slider Revolution > Import Slider. All the import files for the slider you will find in "Slider Revolution Import" folder.', 'photberry' ),
}
add_filter( 'pt-ocdi/import_files', 'pm_ocdi_import_files' );

# Remove Branding Message
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

# Disable Regenerate for Thumbs
add_filter( 'pt-ocdi/regenerate_thumbnails_in_content_import', '__return_false' );

function pm_after_activation_theme() {
	echo '
		<div class="updated">
			<p>'.esc_attr__('After activating all the recommended plugins, you can import all demo content in one-touch. Appearance > Import Demo Data.', 'photberry').'</p>
		</div>
		';
}

function pm_after_activation($oldname, $oldtheme=false) {
    add_action( 'admin_notices', 'pm_after_activation_theme' );
}
add_action("after_switch_theme", "pm_after_activation", 10 ,  2);


function pm_ocdi_after_import_setup() {
    # Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
    # $footer_menu = get_term_by( 'name', 'Footer Menu', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations', array(
            'main' => $main_menu->term_id,
        )
    );
    # 'footer' => $footer_menu->term_id,

    # Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title( 'Home Slider' );
    # $blog_page_id  = get_page_by_title( 'Blog' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    # update_option( 'page_for_posts', $blog_page_id->ID );
}
add_action( 'pt-ocdi/after_import', 'pm_ocdi_after_import_setup' );