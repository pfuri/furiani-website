<?php
/*
 * Created by Pixel-Mafia
 * www.pixel-mafia.com
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class PM_Portfolio_Listing_Widget extends Widget_Base {

    public function get_name() {
        return 'pm-portfolio-listing';
    }

    public function get_title() {
        return esc_html__('Portfolio Listing', 'photberry');
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
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
            'section_portfolio_listing',
            [
                'label' => esc_html__('Portfolio Listing', 'photberry')
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
		$tax = esc_attr(photberry_get_theme_mod('portfolio_pt_tax'));
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
            'portfolio_view_type',
            [
                'label' => esc_html__('Portfolio View Type', 'photberry'),
                'type' => Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => [
            		'column' => esc_html__('One Column', 'photberry'),        
					'grid' => esc_html__('Grid', 'photberry'),                    
					'grid_title' => esc_html__('Grid with Title', 'photberry')
                ]
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Posts per Page', 'photberry'),
                'type' => Controls_Manager::NUMBER,
                'default' => 9,
                'min' => 1,
                'step' => 1,
            ]
        );

        $this->add_control(
            'posts_per_click',
            [
                'label' => esc_html__('Posts per Click', 'photberry'),
                'type' => Controls_Manager::NUMBER,
                'default' => 3,
                'min' => 1,
                'step' => 1,
            ]
        );

        $this->add_control(
            'columns',
            [
                'label' => esc_html__('Columns', 'photberry'),
                'type' => Controls_Manager::SELECT,
                'default' => 3,
                'options' => [
                    2 => esc_html__('Two', 'photberry'),
                    3 => esc_html__('Three', 'photberry'),
                    4 => esc_html__('Four', 'photberry'),
					5 => esc_html__('Five', 'photberry')
                ],
                'condition' => [
                    'portfolio_view_type' => ['grid', 'grid_title']
                ]
            ]
        );

        $this->add_control(
            'images_shape',
            [
                'label' => esc_html__('Images Shape', 'photberry'),
                'type' => Controls_Manager::SELECT,
                'default' => 'rectangle',
                'options' => [
                    'rectangle' => esc_html__('Rectangle', 'photberry'),
                    'square' => esc_html__('Square', 'photberry')
                ],
                'condition' => [
                    'portfolio_view_type' => ['grid', 'grid_title']
                ]
            ]
        );

        $this->add_control(
            'masonry',
            [
                'label' => esc_html__('Masonry Layout', 'photberry'),
                'type' => Controls_Manager::SELECT,
                'default' => 'off',
                'options' => [
                    'off' => esc_html__('Off', 'photberry'),
                    'on' => esc_html__('On', 'photberry')
                ],
                'condition' => [
                    'portfolio_view_type' => ['grid', 'grid_title']
                ]
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
                'condition' => [
                    'portfolio_view_type' => ['grid', 'grid_title']
                ]
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
                'label' => esc_html__('Load More Button Status', 'photberry'),
                'type' => Controls_Manager::SELECT,
                'default' => 'show',
                'options' => [
                    'show' => esc_html__('Show', 'photberry'),
                    'hide' => esc_html__('Hide', 'photberry')
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $element_title = $settings['element_title'];
        $element_title_align = $settings['element_title_align'];

        $portfolio_view_type = $settings['portfolio_view_type'];
        $posts_per_page = $settings['posts_per_page'];
        $posts_per_click = $settings['posts_per_click'];
        $columns = $settings['columns'];
        $order_by = $settings['order_by'];
        $order = $settings['order'];
        $filter_status = $settings['filter_status'];
        $load_more_status = $settings['load_more_status'];
		$masonry = $settings['masonry'];
		$items_padding = $settings['items_padding'];
		
		$images_shape = $settings['images_shape'];

		$categs_state = $settings['categories'];
		$selected_categories = $settings['selected_categories'];
		$port_tax = esc_attr(photberry_get_theme_mod('portfolio_pt_tax'));
		$cat_string = '';
		$filter_categ_array = array();
		if ($categs_state == 'custom' && !empty($selected_categories) && $selected_categories !== 'no_categories') {
			foreach ($selected_categories as $cat_slug ) {
				$this_categ = get_term_by('slug', $cat_slug, $port_tax);
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
				if ($portfolio_view_type == 'grid') {					
					echo '<div class="photberry_'. esc_attr($portfolio_view_type) .'_filter_wrapper">' . photberry_portfolio_grid_filtering($filter_categ_array) . '</div>';
				} else {
					echo '<div class="photberry_packery_filter_wrapper">' . photberry_portfolio_packery_filtering() . '</div>';
				}
			}
			$masonry_class = '';
			if ($masonry == 'on') {
				$masonry_class = 'is_masonry';
			}

			if ($portfolio_view_type == 'grid' || $portfolio_view_type == 'grid_title') {
				wp_enqueue_script('isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array('jquery'), false, true);
				wp_enqueue_script('imagesloaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array('isotope'), false, true);
				?>
				<div class="photberry_portfolio_listing_cont photberry_portfolio_grid photberry_portfolio_grid<?php echo esc_attr($columns);?> view_type_<?php echo esc_attr($portfolio_view_type); ?> photberry_isotope_trigger <?php echo esc_attr($masonry_class); ?>" data-setPad="<?php echo esc_attr($items_padding); ?>"></div>
				<?php

				$portfolio_args = '{"output_template": "portfolio_'. esc_attr($portfolio_view_type) .'", "post_type": "pm-portfolio", "post_status":"publish", "posts_first_load": ' . esc_attr($posts_per_page) . ', "posts_per_page": ' . esc_attr($posts_per_click) . ', "offset": 0, "orderby": "' . esc_attr($order_by) . '", "order": "' . esc_attr($order) . '", "posts_counter": 1, "columns": ' . esc_attr($columns) . ', "masonry": "'. esc_attr($masonry) .'", "ajax_callback_function": "photberry_portfolio_grid_setup", "cat_string": "'. $cat_string .'", "images_shape": "'. esc_attr($images_shape) .'"}';
                ?>
                <div class="clear"></div>
                <div class="photberry_load_more_button_wrapper element_portfolio_<?php echo esc_attr($portfolio_view_type); ?> <?php echo (($load_more_status == 'hide') ? 'photberry_hidden_cont' : '') ?>">
                    <a class='photberry_button photberry_load_more_button photberry_load_more photberry_ajax_isotope photberry_ajax_query_posts <?php echo (($load_more_status == 'hide') ? 'photberry_hidden_cont' : '') ?>'
                       href='<?php echo esc_js('javascript:void(0)'); ?>'
                       data-return-to='photberry_portfolio_listing_cont'
                       data-args='<?php echo photberry_output($portfolio_args); ?>'>
                        <?php echo esc_html__('Load More', 'photberry'); ?>
                    </a>
                </div>
                <?php
			}

			if ($portfolio_view_type == 'column') {
				if (isset($_GET['slug'])) {
					$cat_string = $_GET['slug'];
				}

				?>
				<div class="photberry_portfolio_listing_cont photberry_portfolio_listing"></div>
				<?php
				$portfolio_args = '{"output_template": "portfolio_column", "post_type": "pm-portfolio", "post_status":"publish", "posts_first_load": ' . esc_attr($posts_per_page) . ', "posts_per_page": ' . esc_attr($posts_per_click) . ', "offset": 0, "orderby": "' . esc_attr($order_by) . '", "order": "' . esc_attr($order) . '", "posts_counter": 1, "cat_string": "'. $cat_string .'"}';
                ?>
                <div class="clear"></div>
                <div class="photberry_load_more_button_wrapper element_portfolio_<?php echo esc_attr($portfolio_view_type); ?> <?php echo (($load_more_status == 'hide') ? 'photberry_hidden_cont' : '') ?>">
                    <a class='photberry_button photberry_load_more_button photberry_load_more photberry_ajax_query_posts <?php echo (($load_more_status == 'hide') ? 'photberry_hidden_cont' : '') ?>'
                       href='<?php echo esc_js('javascript:void(0)'); ?>'
                       data-return-to='photberry_portfolio_listing_cont'
                       data-args='<?php echo photberry_output($portfolio_args); ?>'>
                        <?php echo esc_html__('Load More', 'photberry'); ?>
                    </a>
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