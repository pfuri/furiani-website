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
			<div class="photberry_content_wrapper row <?php echo esc_attr($photberry_sidebar_position); ?>">
				<div class="photberry_content <?php echo esc_attr($content_col_class); ?>">
					<?php
					if ($page_title !== 'hide') {
						?>
						<h1 class="photberry_page_title align_<?php echo esc_attr($page_title_position); ?>"><?php echo get_the_title(); ?></h1>
						<?php
					}
					?>

					<div class="photberry_tiny">
						<?php the_content(); ?>
					</div>
					<div class="clear"></div>
					<div class="photberry_subtiny">
						<?php wp_link_pages(array('before' => '<div class="page-link">' . esc_html__('Pages', 'photberry') . ': ', 'after' => '</div>')); ?>
					</div>

					<div class="photberry_comments_cont">
						<?php comments_template(); ?>
					</div>
				</div>
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div><!-- .photberry_main_wrapper -->
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