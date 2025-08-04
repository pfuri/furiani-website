<?php
/*
 * Created by Pixel-Mafia
 * www.pixel-mafia.com
 * Template Name: Verticaly Centered
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
	$photberry_bg_img = photberry_get_post_option('centered_bg_image');
	
	foreach ($photberry_bg_img as $key => $image) {
		$photberry_bg_img_src = $image['full_url'];
	}
	?>
	<div class="photberry_centered_page_bg photberry_js_bg_image" data-src="<?php echo esc_url($photberry_bg_img_src); ?>"></div>
	<?php if (photberry_get_post_option('centered_bg_overlay_state') == 'show') { ?>
	<div class="photberry_centered_page_bg_overlay photberry_js_bg_color" data-bgcolor="<?php echo esc_attr(photberry_get_post_option('centered_bg_overlay')); ?>"></div>
	<?php } ?>
	<div class="photberry_content">
		<div class="photberry_verticaly_page_wrapper">
			<div class="photberry_verticaly_page_inner">
				<div id="post-<?php the_ID(); ?>" <?php post_class('photberry_container'); ?>>
					<div class="photberry_centered_content">
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
					</div>
				</div>
			</div>
		</div><!-- .photberry_verticaly_page_wrapper -->
	</div>
	<?php

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