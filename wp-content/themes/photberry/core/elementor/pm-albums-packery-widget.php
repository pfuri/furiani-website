<?php
/*
 * Created by Pixel-Mafia
 * www.pixel-mafia.com
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class PM_Albums_Packery_Widget extends Widget_Base {

    public function get_name() {
        return 'pm-albums-packery';
    }

    public function get_title() {
        return esc_html__('Albums Packery', 'photberry');
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
            'section_albums_packery',
            [
                'label' => esc_html__('Albums Packery', 'photberry')
            ]
        );
		
        $this->add_control(
            'categories',
            [
                'label' => esc_html__('Categories', 'photberry'),
                'type' => Controls_Manager::SELECT,
                'default' => 'all',
                'options' => [
                    'all' => esc_html__('All', 'photberry'),
                    'custom' => esc_html__('Customize', 'photberry')
                ]
            ]
        );
		
		//Categories List
		$tax = esc_attr(photberry_get_theme_mod('albums_pt_tax'));
		$args = array('taxonomy' => 'Category');
		$terms = get_terms($tax, $args);
		$categories = get_categories($args, $tax);

		$photberry_post_categs = array();
		if (is_array($terms) && count($terms) > 0) {
			foreach ($terms as $cat) {
				$photberry_post_categs[$cat->slug] = $cat->name;
			}
		} else {
			$photberry_post_categs = array('no_categories' => esc_html__( "No category available", 'photberry' ));
		}

		$this->add_control(
			'selected_categories',
			[
				'label' => __( 'Select Categories', 'photberry' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $photberry_post_categs,
				'multiple' => true,
				'condition' => [
					'categories' => 'custom'
				]
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
                'step' => 1,
            ]
        );

        $this->add_control(
            'order_by',
            [
                'label' => esc_html__('Order By', 'photberry'),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'date' => esc_html__('Post Date', 'photberry'),
                    'rand' => esc_html__('Random', 'photberry'),
                    'ID' => esc_html__('Post ID', 'photberry'),
                    'title' => esc_html__('Post Title', 'photberry')
                ]
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => esc_html__('Order', 'photberry'),
                'type' => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'desc' => esc_html__('Descending', 'photberry'),
                    'asc' => esc_html__('Ascending', 'photberry')
                ]
            ]
        );

        $this->add_control(
            'filter_status',
            [
                'label' => esc_html__('Filter Status', 'photberry'),
                'type' => Controls_Manager::SELECT,
                'default' => 'show',
                'options' => [
                    'show' => esc_html__('Show', 'photberry'),
                    'hide' => esc_html__('Hide', 'photberry')
                ],
            ]
        );

        $this->add_control(
            'load_more_status',
            [
                'label' => esc_html__('Load More Status', 'photberry'),
                'type' => Controls_Manager::SELECT,
                'default' => 'show',
                'options' => [
                    'show' => esc_html__('Show', 'photberry'),
                    'hide' => esc_html__('Hide', 'photberry')
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $element_title = $settings['element_title'];
        $element_title_align = $settings['element_title_align'];

		$posts_per_page = $settings['posts_per_page'];
		$posts_per_click = $settings['posts_per_click'];
		$items_padding = $settings['items_padding'];
		$order_by = $settings['order_by'];
		$order = $settings['order'];
		$filter_status = $settings['filter_status'];
        $load_more_status = $settings['load_more_status'];

		$categs_state = $settings['categories'];
		$selected_categories = $settings['selected_categories'];
		$album_tax = esc_attr(photberry_get_theme_mod('albums_pt_tax'));
		$cat_string = '';
		$filter_categ_array = array();
		if ($categs_state == 'custom' && !empty($selected_categories) && $selected_categories !== 'no_categories') {
			foreach ($selected_categories as $cat_slug ) {
				$this_categ = get_term_by('slug', $cat_slug, $album_tax);
				$this_categ_id = $this_categ->term_id;
				$cat_string .= $this_categ_id .',';
				array_push($filter_categ_array, $this_categ_id);
			}
			$cat_string = substr($cat_string, 0, -1);
		}

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


            // Element Content
			if ($filter_status == 'show') {
				echo '<div class="photberry_albums_filter_wrapper">' . photberry_albums_grid_filtering($filter_categ_array) . '</div>';
			}

			wp_enqueue_script('isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array('jquery'), false, true);
			wp_enqueue_script('packery', get_template_directory_uri() . '/js/packery-mode.pkgd.js', array('jquery'), false, true);
			wp_enqueue_script('imagesloaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array('isotope'), false, true);
			?>
			<div class="photberry_albums_packery_wrapper">
				<div class="photberry_albums_packery_cont photberry_albums_packery photberry_isotope_trigger is_packery" data-setPad="<?php echo esc_attr($items_padding); ?>"></div>
			</div>
			<?php

			$albums_args = '{"output_template": "albums_packery", "post_type": "pm-albums", "post_status":"publish", "posts_first_load": ' . esc_attr($posts_per_page) . ', "posts_per_page": ' . esc_attr($posts_per_click) . ', "offset": 0, "orderby": "' . esc_attr($order_by) . '", "order": "' . esc_attr($order) . '", "posts_counter": 1, "ajax_callback_function": "photberry_albums_packery_setup", "cat_string": "'. $cat_string .'"}';

			?>
			<div class="clear"></div>

			<div class="photberry_load_more_button_wrapper element_albums_packery">
				<a class='photberry_button photberry_load_more_button photberry_load_more photberry_ajax_isotope photberry_ajax_query_posts <?php echo (($load_more_status == 'hide') ? 'photberry_hidden_cont' : '') ?>'
				   href='<?php echo esc_js('javascript:void(0)'); ?>'
				   data-return-to='photberry_albums_packery_cont'
				   data-args='<?php echo photberry_output($albums_args); ?>'>
					<?php echo esc_html__('Load More', 'photberry'); ?>
				</a>
			</div>
        </div>
        <?php
    }

    protected function content_template() {}

    public function render_plain_content() {}
}