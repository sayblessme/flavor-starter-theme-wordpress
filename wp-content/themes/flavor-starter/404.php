<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Flavor_Starter
 */

get_header();
?>

<main id="primary" class="site-main">
    <section class="error-404 not-found">
        <div class="container">
            <div class="error-404__content">
                <div class="error-404__number">404</div>

                <h1 class="error-404__title"><?php esc_html_e('Страница не найдена', 'flavor-starter'); ?></h1>

                <p class="error-404__description">
                    <?php
                    $custom_message = flavor_get_option('404_message');
                    if ($custom_message) :
                        echo esc_html($custom_message);
                    else :
                        esc_html_e('Упс! Страница, которую вы ищете, могла быть удалена, переименована или временно недоступна.', 'flavor-starter');
                    endif;
                    ?>
                </p>

                <div class="error-404__search">
                    <p><?php esc_html_e('Попробуйте найти то, что вам нужно:', 'flavor-starter'); ?></p>
                    <?php get_search_form(); ?>
                </div>

                <div class="error-404__links">
                    <p><?php esc_html_e('Или посмотрите эти ссылки:', 'flavor-starter'); ?></p>

                    <div class="error-404__links-grid">
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="error-404__link">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                                <polyline points="9,22 9,12 15,12 15,22"/>
                            </svg>
                            <span><?php esc_html_e('Главная', 'flavor-starter'); ?></span>
                        </a>

                        <?php if (class_exists('WooCommerce')) : ?>
                            <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="error-404__link">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="9" cy="21" r="1"/>
                                    <circle cx="20" cy="21" r="1"/>
                                    <path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/>
                                </svg>
                                <span><?php esc_html_e('Магазин', 'flavor-starter'); ?></span>
                            </a>
                        <?php endif; ?>

                        <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="error-404__link">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M4 19.5A2.5 2.5 0 016.5 17H20"/>
                                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/>
                            </svg>
                            <span><?php esc_html_e('Блог', 'flavor-starter'); ?></span>
                        </a>

                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="error-404__link">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <polyline points="22,6 12,13 2,6"/>
                            </svg>
                            <span><?php esc_html_e('Контакты', 'flavor-starter'); ?></span>
                        </a>
                    </div>
                </div>

                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn--primary btn--lg">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                    <?php esc_html_e('Вернуться на главную', 'flavor-starter'); ?>
                </a>
            </div>
        </div>
    </section>
</main>

<style>
.error-404 {
    min-height: calc(100vh - var(--header-height));
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: var(--space-16) 0;
}

.error-404__content {
    max-width: 600px;
    margin: 0 auto;
}

.error-404__number {
    font-size: clamp(8rem, 20vw, 12rem);
    font-weight: 800;
    line-height: 1;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: var(--space-4);
}

.error-404__title {
    font-size: var(--text-3xl);
    font-weight: 700;
    color: var(--gray-900);
    margin-bottom: var(--space-4);
}

.error-404__description {
    font-size: var(--text-lg);
    color: var(--gray-600);
    margin-bottom: var(--space-8);
    line-height: 1.7;
}

.error-404__search {
    margin-bottom: var(--space-8);
}

.error-404__search p {
    font-size: var(--text-sm);
    color: var(--gray-500);
    margin-bottom: var(--space-3);
}

.error-404__search .search-form {
    display: flex;
    max-width: 400px;
    margin: 0 auto;
}

.error-404__search .search-field {
    flex: 1;
    padding: var(--space-3) var(--space-4);
    border: 1px solid var(--gray-200);
    border-right: none;
    border-radius: var(--radius-lg) 0 0 var(--radius-lg);
    font-size: var(--text-base);
}

.error-404__search .search-submit {
    padding: var(--space-3) var(--space-5);
    background: var(--primary);
    color: var(--white);
    border: none;
    border-radius: 0 var(--radius-lg) var(--radius-lg) 0;
    font-weight: 600;
    cursor: pointer;
    transition: background var(--transition-fast);
}

.error-404__search .search-submit:hover {
    background: var(--primary-dark);
}

.error-404__links {
    margin-bottom: var(--space-8);
}

.error-404__links > p {
    font-size: var(--text-sm);
    color: var(--gray-500);
    margin-bottom: var(--space-4);
}

.error-404__links-grid {
    display: flex;
    justify-content: center;
    gap: var(--space-4);
    flex-wrap: wrap;
}

.error-404__link {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: var(--space-2);
    padding: var(--space-4);
    background: var(--gray-50);
    border-radius: var(--radius-lg);
    color: var(--gray-700);
    text-decoration: none;
    transition: all var(--transition-fast);
    min-width: 100px;
}

.error-404__link:hover {
    background: var(--primary);
    color: var(--white);
    transform: translateY(-2px);
}

.error-404__link svg {
    width: 24px;
    height: 24px;
}

.error-404__link span {
    font-size: var(--text-sm);
    font-weight: 500;
}

@media (max-width: 767px) {
    .error-404__number {
        font-size: 6rem;
    }

    .error-404__title {
        font-size: var(--text-2xl);
    }

    .error-404__links-grid {
        gap: var(--space-3);
    }

    .error-404__link {
        min-width: 80px;
        padding: var(--space-3);
    }
}
</style>

<?php
get_footer();
