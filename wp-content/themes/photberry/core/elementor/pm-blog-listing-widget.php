<?php
/*
 * Created by Pixel-Mafia
 * www.pixel-mafia.com
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class PM_Blog_Listing_Widget extends Widget_Base {

    public function get_name() {
        return 'pm-blog-listing';
    }

    public function get_title() {
        return esc_html__('Blog', 'photberry');
    }

    public function get_icon() {
        return 'eicon-posts-grid';
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
            'section_blog_listing',
            [
                'label' => esc_html__('Blog Listing', 'photberry')
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
		$args = array('type' => 'post');
		$categories = get_categories($args);

		$photberry_post_categs = array();
		if (count($categories) > 0) {
			foreach ($categories as $cat) {
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
            'blog_view_type',
            [
                'label' => esc_html__('Blog View Type', 'photberry'),
                'type' => Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => [
                    'grid' => esc_html__('Grid', 'photberry'),
                    'standard' => esc_html__('Standard', 'photberry')
                ]
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
                    'blog_view_type' => 'grid'
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
                    'blog_view_type' => 'grid'
                ]
            ]
        );
	
        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Posts per Page', 'photberry'),
                'type' => Controls_Manager::NUMBER,
                'default' => '3',
                'min' => '1',
                'step' => '1'
            ]
        );

        $this->add_control(
            'posts_per_click',
            [
                'label' => esc_html__('Posts per Click', 'photberry'),
                'type' => Controls_Manager::NUMBER,
                'default' => '3',
                'min' => '1',
                'step' => '1',
                'condition' => [
                    'blog_view_type' => 'grid',
                    'grid_blog_nav' => 'load_more'
                ]
            ]
        );

        $this->add_control(
            'post_order_by',
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
            'post_order',
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
            'grid_blog_nav',
            [
                'label' => esc_html__('Pages Navigation', 'photberry'),
                'type' => Controls_Manager::SELECT,
                'default' => 'load_more',
                'options' => [
                    'load_more' => esc_html__('Load More Button', 'photberry'),
                    'pagination' => esc_html__('Pagination', 'photberry'),
					'none' => esc_html__('None', 'photberry'),
                ],
                'condition' => [
                    'blog_view_type' => 'grid'
                ]
            ]
        );

        $this->add_control(
            'blog_pagination',
            [
                'label' => esc_html__('Pagination', 'photberry'),
                'type' => Controls_Manager::SELECT,
                'default' => 'show',
                'options' => [
                    'show' => esc_html__('Show', 'photberry'),
                    'hide' => esc_html__('Hide', 'photberry')
                ],
                'condition' => [
                    'blog_view_type' => 'standard'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $element_title = $settings['element_title'];
        $element_title_align = $settings['element_title_align'];

        $blog_view_type = $settings['blog_view_type'];
        $posts_per_page = $settings['posts_per_page'];
        $post_order_by = $settings['post_order_by'];
        $post_order = $settings['post_order'];
		$categs_state = $settings['categories'];
		$selected_categories = $settings['selected_categories'];
		
		$columns = $settings['columns'];
		$images_shape = $settings['images_shape'];


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
            // View Type Grid
            if ($blog_view_type == 'grid') {

                $grid_blog_nav = $settings['grid_blog_nav'];
                $posts_per_click = $settings['posts_per_click'];
				$cat_string = '';
				if ($categs_state == 'custom' && !empty($selected_categories) && $selected_categories !== 'no_categories') {
					foreach ($selected_categories as $cat_slug ) {
						$this_categ = get_category_by_slug($cat_slug);
						$this_categ_id = $this_categ->term_id;
						$cat_string .= $this_categ_id .',';
					}
					$cat_string = substr($cat_string, 0, -1);
				}
				
				if ($grid_blog_nav == 'pagination') {
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

					$args = array(
						'posts_per_page' => absint($posts_per_page),
						'orderby' => esc_attr($post_order_by),
						'order' => esc_attr($post_order),
						'paged' => esc_attr($paged)
					);
					if ($categs_state == 'custom' && !empty($selected_categories) && $selected_categories !== 'no_categories') {
						$cat_string = '';
						foreach ($selected_categories as $cat_slug ) {
							$this_categ = get_category_by_slug($cat_slug);
							$this_categ_id = $this_categ->term_id;
							$cat_string .= $this_categ_id .',';
						}
						$cat_string = substr($cat_string, 0, -1);
						$args['cat'] = $cat_string;
					}
					?>
					<div class="photberry_grid_blog_listing_cont items_in_row_<?php echo esc_attr($columns); ?>">
						<?php
						query_posts($args);

						if (have_posts()) {
							while (have_posts()) {
								the_post();
								$featured_image = photberry_get_featured_image_url();
								$html = '
									<div class="photberry_grid_blog_item photberry_load">';
										if (!empty($featured_image)) {
								$html .= '
										<a href="'. esc_url(get_permalink()) .'" class="photberry_grid_blog_image">
											<img src="' . aq_resize(esc_url($featured_image), 1110, 810, true, true, true) . '" alt="'. get_the_title() .'">
										</a>
								';
										}
								$html .= '
										<div class="photberry_post_content">
											<div class="photberry_post_meta">
												<div class="photberry_post_meta_item">
													' . get_the_date() . '
												</div>
												<div class="photberry_post_meta_item">
													' . esc_attr__('by ', 'photberry') . get_the_author_posts_link() . '
												</div>
												<div class="photberry_post_meta_item">
													' . get_the_category_list(', ') . '
												</div>
											</div>
											<h4 class="photberry_post_title"><a href="'. esc_url(get_permalink()) .'">' . esc_html(get_the_title()) . '</a></h4>
											<div class="photberry_post_excerpt">
												' . photberry_excerpt_truncate(get_the_excerpt(), 170, '...') . '
											</div>
										</div>
									</div>
								';
								echo photberry_output($html);
							}
						}
						?>
					</div>
					<div class="photberry_blog_listing_pagination">
                        <?php
                        echo get_the_posts_pagination(array(
                            'prev_text' => '<i class="pm-fa pm-fa-arrow-left" aria-hidden="true"></i>' . esc_html__(' Prev', 'photberry'),
                            'next_text' => esc_html__('Next ', 'photberry') . '<i class="pm-fa pm-fa-arrow-right" aria-hidden="true"></i>'
                        ));
                        ?>
                    </div>
					<?php
					wp_reset_query();
				} else {
					?>
					<div class="photberry_grid_blog_listing_cont items_in_row_<?php echo esc_attr($columns); ?>"></div>
					<div class="clear"></div>
					<div class="photberry_load_more photberry_load_more_button_wrapper">
						<a class='photberry_button photberry_load_more_button grid_blog_trigger photberry_ajax_query_posts photberry_ajax_query_posts <?php echo (($grid_blog_nav == 'none') ? 'photberry_hidden_cont' : ''); ?>'
						   href='<?php echo esc_js('javascript:void(0)'); ?>'
						   data-return-to='photberry_grid_blog_listing_cont'
						   data-args='{"output_template": "grid_blog_list", "post_type": "post", "post_status":"publish", "posts_first_load": <?php echo esc_attr($posts_per_page); ?>, "posts_per_page": <?php echo esc_attr($posts_per_click) ?>, "offset":0, "orderby": "<?php echo esc_attr($post_order_by); ?>", "order": "<?php echo esc_attr($post_order); ?>", "posts_counter": 1, "cat": "<?php echo esc_attr($cat_string); ?>", "images_shape": "<?php echo esc_attr($images_shape); ?>"}'>
							<?php echo esc_html__('Load More', 'photberry'); ?>
						 </a>
					</div>
					<?php
				}
            }

            // View Type Standard
            else {
                $blog_pagination = $settings['blog_pagination'];
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				
                $args = array(
                    'posts_per_page' => absint($posts_per_page),
                    'orderby' => esc_attr($post_order_by),
                    'order' => esc_attr($post_order),
                    'paged' => esc_attr($paged)
                );
				if ($categs_state == 'custom' && !empty($selected_categories) && $selected_categories !== 'no_categories') {
					$cat_string = '';
					foreach ($selected_categories as $cat_slug ) {
						$this_categ = get_category_by_slug($cat_slug);
						$this_categ_id = $this_categ->term_id;
						$cat_string .= $this_categ_id .',';
					}
					$cat_string = substr($cat_string, 0, -1);
					$args['cat'] = $cat_string;
				}
                ?>

                <div class="photberry_blog_wrapper photberry_element_blog">
                    <?php
                    query_posts($args);

                    if (have_posts()) {
                        while (have_posts()) {
                            the_post();

                            get_template_part('standard-listing');
                        }
                    }
                    ?>
                </div>

                <?php
                if ($blog_pagination == 'show') {
                    ?>
                    <div class="photberry_blog_listing_pagination">
                        <?php
                        echo get_the_posts_pagination(array(
                            'prev_text' => '<i class="pm-fa pm-fa-arrow-left" aria-hidden="true"></i>' . esc_html__(' Prev', 'photberry'),
                            'next_text' => esc_html__('Next ', 'photberry') . '<i class="pm-fa pm-fa-arrow-right" aria-hidden="true"></i>'
                        ));
                        ?>
                    </div>
                    <?php
                }

                wp_reset_query();
            }
            ?>
        </div>
        <?php
    }

    protected function content_template() {}

    public function render_plain_content() {}
}