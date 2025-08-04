<?php
/*
 * Created by Pixel-Mafia
 * www.pixel-mafia.com
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class PM_Person_Widget extends Widget_Base {

    public function get_name() {
        return 'pm-person';
    }

    public function get_title() {
        return esc_html__('Person', 'photberry');
    }

    public function get_icon() {
        return 'eicon-person';
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
            'section_person',
            [
                'label' => esc_html__('Person', 'photberry')
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
            'position',
            [
                'label' => esc_html__('Position', 'photberry'),
                'type' => Controls_Manager::TEXT,
                'default' => ''
            ]
        );

		$this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'photberry'),
                'type' => Controls_Manager::TEXTAREA
            ]
        );

        $this->add_control(
            'social_icons',
            [
                'label' => esc_html__('Social Icons', 'photberry'),
                'type' => Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'social',
                        'label' => esc_html__('icon', 'photberry'),
                        'type' => Controls_Manager::ICON,
                        'label_block' => true,
                        'default' => 'pm-fa pm-fa-wordpress',
						'options' => [
                            'pm-fa pm-fa-apple' => 'Apple',
                            'pm-fa pm-fa-behance' => 'Behance',
                            'pm-fa pm-fa-bitbucket' => 'Bitbucket',
                            'pm-fa pm-fa-codepen' => 'Codepen',
                            'pm-fa pm-fa-delicious' => 'Delicious',
                            'pm-fa pm-fa-digg' => 'Digg',
                            'pm-fa pm-fa-dribbble' => 'Dribbble',
                            'pm-fa pm-fa-envelope' => 'Envelope',
                            'pm-fa pm-fa-facebook' => 'Facebook',
                            'pm-fa pm-fa-flickr' => 'Flickr',
                            'pm-fa pm-fa-foursquare' => 'Foursquare',
                            'pm-fa pm-fa-github' => 'Github',
                            'pm-fa pm-fa-houzz' => 'Houzz',
                            'pm-fa pm-fa-instagram' => 'Instagram',
                            'pm-fa pm-fa-jsfiddle' => 'jsFiddle',
                            'pm-fa pm-fa-linkedin' => 'LinkedIn',
                            'pm-fa pm-fa-medium' => 'Medium',
                            'pm-fa pm-fa-pinterest' => 'Pinterest',
                            'pm-fa pm-fa-product-hunt' => 'Product Hunt',
                            'pm-fa pm-fa-reddit' => 'Reddit',
                            'pm-fa pm-fa-shopping-cart' => 'Shopping Cart',
                            'pm-fa pm-fa-slideshare' => 'Slideshare',
                            'pm-fa pm-fa-snapchat' => 'SnapChat',
                            'pm-fa pm-fa-soundcloud' => 'SoundCloud',
                            'pm-fa pm-fa-spotify' => 'Spotify',
                            'pm-fa pm-fa-stack-overflow' => 'Stack Overflow',
                            'pm-fa pm-fa-tripadvisor' => 'Trip Advisor',
                            'pm-fa pm-fa-tumblr' => 'Tumblr',
                            'pm-fa pm-fa-twitch' => 'Twitch',
                            'pm-fa pm-fa-twitter' => 'Twitter',
                            'pm-fa pm-fa-vimeo' => 'Vimeo',
                            'pm-fa pm-fa-vk' => 'VK',
                            'pm-fa pm-fa-whatsapp' => 'WhatsApp',
                            'pm-fa pm-fa-wordpress' => 'Wordpress',
                            'pm-fa pm-fa-xing' => 'Xing',
                            'pm-fa pm-fa-yelp' => 'Yelp',
                            'pm-fa pm-fa-youtube' => 'Youtube',
						],
                        'include' => [
                            'pm-fa pm-fa-apple',
                            'pm-fa pm-fa-behance',
                            'pm-fa pm-fa-bitbucket',
                            'pm-fa pm-fa-codepen',
                            'pm-fa pm-fa-delicious',
                            'pm-fa pm-fa-digg',
                            'pm-fa pm-fa-dribbble',
                            'pm-fa pm-fa-envelope',
                            'pm-fa pm-fa-facebook',
                            'pm-fa pm-fa-flickr',
                            'pm-fa pm-fa-foursquare',
                            'pm-fa pm-fa-github',
                            'pm-fa pm-fa-houzz',
                            'pm-fa pm-fa-instagram',
                            'pm-fa pm-fa-jsfiddle',
                            'pm-fa pm-fa-linkedin',
                            'pm-fa pm-fa-medium',
                            'pm-fa pm-fa-pinterest',
                            'pm-fa pm-fa-product-hunt',
                            'pm-fa pm-fa-reddit',
                            'pm-fa pm-fa-shopping-cart',
                            'pm-fa pm-fa-slideshare',
                            'pm-fa pm-fa-snapchat',
                            'pm-fa pm-fa-soundcloud',
                            'pm-fa pm-fa-spotify',
                            'pm-fa pm-fa-stack-overflow',
                            'pm-fa pm-fa-tripadvisor',
                            'pm-fa pm-fa-tumblr',
                            'pm-fa pm-fa-twitch',
                            'pm-fa pm-fa-twitter',
                            'pm-fa pm-fa-vimeo',
                            'pm-fa pm-fa-vk',
                            'pm-fa pm-fa-whatsapp',
                            'pm-fa pm-fa-wordpress',
                            'pm-fa pm-fa-xing',
                            'pm-fa pm-fa-yelp',
                            'pm-fa pm-fa-youtube',
                        ]
                    ],
                    [
                        'name' => 'link',
                        'label' => esc_html__( 'Link', 'photberry' ),
                        'type' => Controls_Manager::URL,
                        'label_block' => true,
                        'default' => [
                            'url' => '',
                            'is_external' => 'true',
                        ],
                        'placeholder' => esc_html__( 'http://your-link.com', 'photberry' ),
                    ]
                ],
                'title_field' => '<i class="{{ social }}"></i> {{{ social.replace( \'pm-fa pm-fa-\', \'\' ).replace( \'-\', \' \' ).replace( /\b\w/g, function( letter ){ return letter.toUpperCase() } ) }}}',
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

        $person_image = $settings['image'];
        $person_name = $settings['name'];
        $person_position = $settings['position'];
        $person_socials = $settings['social_icons'];
		$person_description = $settings['description'];

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
		$person_image_url = wp_get_attachment_url($person_image['id']);
        ?>
        <div class="photberry_person_item">
            <img src="<?php echo aq_resize($person_image_url, '960', '960', true, true, true); ?>" alt="<?php the_title(); ?>" />

            <div class="photberry_person_info <?php echo ((is_array($person_socials)) ? 'with_socials' : 'no_socials'); ?>">
                <h5 class="photberry_person_title"><?php echo esc_html($person_name); ?></h5>
                <span class="photberry_person_position"><?php echo esc_html($person_position); ?></span>
				<div class="photberry_person_content">
					<?php echo esc_html($person_description); ?>
				</div>
                <?php
                if (is_array($person_socials)) {
                    ?>
                    <div class="photberry_person_socials">
                        <?php
                        foreach ($person_socials as $social) {
                            if ($social['link']['url'] !== '') {
                                $person_social_url = $social['link']['url'];
                            } else {
                                $person_social_url = '#';
                            }
                            ?>
                            <a href="<?php echo esc_url($person_social_url); ?>">
                                <i class="<?php echo esc_attr($social['social']); ?>"></i>
                            </a>
                        <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php

    }

    protected function content_template() {}

    public function render_plain_content() {}
}