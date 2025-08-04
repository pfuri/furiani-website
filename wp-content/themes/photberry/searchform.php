<?php
/*
 * Created by Pixel-Mafia
 * www.pixel-mafia.com
*/
$search_rand = mt_rand(0, 999);
?>
<form name="search_form" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="photberry_search_form" id="search-<?php echo esc_attr($search_rand); ?>">
    <span class="photberry_icon_search" onclick="javascript:document.getElementById('search-<?php echo esc_attr($search_rand); ?>').submit();">
        <i class="pm-fa pm-fa-arrow-right"></i>
    </span>
    <input type="text" name="s" value="" placeholder="<?php echo esc_html__('Search', 'photberry'); ?>" title="<?php esc_html_e('Search the site...', 'photberry'); ?>" class="photberry_field_search">
    <div class="clear"></div>
</form>