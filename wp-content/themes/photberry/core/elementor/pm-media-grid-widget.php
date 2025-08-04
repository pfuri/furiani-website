<?php
/*
 * Created by Pixel-Mafia
 * www.pixel-mafia.com
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class PM_Media_Grid_Widget extends Widget_Base {
    public function get_name() {
        return 'pm-media-grid';
    }

    public function get_title() {
        return esc_html__('Media Grid', 'photberry');
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_categories() {
        return ['photberry_elements'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_heading_element',
            [
                'label' => esc_html__('Element Heading', 'photberry')
            ]
        );

        $this->add_control(
            'element_title',
            [
                'label' => esc_html__('Element Title', 'photberry'),
                'type' => Controls_Manager::TEXTAREA
            ]
        );

        $this->add_control(
            'element_title_align',
            [
                'label' => esc_html__('Title Alignment', 'photberry'),
                'type' => Controls_Manager::CHOOSE,
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
                'default' => 'left'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_media_grid',
            [
                'label' => esc_html__('Media Grid Items', 'photberry')
            ]
        );

        $this->add_control(
            'media_grid_item',
            [
                'label' => '',
                'type' => Controls_Manager::REPEATER,
                'fields' => [
					[
						'name' => 'slide_type',
						'label' => esc_html__( 'Item Type', 'photberry' ),
						'type' => Controls_Manager::SELECT,
						'default' => 'image',
						'options' => [
							'image' => esc_html__( 'Image', 'photberry' ),
							'video' => esc_html__( 'Video', 'photberry' ),
						]
					],
                    [
                        'name' => 'video_url',
                        'label' => esc_html__('Video URL', 'photberry'),
                        'type' => Controls_Manager::TEXT,
                        'default' => '',
						'condition' => [
							'slide_type' => 'video'
						]
                    ],
                    [
                        'name' => 'slide_image',
                        'label' => esc_html__('Select Image', 'photberry'),
                        'type' => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
						'condition' => [
							'slide_type' => 'image'
						]
                    ],
                    [
                        'name' => 'slide_thmb',
                        'label' => esc_html__('Select Image', 'photberry'),
                        'type' => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
						'condition' => [
							'slide_type' => 'video'
						]
                    ],
					[
						'name' => 'slide_caption_type',
						'label' => esc_html__( 'Caption Type', 'photberry' ),
						'type' => Controls_Manager::SELECT,
						'default' => 'default',
						'options' => [
							'default' => esc_html__( 'Default', 'photberry' ),
							'custom' => esc_html__( 'Custom', 'photberry' ),
						]
					],
                    [
                        'name' => 'slide_caption',
                        'label' => esc_html__('Slide Caption', 'photberry'),
                        'type' => Controls_Manager::TEXT,
                        'default' => '',
						'condition' => [
							'slide_caption_type' => 'custom'
						]
                    ],
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_settings',
            [
                'label' => esc_html__('Settings', 'photberry')
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Posts per Page', 'photberry'),
                'type' => Controls_Manager::NUMBER,
                'default' => 9,
                'min' => 1,
                'step' => 1,
            ]
        );

        $this->add_control(
            'posts_per_click',
            [
                'label' => esc_html__('Posts per Click', 'photberry'),
                'type' => Controls_Manager::NUMBER,
                'default' => 3,
                'min' => 1,
                'step' => 1,
            ]
        );

        $this->add_control(
            'columns',
            [
                'label' => esc_html__('Columns', 'photberry'),
                'type' => Controls_Manager::SELECT,
                'default' => 3,
                'options' => [
                    2 => esc_html__('Two', 'photberry'),
                    3 => esc_html__('Three', 'photberry'),
                    4 => esc_html__('Four', 'photberry'),
					5 => esc_html__('Five', 'photberry')
                ]
            ]
        );

        $this->add_control(
            'items_padding',
            [
                'label' => esc_html__('Padding Between Items', 'photberry'),
                'type' => Controls_Manager::NUMBER,
                'default' => 10,
                'min' => 0,
                'step' => 1
            ]
        );

        $this->add_control(
            'masonry',
            [
                'label' => esc_html__('Masonry Layout', 'photberry'),
                'type' => Controls_Manager::SELECT,
                'default' => 'off',
                'options' => [
                    'off' => esc_html__('Off', 'photberry'),
                    'on' => esc_html__('On', 'photberry')
                ]
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'photberry'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Load More', 'photberry')
            ]
        );

        $this->add_control(
            'button_type',
            [
                'label' => esc_html__('Button Type', 'photberry'),
                'type' => Controls_Manager::SELECT,
                'default' => 'def',
                'options' => [
                    'def' => esc_html__('Default', 'photberry'),
                    'reverse' => esc_html__('Reverse', 'photberry')
                ]
            ]
        );
		
        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings();

        $element_title = $settings['element_title'];
        $element_title_align = $settings['element_title_align'];

		$media_grid_item = $settings['media_grid_item'];
		
		$posts_per_page = $settings['posts_per_page'];
		$posts_per_click = $settings['posts_per_click'];
		$columns = $settings['columns'];
		$items_padding = $settings['items_padding'];
		$masonry = $settings['masonry'];
		$button_text = $settings['button_text'];
		$button_type = $settings['button_type'];

		photberry_PM_widgets_back_end_icons(self::get_icon(), self::get_name(), self::get_title());
		wp_enqueue_script('photberry_gallery_grid', get_template_directory_uri() . '/js/pm_gallery_grid.js', true, false, true);
		wp_enqueue_script('isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array('jquery'), false, true);
		wp_enqueue_script('imagesloaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array('isotope'), false, true);		

		echo '<div class="photberry_front_end_display">';

		// Element Heading	
        if ($element_title !== '') {
            ?>
            <h2 class="photberry_element_title photberry_text_align_<?php echo esc_attr($element_title_align); ?>">
                <?php echo esc_html($element_title); ?>
            </h2>
            <?php
        }
		$img_width = 960;
		$img_height = 960;
		$uniqid = mt_rand(0, 9999);
		$grid_array = array();
		$img_array = array();
		$imgCounter = 0;
		$masonry_class = '';
		$button_class = '';

		if ($masonry == 'on') {
			$img_height = '';
			$masonry_class = 'is_masonry';
		}
		if ($button_type == 'reverse') {
			$button_class = 'photberry_reverse_button';
		}

			echo '
			<div class="photberry_grid_wrapper photberry_grid_'. esc_attr($uniqid) .'" data-uniqid="'. esc_attr($uniqid) .'" data-perload="'. esc_attr($posts_per_click) .'">
				<div class="photberry_grid_inner photberry_isotope_trigger '. esc_attr($masonry_class).' grid_columns'. esc_attr($columns).'" data-pad="'. esc_attr($items_padding) .'" data-perload="'. esc_attr($posts_per_click) .'">
			';
		
			foreach ($media_grid_item as $item) {
				
				$slide_type = $item['slide_type'];
				$video_url = $item['video_url'];
				$slide_image = $item['slide_image'];
				$slide_thmb = $item['slide_thmb'];
				$slide_caption_type = $item['slide_caption_type'];
				$slide_caption = $item['slide_caption'];

				$photoTitle = '';
				$photoAlt = '';
				
				if ($slide_type == 'image') {
					$attach_meta = photberry_get_attachment($slide_image['id']);
					$featured_image = wp_get_attachment_url($slide_image['id']);
					$thumb_image = aq_resize(esc_url($featured_image), esc_attr($img_width), esc_attr($img_height), true, true, true);
					$slide_img_id = $slide_image['id'];
				}

				if ($slide_type == 'video') {
					$attach_meta = photberry_get_attachment($slide_thmb['id']);
					$featured_image = wp_get_attachment_url($slide_thmb['id']);
					$thumb_image = aq_resize(esc_url($featured_image), esc_attr($img_width), esc_attr($img_height), true, true, true);
					$slide_img_id = $slide_thmb['id'];
				}
				
				if (!empty($attach_meta)) {
					$photoTitle = $attach_meta['caption'];
					$photoAlt = $attach_meta['alt'];
					$PCREpattern = '/\r\n|\r|\n/u';
				}
				if ($slide_caption_type == 'custom') {
					$photoTitle = $slide_caption;
				}
				
				$img_array['attach_id'] = esc_attr($slide_img_id);
				$img_array['slide_type'] = $slide_type;
				$img_array['title'] = esc_attr($photoTitle);
				$img_array['alt'] = esc_attr($photoAlt);
				$img_array['thmb'] = esc_url($thumb_image);
				if ($slide_type == 'video') {
					$img_array['url'] = esc_url($video_url);
				} else {
					$img_array['url'] = esc_url($featured_image);
				}
				$img_array['count'] = esc_attr($imgCounter);
				
				$imgCounter++;
				
				array_push($grid_array, $img_array);
			}

			if ($posts_per_page > count($grid_array)) {
				$posts_per_page = count($grid_array);
			}
			$i = 0;

			while ($i < $posts_per_page) {
				$photoTitle = '';
				$photoTitle = $grid_array[$i]['title'];
				if (isset($photoTitle) && $photoTitle !== '') {
					$photoTitle = str_replace('"', "'", $photoTitle);
				}
				$photoAlt = $grid_array[$i]['alt'];
				$imgCounter = $grid_array[$i]['count'];
				$featured_image = $grid_array[$i]['url'];
				$img_thmb = $grid_array[$i]['thmb'];
				$slide_type = $grid_array[$i]['slide_type'];
				
				echo '
				<div class="grid-item element anim_el anim_el2 load_anim_grid grid_b2p">
					<div class="grid-item-inner">
						<a rel="grid_gallery'. esc_attr($uniqid) .'" class="swipebox" href="'. esc_url($featured_image) .'" data-elementor-open-lightbox="no">
							<img src="'. esc_url($img_thmb) .'" alt="'. esc_attr($photoAlt) .'" class="grid_thmb"/>
							<div class="grid-item-content">
								<h4>'. esc_attr($photoTitle) .'</h4>
							</div>
						</a>
						<div class="photberry-img-preloader"></div>
					</div>
				</div>';
				unset($grid_array[$i]);
				$i++;
			} //EoWhile First Load
			?>
			</div><!-- .photberry_grid_inner -->
			<?php 
			if (isset($grid_array) && count($grid_array) > 0) {
				echo '<div class="photberry_grid_gallery_array" data-id = "'. esc_attr($uniqid) .'">';
					$i = 0;
					foreach ($grid_array as $image) {
						echo '<div class="photberry_grid_array_item" 
								data-id = "'. esc_attr($uniqid) .'" 
								data-type = "' . esc_attr($image['slide_type']) . '" 
								data-img = "' . esc_url($image['url']) . '" 
								data-thmb = "' . esc_url($image['thmb']) . '" 
								data-title = "' . esc_attr($image['title']) . '" 
								data-alt = "' . esc_attr($image['alt']) . '" 
								data-counter = "' . esc_attr($image['count']) . '"></div>';
					}
				echo '</div>';
				echo '<div class="photberry_load_more_button_wrapper grid_loadmore_wrapper"><a class="photberry_load_more_button grid_load_more photberry_button '. esc_attr($button_class) .'" href="'. esc_js("javascript:void(0)") .'">' . esc_attr($button_text) . '</a></div>';
			}
			?>
		</div><!-- .photberry_grid_wrapper -->
	</div><!-- .photberry_front_end_display -->
		<?php
    }

    protected function content_template() {}

    public function render_plain_content() {}
}