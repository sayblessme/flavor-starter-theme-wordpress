<?php
/**
 * CTA Section Template
 *
 * @package Flavor_Starter
 * @since 1.0.0
 */

// Get ACF fields
$cta_title = '';
$cta_description = '';
$cta_button_text = '';
$cta_button_url = '';

if (function_exists('get_field')) {
    $cta_title = get_field('cta_title') ?: 'Готовы начать проект?';
    $cta_description = get_field('cta_description') ?: 'Давайте работать вместе над созданием чего-то удивительного. Свяжитесь с нами сегодня.';
    $cta_button_text = get_field('cta_button_text') ?: 'Связаться с нами';
    $cta_button_url = get_field('cta_button_url') ?: get_permalink(get_page_by_path('contact'));
} else {
    $cta_title = 'Готовы начать проект?';
    $cta_description = 'Давайте работать вместе над созданием чего-то удивительного. Свяжитесь с нами сегодня.';
    $cta_button_text = 'Связаться с нами';
    $cta_button_url = get_permalink(get_page_by_path('contact'));
}
?>

<section class="cta-section section-lg section-gradient section-dark" id="cta">
    <div class="cta-background">
        <div class="cta-pattern"></div>
        <div class="cta-glow cta-glow--1"></div>
        <div class="cta-glow cta-glow--2"></div>
    </div>

    <div class="container">
        <div class="cta-content text-center fade-in">
            <h2 class="cta-title"><?php echo esc_html($cta_title); ?></h2>
            <p class="cta-description"><?php echo esc_html($cta_description); ?></p>
            <div class="cta-actions">
                <a href="<?php echo esc_url($cta_button_url); ?>" class="btn btn-white btn-xl">
                    <?php echo esc_html($cta_button_text); ?>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="btn-arrow">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
                <span class="cta-or"><?php esc_html_e('или', 'flavor-starter'); ?></span>
                <a href="<?php echo esc_url(get_post_type_archive_link('case')); ?>" class="btn btn-outline btn-xl cta-secondary">
                    <?php esc_html_e('Наши работы', 'flavor-starter'); ?>
                </a>
            </div>

            <!-- Trust indicators -->
            <div class="cta-trust">
                <div class="cta-trust__item">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                    <span><?php esc_html_e('Бесплатная консультация', 'flavor-starter'); ?></span>
                </div>
                <div class="cta-trust__item">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    <span><?php esc_html_e('Быстрый ответ', 'flavor-starter'); ?></span>
                </div>
                <div class="cta-trust__item">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                    <span><?php esc_html_e('Защита NDA', 'flavor-starter'); ?></span>
                </div>
            </div>
        </div>
    </div>
</section>
