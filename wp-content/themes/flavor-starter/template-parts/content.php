<?php
/**
 * Template part for displaying posts
 *
 * @package Flavor_Starter
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
    <?php if (has_post_thumbnail()) : ?>
        <div class="post-card__image">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('flavor-card', ['class' => 'post-card__img']); ?>
            </a>
            <?php
            $categories = get_the_category();
            if ($categories) :
            ?>
                <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>" class="post-card__category">
                    <?php echo esc_html($categories[0]->name); ?>
                </a>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="post-card__content">
        <div class="post-card__meta">
            <span class="post-card__date">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                    <line x1="16" y1="2" x2="16" y2="6"/>
                    <line x1="8" y1="2" x2="8" y2="6"/>
                    <line x1="3" y1="10" x2="21" y2="10"/>
                </svg>
                <?php echo get_the_date(); ?>
            </span>
            <span class="post-card__reading-time">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/>
                    <polyline points="12,6 12,12 16,14"/>
                </svg>
                <?php echo esc_html(flavor_reading_time()); ?>
            </span>
        </div>

        <h2 class="post-card__title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h2>

        <p class="post-card__excerpt">
            <?php echo esc_html(wp_trim_words(get_the_excerpt(), 20, '...')); ?>
        </p>

        <a href="<?php the_permalink(); ?>" class="post-card__link">
            <?php esc_html_e('Читать далее', 'flavor-starter'); ?>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M5 12h14M12 5l7 7-7 7"/>
            </svg>
        </a>
    </div>
</article>
