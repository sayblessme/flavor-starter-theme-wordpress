<?php
/**
 * FAQ Section Template
 *
 * @package Flavor_Starter
 * @since 1.0.0
 */

$faqs = new WP_Query([
    'post_type'      => 'faq',
    'posts_per_page' => 6,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
]);

// Default FAQs if none exist
$default_faqs = [
    [
        'question' => 'Какие услуги вы предлагаете?',
        'answer'   => 'Мы предлагаем комплексный спектр цифровых услуг, включая веб-разработку, UI/UX дизайн, e-commerce решения, разработку мобильных приложений, брендинг и цифровой маркетинг. Каждая услуга адаптируется под ваши конкретные потребности.',
    ],
    [
        'question' => 'Сколько времени занимает типичный проект?',
        'answer'   => 'Сроки проекта варьируются в зависимости от сложности и масштаба. Простой сайт обычно занимает 4-6 недель, а более сложные e-commerce или кастомные приложения могут потребовать 8-12 недель или больше. Мы предоставляем детальные сроки на этапе предложения.',
    ],
    [
        'question' => 'Какова ваша ценовая политика?',
        'answer'   => 'Мы предлагаем как фиксированную цену, так и почасовую оплату в зависимости от типа проекта. Фиксированная цена подходит для чётко определённых проектов, а почасовая оплата — для ongoing работы или проектов с изменяющимися требованиями.',
    ],
    [
        'question' => 'Вы предоставляете техническую поддержку?',
        'answer'   => 'Да, мы предлагаем гибкие пакеты поддержки и обслуживания, чтобы ваши цифровые продукты оставались безопасными, актуальными и работали оптимально. Наши планы поддержки включают регулярные обновления, мониторинг безопасности и приоритетную помощь.',
    ],
    [
        'question' => 'Можете ли вы работать с нашей командой?',
        'answer'   => 'Безусловно! Мы часто сотрудничаем с внутренними командами и другими агентствами. Мы можем легко интегрироваться в ваш рабочий процесс, будь то руководство проектом или поддержка ваших существующих усилий.',
    ],
    [
        'question' => 'С какими технологиями вы работаете?',
        'answer'   => 'Мы работаем с широким спектром современных технологий, включая WordPress, WooCommerce, React, Vue.js, Node.js, PHP и различные облачные платформы. Мы выбираем лучший технологический стек на основе требований вашего проекта.',
    ],
];
?>

<section class="faq-section section" id="faq">
    <div class="container container-lg">
        <div class="section-header fade-in">
            <span class="section-label"><?php esc_html_e('Вопросы и ответы', 'flavor-starter'); ?></span>
            <h2 class="section-title"><?php esc_html_e('Часто задаваемые вопросы', 'flavor-starter'); ?></h2>
            <p class="section-description">
                <?php esc_html_e('Найдите ответы на распространённые вопросы о наших услугах и процессе работы.', 'flavor-starter'); ?>
            </p>
        </div>

        <div class="faq-accordion fade-in" data-accordion>
            <?php if ($faqs->have_posts()): ?>
                <?php while ($faqs->have_posts()): $faqs->the_post(); ?>
                <div class="faq-item" data-accordion-item>
                    <button type="button" class="faq-item__header" data-accordion-trigger aria-expanded="false">
                        <span class="faq-item__question"><?php the_title(); ?></span>
                        <span class="faq-item__icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="12" y1="5" x2="12" y2="19" class="faq-item__icon-vertical"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                        </span>
                    </button>
                    <div class="faq-item__content" data-accordion-content>
                        <div class="faq-item__answer">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php else: ?>
                <?php foreach ($default_faqs as $faq): ?>
                <div class="faq-item" data-accordion-item>
                    <button type="button" class="faq-item__header" data-accordion-trigger aria-expanded="false">
                        <span class="faq-item__question"><?php echo esc_html($faq['question']); ?></span>
                        <span class="faq-item__icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="12" y1="5" x2="12" y2="19" class="faq-item__icon-vertical"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                        </span>
                    </button>
                    <div class="faq-item__content" data-accordion-content>
                        <div class="faq-item__answer">
                            <p><?php echo esc_html($faq['answer']); ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="faq-cta text-center fade-in">
            <p class="faq-cta__text"><?php esc_html_e('Остались вопросы?', 'flavor-starter'); ?></p>
            <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>" class="btn btn-primary">
                <?php esc_html_e('Связаться с нами', 'flavor-starter'); ?>
            </a>
        </div>
    </div>
</section>
