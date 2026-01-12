<?php
/**
 * Portfolio/Cases Section Template
 *
 * @package Flavor_Starter
 * @since 1.0.0
 */

$cases = new WP_Query([
    'post_type'      => 'case',
    'posts_per_page' => 6,
    'orderby'        => 'date',
    'order'          => 'DESC',
]);

// Get categories for filter
$case_categories = get_terms([
    'taxonomy'   => 'case_category',
    'hide_empty' => true,
]);

// Default cases if none exist
$default_cases = [
    [
        'title'    => 'E-Commerce Platform',
        'category' => 'Web Development',
        'client'   => 'TechStore Inc.',
        'color'    => '#6366f1',
    ],
    [
        'title'    => 'Mobile Banking App',
        'category' => 'Mobile App',
        'client'   => 'FinanceHub',
        'color'    => '#ec4899',
    ],
    [
        'title'    => 'Brand Identity Design',
        'category' => 'Branding',
        'client'   => 'StartupX',
        'color'    => '#14b8a6',
    ],
    [
        'title'    => 'SaaS Dashboard',
        'category' => 'UI/UX Design',
        'client'   => 'DataFlow',
        'color'    => '#f59e0b',
    ],
    [
        'title'    => 'Corporate Website',
        'category' => 'Web Development',
        'client'   => 'Global Corp',
        'color'    => '#8b5cf6',
    ],
    [
        'title'    => 'Restaurant App',
        'category' => 'Mobile App',
        'client'   => 'FoodDelivery',
        'color'    => '#ef4444',
    ],
];
?>

<section class="portfolio-section section" id="portfolio">
    <div class="container">
        <div class="section-header fade-in">
            <span class="section-label"><?php esc_html_e('Our Work', 'flavor-starter'); ?></span>
            <h2 class="section-title"><?php esc_html_e('Featured Projects', 'flavor-starter'); ?></h2>
            <p class="section-description">
                <?php esc_html_e('Explore our latest work and see how we help businesses achieve their goals through innovative digital solutions.', 'flavor-starter'); ?>
            </p>
        </div>

        <?php if (!empty($case_categories) && !is_wp_error($case_categories)): ?>
        <!-- Filter Buttons -->
        <div class="portfolio-filter fade-in">
            <button type="button" class="portfolio-filter__btn is-active" data-filter="all">
                <?php esc_html_e('All', 'flavor-starter'); ?>
            </button>
            <?php foreach ($case_categories as $category): ?>
            <button type="button" class="portfolio-filter__btn" data-filter="<?php echo esc_attr($category->slug); ?>">
                <?php echo esc_html($category->name); ?>
            </button>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if ($cases->have_posts()): ?>
        <div class="portfolio-grid" data-portfolio-grid>
            <?php while ($cases->have_posts()): $cases->the_post();
                $categories = get_the_terms(get_the_ID(), 'case_category');
                $category_slugs = [];
                $category_name = '';
                if ($categories && !is_wp_error($categories)) {
                    foreach ($categories as $cat) {
                        $category_slugs[] = $cat->slug;
                    }
                    $category_name = $categories[0]->name;
                }

                $client = '';
                $case_color = '#6366f1';
                if (function_exists('get_field')) {
                    $client = get_field('case_client');
                    $case_color = get_field('case_color') ?: '#6366f1';
                }
            ?>
            <article class="portfolio-item fade-in" data-category="<?php echo esc_attr(implode(' ', $category_slugs)); ?>">
                <a href="<?php the_permalink(); ?>" class="portfolio-item__link">
                    <div class="portfolio-item__image" style="--accent-color: <?php echo esc_attr($case_color); ?>">
                        <?php if (has_post_thumbnail()): ?>
                            <?php the_post_thumbnail('flavor-card-wide', ['class' => 'img-cover']); ?>
                        <?php else: ?>
                            <div class="portfolio-item__placeholder">
                                <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                    <polyline points="21 15 16 10 5 21"></polyline>
                                </svg>
                            </div>
                        <?php endif; ?>
                        <div class="portfolio-item__overlay">
                            <span class="portfolio-item__view">
                                <?php echo flavor_icon('eye', 28); ?>
                            </span>
                        </div>
                    </div>
                    <div class="portfolio-item__content">
                        <?php if ($category_name): ?>
                        <span class="portfolio-item__category"><?php echo esc_html($category_name); ?></span>
                        <?php endif; ?>
                        <h3 class="portfolio-item__title"><?php the_title(); ?></h3>
                        <?php if ($client): ?>
                        <span class="portfolio-item__client"><?php echo esc_html($client); ?></span>
                        <?php endif; ?>
                    </div>
                </a>
            </article>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </div>
        <?php else: ?>
        <!-- Default Portfolio Items -->
        <div class="portfolio-grid" data-portfolio-grid>
            <?php foreach ($default_cases as $index => $case): ?>
            <article class="portfolio-item fade-in stagger-<?php echo ($index % 3) + 1; ?>">
                <a href="<?php echo esc_url(get_post_type_archive_link('case')); ?>" class="portfolio-item__link">
                    <div class="portfolio-item__image" style="--accent-color: <?php echo esc_attr($case['color']); ?>">
                        <div class="portfolio-item__placeholder" style="background: linear-gradient(135deg, <?php echo esc_attr($case['color']); ?> 0%, <?php echo esc_attr($case['color']); ?>88 100%);">
                            <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                <polyline points="21 15 16 10 5 21"></polyline>
                            </svg>
                        </div>
                        <div class="portfolio-item__overlay">
                            <span class="portfolio-item__view">
                                <?php echo flavor_icon('eye', 28); ?>
                            </span>
                        </div>
                    </div>
                    <div class="portfolio-item__content">
                        <span class="portfolio-item__category"><?php echo esc_html($case['category']); ?></span>
                        <h3 class="portfolio-item__title"><?php echo esc_html($case['title']); ?></h3>
                        <span class="portfolio-item__client"><?php echo esc_html($case['client']); ?></span>
                    </div>
                </a>
            </article>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <div class="portfolio-cta text-center fade-in">
            <a href="<?php echo esc_url(get_post_type_archive_link('case')); ?>" class="btn btn-primary btn-lg">
                <?php esc_html_e('View All Projects', 'flavor-starter'); ?>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="btn-arrow">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </a>
        </div>
    </div>
</section>
