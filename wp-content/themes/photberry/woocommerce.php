<?php
/*
 * Created by Pixel-Mafia
 * www.pixel-mafia.com
*/
get_header();

$photberry_sidebar_position = esc_attr(photberry_get_theme_mod('shop_sidebar_position'));
$photberry_sale_label = esc_attr(photberry_get_theme_mod('shop_sale_label'));
if ($photberry_sidebar_position == 'photberry_no_sidebar') {
    $content_col_class = 'col12';
} else {
    $content_col_class = 'col9';
}
$sidebar_name = 'Sidebar';

?>
<div class="photberry_main_wrapper photberry_top_padding_<?php echo esc_attr(photberry_get_post_option('page_top_padding')); ?> photberry_bottom_padding_<?php echo esc_attr(photberry_get_post_option('page_bottom_padding')); ?> shop_sale_label_<?php echo esc_attr($photberry_sale_label); ?>">
    <div id="post-<?php the_ID(); ?>" <?php post_class('photberry_container'); ?>>
        <div class="photberry_content_wrapper row <?php echo esc_attr($photberry_sidebar_position); ?>">
            <div class="photberry_content <?php echo esc_attr($content_col_class); ?>">
                <div class="photberry_tiny">
                    <?php
                        $shop_loop = false;
                        if (is_shop() || is_product_taxonomy() || is_product_tag() || is_product_category()) {
                            $shop_loop = true;
                        }
                        if ($shop_loop) {
                            echo '<div class="photberry_shop_loop">';
                        }
                        woocommerce_content();
                        if ($shop_loop) {
                            echo '</div><!-- .photberry_shop_loop -->';
                        }
                    ?>
                </div>
                <div class="clear"></div>
                <div class="photberry_subtiny">
                    <?php wp_link_pages(array('before' => '<div class="page-link">' . esc_html__('Pages', 'photberry') . ': ', 'after' => '</div>')); ?>
                </div>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
</div><!-- .photberry_main_wrapper -->
<?php

get_footer();