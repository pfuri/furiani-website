<?php
/*
 * Created by Pixel-Mafia
 * www.pixel-mafia.com
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class PM_Albums_Carousel_Widget extends Widget_Base {

    public function get_name() {
        return 'pm-albums-carousel';
    }

    public function get_title() {
        return esc_html__('Albums Carousel', 'photberry');
    }

    public function get_icon() {
        return 'eicon-slider-album';
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
            'section_albums_carousel',
            [
                'label' => esc_html__('Albums Carousel', 'photberry')
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
            'items_on_screen',
            [
                'label' => esc_html__( 'Items on Screen', 'photberry' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 4,
                'min' => 1,
                'step' => 1,
            ]
        );

		$this->add_control(
            'items_padding',
            [
                'label' => esc_html__( 'Items Padding', 'photberry' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 10,
                'min' => 1,
                'step' => 1,
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
                ]
            ]
        );

		$this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $element_title = $settings['element_title'];
        $element_title_align = $settings['element_title_align'];

		$order_by = $settings['order_by'];
		$order = $settings['order'];
		$items_padding = $settings['items_padding'];
		$items_on_screen = $settings['items_on_screen'];
		$autoplay = $settings['autoplay'];
		$autoplay_speed = $settings['autoplay_speed'];
		$pause_on_hover = $settings['pause_on_hover'];
		$infinite = $settings['infinite'];

		$categs_state = $settings['categories'];
		$selected_categories = $settings['selected_categories'];
		$album_tax = esc_attr(photberry_get_theme_mod('albums_pt_tax'));
		$cat_string = '';
		if ($categs_state == 'custom' && !empty($selected_categories) && $selected_categories !== 'no_categories') {
			foreach ($selected_categories as $cat_slug ) {
				$this_categ = get_term_by('slug', $cat_slug, $album_tax);
				$this_categ_id = $this_categ->term_id;
				$cat_string .= $this_categ_id .',';
			}
			$cat_string = substr($cat_string, 0, -1);
		}
		$post_type_terms = explode(",", $cat_string);
        $args = array(
            'post_type' => 'pm-albums',
            'post_status' => 'publish',
            'orderby' => esc_attr($order_by),
			'order' => esc_attr($order),
            'posts_per_page' => -1,
            'ignore_sticky_posts' => 1
        );

		if ($cat_string !== '') {
			$args['tax_query'] = array(
				array(
					'taxonomy' => $album_tax,
					'field' => 'id',
					'terms' => $post_type_terms
				)
			);
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

			echo '<div class="photberry_albums_carousel_wrapper">';
			?>
				<div class="photberry_albums_carousel photberry_owlCarousel owl-carousel owl-theme"
					data-setpad = "<?php echo esc_attr($items_padding); ?>"
					data-onscreen = "<?php echo esc_attr($items_on_screen); ?>"
					data-pause = "<?php echo esc_attr($pause_on_hover); ?>"
					data-infinite = "<?php echo esc_attr($infinite); ?>"
					data-autoplay = "<?php echo esc_attr($autoplay); ?>"
					data-speed = "<?php echo esc_attr($autoplay_speed); ?>">
			<?php
				$count = 0;
		 		query_posts($args);
				if (have_posts()) {
					while (have_posts()) {
						the_post();

						$terms = get_the_terms(get_the_ID(), $album_tax);
						$categories = array();
						$categories_class = '';
						if (is_array($terms)) {
							foreach ($terms as $term) {
								$category_name = strtr($term->name, array(
									" " => "-",
									"'" => "-",
								));

								$categories[] =  esc_html($term->name);
								$categories_class .= strtolower($category_name) . ' ';
							}
						}
						$featured_image = photberry_get_featured_image_url();
						?>
						<div class="photberry_albums_carousel_item">
							<div class="photberry_albums_carousel_item_inner">
								<a href="<?php echo esc_url(get_permalink()); ?>">
									<img src="<?php echo esc_url(aq_resize(esc_url($featured_image), 960, 960, true, true, true)); ?>" alt="<?php the_title(); ?>" />
									<div class="photberry_albums_carousel_content">
										<h6 class="photberry_albums_category">
											<?php echo (is_array($categories) ? join(', ', $categories) : ''); ?>
										</h6>
										<h3 class="photberry_albums_title">
											<?php echo get_the_title(); ?>
										</h3>
									</div>
								</a>
							</div><!-- .photberry_albums_carousel_item_inner -->
						</div><!-- .photberry_albums_carousel_item -->
						<?php
					}
					wp_reset_query();
				}

				// Element Content
				?>
				</div><!-- .photberry_albums_carousel_slider -->
			</div><!-- .photberry_albums_carousel_wrapper -->
        </div>
        <?php
    }

    protected function content_template() {}

    public function render_plain_content() {}
}
