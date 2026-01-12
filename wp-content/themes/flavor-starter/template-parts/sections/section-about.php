<?php
/**
 * About Section Template
 *
 * @package Flavor_Starter
 * @since 1.0.0
 */

// Get ACF fields
$about_label = '';
$about_title = '';
$about_description = '';
$about_image = '';

if (function_exists('get_field')) {
    $about_label = get_field('about_label') ?: 'О нас';
    $about_title = get_field('about_title') ?: 'Цифровая студия с душой';
    $about_description = get_field('about_description');
    $about_image = get_field('about_image');
}

if (!$about_label) $about_label = 'О нас';
if (!$about_title) $about_title = 'Цифровая студия с душой';
if (!$about_description) {
    $about_description = '<p>Мы — команда увлечённых дизайнеров, разработчиков и стратегов, которые создают исключительные цифровые решения. С более чем десятилетним опытом мы помогли бизнесам любого масштаба преобразить их онлайн-присутствие.</p><p>Наш подход сочетает передовые технологии с проверенными временем принципами дизайна, гарантируя, что каждый проект не только выглядит потрясающе, но и работает безупречно.</p>';
}
?>

<section class="about-section section" id="about">
    <div class="container">
        <div class="about-grid">
            <!-- About Image -->
            <div class="about-image-wrapper slide-left">
                <div class="about-image">
                    <?php if ($about_image): ?>
                        <img src="<?php echo esc_url($about_image['url']); ?>"
                             alt="<?php echo esc_attr($about_image['alt']); ?>"
                             class="img-cover">
                    <?php else: ?>
                        <div class="about-image__placeholder">
                            <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                <polyline points="21 15 16 10 5 21"></polyline>
                            </svg>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Experience Badge -->
                <div class="about-badge">
                    <span class="about-badge__number">10+</span>
                    <span class="about-badge__text"><?php esc_html_e('Лет опыта', 'flavor-starter'); ?></span>
                </div>
            </div>

            <!-- About Content -->
            <div class="about-content slide-right">
                <div class="section-header text-left">
                    <span class="section-label"><?php echo esc_html($about_label); ?></span>
                    <h2 class="section-title"><?php echo esc_html($about_title); ?></h2>
                </div>

                <div class="about-text">
                    <?php echo wp_kses_post($about_description); ?>
                </div>

                <!-- Features List -->
                <div class="about-features">
                    <div class="about-feature">
                        <div class="about-feature__icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
                        </div>
                        <div class="about-feature__content">
                            <h4><?php esc_html_e('Качество прежде всего', 'flavor-starter'); ?></h4>
                            <p><?php esc_html_e('Мы никогда не идём на компромисс в качестве, создавая идеальные решения.', 'flavor-starter'); ?></p>
                        </div>
                    </div>

                    <div class="about-feature">
                        <div class="about-feature__icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                        </div>
                        <div class="about-feature__content">
                            <h4><?php esc_html_e('Точно в срок', 'flavor-starter'); ?></h4>
                            <p><?php esc_html_e('Мы уважаем сроки и сдаём проекты вовремя.', 'flavor-starter'); ?></p>
                        </div>
                    </div>

                    <div class="about-feature">
                        <div class="about-feature__icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                        </div>
                        <div class="about-feature__content">
                            <h4><?php esc_html_e('Полная поддержка', 'flavor-starter'); ?></h4>
                            <p><?php esc_html_e('Наша команда всегда готова помочь вам добиться успеха.', 'flavor-starter'); ?></p>
                        </div>
                    </div>
                </div>

                <div class="about-cta">
                    <a href="<?php echo esc_url(get_permalink(get_page_by_path('about'))); ?>" class="btn btn-primary">
                        <?php esc_html_e('Узнать больше о нас', 'flavor-starter'); ?>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="btn-arrow">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
