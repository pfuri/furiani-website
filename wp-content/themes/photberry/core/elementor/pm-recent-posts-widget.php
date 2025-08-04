<?php
/*
 * Created by Pixel-Mafia
 * www.pixel-mafia.com
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class PM_Recent_Posts_Widget extends Widget_Base {

	public function get_name() {
		return 'pm-recent-posts';
	}

	public function get_title() {
		return esc_html__( 'Recent Posts', 'photberry' );
	}

	public function get_icon() {
		return 'eicon-post-list';
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
			'section_resent_posts',
			[
				'label' => esc_html__( 'Recent Posts', 'photberry' )
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label' => esc_html__( 'Number of Posts', 'photberry' ),
				'type' => Controls_Manager::SELECT,
				'default' => 3,
				'options' => [
					2 => esc_html__( 'Two', 'photberry' ),
					3 => esc_html__( 'Three', 'photberry' ),
					4 => esc_html__( 'Four', 'photberry' ),
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

		$this->end_controls_section();

	}

	protected function render() {
        $settings = $this->get_settings();

        $element_title = $settings['element_title'];
        $element_subtitle = $settings['element_subtitle'];
        $element_title_align = $settings['element_title_align'];
        $element_subtitle_align = $settings['element_subtitle_align'];

		$post_count = ! empty( $settings['posts_per_page'] ) ? (int)$settings['posts_per_page'] : 3;
        $orderby = $settings['post_order_by'];
        $order = $settings['post_order'];

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
        $args = array(
            'posts_per_page' => $post_count,
            'orderby' => $orderby,
            'order' => $order
        );

        $recent_posts = query_posts($args);

        if (have_posts()) {
            ?>
            <div class="photberry_featured_posts photberry_items_<?php echo esc_attr($post_count); ?>">
                <?php
                while (have_posts()) {
                    the_post();

					if ($post_count == '2') {
						$featured_image = aq_resize(esc_url(photberry_get_featured_image_url()), 1170, 959, true, true, true);
						$post_excerpt = substr(get_the_excerpt(), 0, 140);
					}

					if ($post_count == '3') {
						$featured_image = aq_resize(esc_url(photberry_get_featured_image_url()), 780, 634, true, true, true);
						$post_excerpt = substr(get_the_excerpt(), 0, 165);
					}

					if ($post_count == '4') {
						$featured_image = aq_resize(esc_url(photberry_get_featured_image_url()), 584, 546, true, true, true);
						$post_excerpt = substr(get_the_excerpt(), 0, 100);
					}
                    ?>
                    <div class="photberry_posts_item">
						<div class="photberry_fimage_cont">
							<a href="<?php echo esc_url(get_permalink()); ?>">
								<img src="<?php echo esc_url($featured_image); ?>" alt="<?php the_title(); ?>" />
							</a>
						</div>

                        <div class="photberry_post_meta">
							<div class="photberry_post_meta_item">
								<?php echo get_the_date(); ?>
							</div>
							<div class="photberry_post_meta_item">
								<?php echo esc_html__('by', 'photberry'); echo ' '; the_author_posts_link(); ?>
							</div>
							<div class="photberry_post_meta_item">
								<?php echo esc_html__('in', 'photberry'); echo ' '; the_category('<span>+</span>'); ?>
							</div>									
                        </div>

						<h4 class="photberry_post_title">
							<a href="<?php echo esc_url(get_permalink()); ?>">
								<?php echo get_the_title(); ?>
							</a>
						</h4>

                        <div class="photberry_excerpt">
                            <?php echo esc_attr($post_excerpt); ?>
                        </div>
                    </div>
                    <?php
                }

                wp_reset_query();
                ?>
            </div>
            <?php
        }
	}

	protected function content_template() {}

	public function render_plain_content() {}

}


