<?php
/*
 * Created by Pixel-Mafia
 * www.pixel-mafia.com
*/

if (post_password_required()) {
    return;
}

# Enqueue Comment Reply JS
if (is_singular() && comments_open()) {
    wp_enqueue_script('comment-reply');
}

function photberry_comment_html($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;
    ?>

<div <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
    <div class="photberry_comment_ava">
        <?php echo get_avatar($comment->comment_author_email, $args['avatar_size']); ?>
    </div>
    <div class="photberry_comment_body">
        <?php
        if ($comment->comment_approved == '0') {
            echo '<p>' . esc_html__('Your comment is awaiting moderation.', 'photberry') . '</p>';
        }
        ?>
        <h6 class="innertitle photberry_comment_author"><?php echo get_comment_author(); ?></h6>
        <div class="photberry_comment_text">
            <?php comment_text(); ?>
        </div>
        <?php
        echo '
		<div class="photberry_comment_meta">'; ?>
			<div class="photberry_comment_date">
				<?php echo get_the_date(); ?>
			</div>
			<div class="photberry_comment_reply_cont">
				<?php
				comment_reply_link(
					array_merge(
						$args, array(
							'before' => ' <div class="photberry_comment_reply">',
							'after' => '</div>',
							'depth' => $depth,
							'reply_text' => esc_html__('Reply', 'photberry'),
							'max_depth' => $args['max_depth']
						)
					)
				);
				?>
			</div>
			<div class="photberry_comment_edit">
				<?php edit_comment_link('Edit'); ?>
			</div>
			<?php
			echo '
			<div class="clear"></div>
		</div>
        ';
        ?>
    </div>
    <?php
}
    ?>

    <div class="photberry_comments_cont">
        <div class="photberry_comments_wrapper">
            <?php if (have_comments()) { ?>
               <h5 class="photberry_comments_title">
                <?php echo esc_attr__('Comments on This Post', 'photberry'); ?>
            </h5>

            <?php
            
                the_comments_navigation();
                ?>

                <div class="photberry_comment_list">
                    <?php
                    wp_list_comments(array(
                        'style' => 'div',
                        'max_depth' => '5',
                        'avatar_size' => 140,
						'type' => 'all',
                        'callback' => 'photberry_comment_html'
                    ));
                    ?>
                </div>

                <?php the_comments_navigation();
            }
if (comments_open()) {

            $photberry_comments_field_req = get_option('require_name_email');			

            comment_form(array(
                'title_reply_before' => '<h5 class="photberry_reply_comment_title">',
                'title_reply' => esc_html__('Let us know your thoughts about this topic', 'photberry'),
                'title_reply_after' => '</h5>',
                'fields' => array(
                    'author' => '<div class="row"><div class="comment-form-author col col-12"><input placeholder="'.esc_attr__('Name', 'photberry') . ($photberry_comments_field_req ? ' *' : '').'" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30" /></div>',
                    'email' => '<div class="comment-form-email col col-12"><input placeholder="'.esc_attr__('Email', 'photberry') . ($photberry_comments_field_req ? ' *' : '').'" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" /></div></div>',
                ),
                'comment_field' => '<div class="row"><div class="comment-form-comment col col-12"><textarea name="comment" cols="45" rows="5" placeholder="' . esc_html__('Comment', 'photberry') . '" id="comment-message" class="form-field"></textarea></div></div>',
                'label_submit' => esc_html__('Send Comment', 'photberry'),
            ));
            ?>
    <?php
}
?>
        </div>
    </div>
