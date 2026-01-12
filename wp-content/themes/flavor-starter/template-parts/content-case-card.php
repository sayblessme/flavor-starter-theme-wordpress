<?php
/**
 * Template part for displaying case/portfolio card
 *
 * @package Flavor_Starter
 */
?>

<article id="case-<?php the_ID(); ?>" <?php post_class('portfolio-card'); ?> data-category="<?php
    $categories = get_the_terms(get_the_ID(), 'case_category');
    if ($categories && !is_wp_error($categories)) {
        echo esc_attr($categories[0]->slug);
    }
?>">
    <div class="portfolio-card__image">
        <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('flavor-card', ['class' => 'portfolio-card__img']); ?>
        <?php else : ?>
            <div class="portfolio-card__placeholder">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                    <circle cx="8.5" cy="8.5" r="1.5"/>
                    <polyline points="21,15 16,10 5,21"/>
                </svg>
            </div>
        <?php endif; ?>

        <div class="portfolio-card__overlay">
            <h3 class="portfolio-card__title"><?php the_title(); ?></h3>

            <?php if ($categories && !is_wp_error($categories)) : ?>
                <span class="portfolio-card__category"><?php echo esc_html($categories[0]->name); ?></span>
            <?php endif; ?>

            <div class="portfolio-card__actions">
                <a href="<?php the_permalink(); ?>" class="portfolio-card__action" aria-label="<?php esc_attr_e('View Project', 'flavor-starter'); ?>">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </a>
                <?php
                $website = function_exists('get_field') ? get_field('case_website') : '';
                if ($website) :
                ?>
                    <a href="<?php echo esc_url($website); ?>" class="portfolio-card__action" target="_blank" rel="noopener" aria-label="<?php esc_attr_e('Visit Website', 'flavor-starter'); ?>">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6v6M10 14L21 3"/>
                        </svg>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</article>
