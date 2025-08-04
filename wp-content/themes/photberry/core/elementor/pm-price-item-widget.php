<?php
/*
 * Created by Pixel-Mafia
 * www.pixel-mafia.com
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class PM_Price_Item_Widget extends Widget_Base {

    public function get_name() {
        return 'pm-price-item';
    }

    public function get_title() {
        return esc_html__('Price Item', 'photberry');
    }

    public function get_icon() {
        return 'eicon-price-table';
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
            'section_price_item',
            [
                'label' => esc_html__('Price Table Item', 'photberry')
            ]
        );

		$this->add_control(
			'bg_color',
			[
				'label' => __( 'Background Color', 'photberry' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#eeeeee'
			]
		);

        $this->add_control(
            'image',
            [
                'label' => __( 'Choose Image', 'photberry' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $this->add_control(
            'name',
            [
                'label' => esc_html__('Name', 'photberry'),
                'type' => Controls_Manager::TEXT,
                'default' => ''
            ]
        );

        $this->add_control(
            'price',
            [
                'label' => esc_html__('Price', 'photberry'),
                'type' => Controls_Manager::TEXT,
                'default' => ''
            ]
        );
		
		$this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'photberry'),
                'type' => Controls_Manager::WYSIWYG
            ]
        );

		$this->add_control(
			'most_popular',
			[
				'label' => esc_html__( 'Most Popular', 'photberry' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'no' => esc_html__('No', 'photberry'),
					'yes' => esc_html__('Yes', 'photberry')
				]
			]
		);

		$this->add_control(
			'button_state',
			[
				'label' => esc_html__( 'Button State', 'photberry' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'no' => esc_html__('No', 'photberry'),
					'yes' => esc_html__('Yes', 'photberry')
				]
			]
		);

		$this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'photberry'),
                'type' => Controls_Manager::TEXT,
				'condition' => [
					'button_state' => 'yes'
				]
            ]
        );
		
		$this->add_control(
            'button_url',
            [
                'label' => esc_html__('Button URL', 'photberry'),
                'type' => Controls_Manager::URL,
				'default' => [
					'url' => '',
					'is_external' => 'true',
				],
				'placeholder' => esc_html__( 'http://your-link.com', 'photberry' ),
				'condition' => [
					'button_state' => 'yes'
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

		$price_item_image = $settings['image'];
        $price_item_name = $settings['name'];
        $price_item_price = $settings['price'];
        $price_item_description = $settings['description'];
		$price_item_most_popular = $settings['most_popular'];
		$price_item_button_state = $settings['button_state'];
		$price_item_button_text = $settings['button_text'];
		$price_item_button_url = $settings['button_url'];
		$price_item_bg_color = $settings['bg_color'];
		
		$most_popular_class = '';
		if ($price_item_most_popular == 'yes') {
			$most_popular_class = 'most_popular_item';
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
        ?>
        <div class="photberry_price_item photberry_js_bg_color <?php echo esc_attr($most_popular_class); ?>" data-bgcolor="<?php echo esc_attr($price_item_bg_color); ?>">
            <div class="photberry_price_item_inner">
            	<?php if ($price_item_image['id'] !== '') { 
				$price_item_image_url = wp_get_attachment_url($price_item_image['id']);
				?>
				<img src="<?php echo aq_resize(esc_url($price_item_image_url), 570, 570, true, true, true); ?>" alt="<?php the_title(); ?>" class="photberry_price_item_image" />
               	<?php } ?>
                <h5 class="photberry_price_item_title"><?php echo esc_html($price_item_name); ?></h5>
                <h2><?php echo esc_html($price_item_price); ?></h2>
                <div class="photberry_price_item_descr">
                	<?php echo photberry_output($price_item_description); ?>
				</div>
           		<?php 
				if ($price_item_button_state == 'yes') {
					$target = 'target="_self"';
					$nofollow = '';
					if ($price_item_button_url['is_external'] == 'true' || $price_item_button_url['is_external'] == 'on') {
						$target = 'target="_blank"';
					}
					if ($price_item_button_url['nofollow'] == 'true' || $price_item_button_url['nofollow'] == 'on') {
						$nofollow = 'rel="nofollow"';
					}
					echo '<a href="'. esc_url($price_item_button_url['url']).'" '. $target .' '. $nofollow .' class="photberry_button photberry_reverse_button">'. esc_attr($price_item_button_text) .'</a>';
				}
				?>
            </div>
        </div>
        <?php

    }

    protected function content_template() {}

    public function render_plain_content() {}
}