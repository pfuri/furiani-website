<?php
/*
 * Created by Pixel-Mafia
 * www.pixel-mafia.com
*/

get_header();

$photberry_sidebar_position = photberry_get_theme_mod('sidebar_position');
if ($photberry_sidebar_position == 'photberry_no_sidebar') {
	$content_col_class = 'col12';
} else {
	$content_col_class = 'col9';
}
$sidebar_name = 'Sidebar';
$page_title_position = photberry_get_theme_mod('page_title_position');

    ?>
	<div class="photberry_main_wrapper photberry_top_padding_on photberry_bottom_padding_on">
		<div id="post-<?php the_ID(); ?>" <?php post_class('photberry_container'); ?>>
			<div class="photberry_content_wrapper row <?php echo esc_attr($photberry_sidebar_position); ?>">
				<div class="photberry_content <?php echo esc_attr($content_col_class); ?>">
					<div class="photberry_tiny">
						<div class="photberry_element_blog blog_type_standard colunms_1">
							<div class="photberry_blog_wrapper">
                            <?php
                            if (have_posts()) {
                                while (have_posts()) : the_post();
                                    ?>
                                    <div class="standard_post_item photberry_search_result_item">
                                        <div class="photberry_post_meta">
                                            <div class="photberry_post_meta_item">
                                                <?php echo esc_html(get_the_date()); ?>
                                            </div>

                                            <div class="photberry_post_meta_item">
                                                <?php
                                                echo esc_html__('by ', 'photberry');
                                                echo get_the_author_posts_link();
                                                ?>
                                            </div>
											<?php
											$categories = get_the_category();
											if (!empty($categories)) {
												?>
												<div class="photberry_post_meta_item">
													<?php
													the_category(', ');
													?>
												</div>
												<?php
											}
											?>
                                        </div>

                                        <h2 class="photberry_post_title">
                                            <a href="<?php echo esc_url(get_permalink()); ?>">
                                                <?php echo esc_html(get_the_title()); ?>
                                            </a>
                                        </h2>

                                        <div class="photberry_excerpt">
                                            <?php echo substr(get_the_excerpt(), 0, 310); ?>
                                        </div>

                                        <a class="photberry_read_more_button" href="<?php echo esc_url(get_permalink()); ?>">
                                            <?php echo esc_html__('Read More', 'photberry'); ?>
                                        </a>
                                    </div>
                                    <?php
                                endwhile;
                            } else {
                                ?>
                                <h1 class="photberry_no_search_result align_<?php echo esc_attr($page_title_position); ?>">
                                    <?php echo esc_html__('Oops! Nothing Found!', 'photberry'); ?>
                                </h1>

                                <div class="photberry_no_result_search_form widget_search">
                                    <?php echo get_search_form(true); ?>
                                </div>
                                <?php
                            }
                            ?>
							</div>

							<?php
							echo get_the_posts_pagination(array(
								'prev_text' => '<i class="pm-fa pm-fa-arrow-left" aria-hidden="true"></i>' . esc_html__(' Prev', 'photberry'),
								'next_text' => esc_html__('Next ', 'photberry') . '<i class="pm-fa pm-fa-arrow-right" aria-hidden="true"></i>'
							));
							?>
						</div>
					</div>
	            </div><!-- .photberry_content_wrapper -->
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
    <?php
get_footer();