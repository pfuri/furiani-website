<?php
/*
 * Created by Pixel-Mafia
 * www.pixel-mafia.com
*/

get_header();
$search_rand = mt_rand(0, 999);
?>
	<div class="photberry_404_bg photberry_js_bg_image" data-src="<?php echo photberry_get_theme_mod('404_bg_image'); ?>"></div>
    <div class="photberry_404_content_wrapper">
        <div class="photberry_404_content_inner">
            <h1><?php echo esc_html__('404 Error! Page not Found.', 'photberry'); ?></h1>
            <p><?php echo esc_html__("There's a lot of reasons why this page is 404. Don't waste your time enjoying the look of it. You could return to the homepage or search using the search box below.", "photberry"); ?></p>
            <div class="clear"></div>
			<form name="search_form" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="photberry_search_form" id="search-<?php echo esc_attr($search_rand); ?>">
				<input type="text" name="s" value="" placeholder="<?php echo esc_html__('search the site', 'photberry'); ?>" title="<?php esc_html_e('Search the site...', 'photberry'); ?>" class="photberry_field_search">
				<input type="submit" class="photberry_search_submit photberry_reverse_button" value="<?php esc_html_e('Search', 'photberry'); ?>">
				<div class="clear"></div>
			</form>
		</div>
    </div>
<?php
get_footer('empty');