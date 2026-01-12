<?php
/**
 * Template Functions
 *
 * @package Flavor_Starter
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get social sharing links
 */
function flavor_get_share_links(): array {
    $url = urlencode(get_permalink());
    $title = urlencode(get_the_title());

    return [
        'facebook' => [
            'url'   => "https://www.facebook.com/sharer/sharer.php?u={$url}",
            'label' => __('Share on Facebook', 'flavor-starter'),
            'icon'  => '<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>',
        ],
        'twitter' => [
            'url'   => "https://twitter.com/intent/tweet?url={$url}&text={$title}",
            'label' => __('Share on Twitter', 'flavor-starter'),
            'icon'  => '<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>',
        ],
        'linkedin' => [
            'url'   => "https://www.linkedin.com/shareArticle?mini=true&url={$url}&title={$title}",
            'label' => __('Share on LinkedIn', 'flavor-starter'),
            'icon'  => '<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>',
        ],
        'telegram' => [
            'url'   => "https://t.me/share/url?url={$url}&text={$title}",
            'label' => __('Share on Telegram', 'flavor-starter'),
            'icon'  => '<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"></path></svg>',
        ],
        'email' => [
            'url'   => "mailto:?subject={$title}&body={$url}",
            'label' => __('Share via Email', 'flavor-starter'),
            'icon'  => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>',
        ],
    ];
}

/**
 * Display share buttons
 */
function flavor_share_buttons(): void {
    $links = flavor_get_share_links();
    ?>
    <div class="share-buttons">
        <span class="share-buttons__label"><?php esc_html_e('Share:', 'flavor-starter'); ?></span>
        <div class="share-buttons__list">
            <?php foreach ($links as $key => $link): ?>
            <a href="<?php echo esc_url($link['url']); ?>"
               class="share-button share-button--<?php echo esc_attr($key); ?>"
               target="_blank"
               rel="noopener noreferrer"
               aria-label="<?php echo esc_attr($link['label']); ?>">
                <?php echo $link['icon']; ?>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
}

/**
 * Pagination
 */
function flavor_pagination(WP_Query $query = null): void {
    if (!$query) {
        global $wp_query;
        $query = $wp_query;
    }

    $total_pages = $query->max_num_pages;

    if ($total_pages <= 1) {
        return;
    }

    $current_page = max(1, get_query_var('paged'));
    ?>
    <nav class="pagination" aria-label="<?php esc_attr_e('Pagination', 'flavor-starter'); ?>">
        <div class="pagination__list">
            <?php
            // Previous button
            if ($current_page > 1):
            ?>
            <a href="<?php echo esc_url(get_pagenum_link($current_page - 1)); ?>" class="pagination__item pagination__item--prev">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
                <span class="sr-only"><?php esc_html_e('Previous', 'flavor-starter'); ?></span>
            </a>
            <?php endif; ?>

            <?php
            // Page numbers
            $range = 2;
            $show_dots = false;

            for ($i = 1; $i <= $total_pages; $i++):
                if ($i == 1 || $i == $total_pages || ($i >= $current_page - $range && $i <= $current_page + $range)):
                    $show_dots = true;
                    if ($i == $current_page):
                    ?>
                    <span class="pagination__item pagination__item--current"><?php echo $i; ?></span>
                    <?php else: ?>
                    <a href="<?php echo esc_url(get_pagenum_link($i)); ?>" class="pagination__item"><?php echo $i; ?></a>
                    <?php
                    endif;
                elseif ($show_dots):
                    $show_dots = false;
                    ?>
                    <span class="pagination__item pagination__item--dots">...</span>
                    <?php
                endif;
            endfor;

            // Next button
            if ($current_page < $total_pages):
            ?>
            <a href="<?php echo esc_url(get_pagenum_link($current_page + 1)); ?>" class="pagination__item pagination__item--next">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
                <span class="sr-only"><?php esc_html_e('Next', 'flavor-starter'); ?></span>
            </a>
            <?php endif; ?>
        </div>
    </nav>
    <?php
}

/**
 * Breadcrumbs
 */
function flavor_breadcrumbs(): void {
    if (is_front_page()) {
        return;
    }
    ?>
    <nav class="breadcrumb" aria-label="<?php esc_attr_e('Breadcrumb', 'flavor-starter'); ?>">
        <div class="container">
            <ol class="breadcrumb__list" itemscope itemtype="https://schema.org/BreadcrumbList">
                <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="<?php echo esc_url(home_url('/')); ?>" itemprop="item">
                        <span itemprop="name"><?php esc_html_e('Home', 'flavor-starter'); ?></span>
                    </a>
                    <meta itemprop="position" content="1">
                </li>

                <?php
                $position = 2;

                if (is_category() || is_single()):
                    $category = get_the_category();
                    if ($category):
                ?>
                <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span class="breadcrumb__separator">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </span>
                    <a href="<?php echo esc_url(get_category_link($category[0]->term_id)); ?>" itemprop="item">
                        <span itemprop="name"><?php echo esc_html($category[0]->name); ?></span>
                    </a>
                    <meta itemprop="position" content="<?php echo $position++; ?>">
                </li>
                <?php
                    endif;
                endif;

                if (is_single()):
                ?>
                <li class="breadcrumb__item breadcrumb__item--current" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span class="breadcrumb__separator">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </span>
                    <span itemprop="name"><?php the_title(); ?></span>
                    <meta itemprop="position" content="<?php echo $position; ?>">
                </li>
                <?php
                elseif (is_page()):
                    $ancestors = get_post_ancestors(get_the_ID());
                    $ancestors = array_reverse($ancestors);

                    foreach ($ancestors as $ancestor):
                ?>
                <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span class="breadcrumb__separator">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </span>
                    <a href="<?php echo esc_url(get_permalink($ancestor)); ?>" itemprop="item">
                        <span itemprop="name"><?php echo esc_html(get_the_title($ancestor)); ?></span>
                    </a>
                    <meta itemprop="position" content="<?php echo $position++; ?>">
                </li>
                <?php
                    endforeach;
                ?>
                <li class="breadcrumb__item breadcrumb__item--current" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span class="breadcrumb__separator">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </span>
                    <span itemprop="name"><?php the_title(); ?></span>
                    <meta itemprop="position" content="<?php echo $position; ?>">
                </li>
                <?php
                elseif (is_category()):
                ?>
                <li class="breadcrumb__item breadcrumb__item--current" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span class="breadcrumb__separator">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </span>
                    <span itemprop="name"><?php single_cat_title(); ?></span>
                    <meta itemprop="position" content="<?php echo $position; ?>">
                </li>
                <?php
                elseif (is_tag()):
                ?>
                <li class="breadcrumb__item breadcrumb__item--current" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span class="breadcrumb__separator">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </span>
                    <span itemprop="name"><?php single_tag_title(); ?></span>
                    <meta itemprop="position" content="<?php echo $position; ?>">
                </li>
                <?php
                elseif (is_search()):
                ?>
                <li class="breadcrumb__item breadcrumb__item--current" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span class="breadcrumb__separator">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </span>
                    <span itemprop="name"><?php printf(esc_html__('Search: %s', 'flavor-starter'), get_search_query()); ?></span>
                    <meta itemprop="position" content="<?php echo $position; ?>">
                </li>
                <?php
                elseif (is_archive()):
                ?>
                <li class="breadcrumb__item breadcrumb__item--current" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span class="breadcrumb__separator">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </span>
                    <span itemprop="name"><?php the_archive_title(); ?></span>
                    <meta itemprop="position" content="<?php echo $position; ?>">
                </li>
                <?php endif; ?>
            </ol>
        </div>
    </nav>
    <?php
}

/**
 * Reading time estimate
 */
function flavor_reading_time(int $post_id = 0): string {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $content = get_post_field('post_content', $post_id);
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // Average reading speed

    return sprintf(
        _n('%d min read', '%d min read', $reading_time, 'flavor-starter'),
        $reading_time
    );
}

/**
 * Get post views
 */
function flavor_get_post_views(int $post_id = 0): int {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    return (int) get_post_meta($post_id, 'post_views_count', true);
}

/**
 * Set post views
 */
function flavor_set_post_views(int $post_id = 0): void {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $count = flavor_get_post_views($post_id);
    update_post_meta($post_id, 'post_views_count', $count + 1);
}

/**
 * Track post views
 */
function flavor_track_post_views(): void {
    if (is_singular('post') && !is_preview()) {
        flavor_set_post_views(get_the_ID());
    }
}
add_action('wp_head', 'flavor_track_post_views');

/**
 * Format number (1000 -> 1K)
 */
function flavor_format_number(int $number): string {
    if ($number >= 1000000) {
        return round($number / 1000000, 1) . 'M';
    } elseif ($number >= 1000) {
        return round($number / 1000, 1) . 'K';
    }

    return (string) $number;
}

/**
 * Get excerpt by length
 */
function flavor_excerpt(int $length = 25, int $post_id = 0): string {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $post = get_post($post_id);
    $excerpt = $post->post_excerpt;

    if (empty($excerpt)) {
        $excerpt = $post->post_content;
    }

    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = wp_trim_words($excerpt, $length, '...');

    return $excerpt;
}

/**
 * Check if page has sidebar
 */
function flavor_has_sidebar(): bool {
    if (is_page_template('page-full-width.php')) {
        return false;
    }

    if (is_front_page()) {
        return false;
    }

    return is_active_sidebar('sidebar-1');
}

/**
 * Get content classes
 */
function flavor_content_classes(): string {
    $classes = ['site-content'];

    if (flavor_has_sidebar()) {
        $classes[] = 'has-sidebar';
    }

    return implode(' ', $classes);
}

/**
 * Placeholder image URL
 */
function flavor_placeholder_image(int $width = 800, int $height = 600): string {
    return "https://via.placeholder.com/{$width}x{$height}/f3f4f6/9ca3af?text=Image";
}

/**
 * Get featured image or placeholder
 */
function flavor_get_thumbnail_url(int $post_id = 0, string $size = 'large'): string {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    if (has_post_thumbnail($post_id)) {
        return get_the_post_thumbnail_url($post_id, $size);
    }

    // Get size dimensions
    $image_sizes = wp_get_registered_image_subsizes();
    $width = $image_sizes[$size]['width'] ?? 800;
    $height = $image_sizes[$size]['height'] ?? 600;

    return flavor_placeholder_image($width, $height);
}

/**
 * Truncate text
 */
function flavor_truncate(string $text, int $length = 100, string $append = '...'): string {
    if (strlen($text) <= $length) {
        return $text;
    }

    return substr($text, 0, $length) . $append;
}

/**
 * Get related posts
 */
function flavor_get_related_posts(int $post_id = 0, int $count = 3): WP_Query {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $categories = wp_get_post_categories($post_id);
    $tags = wp_get_post_tags($post_id, ['fields' => 'ids']);

    $args = [
        'post_type'      => 'post',
        'posts_per_page' => $count,
        'post__not_in'   => [$post_id],
        'orderby'        => 'rand',
    ];

    if (!empty($categories) || !empty($tags)) {
        $args['tax_query'] = ['relation' => 'OR'];

        if (!empty($categories)) {
            $args['tax_query'][] = [
                'taxonomy' => 'category',
                'field'    => 'term_id',
                'terms'    => $categories,
            ];
        }

        if (!empty($tags)) {
            $args['tax_query'][] = [
                'taxonomy' => 'post_tag',
                'field'    => 'term_id',
                'terms'    => $tags,
            ];
        }
    }

    return new WP_Query($args);
}

/**
 * SVG Icons helper
 */
function flavor_icon(string $name, int $size = 24): string {
    $icons = [
        'arrow-right' => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>',
        'arrow-left'  => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
        'check'       => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>',
        'x'           => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>',
        'menu'        => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>',
        'search'      => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
        'cart'        => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="m1 1 4 4 2 14h13l3-9H6"></path></svg>',
        'user'        => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>',
        'heart'       => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>',
        'star'        => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>',
        'star-empty'  => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>',
        'clock'       => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>',
        'calendar'    => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>',
        'eye'         => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>',
        'mail'        => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>',
        'phone'       => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>',
        'map-pin'     => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>',
        'external'    => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>',
        'download'    => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>',
        'play'        => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>',
        'quote'       => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="currentColor"><path d="M10 11H6a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v7c0 2.21-1.79 4-4 4H5a1 1 0 0 1 0-2h1c1.1 0 2-.9 2-2v-1zm10 0h-4a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v7c0 2.21-1.79 4-4 4h-1a1 1 0 0 1 0-2h1c1.1 0 2-.9 2-2v-1z"></path></svg>',
    ];

    return $icons[$name] ?? '';
}
