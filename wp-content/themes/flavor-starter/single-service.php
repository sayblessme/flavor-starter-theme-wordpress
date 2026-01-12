<?php
/**
 * The template for displaying single service pages
 *
 * @package Flavor_Starter
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php while (have_posts()) : the_post(); ?>

        <article id="service-<?php the_ID(); ?>" <?php post_class('service-single'); ?>>
            <!-- Hero Section -->
            <header class="service-hero">
                <div class="container">
                    <?php flavor_breadcrumb(); ?>

                    <div class="service-hero__grid">
                        <div class="service-hero__content">
                            <?php
                            $icon = function_exists('get_field') ? get_field('service_icon') : '';
                            if ($icon) :
                            ?>
                                <div class="service-hero__icon">
                                    <?php echo wp_kses($icon, ['svg' => ['width' => [], 'height' => [], 'viewbox' => [], 'fill' => [], 'xmlns' => []], 'path' => ['d' => [], 'fill' => [], 'stroke' => [], 'stroke-width' => [], 'stroke-linecap' => [], 'stroke-linejoin' => []], 'circle' => ['cx' => [], 'cy' => [], 'r' => [], 'fill' => [], 'stroke' => []], 'rect' => ['x' => [], 'y' => [], 'width' => [], 'height' => [], 'rx' => [], 'fill' => []], 'line' => ['x1' => [], 'y1' => [], 'x2' => [], 'y2' => [], 'stroke' => []]]); ?>
                                </div>
                            <?php endif; ?>

                            <h1 class="service-hero__title"><?php the_title(); ?></h1>

                            <?php
                            $subtitle = function_exists('get_field') ? get_field('service_subtitle') : '';
                            if ($subtitle) :
                            ?>
                                <p class="service-hero__subtitle"><?php echo esc_html($subtitle); ?></p>
                            <?php elseif (has_excerpt()) : ?>
                                <p class="service-hero__subtitle"><?php echo esc_html(get_the_excerpt()); ?></p>
                            <?php endif; ?>

                            <div class="service-hero__actions">
                                <a href="#contact" class="btn btn--primary btn--lg">
                                    <?php esc_html_e('Начать проект', 'flavor-starter'); ?>
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M5 12h14M12 5l7 7-7 7"/>
                                    </svg>
                                </a>
                                <a href="#features" class="btn btn--outline btn--lg">
                                    <?php esc_html_e('Подробнее', 'flavor-starter'); ?>
                                </a>
                            </div>
                        </div>

                        <?php if (has_post_thumbnail()) : ?>
                            <div class="service-hero__image">
                                <?php the_post_thumbnail('large', ['class' => 'service-hero__img']); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </header>

            <!-- Features Section -->
            <?php
            $features = function_exists('get_field') ? get_field('service_features') : [];
            if ($features) :
            ?>
                <section id="features" class="service-features section">
                    <div class="container">
                        <div class="section__header">
                            <h2 class="section-title"><?php esc_html_e('Что включено', 'flavor-starter'); ?></h2>
                            <p class="section-subtitle"><?php esc_html_e('Всё необходимое для успеха с нашей услугой', 'flavor-starter'); ?></p>
                        </div>

                        <div class="service-features__grid">
                            <?php foreach ($features as $index => $feature) : ?>
                                <div class="service-feature" data-animate="fade-in-up" data-animate-delay="<?php echo esc_attr($index * 100); ?>">
                                    <?php if (!empty($feature['icon'])) : ?>
                                        <div class="service-feature__icon">
                                            <?php echo wp_kses($feature['icon'], ['svg' => ['width' => [], 'height' => [], 'viewbox' => [], 'fill' => [], 'xmlns' => []], 'path' => ['d' => [], 'fill' => [], 'stroke' => [], 'stroke-width' => []], 'circle' => ['cx' => [], 'cy' => [], 'r' => [], 'fill' => []], 'rect' => ['x' => [], 'y' => [], 'width' => [], 'height' => [], 'rx' => [], 'fill' => []]]); ?>
                                        </div>
                                    <?php endif; ?>
                                    <h3 class="service-feature__title"><?php echo esc_html($feature['title']); ?></h3>
                                    <p class="service-feature__description"><?php echo esc_html($feature['description']); ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>
            <?php endif; ?>

            <!-- Content Section -->
            <?php if (get_the_content()) : ?>
                <section class="service-content section section--gray">
                    <div class="container">
                        <div class="service-content__wrapper">
                            <div class="entry-content">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                </section>
            <?php endif; ?>

            <!-- Process Section -->
            <?php
            $process = function_exists('get_field') ? get_field('service_process') : [];
            if ($process) :
            ?>
                <section class="service-process section">
                    <div class="container">
                        <div class="section__header">
                            <h2 class="section-title"><?php esc_html_e('Наш процесс', 'flavor-starter'); ?></h2>
                            <p class="section-subtitle"><?php esc_html_e('Как мы работаем для достижения исключительных результатов', 'flavor-starter'); ?></p>
                        </div>

                        <div class="service-process__grid">
                            <?php foreach ($process as $index => $step) : ?>
                                <div class="service-process__step" data-animate="fade-in-up" data-animate-delay="<?php echo esc_attr($index * 150); ?>">
                                    <div class="service-process__number"><?php echo esc_html(str_pad($index + 1, 2, '0', STR_PAD_LEFT)); ?></div>
                                    <h3 class="service-process__title"><?php echo esc_html($step['title']); ?></h3>
                                    <p class="service-process__description"><?php echo esc_html($step['description']); ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>
            <?php endif; ?>

            <!-- Pricing Section -->
            <?php
            $pricing = function_exists('get_field') ? get_field('service_pricing') : [];
            if ($pricing) :
            ?>
                <section class="service-pricing section section--gray">
                    <div class="container">
                        <div class="section__header">
                            <h2 class="section-title"><?php esc_html_e('Тарифы', 'flavor-starter'); ?></h2>
                            <p class="section-subtitle"><?php esc_html_e('Выберите план, который подходит вам', 'flavor-starter'); ?></p>
                        </div>

                        <div class="service-pricing__grid">
                            <?php foreach ($pricing as $index => $plan) : ?>
                                <div class="pricing-card <?php echo !empty($plan['featured']) ? 'pricing-card--featured' : ''; ?>">
                                    <?php if (!empty($plan['featured'])) : ?>
                                        <div class="pricing-card__badge"><?php esc_html_e('Популярный', 'flavor-starter'); ?></div>
                                    <?php endif; ?>

                                    <div class="pricing-card__header">
                                        <h3 class="pricing-card__title"><?php echo esc_html($plan['title']); ?></h3>
                                        <p class="pricing-card__description"><?php echo esc_html($plan['description']); ?></p>
                                    </div>

                                    <div class="pricing-card__price">
                                        <span class="pricing-card__amount"><?php echo esc_html($plan['price']); ?></span>
                                        <span class="pricing-card__currency">₽</span>
                                        <span class="pricing-card__period">/<?php echo esc_html($plan['period'] ?? 'месяц'); ?></span>
                                    </div>

                                    <?php if (!empty($plan['features'])) : ?>
                                        <ul class="pricing-card__features">
                                            <?php foreach ($plan['features'] as $feature) : ?>
                                                <li>
                                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                        <polyline points="20,6 9,17 4,12"/>
                                                    </svg>
                                                    <?php echo esc_html($feature['text']); ?>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>

                                    <a href="<?php echo esc_url($plan['button_url'] ?? '#contact'); ?>" class="btn <?php echo !empty($plan['featured']) ? 'btn--primary' : 'btn--outline'; ?> btn--block">
                                        <?php echo esc_html($plan['button_text'] ?? __('Заказать', 'flavor-starter')); ?>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>
            <?php endif; ?>

            <!-- Related Cases -->
            <?php
            $related_cases = new WP_Query([
                'post_type' => 'case',
                'posts_per_page' => 3,
                'meta_query' => [
                    [
                        'key' => 'case_service',
                        'value' => get_the_ID(),
                        'compare' => '=',
                    ],
                ],
            ]);

            if ($related_cases->have_posts()) :
            ?>
                <section class="service-cases section">
                    <div class="container">
                        <div class="section__header">
                            <h2 class="section-title"><?php esc_html_e('Связанные проекты', 'flavor-starter'); ?></h2>
                            <p class="section-subtitle"><?php esc_html_e('Посмотрите, как мы помогли нашим клиентам достичь успеха', 'flavor-starter'); ?></p>
                        </div>

                        <div class="portfolio__grid">
                            <?php
                            while ($related_cases->have_posts()) :
                                $related_cases->the_post();
                                get_template_part('template-parts/content', 'case-card');
                            endwhile;
                            wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                </section>
            <?php endif; ?>

            <!-- FAQ Section -->
            <?php
            $faqs = function_exists('get_field') ? get_field('service_faqs') : [];
            if ($faqs) :
            ?>
                <section class="service-faq section section--gray">
                    <div class="container">
                        <div class="section__header">
                            <h2 class="section-title"><?php esc_html_e('Частые вопросы', 'flavor-starter'); ?></h2>
                        </div>

                        <div class="faq__list">
                            <?php foreach ($faqs as $faq) : ?>
                                <div class="faq__item">
                                    <button class="faq__item-question" aria-expanded="false">
                                        <?php echo esc_html($faq['question']); ?>
                                        <svg class="faq__item-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M6 9l6 6 6-6"/>
                                        </svg>
                                    </button>
                                    <div class="faq__item-answer">
                                        <p><?php echo wp_kses_post($faq['answer']); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>
            <?php endif; ?>

            <!-- CTA Section -->
            <section id="contact" class="service-cta section section--dark">
                <div class="container">
                    <div class="service-cta__content">
                        <h2 class="service-cta__title"><?php esc_html_e('Готовы начать?', 'flavor-starter'); ?></h2>
                        <p class="service-cta__description">
                            <?php esc_html_e('Давайте обсудим, как мы можем помочь вам достичь ваших целей.', 'flavor-starter'); ?>
                        </p>
                        <div class="service-cta__actions">
                            <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--white btn--lg">
                                <?php esc_html_e('Связаться с нами', 'flavor-starter'); ?>
                            </a>
                            <a href="tel:<?php echo esc_attr(flavor_get_option('phone')); ?>" class="btn btn--outline-white btn--lg">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/>
                                </svg>
                                <?php esc_html_e('Позвонить', 'flavor-starter'); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </article>

    <?php endwhile; ?>
</main>

<?php
get_footer();
