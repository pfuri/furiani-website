<?php
/*
 * Created by Pixel-Mafia
 * www.pixel-mafia.com
 * Template Name: Coming Soon
*/

the_post();
get_header('empty');

wp_enqueue_script('jquery-countdown', get_template_directory_uri() . '/js/jquery.countdown.js', true, false, true);
?>
	<div class="photberry_cs_bg photberry_js_bg_image" data-src="<?php echo esc_url(photberry_get_theme_mod('cs_bg_image')); ?>"></div>
	<div class="photberry_cs_logo">
		<?php photberry_the_logo(); ?>
	</div>
	<div class="photberry_cs_content_wrapper">
		<div class="photberry_cs_content_inner">
			<div class="photberry_cs_content">
				<h1 class="photberry_cs_title"><?php the_title(); ?></h1>
				<div class="photberry_element_wrap photberry_element_countdown">
					<time><?php echo esc_attr(photberry_get_post_option('photberry_countdown_date_y')) . '-' . esc_attr(photberry_get_post_option('photberry_countdown_date_m')) . '-' . esc_attr(photberry_get_post_option('photberry_countdown_date_d')); ?>T00:00:00+0000</time>
				</div>
				<?php if (photberry_get_post_option('photberry_countdown_shortcode') !== '') {
					echo '
						<div class="photberry_cs_shortcode_wrapper">
							'. do_shortcode(photberry_get_post_option('photberry_countdown_shortcode')) .'
						</div>
					';
				}?>
			</div>
		</div>
	</div>
	<div class="photberry_cs_footer">
		<div class="photberry_socials_wrapper"><?php echo photberry_social_buttons_in_footer(); ?></div>
		<div class="photberry_copyright">
			<?php echo photberry_get_theme_mod('footer_copyright_text'); ?>
		</div>
		<div class="photberry_footer_additional">
			<?php echo photberry_get_theme_mod('footer_advanced_line'); ?>
		</div>
	</div>
<?php
get_footer('empty');
