<?php
/*
 * Created by Pixel-Mafia
 * www.pixel-mafia.com
*/

add_action('wp_ajax_photberry_ajax_query_posts', 'photberry_ajax_query_posts');
add_action('wp_ajax_nopriv_photberry_ajax_query_posts', 'photberry_ajax_query_posts');
function photberry_ajax_query_posts()
{
    $args = photberry_objectToArray(json_decode(stripslashes(sanitize_text_field($_POST['photberry_ajax_query_posts']))));

    $all_posts = wp_count_posts($args['post_type'])->publish;

	if ($args['post_type'] == 'post' && $args['cat'] !== '') {
		$the_query = new WP_Query($args);
		$all_posts = $the_query->found_posts;
		wp_reset_query();
	}
    $posts_counter = $args['posts_counter'];
	$photberry_portfolio_slug = esc_attr(photberry_get_theme_mod('portfolio_pt_slug'));
	$photberry_albums_slug = esc_attr(photberry_get_theme_mod('albums_pt_slug'));
	$photberry_portfolio_tax = esc_attr(photberry_get_theme_mod('portfolio_pt_tax'));
	$photberry_albums_tax = esc_attr(photberry_get_theme_mod('albums_pt_tax'));

	$port_tax = $photberry_portfolio_tax;
	$album_tax = $photberry_albums_tax;

	if ($args['post_type'] == 'pm-portfolio') {
		if ($args['cat_string'] > 0) {
			$post_type_terms = explode(",", $args['cat_string']);
			$tax_query = array(
				array(
					'taxonomy' => $photberry_portfolio_tax,
					'field' => 'id',
					'terms' => $post_type_terms
				)
			);
			$args['tax_query'] = $tax_query;

			$count_post_terms = array(
				'post_type' => $args['post_type'],
				'post_status' => 'publish',
				'tax_query' => $tax_query
			);

			$the_query = new WP_Query($count_post_terms);
			$all_posts = $the_query->found_posts;
			wp_reset_query();
		}
	}

	if ($args['post_type'] == 'pm-albums') {
		if ($args['cat_string'] > 0) {
			$post_type_terms = explode(",", $args['cat_string']);
			$tax_query = array(
				array(
					'taxonomy' => $album_tax,
					'field' => 'id',
					'terms' => $post_type_terms
				)
			);
			$args['tax_query'] = $tax_query;

			$count_post_terms = array(
				'post_type' => $args['post_type'],
				'post_status' => 'publish',
				'tax_query' => $tax_query
			);

			$the_query = new WP_Query($count_post_terms);
			$all_posts = $the_query->found_posts;
			wp_reset_query();
		}
	}

    if ($args['row_counter'] > 0) {
        if ($args['row_counter'] % 2 !== 0) {
            $photberry_i = 1;
        } else {
            $photberry_i = 5;
        }
    }

    query_posts($args);

    if (have_posts()) {
        while (have_posts()) {
            the_post();

            # Template 1
            if ($args['output_template'] == 'template1') {
                the_title();
                echo "<br>";
            }

            # Blog Grid
            if ($args['output_template'] == 'grid_blog_list') {
				$featured_image = photberry_get_featured_image_url();
				if ($args['images_shape'] == 'square') {
					if ($columns == 5) {
						$width = 450;
						$height = 450;
					} elseif ($columns == 4) {
						$width = 570;
						$height = 570;
					} elseif ($columns == 3) {
						$width = 570;
						$height = 570;
					} else {
						$width = 1110;
						$height = 1110;
					}
				} else {
					if ($columns == 5) {
						$width = 450;
						$height = 340;
					} elseif ($columns == 4) {
						$width = 570;
						$height = 430;
					} elseif ($columns == 3) {
						$width = 570;
						$height = 430;
					} else {
						$width = 1110;
						$height = 810;
					}
				}

                $html = '
                    <div class="photberry_grid_blog_item photberry_load">';
						if (!empty($featured_image)) {
				$html .= '
						<a href="'. esc_url(get_permalink()) .'" class="photberry_grid_blog_image">
                        	<img src="' . aq_resize(esc_url($featured_image), $width, $height, true, true, true) . '" alt="'. get_the_title() .'">
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

			# Portfolio Packery
            if ($args['output_template'] == 'portfolio_packery') {

				$width = 960;
				$height = 960;

				$photberry_featured_image = aq_resize(esc_url(photberry_get_featured_image_url()), $width, $height, true, true, true);

                $terms = get_the_terms(get_the_ID(), $port_tax);
                $categories = array();
                $categories_class = '';
                if (is_array($terms)) {
                    foreach ($terms as $term) {
                        $category_name = strtr($term->name, array(
                            " " => "-",
                            "'" => "-",
                        ));

						array_push($categories, esc_html($term->name));
                        $categories_class .= strtolower($category_name) . ' ';
                    }
                }

				$html = '
					<div class="photberry_portfolio_packery_item packery-item element wait4index anim_el anim_el2 load_anim ' . esc_attr($categories_class) . '">
						<div class="photberry_inner_cont packery-item-inner photberry_js_bg_image" data-src="'. esc_url($photberry_featured_image) .'">
							<a href="' . esc_url(get_permalink()) . '">
								<div class="photberry_portfolio_grid_content">
									<h6 class="photberry_portfolio_category">
										' . (is_array($categories) ? join(', ', $categories) : '') . '
									</h6>
									<h4 class="photberry_portfolio_title">
										' . get_the_title() . '
									</h4>
								</div>
							</a>
						</div>
					</div>
				';
                echo photberry_output($html);
            }

			# Albums Packery
            if ($args['output_template'] == 'albums_packery') {

				$width = 960;
				$height = 960;

				$photberry_featured_image = aq_resize(esc_url(photberry_get_featured_image_url()), $width, $height, true, true, true);

                $terms = get_the_terms(get_the_ID(), $album_tax);
                $categories = array();
                $categories_class = '';
                if (is_array($terms)) {
                    foreach ($terms as $term) {
                        $category_name = strtr($term->name, array(
                            " " => "-",
                            "'" => "-",
                        ));

						array_push($categories, esc_html($term->name));
                        $categories_class .= strtolower($category_name) . ' ';
                    }
                }

				$html = '
					<div class="photberry_albums_packery_item packery-item element wait4index anim_el anim_el2 load_anim ' . esc_attr($categories_class) . '">
						<div class="photberry_inner_cont packery-item-inner photberry_js_bg_image" data-src="'. esc_url($photberry_featured_image) .'">
							<a href="' . esc_url(get_permalink()) . '">
								<div class="photberry_albums_grid_content">
									<h6 class="photberry_albums_category">
										' . (is_array($categories) ? join(', ', $categories) : '') . '
									</h6>
									<h4 class="photberry_albums_title">
										' . get_the_title() . '
									</h4>
								</div>
							</a>
						</div>
					</div>
				';
                echo photberry_output($html);
            }

            # Albums Grid
            if ($args['output_template'] == 'albums_grid') {
                $columns = $args['columns'];

				if ($args['images_shape'] == 'square') {
					if ($columns == 5) {
						$width = 450;
						$height = 450;
					} elseif ($columns == 4) {
						$width = 570;
						$height = 570;
					} elseif ($columns == 3) {
						$width = 570;
						$height = 570;
					} else {
						$width = 800;
						$height = 800;
					}
				} else {
					if ($columns == 5) {
						$width = 450;
						$height = 340;
					} elseif ($columns == 4) {
						$width = 570;
						$height = 430;
					} elseif ($columns == 3) {
						$width = 570;
						$height = 430;
					} else {
						$width = 800;
						$height = 604;
					}
				}
				if ($args['masonry'] == 'off') {
					$photberry_featured_image = aq_resize(esc_url(photberry_get_featured_image_url()), $width, $height, true, true, true);
				} else {
					$photberry_featured_image = aq_resize(esc_url(photberry_get_featured_image_url()), $width, '', true, true, true);
				}

                $terms = get_the_terms(get_the_ID(), $album_tax);
                $categories = array();
				$categories_w_link = array();
                $categories_class = '';
                if (is_array($terms)) {
                    foreach ($terms as $term) {
                        $category_name = strtr($term->name, array(
                            " " => "-",
                            "'" => "-",
                        ));
						$term_link = get_term_link($term->slug, $album_tax);

						array_push($categories, esc_html($term->name));
                        $categories_class .= strtolower($category_name) . ' ';
                    }
                }

				$html = '
					<div class="photberry_albums_grid_item ' . esc_attr($categories_class) . ' columns_' . esc_attr($columns) . '">
						<div class="photberry_inner_cont photberry_load">
							<a href="' . esc_url(get_permalink()) . '">
								<img src="' . $photberry_featured_image . '" alt="'. get_the_title() .'" />
								<div class="photberry_albums_grid_content">
									<h6 class="photberry_albums_category">
										' . (is_array($categories) ? join(', ', $categories) : '') . '
									</h6>
									<h4 class="photberry_albums_title">
										' . get_the_title() . '
									</h4>
								</div>
							</a>
						</div>
					</div>
				';

                echo photberry_output($html);
            }

            # Portfolio Grid
            if ($args['output_template'] == 'portfolio_grid' || $args['output_template'] == 'portfolio_grid_title') {
                $columns = $args['columns'];

				if ($args['images_shape'] == 'square') {
					if ($columns == 5) {
						$width = 450;
						$height = 450;
					} elseif ($columns == 4) {
						$width = 570;
						$height = 570;
					} elseif ($columns == 3) {
						$width = 570;
						$height = 570;
					} else {
						$width = 800;
						$height = 800;
					}
				} else {
					if ($columns == 5) {
						$width = 450;
						$height = 340;
					} elseif ($columns == 4) {
						$width = 570;
						$height = 430;
					} elseif ($columns == 3) {
						$width = 570;
						$height = 430;
					} else {
						$width = 800;
						$height = 604;
					}
				}

				if ($args['masonry'] == 'off') {
					$photberry_featured_image = aq_resize(esc_url(photberry_get_featured_image_url()), $width, $height, true, true, true);
				} else {
					$photberry_featured_image = aq_resize(esc_url(photberry_get_featured_image_url()), $width, '', true, true, true);
				}

                $terms = get_the_terms(get_the_ID(), $port_tax);
                $categories = array();
                $categories_class = '';
                if (is_array($terms)) {
                    foreach ($terms as $term) {
                        $category_name = strtr($term->name, array(
                            " " => "-",
                            "'" => "-",
                        ));

						array_push($categories, esc_html($term->name));
                        $categories_class .= strtolower($category_name) . ' ';
                    }
                }


				if ($args['output_template'] == 'portfolio_grid') {
					$html = '
						<div class="photberry_portfolio_grid_item ' . esc_attr($categories_class) . ' columns_' . esc_attr($columns) . '">
							<div class="photberry_inner_cont photberry_load">
								<a href="' . esc_url(get_permalink()) . '">
									<img src="' . $photberry_featured_image . '" alt="'. get_the_title() .'" />
									<div class="photberry_portfolio_grid_content">
										<h6 class="photberry_portfolio_category">
											' . (is_array($categories) ? join(', ', $categories) : '') . '
										</h6>
										<h4 class="photberry_portfolio_title">
											' . get_the_title() . '
										</h4>
									</div>
								</a>
							</div>
						</div>
					';
				}
				if ($args['output_template'] == 'portfolio_grid_title') {
					$html = '
						<div class="photberry_portfolio_grid_item ' . esc_attr($categories_class) . ' columns_' . esc_attr($columns) . '">
							<div class="photberry_inner_cont photberry_load">
								<div class="photberry_image_cont">
									<a href="' . esc_url(get_permalink()) . '">
										<img src="' . $photberry_featured_image . '" alt="'. get_the_title() .'" />
									</a>
								</div>

								<div class="photberry_portfolio_cont">
									<h6 class="photberry_portfolio_category">
										' . (is_array($categories_w_link) ? join(', ', $categories_w_link) : '') . '
									</h6>

									<h3 class="photberry_portfolio_title">
										<a href="' . esc_url(get_permalink()) . '">
											' . get_the_title() . '
										</a>
									</h3>
								</div>
							</div>
						</div>
					';
				}
                echo photberry_output($html);
            }

            # Portfolio Column
            if ($args['output_template'] == 'portfolio_column') {
                $photberry_featured_image = aq_resize(esc_url(photberry_get_featured_image_url()), 960, null, true, true, true);

                $terms = get_the_terms(get_the_ID(), $port_tax);
                $categories = array();
                if (is_array($terms)) {
                    foreach ($terms as $term) {
						array_push($categories, '<a href="' . esc_url(get_term_link($term->slug, $port_tax)) . '">' . esc_html($term->name) . '</a>');
                    }
                }

                $html = '
                    <div class="photberry_portfolio_column_item photberry_load">
                        <div class="photberry_image_cont">
                            <img src="' . $photberry_featured_image . '" alt="'. get_the_title() .'" />
                        </div>

                        <div class="photberry_portfolio_cont">
                            <h6 class="photberry_portfolio_category">
                                ' . (is_array($categories) ? join(', ', $categories) : '') . '
                            </h6>

                            <h2 class="photberry_portfolio_title">
                                <a href="' . esc_url(get_permalink()) . '">
                                    ' . get_the_title() . '
                                </a>
                            </h2>
                            <div class="photberry_portfolio_excerpt">
                                ' . photberry_excerpt_truncate(get_the_excerpt(), 1250, '...') . '
                            </div>
                            <a class="photberry_read_more_button" href="' . esc_url(get_permalink()) . '">
                                ' . esc_html__('Read More', 'photberry') . '
                            </a>
                        </div>
                    </div>
                ';

                echo photberry_output($html);
            }

            $posts_counter ++;
        }

        echo '
            <input type="hidden" name="count_posts" value="' . esc_attr($all_posts) . '">
            <input type="hidden" name="posts_counter" value="' . esc_attr($posts_counter) . '">
        ';
        wp_reset_query();
    }

    die();
}

# Reset All Settings
add_action('wp_ajax_photberry_reset_all_settings', 'photberry_reset_all_settings');
function photberry_reset_all_settings()
{
	if (!current_user_can('manage_options')) {
        wp_die(esc_html__('You do not have permissions to access this page.', 'photberry'));
    }

	remove_theme_mods();

	die(esc_html__('Done!', 'photberry'));
}
