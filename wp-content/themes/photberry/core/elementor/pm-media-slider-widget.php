<?php
/*
 * Created by Pixel-Mafia
 * www.pixel-mafia.com
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class PM_Media_Slider_Widget extends Widget_Base {
    public function get_name() {
        return 'pm-media-slider';
    }

    public function get_title() {
        return esc_html__('Media Slider', 'photberry');
    }

    public function get_icon() {
        return 'eicon-thumbnails-right';
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
            'section_media_slider',
            [
                'label' => esc_html__('Media Slider Items', 'photberry')
            ]
        );

        $this->add_control(
            'media_slider_item',
            [
                'label' => '',
                'type' => Controls_Manager::REPEATER,
                'fields' => [
					[
						'name' => 'slide_type',
						'label' => esc_html__( 'Slide Type', 'photberry' ),
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
                        'label' => esc_html__('Slide Image', 'photberry'),
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
                        'label' => esc_html__('Slide Thumb', 'photberry'),
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
            'fit_style',
            [
                'label' => esc_html__('Fit Style', 'photberry'),
                'type' => Controls_Manager::SELECT,
                'default' => 'cover',
                'options' => [
					'cover' => esc_attr__('Cover Slide', 'photberry'),
					'fit_always' => esc_attr__('Fit Always', 'photberry'),
					'fit_width' => esc_attr__('Fit Width', 'photberry'),
					'fit_height' => esc_attr__('Fit Height', 'photberry')
                ]
            ]
        );

        $this->add_control(
            'video_fit_style',
            [
                'label' => esc_html__('Video Fit Style', 'photberry'),
                'type' => Controls_Manager::SELECT,
                'default' => 'video_cover',
                'options' => [
					'video_cover' => esc_attr__('Cover Slide', 'photberry'),
					'video_fit' => esc_attr__('Fit Always', 'photberry')
                ]
            ]
        );

        $this->add_control(
            'thumbs_state',
            [
                'label' => esc_html__('Thumbs State', 'photberry'),
                'type' => Controls_Manager::SELECT,
                'default' => 'off',
                'options' => [
                    'on' => esc_html__('On', 'photberry'),
					'off' => esc_html__('Off', 'photberry')
                    
                ]
            ]
        );

        $this->add_control(
            'titles_state',
            [
                'label' => esc_html__('Titles State', 'photberry'),
                'type' => Controls_Manager::SELECT,
                'default' => 'on',
                'options' => [
					'on' => esc_html__('On', 'photberry'),        
					'off' => esc_html__('Off', 'photberry')                   
                ]
            ]
        );
		
		$this->add_control(
			'titles_color',
			[
				'label' => esc_html__( 'Titles Color', 'photberry' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'titles_state' => 'on'
				]
			]
		);
		
        $this->add_control(
            'overlay_state',
            [
                'label' => esc_html__('Overlay State', 'photberry'),
                'type' => Controls_Manager::SELECT,
                'default' => 'on',
                'options' => [
					'on' => esc_html__('On', 'photberry'),
					'off' => esc_html__('Off', 'photberry'),
					'custom' => esc_html__('Custom', 'photberry')
                ]
            ]
        );

		$this->add_control(
			'overlay_color',
			[
				'label' => esc_html__( 'Overlay Color', 'photberry' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'overlay_state' => 'custom'
				]
			]
		);

        $this->add_control(
            'controls_state',
            [
                'label' => esc_html__('Controls State', 'photberry'),
                'type' => Controls_Manager::SELECT,
                'default' => 'on',
                'options' => [
                    'off' => esc_html__('Off', 'photberry'),
                    'on' => esc_html__('On', 'photberry')
                ]
            ]
        );

        $this->add_control(
            'module_height_state',
            [
                'label' => esc_html__('Module Height Type', 'photberry'),
                'type' => Controls_Manager::SELECT,
                'default' => 'auto',
                'options' => [
                    'auto' => esc_html__('Auto', 'photberry'),
                    'custom' => esc_html__('Custom', 'photberry')
                ]
            ]
        );

        $this->add_control(
            'module_height',
            [
                'label' => esc_html__('Module Height', 'photberry'),
                'type' => Controls_Manager::NUMBER,
                'default' => 750,
                'min' => 0,
                'step' => 1,
				'condition' => [
					'module_height_state' => 'custom'
				]
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => esc_html__('Autoplay', 'photberry'),
                'type' => Controls_Manager::SELECT,
                'default' => 'on',
                'options' => [
                    'off' => esc_html__('Off', 'photberry'),
                    'on' => esc_html__('On', 'photberry')
                ]
            ]
        );
		
        $this->add_control(
            'autoplay_speed',
            [
                'label' => esc_html__('Autoplay Speed', 'photberry'),
                'type' => Controls_Manager::NUMBER,
                'default' => 4000,
                'min' => 0,
                'step' => 100,
				'condition' => [
					'autoplay' => 'on'
				]
            ]
        );
		
        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings();

        $element_title = $settings['element_title'];
        $element_title_align = $settings['element_title_align'];

		$media_slider_item = $settings['media_slider_item'];
		
		$fit_style = $settings['fit_style'];
		$video_fit_style = $settings['video_fit_style'];
		$thumbs_state = $settings['thumbs_state'];
		$titles_state = $settings['titles_state'];
		$titles_color = $settings['titles_color'];
		$overlay_state = $settings['overlay_state'];
		$overlay_color = $settings['overlay_color'];
		$controls_state = $settings['controls_state'];
		$autoplay = $settings['autoplay'];
		$autoplay_speed = $settings['autoplay_speed'];
		$module_height_state = $settings['module_height_state'];
		$module_height = $settings['module_height'];

		photberry_PM_widgets_back_end_icons(self::get_icon(), self::get_name(), self::get_title());
		wp_enqueue_script('vimeo_api', 'https://player.vimeo.com/api/player.js', array(), false, true);
		wp_enqueue_script('photberry_gallery_slider', get_template_directory_uri() . '/js/pm_image_slider.js', true, false, true);

		$thumbs_class = '';
		if ($thumbs_state == 'on') {
			$thumbs_class = 'has_thumbs';
		}
		$thmbs_html = '';
		
		$uniqid = $this->get_id();
		
		echo '<div class="photberry_front_end_display">';

		// Element Heading	
        if ($element_title !== '') {
            ?>
            <h2 class="photberry_element_title photberry_text_align_<?php echo esc_attr($element_title_align); ?>">
                <?php echo esc_html($element_title); ?>
            </h2>
            <?php
        }

        // Element Content
		if ($module_height_state == 'auto') {
			echo '<div class="photberry_slider_wrapper photberry_media_slider_wrapper auto_height '. esc_attr($thumbs_class) .' '. esc_attr($video_fit_style) .' photberry_slider_'. esc_attr($uniqid) .'"
			data-id="'. esc_attr($uniqid) .'"
			data-autoplay = "'. esc_attr($autoplay) .'" 
			data-interval = "'. esc_attr($autoplay_speed) .'" 
			data-thumbs = "'. esc_attr($thumbs_state) .'">';
		} else {
			echo '<div class="photberry_slider_wrapper photberry_media_slider_wrapper photberry_js_height '. esc_attr($thumbs_class) .' '. esc_attr($video_fit_style) .' photberry_slider_'. esc_attr($uniqid) .'" 
			data-height="'. esc_attr($module_height) .'"
			data-id="'. esc_attr($uniqid) .'"
			data-autoplay = "'. esc_attr($autoplay) .'" 
			data-interval = "'. esc_attr($autoplay_speed) .'" 
			data-thumbs = "'. esc_attr($thumbs_state) .'">';
		}
		?>
		<div class="photberry_slider photberry_media_slider <?php echo esc_attr($fit_style); ?>"
			data-autoplay = "<?php echo esc_attr($autoplay); ?>" 
			data-interval = "<?php echo esc_attr($autoplay_speed); ?>">
		<?php
			$count = 0;
			foreach ($media_slider_item as $item) {
				$count++;

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
					$slide_image = wp_get_attachment_image_src($slide_image['id'], 'original');
				}

				if ($slide_type == 'video') {
					$attach_meta = photberry_get_attachment($slide_thmb['id']);
					$featured_image = wp_get_attachment_url($slide_thmb['id']);
				}
				if (!empty($attach_meta)) {
					$photoTitle = $attach_meta['caption'];
					$photoAlt = $attach_meta['alt'];
					$PCREpattern = '/\r\n|\r|\n/u';
				}
				if ($slide_caption_type == 'custom') {
					$photoTitle = $slide_caption;
				}

				if (strlen($featured_image[0]) > 0) {
					$thumb_url = aq_resize(esc_url($featured_image), '290', '216', true, true, true);
				} else {
					$thumb_url = '';
				}
				
				$thmbs_html .= '
					<div class="photberry_slider_thumb photberry_slider_thumb'. esc_attr($count) .'" data-count="'. esc_attr($count) .'">
						<img src="'. esc_url($thumb_url) .'" alt="'. esc_attr($photoAlt) .'"/>
					</div>
				';
				if ($slide_type == 'image') {
					// Image Slide
					?>
					<div class="photberry_slider_slide photberry_image_slide photberry_slide2preload photberry_slider_slide<?php echo esc_attr($count); ?> photberry_js_bg_image" data-src="<?php echo esc_url($slide_image[0]); ?>" data-count="<?php echo esc_attr($count); ?>">
						<?php
						if ($titles_state == 'on') {
							echo '<h2 class="photberry_slide_title photberry_js_color" data-color="'. esc_attr($titles_color) .'">'. esc_html($photoTitle) .'</h2>';
						}
						if ($overlay_state == 'on') {
							echo '<span class="photberry_slider_overlay"></span>';
						}
						if ($overlay_state == 'custom') {
							echo '<span class="photberry_slider_custom_overlay photberry_js_bg_color" data-bgcolor="'. esc_attr($overlay_color) .'"></span>';
						}
						?>
					</div>
					<?php
				}
				if ($slide_type == 'video') {
					// Video Slide
					#YOUTUBE
					$is_youtube = substr_count($video_url, "youtu");
					if ($is_youtube > 0) {

						$videoid = substr(strstr($video_url, "="), 1);
						$video_type = 'youtube';
					}
					#VIMEO
					$is_vimeo = substr_count($video_url, "vimeo");
					if ($is_vimeo > 0) {
						$videoid = substr(strstr($video_url, "m/"), 2);
						$video_type = 'vimeo';
					}
					?>
					<div class="photberry_slider_slide photberry_<?php echo esc_attr($video_type);?>_slide photberry_slider_slide<?php echo esc_attr($count); ?>" data-count="<?php echo esc_attr($count); ?>" data-type="<?php echo esc_attr($video_type); ?>" data-src="<?php echo esc_attr($videoid); ?>">
						<?php
						if ($titles_state == 'on') {
							echo '<h2 class="photberry_slide_title photberry_js_color" data-color="'. esc_attr($titles_color) .'">'. esc_html($photoTitle) .'</h2>';
						}
						if ($overlay_state == 'on') {
							echo '<span class="photberry_slider_overlay"></span>';
						}
						if ($overlay_state == 'custom') {
							echo '<span class="photberry_slider_custom_overlay photberry_js_bg_color" data-bgcolor="'. esc_attr($overlay_color) .'"></span>';
						}
						?>
					</div>
					<?php
				}
			}
			?>
			</div>
			<?php 
			if ($thumbs_state == 'on') {
				if ($count < 10) {
					$counter_text = '0' . $count;
				} else {
					$counter_text = $count;
				}
				echo '
					<div class="photberry_slider_thumbs">
						<div class="photberry_slider_thumbs_inner">
							'. $thmbs_html .'
						</div>
					</div>
					<div class="photberry_slide_counter">
						<span class="photberry_slide_counter_current">01</span>
						<span class="photberry_slide_counter_sep">/</span>
						<span class="photberry_slide_counter_all">'. esc_attr($counter_text) .'</span>
					</div>
				';
			}
			if ($controls_state == 'on') {
				echo '
					<a href="'. esc_js("javascript:void(0)") .'" class="photberry_slider_btn_prev"></a>
					<a href="'. esc_js("javascript:void(0)") .'" class="photberry_slider_btn_next"></a>
				';
			}
			?>
			<div class="photberry_gallery_preloader"></div>
		</div><!-- .photberry_media_slider_wrapper -->
		<?php
			echo '</div><!-- .photberry_front_end_display -->';
    }

    protected function content_template() {}

    public function render_plain_content() {}
}