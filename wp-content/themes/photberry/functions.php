<?php
/*
 * Created by Pixel-Mafia
 * www.pixel-mafia.com
*/

# General
add_theme_support('title-tag');
add_theme_support('post-thumbnails');
add_theme_support('automatic-feed-links');
add_theme_support('post-formats', array('image', 'video', 'audio', 'gallery'));

if (!isset($content_width)) {
    $content_width = 1130;
}

# Custom get_theme_mod
function photberry_get_theme_mod($name) {
	if (func_num_args() > 1) {
		die ('The photberry_get_theme_mod("'.$name.'") function takes only one argument. Define default values in core/customizer.php.');
	}

	global $photberry_customizer_default_values;

	if (!isset($photberry_customizer_default_values[$name])) {
		die ('Error! You did not add the default value for the "'.$name.'" option! core/customizer.php.');
	}
	return get_theme_mod($name, $photberry_customizer_default_values[$name]);
}

# ADD Localization Folder
add_action('after_setup_theme', 'photberry_pomo');
function photberry_pomo()
{
    load_theme_textdomain('photberry', get_template_directory() . '/languages');
}

require_once(get_template_directory() . "/core/init.php");

# ADD Theme Settings Page
add_action('admin_menu', 'photberry_add_menu');
function photberry_add_menu()
{
    add_theme_page('Photberry', 'Photberry', 'administrator', 'photberry_settings_page', 'photberry_theme_settings_page' );
}

# Show Admin Settings Page
function photberry_theme_settings_page()
{
    if (!current_user_can('manage_options')) {
        wp_die(esc_html__('You do not have permissions to access this page.', 'photberry'));
    }
	echo '
    <div class="photberry_admin_wrapper">
    	<h1>Hey!</h1>
	    <p>'. esc_html__('All settings of our theme are made through a standard Customizer. Click', 'photberry') .' <a href="'.esc_url(get_admin_url(null, 'customize.php')).'">'. esc_html__('here', 'photberry') .'</a> '. esc_html__('to go to the settings','photberry') .'</p>

		<p>'. esc_html__('If you want to reset all settings, feel free to click on ', 'photberry') . '<a href="#" class="photberry_reset_all_settings">'. esc_html__('this link','photberry') . '</a>. '. esc_html__('But remember that there is no turning back ;)', 'photberry') .'</p>

		<p>'. esc_html__('If you have any questions, problems or want to talk - email us via the form on ','photberry').'<a href="'. esc_url('http://themeforest.net/user/pixel-mafia', 'photberry') .'" target="_blank">'. esc_html__('this', 'photberry') .'</a> '. esc_html('page.', 'photberry') .'</p>
    </div>
    ';
}

# Register CSS/JS
add_action('wp_enqueue_scripts', 'photberry_css_js');
if (!function_exists('photberry_css_js')) {
    function photberry_css_js()
    {
        # CSS
        wp_enqueue_style('pm-font-awesome', get_template_directory_uri() . '/css/pm-font-awesome.min.css');
        wp_enqueue_style('photberry-kube', get_template_directory_uri() . '/css/kube.css');
        wp_enqueue_style('photberry-elements', get_template_directory_uri() . '/css/elementor.css');
		wp_enqueue_style('photberry-theme', get_template_directory_uri() . '/css/theme.css');
        wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/css/owl.carousel.css');
		if (photberry_get_theme_mod('responsive_status') == 'on') {
			wp_enqueue_style('photberry-responsive', get_template_directory_uri() . '/css/responsive.css');
		}
		wp_enqueue_style('photberry-swipebox', get_template_directory_uri() . '/css/swipebox.css');
		if (photberry_is_woocommerce_activated()) {
			wp_enqueue_style('photberry-woocommerce', get_template_directory_uri() . '/css/woocommerce.css');
		}

        # JS
        wp_enqueue_script('photberry-theme', get_template_directory_uri() . '/js/theme.js', array('jquery'), false, true);
		if (photberry_is_woocommerce_activated()) {
			wp_enqueue_script('photberry-woocommerce', get_template_directory_uri() . '/js/woocommerce.js', array('jquery'), false, true);
		}
		wp_enqueue_script('mousewheel_js', get_template_directory_uri() . '/js/jquery.mousewheel.js', array(), false, true);
        wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', true, false, true);
        wp_enqueue_script('slick-slider', get_template_directory_uri() . '/js/slick.min.js', true, false, true);
		wp_enqueue_script('jquery_swipebox', get_template_directory_uri() . '/js/jquery.swipebox.js', true, false, true);
		wp_enqueue_script('jquery-event-swipe', get_template_directory_uri() . '/js/jquery.event.swipe.js', array('jquery'), false, true);
        wp_localize_script('photberry-theme', 'photberry_ajaxurl',
			array(
				'url' => admin_url('admin-ajax.php')
			)
		);

        global $photberry_custom_css;
        wp_add_inline_style('photberry-theme', $photberry_custom_css);
    }
}

# Register CSS/JS for Admin Settings
add_action('admin_enqueue_scripts', 'photberry_admin_css_js');
if (!function_exists('photberry_admin_css_js')) {
    function photberry_admin_css_js()
    {
		add_editor_style(array('css/editor.css', 'css/pm-font-awesome.min.css'));
        # CSS
        wp_enqueue_style('pm-font-awesome', get_template_directory_uri() . '/css/pm-font-awesome.min.css');
        wp_enqueue_style('photberry-admin', get_template_directory_uri() . '/css/admin.css');
        # JS
        wp_enqueue_script('photberry-admin', get_template_directory_uri() . '/js/admin.js', array('jquery', 'jquery-ui-core', 'jquery-ui-sortable'), false, true);
    }
}

# WP Footer
add_action('wp_footer', 'photberry_wp_footer');
function photberry_wp_footer()
{
    photberryHelper::getInstance()->echoFooter();
}

# Register Menu
add_action('init', 'photberry_register_menu');
function photberry_register_menu()
{
    register_nav_menus(
        array(
            'main' => esc_attr__('Main menu', 'photberry')
        )
    );
}

# Logo
function photberry_the_logo($position = 'header')
{
    if ($position == 'header') {
        $prefix = '';
    }
    if ($position == 'footer') {
        $prefix = 'footer_';
    }
    if (photberry_get_theme_mod($prefix . 'logo_type') == 'image_logo') {
        echo '<div class="photberry_logo_cont"><a href="' . esc_url(home_url('/')) . '" class="photberry_image_logo ' . (photberry_get_theme_mod($prefix . 'logo_retina') == true ? 'photberry_retina' : '') . '"></a></div>';
    } else {
        echo '<div class="photberry_text_logo photberry_logo_cont"><a href="' . esc_url(home_url('/')) . '">' . photberry_get_theme_mod($prefix . 'logo_text_caption') . '</a></div>';
    }
}

# Hex 2 RGB
function photberry_hex2rgb($hex)
{
    $hex = str_replace("#", "", $hex);

    if (strlen($hex) == 3) {
        $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
        $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
        $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
    } else {
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
    }
    return $r . "," . $g . "," . $b;
}

# Register Sidebars
add_action('widgets_init', 'photberry_widgets_init');
function photberry_widgets_init()
{
    register_sidebar(
        array(
            'name' => esc_attr__('Sidebar', 'photberry'),
            'id' => 'sidebar',
            'description' => esc_attr__('Widgets in this area will be shown on all posts and pages.', 'photberry'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h6 class="widgettitle"><span>',
            'after_title' => '</span></h6>',
        )
    );

    register_sidebar(
        array(
            'name' => esc_attr__('Sidebar Footer', 'photberry'),
            'id' => 'sidebar-footer',
            'description' => esc_attr__('Widgets in this area will be shown on footer area.', 'photberry'),
            'before_widget' => '<div id="%1$s" class="widget footer_widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h6 class="widgettitle"><span>',
            'after_title' => '</span></h6>',
        )
    );

	if (photberry_is_woocommerce_activated()) {
		register_sidebar(
			array(
				'name' => esc_attr__('Sidebar Woocommerce', 'photberry'),
				'id' => 'sidebar-woocommerce',
				'description' => esc_attr__('Widgets in this area will be shown on Woocommerce Pages.', 'photberry'),
				'before_widget' => '<div id="%1$s" class="widget woocommerce_widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h6 class="widgettitle"><span>',
				'after_title' => '</span></h6>',
			)
		);
	}
}

# Post Formats
function photberry_get_post_formats($args = array())
{
    if (photberry_post_options()) {
        if (!empty($args)) {
            extract($args);
            #if (isset($output_template) && $output_template == '') {}
        }

        $photberry_post_format = get_post_format();
        if (empty($photberry_post_format)) {
            $photberry_post_format = 'standard';
        }
		$photberry_pf_style = photberry_get_post_option('post_pf_style', 'boxed');

        $html = '';
        $html .= '<div class="photberry_post_formats photberry_pf_' . $photberry_post_format . ' photberry_pf_'. $photberry_pf_style.'">';

        # Post Format Image
        if ($photberry_post_format == 'image') {
            if (is_array(photberry_get_post_option('photberry_pf_images'))) {
                $html .= '<div class="photberry_owlCarousel owl-carousel owl-theme">';
                foreach (photberry_get_post_option('photberry_pf_images') as $key => $image) {
                    if (photberry_get_post_option('photberry_pf_images_crop_status', 'yes') == 'yes') {
                        $html .= '<div class="item"><img src="' . aq_resize($image['full_url'], photberry_get_post_option('photberry_pf_images_width', '1600'), photberry_get_post_option('photberry_pf_images_height', '900'), true, true, true) . '" alt="' . $image['alt'] . '"></div>';

                    } else {
                        $html .= '<div><img src="' . $image['full_url'] . '" alt="' . $image['alt'] . '"></div>';
                    }
                }
                $html .= '</div>';

                photberryHelper::getInstance()->addJSToFooter('owl_post_formats', '
                    jQuery(".photberry_owlCarousel").on("initialized.owl.carousel", function(e) {
                        jQuery(".photberry_owlCarousel").css("opacity", "1");
                    });
                    jQuery(".photberry_owlCarousel").owlCarousel(
                        {
                            items:1,
                            lazyLoad:true,
                            loop:true,
                            dots:false,
                            nav:true,
                            navText:["", ""],
                            autoplay:true,
                            autoplayTimeout:5000,
                            autoplayHoverPause:true,
                            autoHeight:true
                        }
                    );
                ', 'window-load');
            } else {
				if ($photberry_pf_style == 'fullwidth') {
                	$html .= '<img class="photberry_stand_fi" src="' . aq_resize(photberry_get_featured_image_url(), 1920, 750, true, true, true) . '" alt="'. get_the_title() .'">';
				} else {
					$html .= '<img class="photberry_stand_fi" src="' . aq_resize(photberry_get_featured_image_url(), 1170, 750, true, true, true) . '" alt="'. get_the_title() .'">';
				}
            }
        }

        # Post Format Video
        if ($photberry_post_format == 'video') {
            $html .= '<div class="photberry_pf_video_cont" style="height:' . photberry_get_post_option('photberry_pf_video_height', '500') . 'px;">' . photberry_get_post_option('photberry_pf_video_url') . '</div>';
        }

        # Post Format Gallery
        if ($photberry_post_format == 'gallery') {
			$items_in_row = photberry_get_post_option('photberry_pf_gal_in_row', '4');
			$html .= '<div class="photberry_pf_gallery photberry_pf_gallery'. $items_in_row .'">';
			$photberry_pf_gal_images = photberry_get_post_option('photberry_pf_gal_images');
			$count = 0;
			$count_breaker = 0;
			if (isset($photberry_is_listing) && $photberry_is_listing == true) {
				$count_breaker = absint(photberry_get_post_option('photberry_pf_gal_on_listing', '8'));
			}
			if (!empty($photberry_pf_gal_images)) {
				foreach (photberry_get_post_option('photberry_pf_gal_images') as $key => $image) {
					$count++;
					if ($items_in_row == 1 && photberry_get_post_option('photberry_pf_gal_real_prop', 'yes')) {
						$html .= '<div class="photberry_pf_gallery_item"><a rel="pf_grid_gallery'. get_the_ID() .'" href="'. esc_url($image['full_url']) .'" class="swipebox" data-elementor-open-lightbox="no"><img src="' . aq_resize($image['full_url'], '1170', '', true, true, true) . '" alt="' . $image['alt'] . '"></a></div>';
					} else {
						$html .= '<div class="photberry_pf_gallery_item"><a rel="pf_grid_gallery'. get_the_ID() .'" href="'. esc_url($image['full_url']) .'" class="swipebox" data-elementor-open-lightbox="no"><img src="' . aq_resize($image['full_url'], photberry_get_post_option('photberry_pf_gal_img_width', '1140'), photberry_get_post_option('photberry_pf_gal_img_height', '860'), true, true, true) . '" alt="' . $image['alt'] . '"></a></div>';
					}
					if ($count_breaker > 0 && $count == $count_breaker) {
						break;
					}
				}
			}

			$html .= '</div>';
		}

        # Post Format Audio
        if ($photberry_post_format == 'audio') {
            $html .= '<div class="photberry_pf_audio_cont">' . photberry_get_post_option('photberry_pf_audio_url') . '</div>';
        }

        # Post Format Standard
        if ($photberry_post_format == 'standard') {
            $photberry_attachment_ID = get_post_thumbnail_id(get_the_ID());

            if (isset($photberry_attachment_ID) && $photberry_attachment_ID !== '' && $photberry_attachment_ID !== 0) {
                $photberry_attachment_array = wp_get_attachment_metadata($photberry_attachment_ID);

                $photberry_attachment_width = $photberry_attachment_array['width'];
                $photberry_attachment_height = $photberry_attachment_array['height'];

				if ($photberry_pf_style == 'fullwidth') {
					$photberry_image_width = 1920;
					$photberry_image_height = 750;
				} else {
					$photberry_image_width = 1170;
					$photberry_image_height = 750;
				}

                $html .= '
                    <div class="photberry_pf_standard_cont">
                        ';

                        if ($photberry_attachment_width > 1170) {
                            if (($photberry_attachment_width / $photberry_attachment_height) > 1) {
                                $html .= '
                                    <img src="' . aq_resize(esc_url(photberry_get_featured_image_url()), $photberry_image_width, $photberry_image_height, true, true, true) . '" alt="'. get_the_title() .'" />
                                ';
                            } else {
                                $html .= '
                                    <img src="' . aq_resize(esc_url(photberry_get_featured_image_url()), $photberry_image_width, "", true, true, true) . '" alt="'. get_the_title() .'" />
                                ';
                            }
                        } else {
                            $html .= '
                                <img src="' . esc_url(photberry_get_featured_image_url()) . '" alt="'. get_the_title() .'" />
                            ';
                        }

                        $html .= '
                    </div>
                ';
            }
        }

        $html .= '</div>';
        return $html;
    } else {
        $photberry_attachment_ID =get_post_thumbnail_id(get_the_ID());
        $html = '';

        if (isset($photberry_attachment_ID) && $photberry_attachment_ID !== '') {
            $photberry_attachment_array = wp_get_attachment_metadata($photberry_attachment_ID);

            $photberry_attachment_width = $photberry_attachment_array['width'];
            $photberry_attachment_height = $photberry_attachment_array['height'];
            $photberry_image_width = 1170;
            $photberry_image_height = 760;

            $html .= '
                <div class="photberry_post_formats">
                    <div class="photberry_pf_standard_cont">
                        ';

                        if ($photberry_attachment_width > 1170) {
                            if (($photberry_attachment_width / $photberry_attachment_height) > 1) {
                                $html .= '
                                    <img src="' . aq_resize(esc_url(photberry_get_featured_image_url()), $photberry_image_width, $photberry_image_height, true, true, true) . '" alt="'. get_the_title() .'" />
                                ';
                            } else {
                                $html .= '
                                    <img src="' . aq_resize(esc_url(photberry_get_featured_image_url()), $photberry_image_width, "", true, true, true) . '" alt="'. get_the_title() .'" />
                                ';
                            }
                        } else {
                            $html .= '
                                <img src="' . esc_url(photberry_get_featured_image_url()) . '" alt="'. get_the_title() .'" />
                            ';
                        }

                        $html .= '
                    </div>
                </div>
            ';
        }

        return $html;
    }
}

function photberry_get_post_formats_for_listings() {
    $photberry_attachment_ID =get_post_thumbnail_id(get_the_ID());
    $html = '';

    if (isset($photberry_attachment_ID) && $photberry_attachment_ID !== '') {
        $photberry_attachment_array = wp_get_attachment_metadata($photberry_attachment_ID);

        $photberry_attachment_width = $photberry_attachment_array['width'];
        $photberry_attachment_height = $photberry_attachment_array['height'];
        $photberry_image_width = 1170;
        $photberry_image_height = 760;

        $html .= '
            <div class="photberry_post_formats">
                <div class="photberry_pf_standard_cont">
                    ';

                    if ($photberry_attachment_width > 1170) {
                        if (($photberry_attachment_width / $photberry_attachment_height) > 1) {
                            $html .= '
                                <img src="' . aq_resize(esc_url(photberry_get_featured_image_url()), $photberry_image_width, $photberry_image_height, true, true, true) . '" alt="'. get_the_title() .'" />
                            ';
                        } else {
                            $html .= '
                                <img src="' . aq_resize(esc_url(photberry_get_featured_image_url()), $photberry_image_width, "", true, true, true) . '" alt="'. get_the_title() .'" />
                            ';
                        }
                    } else {
                        $html .= '
                            <img src="' . esc_url(photberry_get_featured_image_url()) . '" alt="'. get_the_title() .'" />
                        ';
                    }

                    $html .= '
                </div>
            </div>
        ';
    }

    return $html;
}

# RWMB check
function photberry_post_options()
{
    if (class_exists('RWMB_Loader')) {
        return true;
    } else {
        return false;
    }
}

# RWMB get option
function photberry_get_post_option($name, $default = false)
{
    if (class_exists('RWMB_Loader')) {
        if (rwmb_meta($name)) {
            return rwmb_meta($name);
        } else {
            return $default;
        }
    } else {
        return $default;
    }
}

# Get Preffered Option
function photberry_get_prefered_option($name)
{
	if (func_num_args() > 1) {
		die ('The photberry_get_prefered_option("'.$name.'") function may takes only one argument.');
	}

	global $photberry_customizer_default_values;

	if (!isset($photberry_customizer_default_values[$name])) {
		die ('Error! You did not add the default value for the "'.$name.'" option! core/customizer.php.');
	}

    if (photberry_get_post_option($name) && photberry_get_post_option($name) !== 'default') {
        return photberry_get_post_option($name, $photberry_customizer_default_values[$name]);
    } else {
        return photberry_get_theme_mod($name);
    }
}

# Get Featured Image Url
function photberry_get_featured_image_url()
{
    $featured_image_full_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
    if (isset($featured_image_full_url[0]) && strlen($featured_image_full_url[0]) > 0) {
        return $featured_image_full_url[0];
    } else {
        return false;
    }
}

# Get Image Meta
function photberry_get_attachment($attachment_id)
{
    $attachment = get_post($attachment_id);
    return array(
        'alt' => get_post_meta($attachment->ID, '_wp_attachment_image_alt', true),
        'caption' => $attachment->post_excerpt,
        'description' => $attachment->post_content,
        'href' => get_permalink($attachment->ID),
        'src' => $attachment->guid,
        'title' => $attachment->post_title
    );
}

# Featured Posts
function photberry_featured_posts($args = array('orderby' => 'rand', 'numberposts' => '2', 'featured_image_status' => 'show', 'excerpt' => 'show', 'post_meta' => 'show', 'post_type' => 'post'))
{
    extract($args);
	$currentID = get_the_ID();
	$args = array(
		'post_type' => esc_attr($post_type),
		'post__not_in' => array($currentID),
		'post_status' => 'publish',
		'orderby' => esc_attr($orderby),
		'posts_per_page' => absint($numberposts),
		'ignore_sticky_posts' => 1
	);

	query_posts($args);

	if (have_posts()) {

		echo '
			<h5 class="photberry_featured_posts_heading">
				' . esc_html__('You may also like', 'photberry') . '
			</h5>

			<div class="photberry_featured_posts photberry_items_' . esc_attr($numberposts) . '">
				';

				while (have_posts()) {
					the_post();

					if ($numberposts == '2') {
						$featured_image = aq_resize(esc_url(photberry_get_featured_image_url()), 1170, 959, true, true, true);
						$post_excerpt = substr(get_the_excerpt(), 0, 140);
					}

					if ($numberposts == '3') {
						$featured_image = aq_resize(esc_url(photberry_get_featured_image_url()), 780, 634, true, true, true);
						$post_excerpt = substr(get_the_excerpt(), 0, 130);
					}

					if ($numberposts == '4') {
						$featured_image = aq_resize(esc_url(photberry_get_featured_image_url()), 584, 546, true, true, true);
						$post_excerpt = substr(get_the_excerpt(), 0, 100);
					}
					?>
					<?php if (get_post_type() == 'pm-portfolio') {
						//Portfolio Item
					?>
						<div class="photberry_posts_item photberry_port_item">
							<a href="<?php echo esc_url(get_permalink()); ?>">
								<div class="photberry_fimage_cont">
										<img src="<?php echo esc_url($featured_image); ?>" alt="<?php the_title(); ?>" />
								</div>
								<?php
								$port_tax = esc_attr(photberry_get_theme_mod('portfolio_pt_tax'));
								$terms = get_the_terms(get_the_ID(), $port_tax);
								$categories = array();
								$categories_class = '';
								if (is_array($terms)) {
									foreach ($terms as $term) {
										$category_name = strtr($term->name, array(
											" " => "-",
											"'" => "-",
										));
										array_push($categories, esc_html($term->name));
									}
								}
								?>
								<div class="photberry_port_item_cont">
									<h6><?php echo (is_array($categories) ? join(', ', $categories) : esc_html('Uncategorized', 'photberry')); ?></h6>
									<h3 class="photberry_post_title"><?php echo get_the_title(); ?></h3>
								</div>
							</a>
						</div>
						<?php
					} else {
						//Post Item
						?>
						<div class="photberry_posts_item">
							<?php
							if ($featured_image_status == 'show') {
							?>
								<div class="photberry_fimage_cont">
									<a href="<?php echo esc_url(get_permalink()); ?>">
										<img src="<?php echo esc_url($featured_image); ?>" alt="<?php the_title(); ?>" />
									</a>
								</div>
							<?php
							}

							if ($post_meta == 'show') {
							?>
								<div class="photberry_post_meta">
									<div class="photberry_post_meta_item">
										<?php echo get_the_date(); ?>
									</div>
									<div class="photberry_post_meta_item">
										<?php echo esc_html__('by', 'photberry'); echo ' '; the_author_posts_link(); ?>
									</div>
									<div class="photberry_post_meta_item">
										<?php echo esc_html__('in', 'photberry'); echo ' '; the_category('<span>+</span>'); ?>
									</div>
								</div>
							<?php
							}
							?>

							<h4 class="photberry_post_title">
								<a href="<?php echo esc_url(get_permalink()); ?>">
									<?php echo get_the_title(); ?>
								</a>
							</h4>

							<?php
							if ($excerpt == 'show') {
							?>
								<div class="photberry_excerpt">
									<?php echo esc_html($post_excerpt); ?>
								</div>
							<?php
							}
							?>
						</div>

						<?php
					}
				}
				wp_reset_query();

				echo '
			</div>
		';
	}
}

# Transparent Header Check
function photberry_transparent_header_check()
{
    if (!is_404()) {
		photberryHelper::getInstance()->addJSToFooter('non_transp_head', '
			+jQuery("html").addClass("photberry_non_transparent_header");
		');
    } else {
        photberryHelper::getInstance()->addJSToFooter('transp_head', '
            jQuery("html").addClass("photberry_transparent_header");
        ');
    }
}

# Header Type Check
function photberry_header_type_check()
{
	if (photberry_get_prefered_option('header_type') == 'show_by_click') {
		photberryHelper::getInstance()->addJSToFooter('transp_head', '
			jQuery("html").addClass("photberry_toggled_header");
		');
	}
}

# Excerpt Truncate
if (!function_exists('photberry_excerpt_truncate')) {
    function photberry_excerpt_truncate($photberry_string, $photberry_length = 80, $photberry_etc = '... ', $photberry_break_words = false, $photberry_middle = false)
    {
        if ($photberry_length == 0)
            return '';

        if (mb_strlen($photberry_string, 'utf8') > $photberry_length) {
            $photberry_length -= mb_strlen($photberry_etc, 'utf8');
            if (!$photberry_break_words && !$photberry_middle) {
                $photberry_string = preg_replace('/\s+\S+\s*$/su', '', mb_substr($photberry_string, 0, $photberry_length + 1, 'utf8'));
            }
            if (!$photberry_middle) {
                return mb_substr($photberry_string, 0, $photberry_length, 'utf8') . $photberry_etc;
            } else {
                return mb_substr($photberry_string, 0, $photberry_length / 2, 'utf8') . $photberry_etc . mb_substr($photberry_string, -$photberry_length / 2, utf8);
            }
        } else {
            return $photberry_string;
        }
    }
}

# Albums Packery Filtering
if (!function_exists('photberry_albums_grid_filtering')) {
    function photberry_albums_grid_filtering($post_type_terms = "") {

        $html = '';
        $permalink = get_permalink();
        $args = array('taxonomy' => 'Category', 'field' => 'slug', 'include' => $post_type_terms);
        $terms = get_terms(esc_attr(photberry_get_theme_mod('albums_pt_tax')), $args);

        if (count($terms) > 0) {
            $html .= '
            <li class="photberry_filter-item ' . (!isset($_GET['slug']) ? 'is-checked' : '') . '">
                <a href="' . esc_url($permalink) . '" data-category="*">
                    ' . esc_html__('All', 'photberry') . '
                </a>
            </li>
            ';

            if (is_array($terms)) {
                foreach ($terms as $term) {
                    $permalink = add_query_arg("slug", $term->term_id, $permalink);

                    $catname = strtr($term->name, array(
                        ' ' => '-',
                    ));
                    $catname = strtolower($catname);

                    if (isset($_GET['slug'])) {
                        $slug = $_GET['slug'];
                    } else {
                        $slug = '';
                    }

                    $categ_id = $term->term_id;

                    if (strnatcasecmp($slug, $categ_id) == 0) {
                        $temp_class = 'is-checked';
                    } else {
                        $temp_class = '';
                    }

                    $html .= '
                    <li class="photberry_filter-item ' . esc_attr($temp_class) . '">
                        <a href="' . esc_url($permalink) . '" data-category=".' . esc_attr($catname) . '">
                            ' . esc_html($term->name) . '
                        </a>
                    </li>
                    ';
                }
            }

            return '
            <ul id="filters" class="photberry_grid_filter">' . $html . '</ul>
            ';
        }
    }
}
# Portfolio Packery Filtering
if (!function_exists('photberry_portfolio_packery_filtering')) {
    function photberry_portfolio_packery_filtering($post_type_terms = "") {

        $html = '';
        $permalink = get_permalink();
        $args = array('taxonomy' => 'Category', 'field' => 'slug', 'include' => $post_type_terms);
        $terms = get_terms(esc_attr(photberry_get_theme_mod('portfolio_pt_tax')), $args);

        if (count($terms) > 0) {
            $html .= '
            <li class="photberry_filter-item ' . (!isset($_GET['slug']) ? 'is-checked' : '') . '">
                <a href="' . esc_url($permalink) . '" data-category="*">
                    ' . esc_html__('All', 'photberry') . '
                </a>
            </li>
            ';

            if (is_array($terms)) {
                foreach ($terms as $term) {
                    $permalink = add_query_arg("slug", $term->term_id, $permalink);

                    $catname = strtr($term->name, array(
                        ' ' => '-',
                    ));
                    $catname = strtolower($catname);

                    if (isset($_GET['slug'])) {
                        $slug = $_GET['slug'];
                    } else {
                        $slug = '';
                    }

                    $categ_id = $term->term_id;

                    if (strnatcasecmp($slug, $categ_id) == 0) {
                        $temp_class = 'is-checked';
                    } else {
                        $temp_class = '';
                    }

                    $html .= '
                    <li class="photberry_filter-item ' . esc_attr($temp_class) . '">
                        <a href="' . esc_url($permalink) . '" data-category=".' . esc_attr($catname) . '">
                            ' . esc_html($term->name) . '
                        </a>
                    </li>
                    ';
                }
            }

            return '
            <ul id="filters" class="photberry_grid_filter">' . $html . '</ul>
            ';
        }
    }
}

# Portfolio Grid Filtering
if (!function_exists('photberry_portfolio_grid_filtering')) {
    function photberry_portfolio_grid_filtering($post_type_terms = "") {
        $html = '';
        $permalink = get_permalink();
        $args = array('taxonomy' => 'Category', 'field' => 'slug', 'include' => $post_type_terms);
        $terms = get_terms(esc_attr(photberry_get_theme_mod('portfolio_pt_tax')), $args);

        if (count($terms) > 0) {
            $html .= '
            <li class="photberry_filter-item ' . (!isset($_GET['slug']) ? 'is-checked' : '') . '">
                <a href="#filter" data-category="*">
                    ' . esc_html__('All', 'photberry') . '
                </a>
            </li>
            ';

            if (is_array($terms)) {
                foreach ($terms as $term) {
                    $permalink = add_query_arg("slug", $term->term_id, $permalink);

                    $catname = strtr($term->name, array(
                        ' ' => '-',
                    ));
                    $catname = strtolower($catname);

                    if (isset($_GET['slug'])) {
                        $slug = $_GET['slug'];
                    } else {
                        $slug = '';
                    }

                    $categ_id = $term->term_id;

                    if (strnatcasecmp($slug, $categ_id) == 0) {
                        $temp_class = 'is-checked';
                    } else {
                        $temp_class = '';
                    }

                    $html .= '
                    <li class="photberry_filter-item ' . esc_attr($temp_class) . '">
                        <a href="#filter" data-category=".' . esc_attr($catname) . '">
                            ' . esc_html($term->name) . '
                        </a>
                    </li>
                    ';
                }
            }

            return '
            <ul id="filters" class="photberry_grid_filter">' . $html . '</ul>
            ';
        }
    }
}

# PRE
function photberry_pre($array)
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

# Admin Footer
add_filter('admin_footer', 'photberry_admin_footer');
function photberry_admin_footer()
{
	if (strlen(get_page_template_slug())>0) {
	    echo "<input type='hidden' name='' value='" . (get_page_template_slug() ? get_page_template_slug() : '') . "' class='photberry_this_template_file'>";
    }
}

function photberry_remove_post_format_parameter($url) {
    $url = remove_query_arg('post_format', $url);
    return $url;
}
add_filter('preview_post_link', 'photberry_remove_post_format_parameter', 9999);

function photberry_objectToArray ($object) {
    if(!is_object($object) && !is_array($object))
        return $object;

    return array_map('photberry_objectToArray', (array) $object);
}

# Social Buttons in Footer
if (!function_exists('photberry_social_buttons_in_footer')) {
    function photberry_social_buttons_in_footer() {

        $html = '';

        # Facebook
        if (photberry_get_theme_mod('footer_facebook') !== '') {
            $html .= '
                <a class="photberry_footer_social_button photberry_facebook" href="' . esc_url(photberry_get_theme_mod('footer_facebook')) . '">
                    <i class="pm-fa pm-fa-facebook"></i>
                </a>
            ';
        }

        # Twitter
        if (photberry_get_theme_mod('footer_twitter') !== '') {
            $html .= '
            <a class="photberry_footer_social_button photberry_twitter" href="' . esc_url(photberry_get_theme_mod('footer_twitter')) . '">
                <i class="pm-fa pm-fa-twitter"></i>
            </a>
            ';
        }

        # LinkedIn
        if (photberry_get_theme_mod('footer_linkedin') !== '') {
            $html .= '
            <a class="photberry_footer_social_button photberry_linkedin" href=" ' . esc_url(photberry_get_theme_mod('footer_linkedin')) . '">
                <i class="pm-fa pm-fa-linkedin"></i>
            </a>
            ';
        }

        # YouTube
        if (photberry_get_theme_mod('footer_youtube') !== '') {
            $html .= '
            <a class="photberry_footer_social_button photberry_youtube" href=" ' . esc_url(photberry_get_theme_mod('footer_youtube')) . '">
                <i class="pm-fa pm-fa-youtube"></i>
            </a>
            ';
        }

        # Instagram
        if (photberry_get_theme_mod('footer_instagram') !== '') {
            $html .= '
            <a class="photberry_footer_social_button photberry_instagram" href="' . esc_url(photberry_get_theme_mod('footer_instagram')) . '">
                <i class="pm-fa pm-fa-instagram"></i>
            </a>
            ';
        }

        # Pinterest
        if (photberry_get_theme_mod('footer_pinterest') !== '') {
            $html .= '
            <a class="photberry_footer_social_button photberry_pinterest" href="' . esc_url(photberry_get_theme_mod('footer_pinterest')) . '">
                <i class="pm-fa pm-fa-pinterest"></i>
            </a>
            ';
        }

        # Tumblr
        if (photberry_get_theme_mod('footer_tumbl') !== '') {
            $html .= '
            <a class="photberry_footer_social_button photberry_tumbl" href="' . esc_url(photberry_get_theme_mod('footer_tumbl')) . '">
                <i class="pm-fa pm-fa-tumblr"></i>
            </a>
            ';
        }

        # Flickr
        if (photberry_get_theme_mod('footer_flickr') !== '') {
            $html .= '
            <a class="photberry_footer_social_button photberry_flickr" href="' . esc_url(photberry_get_theme_mod('footer_flickr')) . '">
                <i class="pm-fa pm-fa-flickr"></i>
            </a>
            ';
        }

        # VK
        if (photberry_get_theme_mod('footer_vk') !== '') {
            $html .= '
            <a class="photberry_footer_social_button photberry_vk" href="' . esc_url(photberry_get_theme_mod('footer_vk')) . '">
                <i class="pm-fa pm-fa-vk"></i>
            </a>
            ';
        }

        # Dribbble
        if (photberry_get_theme_mod('footer_dribbble') !== '') {
            $html .= '
            <a class="photberry_footer_social_button photberry_dribbble" href="' . esc_url(photberry_get_theme_mod('footer_dribbble')) . '">
                <i class="pm-fa pm-fa-dribbble"></i>
            </a>
            ';
        }

        # Vimeo
        if (photberry_get_theme_mod('footer_vimeo') !== '') {
            $html .= '
                <a class="photberry_footer_social_button photberry_vimeo" href="' . esc_url(photberry_get_theme_mod('footer_vimeo')) . '">
                    <i class="pm-fa pm-fa-vimeo"></i>
                </a>
            ';
        }

		# Shoping Cart
		if (photberry_is_woocommerce_activated() && photberry_get_theme_mod('cart_in_header') == 'show') {
			$html .= '
				<a class="photberry_shopping_cart" href="'. esc_js(wc_get_cart_url()) .'" data-items="'. WC()->cart->get_cart_contents_count() .'">
					<i class="pm-fa pm-fa-shopping-cart"></i>
				</a>
			';
		}

        return $html;
    }
}

# Demo Class
# update_option('pm_demo', 'true');
if (get_option('pm_demo') == 'true') {
    add_filter( 'body_class', 'pm_demo_body_class');
	function pm_demo_body_class($classes) {
        return array_merge( $classes, array( 'photberry_demo' ) );
    }
}

function wp_body_classes( $classes ) {
	if (get_page_template_slug() == "page-centered.php") {
		$classes[] = 'body_photberry_no_sidebar';
	} else {
		if (is_category() || is_search() || is_home() || is_archive()) {
			$classes[] = 'body_' . photberry_get_theme_mod('sidebar_position');
		} else {
			$classes[] = 'body_' . photberry_get_prefered_option('sidebar_position');
		}
	}
    $classes[] = 'class-name';

    return $classes;
}
add_filter( 'body_class','wp_body_classes' );

add_filter('mce_buttons_2', 'photberry_mce_buttons_2');
function photberry_mce_buttons_2($buttons)
{
	array_push($buttons, 'newdocument');
    array_push($buttons, 'backcolor');
    return $buttons;
}

# Customizer Preview
function photberry_preview_customizer() {
    # update_option('pm_demo', 'true');
    if (get_option('pm_demo') == 'true') {
    ?>
    <div class="photberry_preview_customizer_cont photberry_preview_customizer_nl">
        <a target="_blank" href="http://bit.ly/2AMxicS"><i class="pm-fa pm-fa-cog" aria-hidden="true"></i></a>
    </div>
    <?php
    }
}
//update_option('pm_demo', 'true');

function photberry_add_template_slug_to_body( $classes ) {
	$templateName = basename(get_page_template_slug(get_the_ID()));
	$templateName = str_ireplace('template-', '', basename(get_page_template_slug(get_the_ID()), '.php'));

	$pf = get_post_format(get_the_ID());
	$post_type = get_post_format(get_the_ID());
	$post_type_class = '';

	if (!empty($post_type)) {
		$post_type_class = ' post-type-' . get_post_format();
	}

    return $classes . $templateName . $post_type_class;
}
add_filter('admin_body_class', 'photberry_add_template_slug_to_body');

if (!function_exists( 'photberry_is_woocommerce_activated')) {
	function photberry_is_woocommerce_activated() {
		return class_exists( 'WooCommerce' ) ? true : false;
	}
}

if (photberry_is_woocommerce_activated()) {
    add_action('customize_register', 'photberry_shop_customizer_register');
    if (!function_exists('photberry_shop_customizer_register')) {
        function photberry_shop_customizer_register($wp_customize) {
            global $photberry_customizer_default_values;

            $wp_customize->add_section('photberry_shop_settings',
                array(
                    'title' => esc_attr__('Photberry Shop Settings', 'photberry'),
                    'panel' => 'woocommerce',
                )
            );
            $wp_customize->add_section('photberry_shop_colors',
                array(
                    'title' => esc_attr__('Additional Shop Colors', 'photberry'),
                    'panel' => 'woocommerce',
                )
            );

            # Sidebar Position
            $wp_setting_name = 'shop_sidebar_position';
            $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
            $wp_customize->add_control(new WP_Customize_Control(
                $wp_customize,
                $wp_setting_name,
                array(
                    'label' => esc_attr__('Sidebar Position', 'photberry'),
                    'section' => 'photberry_shop_settings',
                    'settings' => $wp_setting_name,
                    'type' => 'select',
                    'choices' => array('photberry_left_sidebar' => 'Left', 'photberry_right_sidebar' => 'Right', 'photberry_no_sidebar' => 'None'),
                )
            ));

            # Sale Label
            $wp_setting_name = 'shop_sale_label';
            $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
            $wp_customize->add_control(new WP_Customize_Control(
                $wp_customize,
                $wp_setting_name,
                array(
                    'label' => esc_attr__('Sale Label State', 'photberry'),
                    'section' => 'photberry_shop_settings',
                    'settings' => $wp_setting_name,
                    'type' => 'select',
                    'choices' => array('on' => 'On', 'off' => 'Off'),
                )
            ));

            # Header Cart
            $wp_setting_name = 'cart_in_header';
            $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
            $wp_customize->add_control(new WP_Customize_Control(
                $wp_customize,
                $wp_setting_name,
                array(
                    'label' => esc_attr__('Cart Icon in Header', 'photberry'),
                    'section' => 'photberry_shop_settings',
                    'settings' => $wp_setting_name,
                    'type' => 'select',
                    'choices' => array('show' => 'Show', ' hide' => 'Hide'),
                )
            ));

            # Product Lightbox
            $wp_setting_name = 'shop_lightbox';
            $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
            $wp_customize->add_control(new WP_Customize_Control(
                $wp_customize,
                $wp_setting_name,
                array(
                    'label' => esc_attr__('Single Product Image Lightbox', 'photberry'),
                    'section' => 'photberry_shop_settings',
                    'settings' => $wp_setting_name,
                    'type' => 'select',
                    'choices' => array('on' => 'On', 'off' => 'Off'),
                )
            ));

            # Product Zoom
            $wp_setting_name = 'shop_zoom';
            $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
            $wp_customize->add_control(new WP_Customize_Control(
                $wp_customize,
                $wp_setting_name,
                array(
                    'label' => esc_attr__('Single Product Image Zoom', 'photberry'),
                    'section' => 'photberry_shop_settings',
                    'settings' => $wp_setting_name,
                    'type' => 'select',
                    'choices' => array('on' => 'On', 'off' => 'Off'),
                )
            ));

            # Product Slider
            $wp_setting_name = 'shop_slider';
            $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
            $wp_customize->add_control(new WP_Customize_Control(
                $wp_customize,
                $wp_setting_name,
                array(
                    'label' => esc_attr__('Single Product Image Slider', 'photberry'),
                    'section' => 'photberry_shop_settings',
                    'settings' => $wp_setting_name,
                    'type' => 'select',
                    'choices' => array('on' => 'On', 'off' => 'Off'),
                )
            ));

            # Shop Color Message
            $wp_setting_name = 'shop_color_message';
            $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
            $wp_customize->add_control(new WP_Customize_Color_Control(
                $wp_customize,
                $wp_setting_name,
                array(
                    'label' => esc_attr__('Message Box Color', 'photberry'),
                    'section' => 'photberry_shop_colors',
                    'settings' => $wp_setting_name,
                )
            ));

            # Shop Color Info
            $wp_setting_name = 'shop_color_info';
            $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
            $wp_customize->add_control(new WP_Customize_Color_Control(
                $wp_customize,
                $wp_setting_name,
                array(
                    'label' => esc_attr__('Info Box Color', 'photberry'),
                    'section' => 'photberry_shop_colors',
                    'settings' => $wp_setting_name,
                )
            ));

            # Shop Color Error
            $wp_setting_name = 'shop_color_error';
            $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
            $wp_customize->add_control(new WP_Customize_Color_Control(
                $wp_customize,
                $wp_setting_name,
                array(
                    'label' => esc_attr__('Error Box Color', 'photberry'),
                    'section' => 'photberry_shop_colors',
                    'settings' => $wp_setting_name,
                )
            ));

            # Shop Color Required
            $wp_setting_name = 'shop_color_required';
            $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
            $wp_customize->add_control(new WP_Customize_Color_Control(
                $wp_customize,
                $wp_setting_name,
                array(
                    'label' => esc_attr__('Required Fields Color', 'photberry'),
                    'section' => 'photberry_shop_colors',
                    'settings' => $wp_setting_name,
                )
            ));

            # Shop Color Remove
            $wp_setting_name = 'shop_color_remove';
            $wp_customize->add_setting($wp_setting_name, array('default' => $photberry_customizer_default_values[$wp_setting_name], 'sanitize_callback'	=> 'esc_attr'));
            $wp_customize->add_control(new WP_Customize_Color_Control(
                $wp_customize,
                $wp_setting_name,
                array(
                    'label' => esc_attr__('Remove Cross Color', 'photberry'),
                    'section' => 'photberry_shop_colors',
                    'settings' => $wp_setting_name,
                )
            ));

        }
    }
}

if (class_exists('WooCommerce')) {
    add_theme_support( 'woocommerce', array(
        'thumbnail_image_width' => 500,
        'thumbnail_image_height' => 500,
        'single_image_width'    => 640,
        'product_grid'          => array(
            'default_rows'    => 3,
            'min_rows'        => 2,
            'max_rows'        => 8,
            'default_columns' => 3,
            'min_columns'     => 2,
            'max_columns'     => 5,
        ),
    ));
    if (photberry_get_theme_mod('shop_zoom') == 'on') {
        add_theme_support( 'wc-product-gallery-zoom' );
    }
    if (photberry_get_theme_mod('shop_lightbox') == 'on') {
        add_theme_support( 'wc-product-gallery-lightbox' );
    }
    if (photberry_get_theme_mod('shop_slider') == 'on') {
        add_theme_support( 'wc-product-gallery-slider' );
    }
}

if (function_exists('photberry_add_widget'))
{
	add_action('widgets_init', 'photberry_widgets_activate');
	if (!function_exists('photberry_widgets_activate'))
	{
		function photberry_widgets_activate() {
			photberry_add_widget('photberry_featured_posts');
			photberry_add_widget('photberry_flickr');
			photberry_add_widget('photberryQuickContact');
		}
	}
}

if (!function_exists('photberry_output')) {
    function photberry_output($code) {
        return $code;
    }
}

function update_woocommerce_version() {
  if(class_exists('WooCommerce')) {
    global $woocommerce;

    if(version_compare(get_option('woocommerce_db_version', null), $woocommerce->version, '!=')) {
      update_option('woocommerce_db_version', $woocommerce->version);

      if(! wc_update_product_lookup_tables_is_running()) {
        wc_update_product_lookup_tables();
      }
    }
  }
}
add_action('init', 'update_woocommerce_version');
