<?php
/**
 * The template for displaying single case/portfolio items
 *
 * @package Flavor_Starter
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php while (have_posts()) : the_post(); ?>

        <article id="case-<?php the_ID(); ?>" <?php post_class('case-single'); ?>>
            <!-- Hero Section -->
            <header class="case-hero">
                <div class="container">
                    <?php flavor_breadcrumb(); ?>

                    <div class="case-hero__content">
                        <?php
                        $categories = get_the_terms(get_the_ID(), 'case_category');
                        if ($categories && !is_wp_error($categories)) :
                        ?>
                            <div class="case-hero__categories">
                                <?php foreach ($categories as $category) : ?>
                                    <a href="<?php echo esc_url(get_term_link($category)); ?>" class="case-hero__category">
                                        <?php echo esc_html($category->name); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <h1 class="case-hero__title"><?php the_title(); ?></h1>

                        <?php
                        $subtitle = function_exists('get_field') ? get_field('case_subtitle') : '';
                        if ($subtitle) :
                        ?>
                            <p class="case-hero__subtitle"><?php echo esc_html($subtitle); ?></p>
                        <?php endif; ?>

                        <!-- Case Meta -->
                        <div class="case-hero__meta">
                            <?php
                            $client = function_exists('get_field') ? get_field('case_client') : '';
                            $date = function_exists('get_field') ? get_field('case_date') : '';
                            $services = function_exists('get_field') ? get_field('case_services') : '';
                            $website = function_exists('get_field') ? get_field('case_website') : '';
                            ?>

                            <?php if ($client) : ?>
                                <div class="case-hero__meta-item">
                                    <span class="case-hero__meta-label"><?php esc_html_e('Клиент', 'flavor-starter'); ?></span>
                                    <span class="case-hero__meta-value"><?php echo esc_html($client); ?></span>
                                </div>
                            <?php endif; ?>

                            <?php if ($date) : ?>
                                <div class="case-hero__meta-item">
                                    <span class="case-hero__meta-label"><?php esc_html_e('Дата', 'flavor-starter'); ?></span>
                                    <span class="case-hero__meta-value"><?php echo esc_html($date); ?></span>
                                </div>
                            <?php endif; ?>

                            <?php if ($services) : ?>
                                <div class="case-hero__meta-item">
                                    <span class="case-hero__meta-label"><?php esc_html_e('Услуги', 'flavor-starter'); ?></span>
                                    <span class="case-hero__meta-value"><?php echo esc_html($services); ?></span>
                                </div>
                            <?php endif; ?>

                            <?php if ($website) : ?>
                                <div class="case-hero__meta-item">
                                    <span class="case-hero__meta-label"><?php esc_html_e('Сайт', 'flavor-starter'); ?></span>
                                    <a href="<?php echo esc_url($website); ?>" class="case-hero__meta-link" target="_blank" rel="noopener">
                                        <?php esc_html_e('Перейти на сайт', 'flavor-starter'); ?>
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6v6M10 14L21 3"/>
                                        </svg>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <?php if (has_post_thumbnail()) : ?>
                    <div class="case-hero__image">
                        <div class="container">
                            <?php the_post_thumbnail('full', ['class' => 'case-hero__img']); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </header>

            <!-- Case Content -->
            <div class="case-content section">
                <div class="container">
                    <div class="case-content__grid">
                        <!-- Main Content -->
                        <div class="case-content__main">
                            <?php
                            $overview = function_exists('get_field') ? get_field('case_overview') : '';
                            if ($overview) :
                            ?>
                                <div class="case-section">
                                    <h2 class="case-section__title"><?php esc_html_e('Обзор', 'flavor-starter'); ?></h2>
                                    <div class="case-section__content">
                                        <?php echo wp_kses_post($overview); ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php
                            $challenge = function_exists('get_field') ? get_field('case_challenge') : '';
                            if ($challenge) :
                            ?>
                                <div class="case-section">
                                    <h2 class="case-section__title"><?php esc_html_e('Задача', 'flavor-starter'); ?></h2>
                                    <div class="case-section__content">
                                        <?php echo wp_kses_post($challenge); ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php
                            $solution = function_exists('get_field') ? get_field('case_solution') : '';
                            if ($solution) :
                            ?>
                                <div class="case-section">
                                    <h2 class="case-section__title"><?php esc_html_e('Решение', 'flavor-starter'); ?></h2>
                                    <div class="case-section__content">
                                        <?php echo wp_kses_post($solution); ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Default Content -->
                            <?php if (get_the_content()) : ?>
                                <div class="case-section">
                                    <div class="case-section__content entry-content">
                                        <?php the_content(); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Sidebar -->
                        <aside class="case-content__sidebar">
                            <?php
                            $results = function_exists('get_field') ? get_field('case_results') : [];
                            if ($results) :
                            ?>
                                <div class="case-results">
                                    <h3 class="case-results__title"><?php esc_html_e('Результаты', 'flavor-starter'); ?></h3>
                                    <div class="case-results__list">
                                        <?php foreach ($results as $result) : ?>
                                            <div class="case-results__item">
                                                <span class="case-results__number"><?php echo esc_html($result['number']); ?></span>
                                                <span class="case-results__label"><?php echo esc_html($result['label']); ?></span>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php
                            $testimonial = function_exists('get_field') ? get_field('case_testimonial') : '';
                            $testimonial_author = function_exists('get_field') ? get_field('case_testimonial_author') : '';
                            $testimonial_role = function_exists('get_field') ? get_field('case_testimonial_role') : '';

                            if ($testimonial) :
                            ?>
                                <div class="case-testimonial">
                                    <blockquote class="case-testimonial__quote">
                                        <?php echo esc_html($testimonial); ?>
                                    </blockquote>
                                    <?php if ($testimonial_author) : ?>
                                        <cite class="case-testimonial__author">
                                            <span class="case-testimonial__name"><?php echo esc_html($testimonial_author); ?></span>
                                            <?php if ($testimonial_role) : ?>
                                                <span class="case-testimonial__role"><?php echo esc_html($testimonial_role); ?></span>
                                            <?php endif; ?>
                                        </cite>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </aside>
                    </div>
                </div>
            </div>

            <!-- Gallery Section -->
            <?php
            $gallery = function_exists('get_field') ? get_field('case_gallery') : [];
            if ($gallery) :
            ?>
                <section class="case-gallery section section--gray">
                    <div class="container">
                        <h2 class="section-title"><?php esc_html_e('Галерея проекта', 'flavor-starter'); ?></h2>
                        <div class="case-gallery__grid">
                            <?php foreach ($gallery as $image) : ?>
                                <a href="<?php echo esc_url($image['url']); ?>" class="case-gallery__item" data-lightbox="case-gallery">
                                    <img src="<?php echo esc_url($image['sizes']['medium_large']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                                </a>
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
                'post__not_in' => [get_the_ID()],
                'tax_query' => $categories ? [
                    [
                        'taxonomy' => 'case_category',
                        'field' => 'term_id',
                        'terms' => wp_list_pluck($categories, 'term_id'),
                    ],
                ] : [],
            ]);

            if ($related_cases->have_posts()) :
            ?>
                <section class="related-cases section">
                    <div class="container">
                        <h2 class="section-title"><?php esc_html_e('Похожие проекты', 'flavor-starter'); ?></h2>
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

            <!-- Case Navigation -->
            <nav class="case-navigation section">
                <div class="container">
                    <div class="case-navigation__grid">
                        <?php
                        $prev_post = get_previous_post();
                        $next_post = get_next_post();
                        ?>

                        <?php if ($prev_post) : ?>
                            <a href="<?php echo esc_url(get_permalink($prev_post)); ?>" class="case-navigation__link case-navigation__link--prev">
                                <span class="case-navigation__label">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                                    </svg>
                                    <?php esc_html_e('Предыдущий проект', 'flavor-starter'); ?>
                                </span>
                                <span class="case-navigation__title"><?php echo esc_html($prev_post->post_title); ?></span>
                            </a>
                        <?php else : ?>
                            <div></div>
                        <?php endif; ?>

                        <?php if ($next_post) : ?>
                            <a href="<?php echo esc_url(get_permalink($next_post)); ?>" class="case-navigation__link case-navigation__link--next">
                                <span class="case-navigation__label">
                                    <?php esc_html_e('Следующий проект', 'flavor-starter'); ?>
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M5 12h14M12 5l7 7-7 7"/>
                                    </svg>
                                </span>
                                <span class="case-navigation__title"><?php echo esc_html($next_post->post_title); ?></span>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </nav>
        </article>

    <?php endwhile; ?>
</main>

<?php
get_footer();
