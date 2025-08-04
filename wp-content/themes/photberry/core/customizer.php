<?php
/*
 * Created by Pixel-Mafia
 * www.pixel-mafia.com
*/

$photberry_customizer_default_values = array(
	'header_type' => 'always_show',
	'header_type_mobile' => 'show_by_click',

    'logo_type' => 'image_logo',
    'logo_image' => get_template_directory_uri() . '/img/logo.png',
	'logo_image_transparent' => get_template_directory_uri() . '/img/logo_transparent.png',
    'logo_retina' => true,

	'logo_text_caption' => 'Text Logo',
    'logo_text_font' => 'Oswald',
    'logo_text_size' => '26',
    'logo_text_weight' => '400',
    'logo_text_style_uppercase' => true,
    'logo_text_style_italic' => false,

	'logo_padding_top' => '40',
    'logo_padding_bottom' => '82',

	'header_menu_font_family' => 'Oswald',
    'header_menu_font_size' => '16',
	'header_menu_line_height' => '19',
    'header_menu_font_weight' => '400',
    'header_menu_uppercase' => true,
    'header_menu_italic' => false,
    'header_sub_menu_font_family' => 'Oswald',
    'header_sub_menu_font_size' => '16',

    'page_title_status' => 'show',
	'page_title_position' => 'center',
    'post_title_status' => 'show',
    'post_tags_status' => 'show',
    'share_buttons_status' => 'show',
    'post_navigation_status' => 'show',

    'sidebar_position' => 'photberry_right_sidebar',
    'main_font_family' => 'Roboto',
    'main_font_size' => '14',
    'main_line_height' => '21',
    'main_font_weight' => '400',
	'dropcap_font_size' => '30',
	'dropcap_line_height' => '32',
	'dropcap_font_weight' => '500',
	'paragraph_margin' => '16',

    'headings_font_family' => 'Oswald',
	'headings_font_weight' => '400',

    'h1_font_size' => '50',
    'h1_line_height' => '60',
    'h2_font_size' => '40',
    'h2_line_height' => '50',
    'h3_font_size' => '30',
    'h3_line_height' => '40',
    'h4_font_size' => '26',
    'h4_line_height' => '36',
    'h5_font_size' => '16',
    'h5_line_height' => '26',
    'h6_font_size' => '13',
    'h6_line_height' => '23',

    'footer_facebook' => '',
    'footer_twitter' => '',
    'footer_linkedin' => '',
    'footer_youtube' => '',
    'footer_instagram' => '',
    'footer_pinterest' => '',
    'footer_tumbl' => '',
    'footer_flickr' => '',
    'footer_vk' => '',
    'footer_dribbble' => '',
    'footer_vimeo' => '',
    'footer_status' => 'show',
	'footer_columns' => '4',
    'footer_copyright_text' => 'Photberry © 2017. All Rights Reserved',
    'footer_advanced_line' => 'Designed by Pixel-Mafia',

	'color_main' => '#ff3821',
	'bg_body' => '#f7f7f7',
	'bg_sidebar' => '#ffffff',
	'color_headings' => '#202a34',
	'color_text' => '#454e57',
	'color_additional' => '#ffffff',
	'color_404' => '#ffffff',
	'color_cs' => '#ffffff',
	'color_pp' => '#ffffff',
	'bg_input' => '#eeeeee',
	'color_input' => '#202a34',
	'bg_button' => '#202a34',
	'color_button' => '#ffffff',
	'bg_menu' => '#ffffff',
	'color_menu' => '#202a34',
	'color_menu_active' => '#ff3821',
	'color_menu_transparent' => '#ffffff',
	'color_menu_active_transparent' => '#ff3821',
	'bg_footer' => '#202a34',
	'color_footer' => '#79838e',
	'color_footer_additional' => '#ffffff',
	'color_footer_headings' => '#ffffff',

    'featured_posts_status' => 'enabled',
    'featured_posts_orderby' => 'rand',
    'featured_posts_numberposts' => '2',
    'featured_posts_fimage_status' => 'show',
    'featured_posts_meta_status' => 'show',
    'featured_posts_excerpt_status' => 'show',

	'404_bg_image' => get_template_directory_uri() . '/img/null.png',
    '404_text_color' => '#ffffff',

	'cs_bg_image' => get_template_directory_uri() . '/img/null.png',
    'cs_text_color' => '#ffffff',

	'pp_bg_image' => get_template_directory_uri() . '/img/null.png',
    'pp_text_color' => '#ffffff',
    'photberry_flickr_id' => '149482210@N04',

	'responsive_status' => 'on',
	'albums_pt_name' => 'Albums',
	'albums_pt_slug' => 'albums',
	'albums_pt_tax' => 'albums-category',
	'portfolio_pt_name' => 'Portfolio',
	'portfolio_pt_slug' => 'portfolio',
	'portfolio_pt_tax' => 'portfolio-category',
	'code_before_head' => '',


    'posts_featured_image' => 'show',

    /* WooCommerce */
    'shop_sidebar_position' => 'photberry_right_sidebar',
    'shop_sale_label' => 'on',
    'cart_in_header' => 'show',
    'shop_lightbox' => 'on',
    'shop_zoom' => 'on',
    'shop_slider' => 'on',

    'shop_color_message' => '#ff3821',
    'shop_color_info' => '#ff3821',
    'shop_color_error' => '#ff3821',
    'shop_color_required' => '#ff3821',
    'shop_color_remove' => '#ff3821',
);

# Register Customizer
add_action('customize_register', 'photberry_customizer_register');
function photberry_customizer_register($wp_customize)
{
	global $photberry_customizer_default_values;

    ###################################################
    ############# Header Settings Section #############
    ###################################################
    $wp_customize->add_section('photberry_header_settings',
        array(
            'title' => esc_attr__('Header Settings', 'photberry')
        )
    );

    # Header Type
    $wp_setting_name = 'header_type';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Header Style (for Desktop)', 'photberry'),
            'section' => 'photberry_header_settings',
            'settings' => $wp_setting_name,
            'type' => 'select',
            'choices' => array('always_show' => 'Always Show', 'show_by_click' => 'Open by Button'),
        )
    ));

    # Header Type Mobile
    $wp_setting_name = 'header_type_mobile';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Header Style (for Mobile)', 'photberry'),
            'section' => 'photberry_header_settings',
            'settings' => $wp_setting_name,
            'type' => 'select',
            'choices' => array('always_show' => 'Always Show', 'show_by_click' => 'Open by Button'),
        )
    ));

    # Logo Type (Text or Image)
    $wp_setting_name = 'logo_type';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Logo Type', 'photberry'),
            'section' => 'photberry_header_settings',
            'settings' => $wp_setting_name,
            'type' => 'select',
            'choices' => array('image_logo' => 'Image', 'text_logo' => 'Text'),
        )
    ));

    # Logo (Selected Image)
    $wp_setting_name = 'logo_image';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Logo Image', 'photberry'),
            'section' => 'photberry_header_settings',
            'settings' => $wp_setting_name,
            'description' => '<i class="photberry_dependency_customizer" data-dependency-id="logo_type" data-dependency-val="image_logo"></i>',
        )
    ));

    # Logo (Selected Image)
    $wp_setting_name = 'logo_image_transparent';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Logo Image (Transparent Menu)', 'photberry'),
            'section' => 'photberry_header_settings',
            'settings' => $wp_setting_name,
            'description' => '<i class="photberry_dependency_customizer" data-dependency-id="logo_type" data-dependency-val="image_logo"></i>',
        )
    ));

    # Logo Retina
    $wp_setting_name = 'logo_retina';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Logo Retina', 'photberry'),
            'section' => 'photberry_header_settings',
            'description' => '<i class="photberry_dependency_customizer" data-dependency-id="logo_type" data-dependency-val="image_logo"></i>By activating this option you must use an image with 2х size more than you wish to show.',
            'settings' => $wp_setting_name,
            'type' => 'checkbox',
        )
    ));

    # Logo Text Caption
    $wp_setting_name = 'logo_text_caption';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Logo Text', 'photberry'),
            'section' => 'photberry_header_settings',
            'settings' => $wp_setting_name,
            'description' => '<i class="photberry_dependency_customizer" data-dependency-id="logo_type" data-dependency-val="text_logo"></i>',
        )
    ));

    # Logo Text Font
    $wp_setting_name = 'logo_text_font';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Logo Font', 'photberry'),
            'section' => 'photberry_header_settings',
            'settings' => $wp_setting_name,
            'type' => 'select',
            'choices' => photberry_get_all_fonts_name(),
            'description' => '<i class="photberry_dependency_customizer" data-dependency-id="logo_type" data-dependency-val="text_logo"></i>',
        )
    ));

    # Logo Text Size
    $wp_setting_name = 'logo_text_size';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Logo Size, px', 'photberry'),
            'section' => 'photberry_header_settings',
            'settings' => $wp_setting_name,
            'description' => '<i class="photberry_dependency_customizer" data-dependency-id="logo_type" data-dependency-val="text_logo"></i>',
        )
    ));

    # Logo Text Weight
    $wp_setting_name = 'logo_text_weight';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Logo Font Weight', 'photberry'),
            'section' => 'photberry_header_settings',
            'settings' => $wp_setting_name,
            'description' => '<i class="photberry_dependency_customizer" data-dependency-id="logo_type" data-dependency-val="text_logo"></i>Please keep in mind that most fonts do not support such exotic thicknesses as the 100. The most common values: 300, 400, 600, 700.',
            'type' => 'select',
            'choices' => array('100' => '100', '200' => '200', '300' => '300', '400' => '400', '500' => '500', '600' => '600', '700' => '700', '800' => '800', '900' => '900'),
        )
    ));

    # Logo Text Style Uppercase
    $wp_setting_name = 'logo_text_style_uppercase';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Logo Uppercase', 'photberry'),
            'section' => 'photberry_header_settings',
            'settings' => $wp_setting_name,
            'type' => 'checkbox',
            'description' => '<i class="photberry_dependency_customizer" data-dependency-id="logo_type" data-dependency-val="text_logo"></i>',
        )
    ));

    # Logo Text Style Italic
    $wp_setting_name = 'logo_text_style_italic';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Logo Italic', 'photberry'),
            'section' => 'photberry_header_settings',
            'settings' => $wp_setting_name,
            'type' => 'checkbox',
            'description' => '<i class="photberry_dependency_customizer" data-dependency-id="logo_type" data-dependency-val="text_logo"></i>',
        )
    ));

    # Header Padding Top
    $wp_setting_name = 'logo_padding_top';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Logo Padding Top, px', 'photberry'),
            'section' => 'photberry_header_settings',
            'settings' => $wp_setting_name,
        )
    ));

    # Header Padding Bottom
    $wp_setting_name = 'logo_padding_bottom';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Logo Padding Bottom, px', 'photberry'),
            'section' => 'photberry_header_settings',
            'settings' => $wp_setting_name,
        )
    ));

    # Header Menu Font Family
    $wp_setting_name = 'header_menu_font_family';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Header Menu Font Family', 'photberry'),
            'section' => 'photberry_header_settings',
            'settings' => $wp_setting_name,
            'type' => 'select',
            'choices' => photberry_get_all_fonts_name(),
        )
    ));

    # Header Menu Font-Size
    $wp_setting_name = 'header_menu_font_size';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Header Menu Font-Size, px', 'photberry'),
            'section' => 'photberry_header_settings',
            'settings' => $wp_setting_name,
        )
    ));

    # Header Menu Line-Height
    $wp_setting_name = 'header_menu_line_height';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Header Menu Line-Height, px', 'photberry'),
            'section' => 'photberry_header_settings',
            'settings' => $wp_setting_name,
        )
    ));

    # Header Menu Weight
    $wp_setting_name = 'header_menu_font_weight';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Header Menu Font Weight', 'photberry'),
            'section' => 'photberry_header_settings',
            'settings' => $wp_setting_name,
            'description' => 'Please keep in mind that most fonts do not support such exotic thicknesses as the 100. The most common values: 300, 400, 600, 700.',
            'type' => 'select',
            'choices' => array('100' => '100', '200' => '200', '300' => '300', '400' => '400', '500' => '500', '600' => '600', '700' => '700', '800' => '800', '900' => '900'),
        )
    ));

    # Header Menu Uppercase
    $wp_setting_name = 'header_menu_uppercase';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Header Menu Uppercase', 'photberry'),
            'section' => 'photberry_header_settings',
            'settings' => $wp_setting_name,
            'type' => 'checkbox',
        )
    ));

    # Header Menu Italic
    $wp_setting_name = 'header_menu_italic';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Header Menu Italic', 'photberry'),
            'section' => 'photberry_header_settings',
            'settings' => $wp_setting_name,
            'type' => 'checkbox',
        )
    ));

    # Header Sub Menu Font Family
    $wp_setting_name = 'header_sub_menu_font_family';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Header Sub Menu Font Family', 'photberry'),
            'section' => 'photberry_header_settings',
            'settings' => $wp_setting_name,
            'type' => 'select',
            'choices' => photberry_get_all_fonts_name(),
        )
    ));

    # Header Sub Menu Font-Size
    $wp_setting_name = 'header_sub_menu_font_size';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Header Sub Menu Font-Size, px', 'photberry'),
            'section' => 'photberry_header_settings',
            'settings' => $wp_setting_name,
        )
    ));

    ###################################################
    ########### Page Title Settings Section ###########
    ###################################################
    $wp_customize->add_section('photberry_page_title_settings',
        array(
            'title' => esc_attr__('Page Title', 'photberry')
        )
    );

    # Page Title
    $wp_setting_name = 'page_title_status';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Page Title', 'photberry'),
            'section' => 'photberry_page_title_settings',
            'settings' => $wp_setting_name,
            'type' => 'select',
            'choices' => array(
                'show' => esc_html('Show', 'photberry'),
                'hide' => esc_html__('Hide', 'photberry')
            ),
        )
    ));

    $wp_setting_name = 'page_title_position';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Page Title', 'photberry'),
            'section' => 'photberry_page_title_settings',
            'settings' => $wp_setting_name,
            'type' => 'select',
            'choices' => array(
                'left' => esc_html('Left', 'photberry'),
                'center' => esc_html__('Center', 'photberry'),
				'right' => esc_html__('Right', 'photberry')
            ),
        )
    ));

    #################################################
    ############## Post Settings Section ############
    #################################################
    $wp_customize->add_section('photberry_post_settings',
        array(
            'title' => esc_attr__('Post Settings', 'photberry')
        )
    );

    # Post Title Status
    $wp_setting_name = 'post_title_status';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Post Title', 'photberry'),
            'section' => 'photberry_post_settings',
            'settings' => $wp_setting_name,
            'type' => 'select',
            'choices' => array('show' => 'Show', 'hide' => 'Hide'),
        )
    ));

    # Post Tags
    $wp_setting_name = 'post_tags_status';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Post Tags', 'photberry'),
            'section' => 'photberry_post_settings',
            'settings' => $wp_setting_name,
            'type' => 'select',
            'choices' => array('show' => 'Show', 'hide' => 'Hide'),
        )
    ));

    # Share Buttons
    $wp_setting_name = 'share_buttons_status';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Share Buttons', 'photberry'),
            'section' => 'photberry_post_settings',
            'settings' => $wp_setting_name,
            'type' => 'select',
            'choices' => array('show' => 'Show', 'hide' => 'Hide'),
        )
    ));

    # Share Buttons
    $wp_setting_name = 'posts_featured_image';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Posts Featured Block', 'photberry'),
            'section' => 'photberry_post_settings',
            'settings' => $wp_setting_name,
            'type' => 'select',
            'choices' => array('show' => 'Show', 'hide' => 'Hide'),
        )
    ));

    # Posts Navigation
    $wp_setting_name = 'post_navigation_status';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Posts Navigation', 'photberry'),
            'section' => 'photberry_post_settings',
            'settings' => $wp_setting_name,
            'type' => 'select',
            'choices' => array('show' => 'Show', 'hide' => 'Hide'),
        )
    ));

    ############################################
    ############## Social Buttons ##############
    ############################################
    $wp_customize->add_section('pixels_socials',
        array(
            'title' => esc_attr('Social Buttons', 'photberry')
        )
    );

    # Facebook Button
    $wp_setting_name = 'footer_facebook';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Facebook', 'photberry'),
            'section' => 'pixels_socials',
            'settings' => $wp_setting_name,
        )
    ));

    # Twitter Button
    $wp_setting_name = 'footer_twitter';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Twitter', 'photberry'),
            'section' => 'pixels_socials',
            'settings' => $wp_setting_name,
        )
    ));

    # LinkedIn Button
    $wp_setting_name = 'footer_linkedin';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('LinkedIn', 'photberry'),
            'section' => 'pixels_socials',
            'settings' => $wp_setting_name,
        )
    ));

    # YouTube Button
    $wp_setting_name = 'footer_youtube';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('YouTube', 'photberry'),
            'section' => 'pixels_socials',
            'settings' => $wp_setting_name,
        )
    ));

    # Instagram Button
    $wp_setting_name = 'footer_instagram';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Instagram', 'photberry'),
            'section' => 'pixels_socials',
            'settings' => $wp_setting_name,
        )
    ));

    # Pinterest Button
    $wp_setting_name = 'footer_pinterest';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Pinterest', 'photberry'),
            'section' => 'pixels_socials',
            'settings' => $wp_setting_name,
        )
    ));

    # Tumblr Button
    $wp_setting_name = 'footer_tumbl';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Tumblr', 'photberry'),
            'section' => 'pixels_socials',
            'settings' => $wp_setting_name,
        )
    ));

    # Flickr Button
    $wp_setting_name = 'footer_flickr';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Flickr', 'photberry'),
            'section' => 'pixels_socials',
            'settings' => $wp_setting_name,
        )
    ));

    # VK Button
    $wp_setting_name = 'footer_vk';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('VK', 'photberry'),
            'section' => 'pixels_socials',
            'settings' => $wp_setting_name,
        )
    ));

    # Dribbble Button
    $wp_setting_name = 'footer_dribbble';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Dribbble', 'photberry'),
            'section' => 'pixels_socials',
            'settings' => $wp_setting_name,
        )
    ));

    # Vimeo Button
    $wp_setting_name = 'footer_vimeo';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Vimeo', 'photberry'),
            'section' => 'pixels_socials',
            'settings' => $wp_setting_name,
        )
    ));

    ###################################################
    ############## Footer Settings Section ############
    ###################################################
    $wp_customize->add_section('photberry_footer_settings',
        array(
            'title' => esc_attr__('Footer Settings', 'photberry')
        )
    );

    # Footer Visibility
    $wp_setting_name = 'footer_status';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Footer Widgets Area', 'photberry'),
            'section' => 'photberry_footer_settings',
            'settings' => $wp_setting_name,
            'type' => 'select',
            'choices' => array('show' => 'Show', 'hide' => 'Hide'),
        )
    ));

	# Footer Columns
    $wp_setting_name = 'footer_columns';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Number of Widgets Columns', 'photberry'),
            'section' => 'photberry_footer_settings',
            'settings' => $wp_setting_name,
            'type' => 'select',
            'choices' => array('3' => '3 Columns', '4' => '4 Columns'),
        )
    ));

    # Footer Copyright Text
    $wp_setting_name = 'footer_copyright_text';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> ''));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Footer Copyright Text', 'photberry'),
            'section' => 'photberry_footer_settings',
            'settings' => $wp_setting_name,
        )
    ));

    # Advanced Info Line
    $wp_setting_name = 'footer_advanced_line';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> ''));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Advanced Footer Information Line', 'photberry'),
            'section' => 'photberry_footer_settings',
            'settings' => $wp_setting_name,
        )
    ));

    ###################################################
    ################# Sidebars Section ################
    ###################################################
    $wp_customize->add_section('photberry_sidebars_settings',
        array(
            'title' => esc_attr__('Sidebars', 'photberry')
        )
    );

    # Sidebar Position
    $wp_setting_name = 'sidebar_position';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Sidebar Position', 'photberry'),
            'section' => 'photberry_sidebars_settings',
            'settings' => $wp_setting_name,
            'type' => 'select',
            'choices' => array('photberry_left_sidebar' => 'Left', 'photberry_right_sidebar' => 'Right', 'photberry_no_sidebar' => 'None'),
        )
    ));

    ###################################################
    ############### Typography Section ################
    ###################################################
    $wp_customize->add_section('photberry_typography_settings',
        array(
            'title' => esc_attr__('Typography', 'photberry')
        )
    );

    # Main Font Family
    $wp_setting_name = 'main_font_family';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Main Font Family', 'photberry'),
            'section' => 'photberry_typography_settings',
            'settings' => $wp_setting_name,
            'type' => 'select',
            'choices' => photberry_get_all_fonts_name(),
        )
    ));

    # Main Font-Size
    $wp_setting_name = 'main_font_size';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Main Font-Size, px', 'photberry'),
            'section' => 'photberry_typography_settings',
            'settings' => $wp_setting_name,
        )
    ));

    # Main Line-Height
    $wp_setting_name = 'main_line_height';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Main Line-Height, px', 'photberry'),
            'section' => 'photberry_typography_settings',
            'settings' => $wp_setting_name,
        )
    ));

    # Main Font Weight
    $wp_setting_name = 'main_font_weight';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Main Font Weight', 'photberry'),
            'section' => 'photberry_typography_settings',
            'settings' => $wp_setting_name,
            'description' => 'Please keep in mind that most fonts do not support such exotic thicknesses as the 100. The most common values: 300, 400, 600, 700.',
            'type' => 'select',
            'choices' => array('100' => '100', '200' => '200', '300' => '300', '400' => '400', '500' => '500', '600' => '600', '700' => '700', '800' => '800', '900' => '900'),
        )
    ));

    # Dropcap Font size
    $wp_setting_name = 'dropcap_font_size';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Dropcap Font Size, px', 'photberry'),
            'section' => 'photberry_typography_settings',
            'settings' => $wp_setting_name,
        )
    ));

    # Dropcap Line Height
    $wp_setting_name = 'dropcap_line_height';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Dropcap Line-Height, px', 'photberry'),
            'section' => 'photberry_typography_settings',
            'settings' => $wp_setting_name,
        )
    ));

    # Dropcap Font Weight
    $wp_setting_name = 'dropcap_font_weight';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Dropcap Font Weight', 'photberry'),
            'section' => 'photberry_typography_settings',
            'settings' => $wp_setting_name,
            'description' => 'Please keep in mind that most fonts do not support such exotic thicknesses as the 100. The most common values: 300, 400, 600, 700.',
            'type' => 'select',
            'choices' => array('100' => '100', '200' => '200', '300' => '300', '400' => '400', '500' => '500', '600' => '600', '700' => '700', '800' => '800', '900' => '900'),
        )
    ));


    # Paragraph Margin
    $wp_setting_name = 'paragraph_margin';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Default Paragraph Margin', 'photberry'),
            'section' => 'photberry_typography_settings',
            'settings' => $wp_setting_name,
        )
    ));

    # Alternate Font Family
    $wp_setting_name = 'headings_font_family';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Headings Font Family', 'photberry'),
            'section' => 'photberry_typography_settings',
            'settings' => $wp_setting_name,
            'type' => 'select',
            'choices' => photberry_get_all_fonts_name(),
        )
    ));

    $wp_setting_name = 'headings_font_weight';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Headings Font Weight', 'photberry'),
            'section' => 'photberry_typography_settings',
            'settings' => $wp_setting_name,
            'description' => 'Please keep in mind that most fonts do not support such exotic thicknesses as the 100. The most common values: 300, 400, 600, 700.',
            'type' => 'select',
            'choices' => array('100' => '100', '200' => '200', '300' => '300', '400' => '400', '500' => '500', '600' => '600', '700' => '700', '800' => '800', '900' => '900'),
        )
    ));

    # H1 Font Size
    $wp_setting_name = 'h1_font_size';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('H1 Font Size, px', 'photberry'),
            'section' => 'photberry_typography_settings',
            'settings' => $wp_setting_name,
        )
    ));

    # H1 Line Height
    $wp_setting_name = 'h1_line_height';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('H1 Line Height, px', 'photberry'),
            'section' => 'photberry_typography_settings',
            'settings' => $wp_setting_name,
        )
    ));

    # H2 Font Size
    $wp_setting_name = 'h2_font_size';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('H2 Font Size, px', 'photberry'),
            'section' => 'photberry_typography_settings',
            'settings' => $wp_setting_name,
        )
    ));

    # H2 Line Height
    $wp_setting_name = 'h2_line_height';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('H2 Line Height, px', 'photberry'),
            'section' => 'photberry_typography_settings',
            'settings' => $wp_setting_name,
        )
    ));

    # H3 Font Size
    $wp_setting_name = 'h3_font_size';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('H3 Font Size, px', 'photberry'),
            'section' => 'photberry_typography_settings',
            'settings' => $wp_setting_name,
        )
    ));

    # H3 Line Height
    $wp_setting_name = 'h3_line_height';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('H3 Line Height, px', 'photberry'),
            'section' => 'photberry_typography_settings',
            'settings' => $wp_setting_name,
        )
    ));

    # H4 Font Size
    $wp_setting_name = 'h4_font_size';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('H4 Font Size, px', 'photberry'),
            'section' => 'photberry_typography_settings',
            'settings' => $wp_setting_name,
        )
    ));

    # H4 Line Height
    $wp_setting_name = 'h4_line_height';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('H4 Line Height, px', 'photberry'),
            'section' => 'photberry_typography_settings',
            'settings' => $wp_setting_name,
        )
    ));

    # H5 Font Size
    $wp_setting_name = 'h5_font_size';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('H5 Font Size, px', 'photberry'),
            'section' => 'photberry_typography_settings',
            'settings' => $wp_setting_name,
        )
    ));

    # H5 Line Height
    $wp_setting_name = 'h5_line_height';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('H5 Line Height, px', 'photberry'),
            'section' => 'photberry_typography_settings',
            'settings' => $wp_setting_name,
        )
    ));

    # H6 Font Size
    $wp_setting_name = 'h6_font_size';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('H6 Font Size, px', 'photberry'),
            'section' => 'photberry_typography_settings',
            'settings' => $wp_setting_name,
        )
    ));

    # H6 Line Height
    $wp_setting_name = 'h6_line_height';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('H6 Line Height, px', 'photberry'),
            'section' => 'photberry_typography_settings',
            'settings' => $wp_setting_name,
        )
    ));

    ###################################################
    ############## Color Settings Section #############
    ###################################################
    $wp_customize->add_section('photberry_color_settings',
        array(
            'title' => esc_attr__('Color Settings', 'photberry')
        )
    );

    # Main Theme Color
    $wp_setting_name = 'color_main';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Theme Color', 'photberry'),
            'section' => 'photberry_color_settings',
            'settings' => $wp_setting_name,
        )
    ));

    # Body Background Color
    $wp_setting_name = 'bg_body';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Body Background', 'photberry'),
            'section' => 'photberry_color_settings',
            'settings' => $wp_setting_name,
        )
    ));

    # Sidebar Background Color
    $wp_setting_name = 'bg_sidebar';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Sidebar Background', 'photberry'),
            'section' => 'photberry_color_settings',
            'settings' => $wp_setting_name,
        )
    ));

    # Headings Color
    $wp_setting_name = 'color_headings';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Headings Color', 'photberry'),
            'section' => 'photberry_color_settings',
            'settings' => $wp_setting_name,
        )
    ));

    # Text Color
    $wp_setting_name = 'color_text';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Text Color', 'photberry'),
            'section' => 'photberry_color_settings',
            'settings' => $wp_setting_name,
        )
    ));

    # Additional Text Color
    $wp_setting_name = 'color_additional';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Additional Text Color', 'photberry'),
            'section' => 'photberry_color_settings',
            'settings' => $wp_setting_name,
        )
    ));

    # 404 Text Color
    $wp_setting_name = 'color_404';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('404 Page Text Color', 'photberry'),
            'section' => 'photberry_color_settings',
            'settings' => $wp_setting_name,
        )
    ));

    # CS Text Color
    $wp_setting_name = 'color_cs';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Coming Soon Text Color', 'photberry'),
            'section' => 'photberry_color_settings',
            'settings' => $wp_setting_name,
        )
    ));

    # PP Text Color
    $wp_setting_name = 'color_pp';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Password Protected Text Color', 'photberry'),
            'section' => 'photberry_color_settings',
            'settings' => $wp_setting_name,
        )
    ));

    # Input Background Color
    $wp_setting_name = 'bg_input';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Input Background', 'photberry'),
            'section' => 'photberry_color_settings',
            'settings' => $wp_setting_name,
        )
    ));

    # Input Color
    $wp_setting_name = 'color_input';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Input Color', 'photberry'),
            'section' => 'photberry_color_settings',
            'settings' => $wp_setting_name,
        )
    ));

    # Button Background Color
    $wp_setting_name = 'bg_button';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Button Background', 'photberry'),
            'section' => 'photberry_color_settings',
            'settings' => $wp_setting_name,
        )
    ));

    # Button Color
    $wp_setting_name = 'color_button';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Button Color', 'photberry'),
            'section' => 'photberry_color_settings',
            'settings' => $wp_setting_name,
        )
    ));

    # Menu Background Color
    $wp_setting_name = 'bg_menu';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Menu Background', 'photberry'),
            'section' => 'photberry_color_settings',
            'settings' => $wp_setting_name,
        )
    ));

    # Menu Color
    $wp_setting_name = 'color_menu';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Menu Color', 'photberry'),
            'section' => 'photberry_color_settings',
            'settings' => $wp_setting_name,
        )
    ));

    # Menu Active Color
    $wp_setting_name = 'color_menu_active';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Menu Active Color', 'photberry'),
            'section' => 'photberry_color_settings',
            'settings' => $wp_setting_name,
        )
    ));

    # Transparent Menu Color
    $wp_setting_name = 'color_menu_transparent';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Transparent Menu Color', 'photberry'),
            'section' => 'photberry_color_settings',
            'settings' => $wp_setting_name,
        )
    ));

    # Transparent Menu Active Color
    $wp_setting_name = 'color_menu_active_transparent';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Transparent Menu Active Color', 'photberry'),
            'section' => 'photberry_color_settings',
            'settings' => $wp_setting_name,
        )
    ));

    # Footer Background Color
    $wp_setting_name = 'bg_footer';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Footer Background', 'photberry'),
            'section' => 'photberry_color_settings',
            'settings' => $wp_setting_name,
        )
    ));

    # Footer Color
    $wp_setting_name = 'color_footer';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Footer Color', 'photberry'),
            'section' => 'photberry_color_settings',
            'settings' => $wp_setting_name,
        )
    ));

    # Footer Color Additional
    $wp_setting_name = 'color_footer_additional';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Footer Additional Color', 'photberry'),
            'section' => 'photberry_color_settings',
            'settings' => $wp_setting_name,
        )
    ));

    # Footer Headings Color
    $wp_setting_name = 'color_footer_headings';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Footer Headings Color', 'photberry'),
            'section' => 'photberry_color_settings',
            'settings' => $wp_setting_name,
        )
    ));


    ###################################################
    ########### Blog Featured Posts Section ###########
    ###################################################
    $wp_customize->add_section('photberry_featured_posts',
        array(
            'title' => esc_attr__('Blog Featured Posts', 'photberry')
        )
    );

    # Featured Posts Status
    $wp_setting_name = 'featured_posts_status';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Featured Posts Status', 'photberry'),
            'section' => 'photberry_featured_posts',
            'settings' => $wp_setting_name,
            'type' => 'select',
            'choices' => array('enabled' => 'Enabled', 'disabled' => 'Disabled'),
        )
    ));

    # Featured Posts Order By
    $wp_setting_name = 'featured_posts_orderby';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Featured Posts Order By', 'photberry'),
            'section' => 'photberry_featured_posts',
            'settings' => $wp_setting_name,
            'type' => 'select',
            'choices' => array('rand' => 'Random', 'date' => 'Date'),
        )
    ));

    # Featured Posts Number
    $wp_setting_name = 'featured_posts_numberposts';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Number of Posts', 'photberry'),
            'section' => 'photberry_featured_posts',
            'settings' => $wp_setting_name,
            'type' => 'select',
            'choices' => array('2' => '2', '3' => '3', '4' => '4'),
        )
    ));

    # Featured Posts Feature Image
    $wp_setting_name = 'featured_posts_fimage_status';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Feature Image', 'photberry'),
            'section' => 'photberry_featured_posts',
            'settings' => $wp_setting_name,
            'type' => 'select',
            'choices' => array('show' => 'Show', 'hide' => 'Hide'),
        )
    ));

    # Featured Posts Meta
    $wp_setting_name = 'featured_posts_meta_status';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Post Meta', 'photberry'),
            'section' => 'photberry_featured_posts',
            'settings' => $wp_setting_name,
            'type' => 'select',
            'choices' => array('show' => 'Show', 'hide' => 'Hide'),
        )
    ));

    # Featured Posts Excerpt
    $wp_setting_name = 'featured_posts_excerpt_status';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Excerpt', 'photberry'),
            'section' => 'photberry_featured_posts',
            'settings' => $wp_setting_name,
            'type' => 'select',
            'choices' => array('show' => 'Show', 'hide' => 'Hide'),
        )
    ));

    ###################################################
    ################ Error 404 Section ################
    ###################################################
    $wp_customize->add_section('photberry_error404_page_settings',
        array(
            'title' => esc_attr__('Error 404 Page', 'photberry')
        )
    );

    # 404 Page Backgroung Image
    $wp_setting_name = '404_bg_image';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Background Image', 'photberry'),
            'section' => 'photberry_error404_page_settings',
            'settings' => $wp_setting_name,
        )
    ));

    ###################################################
    #################### CS Section ###################
    ###################################################
    $wp_customize->add_section('photberry_cs_page_settings',
        array(
            'title' => esc_attr__('Coming Soon Page', 'photberry')
        )
    );

    # Coming Soon Page Backgroung Image
    $wp_setting_name = 'cs_bg_image';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Background Image', 'photberry'),
            'section' => 'photberry_cs_page_settings',
            'settings' => $wp_setting_name,
        )
    ));

    ###################################################
    #################### PP Section ###################
    ###################################################
    $wp_customize->add_section('photberry_pp_page_settings',
        array(
            'title' => esc_attr__('Password Protected Page', 'photberry')
        )
    );

    # Coming Soon Page Backgroung Image
    $wp_setting_name = 'pp_bg_image';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Background Image', 'photberry'),
            'section' => 'photberry_pp_page_settings',
            'settings' => $wp_setting_name,
        )
    ));

    #######################################################
    ################# Photostream Section #################
    #######################################################
    $wp_customize->add_section('photberry_photostream',
        array(
            'title' => esc_attr('Photostream', 'photberry')
        )
    );

    # Flickr ID
    $wp_setting_name = 'photberry_flickr_id';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Your Flickr ID' , 'photberry'),
            'section' => 'photberry_photostream',
            'settings' => $wp_setting_name,
        )
    ));

    #######################################################
    ############## Custom Post Types Section ##############
    #######################################################
    $wp_customize->add_section('photberry_custom_post_types',
        array(
            'title' => esc_attr('Advanced', 'photberry')
        )
    );


    # Responsive
    $wp_setting_name = 'responsive_status';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Site Responsive', 'photberry'),
            'section' => 'photberry_custom_post_types',
            'settings' => $wp_setting_name,
            'type' => 'select',
            'choices' => array('on' => 'On', 'off' => 'Off'),
        )
    ));

    # Portfolio Name
    $wp_setting_name = 'portfolio_pt_name';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Portfolio Post Type Name' , 'photberry'),
            'section' => 'photberry_custom_post_types',
            'settings' => $wp_setting_name,
        )
    ));

    # Portfolio Slug
    $wp_setting_name = 'portfolio_pt_slug';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Portfolio Post Type Slug' , 'photberry'),
            'section' => 'photberry_custom_post_types',
            'settings' => $wp_setting_name,
        )
    ));

    # Portfolio Taxonomy
    $wp_setting_name = 'portfolio_pt_tax';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Portfolio Post Type Taxonomy' , 'photberry'),
            'section' => 'photberry_custom_post_types',
            'settings' => $wp_setting_name,
        )
    ));

    # Albums Name
    $wp_setting_name = 'albums_pt_name';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Albums Post Type Name' , 'photberry'),
            'section' => 'photberry_custom_post_types',
            'settings' => $wp_setting_name,
        )
    ));

    # Albums Slug
    $wp_setting_name = 'albums_pt_slug';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Albums Post Type Slug' , 'photberry'),
            'section' => 'photberry_custom_post_types',
            'settings' => $wp_setting_name,
        )
    ));

    # Albums Taxonomy
    $wp_setting_name = 'albums_pt_tax';
    $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        $wp_setting_name,
        array(
            'label' => esc_attr__('Albums Post Type Taxonomy' , 'photberry'),
            'section' => 'photberry_custom_post_types',
            'settings' => $wp_setting_name,
        )
    ));

}
