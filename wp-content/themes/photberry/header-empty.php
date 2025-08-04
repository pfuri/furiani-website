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
	$photberry_sidebar_class = 'body_' . photberry_get_prefered_option('sidebar_position');
?>

<body <?php body_class($photberry_sidebar_class); ?>>
	<div class="photberry_site_wrapper <?php echo esc_attr($header_type_class); ?>">
