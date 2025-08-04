<?php
/*
 * Created by Pixel-Mafia
 * www.pixel-mafia.com
*/

global $photberry_custom_css;

	$color_main = esc_attr(photberry_get_theme_mod('color_main'));
	$bg_body = esc_attr(photberry_get_theme_mod('bg_body'));
	$bg_sidebar = esc_attr(photberry_get_theme_mod('bg_sidebar'));

	$color_headings = esc_attr(photberry_get_theme_mod('color_headings'));
	$color_text = esc_attr(photberry_get_theme_mod('color_text'));
	$color_additional = esc_attr(photberry_get_theme_mod('color_additional'));
	$color_404 = esc_attr(photberry_get_theme_mod('color_404'));
	$color_cs = esc_attr(photberry_get_theme_mod('color_cs'));
	$color_pp = esc_attr(photberry_get_theme_mod('color_pp'));

	$bg_input = esc_attr(photberry_get_theme_mod('bg_input'));
	$color_input = esc_attr(photberry_get_theme_mod('color_input'));
	$bg_button = esc_attr(photberry_get_theme_mod('bg_button'));
	$color_button = esc_attr(photberry_get_theme_mod('color_button'));

	$bg_menu = esc_attr(photberry_get_theme_mod('bg_menu'));
	$color_menu = esc_attr(photberry_get_theme_mod('color_menu'));
	$color_menu_active = esc_attr(photberry_get_theme_mod('color_menu_active'));
	$color_menu_transparent = esc_attr(photberry_get_theme_mod('color_menu_transparent'));
	$color_menu_active_transparent = esc_attr(photberry_get_theme_mod('color_menu_active_transparent'));

	$bg_footer = esc_attr(photberry_get_theme_mod('bg_footer'));
	$color_footer = esc_attr(photberry_get_theme_mod('color_footer'));
	$color_footer_additional = esc_attr(photberry_get_theme_mod('color_footer_additional'));
	$color_footer_headings = esc_attr(photberry_get_theme_mod('color_footer_headings'));

	$mobile_fontsize = photberry_get_theme_mod('header_menu_font_size') - 2;

# Body Styles
$photberry_custom_css = '
    body {
        font-family: "' . esc_attr(photberry_get_theme_mod('main_font_family')) . '";
        font-size: ' . absint(photberry_get_theme_mod('main_font_size')) . 'px;
        line-height: ' . absint(photberry_get_theme_mod('main_line_height')) . 'px;
        font-weight: ' . absint(photberry_get_theme_mod('main_font_weight')) . ';

		background: '. $bg_body .';
		background: -moz-linear-gradient(left, '. $bg_body .' 0%, '. $bg_body .' 50%, '. $bg_sidebar .' 51%, '. $bg_sidebar .' 100%);
		background: -webkit-linear-gradient(left, '. $bg_body .' 0%, '. $bg_body .' 50%, '. $bg_sidebar .' 51%, '. $bg_sidebar .' 100%);
		background: linear-gradient(to right, '. $bg_body .' 0%, '. $bg_body .' 50%, '. $bg_sidebar .' 51%, '. $bg_sidebar .' 100%);
		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr = "'. $bg_body .'", endColorstr = "'. $bg_sidebar .'", GradientType=1 );
    }
	body.single-pm-albums {
		background: '. $bg_body .';
	}
	.photberry_verticaly_page_wrapper {
		background: '. $bg_sidebar .';
	}
	body.body_photberry_left_sidebar {
		background: '. $bg_body .';
		background: -moz-linear-gradient(left, '. $bg_sidebar .' 0%, '. $bg_sidebar .' 50%, '. $bg_body .' 51%, '. $bg_body .' 100%);
		background: -webkit-linear-gradient(left, '. $bg_sidebar .' 0%, '. $bg_sidebar .' 50%, '. $bg_body .' 51%, '. $bg_body .' 100%);
		background: linear-gradient(to right, '. $bg_sidebar .' 0%, '. $bg_sidebar .' 50%, '. $bg_body .' 51%, '. $bg_body .' 100%);
		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr = "'. $bg_body .'", endColorstr = "'. $bg_body .'", GradientType=1 );
	}
	body.body_photberry_no_sidebar  {
		background: '. $bg_body .';
	}
';

# Logo Styles
$photberry_custom_css .= '
	.photberry_cs_logo,
    header .photberry_logo_cont {
        padding-top: ' . absint(photberry_get_theme_mod('logo_padding_top')) . 'px;
        padding-bottom: ' . absint(photberry_get_theme_mod('logo_padding_bottom')) . 'px;
    }
';

# Image Logo
if (photberry_get_theme_mod('logo_type') == 'image_logo') {
    $photberry_logo_metadata = wp_get_attachment_metadata(attachment_url_to_postid(photberry_get_theme_mod('logo_image')));
    $photberry_logo_width = (isset($photberry_logo_metadata['width']) ? $photberry_logo_metadata['width'] : '346');
    $photberry_logo_height = (isset($photberry_logo_metadata['height']) ? $photberry_logo_metadata['height'] : '76');

    $photberry_custom_css .= '
        header .photberry_image_logo {
            width: ' . absint($photberry_logo_width) . 'px;
            height: ' . absint($photberry_logo_height) . 'px;
            background: url("' . esc_url(photberry_get_theme_mod('logo_image')) . '") 0 0 no-repeat transparent;
        }
		.photberry_cs_logo .photberry_image_logo,
        .photberry_transparent_header header .photberry_image_logo {
            width: ' . absint($photberry_logo_width) . 'px;
            height: ' . absint($photberry_logo_height) . 'px;
            background: url("' . esc_url(photberry_get_theme_mod('logo_image_transparent')) . '") 0 0 no-repeat transparent;
        }
    ';

    # Retina
    if (photberry_get_theme_mod('logo_retina') == true) {
        $photberry_logo_width = $photberry_logo_width / 2;
        $photberry_logo_height = $photberry_logo_height / 2;
        $photberry_custom_css .= '
			.photberry_cs_logo .photberry_image_logo.photberry_retina,
            header .photberry_image_logo.photberry_retina {
                width: ' . absint($photberry_logo_width) . 'px;
                height: ' . absint($photberry_logo_height) . 'px;
                background-size: ' . absint($photberry_logo_width) . 'px ' . absint($photberry_logo_height) . 'px;
            }
        ';
    }
    $photberry_menu_lh_fix = 3;
}

# Text Logo
if (photberry_get_theme_mod('logo_type') == 'text_logo') {
    $photberry_logo_height = absint(photberry_get_theme_mod('logo_text_size'));
    $photberry_menu_lh_fix = 6;
    $photberry_custom_css .= '
        header .photberry_text_logo a {
            font-size: ' . absint(photberry_get_theme_mod('logo_text_size')) . 'px;
            line-height: ' . absint(photberry_get_theme_mod('logo_text_size')) . 'px;
            color: ' . esc_attr(photberry_get_theme_mod('color_menu')) . ';
            font-weight: ' . esc_attr(photberry_get_theme_mod('logo_text_weight')) . ';
            font-style: ' . (photberry_get_theme_mod('logo_text_style_italic') == true ? 'italic' : 'normal') . ';
            font-family:"' . esc_attr(photberry_get_theme_mod('logo_text_font')) . '";
            text-transform:' . (photberry_get_theme_mod('logo_text_style_uppercase') == true ? 'uppercase' : 'none') . ';
        }

        .photberry_transparent_header header .photberry_text_logo a {
            color: ' . esc_attr(photberry_get_theme_mod('color_menu_transparent')) . ';
        }

        header .photberry_text_logo a:hover {
            color: ' . esc_attr(photberry_get_theme_mod('color_menu_active')) . ';
        }

        .photberry_transparent_header header .photberry_text_logo a:hover {
            color: ' . esc_attr(photberry_get_theme_mod('color_menu_active_transparent')) . ';
        }
    ';
}

# Header Menu Settings
if (photberry_get_theme_mod('header_menu_font_size')) {
	$photberry_menu_text_transform = 'text-transform:uppercase;';
} else {
	$photberry_menu_text_transform = 'text-transform:none;';
}
$photberry_custom_css .= '
	.photberry_mobile_menu_toggler:before,
	.photberry_main_header,
	.photberry_mobile_header_inner {
		 background:'. $bg_menu .'
	}
	.photberry_transparent_header .photberry_main_header {
		background:none;
		border-right:1px solid rgba('. photberry_hex2rgb($bg_menu) .', 0.4);
	}

	.photberry_mobile_menu_toggler,
	.photberry_menu_toggler {
		background:'. $bg_menu .'
	}
	.photberry_mobile_menu_toggler .photberry_menu_ico span,
	.photberry_menu_toggler .photberry_menu_ico span {
		background:'. $color_menu .';
	}
	.photberry_menu_toggler:hover .photberry_menu_ico span {
		background:'. $color_menu_active .';
	}
	.photberry_transparent_header .photberry_menu_toggler {
		border:1px solid rgba('. photberry_hex2rgb($bg_menu) .', 0.4);
		border-left:none;
		background:none;
	}
	.photberry_transparent_header .photberry_menu_toggler .photberry_menu_ico span {
		background:'. $color_menu_transparent .';
	}
	.photberry_transparent_header .photberry_menu_toggler:hover .photberry_menu_ico span {
		background:'. $color_menu_active_transparent .';
	}

	.photberry_aside_footer div,
	.photberry_aside_footer a {
		color:'. $color_menu .';
	}

	.photberry_cs_footer div,
	.photberry_cs_footer a,
	.photberry_transparent_header .photberry_aside_footer div,
	.photberry_transparent_header .photberry_aside_footer a {
		color:'. $color_menu_transparent .';
	}
	.photberry_aside_footer a:hover {
		color:'. $color_menu_active .';
	}
	.photberry_transparent_header .photberry_menu_notify,
	.photberry_transparent_header .photberry_aside_footer a {
		color:'. $color_menu_transparent .';
	}
	.photberry_cs_footer a:hover,
	.photberry_transparent_header .photberry_aside_footer a:hover {
		color:'. $color_menu_active_transparent .';
	}

	/* Menu */
	.photberry_nav ul li.menu-item-has-children a:before {
		font-size: '. esc_attr(photberry_get_theme_mod('header_menu_font_size')) .'px;
		font-weight: '. esc_attr(photberry_get_theme_mod('header_menu_font_weight')) .';
	}
	.photberry_nav ul li.menu-item-has-children a:after {
		font-size: '. esc_attr(photberry_get_theme_mod('header_menu_font_size')) .'px;
		font-weight: '. esc_attr(photberry_get_theme_mod('header_menu_font_weight')) .';
		font-family: '. esc_attr(photberry_get_theme_mod('header_menu_font_family')) .';
	}
	.photberry_nav a {
		font-size: '. esc_attr(photberry_get_theme_mod('header_menu_font_size')) .'px;
		line-height: '. esc_attr(photberry_get_theme_mod('header_menu_line_height')) .'px;
		font-weight: '. esc_attr(photberry_get_theme_mod('header_menu_font_weight')) .';
		font-family: '. esc_attr(photberry_get_theme_mod('header_menu_font_family')) .';
		color:'. $color_menu .';
		'. esc_attr($photberry_menu_text_transform) .'
	}
	.photberry_nav ul.sub-menu li.menu-item-has-children a:before,
	.photberry_nav ul.sub-menu li.menu-item-has-children a:after,
	.photberry_nav ul.sub-menu a {
		font-size: '. esc_attr(photberry_get_theme_mod('header_sub_menu_font_size')) .'px;
	}
	.photberry_mobile_header ul.sub-menu a,
	.photberry_mobile_header ul.sub-menu a:after,
	.photberry_mobile_header ul.sub-menu a:before {
		font-size: '. esc_attr($mobile_fontsize) .'px;
	}
	.photberry_nav li.current-menu-parent > a,
	.photberry_nav li.current-menu-item > a,
	.photberry_nav li.current-menu-ancestor > a,
	.photberry_nav a:hover {
		color:'. $color_menu_active .';
	}
	.photberry_transparent_header .photberry_nav a {
		color:'. $color_menu_transparent .';
	}
	.photberry_transparent_header .photberry_nav li.current-menu-parent > a,
	.photberry_transparent_header .photberry_nav li.current-menu-item > a,
	.photberry_transparent_header .photberry_nav li.current-menu-ancestor > a,
	.photberry_transparent_header .photberry_nav a:hover {
		color:'. $color_menu_active_transparent .';
	}
	.photberry_nav:before {
		background: -moz-linear-gradient(top, rgba('. photberry_hex2rgb($bg_menu) .', 1) 0%, rgba('. photberry_hex2rgb($bg_menu) .', 1) 25%, rgba('. photberry_hex2rgb($bg_menu) .', 0) 100%);
		background: -webkit-linear-gradient(top, rgba('. photberry_hex2rgb($bg_menu) .', 1) 0%, rgba('. photberry_hex2rgb($bg_menu) .', 1) 25%, rgba('. photberry_hex2rgb($bg_menu) .', 0) 100%);
		background: linear-gradient(to bottom, rgba('. photberry_hex2rgb($bg_menu) .', 1) 0%, rgba('. photberry_hex2rgb($bg_menu) .', 1) 25%, rgba('. photberry_hex2rgb($bg_menu) .', 0) 100%);
	}
	.photberry_nav:after {
		background: -moz-linear-gradient(top, rgba('. photberry_hex2rgb($bg_menu) .', 0) 0%, rgba('. photberry_hex2rgb($bg_menu) .', 1) 75%, rgba('. photberry_hex2rgb($bg_menu) .', 1) 100%);
		background: -webkit-linear-gradient(top, rgba('. photberry_hex2rgb($bg_menu) .', 0) 0%, rgba('. photberry_hex2rgb($bg_menu) .', 1) 75%, rgba('. photberry_hex2rgb($bg_menu) .', 1) 100%);
		background: linear-gradient(to bottom, rgba('. photberry_hex2rgb($bg_menu) .', 0) 0%, rgba('. photberry_hex2rgb($bg_menu) .', 1) 75%, rgba('. photberry_hex2rgb($bg_menu) .', 1) 100%);
	}
';

# Content
$photberry_custom_css .= '
	.photberry_content {
		background:'. $bg_body .';
	}
	.photberry_sidebar {
		background:'. $bg_sidebar .';
	}
';

# Footer
$photberry_custom_css .= '
	.photberry_footer {
		background:'. $bg_footer .';
	}
';

# Typography
$photberry_custom_css .= '

	.photberry_tiny ul li,
	.photberry_tiny ol li,
	p, td, div {
		font-size:'. esc_attr(photberry_get_theme_mod('main_font_size')) .'px;
		line-height:'. esc_attr(photberry_get_theme_mod('main_line_height')) .'px;
		font-weight:'. esc_attr(photberry_get_theme_mod('main_font_weight')) .';
		color:'. $color_text .';
	}
	a {
		color:'. $color_headings .';
	}
	a:hover,
	.elementor-text-editor a {
		color:'. $color_main .';
	}
	p {
		margin:0 0 '. esc_attr(photberry_get_theme_mod('header_sub_menu_font_size')) .'px 0;
	}
	body .elementor-widget-text-editor .elementor-drop-cap,
	body .elementor-widget-text-editor:not(.elementor-drop-cap-view-default) .elementor-drop-cap-letter {
		font-size:'. esc_attr(photberry_get_theme_mod('dropcap_font_size')) .'px;
		line-height:'. esc_attr(photberry_get_theme_mod('dropcap_line_height')) .'px;
		font-weight:'. esc_attr(photberry_get_theme_mod('dropcap_font_weight')) .';
	}
	blockquote {
		color:'. $color_text .';
		border-color:'. $color_main .';
	}
	blockquote:before {
		background-color:'. $color_main .';
	}
    h1, h2, h3, h4, h5, h6,
	h1 a, h2 a, h3 a, h4 a, h5 a, h6 a,
	h1 span, h2 span, h3 span, h4 span, h5 span, h6 span,
    body .photberry_content .elementor-widget-heading .elementor-heading-title {
        color: ' . $color_headings . ';
        font-family: "' . esc_attr(photberry_get_theme_mod('headings_font_family')) . '";
		font-weight: ' . esc_attr(photberry_get_theme_mod('headings_font_weight')). ';
    }

    h1 {
        font-size: ' . absint(photberry_get_theme_mod('h1_font_size')) . 'px;
        line-height: ' . absint(photberry_get_theme_mod('h1_line_height')) . 'px;
    }

    h2 {
        font-size: ' . absint(photberry_get_theme_mod('h2_font_size')) . 'px;
        line-height: ' . absint(photberry_get_theme_mod('h2_line_height')) . 'px;
    }

    h3 {
        font-size: ' . absint(photberry_get_theme_mod('h3_font_size')) . 'px;
        line-height: ' . absint(photberry_get_theme_mod('h3_line_height')) . 'px;
    }

    h4 {
        font-size: ' . absint(photberry_get_theme_mod('h4_font_size')) . 'px;
        line-height: ' . absint(photberry_get_theme_mod('h4_line_height')) . 'px;
    }

    h5 {
        font-size: ' . absint(photberry_get_theme_mod('h5_font_size')) . 'px;
        line-height: ' . absint(photberry_get_theme_mod('h5_line_height')) . 'px;
    }

    h6 {
        font-size: ' . absint(photberry_get_theme_mod('h6_font_size')) . 'px;
        line-height: ' . absint(photberry_get_theme_mod('h6_line_height')) . 'px;
    }
';

# Meta Color and Styles
$photberry_custom_css .= '
	.photberry_post_tags,
	.photberry_post_tags a,
	.photberry_sharing,
	.photberry_sharing span,
	.photberry_sharing a,
	.photberry_post_nav_button a,
	a.photberry_read_more_button,
	.photberry_post_meta_item,
	.photberry_post_meta_item a {
        color: ' . $color_headings . ';
        font-family: "' . esc_attr(photberry_get_theme_mod('headings_font_family')) . '";
		font-weight: ' . esc_attr(photberry_get_theme_mod('headings_font_weight')). ';
        font-size: ' . absint(photberry_get_theme_mod('h6_font_size')) . 'px;
        line-height: ' . absint(photberry_get_theme_mod('h6_line_height')) . 'px;
	}
	.photberry_post_nav_button a,
	.elementor-text-editor a:hover {
		color:'. $color_text .';
	}
	.photberry_prev_post_title,
	.photberry_next_post_title {
        font-family: "' . esc_attr(photberry_get_theme_mod('headings_font_family')) . '";
		font-weight: ' . esc_attr(photberry_get_theme_mod('headings_font_weight')). ';
		color: ' . $color_headings . ';
	}
	.photberry_post_meta_item a:hover {
		color:'. $color_main .';
	}
	a.photberry_read_more_button {
		color:'. $color_button .';
		background:'. $bg_button .';
	}
	a.photberry_read_more_button:hover {
		color:'. $color_button .';
		background:'. $color_main .';
	}
';


# Error 404 Page, Coming Soon and Password Protected
$photberry_custom_css .= '
	.photberry_cs_content_wrapper h1,
	.photberry_cs_content_wrapper span,
	.photberry_cs_content_wrapper p {
		color:'. $color_cs.'
	}

	.photberry_pp_content_wrapper h1,
	.photberry_pp_content_wrapper span,
	.photberry_pp_content_wrapper p {
		color:'. $color_pp.'
	}

	.photberry_404_content_wrapper h1,
	.photberry_404_content_wrapper span,
	.photberry_404_content_wrapper p {
		color:'. $color_404 .';
	}
	.photberry_pp_content_wrapper input[type="password"],
	.photberry_pp_content_wrapper input,
	.photberry_404_content_wrapper input {
		color:'. $color_headings .';
	}
	.countdown span.item span {
		font-family: "' . esc_attr(photberry_get_theme_mod('headings_font_family')) . '";
		font-weight: ' . esc_attr(photberry_get_theme_mod('headings_font_weight')). ';
	}
';

# Inputs and Forms
$photberry_custom_css .= '
	input[type="text"],
	input[type="password"],
	input[type="email"],
	input[type="tel"],
	input[type="date"],
	input[type="time"],
	input[type="datetime"],
	input[type="url"],
	textarea,
	textarea:focus {
		color:'. $color_input .';
		background:'. $bg_input .';
        font-family: "' . esc_attr(photberry_get_theme_mod('headings_font_family')) . '";
        font-size: ' . absint(photberry_get_theme_mod('h6_font_size')) . 'px;
		font-weight: ' . esc_attr(photberry_get_theme_mod('headings_font_weight')). ';
	}
	.comment-form-cookies-consent input[type="checkbox"]:checked + label:before,
	.comment-form-cookies-consent input[type="checkbox"]:not(:checked) + label:before {
		background:'. $bg_input .';
	}
	.comment-form-cookies-consent input[type="checkbox"]:checked + label:after,
	.comment-form-cookies-consent input[type="checkbox"]:not(:checked) + label:after {
		color:'. $color_input .';
	}


	body .elementor-widget-button a.elementor-button span {
        font-family: "' . esc_attr(photberry_get_theme_mod('headings_font_family')) . '";
        font-size: ' . absint(photberry_get_theme_mod('h6_font_size')) . 'px;
		font-weight: ' . esc_attr(photberry_get_theme_mod('headings_font_weight')). ';
		color:'. $color_button .';
	}
    body .wp-block-button a.wp-block-button__link {
        font-family: "' . esc_attr(photberry_get_theme_mod('headings_font_family')) . '";
        font-size: ' . absint(photberry_get_theme_mod('h6_font_size')) . 'px;
		font-weight: ' . esc_attr(photberry_get_theme_mod('headings_font_weight')). ';
    }
    .wp-block-button a.wp-block-button__link:not(.has-background) {
        background:'. $bg_button .';
    }
    .wp-block-button a.wp-block-button__link:not(.has-text-color) {
        color:'. $color_button .';
    }
    .wp-block-button a.wp-block-button__link:hover {
        background: '. $color_main .';
        color:'. $color_button .';
    }
    body .wp-block-button.is-style-outline a.wp-block-button__link:hover {
        border-color: '. $color_main .';
        color: '. $color_main .';
        background: transparent;
    }

	body .elementor-widget-button a.elementor-button,
	a.photberry_button,
	input[type="button"],
	input[type="reset"],
	input[type="submit"] {
        font-family: "' . esc_attr(photberry_get_theme_mod('headings_font_family')) . '";
        font-size: ' . absint(photberry_get_theme_mod('h6_font_size')) . 'px;
		font-weight: ' . esc_attr(photberry_get_theme_mod('headings_font_weight')). ';
		color:'. $color_button .';
		background:'. $bg_button .';
	}
	body .elementor-widget-button a.elementor-button:hover,
	a.photberry_button:hover,
	input[type="button"]:hover,
	input[type="reset"]:hover,
	input[type="submit"]:hover {
		color:'. $color_button .';
		background: '. $color_main .';
	}
	body .elementor-widget-button a.elementor-button,
	a.photberry_button.photberry_reverse_button,
	input.photberry_reverse_button,
	.photberry_pp_content_wrapper input[type="submit"],
	.photberry_cs_content_wrapper input[type="submit"] {
		background: '. $color_main .';
	}
	body .elementor-widget-button a.elementor-button:hover,
	a.photberry_button.photberry_reverse_button:hover,
	input.photberry_reverse_button:hover,
	.photberry_pp_content_wrapper input[type="submit"]:hover,
	.photberry_cs_content_wrapper input[type="submit"]:hover {
		background: '. $bg_button .';
	}

	input::-moz-placeholder {
		color:'. $color_input .';
	}

	textarea::-moz-placeholder {
		color:'. $color_input .';
	}

	input::-webkit-input-placeholder {
		color:'. $color_input .';
	}

	textarea::-webkit-input-placeholder {
		color:'. $color_input .';
	}

	input::-ms-input-placeholder {
		color:'. $color_input .';
	}

	textarea::-ms-input-placeholder {
		color:'. $color_input .';
	}
	.wpcf7-response-output,
	.wpcf7-not-valid-tip {
        font-family: "' . esc_attr(photberry_get_theme_mod('headings_font_family')) . '";
        font-size: ' . absint(photberry_get_theme_mod('h6_font_size')) . 'px;
		font-weight: ' . esc_attr(photberry_get_theme_mod('headings_font_weight')). ';
	}

	.photberry_select {
		color:'. $color_input .';
		background:'. $bg_input .';
        font-family: "' . esc_attr(photberry_get_theme_mod('headings_font_family')) . '";
        font-size: ' . absint(photberry_get_theme_mod('h6_font_size')) . 'px;
        line-height: ' . absint(photberry_get_theme_mod('h6_line_height')) . 'px;
		font-weight: ' . esc_attr(photberry_get_theme_mod('headings_font_weight')). ';
	}
    .photberry_select.active {
    }
    .photberry_tiny .photberry_select_wrapper ul.select-options {
        border:2px solid '. $bg_input .';
        border-top: none;
        background: '. $bg_body .';
    }
    .photberry_tiny .photberry_select_wrapper ul.select-options li {
        color: '. $color_text .';
        font-family: "' . esc_attr(photberry_get_theme_mod('headings_font_family')) . '";
        font-size: ' . absint(photberry_get_theme_mod('h6_font_size')) . 'px;
		font-weight: ' . esc_attr(photberry_get_theme_mod('headings_font_weight')). ';
    }
    .photberry_tiny .photberry_select_wrapper ul.select-options li:hover {
		background: '. $color_main .';
        color: '. $bg_body .';
    }
';

# Widgets
$photberry_custom_css .= '
	.widgettitle:before {
		background:'. $color_main .';
	}
	.widget a {
		color: '. $color_headings .';
	}
	.widget a:hover {
		color: '. $color_main.';
	}

    ul.wp-block-latest-posts li:before,
    ul.wp-block-archives-list li:before,
    ul.wp-block-categories-list li:before,
	.widget_product_categories ul li:before,
	.widget_nav_menu ul li:before,
	.widget_archive ul li:before,
	.widget_pages ul li:before,
	.widget_categories ul li:before,
	.widget_recent_entries ul li:before,
	.widget_meta ul li:before,
	.widget_recent_comments ul li:before {
		background:'. $color_text .';
	}

    ul.wp-block-latest-posts li a,
    ul.wp-block-archives-list li a,
    ul.wp-block-categories-list li a,
	.widget_product_categories ul li a,
	.widget_nav_menu ul li a,
	.widget_archive ul li a,
	.widget_pages ul li a,
	.widget_categories ul li a,
	.widget_recent_entries ul li a,
	.widget_meta ul li a,
	.widget_recent_comments ul li a {
		color:'. $color_text .';
	}
	.photberry_posts_item_content a {
		color:'. $color_headings .';
	}
    ul.wp-block-latest-posts li a:hover,
    ul.wp-block-archives-list li a:hover,
    ul.wp-block-categories-list li a:hover,
	.widget_product_categories ul li a:hover,
	.widget_nav_menu ul li a:hover,
	.widget_archive ul li a:hover,
	.widget_pages ul li a:hover,
	.widget_categories ul li a:hover,
	.widget_recent_entries ul li a:hover,
	.widget_meta ul li a:hover,
	.photberry_posts_item_content a:hover,
	.widget_recent_comments ul li a:hover,
	.photberry_posts_item_content .photberry_widget_meta a:hover {
		color:'. $color_main .';
	}
	.photberry_posts_item_content .photberry_widget_meta div,
	.photberry_posts_item_content .photberry_widget_meta a,
	.photberry_posts_item_content .photberry_widget_meta span {
		color:'. $color_footer .';
	}
    .widget_product_tag_cloud a,
	.widget_tag_cloud a {
        font-family: "' . esc_attr(photberry_get_theme_mod('headings_font_family')) . '";
        font-size: ' . absint(photberry_get_theme_mod('h6_font_size')) . 'px!important;
		font-weight: ' . esc_attr(photberry_get_theme_mod('headings_font_weight')). ';
		color:'. $color_button .';
		background:'. $bg_button .';
	}
    .widget_product_tag_cloud a:hover,
	.widget_tag_cloud a:hover {
		color:'. $color_button .';
		background: '. $color_main .';
	}

	.widget_calendar caption {
        font-family: "' . esc_attr(photberry_get_theme_mod('headings_font_family')) . '";
        font-size: ' . absint(photberry_get_theme_mod('h6_font_size')) . 'px!important;
		font-weight: ' . esc_attr(photberry_get_theme_mod('headings_font_weight')). ';
		color: ' . $color_headings . ';
	}
	.widget_calendar td {
		color: '. $color_text .';
	}

	/* Footer Widgets */
	.footer_widget a {
		color: '. $color_footer_additional .';
	}
	.footer_widget a:hover {
		color: '. $color_main.';
	}
	.photberry_footer_widgets .widget_calendar td,
	.footer_widget ul li,
	.footer_widget ol li,
	.footer_widget p,
	.footer_widget span,
	.footer_widget td,
	.footer_widget div {
		color:'. $color_footer .';
	}

	.footer_widget h1,
	.footer_widget h1 a,
	.footer_widget h1 span,
	.footer_widget h2,
	.footer_widget h2 a,
	.footer_widget h2 span,
	.footer_widget h3,
	.footer_widget h3 a,
	.footer_widget h3 span,
	.footer_widget h4,
	.footer_widget h4 a,
	.footer_widget h4 span,
	.footer_widget h5,
	.footer_widget h5 a,
	.footer_widget h5 span,
	.footer_widget h6,
	.footer_widget h6 a,
	.footer_widget h6 span {
		color:'. $color_footer_headings .';
	}

	.photberry_footer_widgets .widget_product_categories ul li:before,
	.photberry_footer_widgets .widget_nav_menu ul li:before,
	.photberry_footer_widgets .widget_archive ul li:before,
	.photberry_footer_widgets .widget_pages ul li:before,
	.photberry_footer_widgets .widget_categories ul li:before,
	.photberry_footer_widgets .widget_recent_entries ul li:before,
	.photberry_footer_widgets .widget_meta ul li:before,
	.photberry_footer_widgets .widget_recent_comments ul li:before {
		background:'. $color_footer_additional .';
	}
	.photberry_footer_widgets .widget_product_categories ul li a,
	.photberry_footer_widgets .widget_nav_menu ul li a,
	.photberry_footer_widgets .widget_archive ul li a,
	.photberry_footer_widgets .widget_pages ul li a,
	.photberry_footer_widgets .widget_categories ul li a,
	.photberry_footer_widgets .widget_recent_entries ul li a,
	.photberry_footer_widgets .widget_meta ul li a,
	.photberry_footer_widgets .widget_recent_comments ul li a {
		color:'. $color_footer_additional .';
	}
	.photberry_footer_widgets .photberry_block_with_fi .photberry_posts_item_content a {
		color:'. $color_footer_headings .';
	}
	.photberry_footer_widgets .widget_product_categories ul li a:hover,
	.photberry_footer_widgets .widget_nav_menu ul li a:hover,
	.photberry_footer_widgets .widget_archive ul li a:hover,
	.photberry_footer_widgets .widget_pages ul li a:hover,
	.photberry_footer_widgets .widget_categories ul li a:hover,
	.photberry_footer_widgets .widget_recent_entries ul li a:hover,
	.photberry_footer_widgets .widget_meta ul li a:hover,
	.photberry_footer_widgets .photberry_block_with_fi .photberry_posts_item_content a:hover,
	.photberry_footer_widgets .widget_recent_comments ul li a:hover {
		color:'. $color_main .';
	}
	.photberry_footer_widgets .photberry_block_with_fi .photberry_posts_item_content .photberry_widget_meta div,
	.photberry_footer_widgets .photberry_block_with_fi .photberry_posts_item_content .photberry_widget_meta span {
		color:'. $color_footer .';
	}
	.photberry_footer_widgets .widget_tag_cloud a {
		color:'. $color_button .';
		background:'. $color_footer .';
	}
	.photberry_footer_widgets .widget_tag_cloud a:hover {
		color:'. $color_button .';
		background: '. $color_main .';
	}

	.photberry_footer_widgets .widget_calendar caption {
		color: ' . $color_footer_headings . ';
	}
	.photberry_flickr_widget_wrapper .photberry_flickr_badge_image a:before,
	.widget_photberry_featured_posts .photberry_posts_item_image:before {
		background: rgba('. photberry_hex2rgb($color_main) .', 0);
	}
	.photberry_flickr_widget_wrapper .photberry_flickr_badge_image a:hover:before,
	.widget_photberry_featured_posts .photberry_posts_item_image:hover:before {
		background: rgba('. photberry_hex2rgb($color_main) .', 0.7);
	}
';

# Blog
$photberry_custom_css .= '
	.photberry_owlCarousel.owl-theme .owl-nav [class*="owl-"]:hover:before,
	.photberry_owlCarousel.owl-theme .owl-nav [class*="owl-"]:hover:after {
		background:'. $color_main .';
	}
	body .nav-links a {
        color: ' . $color_text . ';
        font-family: "' . esc_attr(photberry_get_theme_mod('headings_font_family')) . '";
		font-weight: ' . esc_attr(photberry_get_theme_mod('headings_font_weight')). ';
	}
	.photberry_post_nav_button a:hover,
	body .nav-links a:hover {
		color:'. $color_main .';
	}
	body .nav-links span {
        font-family: "' . esc_attr(photberry_get_theme_mod('headings_font_family')) . '";
		font-weight: ' . esc_attr(photberry_get_theme_mod('headings_font_weight')). ';
	}
	.photberry_featured_posts .photberry_posts_item .photberry_fimage_cont a:before,
	.photberry_grid_blog_item a.photberry_grid_blog_image:before,
	.photberry_pf_gallery .photberry_pf_gallery_item a:before {
		background: rgba('. photberry_hex2rgb($color_main) .', 0);
	}
	.photberry_featured_posts .photberry_posts_item .photberry_fimage_cont a:hover:before,
	.photberry_grid_blog_item a.photberry_grid_blog_image:hover:before,
	.photberry_pf_gallery .photberry_pf_gallery_item a:hover:before {
		background: rgba('. photberry_hex2rgb($color_main) .', 0.7);
	}
	.photberry_sharing a.photberry_share_facebook:hover,
	.photberry_sharing a.photberry_share_twitter:hover,
	.photberry_sharing a.photberry_share_pinterest:hover {
		background:'. $bg_button .';
	}
';

# Portfolio
$photberry_custom_css .= '
	.photberry_grid_filter li,
	.photberry_grid_filter li a {
        font-family: "' . esc_attr(photberry_get_theme_mod('headings_font_family')) . '";
		font-weight: ' . esc_attr(photberry_get_theme_mod('headings_font_weight')). ';
	}
	.photberry_grid_filter li.photberry_filter-item.is-checked a {
		color: ' . $color_main . ';
	}
	.photberry_albums_grid a:before,
	.photberry_featured_posts .photberry_port_item a:before,
	.photberry_portfolio_grid .photberry_image_cont a:before,
	.photberry_portfolio_grid.view_type_grid a:before {
		background: rgba('. photberry_hex2rgb($color_main) .', 0);
	}
	.photberry_albums_grid a:hover:before,
	.photberry_featured_posts .photberry_port_item a:hover:before,
	.photberry_portfolio_grid .photberry_image_cont a:hover:before,
	.photberry_portfolio_grid.view_type_grid a:hover:before {
		background: rgba('. photberry_hex2rgb($color_main) .', 0.7);
	}
	.photberry_albums_grid h4,
	.photberry_albums_grid h6,
	.photberry_albums_packery_item h6,
	.photberry_albums_packery_item h4,
	.photberry_portfolio_packery_item h6,
	.photberry_portfolio_packery_item h4,
	.photberry_featured_posts .photberry_port_item h6,
	.photberry_featured_posts .photberry_port_item h3,
	.photberry_portfolio_grid.view_type_grid h4,
	.photberry_portfolio_grid.view_type_grid h6 {
		color: '. $color_additional .';
	}
';

# Modules
$photberry_custom_css .= '
	body .elementor-widget-text-editor.elementor-drop-cap-view-stacked .elementor-drop-cap {
		background:'. $color_main .';
	}
	.photberry_albums_carousel .photberry_albums_carousel_item_inner a:before,
	.photberry_slider_thumb:before,
	.packery-item-inner a:before,
	.photberry_grid_inner .grid-item a:before,
	.photberry_itemized_link_image a:before {
		background: rgba('. photberry_hex2rgb($color_main) .', 0);
	}
	.photberry_albums_carousel .photberry_albums_carousel_item_inner a:hover:before,
	.photberry_slider_thumb:hover:before,
	.packery-item-inner a:hover:before,
	.photberry_grid_inner .grid-item a:hover:before,
	.photberry_itemized_link_image a:hover:before {
		background: rgba('. photberry_hex2rgb($color_main) .', 0.7);
	}
	.photberry_price_item.most_popular_item:before {
		border-color: transparent '. $color_main .' transparent transparent;
	}
	.photberry_price_item.most_popular_item h5,
	.photberry_price_item.most_popular_item h2 {
		color:'. $color_main .';
	}
	body .elementor-widget-tabs .elementor-tab-title {
        color: ' . $color_headings . ';
        font-family: "' . esc_attr(photberry_get_theme_mod('headings_font_family')) . '";
		font-weight: ' . esc_attr(photberry_get_theme_mod('headings_font_weight')). ';
	}
	body .elementor-widget-tabs .elementor-tab-title:hover,
	body .elementor-widget-tabs .elementor-tab-title.active {
		color: '. $color_main .';
	}
	body .elementor-widget-tabs.elementor-tabs-view-horizontal.photberry_tabs_borders_one .elementor-tab-desktop-title.active:before {
		background: '. $color_main  .';
	}
	body .elementor-widget-tabs .elementor-tab-title.elementor-active {
		color: '. $color_main  .';
	}
	.elementor-widget-tabs.elementor-tabs-view-horizontal.photberry_tabs_borders_one .elementor-tab-desktop-title.elementor-active:after {
		border-color: '. $color_main  .'!important;
	}
	.photberry_testimonials_flow_prev:before,
	.photberry_testimonials_flow_next:before,
	.photberry_testimonials_flow_prev:after,
	.photberry_testimonials_flow_next:after {
		background:'. $color_text .'
	}
	.photberry_albums_carousel .photberry_albums_carousel_item_inner h3,
	.photberry_albums_carousel .photberry_albums_carousel_item_inner h6,
	.photberry_albums_stripes_content h6,
	.photberry_albums_stripes_content h3,
	.photberry_split_slide .photberry_split_title,
	.photberry_slide_counter,
	.photberry_slide_title,
	.photberry_packery_inner .packery-item-content h4,
	.photberry_grid_inner .grid-item h4 {
		color: '. $color_additional .';
	}
	.photberry_slide_counter:before {
		border-color: transparent transparent transparent '. $color_additional .';
	}
	.photberry_slider.cover .photberry_slider_slide {
		background-color: '. $bg_body .';
	}

	body .elementor-widget-counter .elementor-counter-title,
	body .elementor-widget-counter .elementor-counter-number-wrapper {
        font-family: "' . esc_attr(photberry_get_theme_mod('headings_font_family')) . '";
		font-weight: ' . esc_attr(photberry_get_theme_mod('headings_font_weight')). ';
		color: '. $color_main .';
	}
	body .elementor-widget-counter .elementor-counter-title {
		color: '. $color_headings .';
	}

	.photberry_tiny .photberry_mailchimp_widget .photberry_mailchimp_subscribe {
		background: '. $color_main .';
	}
	.photberry_tiny .photberry_mailchimp_widget .photberry_mailchimp_subscribe:hover {
		background: '. $bg_button .';
	}

';

#Responsive
$photberry_custom_css .= '
	@media only screen and (max-width: 760px) {
		body {
			background: '. $bg_body .'!important;
		}
	}
';

# WooCommerce
if (class_exists('WooCommerce')) {
    $shop_color_message = esc_attr(photberry_get_theme_mod('shop_color_message'));
    $shop_color_info = esc_attr(photberry_get_theme_mod('shop_color_info'));
    $shop_color_error = esc_attr(photberry_get_theme_mod('shop_color_error'));
    $shop_color_required = esc_attr(photberry_get_theme_mod('shop_color_required'));
    $shop_color_remove = esc_attr(photberry_get_theme_mod('shop_color_remove'));

	$photberry_custom_css .= '
        body a.reset_variations,
        body button.button,
        body button.button.alt,
        body .photberry_content_wrapper .checkout-button.button,
        body .woocommerce .cart .button,
        body .woocommerce .cart input.button,
        body.woocommerce ul.products li.product a.added_to_cart.wc-forward,
        body .photberry_content_wrapper #respond input#submit,
        body .photberry_content_wrapper a.button,
        body .photberry_content_wrapper button.button,
        body .photberry_content_wrapper input.button
        body .photberry_content_wrapper .button,
        .woocommerce a.woocommerce-MyAccount-downloads-file.button,
        .woocommerce p.order-again a.button,
        body .photberry_content_wrapper .widget_price_filter .price_slider_amount .button {
            font-family: "' . esc_attr(photberry_get_theme_mod('headings_font_family')) . '";
            font-size: ' . absint(photberry_get_theme_mod('h6_font_size')) . 'px;
            font-weight: ' . esc_attr(photberry_get_theme_mod('headings_font_weight')). ';
            color:'. $color_button .';
            background:'. $bg_button .';
        }
        body a.reset_variations:hover,
        .woocommerce a.woocommerce-MyAccount-downloads-file.button:hover,
        body button.button:hover,
        body button.button.alt:hover,
        body .photberry_content_wrapper .checkout-button.button:hover,
        body .woocommerce .cart .button:hover,
        body .woocommerce .cart input.button:hover,
        body.woocommerce ul.products li.product a.added_to_cart.wc-forward:hover,
        body .photberry_content_wrapper #respond input#submit:hover,
        body .photberry_content_wrapper a.button:hover,
        body .photberry_content_wrapper button.button:hover,
        body .photberry_content_wrapper input.button:hover
        body .photberry_content_wrapper .button:hover,
        body .photberry_content_wrapper .widget_price_filter .price_slider_amount .button:hover {
            color:'. $color_button .';
            background: '. $color_main .';
        }
        .woocommerce a.woocommerce-MyAccount-downloads-file.button.alt,
        .woocommerce #respond input#submit.alt,
        .woocommerce a.button.alt,
        .woocommerce button.button.alt,
        .woocommerce input.button.alt,
        body button.button.alt {
            color:'. $color_button .';
            background: '. $color_main .';
        }
        .woocommerce a.woocommerce-MyAccount-downloads-file.button.alt:hover,
        .woocommerce #respond input#submit.alt:hover,
        .woocommerce a.button.alt:hover,
        .woocommerce button.button.alt:hover,
        .woocommerce input.button.alt:hover,
        body button.button.alt:hover {
            color:'. $color_button .';
            background:'. $bg_button .';
        }
        body .photberry_content_wrapper ul.cart_list li a,
        body .photberry_content_wrapper ul.product_list_widget li a {
            color: ' . $color_headings . ';
            font-family: "' . esc_attr(photberry_get_theme_mod('headings_font_family')) . '";
            font-size: ' . absint(photberry_get_theme_mod('h6_font_size')) . 'px;
            line-height: ' . absint(photberry_get_theme_mod('h6_line_height')) . 'px;
            font-weight: ' . esc_attr(photberry_get_theme_mod('headings_font_weight')). ';
        }
        body .photberry_content_wrapper ul.cart_list li a:hover,
        body .photberry_content_wrapper ul.product_list_widget li a:hover {
            color: '. $color_main .';
        }
        body .photberry_content_wrapper ul.cart_list li,
        body .photberry_content_wrapper ul.product_list_widget li {
            border-top:1px solid '. $bg_input .';
        }
        body .photberry_content_wrapper ul.cart_list li:first-child,
        body .photberry_content_wrapper ul.product_list_widget li:first-child {
            border: none;
        }
        body .photberry_content_wrapper .widget_shopping_cart .total,
        .photberry_content_wrapper .woocommerce.widget_shopping_cart .total {
            border-top: 1px solid '. $bg_input .';
        }
        body .photberry_content_wrapper .widget_shopping_cart .total strong,
        .photberry_content_wrapper .woocommerce.widget_shopping_cart .total strong {
            color: '. $color_headings .';
            font-weight: ' . esc_attr(photberry_get_theme_mod('headings_font_weight')). ';
        }
        body .photberry_content_wrapper .widget_price_filter .price_slider_wrapper .ui-widget-content {
            background: '. $bg_button .';
        }
        body .photberry_content_wrapper .widget_price_filter .ui-slider .ui-slider-handle,
        body .photberry_content_wrapper .widget_price_filter .ui-slider .ui-slider-range {
            background: '. $color_main .';
        }

        .woocommerce ul.products li.product .onsale,
        .photberry_tiny .product .onsale {
            color: ' . $color_button . ';
            font-family: "' . esc_attr(photberry_get_theme_mod('headings_font_family')) . '";
            font-size: ' . absint(photberry_get_theme_mod('h6_font_size')) . 'px;
            line-height: ' . absint(photberry_get_theme_mod('h6_line_height')) . 'px;
            font-weight: ' . esc_attr(photberry_get_theme_mod('headings_font_weight')). ';
            background: '. $color_main .';
        }

        body.woocommerce .photberry_content_wrapper ul.products li.product .woocommerce-loop-category__title,
        body.woocommerce .photberry_content_wrapper ul.products li.product .woocommerce-loop-product__title,
        body.woocommerce .photberry_content_wrapper ul.products li.product h3 {
            color: ' . $color_headings . ';
            font-family: "' . esc_attr(photberry_get_theme_mod('headings_font_family')) . '";
            font-weight: ' . esc_attr(photberry_get_theme_mod('headings_font_weight')). ';
            font-size: ' . absint(photberry_get_theme_mod('h6_font_size')) . 'px;
            line-height: ' . absint(photberry_get_theme_mod('h6_line_height')) . 'px;
        }
        body.woocommerce .photberry_content_wrapper ul.products li.product a:hover .woocommerce-loop-category__title,
        body.woocommerce .photberry_content_wrapper ul.products li.product a:hover .woocommerce-loop-product__title,
        body.woocommerce .photberry_content_wrapper ul.products li.product a:hover h3,
        .woocommerce ul.products li.product a:hover .woocommerce-loop-product__title,
        body .wp-block-woocommerce-products ul li a:hover .woocommerce-loop-product__title {
            color: '. $color_main .';
        }

		body.woocommerce .photberry_content_wrapper nav.woocommerce-pagination ul.page-numbers li span {
			font-family: "' . esc_attr(photberry_get_theme_mod('headings_font_family')) . '";
			font-weight: ' . esc_attr(photberry_get_theme_mod('headings_font_weight')). ';
		}
		body.woocommerce .photberry_content_wrapper nav.woocommerce-pagination ul.page-numbers li a {
			color: ' . $color_text . ';
			font-family: "' . esc_attr(photberry_get_theme_mod('headings_font_family')) . '";
			font-weight: ' . esc_attr(photberry_get_theme_mod('headings_font_weight')). ';
		}
		body.woocommerce .photberry_content_wrapper nav.woocommerce-pagination ul.page-numbers li a:hover {
			color:'. $color_main .';
		}


        body table.variations td.label,
        body.woocommerce .photberry_content_wrapper ul.products li.product .price,
        body.woocommerce .photberry_content_wrapper div.product span.price,
        body.woocommerce .photberry_content_wrapper div.product p.price,
        body.woocommerce .photberry_content_wrapper div.product p.price > del,
        body.woocommerce .photberry_content_wrapper div.product span.price > del,
        body.woocommerce .photberry_content_wrapper div.product p.price > ins,
        body.woocommerce .photberry_content_wrapper div.product span.price > ins,
        body.woocommerce .photberry_content_wrapper div.product p.price > span,
        body.woocommerce .photberry_content_wrapper div.product span.price > span,
        body.woocommerce .photberry_content_wrapper ul.products li.product .price > del,
        body.woocommerce .photberry_content_wrapper ul.products li.product .price > ins,
        body.woocommerce .photberry_content_wrapper ul.products li.product .price > span,
        .woocommerce ul.products li.product .price {
            color: ' . $color_headings . ';
            font-family: "' . esc_attr(photberry_get_theme_mod('headings_font_family')) . '";
            font-size: ' . absint(photberry_get_theme_mod('h5_font_size')) . 'px;
            line-height: ' . absint(photberry_get_theme_mod('h5_line_height')) . 'px;
            font-weight: ' . esc_attr(photberry_get_theme_mod('headings_font_weight')). ';
        }
        body.woocommerce .photberry_content_wrapper .woocommerce-result-count,
        body.woocommerce-page .photberry_content_wrapper .woocommerce-result-count {
            color: ' . $color_headings . ';
            font-family: "' . esc_attr(photberry_get_theme_mod('headings_font_family')) . '";
            font-weight: ' . esc_attr(photberry_get_theme_mod('headings_font_weight')). ';
            font-size: ' . absint(photberry_get_theme_mod('h6_font_size')) . 'px;
            line-height: ' . absint(photberry_get_theme_mod('h6_line_height')) . 'px;
        }

        body.woocommerce .photberry_content_wrapper .woocommerce-product-details__short-description {
            border-bottom: 1px solid '. $bg_input .';
        }
        body .woocommerce .quantity .qty,
        body.woocommerce .photberry_content_wrapper .quantity .qty {
            color:'. $color_input .';
            border:2px solid '. $bg_input .';
            font-family: "' . esc_attr(photberry_get_theme_mod('headings_font_family')) . '";
            font-size: ' . absint(photberry_get_theme_mod('h6_font_size')) . 'px;
            font-weight: ' . esc_attr(photberry_get_theme_mod('headings_font_weight')). ';
        }
        body .woocommerce .quantity .qty:focus,
        body.woocommerce .photberry_content_wrapper .quantity .qty:focus {
            border:2px solid '. $color_main .';
        }
        body.woocommerce .photberry_content_wrapper #respond input#submit.alt,
        body.woocommerce .photberry_content_wrapper a.button.alt,
        body.woocommerce .photberry_content_wrapper button.button.alt,
        body.woocommerce .photberry_content_wrapper input.button.alt {
            background: '. $color_main .';
        }
        body.woocommerce .photberry_content_wrapper #respond input#submit.alt:hover,
        body.woocommerce .photberry_content_wrapper a.button.alt:hover,
        body.woocommerce .photberry_content_wrapper button.button.alt:hover,
        body.woocommerce .photberry_content_wrapper input.button.alt:hover {
            background: '. $bg_button .';
        }

        body.woocommerce .photberry_content_wrapper .product_meta > span,
        body.woocommerce .photberry_content_wrapper .product_meta > span a {
            color: ' . $color_headings . ';
            font-family: "' . esc_attr(photberry_get_theme_mod('headings_font_family')) . '";
            font-weight: ' . esc_attr(photberry_get_theme_mod('headings_font_weight')). ';
            font-size: ' . absint(photberry_get_theme_mod('h6_font_size')) . 'px;
            line-height: ' . absint(photberry_get_theme_mod('h6_line_height')) . 'px;
        }
        body.woocommerce .photberry_content_wrapper .product_meta > span:before,
        body.woocommerce .photberry_content_wrapper .product_meta > span a:hover {
            color: '. $color_main .';
        }
        body.woocommerce .photberry_content_wrapper div.product .woocommerce-tabs ul.tabs::before {
            border-bottom: 2px solid '. $bg_input .';
        }

        body.woocommerce .photberry_content_wrapper div.product .woocommerce-tabs ul.tabs li {
            font-family: "' . esc_attr(photberry_get_theme_mod('headings_font_family')) . '";
            font-size: ' . absint(photberry_get_theme_mod('h6_font_size')) . 'px;
            font-weight: ' . esc_attr(photberry_get_theme_mod('headings_font_weight')). ';
            color: '. $color_headings .';
            border: 2px solid '. $bg_input .';
            background: transparent;
        }
        body.woocommerce .photberry_content_wrapper div.product .woocommerce-tabs ul.tabs li:hover {
            color: '. $color_main .';
        }
        body.woocommerce .photberry_content_wrapper div.product .woocommerce-tabs ul.tabs li a {
            color: ' . $color_headings . ';
            font-family: "' . esc_attr(photberry_get_theme_mod('headings_font_family')) . '";
            font-size: ' . absint(photberry_get_theme_mod('h5_font_size')) . 'px;
            line-height: ' . absint(photberry_get_theme_mod('h5_line_height')) . 'px;
            font-weight: ' . esc_attr(photberry_get_theme_mod('headings_font_weight')). ';
        }
        body.woocommerce .photberry_content_wrapper div.product .woocommerce-tabs ul.tabs li:before {
            background: '. $bg_button .';
        }
        body.woocommerce .photberry_content_wrapper div.product .woocommerce-tabs ul.tabs li.active a {
            color: '. $color_main .';
        }
        body.woocommerce .photberry_content_wrapper div.product .woocommerce-tabs ul.tabs li:hover a {
            color: '. $color_main .';
			background: none;
        }
        body.woocommerce .photberry_content_wrapper div.product .woocommerce-tabs ul.tabs li.active:hover {
            border: 2px solid '. $bg_input .';
        }
        body.woocommerce .photberry_content_wrapper div.product .woocommerce-tabs ul.tabs li.active:hover a {
            background: transparent;
            color: '. $color_main .';
        }
        body.woocommerce .photberry_content_wrapper div.product .woocommerce-tabs ul.tabs li.active:before {
            background: '. $bg_body .';
        }

        body.woocommerce .photberry_content_wrapper #content div.product .woocommerce-tabs,
        body.woocommerce .photberry_content_wrapper div.product .woocommerce-tabs,
        body.woocommerce-page .photberry_content_wrapper #content div.product .woocommerce-tabs,
        body.woocommerce-page .photberry_content_wrapper div.product .woocommerce-tabs {
            border-bottom: 1px solid '. $bg_input .';
        }

        body.woocommerce p.stars a,
        body.woocommerce p.stars a:hover,
        body.woocommerce .star-rating {
            color: '. $color_headings .';
        }

        body.woocommerce #reviews #comments ol.commentlist .meta * {
            color: ' . $color_headings . ';
            font-family: "' . esc_attr(photberry_get_theme_mod('headings_font_family')) . '";
            font-size: ' . absint(photberry_get_theme_mod('h6_font_size')) . 'px;
            line-height: ' . absint(photberry_get_theme_mod('h6_line_height')) . 'px;
            font-weight: ' . esc_attr(photberry_get_theme_mod('headings_font_weight')). ';
        }
        body.woocommerce #review_form #respond .comment-reply-title,
        body.woocommerce .product .related.products h2 {
            color: ' . $color_headings . ';
            font-family: "' . esc_attr(photberry_get_theme_mod('headings_font_family')) . '";
            font-size: ' . absint(photberry_get_theme_mod('h5_font_size')) . 'px;
            line-height: ' . absint(photberry_get_theme_mod('h5_line_height')) . 'px;
            font-weight: ' . esc_attr(photberry_get_theme_mod('headings_font_weight')). ';
        }

        body .shop_table.shop_table_responsive tr th,
        body.woocommerce table.shop_attributes tr th {
            color: ' . $color_headings . ';
            font-family: "' . esc_attr(photberry_get_theme_mod('headings_font_family')) . '";
            font-weight: ' . esc_attr(photberry_get_theme_mod('headings_font_weight')). ';
        }
        body.woocommerce table.shop_attributes tr th,
        body.woocommerce table.shop_attributes tr td {
            border: 1px solid '. $bg_input .';
        }

        body nav.woocommerce-MyAccount-navigation ul li {
            color:'. $color_headings .';
        }
        body nav.woocommerce-MyAccount-navigation ul li.is-active,
        body nav.woocommerce-MyAccount-navigation ul li.is-active a {
            color: '. $color_main .'
        }
        #add_payment_method .cart-collaterals .cart_totals tr td,
        #add_payment_method .cart-collaterals .cart_totals tr th,
        .woocommerce-cart .cart-collaterals .cart_totals tr td,
        .woocommerce-cart .cart-collaterals .cart_totals tr th,
        .woocommerce-checkout .cart-collaterals .cart_totals tr td,
        .woocommerce-checkout .cart-collaterals .cart_totals tr th {
            border-color: '. $bg_input .';
        }

        body .photberry_content_wrapper .woocommerce-error,
        body .photberry_content_wrapper .woocommerce-info,
        body .photberry_content_wrapper .woocommerce-message {
            color: '. $color_text .';
        }
        section.woocommerce-order-details .woocommerce-table.woocommerce-table--order-details.order_details tfoot th,
        section.woocommerce-order-details .woocommerce-table.woocommerce-table--order-details.order_details tfoot td,
        .shop_table.woocommerce-checkout-review-order-table tfoot th,
        .shop_table.woocommerce-checkout-review-order-table tfoot td {
            color: '. $color_headings .';
        }

        .photberry_content_wrapper .woocommerce-checkout-payment ul.wc_payment_methods.payment_methods label,
        .photberry_content_wrapper .woocommerce-checkout-payment ul.wc_payment_methods.payment_methods label {
            color: '. $color_text .';
        }
        .photberry_content_wrapper .woocommerce-checkout-payment ul.wc_payment_methods.payment_methods label:hover,
        .photberry_content_wrapper .woocommerce-checkout-payment ul.wc_payment_methods.payment_methods label:hover {
            color: '. $color_headings .';
        }
        .photberry_content_wrapper .woocommerce-checkout-payment ul.wc_payment_methods.payment_methods input[type="radio"]:checked + label:before,
        .photberry_content_wrapper .woocommerce-checkout-payment ul.wc_payment_methods.payment_methods input[type="radio"]:not(:checked) + label:before {
            border: 2px solid '. $bg_input .';
        }
        .photberry_content_wrapper .woocommerce-checkout-payment ul.wc_payment_methods.payment_methods input[type="radio"]:checked + label:hover:before,
        .photberry_content_wrapper .woocommerce-checkout-payment ul.wc_payment_methods.payment_methods input[type="radio"]:not(:checked) + label:hover:before {
            border: 2px solid '. $color_main .';
        }
        .photberry_content_wrapper .woocommerce-checkout-payment ul.wc_payment_methods.payment_methods input[type="radio"]:checked + label:before {
            background: '. $color_main .';
            background-clip: content-box;
        }
        #add_payment_method #payment div.payment_box,
        .woocommerce-cart #payment div.payment_box,
        .woocommerce-checkout #payment div.payment_box {
            background: '. $bg_input .';
            color: '. $color_input .';
        }
        #add_payment_method #payment div.payment_box:before,
        .woocommerce-cart #payment div.payment_box:before,
        .woocommerce-checkout #payment div.payment_box:before {
            border-color: transparent transparent '. $bg_input .' transparent;
        }
        .woocommerce mark {
            background: transparent;
            color: '. $color_headings .';
        }
        .woocommerce fieldset legend {
            color: ' . $color_headings . ';
            font-family: "' . esc_attr(photberry_get_theme_mod('headings_font_family')) . '";
            font-size: ' . absint(photberry_get_theme_mod('h5_font_size')) . 'px;
            line-height: ' . absint(photberry_get_theme_mod('h5_line_height')) . 'px;
            font-weight: ' . esc_attr(photberry_get_theme_mod('headings_font_weight')). ';
        }
        .blockUI.blockOverlay {
            background: '. $bg_body .' !important;
        }

        body .photberry_content_wrapper .woocommerce-error {
            border: 2px solid '. $shop_color_error .';
        }
        body .photberry_content_wrapper .woocommerce-error:before {
            color: '. $shop_color_error .';
        }
        body .photberry_content_wrapper .woocommerce-info {
            border: 2px solid '. $shop_color_info .';
        }
        body .photberry_content_wrapper .woocommerce-info:before {
            color: '. $shop_color_info .';
        }
        body .photberry_content_wrapper .woocommerce-message {
            border: 2px solid '. $shop_color_message .';
        }
        body .photberry_content_wrapper .woocommerce-message:before {
            color: '. $shop_color_message .';
        }

        .woocommerce a.remove,
        body .photberry_content_wrapper .widget_shopping_cart .cart_list li a.remove,
        .photberry_content_wrapper .woocommerce.widget_shopping_cart .cart_list li a.remove {
            color: ' . $shop_color_remove . '!important;
        }
        .woocommerce a.remove:hover,
        body .photberry_content_wrapper .widget_shopping_cart .cart_list li a.remove:hover,
        .photberry_content_wrapper .woocommerce.widget_shopping_cart .cart_list li a.remove:hover {
            color: ' . $color_headings . '!important;
        }
        .woocommerce form .form-row .required,
        body.woocommerce #review_form #respond .required,
        .woocommerce form .form-row abbr.required {
            color: ' . $shop_color_required . ';
        }
        body .photberry_content_wrapper .woocommerce-message {
            font-size:'. esc_attr(photberry_get_theme_mod('main_font_size')) .'px;
            line-height:'. esc_attr(photberry_get_theme_mod('main_line_height')) .'px;
            font-weight:'. esc_attr(photberry_get_theme_mod('main_font_weight')) .';
            color:'. $color_text .';
        }
        .woocommerce ul.products li.product .woocommerce-loop-product__title,
        body .wp-block-woocommerce-products ul li .woocommerce-loop-product__title {
            color: ' . $color_headings . ';
            font-family: "' . esc_attr(photberry_get_theme_mod('headings_font_family')) . '";
            font-weight: ' . esc_attr(photberry_get_theme_mod('headings_font_weight')). ';
            font-size: ' . absint(photberry_get_theme_mod('h6_font_size')) . 'px;
            line-height: ' . absint(photberry_get_theme_mod('h6_line_height')) . 'px;
        }
        body .wp-block-woocommerce-products ul.products li.product  a.woocommerce-LoopProduct-link:hover .woocommerce-loop-product__title {
            color: '. $color_main .';
        }
        body .wp-block-woocommerce-products ul.products li.product span.price {
            color: ' . $color_headings . ';
            font-family: "' . esc_attr(photberry_get_theme_mod('headings_font_family')) . '";
            font-size: ' . absint(photberry_get_theme_mod('h5_font_size')) . 'px;
            line-height: ' . absint(photberry_get_theme_mod('h5_line_height')) . 'px;
            font-weight: ' . esc_attr(photberry_get_theme_mod('headings_font_weight')). ';
        }
        .wp-block-media-text__content .has-large-font-size {
             font-size: ' . absint(photberry_get_theme_mod('h2_font_size')) . 'px;
            line-height: ' . absint(photberry_get_theme_mod('h2_line_height')) . 'px;
            color: ' . $color_headings . ';
            font-family: "' . esc_attr(photberry_get_theme_mod('headings_font_family')) . '";
            font-weight: ' . esc_attr(photberry_get_theme_mod('headings_font_weight')). ';
        }

        @media only screen and (max-width: 760px) {
            .woocommerce ul.products li.product .woocommerce-loop-product__title,
            body .wp-block-woocommerce-products ul li .woocommerce-loop-product__title,
            body.woocommerce .photberry_content_wrapper div.product .product_title {
                font-size: ' . absint(photberry_get_theme_mod('h3_font_size')) . 'px;
                line-height: ' . absint(photberry_get_theme_mod('h3_line_height')) . 'px;
            }
        }

        .photberry_shop_loop_image:before {
            background: rgba('. photberry_hex2rgb($color_main) .', 0);
        }
        .photberry_shop_loop_image:hover:before {
            background: rgba('. photberry_hex2rgb($color_main) .', 0.7);
        }
	';
}
