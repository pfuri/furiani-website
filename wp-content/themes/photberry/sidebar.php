<?php
/*
 * Created by Pixel-Mafia
 * www.pixel-mafia.com
*/

$woo_sidebar_option = 'default';
if (is_category() || is_search() || is_home()) {
	$photberry_sidebar_position = esc_attr(photberry_get_theme_mod('sidebar_position'));
} else if (photberry_is_woocommerce_activated() && is_woocommerce()) {
    $photberry_sidebar_position = esc_attr(photberry_get_theme_mod('shop_sidebar_position'));
} else {
	$photberry_sidebar_position = esc_attr(photberry_get_prefered_option('sidebar_position'));
}
if (is_active_sidebar('sidebar') && $photberry_sidebar_position !== 'photberry_no_sidebar') {
    echo "<div class='photberry_sidebar col3 " . (($photberry_sidebar_position == 'photberry_left_sidebar') ? 'first' : '') . "'>";
	if (photberry_is_woocommerce_activated()) {
		if (is_woocommerce()) {
			dynamic_sidebar('sidebar-woocommerce');
		} else {
			dynamic_sidebar('sidebar');
		}
	} else {
		dynamic_sidebar('sidebar');
	}
    echo "</div>";
}