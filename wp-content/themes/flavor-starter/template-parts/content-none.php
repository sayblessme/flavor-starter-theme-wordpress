<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @package Flavor_Starter
 */
?>

<section class="no-results not-found">
    <div class="no-results__content">
        <div class="no-results__icon">
            <?php if (is_search()) : ?>
                <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="11" cy="11" r="8"/>
                    <path d="M21 21l-4.35-4.35"/>
                </svg>
            <?php else : ?>
                <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                    <polyline points="14,2 14,8 20,8"/>
                    <line x1="16" y1="13" x2="8" y2="13"/>
                    <line x1="16" y1="17" x2="8" y2="17"/>
                    <polyline points="10,9 9,9 8,9"/>
                </svg>
            <?php endif; ?>
        </div>

        <header class="no-results__header">
            <h1 class="no-results__title"><?php esc_html_e('Nothing Found', 'flavor-starter'); ?></h1>
        </header>

        <div class="no-results__body">
            <?php
            if (is_home() && current_user_can('publish_posts')) :

                printf(
                    '<p>' . wp_kses(
                        /* translators: 1: link to WP admin new post page. */
                        __('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'flavor-starter'),
                        [
                            'a' => [
                                'href' => [],
                            ],
                        ]
                    ) . '</p>',
                    esc_url(admin_url('post-new.php'))
                );

            elseif (is_search()) :
            ?>
                <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'flavor-starter'); ?></p>

                <div class="no-results__suggestions">
                    <h3><?php esc_html_e('Suggestions:', 'flavor-starter'); ?></h3>
                    <ul>
                        <li><?php esc_html_e('Make sure all words are spelled correctly.', 'flavor-starter'); ?></li>
                        <li><?php esc_html_e('Try different keywords.', 'flavor-starter'); ?></li>
                        <li><?php esc_html_e('Try more general keywords.', 'flavor-starter'); ?></li>
                    </ul>
                </div>

                <div class="no-results__search">
                    <?php get_search_form(); ?>
                </div>

            <?php else : ?>

                <p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'flavor-starter'); ?></p>

                <div class="no-results__search">
                    <?php get_search_form(); ?>
                </div>

            <?php endif; ?>
        </div>
    </div>
</section>
