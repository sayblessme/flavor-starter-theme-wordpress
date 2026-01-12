<?php
/**
 * Hero Section Template
 *
 * @package Flavor_Starter
 * @since 1.0.0
 */

// Get ACF fields
$hero_title = '';
$hero_subtitle = '';
$hero_image = '';
$hero_cta_text = '';
$hero_cta_url = '';

if (function_exists('get_field')) {
    $hero_title = get_field('hero_title') ?: 'We Create Digital Experiences That Matter';
    $hero_subtitle = get_field('hero_subtitle') ?: 'Award-winning design studio crafting beautiful digital products, immersive brand experiences, and scalable technology solutions.';
    $hero_image = get_field('hero_image');
    $hero_cta_text = get_field('hero_cta_text') ?: 'View Our Work';
    $hero_cta_url = get_field('hero_cta_url') ?: get_post_type_archive_link('case');
} else {
    $hero_title = 'We Create Digital Experiences That Matter';
    $hero_subtitle = 'Award-winning design studio crafting beautiful digital products, immersive brand experiences, and scalable technology solutions.';
    $hero_cta_text = 'View Our Work';
    $hero_cta_url = get_post_type_archive_link('case');
}
?>

<section class="hero-section section-lg" id="hero">
    <div class="hero-background">
        <div class="hero-gradient"></div>
        <div class="hero-pattern"></div>
    </div>

    <div class="container">
        <div class="hero-content">
            <div class="hero-text fade-in">
                <span class="hero-label"><?php esc_html_e('Welcome to Flavor Starter', 'flavor-starter'); ?></span>
                <h1 class="hero-title">
                    <?php echo wp_kses_post($hero_title); ?>
                </h1>
                <p class="hero-subtitle">
                    <?php echo esc_html($hero_subtitle); ?>
                </p>
                <div class="hero-actions">
                    <a href="<?php echo esc_url($hero_cta_url); ?>" class="btn btn-primary btn-xl">
                        <?php echo esc_html($hero_cta_text); ?>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="btn-arrow">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                    <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>" class="btn btn-outline btn-xl">
                        <?php esc_html_e('Get in Touch', 'flavor-starter'); ?>
                    </a>
                </div>

                <!-- Trust Badges -->
                <div class="hero-trust">
                    <div class="hero-trust__avatars">
                        <div class="hero-trust__avatar">
                            <img src="<?php echo esc_url(FLAVOR_ASSETS . '/images/avatar-1.jpg'); ?>" alt="">
                        </div>
                        <div class="hero-trust__avatar">
                            <img src="<?php echo esc_url(FLAVOR_ASSETS . '/images/avatar-2.jpg'); ?>" alt="">
                        </div>
                        <div class="hero-trust__avatar">
                            <img src="<?php echo esc_url(FLAVOR_ASSETS . '/images/avatar-3.jpg'); ?>" alt="">
                        </div>
                        <div class="hero-trust__avatar hero-trust__avatar--more">
                            +50
                        </div>
                    </div>
                    <div class="hero-trust__text">
                        <div class="hero-trust__stars">
                            <?php for ($i = 0; $i < 5; $i++): ?>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                            <?php endfor; ?>
                        </div>
                        <span><?php esc_html_e('Trusted by 50+ clients worldwide', 'flavor-starter'); ?></span>
                    </div>
                </div>
            </div>

            <div class="hero-visual fade-in stagger-2">
                <div class="hero-image-wrapper">
                    <?php if ($hero_image): ?>
                        <img src="<?php echo esc_url($hero_image['url']); ?>"
                             alt="<?php echo esc_attr($hero_image['alt']); ?>"
                             class="hero-image">
                    <?php else: ?>
                        <div class="hero-placeholder">
                            <div class="hero-placeholder__content">
                                <div class="hero-placeholder__browser">
                                    <div class="hero-placeholder__dots">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </div>
                                <div class="hero-placeholder__screen">
                                    <div class="hero-placeholder__sidebar"></div>
                                    <div class="hero-placeholder__main">
                                        <div class="hero-placeholder__block"></div>
                                        <div class="hero-placeholder__block hero-placeholder__block--wide"></div>
                                        <div class="hero-placeholder__block hero-placeholder__block--tall"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Floating Elements -->
                    <div class="hero-float hero-float--1">
                        <div class="hero-float__card">
                            <div class="hero-float__icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                </svg>
                            </div>
                            <div class="hero-float__text">
                                <span class="hero-float__title">Project Completed</span>
                                <span class="hero-float__subtitle">E-commerce Platform</span>
                            </div>
                        </div>
                    </div>

                    <div class="hero-float hero-float--2">
                        <div class="hero-float__stat">
                            <span class="hero-float__number" data-count="98">0</span>
                            <span class="hero-float__percent">%</span>
                            <span class="hero-float__label"><?php esc_html_e('Client Satisfaction', 'flavor-starter'); ?></span>
                        </div>
                    </div>

                    <div class="hero-float hero-float--3">
                        <div class="hero-float__badge">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                            </svg>
                            <span><?php esc_html_e('Top Rated', 'flavor-starter'); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="hero-scroll">
        <a href="#about" class="hero-scroll__link">
            <span class="hero-scroll__text"><?php esc_html_e('Scroll to explore', 'flavor-starter'); ?></span>
            <span class="hero-scroll__icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <polyline points="19 12 12 19 5 12"></polyline>
                </svg>
            </span>
        </a>
    </div>
</section>
