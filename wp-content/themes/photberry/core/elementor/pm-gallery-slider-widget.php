<?php
/*
 * Created by Pixel-Mafia
 * www.pixel-mafia.com
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class PM_Slider_Gallery_Widget extends Widget_Base {

    public function get_name() {
        return 'pm-slider-gallery';
    }

    public function get_title() {
        return esc_html__('Slider Gallery', 'photberry');
    }

    public function get_icon() {
        return 'eicon-thumbnails-down';
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
            'section_slider_gallery',
            [
                'label' => esc_html__('Slider Gallery', 'photberry')
            ]
        );

		$this->add_control(
			'images',
			[
				'label' => __( 'Add Images', 'photberry' ),
				'type' => Controls_Manager::GALLERY,
				'default' => [],
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

		$images = $settings['images'];

		$fit_style = $settings['fit_style'];
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
		
		$uniqid = $this->get_id();
		
		photberry_PM_widgets_back_end_icons(self::get_icon(), self::get_name(), self::get_title());
		wp_enqueue_script('photberry_gallery_slider', get_template_directory_uri() . '/js/pm_image_slider.js', true, false, true);
		
		$thumbs_class = '';
		if ($thumbs_state == 'on') {
			$thumbs_class = 'has_thumbs';
		}
	
		$thmbs_html = '';
		?>
		<div class="photberry_front_end_display">
			<?php
			// Element Heading
			if ($element_title !== '') {
				?>
				<h2 class="photberry_element_title photberry_text_align_<?php echo esc_attr($element_title_align); ?>">
					<?php echo esc_html($element_title); ?>
				</h2>
			<?php
			}

			// Element Content
			if (empty($images)) {
				return;
			}

			if ($module_height_state == 'auto') {
				echo '<div class="photberry_slider_wrapper photberry_module_loading auto_height '. esc_attr($thumbs_class) .'">';
			} else {
				echo '<div class="photberry_slider_wrapper photberry_module_loading photberry_js_height '. esc_attr($thumbs_class) .'" data-height="'. esc_attr($module_height) .'">';
			}
			?>
				<div class="photberry_slider <?php echo esc_attr($fit_style); ?>"
					data-autoplay = "<?php echo esc_attr($autoplay); ?>" 
					data-interval = "<?php echo esc_attr($autoplay_speed); ?>">
					<?php
					$count = 0;
					foreach ( $images as $index => $image ) {
						$count++;
						$photoCaption = '';
						$attach_meta = photberry_get_attachment($image['id']);
						$photoTitle = $attach_meta['caption'];
						$photoCaption = $attach_meta['description'];
						$photoAlt = $attach_meta['alt'];
						$PCREpattern = '/\r\n|\r|\n/u';
						$photoCaption = preg_replace($PCREpattern, '', nl2br($photoCaption));

						$featured_image = wp_get_attachment_url($image['id']);
						if (strlen($featured_image[0]) > 0) {
							$thumb_url = aq_resize(esc_url($featured_image), '290', '216', true, true, true);
						} else {
							$thumb_url = '';
						}
						$slide_image = wp_get_attachment_image_src($image['id'], 'original');
						$thmbs_html .= '
							<div class="photberry_slider_thumb photberry_slider_thumb'. esc_attr($count) .'" data-count="'. esc_attr($count) .'">
								<img src="'. esc_url($thumb_url) .'" alt="'. esc_attr($photoAlt) .'"/>
							</div>
						';
						?>
						<div class="photberry_slider_slide photberry_slide2preload photberry_slider_slide<?php echo esc_attr($count); ?> photberry_js_bg_image" data-src="<?php echo esc_url($slide_image[0]); ?>" data-count="<?php echo esc_attr($count); ?>">
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
			</div>
		</div>
        <?php
    }

    protected function content_template() {}

    public function render_plain_content() {}
}