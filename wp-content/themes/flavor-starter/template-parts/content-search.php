<?php
/**
 * Template part for displaying results in search pages
 *
 * @package Flavor_Starter
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('search-result'); ?>>
    <div class="search-result__content">
        <span class="search-result__type">
            <?php echo esc_html(get_post_type_object(get_post_type())->labels->singular_name); ?>
        </span>

        <h2 class="search-result__title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h2>

        <div class="search-result__excerpt">
            <?php the_excerpt(); ?>
        </div>

        <div class="search-result__meta">
            <span class="search-result__date">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                    <line x1="16" y1="2" x2="16" y2="6"/>
                    <line x1="8" y1="2" x2="8" y2="6"/>
                    <line x1="3" y1="10" x2="21" y2="10"/>
                </svg>
                <?php echo get_the_date(); ?>
            </span>

            <a href="<?php the_permalink(); ?>" class="search-result__link">
                <?php esc_html_e('View', 'flavor-starter'); ?>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M5 12h14M12 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>

    <?php if (has_post_thumbnail()) : ?>
        <div class="search-result__image">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('thumbnail', ['class' => 'search-result__img']); ?>
            </a>
        </div>
    <?php endif; ?>
</article>
