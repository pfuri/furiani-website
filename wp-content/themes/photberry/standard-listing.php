<?php
/*
 * Created by Pixel-Mafia
 * www.pixel-mafia.com
*/

$photberry_post_format = get_post_format();
if (empty($photberry_post_format)) {
    $photberry_post_format = 'standard';
}
?>

<div class="standard_post_item <?php echo ((is_sticky()) ? 'photberry_sticky_post' : ''); ?>" id="post-<?php echo esc_attr(get_the_ID()); ?>">
	<?php echo photberry_get_post_formats(array('photberry_is_listing' => true)); ?>
	<div class="photberry_post_meta">
       	<?php 
			if (is_sticky()) {
				echo '<i class="pm-fa pm-fa-thumb-tack photberry_sticky_marker"></i>'; 
			}
		?>
        <div class="photberry_post_meta_item">
            <?php echo get_the_date(); ?>
        </div>
        <div class="photberry_post_meta_item">
            <?php
            echo esc_html__('by', 'photberry') .' ' .get_the_author_posts_link();
            ?>
        </div>
        <?php
        $categories = get_the_category();
        if (!empty($categories)) {
            ?>
            <div class="photberry_post_meta_item">
                <?php
                the_category(', ');
                ?>
            </div>
            <?php
        }
        ?>
    </div>
    <h2 class="photberry_post_listing_title"><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_the_title()); ?></a></h2>

    <div class="photberry_excerpt">
        <?php echo photberry_excerpt_truncate(get_the_excerpt(), 380, '...'); ?>
    </div>

    <a class="photberry_read_more_button" href="<?php echo esc_url(get_permalink()); ?>">
        <?php echo esc_html__('Read More', 'photberry'); ?>
    </a>
</div>