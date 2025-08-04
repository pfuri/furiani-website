/*
 * Created by Pixel-Mafia
 * www.pixel-mafia.com
*/
"use strict";

jQuery(document).ready(function(){
    if (jQuery('.photberry_shop_loop').length) {
        jQuery('.photberry_shop_loop').find('li.product').each(function(){
            var $this = jQuery(this);
            $this.find('img').wrap('<div class="photberry_shop_loop_image"></div>');
        });
    } else {
        jQuery('.products li .attachment-woocommerce_thumbnail').wrap('<div class="photberry_shop_loop_image"></div>')
    }
});