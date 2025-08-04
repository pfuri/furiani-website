<?php
/*
 * Created by Pixel-Mafia
 * www.pixel-mafia.com
*/

if (!class_exists('RWMB_Loader')) {
    return;
}

add_filter('rwmb_meta_boxes', 'photberry_meta_boxes');
function photberry_meta_boxes($meta_boxes)
{
    # Image Post Format
    $meta_boxes[] = array(
        'title' => esc_attr__('Image Post Format Settings', 'photberry'),
        'post_types' => array('post', 'pm-portfolio'),
        'fields' => array(
            array(
                'id' => 'photberry_pf_images',
                'name' => esc_attr__('Select Images', 'photberry'),
                'type' => 'image_advanced',
            ),
            array(
                'id' => 'photberry_pf_images_crop_status',
                'name' => esc_attr__('Crop Images', 'photberry'),
                'type' => 'select',
                'options' => array(
                    'yes' => esc_attr__('Yes', 'photberry'),
                    'no' => esc_attr__('No', 'photberry'),
                ),
            ),
            array(
                'id' => 'photberry_pf_images_width',
                'name' => esc_attr__('Image Width', 'photberry'),
                'type' => 'text',
                'desc' => esc_attr__('In pixels.', 'photberry'),
                'std' => '1600',
                'attributes' => array(
                    'data-dependency-id' => 'photberry_pf_images_crop_status',
                    'data-dependency-val' => 'yes'
                ),
            ),
            array(
                'id' => 'photberry_pf_images_height',
                'name' => esc_attr__('Image Height', 'photberry'),
                'type' => 'text',
                'desc' => esc_attr__('In pixels.', 'photberry'),
                'std' => '900',
                'attributes' => array(
                    'data-dependency-id' => 'photberry_pf_images_crop_status',
                    'data-dependency-val' => 'yes'
                ),
            ),
        ),
    );

	# Gallery Post Format
    $meta_boxes[] = array(
        'title' => esc_attr__('Gallery Post Format Settings', 'photberry'),
        'post_types' => array('post', 'pm-portfolio'),
        'fields' => array(
            array(
                'id' => 'photberry_pf_gal_images',
                'name' => esc_attr__('Select Images', 'photberry'),
                'type' => 'image_advanced',
            ),
            array(
                'id' => 'photberry_pf_gal_in_row',
                'name' => esc_attr__('Items in Row', 'photberry'),
                'type' => 'select',
				'std' => '4',
                'options' => array(
					'1' => esc_attr__('1 Item', 'photberry'),
					'2' => esc_attr__('2 Items', 'photberry'),
                    '3' => esc_attr__('3 Items', 'photberry'),
					'4' => esc_attr__('4 Items', 'photberry'),
					'5' => esc_attr__('5 Items', 'photberry')
                ),
            ),
            array(
                'id' => 'photberry_pf_gal_on_listing',
                'name' => esc_attr__('Items Shown on Blog Listing', 'photberry'),
                'type' => 'number',
				'std' => '8'
            ),
            array(
                'id' => 'photberry_pf_gal_real_prop',
                'name' => esc_attr__('Show Images in Real Proportions', 'photberry'),
                'type' => 'select',
				'std' => 'yes',
                'options' => array(
                    'yes' => esc_attr__('Yes', 'photberry'),
                    'no' => esc_attr__('No', 'photberry'),
                ),
				'attributes' => array(
                    'data-dependency-id' => 'photberry_pf_gal_in_row',
                    'data-dependency-val' => '1'
                ),
            ),
            array(
                'id' => 'photberry_pf_gal_img_width',
                'name' => esc_attr__('Image Width', 'photberry'),
                'type' => 'text',
                'desc' => esc_attr__('In pixels.', 'photberry'),
                'std' => '1140'
            ),
            array(
                'id' => 'photberry_pf_gal_img_height',
                'name' => esc_attr__('Image Height', 'photberry'),
                'type' => 'text',
                'desc' => esc_attr__('In pixels.', 'photberry'),
                'std' => '860'
            ),
        ),
    );

    # Video Post Format
    $meta_boxes[] = array(
        'title' => esc_attr__('Video Post Format Settings', 'photberry'),
        'post_types' => array('post', 'pm-portfolio'),
        'fields' => array(
            array(
                'id' => 'photberry_pf_video_url',
                'name' => esc_attr__('Video URL', 'photberry'),
                'type' => 'oembed',
                'desc' => esc_attr__('Copy link to the video from YouTube or other video-sharing website.', 'photberry'),
            ),
            array(
                'id' => 'photberry_pf_video_height',
                'name' => esc_attr__('Video Height', 'photberry'),
                'type' => 'text',
                'desc' => esc_attr__('In pixels.', 'photberry'),
                'std' => '500',
            ),
        ),
    );

    # Audio Post Format
    $meta_boxes[] = array(
        'title' => esc_html__('Audio Past Format Settings', 'photberry'),
        'post_types' => array('post', 'pm-portfolio'),
        'fields' => array(
            array(
                'id' => 'photberry_pf_audio_url',
                'name' => esc_attr__('Audio URL', 'photberry'),
                'type' => 'oembed',
                'desc' => esc_attr__('Copy link to the audio from SoundCloud or other audio-sharing website.', 'photberry'),
            ),
        )
    );

    # Featured Posts Settings
    $meta_boxes[] = array(
        'title' => esc_attr__('Featured Posts Settings', 'photberry'),
        'post_types' => array('post'),
        'fields' => array(
            array(
                'id' => 'featured_posts_status',
                'name' => esc_attr__('Featured Posts', 'photberry'),
                'type' => 'select',
                'options' => array(
                    'default' => esc_attr__('Default', 'photberry'),
                    'enabled' => esc_attr__('Enabled', 'photberry'),
                    'disabled' => esc_attr__('Disabled', 'photberry'),
                ),
            ),
            array(
                'id' => 'featured_posts_orderby',
                'name' => esc_attr__('Order By', 'photberry'),
                'type' => 'select',
                'options' => array(
                    'default' => esc_attr__('Default', 'photberry'),
                    'rand' => esc_attr__('Random', 'photberry'),
                    'date' => esc_attr__('Date', 'photberry'),
                ),
                'attributes' => array(
                    'data-dependency-id' => 'featured_posts_status',
                    'data-dependency-val' => 'enabled'
                ),
            ),
            array(
                'id' => 'featured_posts_numberposts',
                'name' => esc_attr__('Number of Posts', 'photberry'),
                'type' => 'select',
                'options' => array(
                    'default' => esc_attr__('Default', 'photberry'),
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                ),
                'attributes' => array(
                    'data-dependency-id' => 'featured_posts_status',
                    'data-dependency-val' => 'enabled'
                ),
            ),
            array(
                'id' => 'featured_posts_fimage_status',
                'name' => esc_attr__('Featured Image', 'photberry'),
                'type' => 'select',
                'options' => array(
                    'default' => esc_attr__('Default', 'photberry'),
                    'show' => 'Show',
                    'hide' => 'Hide',
                ),
                'attributes' => array(
                    'data-dependency-id' => 'featured_posts_status',
                    'data-dependency-val' => 'enabled'
                ),
            ),
            array(
                'id' => 'featured_posts_meta_status',
                'name' => esc_attr__('Meta', 'photberry'),
                'type' => 'select',
                'options' => array(
                    'default' => esc_attr__('Default', 'photberry'),
                    'show' => 'Show',
                    'hide' => 'Hide',
                ),
                'attributes' => array(
                    'data-dependency-id' => 'featured_posts_status',
                    'data-dependency-val' => 'enabled'
                ),
            ),
            array(
                'id' => 'featured_posts_excerpt_status',
                'name' => esc_attr__('Excerpt', 'photberry'),
                'type' => 'select',
                'options' => array(
                    'default' => esc_attr__('Default', 'photberry'),
                    'show' => 'Show',
                    'hide' => 'Hide',
                ),
                'attributes' => array(
                    'data-dependency-id' => 'featured_posts_status',
                    'data-dependency-val' => 'enabled'
                ),
            ),
        ),
    );
	
    # Featured Portfolio Settings
    $meta_boxes[] = array(
        'title' => esc_attr__('Featured Posts Settings', 'photberry'),
        'post_types' => array('pm-portfolio'),
        'fields' => array(
            array(
                'id' => 'featured_posts_status',
                'name' => esc_attr__('Featured Posts', 'photberry'),
                'type' => 'select',
                'options' => array(
                    'default' => esc_attr__('Default', 'photberry'),
                    'enabled' => esc_attr__('Enabled', 'photberry'),
                    'disabled' => esc_attr__('Disabled', 'photberry'),
                ),
            ),
            array(
                'id' => 'featured_posts_orderby',
                'name' => esc_attr__('Order By', 'photberry'),
                'type' => 'select',
                'options' => array(
                    'default' => esc_attr__('Default', 'photberry'),
                    'rand' => esc_attr__('Random', 'photberry'),
                    'date' => esc_attr__('Date', 'photberry'),
                ),
                'attributes' => array(
                    'data-dependency-id' => 'featured_posts_status',
                    'data-dependency-val' => 'enabled'
                ),
            ),
            array(
                'id' => 'featured_posts_numberposts',
                'name' => esc_attr__('Number of Posts', 'photberry'),
                'type' => 'select',
                'options' => array(
                    'default' => esc_attr__('Default', 'photberry'),
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                ),
                'attributes' => array(
                    'data-dependency-id' => 'featured_posts_status',
                    'data-dependency-val' => 'enabled'
                ),
            ),
        ),
    );

    # Post Settings
    $meta_boxes[] = array(
        'title' => esc_attr__('Post Settings', 'photberry'),
        'post_types' => 'post',
        'fields' => array(
            array(
                'id' => 'post_tags_status',
                'name' => esc_attr__('Post Tags', 'photberry'),
                'type' => 'select',
                'options' => array(
                    'default' => esc_attr__('Default', 'photberry'),
                    'show' => esc_attr__('Show', 'photberry'),
                    'hide' => esc_attr__('Hide', 'photberry'),
                ),
            ),
            array(
                'id' => 'share_buttons_status',
                'name' => esc_attr__('Share Buttons', 'photberry'),
                'type' => 'select',
                'options' => array(
                    'default' => esc_attr__('Default', 'photberry'),
                    'show' => esc_attr__('Show', 'photberry'),
                    'hide' => esc_attr__('Hide', 'photberry'),
                ),
            ),
            array(
                'id' => 'posts_featured_image',
                'name' => esc_attr__('Featured Block', 'photberry'),
                'type' => 'select',
                'options' => array(
                    'default' => esc_attr__('Default', 'photberry'),
                    'show' => esc_attr__('Show', 'photberry'),
                    'hide' => esc_attr__('Hide', 'photberry'),
                ),
            ),
        )
    );

    # Portfolio Settings
    $meta_boxes[] = array(
        'title' => esc_attr__('Portfolio Settings', 'photberry'),
        'post_types' => 'pm-portfolio',
        'fields' => array(
            array(
                'id' => 'share_buttons_status',
                'name' => esc_attr__('Share Buttons', 'photberry'),
                'type' => 'select',
                'options' => array(
                    'default' => esc_attr__('Default', 'photberry'),
                    'show' => esc_attr__('Show', 'photberry'),
                    'hide' => esc_attr__('Hide', 'photberry'),
                ),
            ),
            array(
                'id' => 'post_navigation_status',
                'name' => esc_attr__('Posts Navigation', 'photberry'),
                'type' => 'select',
                'options' => array(
                    'default' => esc_attr__('Default', 'photberry'),
                    'show' => esc_attr__('Show', 'photberry'),
                    'hide' => esc_attr__('Hide', 'photberry'),
                ),
            ),
            array(
                'id' => 'post_pf_style',
                'name' => esc_attr__('Media Block Status', 'photberry'),
                'type' => 'select',
				'std' => 'boxed',
                'options' => array(
                    'boxed' => esc_attr__('Boxed', 'photberry'),
                    'fullwidth' => esc_attr__('Fullwidth', 'photberry'),
                ),
            ),
            array(
                'id' => 'post_client_field_status',
                'name' => esc_attr__('Add Client Field?', 'photberry'),
                'type' => 'select',
				'std' => 'no',
                'options' => array(
                    'no' => esc_attr__('No', 'photberry'),
                    'yes' => esc_attr__('Yes', 'photberry'),
                ),
            ),
            array(
                'id' => 'post_client_field',
                'name' => esc_attr__('Client:', 'photberry'),
                'type' => 'text',
                'std' => '',
                'attributes' => array(
                    'data-dependency-id' => 'post_client_field_status',
                    'data-dependency-val' => 'yes'
                ),
            ),
            array(
                'id' => 'post_additional_meta',
                'name' => esc_attr__('Additional Meta:', 'photberry'),
                'type' => 'text',
                'std' => '',
            ),

        )
    );

    # Post and Portfolio Settings
    $meta_boxes[] = array(
        'title' => esc_attr__('Page Settings', 'photberry'),
        'post_types' => array('post', 'pm-portfolio'),
        'fields' => array(
            array(
                'id' => 'post_title_status',
                'name' => esc_attr__('Post Title', 'photberry'),
                'type' => 'select',
                'options' => array(
                    'default' => esc_html__('Default', 'photberry'),
                    'show' => esc_attr__('Show', 'photberry'),
                    'hide' => esc_attr__('Hide', 'photberry'),
                ),
            ),

            array(
                'id' => 'sidebar_position',
                'name' => esc_html__('Sidebar Position', 'photberry'),
                'type' => 'select',
                'options' => array(
                    'default' => esc_attr__('Default', 'photberry'),
                    'photberry_left_sidebar' => esc_attr__('Left', 'photberry'),
                    'photberry_right_sidebar' => esc_attr__('Right', 'photberry'),
                    'photberry_no_sidebar' => esc_attr__('None', 'photberry')
                )
            ),

            array(
                'id' => 'footer_status',
                'name' => esc_html__('Footer', 'photberry'),
                'type' => 'select',
                'options' => array(
                    'default' => esc_attr__('Default', 'photberry'),
                    'show' => esc_attr('Show', 'photberry'),
                    'hide' => esc_attr__('Hide', 'photberry')
                )
            )
        ),
    );
	
    # Page Settings
    $meta_boxes[] = array(
        'title' => esc_attr__('Page Settings', 'photberry'),
        'post_types' => 'page',
        'fields' => array(
            array(
                'id' => 'header_type',
                'name' => esc_attr__('Menu Type', 'photberry'),
                'type' => 'select',
                'options' => array(
                    'default' => esc_attr__('Default', 'photberry'),
                    'always_show' => esc_attr__('Always Show', 'photberry'),
                    'show_by_click' => esc_attr__('Open by Button', 'photberry'),
                ),
                'attributes' => array(
                    'data-hide-on-template-file' => 'page-coming-soon.php',
                ),
            ),

            array(
                'id' => 'page_top_padding',
                'name' => esc_attr__('Page Top Padding', 'photberry'),
                'type' => 'select',
                'options' => array(
                    'yes' => esc_attr__('Yes', 'photberry'),
                    'no' => esc_attr__('No', 'photberry'),
                ),
                'attributes' => array(
                    'data-hide-on-template-file' => 'page-coming-soon.php, page-centered.php',
                ),
            ),

            array(
                'id' => 'page_bottom_padding',
                'name' => esc_attr__('Page Bottom Padding', 'photberry'),
                'type' => 'select',
                'options' => array(
                    'yes' => esc_attr__('Yes', 'photberry'),
                    'no' => esc_attr__('No', 'photberry'),
                ),
                'attributes' => array(
                    'data-hide-on-template-file' => 'page-coming-soon.php, page-centered.php',
                ),
            ),

            array(
                'id' => 'page_title_status',
                'name' => esc_attr__('Page Title', 'photberry'),
                'type' => 'select',
                'options' => array(
                    'default' => esc_html__('Default', 'photberry'),
                    'show' => esc_attr__('Show', 'photberry'),
                    'hide' => esc_attr__('Hide', 'photberry'),
                ),
                'attributes' => array(
                    'data-hide-on-template-file' => 'page-coming-soon.php',
                ),
            ),
            array(
                'id' => 'page_title_position',
                'name' => esc_attr__('Page Title Position', 'photberry'),
                'type' => 'select',
                'options' => array(
                    'default' => esc_html__('Default', 'photberry'),
                    'left' => esc_attr__('Left', 'photberry'),
                    'center' => esc_attr__('Center', 'photberry'),
					'right' => esc_attr__('Right', 'photberry'),
                ),
                'attributes' => array(
                    'data-hide-on-template-file' => 'page-coming-soon.php',
                )
            ),

            array(
                'id' => 'sidebar_position',
                'name' => esc_html__('Sidebar Position', 'photberry'),
                'type' => 'select',
                'options' => array(
                    'default' => esc_attr__('Default', 'photberry'),
                    'photberry_left_sidebar' => esc_attr__('Left', 'photberry'),
                    'photberry_right_sidebar' => esc_attr__('Right', 'photberry'),
                    'photberry_no_sidebar' => esc_attr__('None', 'photberry')
                ),
                'attributes' => array(
                    'data-hide-on-template-file' => 'page-coming-soon.php, page-centered.php',
                )
            ),
            array(
                'id' => 'footer_status',
                'name' => esc_html__('Footer', 'photberry'),
                'type' => 'select',
                'options' => array(
                    'default' => esc_attr__('Default', 'photberry'),
                    'show' => esc_attr('Show', 'photberry'),
                    'hide' => esc_attr__('Hide', 'photberry')
                ),
                'attributes' => array(
                    'data-hide-on-template-file' => 'page-coming-soon.php, page-centered.php',
                )
            ),
            array(
                'id' => 'footer_columns',
                'name' => esc_html__('Footer Widgets Columns', 'photberry'),
                'type' => 'select',
                'options' => array(
                    'default' => esc_attr__('Default', 'photberry'),
                    '3' => esc_attr('3 Columns', 'photberry'),
                    '4' => esc_attr__('4 Columns', 'photberry')
                ),
                'attributes' => array(
                    'data-hide-on-template-file' => 'page-coming-soon.php, page-centered.php',
                )
            ),
			array(
                'id' => 'centered_bg_image',
                'name' => esc_attr__('Body Background', 'photberry'),
                'type' => 'image_advanced',
				'max_file_uploads' => '1',
                'attributes' => array(
                    'data-show-on-template-file' => 'page-centered.php',
                ),
            ),
            array(
                'id' => 'centered_bg_overlay_state',
                'name' => esc_html__('Show Background Overlay', 'photberry'),
                'type' => 'select',
                'options' => array(
					'hide' => esc_attr__('Hide', 'photberry'),
					'show' => esc_attr('Show', 'photberry')
                ),
                'attributes' => array(
                    'data-show-on-template-file' => 'page-centered.php',
                ),
            ),
            array(
                'id' => 'centered_bg_overlay',
                'name' => esc_html__('Background Overlay Color', 'photberry'),
                'type' => 'color',
				'alpha_channel' => true,
                'attributes' => array(
                    'data-dependency-id' => 'centered_bg_overlay_state',
                    'data-dependency-val' => 'show',
                    'data-show-on-template-file' => 'page-centered.php',
                ),
            ),
        )
    );
	
	# Albums Settings
    $meta_boxes[] = array(
        'title' => esc_attr__('Album Settings', 'photberry'),
        'post_types' => array('pm-albums'),
        'fields' => array(
            array(
                'id' => 'photberry_albums_images',
                'name' => esc_attr__('Select Images', 'photberry'),
                'type' => 'image_advanced',
            ),
            array(
                'id' => 'divider',
                'type' => 'divider',
            ),
            array(
                'id' => 'header_type',
                'name' => esc_attr__('Menu Type', 'photberry'),
                'type' => 'select',
                'options' => array(
                    'default' => esc_attr__('Default', 'photberry'),
                    'always_show' => esc_attr__('Always Show', 'photberry'),
                    'show_by_click' => esc_attr__('Open by Button', 'photberry'),
                ),
                'attributes' => array(
                    'data-hide-on-template-file' => 'page-coming-soon.php',
                ),
            ),
            array(
                'id' => 'gallery_type',
                'name' => esc_attr__('Gallery Type', 'photberry'),
                'type' => 'select',
				'std' => 'grid',
                'options' => array(
                    'grid' => esc_attr__('Grid', 'photberry'),
                    'packery' => esc_attr__('Packery', 'photberry'),
                    'slider' => esc_attr__('Slider', 'photberry'),
					'split' => esc_attr__('Split', 'photberry')
                ),
            ),
            array(
                'id' => 'divider',
                'type' => 'divider',
            ),

			/* Grid And Packery*/
            array(
                'id' => 'columns',
                'name' => esc_attr__('Columns', 'photberry'),
                'type' => 'select',
				'std' => '4',
                'options' => array(
					'2' => esc_attr__('Two', 'photberry'),            
					'3' => esc_attr__('Three', 'photberry'),
                    '4' => esc_attr__('Four', 'photberry'),
                    '5' => esc_attr__('Five', 'photberry')
                ),
                'attributes' => array(
                    'data-dependency-id' => 'gallery_type',
                    'data-dependency-val' => 'grid'
                ),
            ),
            array(
                'id' => 'posts_per_page',
                'name' => esc_attr__('Items on First Load', 'photberry'),
                'type' => 'number',
				'std' => '8',
                'attributes' => array(
                    'data-dependency-id' => 'gallery_type',
                    'data-dependency-val' => 'grid, packery'
                ),
            ),
            array(
                'id' => 'posts_per_click',
                'name' => esc_attr__('Items on Load More', 'photberry'),
                'type' => 'number',
				'std' => '4',
                'attributes' => array(
                    'data-dependency-id' => 'gallery_type',
                    'data-dependency-val' => 'grid, packery'
                ),
            ),
            array(
                'id' => 'items_padding',
                'name' => esc_attr__('Items Padding (in pixels)', 'photberry'),
                'type' => 'number',
				'std' => '10',
                'attributes' => array(
                    'data-dependency-id' => 'gallery_type',
                    'data-dependency-val' => 'grid, packery'
                ),
            ),
            array(
                'id' => 'masonry',
                'name' => esc_attr__('Masonry', 'photberry'),
                'type' => 'select',
                'options' => array(
					'off' => esc_attr__('Off', 'photberry'),
					'on' => esc_attr__('On', 'photberry')
                ),
                'attributes' => array(
                    'data-dependency-id' => 'gallery_type',
                    'data-dependency-val' => 'grid'
                ),
            ),
            array(
                'id' => 'button_text',
                'name' => esc_attr__('Load More Text', 'photberry'),
                'type' => 'text',
                'std' => 'Load More',
                'attributes' => array(
                    'data-dependency-id' => 'gallery_type',
                    'data-dependency-val' => 'grid, packery'
                ),
            ),
            array(
                'id' => 'button_type',
                'name' => esc_attr__('Button Type', 'photberry'),
                'type' => 'select',
                'options' => array(
					'normal' => esc_attr__('Normal', 'photberry'),
					'reverse' => esc_attr__('Reverse', 'photberry')
                ),
                'attributes' => array(
                    'data-dependency-id' => 'gallery_type',
                    'data-dependency-val' => 'grid, packery'
                ),
            ),

			/* Slider */
            array(
                'id' => 'transparent_header',
                'name' => esc_attr__('Transparent Header', 'photberry'),
                'type' => 'select',
				'std' => 'off',
                'options' => array(
					'on' => esc_attr__('On', 'photberry'),
					'off' => esc_attr__('Off', 'photberry')
                ),
                'attributes' => array(
                    'data-dependency-id' => 'gallery_type',
                    'data-dependency-val' => 'slider'
                ),
            ),
			array(
                'id' => 'fit_style',
                'name' => esc_attr__('Fit Style', 'photberry'),
                'type' => 'select',
				'std' => 'cover',
                'options' => array(
					'cover' => esc_attr__('Cover Slide', 'photberry'),
					'fit_always' => esc_attr__('Fit Always', 'photberry'),
					'fit_width' => esc_attr__('Fit Width', 'photberry'),
					'fit_height' => esc_attr__('Fit Height', 'photberry')
                ),
                'attributes' => array(
                    'data-dependency-id' => 'gallery_type',
                    'data-dependency-val' => 'slider'
                ),
            ),
            array(
                'id' => 'thumbs_state',
                'name' => esc_attr__('Thumbs State', 'photberry'),
                'type' => 'select',
				'std' => 'off',
                'options' => array(
					'on' => esc_attr__('On', 'photberry'),
					'off' => esc_attr__('Off', 'photberry'),
                ),
                'attributes' => array(
                    'data-dependency-id' => 'gallery_type',
                    'data-dependency-val' => 'slider'
                ),
            ),
            array(
                'id' => 'infinity_scroll',
                'name' => esc_attr__('Infinity Scroll', 'photberry'),
                'type' => 'select',
				'std' => 'on',
                'options' => array(
					'on' => esc_attr__('On', 'photberry'),
					'off' => esc_attr__('Off', 'photberry'),
					
                ),
                'attributes' => array(
                    'data-dependency-id' => 'gallery_type',
                    'data-dependency-val' => 'split'
                ),
            ),
            array(
                'id' => 'titles_state',
                'name' => esc_attr__('Title State', 'photberry'),
                'type' => 'select',
				'std' => 'always_show',
                'options' => array(
					'always_show' => esc_attr__('Always Show', 'photberry'),
					'always_hide' => esc_attr__('Always Hide', 'photberry'),
					'show_on_hover' => esc_attr__('Show on Hover', 'photberry'),
                ),
                'attributes' => array(
                    'data-dependency-id' => 'gallery_type',
                    'data-dependency-val' => 'split'
                ),
            ),
            array(
                'id' => 'titles_state_slider',
                'name' => esc_attr__('Title State', 'photberry'),
                'type' => 'select',
				'std' => 'on',
                'options' => array(
					'on' => esc_attr__('On', 'photberry'),
					'off' => esc_attr__('Off', 'photberry')
                ),
                'attributes' => array(
                    'data-dependency-id' => 'gallery_type',
                    'data-dependency-val' => 'slider'
                ),
            ),
            array(
                'id' => 'titles_color',
                'name' => esc_html__('Titles Color', 'photberry'),
                'type' => 'color',
				'alpha_channel' => false,
                'attributes' => array(
                    'data-dependency-id' => 'gallery_type',
                    'data-dependency-val' => 'split, slider'
                ),
            ),
            array(
                'id' => 'overlay_state',
                'name' => esc_attr__('Overlay State', 'photberry'),
                'type' => 'select',
				'std' => 'on',
                'options' => array(
					'on' => esc_attr__('On', 'photberry'),
					'off' => esc_attr__('Off', 'photberry'),
					'custom' => esc_attr__('Custom', 'photberry'),
                ),
                'attributes' => array(
                    'data-dependency-id' => 'gallery_type',
                    'data-dependency-val' => 'slider, split'
                ),
            ),
            array(
                'id' => 'overlay_color',
                'name' => esc_html__('Custom Overlay Color', 'photberry'),
                'type' => 'color',
				'alpha_channel' => true,
                'attributes' => array(
                    'data-dependency-id' => 'gallery_type',
                    'data-dependency-val' => 'split, slider'
                ),
            ),
            array(
                'id' => 'controls_state',
                'name' => esc_attr__('Controls State', 'photberry'),
                'type' => 'select',
				'std' => 'on',
                'options' => array(
					'on' => esc_attr__('On', 'photberry'),
					'off' => esc_attr__('Off', 'photberry')
                ),
                'attributes' => array(
                    'data-dependency-id' => 'gallery_type',
                    'data-dependency-val' => 'slider, split'
                ),
            ),
            array(
                'id' => 'autoplay',
                'name' => esc_attr__('Autoplay', 'photberry'),
                'type' => 'select',
				'std' => 'off',
                'options' => array(
					'on' => esc_attr__('On', 'photberry'),
					'off' => esc_attr__('Off', 'photberry')
                ),
                'attributes' => array(
                    'data-dependency-id' => 'gallery_type',
                    'data-dependency-val' => 'slider'
                ),
            ),
            array(
                'id' => 'autoplay_speed',
                'name' => esc_attr__('Autoplay Speed', 'photberry'),
                'type' => 'number',
				'std' => '4000',
				'step' => '100',
                'attributes' => array(
                    'data-dependency-id' => 'gallery_type',
                    'data-dependency-val' => 'slider'
                ),
            ),

        ),
    );

	
	# Comming Soon Template
    $meta_boxes[] = array(
        'title' => esc_attr__('Comming Soon Settings', 'photberry'),
        'post_types' => 'page',
        'fields' => array(
            array(
                'id' => 'photberry_countdown_date_d',
                'name' => esc_attr__('Day', 'photberry'),
                'type' => 'select',
                'options' => array(
						'01' => '01',
						'02' => '02',
						'03' => '03',
						'04' => '04',
						'05' => '05',
						'06' => '06',
						'07' => '07',
						'08' => '08',
						'09' => '09',
						'10' => '10',
						'11' => '11',
						'12' => '12',
						'13' => '13',
						'14' => '14',
						'15' => '15',
						'16' => '16',
						'17' => '17',
						'18' => '18',
						'19' => '19',
						'20' => '20',
						'21' => '21',
						'22' => '22',
						'23' => '23',
						'24' => '24',
						'25' => '25',
						'26' => '26',
						'27' => '27',
						'28' => '28',
						'29' => '29',
						'30' => '30',
						'31' => '31',
                ),
                'attributes' => array(
                    'data-show-on-template-file' => 'page-coming-soon.php',
                ),
            ),

			array(
                'id' => 'photberry_countdown_date_m',
                'name' => esc_attr__('Month', 'photberry'),
                'type' => 'select',
                'options' => array(
						'01' => '01',
						'02' => '02',
						'03' => '03',
						'04' => '04',
						'05' => '05',
						'06' => '06',
						'07' => '07',
						'08' => '08',
						'09' => '09',
						'10' => '10',
						'11' => '11',
						'12' => '12',
                ),
                'attributes' => array(
                    'data-show-on-template-file' => 'page-coming-soon.php',
                ),
            ),
            array(
                'id' => 'photberry_countdown_date_y',
                'name' => esc_attr__('Year', 'photberry'),
                'type' => 'text',
                'std' => '2018',
                'attributes' => array(
                    'data-show-on-template-file' => 'page-coming-soon.php',
                ),
            ),			
            array(
                'id' => 'photberry_countdown_shortcode',
                'name' => esc_attr__('Form Shortcode', 'photberry'),
                'type' => 'text',
                'std' => '',
                'attributes' => array(
                    'data-show-on-template-file' => 'page-coming-soon.php',
                ),
            ),			
        )
    );
	
    return $meta_boxes;
}