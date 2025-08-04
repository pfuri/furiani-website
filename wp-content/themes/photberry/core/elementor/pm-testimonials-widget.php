<?php
/*
 * Created by Pixel-Mafia
 * www.pixel-mafia.com
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class PM_Testimonials_Widget extends Widget_Base {
    public function get_name() {
        return 'pm-testimonials';
    }

    public function get_title() {
        return esc_html__('Testimonials', 'photberry');
    }

    public function get_icon() {
        return 'eicon-posts-ticker';
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

        $this->add_control(
            'element_subtitle',
            [
                'label' => esc_html__('Element Subtitle', 'photberry'),
                'type' => Controls_Manager::TEXTAREA
            ]
        );

        $this->add_control(
            'element_subtitle_align',
            [
                'label' => esc_html__('Subtitle Alignment', 'photberry'),
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
            'section_testimonials',
            [
                'label' => esc_html__('Testimonials', 'photberry')
            ]
        );

        $this->add_control(
            'testimonials_list',
            [
                'label' => '',
                'type' => Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'author_image',
                        'label' => esc_html__('Author Image', 'photberry'),
                        'type' => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ]
                    ],
                    [
                        'name' => 'author_name',
                        'label' => esc_html__('Author Name', 'photberry'),
                        'type' => Controls_Manager::TEXT,
                        'default' => ''
                    ],
                    [
                        'name' => 'author_position',
                        'label' => esc_html__('Author Position', 'photberry'),
                        'type' => Controls_Manager::TEXT,
                        'default' => ''
                    ],
                    [
                        'name' => 'testimonial',
                        'label' => esc_html__('Content', 'photberry'),
                        'type' => Controls_Manager::TEXTAREA,
                        'rows' => '10',
                        'default' => ''
                    ]
                ],
                'title_field' => '{{{author_name}}}'
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
            'testimonials_style',
            [
                'label' => __( 'Testimonials Style', 'photberry' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'carousel',
                'options' => [
                    'carousel' => esc_html__( 'Carousel', 'photberry' ),
                    'flow' => esc_html__('Flow', 'photberry'),
                    'masonry' => esc_html__('Masonry', 'photberry')
                ],
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => esc_html__( 'Autoplay', 'photberry' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'photberry' ),
                    'no' => esc_html__( 'No', 'photberry' ),
                ],
				'condition' => [
					'testimonials_style' => 'carousel'
				]
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label' => esc_html__( 'Autoplay Speed', 'photberry' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 5000,
				'condition' => [
					'testimonials_style' => 'carousel',
					'autoplay' => 'yes'
				]
            ]
        );

        $this->add_control(
            'pause_on_hover',
            [
                'label' => esc_html__( 'Pause on Hover', 'photberry' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'photberry' ),
                    'no' => esc_html__( 'No', 'photberry' ),
                ],
				'condition' => [
					'testimonials_style' => 'carousel',
					'autoplay' => 'yes'
				]
            ]
        );

        $this->add_control(
            'infinite',
            [
                'label' => esc_html__( 'Infinite Loop', 'photberry' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'photberry' ),
                    'no' => esc_html__( 'No', 'photberry' ),
                ],
				'condition' => [
					'testimonials_style' => 'carousel'
				]			
            ]
        );

        $this->add_control(
            'items_in_row',
            [
                'label' => esc_html__( 'Items in Row', 'photberry' ),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '1' => esc_html__( '1 Item', 'photberry' ),
                    '2' => esc_html__( '2 Items', 'photberry' ),
					'3' => esc_html__( '3 Items', 'photberry' ),
					'4' => esc_html__( '4 Items', 'photberry' ),
                ],
				'condition' => [
					'testimonials_style' => 'masonry'
				]			
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings();

        $element_title = $settings['element_title'];
        $element_subtitle = $settings['element_subtitle'];
        $element_title_align = $settings['element_title_align'];
        $element_subtitle_align = $settings['element_subtitle_align'];

        $testimonials_list = $settings['testimonials_list'];

		$testimonials_style = $settings['testimonials_style'];
		$autoplay = $settings['autoplay'];
		$autoplay_speed = $settings['autoplay_speed'];
		$pause_on_hover = $settings['pause_on_hover'];
		$infinite = $settings['infinite'];
		$items_in_row = $settings['items_in_row'];
		
		if ($testimonials_style == 'carousel' || $testimonials_style == 'flow') {
			photberry_PM_widgets_back_end_icons(self::get_icon(), self::get_name(), self::get_title());
			echo '<div class="photberry_front_end_display">';
		}
		// Element Heading	
        if ($element_title !== '') {
            ?>
            <h2 class="photberry_element_title photberry_text_align_<?php echo esc_attr($element_title_align); ?>">
                <?php echo esc_html($element_title); ?>
            </h2>
            <?php
        }

        if ($element_subtitle !== '') {
            ?>
            <p class="photberry_element_subtitle photberry_text_align_<?php echo esc_attr($element_subtitle_align); ?>">
                <?php echo esc_html($element_subtitle); ?>
            </p>
            <?php
        }

        // Element Content
		if ($testimonials_style == 'carousel') {
			//Carousel Tesimonials
			?>
			<div class="photberry_testimonials_carousel photberry_owlCarousel owl-carousel owl-theme"
				data-pause = "<?php echo esc_attr($pause_on_hover); ?>" 
				data-infinite = "<?php echo esc_attr($infinite); ?>" 
				data-autoplay = "<?php echo esc_attr($autoplay); ?>"
				data-speed = "<?php echo esc_attr($autoplay_speed); ?>">
				<?php 
				foreach ($testimonials_list as $item) {
					$author_image = wp_get_attachment_url($item['author_image']['id']);
					echo '
					<div class="photberry_testimonials_item">
						<div class="photberry_testimonials_item_inner">
							<div class="testimonial_img_wrapper">
								<img src="'. aq_resize(esc_url($author_image), 120, 120, true, true, true) .'" alt="'. get_the_title() .'"  class="testimonials_img"/>
							</div>
							<div class="testimonial_author_info">
								<h6 class="testimonial_author">'. esc_html($item['author_name']) .'</h6>
								<div class="testimonial_additional">'. esc_html($item['author_position']) .'</div>
							</div>
							<div class="testimonial_content">“'. esc_html($item['testimonial']) .'”</div>
						</div>
					</div>';
				}
				?>
			</div>
		<?php
		}
		if ($testimonials_style == 'flow') {
			//Flow Tesimonials
			wp_enqueue_script('pm-testimonials', get_template_directory_uri() . '/js/pm_testimonials.js', true, false, true);
			$uniqid = mt_rand(0, 9999);
			echo '
				<div class="photberry_testimonials_flow photberry_testimonials_flow'. esc_attr($uniqid) .'" data-uniqid="'. esc_attr($uniqid) .'">
					<div class="photberry_testimonials_flow_inner">';
					foreach ($testimonials_list as $item) {
						$author_image = wp_get_attachment_url($item['author_image']['id']);
						echo '
						<div class="photberry_testimonials_flow_item">
							<div class="photberry_testimonials_flow_img_block">
								<img src="'. aq_resize(esc_url($author_image), 200, 200, true, true, true) .'" alt="'. get_the_title() .'"  class="photberry_testimonials_flow_img"/>
							</div>
							<div class="testimonial_content_wrapper">
								<div class="testimonial_content">“'. esc_html($item['testimonial']) .'”</div>
								<h6 class="testimonial_author">'. esc_html($item['author_name']) .'</h6>
								<div class="testimonial_additional">'. esc_html($item['author_position']) .'</div>
							</div>
						</div>';
					}
			echo '
					</div>
					<a href="'. esc_js("javascript:void(0)") .'" class="photberry_testimonials_flow_prev"></a>
					<a href="'. esc_js("javascript:void(0)") .'" class="photberry_testimonials_flow_next"></a>
				</div>';
		}
		if ($testimonials_style == 'masonry') {
			//Masonry Tesimonials
			wp_enqueue_script('isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array('jquery'), false, true);
			wp_enqueue_script('imagesloaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array('isotope'), false, true);

			echo '
			<div class="photberry_testimonials_grid photberry_testimonials_grid'. $items_in_row .'">
				<div class="photberry_testimonials_grid_inner photberry_isotope_trigger is_masonry">';
					foreach ($testimonials_list as $item) {
						$author_image = wp_get_attachment_url($item['author_image']['id']);
						echo '
						<div class="photberry_testimonials_item">
							<div class="photberry_testimonials_item_inner">
								<div class="testimonial_img_wrapper">
									<img src="'. aq_resize(esc_url($author_image), 120, 120, true, true, true) .'" alt="'. get_the_title() .'"  class="testimonials_img"/>
								</div>
								<div class="testimonial_author_info">
									<h6 class="testimonial_author">'. esc_html($item['author_name']) .'</h6>
									<div class="testimonial_additional">'. esc_html($item['author_position']) .'</div>
								</div>
								<div class="testimonial_content">“'. esc_html($item['testimonial']) .'”</div>
							</div>
						</div>';
					}
			echo '
				</div>
			</div>';
		}
		if ($testimonials_style == 'carousel' || $testimonials_style == 'flow') {
			echo '</div>';
		}
    }

    protected function content_template() {}

    public function render_plain_content() {}
}