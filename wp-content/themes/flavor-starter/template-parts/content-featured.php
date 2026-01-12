<?php
/**
 * Template part for displaying featured post
 *
 * @package Flavor_Starter
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('featured-post'); ?>>
    <div class="featured-post__grid">
        <?php if (has_post_thumbnail()) : ?>
            <div class="featured-post__image">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('flavor-hero', ['class' => 'featured-post__img']); ?>
                </a>
            </div>
        <?php endif; ?>

        <div class="featured-post__content">
            <span class="featured-post__badge"><?php esc_html_e('Рекомендуем', 'flavor-starter'); ?></span>

            <?php
            $categories = get_the_category();
            if ($categories) :
            ?>
                <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>" class="featured-post__category">
                    <?php echo esc_html($categories[0]->name); ?>
                </a>
            <?php endif; ?>

            <h2 class="featured-post__title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>

            <p class="featured-post__excerpt">
                <?php echo esc_html(wp_trim_words(get_the_excerpt(), 40, '...')); ?>
            </p>

            <div class="featured-post__meta">
                <div class="featured-post__author">
                    <?php echo get_avatar(get_the_author_meta('ID'), 40, '', '', ['class' => 'featured-post__avatar']); ?>
                    <div class="featured-post__author-info">
                        <span class="featured-post__author-name"><?php the_author(); ?></span>
                        <span class="featured-post__date"><?php echo get_the_date(); ?></span>
                    </div>
                </div>

                <span class="featured-post__reading-time">
                    <?php echo esc_html(flavor_reading_time()); ?>
                </span>
            </div>

            <a href="<?php the_permalink(); ?>" class="btn btn--primary">
                <?php esc_html_e('Читать статью', 'flavor-starter'); ?>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M5 12h14M12 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>
</article>
