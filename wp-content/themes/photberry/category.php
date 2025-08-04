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

	?>
	<div class="photberry_main_wrapper photberry_top_padding_yes photberry_bottom_padding_yes">
		<div class="photberry_container">
			<div class="photberry_content_wrapper row <?php echo esc_attr($photberry_sidebar_position); ?>">
				<div class="photberry_content <?php echo esc_attr($content_col_class); ?>">
					<div class="photberry_tiny">
						<div class="photberry_blog_wrapper photberry_element_blog">
							<?php
							while (have_posts()) : the_post();
								get_template_part('standard-listing');
							endwhile;
							wp_reset_query();
							?>
						</div><!-- .photberry_blog_wrapper -->

						<div class="photberry_blog_listing_pagination">
							<?php
							echo get_the_posts_pagination(array(
								'prev_text' => '<i class="pm-fa pm-fa-arrow-left" aria-hidden="true"></i>' . esc_html__(' Prev', 'photberry'),
								'next_text' => esc_html__('Next ', 'photberry') . '<i class="pm-fa pm-fa-arrow-right" aria-hidden="true"></i>'
							));
							?>
						</div>
					</div><!-- .photberry_tiny -->
					<div class="clear"></div>
				</div>
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div><!-- .photberry_main_wrapper -->

    <?php
get_footer();