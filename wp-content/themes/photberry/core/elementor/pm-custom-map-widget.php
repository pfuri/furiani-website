<?php
/*
 * Created by Pixel-Mafia
 * www.pixel-mafia.com
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class PM_Custom_Map_Widget extends Widget_Base {

    public function get_name() {
        return 'pm-custom-map';
    }

    public function get_title() {
        return esc_html__('Custom Map', 'photberry');
    }

    public function get_icon() {
        return 'eicon-google-maps';
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
            'section_map',
            [
                'label' => esc_html__('Map', 'photberry')
            ]
        );

        $this->add_control(
            'html_code',
            [
                'label' => esc_html__('HTML Code', 'photberry'),
                'type' => Controls_Manager::CODE,
                'default' => '',
                'placeholder' => esc_html__('Enter Code of Your Custom Map Here', 'photberry')
            ]
        );

        $this->add_control(
            'map_height',
            [
                'label' => esc_html__('Height of Map', 'photberry'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 700
                ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .photberry_custom_map_wrapper' => 'height: {{SIZE}}{{UNIT}}'
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

        $html_code = $settings['html_code'];

        photberry_PM_widgets_back_end_icons(self::get_icon(), self::get_name(), self::get_title());
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

            if ($element_subtitle !== '') {
                ?>
                <p class="photberry_element_subtitle photberry_text_align_<?php echo esc_attr($element_subtitle_align); ?>">
                    <?php echo esc_html($element_subtitle); ?>
                </p>
            <?php
            }

            // Element Content
            if (isset($html_code) && $html_code !== '') {
                ?>
                <div class="photberry_custom_map_wrapper">
                    <?php echo photberry_output($html_code); ?>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }

    protected function content_template() {}

    public function render_plain_content() {}
}