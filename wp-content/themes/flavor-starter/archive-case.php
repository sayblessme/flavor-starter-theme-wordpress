<?php
/**
 * The template for displaying case/portfolio archive
 *
 * @package Flavor_Starter
 */

get_header();
?>

<main id="primary" class="site-main">
    <!-- Page Header -->
    <header class="page-header">
        <div class="container">
            <?php flavor_breadcrumb(); ?>

            <div class="page-header__content">
                <h1 class="page-header__title">
                    <?php
                    if (is_tax('case_category')) :
                        single_term_title();
                    else :
                        esc_html_e('Наши работы', 'flavor-starter');
                    endif;
                    ?>
                </h1>
                <p class="page-header__description">
                    <?php
                    if (is_tax('case_category')) :
                        echo esc_html(term_description());
                    else :
                        esc_html_e('Посмотрите наше портфолио успешных проектов и узнайте, как мы помогли клиентам достичь их целей.', 'flavor-starter');
                    endif;
                    ?>
                </p>
            </div>
        </div>
    </header>

    <!-- Portfolio Filters -->
    <section class="portfolio-filters">
        <div class="container">
            <div class="portfolio__filters">
                <button class="portfolio__filter <?php echo !is_tax() ? 'portfolio__filter--active' : ''; ?>" data-filter="all">
                    <?php esc_html_e('Все', 'flavor-starter'); ?>
                </button>
                <?php
                $categories = get_terms([
                    'taxonomy' => 'case_category',
                    'hide_empty' => true,
                ]);

                foreach ($categories as $category) :
                    $is_active = is_tax('case_category', $category->slug);
                ?>
                    <a href="<?php echo esc_url(get_term_link($category)); ?>" class="portfolio__filter <?php echo $is_active ? 'portfolio__filter--active' : ''; ?>">
                        <?php echo esc_html($category->name); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Portfolio Grid -->
    <section class="portfolio-archive section">
        <div class="container">
            <?php if (have_posts()) : ?>
                <div class="portfolio__grid portfolio__grid--archive">
                    <?php
                    while (have_posts()) :
                        the_post();
                        get_template_part('template-parts/content', 'case-card');
                    endwhile;
                    ?>
                </div>

                <?php flavor_pagination(); ?>
            <?php else : ?>
                <div class="no-results">
                    <h2><?php esc_html_e('Проекты не найдены', 'flavor-starter'); ?></h2>
                    <p><?php esc_html_e('Мы ещё не добавили проекты. Загляните позже!', 'flavor-starter'); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta section section--dark">
        <div class="container">
            <div class="cta__content">
                <h2 class="cta__title"><?php esc_html_e('Есть идея проекта?', 'flavor-starter'); ?></h2>
                <p class="cta__description">
                    <?php esc_html_e('Давайте обсудим, как мы можем воплотить вашу идею в жизнь.', 'flavor-starter'); ?>
                </p>
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--white btn--lg">
                    <?php esc_html_e('Начать проект', 'flavor-starter'); ?>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
