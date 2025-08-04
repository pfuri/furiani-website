<?php
/*
 * Created by Pixel-Mafia
 * www.pixel-mafia.com
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class PM_Packery_Gallery_Widget extends Widget_Base {

    public function get_name() {
        return 'pm-packery-gallery';
    }

    public function get_title() {
        return esc_html__('Packery Gallery', 'photberry');
    }

    public function get_icon() {
        return 'eicon-inner-section';
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
            'section_packery_gallery',
            [
                'label' => esc_html__('Packery Gallery', 'photberry')
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
            'posts_per_page',
            [
                'label' => esc_html__('Posts per Page', 'photberry'),
                'type' => Controls_Manager::NUMBER,
                'default' => 8,
                'min' => 1,
                'step' => 1,
            ]
        );

        $this->add_control(
            'posts_per_click',
            [
                'label' => esc_html__('Posts per Click', 'photberry'),
                'type' => Controls_Manager::NUMBER,
                'default' => 4,
                'min' => 1,
                'step' => 1,
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

		$images = $settings['images'];
		$posts_per_page = $settings['posts_per_page'];
		$posts_per_click = $settings['posts_per_click'];
		$items_padding = $settings['items_padding'];
		$button_text = $settings['button_text'];
		$button_type = $settings['button_type'];


        photberry_PM_widgets_back_end_icons(self::get_icon(), self::get_name(), self::get_title());
		wp_enqueue_script('photberry_gallery_packery', get_template_directory_uri() . '/js/pm_gallery_packery.js', true, false, true);
		wp_enqueue_script('isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array('jquery'), false, true);
		wp_enqueue_script('packery', get_template_directory_uri() . '/js/packery-mode.pkgd.js', array('jquery'), false, true);
		wp_enqueue_script('imagesloaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array('isotope'), false, true);		
		
		$img_width = 960;
		$img_height = 960;
		$uniqid = mt_rand(0, 9999);
		$packery_array = array();
		$img_array = array();
		$imgCounter = 0;
		$button_class = '';
		
		if ($button_type == 'reverse') {
			$button_class = 'photberry_reverse_button';
		}
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
			echo '
			<div class="photberry_packery_wrapper photberry_packery_'. esc_attr($uniqid) .'" data-uniqid="'. esc_attr($uniqid) .'" data-perload="'. esc_attr($posts_per_click) .'">
				<div class="photberry_packery_inner photberry_isotope_trigger is_packery" data-pad="'. esc_attr($items_padding) .'" data-perload="'. esc_attr($posts_per_click) .'">
			';

			foreach ( $images as $index => $image ) {
				$photoCaption = '';
				$attach_meta = photberry_get_attachment($image['id']);
				$photoTitle = $attach_meta['caption'];
				$photoCaption = $attach_meta['description'];
				$photoAlt = $attach_meta['alt'];
				$PCREpattern = '/\r\n|\r|\n/u';
				$photoCaption = preg_replace($PCREpattern, '', nl2br($photoCaption));

				$featured_image = wp_get_attachment_url($image['id']);
				if (strlen($featured_image[0]) > 0) {
					$featured_image_url = aq_resize(esc_url($featured_image), esc_attr($img_width), esc_attr($img_height), true, true, true);
				} else {
					$featured_image_url = '';
				}

				$featured_image = wp_get_attachment_image_src($image['id'], 'original');
				
				
				$img_array['attach_id'] = esc_attr($image['id']);
				$img_array['slide_type'] = 'image';
				$img_array['title'] = esc_attr($photoTitle);
				$img_array['alt'] = esc_attr($photoAlt);
				$img_array['thmb'] = esc_url($featured_image_url);
				$img_array['url'] = esc_url($featured_image[0]);
				$img_array['count'] = esc_attr($imgCounter);
				
				$imgCounter++;
				
				array_push($packery_array, $img_array);
			}

			if ($posts_per_page > count($packery_array)) {
				$posts_per_page = count($packery_array);
			}

			$i = 0;
			//photberry_pre($packery_array);
			while ($i < $posts_per_page) {
				$count = $i + 1;
				if ($count > 8) {
					$count = 1;
				}
				if ($packery_array[$i]['slide_type'] == 'image') {
					$thishref = wp_get_attachment_url($packery_array[$i]['attach_id']);
					$thisvideoclass = '';
				} else if ($packery_array[$i]['slide_type'] == 'video') {
					$thishref = $packery_array[$i]['src'];
					$thisvideoclass = 'video_zoom';
				}
				$photoTitle = '';
				$photoTitle = $packery_array[$i]['title'];
				if (isset($photoTitle) && $photoTitle !== '') {
					$photoTitle = str_replace('"', "'", $photoTitle);
				}
				$photoAlt = $packery_array[$i]['alt'];
				$imgCounter = $packery_array[$i]['count'];
				$featured_image = $packery_array[$i]['url'];
				$img_thmb = $packery_array[$i]['thmb'];
				echo '
				<div class="packery-item packery-item'. esc_attr($count) .' element anim_el anim_el2 load_anim packery_b2p" data-count="'. esc_attr($count) .'">
					<div class="packery-item-inner photberry_js_bg_image" data-src="'. esc_url($img_thmb) .'">
						<a rel="packery_gallery'. esc_attr($uniqid) .'" href="'. esc_url($featured_image) .'" class="swipebox" data-elementor-open-lightbox="no">
							<div class="packery-item-content">
								<h4>'. esc_attr($photoTitle) .'</h4>
							</div>
						</a>
						<div class="photberry-img-preloader"></div>
					</div>
				</div>';
				unset($packery_array[$i]);
				$i++;
			} //EoWhile First Load	
				echo '
			</div>';
		if (isset($packery_array) && count($packery_array) > 0) {
			echo '<div class="photberry_packery_gallery_array" data-id = "'. esc_attr($uniqid) .'">';
				$i = 0;
				foreach ($packery_array as $image) {
					echo '<div class="photberry_packery_array_item" 
							data-id = "'. esc_attr($uniqid) .'" 
							data-type = "' . esc_attr($image['slide_type']) . '" 
							data-img = "' . esc_url($image['url']) . '" 
							data-thmb = "' . esc_url($image['thmb']) . '" 
							data-title = "' . esc_attr($image['title']) . '" 
							data-alt = "' . esc_attr($image['alt']) . '" 
							data-counter = "' . esc_attr($image['count']) . '"></div>';
				}
			echo '</div>';

			echo '<div class="photberry_load_more_button_wrapper packery_loadmore_wrapper"><a class="photberry_load_more_button packery_load_more photberry_button '. esc_attr($button_class) .'" href="'. esc_js("javascript:void(0)") .'">' . esc_attr($button_text) . '</a></div>';
		}

			echo '
			</div>';
   			?>

        </div>
        <?php
    }

    protected function content_template() {}

    public function render_plain_content() {}
}