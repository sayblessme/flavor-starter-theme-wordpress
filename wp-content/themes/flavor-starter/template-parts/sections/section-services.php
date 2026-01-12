<?php
/**
 * Services Section Template
 *
 * @package Flavor_Starter
 * @since 1.0.0
 */

$services = new WP_Query([
    'post_type'      => 'service',
    'posts_per_page' => 6,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
]);

// Default services if no custom services exist
$default_services = [
    [
        'title' => 'Веб-разработка',
        'icon'  => '<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg>',
        'desc'  => 'Создание сайтов и веб-приложений на современных технологиях для оптимальной производительности и масштабируемости.',
    ],
    [
        'title' => 'UI/UX дизайн',
        'icon'  => '<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 19l7-7 3 3-7 7-3-3z"></path><path d="M18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5-5z"></path><path d="M2 2l7.586 7.586"></path><circle cx="11" cy="11" r="2"></circle></svg>',
        'desc'  => 'Дизайн-решения, ориентированные на пользователя, создающие интуитивные и вовлекающие интерфейсы.',
    ],
    [
        'title' => 'Интернет-магазины',
        'icon'  => '<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="m1 1 4 4 2 14h13l3-9H6"></path></svg>',
        'desc'  => 'Мощные онлайн-магазины на WooCommerce, увеличивающие продажи и обеспечивающие удобный шопинг.',
    ],
    [
        'title' => 'Мобильные приложения',
        'icon'  => '<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect><line x1="12" y1="18" x2="12.01" y2="18"></line></svg>',
        'desc'  => 'Нативные и кроссплатформенные мобильные приложения, вовлекающие пользователей и расширяющие цифровое присутствие.',
    ],
    [
        'title' => 'Брендинг',
        'icon'  => '<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>',
        'desc'  => 'Стратегический дизайн фирменного стиля, передающий вашу уникальную ценность и связывающий с аудиторией.',
    ],
    [
        'title' => 'Цифровой маркетинг',
        'icon'  => '<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M22 12h-4l-3 9L9 3l-3 9H2"></path></svg>',
        'desc'  => 'Маркетинговые стратегии на основе данных, увеличивающие видимость, трафик и конверсии.',
    ],
];
?>

<section class="services-section section bg-gray-50" id="services">
    <div class="container">
        <div class="section-header fade-in">
            <span class="section-label"><?php esc_html_e('Что мы делаем', 'flavor-starter'); ?></span>
            <h2 class="section-title"><?php esc_html_e('Наши услуги', 'flavor-starter'); ?></h2>
            <p class="section-description">
                <?php esc_html_e('Мы предоставляем комплексные цифровые решения, чтобы помочь вашему бизнесу процветать в современном мире.', 'flavor-starter'); ?>
            </p>
        </div>

        <?php if ($services->have_posts()): ?>
        <div class="services-grid grid grid-cols-3">
            <?php while ($services->have_posts()): $services->the_post(); ?>
            <article class="service-card card card-bordered hover-lift fade-in">
                <div class="card-body">
                    <?php
                    $icon = '';
                    if (function_exists('get_field')) {
                        $icon = get_field('service_icon');
                    }
                    if ($icon):
                    ?>
                    <div class="service-card__icon">
                        <?php echo $icon; ?>
                    </div>
                    <?php endif; ?>

                    <h3 class="service-card__title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>

                    <?php
                    $short_desc = '';
                    if (function_exists('get_field')) {
                        $short_desc = get_field('service_short_desc');
                    }
                    if (!$short_desc) {
                        $short_desc = get_the_excerpt();
                    }
                    ?>
                    <p class="service-card__description"><?php echo esc_html($short_desc); ?></p>

                    <a href="<?php the_permalink(); ?>" class="service-card__link">
                        <?php esc_html_e('Подробнее', 'flavor-starter'); ?>
                        <?php echo flavor_icon('arrow-right', 18); ?>
                    </a>
                </div>
            </article>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </div>
        <?php else: ?>
        <!-- Default Services -->
        <div class="services-grid grid grid-cols-3">
            <?php foreach ($default_services as $index => $service): ?>
            <article class="service-card card card-bordered hover-lift fade-in stagger-<?php echo ($index % 3) + 1; ?>">
                <div class="card-body">
                    <div class="service-card__icon">
                        <?php echo $service['icon']; ?>
                    </div>
                    <h3 class="service-card__title">
                        <?php echo esc_html($service['title']); ?>
                    </h3>
                    <p class="service-card__description">
                        <?php echo esc_html($service['desc']); ?>
                    </p>
                    <a href="<?php echo esc_url(get_post_type_archive_link('service')); ?>" class="service-card__link">
                        <?php esc_html_e('Подробнее', 'flavor-starter'); ?>
                        <?php echo flavor_icon('arrow-right', 18); ?>
                    </a>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <div class="services-cta text-center fade-in">
            <a href="<?php echo esc_url(get_post_type_archive_link('service')); ?>" class="btn btn-outline btn-lg">
                <?php esc_html_e('Все услуги', 'flavor-starter'); ?>
            </a>
        </div>
    </div>
</section>
