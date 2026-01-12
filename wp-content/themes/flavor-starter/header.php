<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary">
        <?php esc_html_e('Skip to content', 'flavor-starter'); ?>
    </a>

    <?php
    // Header classes
    $header_classes = ['site-header'];

    if (get_theme_mod('flavor_sticky_header', true)) {
        $header_classes[] = 'is-sticky';
    }

    if (is_front_page() && get_theme_mod('flavor_transparent_header', true)) {
        $header_classes[] = 'is-transparent';
    }
    ?>

    <header id="masthead" class="<?php echo esc_attr(implode(' ', $header_classes)); ?>" data-header>
        <div class="header-inner">
            <div class="container">
                <div class="header-content">
                    <!-- Logo -->
                    <div class="site-branding">
                        <?php if (has_custom_logo()): ?>
                            <div class="site-logo">
                                <?php the_custom_logo(); ?>
                            </div>
                        <?php else: ?>
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="site-title-link" rel="home">
                                <span class="site-title"><?php bloginfo('name'); ?></span>
                            </a>
                        <?php endif; ?>
                    </div>

                    <!-- Primary Navigation -->
                    <nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e('Primary Navigation', 'flavor-starter'); ?>">
                        <?php
                        wp_nav_menu([
                            'theme_location' => 'primary',
                            'menu_class'     => 'primary-menu',
                            'container'      => false,
                            'depth'          => 3,
                            'walker'         => new Flavor_Walker_Nav_Menu(),
                            'fallback_cb'    => 'flavor_fallback_menu',
                        ]);
                        ?>
                    </nav>

                    <!-- Header Actions -->
                    <div class="header-actions">
                        <!-- Search Toggle -->
                        <button type="button" class="header-action header-search-toggle" aria-label="<?php esc_attr_e('Toggle search', 'flavor-starter'); ?>" data-search-toggle>
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </button>

                        <?php if (class_exists('WooCommerce')): ?>
                        <!-- Cart -->
                        <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="header-action header-cart" data-cart-toggle>
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="9" cy="21" r="1"></circle>
                                <circle cx="20" cy="21" r="1"></circle>
                                <path d="m1 1 4 4 2 14h13l3-9H6"></path>
                            </svg>
                            <span class="header-cart__count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                        </a>
                        <?php endif; ?>

                        <!-- CTA Button (Desktop) -->
                        <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>" class="btn btn-primary header-cta">
                            <?php esc_html_e('Contact Us', 'flavor-starter'); ?>
                        </a>

                        <!-- Mobile Menu Toggle -->
                        <button type="button" class="header-action mobile-menu-toggle" aria-label="<?php esc_attr_e('Toggle menu', 'flavor-starter'); ?>" aria-expanded="false" data-mobile-toggle>
                            <span class="hamburger">
                                <span class="hamburger-line"></span>
                                <span class="hamburger-line"></span>
                                <span class="hamburger-line"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="mobile-menu" id="mobile-menu" data-mobile-menu>
            <div class="mobile-menu__inner">
                <nav class="mobile-menu__nav" aria-label="<?php esc_attr_e('Mobile Navigation', 'flavor-starter'); ?>">
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'mobile',
                        'menu_class'     => 'mobile-menu__list',
                        'container'      => false,
                        'depth'          => 2,
                        'walker'         => new Flavor_Walker_Mobile_Menu(),
                        'fallback_cb'    => function() {
                            wp_nav_menu([
                                'theme_location' => 'primary',
                                'menu_class'     => 'mobile-menu__list',
                                'container'      => false,
                                'depth'          => 2,
                                'walker'         => new Flavor_Walker_Mobile_Menu(),
                            ]);
                        },
                    ]);
                    ?>
                </nav>

                <?php if (class_exists('WooCommerce')): ?>
                <div class="mobile-menu__cart">
                    <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="mobile-menu__cart-link">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="m1 1 4 4 2 14h13l3-9H6"></path>
                        </svg>
                        <span><?php esc_html_e('Cart', 'flavor-starter'); ?></span>
                        <span class="mobile-menu__cart-count">(<?php echo WC()->cart->get_cart_contents_count(); ?>)</span>
                    </a>
                </div>
                <?php endif; ?>

                <div class="mobile-menu__cta">
                    <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>" class="btn btn-primary btn-lg w-full">
                        <?php esc_html_e('Contact Us', 'flavor-starter'); ?>
                    </a>
                </div>

                <?php
                $social_links = flavor_get_social_links();
                $has_social = array_filter($social_links);
                if ($has_social):
                ?>
                <div class="mobile-menu__social">
                    <?php if ($social_links['facebook']): ?>
                    <a href="<?php echo esc_url($social_links['facebook']); ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                    </a>
                    <?php endif; ?>
                    <?php if ($social_links['instagram']): ?>
                    <a href="<?php echo esc_url($social_links['instagram']); ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                    </a>
                    <?php endif; ?>
                    <?php if ($social_links['twitter']): ?>
                    <a href="<?php echo esc_url($social_links['twitter']); ?>" target="_blank" rel="noopener noreferrer" aria-label="Twitter">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
                    </a>
                    <?php endif; ?>
                    <?php if ($social_links['telegram']): ?>
                    <a href="<?php echo esc_url($social_links['telegram']); ?>" target="_blank" rel="noopener noreferrer" aria-label="Telegram">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"></path></svg>
                    </a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <!-- Search Modal -->
    <div class="search-modal" id="search-modal" data-search-modal>
        <div class="search-modal__overlay" data-search-close></div>
        <div class="search-modal__content">
            <button type="button" class="search-modal__close" aria-label="<?php esc_attr_e('Close search', 'flavor-starter'); ?>" data-search-close>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
            <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                <label class="search-form__label">
                    <span class="sr-only"><?php esc_html_e('Search for:', 'flavor-starter'); ?></span>
                    <input type="search"
                           class="search-form__input"
                           placeholder="<?php esc_attr_e('Type to search...', 'flavor-starter'); ?>"
                           value="<?php echo get_search_query(); ?>"
                           name="s"
                           autocomplete="off"
                           autofocus>
                </label>
                <button type="submit" class="search-form__submit">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <span class="sr-only"><?php esc_html_e('Search', 'flavor-starter'); ?></span>
                </button>
            </form>
            <div class="search-modal__hint">
                <?php esc_html_e('Press ESC to close', 'flavor-starter'); ?>
            </div>
        </div>
    </div>

    <?php do_action('flavor_after_header'); ?>
