<?php
/*
 * Created by Pixel-Mafia
 * www.pixel-mafia.com
*/

if (!post_password_required()) {
	the_post();
	get_header();

	$albums_pt_tax = esc_attr(photberry_get_theme_mod('albums_pt_tax'));
	$terms = get_the_terms(get_the_ID(), $albums_pt_tax);
	$categories = '';
	$categories_w_link = '';
	$categories_class = '';
	if (is_array($terms)) {
		foreach ($terms as $term) {
			$category_name = strtr($term->name, array(
				" " => "-",
				"'" => "-",
			));
		}
	}
	$images = photberry_get_post_option('photberry_albums_images');
	
	if (photberry_get_post_option('gallery_type') == 'grid') {
		
		// GRID GALLERY
		
		$posts_per_page = photberry_get_post_option('posts_per_page');
		$posts_per_click = photberry_get_post_option('posts_per_click');
		$columns = photberry_get_post_option('columns');
		$items_padding = photberry_get_post_option('items_padding');
		$masonry = photberry_get_post_option('masonry');
		$button_text = photberry_get_post_option('button_text');
		$button_type = photberry_get_post_option('button_type');


		wp_enqueue_script('photberry_gallery_grid', get_template_directory_uri() . '/js/pm_gallery_grid.js', true, false, true);
		wp_enqueue_script('isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array('jquery'), false, true);
		wp_enqueue_script('imagesloaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array('isotope'), false, true);

		$img_width = 960;
		$img_height = 960;
		$uniqid = mt_rand(0, 9999);
		$grid_array = array();
		$img_array = array();
		$imgCounter = 0;
		$masonry_class = '';
		$button_class = '';
		
		if ($masonry == 'on') {
			$img_height = '';
			$masonry_class = 'is_masonry';
		}
		if ($button_type == 'reverse') {
			$button_class = 'photberry_reverse_button';
		}
		if (empty($images)) {
			return;
		}
		?>
		<div class="photberry_single_gallery_wrapper photberry_single_gallery_grid">
		<?php
			echo '
			<div class="photberry_grid_wrapper photberry_grid_'. esc_attr($uniqid) .'" data-uniqid="'. esc_attr($uniqid) .'" data-perload="'. esc_attr($posts_per_click) .'">
				<div class="photberry_grid_inner photberry_isotope_trigger '. esc_attr($masonry_class).' grid_columns'. esc_attr($columns).'" data-pad="'. esc_attr($items_padding) .'" data-perload="'. esc_attr($posts_per_click) .'">
			';

			foreach ( $images as $index => $image ) {
				$photoCaption = '';
				$attach_meta = photberry_get_attachment($image['ID']);
				$photoTitle = $attach_meta['caption'];
				$photoCaption = $attach_meta['description'];
				$photoAlt = $attach_meta['alt'];
				$PCREpattern = '/\r\n|\r|\n/u';
				$photoCaption = preg_replace($PCREpattern, '', nl2br($photoCaption));

				$featured_image = wp_get_attachment_url($image['ID']);
				if (strlen($featured_image[0]) > 0) {
					$featured_image_url = aq_resize(esc_url($featured_image), esc_attr($img_width), esc_attr($img_height), true, true, true);
				} else {
					$featured_image_url = '';
				}

				$featured_image = wp_get_attachment_image_src($image['ID'], 'original');
				
				
				$img_array['attach_id'] = esc_attr($image['ID']);
				$img_array['slide_type'] = 'image';
				$img_array['title'] = esc_attr($photoTitle);
				$img_array['alt'] = esc_attr($photoAlt);
				$img_array['thmb'] = esc_url($featured_image_url);
				$img_array['url'] = esc_url($featured_image[0]);
				$img_array['count'] = esc_attr($imgCounter);
				
				$imgCounter++;
				
				array_push($grid_array, $img_array);
			}

			if ($posts_per_page > count($grid_array)) {
				$posts_per_page = count($grid_array);
			}

			$i = 0;
			//photberry_pre($grid_array);
			while ($i < $posts_per_page) {
				if ($grid_array[$i]['slide_type'] == 'image') {
					$thishref = wp_get_attachment_url($grid_array[$i]['attach_id']);
					$thisvideoclass = '';
				} else if ($grid_array[$i]['slide_type'] == 'video') {
					$thishref = $grid_array[$i]['src'];
					$thisvideoclass = 'video_zoom';
				}
				$photoTitle = '';
				$photoTitle = $grid_array[$i]['title'];
				if (isset($photoTitle) && $photoTitle !== '') {
					$photoTitle = str_replace('"', "'", $photoTitle);
				}
				$photoAlt = $grid_array[$i]['alt'];
				$imgCounter = $grid_array[$i]['count'];
				$featured_image = $grid_array[$i]['url'];
				$img_thmb = $grid_array[$i]['thmb'];
				echo '
				<div class="grid-item element anim_el anim_el2 load_anim_grid grid_b2p">
					<div class="grid-item-inner">
						<a rel="grid_gallery_post" href="'. esc_url($featured_image) .'" class="swipebox">
							<img src="'. esc_url($img_thmb) .'" alt="'. esc_attr($photoAlt) .'" class="grid_thmb"/>
							<div class="grid-item-content">
								<h4>'. esc_attr($photoTitle) .'</h4>
							</div>
						</a>
						<div class="photberry-img-preloader"></div>
					</div>
				</div>';
				unset($grid_array[$i]);
				$i++;
			} //EoWhile First Load	
				echo '
			</div>';
		if (isset($grid_array) && count($grid_array) > 0) {
            echo '<div class="photberry_grid_gallery_array" data-id = "'. esc_attr($uniqid) .'">';
                $i = 0;
                foreach ($grid_array as $image) {
                    echo '<div class="photberry_grid_array_item" 
                            data-id = "'. esc_attr($uniqid) .'" 
                            data-type = "' . esc_attr($image['slide_type']) . '" 
                            data-img = "' . esc_url($image['url']) . '" 
                            data-thmb = "' . esc_url($image['thmb']) . '" 
                            data-title = "' . esc_attr($image['title']) . '" 
                            data-alt = "' . esc_attr($image['alt']) . '" 
                            data-counter = "' . esc_attr($image['count']) . '"></div>';
                }
            echo '</div>';

			echo '<div class="photberry_load_more_button_wrapper grid_loadmore_wrapper"><a class="photberry_load_more_button grid_load_more photberry_button '. esc_attr($button_class) .'" href="'. esc_js("javascript:void(0)") .'">' . esc_attr($button_text) . '</a></div>';
		}

			echo '
			</div>';
		?>
		</div>
		<?php
	}

	if (photberry_get_post_option('gallery_type') == 'packery') {
		
		// PACKERY GALLERY
		
		$posts_per_page = photberry_get_post_option('posts_per_page');
		$posts_per_click = photberry_get_post_option('posts_per_click');
		$items_padding = photberry_get_post_option('items_padding');
		$button_text = photberry_get_post_option('button_text');
		$button_type = photberry_get_post_option('button_type');

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

        <div class="photberry_single_gallery_wrapper photberry_single_gallery_grid">
		<?php			
			if (empty($images)) {
				return;
			}
			echo '
			<div class="photberry_packery_wrapper photberry_packery_'. esc_attr($uniqid) .'" data-uniqid="'. esc_attr($uniqid) .'" data-perload="'. esc_attr($posts_per_click) .'">
				<div class="photberry_packery_inner photberry_isotope_trigger is_packery" data-pad="'. esc_attr($items_padding) .'" data-perload="'. esc_attr($posts_per_click) .'">
			';

			foreach ( $images as $index => $image ) {
				$photoCaption = '';
				$attach_meta = photberry_get_attachment($image['ID']);
				$photoTitle = $attach_meta['caption'];
				$photoCaption = $attach_meta['description'];
				$photoAlt = $attach_meta['alt'];
				$PCREpattern = '/\r\n|\r|\n/u';
				$photoCaption = preg_replace($PCREpattern, '', nl2br($photoCaption));

				$featured_image = wp_get_attachment_url($image['ID']);
				if (strlen($featured_image[0]) > 0) {
					$featured_image_url = aq_resize(esc_url($featured_image), esc_attr($img_width), esc_attr($img_height), true, true, true);
				} else {
					$featured_image_url = '';
				}

				$featured_image = wp_get_attachment_image_src($image['ID'], 'original');
				
				
				$img_array['attach_id'] = esc_attr($image['ID']);
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
						<a rel="packery_gallery_post" class="swipebox" href="'. esc_url($featured_image) .'">
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
	
	if (photberry_get_post_option('gallery_type') == 'slider') {
		// SLIDER GALLERY
		$transparent_header = photberry_get_post_option('transparent_header');

		$fit_style = photberry_get_post_option('fit_style');
		$thumbs_state = photberry_get_post_option('thumbs_state');
		$titles_state = photberry_get_post_option('titles_state_slider');
		$titles_color = photberry_get_post_option('titles_color');
		$overlay_state = photberry_get_post_option('overlay_state');
		$overlay_color = photberry_get_post_option('overlay_color');
		$controls_state = photberry_get_post_option('controls_state');
		$autoplay = photberry_get_post_option('autoplay');
		$autoplay_speed = photberry_get_post_option('autoplay_speed');
		
		wp_enqueue_script('photberry_gallery_slider', get_template_directory_uri() . '/js/pm_image_slider.js', true, false, true);
		
		$thumbs_class = '';
		if ($thumbs_state == 'on') {
			$thumbs_class = 'has_thumbs';
		}
		$uniqid = mt_rand(0, 9999);
		$thmbs_html = '';
		?>
		<div class="photberry_single_gallery_wrapper photberry_single_gallery_slider">
			<?php
			// Element Content
			if (empty($images)) {
				return;
			}

			echo '<div class="photberry_slider_wrapper photberry_module_loading auto_height photberry_single_gallery_slider photberry_slider_'. esc_attr($uniqid) .' '. esc_attr($thumbs_class) .'" data-id="'. esc_attr($uniqid) .'"
			data-autoplay = "'. esc_attr($autoplay) .'" 
			data-interval = "'. esc_attr($autoplay_speed) .'" 
			data-thumbs = "'. esc_attr($thumbs_state) .'"
			>';
			?>
				<div class="photberry_slider <?php echo esc_attr($fit_style); ?> transparent_header_<?php echo esc_attr($transparent_header);?>"
					data-autoplay = "<?php echo esc_attr($autoplay); ?>" 
					data-interval = "<?php echo esc_attr($autoplay_speed); ?>">
					<?php
					$count = 0;
					foreach ( $images as $index => $image ) {
						$count++;
						$photoCaption = '';
						$attach_meta = photberry_get_attachment($image['ID']);
						$photoTitle = $attach_meta['caption'];
						$photoCaption = $attach_meta['description'];
						$photoAlt = $attach_meta['alt'];
						$PCREpattern = '/\r\n|\r|\n/u';
						$photoCaption = preg_replace($PCREpattern, '', nl2br($photoCaption));

						$featured_image = wp_get_attachment_url($image['ID']);
						if (strlen($featured_image[0]) > 0) {
							$thumb_url = aq_resize(esc_url($featured_image), '290', '216', true, true, true);
						} else {
							$thumb_url = '';
						}
						$slide_image = wp_get_attachment_image_src($image['ID'], 'original');
						$thmbs_html .= '
							<div class="photberry_slider_thumb photberry_slider_thumb'. esc_attr($count) .'" data-count="'. esc_attr($count) .'">
								<img src="'. esc_url($thumb_url) .'" alt="'. esc_attr($photoAlt) .'"/>
							</div>
						';
						?>
						<div class="photberry_slider_slide photberry_slide2preload photberry_slider_slide<?php echo esc_attr($count); ?> photberry_js_bg_image" data-src="<?php echo esc_url($slide_image[0]); ?>" data-count="<?php echo esc_attr($count); ?>">
							<?php
							if ($titles_state == 'on') {
								echo '<h2 class="photberry_slide_title photberry_js_color" data-color="'. esc_attr($titles_color) .'">'. esc_html($photoTitle) .'</h2>';
							}
							if ($overlay_state == 'on') {
								echo '<span class="photberry_slider_overlay"></span>';
							}
							if ($overlay_state == 'custom') {
								echo '<span class="photberry_slider_custom_overlay photberry_js_bg_color" data-bgcolor="'. esc_attr($overlay_color) .'"></span>';
							}
							?>
						</div>
						<?php
					}
					?>
				</div>
				<?php 
				if ($thumbs_state == 'on') {
					if ($count < 10) {
						$counter_text = '0' . $count;
					} else {
						$counter_text = $count;
					}
					echo '
						<div class="photberry_slider_thumbs">
							<div class="photberry_slider_thumbs_inner">
								'. $thmbs_html .'
							</div>
						</div>
						<div class="photberry_slide_counter">
							<span class="photberry_slide_counter_current">01</span>
							<span class="photberry_slide_counter_sep">/</span>
							<span class="photberry_slide_counter_all">'. esc_attr($counter_text) .'</span>
						</div>
					';
				}
				if ($controls_state == 'on') {
					echo '
						<a href="'. esc_js("javascript:void(0)") .'" class="photberry_slider_btn_prev"></a>
						<a href="'. esc_js("javascript:void(0)") .'" class="photberry_slider_btn_next"></a>
					';
				}
				?>
				<div class="photberry_gallery_preloader"></div>
			</div>
		</div>
		<?php
	}

	if (photberry_get_post_option('gallery_type') == 'split') {
		// SPLIT GALLERY

		$infinity_scroll = photberry_get_post_option('infinity_scroll');
		$titles_state = photberry_get_post_option('titles_state');
		$titles_color = photberry_get_post_option('titles_color');
		$overlay_state = photberry_get_post_option('overlay_state');
		$overlay_color = photberry_get_post_option('overlay_color');
		$controls_state = photberry_get_post_option('controls_state');
		
		wp_enqueue_script('photberry_gallery_split', get_template_directory_uri() . '/js/pm_split.js', true, false, true);
		$uniqid = mt_rand(0, 9999);
		?>
		<div class="photberry_single_gallery_wrapper">
			<?php
			$infinity_class = '';
			if ($infinity_scroll == 'on') {
				$infinity_class = 'infinity_scroll';
			}
			// Element Content
			if (empty($images)) {
				return;
			}
			
			$title_state_class = 'titles_' . $titles_state;
			
			echo '<div class="photberry_split_wrapper photberry_single_gallery_split photberry_split_wrapper'. $uniqid .' photberry_module_loading auto_height '. esc_attr($infinity_class) .'" data-id="'. $uniqid .'">';
			?>
				<div class="photberry_split <?php echo esc_attr($title_state_class); ?>">
					<?php
					$count = 0;
					$photberry_base_count = 1;
					$photberry_right_count = 1;
					$photberry_left_count = 1;
					foreach ( $images as $index => $image ) {
						$count++;
						if(($photberry_base_count % 2) == 0){
							$photberry_slide_class = 'photberry_right_slide'.$photberry_right_count;
							$photberry_slide_style = 'photberry_right_slide';
							$photberry_data_count = $photberry_right_count;
							$photberry_right_count++;
						} else {
							$photberry_slide_class = 'photberry_left_slide'.$photberry_left_count;
							$photberry_slide_style = 'photberry_left_slide';
							$photberry_data_count = $photberry_left_count;
							$photberry_left_count++;
						}
						$photberry_base_count++;
						
						$photoCaption = '';
						$attach_meta = photberry_get_attachment($image['ID']);
						$photoTitle = $attach_meta['caption'];
						$photoCaption = $attach_meta['description'];
						$photoAlt = $attach_meta['alt'];
						$PCREpattern = '/\r\n|\r|\n/u';
						$photoCaption = preg_replace($PCREpattern, '', nl2br($photoCaption));

						$slide_image = wp_get_attachment_image_src($image['ID'], 'original');
						if ($count == 1) {
							$current_class = 'current-slide';
						} else {
							$current_class = '';
						}
						?>
						<div class="photberry_split2preload photberry_split_slide <?php echo esc_attr($photberry_slide_class) . ' ' . esc_attr($photberry_slide_style); ?> photberry_js_bg_image <?php echo esc_attr($current_class); ?>" data-src="<?php echo esc_url($slide_image[0]); ?>" data-count="<?php echo esc_attr($photberry_data_count); ?>">
							<?php
							if ($titles_state !== 'always_hide') {
								echo '<h2 class="photberry_split_title photberry_js_color" data-color="'. esc_attr($titles_color) .'">'. esc_html($photoTitle) .'</h2>';
							}
							if ($overlay_state == 'on') {
								echo '<div class="photberry_split_overlay"></div>';
							}
							if ($overlay_state == 'custom') {
								echo '<div class="photberry_split_custom_overlay photberry_js_bg_color" data-bgcolor="'. esc_attr($overlay_color) .'"></div>';
							}
							?>
						</div>
						<?php
					}
					?>
				</div>
				<?php 
				if ($controls_state == 'on') {
					echo '
						<a href="'. esc_js("javascript:void(0)") .'" class="photberry_split_btn_prev"></a>
						<a href="'. esc_js("javascript:void(0)") .'" class="photberry_split_btn_next"></a>
					';
				}
				?>
				<div class="photberry_gallery_preloader"></div>
			</div>
		</div>
        <?php

	}
	get_footer('empty');
} else {
	get_header();
	photberryHelper::getInstance()->addJSToFooter('protected_page', '
		jQuery("html").addClass("photberry_transparent_header photberry_height_100");
	');
    ?>
	<div class="photberry_pp_bg photberry_js_bg_image" data-src="<?php echo esc_url(photberry_get_theme_mod('pp_bg_image')); ?>"></div>
    <div class="photberry_pp_content_wrapper">
		<h1 class="photberry_pp_title"><?php echo esc_html__('Password Protected', 'photberry'); ?></h1>
        <div class="photberry_password_form container">
            <?php the_content(); ?>
        </div>
    </div>

    <?php
    get_footer('empty');
}