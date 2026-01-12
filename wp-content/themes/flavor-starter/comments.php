<?php
/**
 * The template for displaying comments
 *
 * @package Flavor_Starter
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php if (have_comments()) : ?>
        <h2 class="comments-title">
            <?php
            $flavor_comment_count = get_comments_number();
            if ('1' === $flavor_comment_count) {
                printf(
                    /* translators: 1: title. */
                    esc_html__('One thought on &ldquo;%1$s&rdquo;', 'flavor-starter'),
                    '<span>' . wp_kses_post(get_the_title()) . '</span>'
                );
            } else {
                printf(
                    /* translators: 1: comment count number, 2: title. */
                    esc_html(_nx('%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $flavor_comment_count, 'comments title', 'flavor-starter')),
                    number_format_i18n($flavor_comment_count),
                    '<span>' . wp_kses_post(get_the_title()) . '</span>'
                );
            }
            ?>
        </h2>

        <?php the_comments_navigation(); ?>

        <ol class="comments__list">
            <?php
            wp_list_comments([
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 60,
                'callback'    => 'flavor_comment_callback',
            ]);
            ?>
        </ol>

        <?php
        the_comments_navigation();

        // If comments are closed and there are comments, let's leave a little note.
        if (!comments_open()) :
        ?>
            <p class="no-comments"><?php esc_html_e('Comments are closed.', 'flavor-starter'); ?></p>
        <?php endif; ?>

    <?php endif; ?>

    <?php
    $commenter = wp_get_current_commenter();
    $req       = get_option('require_name_email');
    $html_req  = ($req ? " required='required'" : '');
    $html5     = true;

    comment_form([
        'class_form'           => 'comment-form',
        'title_reply'          => esc_html__('Leave a Comment', 'flavor-starter'),
        'title_reply_to'       => esc_html__('Reply to %s', 'flavor-starter'),
        'cancel_reply_link'    => esc_html__('Cancel Reply', 'flavor-starter'),
        'label_submit'         => esc_html__('Post Comment', 'flavor-starter'),
        'submit_button'        => '<button name="%1$s" type="submit" id="%2$s" class="%3$s btn btn--primary">%4$s</button>',
        'submit_field'         => '<div class="form-submit">%1$s %2$s</div>',
        'comment_notes_before' => '<p class="comment-notes">' . esc_html__('Your email address will not be published. Required fields are marked *', 'flavor-starter') . '</p>',
        'comment_field'        => '<div class="comment-form-comment"><label for="comment">' . esc_html__('Comment', 'flavor-starter') . ' <span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="6" required="required" placeholder="' . esc_attr__('Write your comment here...', 'flavor-starter') . '"></textarea></div>',
        'fields'               => [
            'author' => '<div class="comment-form-author"><label for="author">' . esc_html__('Name', 'flavor-starter') . ($req ? ' <span class="required">*</span>' : '') . '</label><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" placeholder="' . esc_attr__('Your name', 'flavor-starter') . '"' . $html_req . ' /></div>',
            'email'  => '<div class="comment-form-email"><label for="email">' . esc_html__('Email', 'flavor-starter') . ($req ? ' <span class="required">*</span>' : '') . '</label><input id="email" name="email" ' . ($html5 ? 'type="email"' : 'type="text"') . ' value="' . esc_attr($commenter['comment_author_email']) . '" placeholder="' . esc_attr__('your@email.com', 'flavor-starter') . '"' . $html_req . ' /></div>',
            'url'    => '<div class="comment-form-url"><label for="url">' . esc_html__('Website', 'flavor-starter') . '</label><input id="url" name="url" ' . ($html5 ? 'type="url"' : 'type="text"') . ' value="' . esc_attr($commenter['comment_author_url']) . '" placeholder="' . esc_attr__('https://yourwebsite.com', 'flavor-starter') . '" /></div>',
            'cookies' => '<div class="comment-form-cookies"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . (empty($commenter['comment_author_email']) ? '' : ' checked="checked"') . ' /><label for="wp-comment-cookies-consent">' . esc_html__('Save my name, email, and website in this browser for the next time I comment.', 'flavor-starter') . '</label></div>',
        ],
    ]);
    ?>

</div>

<?php
/**
 * Custom comment callback function
 */
function flavor_comment_callback($comment, $args, $depth)
{
    $tag = ('div' === $args['style']) ? 'div' : 'li';
?>
    <<?php echo esc_attr($tag); ?> id="comment-<?php comment_ID(); ?>" <?php comment_class(empty($args['has_children']) ? 'comment' : 'comment comment--parent', $comment); ?>>
        <article id="div-comment-<?php comment_ID(); ?>" class="comment__body">
            <div class="comment__avatar">
                <?php
                if (0 != $args['avatar_size']) {
                    echo get_avatar($comment, $args['avatar_size']);
                }
                ?>
            </div>

            <div class="comment__content">
                <header class="comment__header">
                    <div class="comment__author vcard">
                        <?php
                        printf(
                            '<cite class="fn">%s</cite>',
                            get_comment_author_link($comment)
                        );
                        ?>
                    </div>

                    <div class="comment__meta">
                        <a href="<?php echo esc_url(get_comment_link($comment, $args)); ?>" class="comment__date">
                            <time datetime="<?php comment_time('c'); ?>">
                                <?php
                                printf(
                                    /* translators: 1: comment date, 2: comment time. */
                                    esc_html__('%1$s at %2$s', 'flavor-starter'),
                                    get_comment_date('', $comment),
                                    get_comment_time()
                                );
                                ?>
                            </time>
                        </a>

                        <?php edit_comment_link(esc_html__('Edit', 'flavor-starter'), '<span class="comment__edit">', '</span>'); ?>
                    </div>
                </header>

                <?php if ('0' == $comment->comment_approved) : ?>
                    <p class="comment__awaiting-moderation">
                        <?php esc_html_e('Your comment is awaiting moderation.', 'flavor-starter'); ?>
                    </p>
                <?php endif; ?>

                <div class="comment__text">
                    <?php comment_text(); ?>
                </div>

                <footer class="comment__footer">
                    <?php
                    comment_reply_link(
                        array_merge(
                            $args,
                            [
                                'add_below' => 'div-comment',
                                'depth'     => $depth,
                                'max_depth' => $args['max_depth'],
                                'before'    => '<span class="comment__reply">',
                                'after'     => '</span>',
                            ]
                        )
                    );
                    ?>
                </footer>
            </div>
        </article>
<?php
}
