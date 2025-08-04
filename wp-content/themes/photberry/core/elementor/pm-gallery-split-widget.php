<?php
/*
 * Created by Pixel-Mafia
 * www.pixel-mafia.com
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class PM_Split_Gallery_Widget extends Widget_Base {

    public function get_name() {
        return 'pm-split-gallery';
    }

    public function get_title() {
        return esc_html__('Split Gallery', 'photberry');
    }

    public function get_icon() {
        return 'eicon-slider-vertical';
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
            'section_split_gallery',
            [
                'label' => esc_html__('Split Gallery', 'photberry')
            ]
        );

		$this->add_control(
			'images',
			[
				'label' => __( 'Add Images', 'photberry' ),
				'type' => Controls_Manager::GALLERY,
				'default' => []
			]
		);

        $this->add_control(
            'infinity_scroll',
            [
                'label' => esc_html__('Infinity Scroll', 'photberry'),
                'type' => Controls_Manager::SELECT,
                'default' => 'on',
                'options' => [
					'on' => esc_attr__('On', 'photberry'),
					'off' => esc_attr__('Off', 'photberry')
                ]
            ]
        );

        $this->add_control(
            'titles_state',
            [
                'label' => esc_html__('Titles State', 'photberry'),
                'type' => Controls_Manager::SELECT,
                'default' => 'always_show',
                'options' => [
					'always_show' => esc_attr__('Always Show', 'photberry'),
					'always_hide' => esc_attr__('Always Hide', 'photberry'),
					'show_on_hover' => esc_attr__('Show on Hover', 'photberry'),
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

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $element_title = $settings['element_title'];
        $element_title_align = $settings['element_title_align'];

		$images = $settings['images'];

		$infinity_scroll = $settings['infinity_scroll'];
		$titles_state = $settings['titles_state'];
		$titles_color = $settings['titles_color'];
		$overlay_state = $settings['overlay_state'];
		$overlay_color = $settings['overlay_color'];
		$controls_state = $settings['controls_state'];
		$module_height_state = $settings['module_height_state'];
		$module_height = $settings['module_height'];
		
		$uniqid = $this->get_id();
		
		photberry_PM_widgets_back_end_icons(self::get_icon(), self::get_name(), self::get_title());
		wp_enqueue_script('photberry_gallery_split', get_template_directory_uri() . '/js/pm_split.js', true, false, true);
		
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
			$infinity_class = '';
			if ($infinity_scroll == 'on') {
				$infinity_class = 'infinity_scroll';
			}
			// Element Content
			if (empty($images)) {
				return;
			}
			
			$title_state_class = 'titles_' . $titles_state;
			
			if ($module_height_state == 'auto') {
				echo '<div class="photberry_split_wrapper photberry_module_loading photberry_split_wrapper'. $uniqid .' auto_height '. esc_attr($infinity_class) .'" data-id="'. $uniqid .'">';
			} else {
				echo '<div class="photberry_split_wrapper photberry_module_loading photberry_split_wrapper'. $uniqid .' photberry_js_height '. esc_attr($infinity_class) .'" data-height="'. esc_attr($module_height) .'"  data-id="'. $uniqid .'">';
			}
			?>
				<div class="photberry_split <?php echo esc_attr($title_state_class); ?>">
					<?php
					$count = 0;
					$photberry_base_count = 1;
					$photberry_right_count = 1;
					$photberry_left_count = 1;
					foreach ( $images as $index => $image ) {
						$count++;
						if(($photberry_base_count % 2) == 0){
							$photberry_slide_class = 'photberry_right_slide'.$photberry_right_count;
							$photberry_slide_style = 'photberry_right_slide';
							$photberry_data_count = $photberry_right_count;
							$photberry_right_count++;
						} else {
							$photberry_slide_class = 'photberry_left_slide'.$photberry_left_count;
							$photberry_slide_style = 'photberry_left_slide';
							$photberry_data_count = $photberry_left_count;
							$photberry_left_count++;
						}
						$photberry_base_count++;
						
						$photoCaption = '';
						$attach_meta = photberry_get_attachment($image['id']);
						$photoTitle = $attach_meta['caption'];
						$photoCaption = $attach_meta['description'];
						$photoAlt = $attach_meta['alt'];
						$PCREpattern = '/\r\n|\r|\n/u';
						$photoCaption = preg_replace($PCREpattern, '', nl2br($photoCaption));

						$slide_image = wp_get_attachment_image_src($image['id'], 'original');
						if ($count == 1) {
							$current_class = 'current-slide';
						} else {
							$current_class = '';
						}
						?>
						<div class="photberry_split_slide photberry_split2preload <?php echo esc_attr($photberry_slide_class) . ' ' . esc_attr($photberry_slide_style); ?> photberry_js_bg_image <?php echo esc_attr($current_class); ?>" data-src="<?php echo esc_url($slide_image[0]); ?>" data-count="<?php echo esc_attr($photberry_data_count); ?>">
							<?php
							if ($titles_state !== 'always_hide') {
								echo '<h2 class="photberry_split_title photberry_js_color" data-color="'. esc_attr($titles_color) .'">'. esc_html($photoTitle) .'</h2>';
							}
							if ($overlay_state == 'on') {
								echo '<div class="photberry_split_overlay"></div>';
							}
							if ($overlay_state == 'custom') {
								echo '<div class="photberry_split_custom_overlay photberry_js_bg_color" data-bgcolor="'. esc_attr($overlay_color) .'"></div>';
							}
							?>
						</div>
						<?php
					}
					?>
				</div>
				<?php 
				if ($controls_state == 'on') {
					echo '
						<a href="'. esc_js("javascript:void(0)") .'" class="photberry_split_btn_prev"></a>
						<a href="'. esc_js("javascript:void(0)") .'" class="photberry_split_btn_next"></a>
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