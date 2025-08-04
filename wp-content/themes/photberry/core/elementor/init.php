<?php

/*
 * Created by Pixel-Mafia
 * www.pixel-mafia.com
*/

if ( ! defined( 'ABSPATH' ) ) exit;

class photberryElementorCustomElement {

	private static $instance = null;

	public static function get_instance() {
		if (! self::$instance)
			self::$instance = new self;
		return self::$instance;
	}

	public function init(){
		add_action('elementor/init', array($this, 'widgets_registered'));
	}

	public function widgets_registered() {
		if(defined('ELEMENTOR_PATH') && class_exists('Elementor\Widget_Base')){

            // Recent Posts Widget
            $pm_recent_posts_widget = locate_template('core/elementor/pm-recent-posts-widget.php');
			if (!$pm_recent_posts_widget || !is_readable($pm_recent_posts_widget)) {
                $pm_recent_posts_widget = plugin_dir_path(__FILE__).'pm-recent-posts-widget.php';
			}
            if ($pm_recent_posts_widget && is_readable( $pm_recent_posts_widget)) {
                require_once $pm_recent_posts_widget;
            }

            // Recent Portfolio Widget
            $pm_recent_ports_widget = locate_template('core/elementor/pm-recent-ports-widget.php');
			if (!$pm_recent_ports_widget || !is_readable($pm_recent_ports_widget)) {
                $pm_recent_ports_widget = plugin_dir_path(__FILE__).'pm-recent-ports-widget.php';
			}
            if ($pm_recent_ports_widget && is_readable( $pm_recent_ports_widget)) {
                require_once $pm_recent_ports_widget;
            }

			// Itemized Link Widget
			$pm_itemized_link_widget = locate_template('core/elementor/pm-itemized-link-widget.php');
			if (!$pm_itemized_link_widget || !is_readable($pm_itemized_link_widget)) {
				require_once $pm_itemized_link_widget;
			}			
			if ($pm_itemized_link_widget && is_readable($pm_itemized_link_widget)) {
				require_once $pm_itemized_link_widget;
			}

			// Price Item Widget
			$pm_price_item_widget = locate_template('core/elementor/pm-price-item-widget.php');
			if (!$pm_price_item_widget || !is_readable($pm_price_item_widget)) {
				require_once $pm_price_item_widget;
			}			
			if ($pm_price_item_widget && is_readable($pm_price_item_widget)) {
				require_once $pm_price_item_widget;
			}
			
            // Team Widget
            $pm_person_widget = locate_template('core/elementor/pm-person-widget.php');
            if (!$pm_person_widget || !is_readable($pm_person_widget)) {
                $pm_person_widget = plugin_dir_path(__FILE__).'pm-person-widget.php';
            }
            if ($pm_person_widget && is_readable($pm_person_widget)) {
                require_once $pm_person_widget;
            }

            // Testimonials Widget
            $pm_testimonials_widget = locate_template('core/elementor/pm-testimonials-widget.php');
            if (!$pm_testimonials_widget || !is_readable($pm_testimonials_widget)) {
                $pm_testimonials_widget = plugin_dir_path(__FILE__).'pm-testimonials-widget.php';
            }
            if ($pm_testimonials_widget && is_readable($pm_testimonials_widget)) {
                require_once $pm_testimonials_widget;
            }

            // Blog Listing Widget
            $pm_blog_listing_widget = locate_template('core/elementor/pm-blog-listing-widget.php');
            if (!$pm_blog_listing_widget || !is_readable($pm_blog_listing_widget)) {
                $pm_blog_listing_widget = plugin_dir_path(__FILE__).'pm-blog-listing-widget.php';
            }
            if ($pm_blog_listing_widget && is_readable($pm_blog_listing_widget)) {
                require_once $pm_blog_listing_widget;
            }

            // Custom Map Widget
            $pm_custom_map_widget = locate_template('core/elementor/pm-custom-map-widget.php');
            if (!$pm_custom_map_widget || !is_readable($pm_custom_map_widget)) {
                $pm_custom_map_widget = plugin_dir_path(__FILE__).'pm-custom-map-widget.php';
            }
            if ($pm_custom_map_widget && is_readable($pm_custom_map_widget)) {
                require_once $pm_custom_map_widget;
            }

            // Portfolio Listing Widget
            $pm_portfolio_listing_widget = locate_template('core/elementor/pm-portfolio-listing-widget.php');
            if (!$pm_portfolio_listing_widget || !is_readable($pm_portfolio_listing_widget)) {
                $pm_portfolio_listing_widget = plugin_dir_path(__FILE__).'pm-portfolio-listing-widget.php';
            }
            if ($pm_portfolio_listing_widget && is_readable($pm_portfolio_listing_widget)) {
                require_once $pm_portfolio_listing_widget;
            }

            // Portfolio Packery Widget
            $pm_portfolio_packery_widget = locate_template('core/elementor/pm-portfolio-packery-widget.php');
            if (!$pm_portfolio_packery_widget || !is_readable($pm_portfolio_packery_widget)) {
                $pm_portfolio_packery_widget = plugin_dir_path(__FILE__).'pm-portfolio-packery-widget.php';
            }
            if ($pm_portfolio_packery_widget && is_readable($pm_portfolio_packery_widget)) {
                require_once $pm_portfolio_packery_widget;
            }

            // Albums Grid Widget
            $pm_albums_grid_widget = locate_template('core/elementor/pm-albums-grid-widget.php');
            if (!$pm_albums_grid_widget || !is_readable($pm_albums_grid_widget)) {
                $pm_albums_grid_widget = plugin_dir_path(__FILE__).'pm-albums-grid-widget.php';
            }
            if ($pm_albums_grid_widget && is_readable($pm_albums_grid_widget)) {
                require_once $pm_albums_grid_widget;
            }

            // Albums Packery Widget
            $pm_albums_packery_widget = locate_template('core/elementor/pm-albums-packery-widget.php');
            if (!$pm_albums_packery_widget || !is_readable($pm_albums_packery_widget)) {
                $pm_albums_packery_widget = plugin_dir_path(__FILE__).'pm-albums-packery-widget.php';
            }
            if ($pm_albums_packery_widget && is_readable($pm_albums_packery_widget)) {
                require_once $pm_albums_packery_widget;
            }

            // Albums Carousel Widget
            $pm_albums_carousel_widget = locate_template('core/elementor/pm-albums-carousel-widget.php');
            if (!$pm_albums_carousel_widget || !is_readable($pm_albums_carousel_widget)) {
                $pm_albums_carousel_widget = plugin_dir_path(__FILE__).'pm-albums-carousel-widget.php';
            }
            if ($pm_albums_carousel_widget && is_readable($pm_albums_carousel_widget)) {
                require_once $pm_albums_carousel_widget;
            }

            // Grid Gallery Widget
            $pm_grid_gallery_widget = locate_template('core/elementor/pm-gallery-grid-widget.php');
            if (!$pm_grid_gallery_widget || !is_readable($pm_grid_gallery_widget)) {
                $pm_grid_gallery_widget = plugin_dir_path(__FILE__).'pm-gallery-grid-widget.php';
            }
            if ($pm_grid_gallery_widget && is_readable($pm_grid_gallery_widget)) {
                require_once $pm_grid_gallery_widget;
            }

			// Packery Gallery Widget
            $pm_packery_gallery_widget = locate_template('core/elementor/pm-gallery-packery-widget.php');
            if (!$pm_packery_gallery_widget || !is_readable($pm_packery_gallery_widget)) {
                $pm_packery_gallery_widget = plugin_dir_path(__FILE__).'pm-gallery-packery-widget.php'; 
            }
            if ($pm_packery_gallery_widget && is_readable($pm_packery_gallery_widget)) {
                require_once $pm_packery_gallery_widget;
            }

            // Slider Gallery Widget
            $pm_slider_gallery_widget = locate_template('core/elementor/pm-gallery-slider-widget.php');
            if (!$pm_slider_gallery_widget || !is_readable($pm_slider_gallery_widget)) {
                $pm_slider_gallery_widget = plugin_dir_path(__FILE__).'pm-gallery-slider-widget.php';
            }
            if ($pm_slider_gallery_widget && is_readable($pm_slider_gallery_widget)) {
                require_once $pm_slider_gallery_widget;
            }

            // Media Slider Widget
            $pm_media_slider_widget = locate_template('core/elementor/pm-media-slider-widget.php');
            if (!$pm_media_slider_widget || !is_readable($pm_media_slider_widget)) {
                $pm_media_slider_widget = plugin_dir_path(__FILE__).'pm-media-slider-widget.php';
            }
            if ($pm_media_slider_widget && is_readable($pm_media_slider_widget)) {
                require_once $pm_media_slider_widget;
            }
			
			// Media Grid Widget
            $pm_media_grid_widget = locate_template('core/elementor/pm-media-grid-widget.php');
            if (!$pm_media_grid_widget || !is_readable($pm_media_grid_widget)) {
                $pm_media_grid_widget = plugin_dir_path(__FILE__).'pm-media-grid-widget.php';
            }
            if ($pm_media_grid_widget && is_readable($pm_media_grid_widget)) {
                require_once $pm_media_grid_widget;
            }

            // Split Gallery Widget
            $pm_split_gallery_widget = locate_template('core/elementor/pm-gallery-split-widget.php');
            if (!$pm_split_gallery_widget || !is_readable($pm_split_gallery_widget)) {
                $pm_split_gallery_widget = plugin_dir_path(__FILE__).'pm-gallery-split-widget.php';
            }
            if ($pm_split_gallery_widget && is_readable($pm_split_gallery_widget)) {
                require_once $pm_split_gallery_widget;
            }

		}

		if (defined('ELEMENTOR_PATH') && class_exists('Elementor\Widget_Base')) {
			if (class_exists('Elementor\Plugin')) {
				if (is_callable('Elementor\Plugin', 'instance')) {
					$elementor = Elementor\Plugin::instance();
					if (isset($elementor->widgets_manager)) {
						if (method_exists($elementor->widgets_manager, 'register_widget_type')) {

                            // Recent Posts Widget
                            $pm_recent_posts_widget = locate_template('core/elementor/pm-recent-posts-widget.php');
							if ($pm_recent_posts_widget && is_readable($pm_recent_posts_widget)) {
								require_once $pm_recent_posts_widget;
								Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\PM_Recent_Posts_Widget());
							}

                            // Recent Portfolio Widget
                            $pm_recent_ports_widget = locate_template('core/elementor/pm-recent-ports-widget.php');
							if ($pm_recent_ports_widget && is_readable($pm_recent_ports_widget)) {
								require_once $pm_recent_ports_widget;
								Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\PM_Recent_Ports_Widget());
							}

							// Itemized Link Widget
                            $pm_itemized_link_widget = locate_template('core/elementor/pm-itemized-link-widget.php');
                            if ($pm_itemized_link_widget && is_readable($pm_itemized_link_widget)) {
                                require_once $pm_itemized_link_widget;
                                Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\PM_Itemized_Link_Widget());
                            }

							// Price Item Widget
                            $pm_price_item_widget = locate_template('core/elementor/pm-price-item-widget.php');
                            if ($pm_price_item_widget && is_readable($pm_price_item_widget)) {
                                require_once $pm_price_item_widget;
                                Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\PM_Price_Item_Widget());
                            }

							// Team Widget
                            $pm_person_widget = locate_template('core/elementor/pm-person-widget.php');
                            if ($pm_person_widget && is_readable($pm_person_widget)) {
                                require_once $pm_person_widget;
                                Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\PM_Person_Widget());
                            }

                            // Testimonials Widget
                            $pm_testimonials_widget = locate_template('core/elementor/pm-testimonials-widget.php');
                            if ($pm_testimonials_widget && is_readable($pm_testimonials_widget)) {
                                require_once $pm_testimonials_widget;
                                Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\PM_Testimonials_Widget());
                            }

                            // Blog Listing Widget
                            $pm_blog_listing_widget = locate_template('core/elementor/pm-blog-listing-widget.php');
                            if ($pm_blog_listing_widget && is_readable($pm_blog_listing_widget)) {
                                require_once $pm_blog_listing_widget;
                                Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\PM_Blog_Listing_Widget());
                            }

                            // Custom Map Widget
                            $pm_custom_map_widget = locate_template('core/elementor/pm-custom-map-widget.php');
                            if ($pm_custom_map_widget && is_readable($pm_custom_map_widget)) {
                                require_once $pm_custom_map_widget;
                                Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\PM_Custom_Map_Widget());
                            }

                            // Portfolio Listing Widget
                            $pm_portfolio_listing_widget = locate_template('core/elementor/pm-portfolio-listing-widget.php');
                            if ($pm_portfolio_listing_widget && is_readable($pm_portfolio_listing_widget)) {
                                require_once $pm_portfolio_listing_widget;
                                Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\PM_Portfolio_Listing_Widget());
                            }

                            // Portfolio Packery Widget
                            $pm_portfolio_packery_widget = locate_template('core/elementor/pm-portfolio-packery-widget.php');
                            if ($pm_portfolio_packery_widget && is_readable($pm_portfolio_packery_widget)) {
								require_once $pm_portfolio_packery_widget;
								Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\PM_Portfolio_Packery_Widget());
							}

                            // Albums Grid Widget
                            $pm_albums_grid_widget = locate_template('core/elementor/pm-albums-grid-widget.php');
                            if ($pm_albums_grid_widget && is_readable($pm_albums_grid_widget)) {
                                require_once $pm_albums_grid_widget;
                                Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\PM_Albums_Grid_Widget());
                            }

                            // Albums Packery Widget
                            $pm_albums_packery_widget = locate_template('core/elementor/pm-albums-packery-widget.php');
                            if ($pm_albums_packery_widget && is_readable($pm_albums_packery_widget)) {
								require_once $pm_albums_packery_widget;
								Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\PM_Albums_Packery_Widget());
							}

                            // Albums Carousel Widget
                            $pm_albums_carousel_widget = locate_template('core/elementor/pm-albums-carousel-widget.php');
                            if ($pm_albums_carousel_widget && is_readable($pm_albums_carousel_widget)) {
								require_once $pm_albums_carousel_widget;
								Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\PM_Albums_Carousel_Widget());
							}

                            // Grid Gallery Widget
                            $pm_grid_gallery_widget = locate_template('core/elementor/pm-gallery-grid-widget.php');
                            if ($pm_grid_gallery_widget && is_readable($pm_grid_gallery_widget)) {
                                require_once $pm_grid_gallery_widget;
                                Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\PM_Grid_Gallery_Widget());
                            }

                            // Packery Gallery Widget
                            $pm_packery_gallery_widget = locate_template('core/elementor/pm-gallery-packery-widget.php');
                            if ($pm_packery_gallery_widget && is_readable($pm_packery_gallery_widget)) {
                                require_once $pm_packery_gallery_widget;
                                Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\PM_Packery_Gallery_Widget());
                            }

                            // Slider Gallery Widget
                            $pm_slider_gallery_widget = locate_template('core/elementor/pm-gallery-slider-widget.php');
                            if ($pm_slider_gallery_widget && is_readable($pm_slider_gallery_widget)) {
                                require_once $pm_slider_gallery_widget;
                                Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\PM_Slider_Gallery_Widget());
                            }

                            // Split Gallery Widget
                            $pm_split_gallery_widget = locate_template('core/elementor/pm-gallery-split-widget.php');
                            if ($pm_split_gallery_widget && is_readable($pm_split_gallery_widget)) {
                                require_once $pm_split_gallery_widget;
                                Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\PM_Split_Gallery_Widget());
                            }
							
							// Media Slider Widget
							$pm_media_slider_widget = locate_template('core/elementor/pm-media-slider-widget.php');
                            if ($pm_media_slider_widget && is_readable($pm_media_slider_widget)) {
                                require_once $pm_media_slider_widget;
                                Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\PM_Media_Slider_Widget());
                            }
							
							// Media Grid Widget
							$pm_media_grid_widget = locate_template('core/elementor/pm-media-grid-widget.php');
                            if ($pm_media_grid_widget && is_readable($pm_media_grid_widget)) {
                                require_once $pm_media_grid_widget;
                                Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\PM_Media_Grid_Widget());
                            }
						}
					}
				}
			}
		}
	}
}

photberryElementorCustomElement::get_instance()->init();

// Add a custom category for panel widgets
add_action('elementor/init', function() {
    \Elementor\Plugin::$instance->elements_manager->add_category(
        'photberry_elements',
        [
            'title' => esc_html__('Pixel-Mafia Elements', 'photberry'),
            'icon' => 'pm-fa pm-fa-plug', //default icon
        ],
        2 // position
    );
});

// Add Custom Field in Standard Element
add_action('elementor/element/before_section_end', function( $section, $section_id, $args ) {
    if( $section->get_name() == 'section' && $section_id == 'section_layout' ){
        $section->add_control(
            'section_z_index',
            [
                'label' => esc_html__('Z-Index', 'photberry'),
                'type' => Elementor\Controls_Manager::NUMBER,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}' => 'z-index: {{VALUE}}'
                ]
            ]
        );
    }
}, 10, 3);

// Add Options for Tabs Widget
add_action('elementor/element/tabs/section_tabs/before_section_end', function( $element, $args ) {
	$element->add_control (
		'element_tabs_align',
		[
			'label' => esc_html__('Tabs Alignment', 'photberry'),
			'type' => Elementor\Controls_Manager::CHOOSE,
			'options' => [
				'left' => [
					'title' => esc_html__( 'Left', 'photberry' ),
					'icon' => 'pm-fa pm-fa-align-left',
				],
				'center' => [
					'title' => esc_html__( 'Center', 'photberry' ),
					'icon' => 'pm-fa pm-fa-align-center',
				],
				'right' => [
					'title' => esc_html__( 'Right', 'photberry' ),
					'icon' => 'pm-fa pm-fa-align-right',
				]
			],
			'prefix_class' => 'photberry_tabs_',
			'default' => 'left',
			'condition' => [
				'type' => 'horizontal'
			]
		]
	);
	$element->add_control (
		'element_content_align',
		[
			'label' => esc_html__('Content Alignment', 'photberry'),
			'type' => Elementor\Controls_Manager::CHOOSE,
			'options' => [
				'left' => [
					'title' => esc_html__( 'Left', 'photberry' ),
					'icon' => 'pm-fa pm-fa-align-left',
				],
				'center' => [
					'title' => esc_html__( 'Center', 'photberry' ),
					'icon' => 'pm-fa pm-fa-align-center',
				],
				'right' => [
					'title' => esc_html__( 'Right', 'photberry' ),
					'icon' => 'pm-fa pm-fa-align-right',
				]
			],
			'prefix_class' => 'photberry_tabs_content_',
			'default' => 'left',
			'condition' => [
				'type' => 'horizontal'
			]
		]
	);
	$element->add_control (
		'borders_style',
		[
			'label' => esc_html__( 'Borders Style', 'photberry' ),
			'type' => Elementor\Controls_Manager::SELECT,
			'default' => 'default',
			'prefix_class' => 'photberry_tabs_borders_',
			'options' => [
				'default' => esc_html__('Default', 'photberry'),
				'one' => esc_html__('One Border', 'photberry')
			]
		]
	);

}, 10, 2);

if (!function_exists('photberry_PM_widgets_back_end_icons')) {
    function photberry_PM_widgets_back_end_icons($icon, $name, $title) {
        echo '
            <i class="photberry_back_end_display ' . $name . ' ' . $icon . '" data-title="' . $title . '"></i>
        ';
    }
}

add_action( 'elementor/editor/before_enqueue_scripts', function() {
	wp_enqueue_style('pm-font-awesome', get_template_directory_uri() . '/css/pm-font-awesome.min.css');
});