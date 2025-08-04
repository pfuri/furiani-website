<?php
/*
 * Created by Pixel-Mafia
 * www.pixel-mafia.com
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class PM_Itemized_Link_Widget extends Widget_Base {

    public function get_name() {
        return 'pm-itemized-link';
    }

    public function get_title() {
        return esc_html__('Itemized Link', 'photberry');
    }

    public function get_icon() {
        return 'eicon-info-box';
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
            'section_itemized_link',
            [
                'label' => esc_html__('Itemized Link', 'photberry')
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
            'item_title',
            [
                'label' => esc_html__('Item Title', 'photberry'),
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
			'linked_image',
			[
				'label' => esc_html__( 'Link Image', 'photberry' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'no' => esc_html__('No', 'photberry'),
					'yes' => esc_html__('Yes', 'photberry')
				]
			]
		);

		$this->add_control(
			'linked_title',
			[
				'label' => esc_html__( 'Link Title', 'photberry' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'no' => esc_html__('No', 'photberry'),
					'yes' => esc_html__('Yes', 'photberry')
				]
			]
		);

		$this->add_control(
			'link_style',
			[
				'label' => esc_html__( 'Link Style', 'photberry' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'text_w_arrow',
				'options' => [
					'none' => esc_html__('None', 'photberry'),		
					'text' => esc_html__('Text', 'photberry'),
					'text_w_arrow' => esc_html__('Text with Arrow', 'photberry'),
					'button' => esc_html__('Button', 'photberry'),
					'button_invert' => esc_html__('Inverted Button', 'photberry')
				]
			]
		);

		$this->add_control(
            'link_text',
            [
                'label' => esc_html__('Link Text', 'photberry'),
                'type' => Controls_Manager::TEXT,
				'condition' => [
					'link_style' => ['text','text_w_arrow','button','button_invert']
				]
            ]
        );
		
		$this->add_control(
            'link_url',
            [
                'label' => esc_html__('Link URL', 'photberry'),
                'type' => Controls_Manager::URL,
				'default' => [
					'url' => '',
					'is_external' => 'true',
				],
				'placeholder' => esc_html__( 'http://your-link.com', 'photberry' ),
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

		$itemized_link_image = $settings['image'];
		$itemized_link_title = $settings['item_title'];
		$itemized_link_descr = $settings['description'];
		$itemized_link_linked_image = $settings['linked_image'];
		$itemized_link_linked_title = $settings['linked_title'];
		$itemized_link_link_style = $settings['link_style'];
		$itemized_link_link_text = $settings['link_text'];
		$itemized_link_url = $settings['link_url'];
		
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
        <div class="photberry_itemized_link_item">
            <div class="photberry_itemized_link_item_inner">
            	<?php 
				$target = 'target="_self"';
				$nofollow = '';
				if ($itemized_link_url['is_external'] == 'true' || $itemized_link_url['is_external'] == 'on') {
					$target = 'target="_blank"';
				}
				if ($itemized_link_url['nofollow'] == 'true' || $itemized_link_url['nofollow'] == 'on') {
					$nofollow = 'rel="nofollow"';
				}
				
				if ($itemized_link_image['id'] !== '') {
					$featured_image = wp_get_attachment_url($itemized_link_image['id']);
					echo '<div class="photberry_itemized_link_image">';
					if ($itemized_link_linked_image == 'yes') {
						echo '<a href="'. esc_url($itemized_link_url['url']) .'" '. $target .' '. $nofollow .'><img src="'. aq_resize(esc_url($featured_image), 960, 700, true, true, true) .'" alt="'. get_the_title() .'" /></a>';
					} else {
						echo '<img src="'. aq_resize(esc_url($featured_image), 960, 700, true, true, true) .'" alt="'. get_the_title() .'" />';
					}
					echo '</div>';
				}
				
				if ($itemized_link_linked_title == 'yes') {
					echo '<h5 class="photberry_itemized_link_title"><a href="'. esc_url($itemized_link_url['url']).'" '. $target .' '. $nofollow .'>'. esc_html($itemized_link_title) .'</a></h5>';
				} else {
					echo '<h5 class="photberry_itemized_link_title">'. esc_html($itemized_link_title) .'</h5>';
				}
				?>
                <div class="photberry_itemized_link_descr"><?php echo photberry_output($itemized_link_descr); ?></div>                
           		<?php 
				if ($itemized_link_link_style == 'text' && $itemized_link_link_text !== '') {
					echo '<h6><a href="'. esc_url($itemized_link_url['url']).'" '. $target .' '. $nofollow .' class="photberry_itemized_link_href">'. esc_attr($itemized_link_link_text) .'</a></h6>';
				}
				if ($itemized_link_link_style == 'text_w_arrow' && $itemized_link_link_text !== '') {
					echo '<h6><a href="'. esc_url($itemized_link_url['url']).'" '. $target .' '. $nofollow .' class="photberry_itemized_link_href">'. esc_attr($itemized_link_link_text) .'<i class="pm-fa pm-fa-arrow-right"></i></a></h6>';
				}
				if ($itemized_link_link_style == 'button' && $itemized_link_link_text !== '') {
					echo '<a href="'. esc_url($itemized_link_url['url']).'" '. $target .' '. $nofollow .' class="photberry_itemized_link_button photberry_button">'. esc_attr($itemized_link_link_text) .'</a>';
				}
				if ($itemized_link_link_style == 'button_invert' && $itemized_link_link_text !== '') {
					echo '<a href="'. esc_url($itemized_link_url['url']).'" '. $target .' '. $nofollow .' class="photberry_itemized_link_button photberry_button photberry_reverse_button">'. esc_attr($itemized_link_link_text) .'</a>';
				}
				?>
            </div>
        </div>
        <?php

    }

    protected function content_template() {}

    public function render_plain_content() {}
}