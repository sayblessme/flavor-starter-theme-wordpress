<?php
/**
 * Template part for displaying single post content
 *
 * @package Flavor_Starter
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('single-post__article'); ?>>
    <?php if (has_post_thumbnail()) : ?>
        <div class="single-post__featured-image">
            <?php the_post_thumbnail('flavor-hero', ['class' => 'single-post__img']); ?>
        </div>
    <?php endif; ?>

    <div class="entry-content">
        <?php
        the_content(
            sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                    __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'flavor-starter'),
                    [
                        'span' => [
                            'class' => [],
                        ],
                    ]
                ),
                wp_kses_post(get_the_title())
            )
        );

        wp_link_pages([
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'flavor-starter'),
            'after'  => '</div>',
        ]);
        ?>
    </div>

    <footer class="entry-footer">
        <?php
        // Tags
        $tags = get_the_tags();
        if ($tags) :
        ?>
            <div class="entry-tags">
                <span class="entry-tags__label"><?php esc_html_e('Tags:', 'flavor-starter'); ?></span>
                <?php foreach ($tags as $tag) : ?>
                    <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="entry-tag">
                        <?php echo esc_html($tag->name); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Share Buttons -->
        <div class="entry-share">
            <span class="entry-share__label"><?php esc_html_e('Share:', 'flavor-starter'); ?></span>
            <?php flavor_share_buttons(); ?>
        </div>
    </footer>
</article>
