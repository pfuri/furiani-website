<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>">
    <?php if (photberry_get_theme_mod('responsive_status') == 'on') { ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <?php } ?>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
</head>
<?php
	$header_type_class = photberry_get_prefered_option('header_type');
	$header_type_class_mobile = photberry_get_prefered_option('header_type_mobile');
?>
<body <?php body_class(); ?>>
	<?php photberry_preview_customizer(); ?>
	<div class="photberry_site_wrapper <?php echo esc_attr($header_type_class) . ' mobile_' . esc_attr($header_type_class_mobile); ?>">
        <header class="photberry_main_header <?php echo esc_attr($header_type_class); ?>">
			<?php photberry_the_logo(); ?>
			<nav class="photberry_nav" data-back="<?php echo esc_html__('Back', 'photberry'); ?>">
				<?php
				$photberry_menu_locations = get_nav_menu_locations();
				if (isset($photberry_menu_locations['main']) && $photberry_menu_locations['main'] !== 0) {
					wp_nav_menu(array('theme_location' => 'main', 'menu_class' => 'photberry_menu', 'depth' => '0', 'container' => ''));
				} else {
					echo '<div class="photberry_menu_notify">' . esc_html__('Please create and select menu in Appearance (Menus)', 'photberry') . ' <a href="'.esc_url(get_admin_url(null, 'nav-menus.php')).'"><i class="pm-fa pm-fa-long-arrow-right" aria-hidden="true"></i></a></div>';
				}
				?>
			</nav>
			<div class="photberry_aside_footer">
				<div class="photberry_aside_footer_inner">
					<div class="photberry_socials_wrapper"><?php echo photberry_social_buttons_in_footer(); ?></div>
					<div class="photberry_copyright">
						<?php echo photberry_get_theme_mod('footer_copyright_text'); ?>
					</div>
					<div class="photberry_footer_additional">
						<?php echo photberry_get_theme_mod('footer_advanced_line'); ?>
					</div>
				</div>
			</div>
		</header>
        <a href="<?php echo esc_js("javascript:void(0)"); ?>" class="photberry_menu_toggler <?php echo esc_attr($header_type_class_mobile); ?>">
        	<span class="photberry_menu_ico">
                <span class="photberry_menu_line1"></span>
                <span class="photberry_menu_line2"></span>
                <span class="photberry_menu_line3"></span>
            </span>
		</a>

        <header class="photberry_mobile_header photberry_mobile_header_loading <?php echo esc_attr($header_type_class_mobile); ?>">
        	<div class="photberry_mobile_header_inner">
				<?php photberry_the_logo(); ?>
				<nav class="photberry_nav" data-back="<?php echo esc_html__('Back', 'photberry'); ?>">
					<?php
					$photberry_menu_locations = get_nav_menu_locations();
					if (isset($photberry_menu_locations['main']) && $photberry_menu_locations['main'] !== 0) {
						wp_nav_menu(array('theme_location' => 'main', 'menu_class' => 'photberry_menu', 'depth' => '0', 'container' => ''));
					} else {
						echo '<div class="photberry_menu_notify">' . esc_html__('Please create and select menu in Appearance (Menus)', 'photberry') . ' <a href="'.esc_url(get_admin_url(null, 'nav-menus.php')).'"><i class="pm-fa pm-fa-long-arrow-right" aria-hidden="true"></i></a></div>';
					}
					?>
				</nav>
				<div class="photberry_aside_footer">
					<div class="photberry_aside_footer_inner">
						<div class="photberry_socials_wrapper"><?php echo photberry_social_buttons_in_footer(); ?></div>
						<div class="photberry_copyright">
							<?php echo photberry_get_theme_mod('footer_copyright_text'); ?>
						</div>
						<div class="photberry_footer_additional">
							<?php echo photberry_get_theme_mod('footer_advanced_line'); ?>
						</div>
					</div>
				</div>
			</div>
			<a href="<?php echo esc_js("javascript:void(0)"); ?>" class="photberry_mobile_menu_toggler">
				<span class="photberry_menu_ico">
					<span class="photberry_menu_line1"></span>
					<span class="photberry_menu_line2"></span>
					<span class="photberry_menu_line3"></span>
				</span>
			</a>
		</header>
