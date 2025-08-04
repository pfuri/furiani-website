<?php
/*
 * Created by Pixel-Mafia
 * www.pixel-mafia.com
*/

if (!post_password_required()) {
	the_post();
	get_header();

	$page_title = photberry_get_prefered_option('page_title_status');
	$page_title_position = photberry_get_prefered_option('page_title_position');
    $posts_featured_image = photberry_get_prefered_option('posts_featured_image');
	$photberry_sidebar_position = photberry_get_prefered_option('sidebar_position');
	if ($photberry_sidebar_position == 'photberry_no_sidebar') {
		$content_col_class = 'col12';
	} else {
		$content_col_class = 'col9';
	}
	$sidebar_name = 'Sidebar';
	?>
	<div class="photberry_main_wrapper photberry_top_padding_<?php echo esc_attr(photberry_get_post_option('page_top_padding')); ?> photberry_bottom_padding_<?php echo esc_attr(photberry_get_post_option('page_bottom_padding')); ?>">
		<div id="post-<?php the_ID(); ?>" <?php post_class('photberry_container'); ?>>
			<div class="photberry_single_post photberry_content_wrapper row <?php echo esc_attr($photberry_sidebar_position); ?>">
				<div class="photberry_content <?php echo esc_attr($content_col_class); ?>">
					<div class="photberry_post_meta">
						<div class="photberry_post_meta_item">
							<?php echo esc_html(get_the_date()); ?>
						</div>
						<div class="photberry_post_meta_item">
							<?php echo esc_html__('by', 'photberry'); echo ' '; the_author_posts_link(); ?>
						</div>
						<div class="photberry_post_meta_item">
							<?php echo esc_html__('in', 'photberry'); echo ' '; the_category('<span>+</span>'); ?>
						</div>
					</div>

					<?php
					if (photberry_get_prefered_option('post_title_status') == 'show') {
						?>
						<h1 class="photberry_post_title"><?php echo esc_html(get_the_title()); ?></h1>
						<?php
					}
					?>

					<?php 
                        if ($posts_featured_image == 'show') {
                            echo photberry_get_post_formats();
                        }
                    ?>

					<div class="photberry_tiny">
						<?php the_content(); ?>
					</div>
					<div class="clear"></div>
					<div class="photberry_subtiny">
						<?php wp_link_pages(array('before' => '<div class="page-link">' . esc_html__('Pages', 'photberry') . ': ', 'after' => '</div>')); ?>
					</div>

					<?php
					if (photberry_get_prefered_option('post_tags_status') == 'show') {
						?>
						<div class="photberry_post_tags">
							<?php the_tags(esc_html__('Tagged In', 'photberry'). ' ', ', ', ''); ?>
						</div>
						<?php
					}

					if (photberry_get_prefered_option('share_buttons_status') == 'show') {
						?>
						<div class="photberry_sharing">
							<span href="<?php echo esc_js('javascript:void(0)'); ?>" class="photberry_sharing_label">
								<?php echo esc_html__('Share This Post', 'photberry'); ?>
							</span>

							<a target="_blank"
							   class="photberry_share_facebook"
							   data-elementor-open-lightbox="no"
							   href="http://www.facebook.com/share.php?u=<?php echo get_permalink(); ?>">
								<?php echo esc_html__('Facebook', 'photberry'); ?>
							</a>

							<a target="_blank"
							   class="photberry_share_twitter"
							   data-elementor-open-lightbox="no"
							   href="https://twitter.com/intent/tweet?text=<?php echo str_replace(' ', '%20', get_the_title()); ?>&amp;url=<?php echo get_permalink(); ?>">
								<?php echo esc_html__('Twitter', 'photberry'); ?>
							</a>

							<a target="_blank"
							   class="photberry_share_pinterest"
							   data-elementor-open-lightbox="no"
							   href="http://pinterest.com/pin/create/button/?url=<?php echo get_permalink(); ?>&media=<?php echo (strlen(photberry_get_featured_image_url()) > 0 ? photberry_get_featured_image_url() : photberry_get_theme_mod('logo_image')); ?>">
								<?php echo esc_html__('Pinterest', 'photberry'); ?>
							</a>
						</div>
						<?php
					}

					?>
					<div class="clear"></div>
					<div class="photberry_single_divider"></div>
					<?php
					if (photberry_get_prefered_option('post_navigation_status') == 'show') {
						if (strlen(get_previous_post_link()) > 0 || strlen(get_next_post_link()) > 0) {
							?>
							<div class="photberry_posts_navigation">
								<div class="photberry_prev_post_wrapper">
								<?php
								if (strlen(get_previous_post_link()) > 0) {
									$prev_post = get_previous_post();
									?>
									<span class="photberry_prev_post_button photberry_post_nav_button">
										<?php echo get_previous_post_link('%link', '<i class="pm-fa pm-fa-arrow-left"></i>' . esc_html__('Prev Post', 'photberry')); ?>
									</span>
									<a href="<?php echo get_permalink($prev_post->ID); ?>" class="photberry_prev_post_title"><?php echo get_the_title($prev_post->ID); ?></a>
									<?php
								}
								?>
								</div><!-- .photberry_prev_post_wrapper -->

								<div class="photberry_next_post_wrapper">
								<?php
								if (strlen(get_next_post_link()) > 0) {
									$next_post = get_next_post();
									?>

									<span class="photberry_next_post_button photberry_post_nav_button">
										<?php echo get_next_post_link('%link', esc_html__('Next Post', 'photberry') . '<i class="pm-fa pm-fa-arrow-right"></i>'); ?>
										
									</span>
									<a href="<?php echo get_permalink($next_post->ID); ?>" class="photberry_next_post_title"><?php echo get_the_title($next_post->ID); ?></a>
									<?php
								}
								?>
								</div><!-- .photberry_next_post_wrapper -->

								<div class="clear"></div>
							</div>
						<?php
						}
					}
					?>

					<?php comments_template(); ?>
					
					<?php
					if (photberry_get_prefered_option('featured_posts_status') == 'enabled') {
						photberry_featured_posts(array(
							'post_type' => get_post_type(),
							'orderby' => photberry_get_prefered_option('featured_posts_orderby'),
							'numberposts' => photberry_get_prefered_option('featured_posts_numberposts'),
							'featured_image_status' => photberry_get_prefered_option('featured_posts_fimage_status'),
							'excerpt' => photberry_get_prefered_option('featured_posts_excerpt_status'),
							'post_meta' => photberry_get_prefered_option('featured_posts_meta_status')
						));
					}
					?>
				</div>
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
	<?php

	get_footer();
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