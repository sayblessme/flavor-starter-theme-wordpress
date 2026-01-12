<?php
/**
 * The template for displaying services archive
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
                <h1 class="page-header__title"><?php esc_html_e('Our Services', 'flavor-starter'); ?></h1>
                <p class="page-header__description">
                    <?php esc_html_e('Comprehensive solutions tailored to your needs. Discover how we can help you achieve your business goals.', 'flavor-starter'); ?>
                </p>
            </div>
        </div>
    </header>

    <!-- Services Grid -->
    <section class="services-archive section">
        <div class="container">
            <?php if (have_posts()) : ?>
                <div class="services__grid services__grid--archive">
                    <?php
                    while (have_posts()) :
                        the_post();
                        get_template_part('template-parts/content', 'service-card');
                    endwhile;
                    ?>
                </div>

                <?php flavor_pagination(); ?>
            <?php else : ?>
                <div class="no-results">
                    <h2><?php esc_html_e('No services found', 'flavor-starter'); ?></h2>
                    <p><?php esc_html_e('We haven\'t added any services yet. Check back soon!', 'flavor-starter'); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="why-choose-us section section--gray">
        <div class="container">
            <div class="section__header">
                <span class="section-label"><?php esc_html_e('Why Choose Us', 'flavor-starter'); ?></span>
                <h2 class="section-title"><?php esc_html_e('What Sets Us Apart', 'flavor-starter'); ?></h2>
            </div>

            <div class="why-choose-us__grid">
                <div class="why-choose-us__item">
                    <div class="why-choose-us__icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        </svg>
                    </div>
                    <h3 class="why-choose-us__title"><?php esc_html_e('Quality Guaranteed', 'flavor-starter'); ?></h3>
                    <p class="why-choose-us__description">
                        <?php esc_html_e('We stand behind our work with a satisfaction guarantee on all projects.', 'flavor-starter'); ?>
                    </p>
                </div>

                <div class="why-choose-us__item">
                    <div class="why-choose-us__icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12,6 12,12 16,14"/>
                        </svg>
                    </div>
                    <h3 class="why-choose-us__title"><?php esc_html_e('On-Time Delivery', 'flavor-starter'); ?></h3>
                    <p class="why-choose-us__description">
                        <?php esc_html_e('We respect deadlines and deliver projects on schedule, every time.', 'flavor-starter'); ?>
                    </p>
                </div>

                <div class="why-choose-us__item">
                    <div class="why-choose-us__icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                        </svg>
                    </div>
                    <h3 class="why-choose-us__title"><?php esc_html_e('Expert Team', 'flavor-starter'); ?></h3>
                    <p class="why-choose-us__description">
                        <?php esc_html_e('Our experienced professionals bring expertise to every project.', 'flavor-starter'); ?>
                    </p>
                </div>

                <div class="why-choose-us__item">
                    <div class="why-choose-us__icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>
                        </svg>
                    </div>
                    <h3 class="why-choose-us__title"><?php esc_html_e('24/7 Support', 'flavor-starter'); ?></h3>
                    <p class="why-choose-us__description">
                        <?php esc_html_e('We\'re always available to answer questions and provide assistance.', 'flavor-starter'); ?>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta section section--dark">
        <div class="container">
            <div class="cta__content">
                <h2 class="cta__title"><?php esc_html_e('Ready to Get Started?', 'flavor-starter'); ?></h2>
                <p class="cta__description">
                    <?php esc_html_e('Contact us today to discuss your project and receive a free quote.', 'flavor-starter'); ?>
                </p>
                <div class="cta__actions">
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--white btn--lg">
                        <?php esc_html_e('Get Free Quote', 'flavor-starter'); ?>
                    </a>
                    <a href="tel:<?php echo esc_attr(flavor_get_option('phone')); ?>" class="btn btn--outline-white btn--lg">
                        <?php esc_html_e('Call Us Now', 'flavor-starter'); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
