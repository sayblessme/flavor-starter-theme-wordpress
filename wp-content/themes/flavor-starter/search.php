<?php
/**
 * The template for displaying search results pages
 *
 * @package Flavor_Starter
 */

get_header();
?>

<main id="primary" class="site-main">
    <header class="page-header">
        <div class="container">
            <?php flavor_breadcrumb(); ?>

            <div class="page-header__content">
                <h1 class="page-header__title">
                    <?php
                    printf(
                        /* translators: %s: search query. */
                        esc_html__('Результаты поиска: %s', 'flavor-starter'),
                        '<span>' . get_search_query() . '</span>'
                    );
                    ?>
                </h1>

                <?php if (have_posts()) : ?>
                    <p class="page-header__description">
                        <?php
                        printf(
                            /* translators: %d: number of results. */
                            esc_html(_n('Найден %d результат', 'Найдено %d результатов', $wp_query->found_posts, 'flavor-starter')),
                            $wp_query->found_posts
                        );
                        ?>
                    </p>
                <?php endif; ?>
            </div>

            <div class="page-header__search">
                <?php get_search_form(); ?>
            </div>
        </div>
    </header>

    <div class="search-content section">
        <div class="container">
            <?php if (have_posts()) : ?>

                <div class="content-area">
                    <div class="content-main">
                        <div class="posts-grid">
                            <?php
                            while (have_posts()) :
                                the_post();
                                get_template_part('template-parts/content', 'search');
                            endwhile;
                            ?>
                        </div>

                        <?php flavor_pagination(); ?>
                    </div>

                    <?php get_sidebar(); ?>
                </div>

            <?php else : ?>

                <div class="no-results">
                    <div class="no-results__icon">
                        <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <circle cx="11" cy="11" r="8"/>
                            <path d="M21 21l-4.35-4.35"/>
                        </svg>
                    </div>

                    <h2 class="no-results__title"><?php esc_html_e('Ничего не найдено', 'flavor-starter'); ?></h2>

                    <p class="no-results__text">
                        <?php esc_html_e('К сожалению, по вашему запросу ничего не найдено. Попробуйте изменить ключевые слова.', 'flavor-starter'); ?>
                    </p>

                    <div class="no-results__suggestions">
                        <h3><?php esc_html_e('Рекомендации:', 'flavor-starter'); ?></h3>
                        <ul>
                            <li><?php esc_html_e('Убедитесь, что все слова написаны правильно.', 'flavor-starter'); ?></li>
                            <li><?php esc_html_e('Попробуйте другие ключевые слова.', 'flavor-starter'); ?></li>
                            <li><?php esc_html_e('Попробуйте более общие запросы.', 'flavor-starter'); ?></li>
                        </ul>
                    </div>

                    <div class="no-results__search">
                        <?php get_search_form(); ?>
                    </div>
                </div>

            <?php endif; ?>
        </div>
    </div>
</main>

<?php
get_footer();
