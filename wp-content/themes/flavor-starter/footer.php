    <?php do_action('flavor_before_footer'); ?>

    <footer id="colophon" class="site-footer">
        <!-- Newsletter Section -->
        <div class="footer-newsletter section-dark">
            <div class="container">
                <div class="newsletter-content">
                    <div class="newsletter-text">
                        <h3 class="newsletter-title"><?php esc_html_e('Subscribe to Our Newsletter', 'flavor-starter'); ?></h3>
                        <p class="newsletter-description"><?php esc_html_e('Get the latest news, articles, and resources delivered to your inbox weekly.', 'flavor-starter'); ?></p>
                    </div>
                    <form class="newsletter-form" action="#" method="post">
                        <div class="newsletter-form__inner">
                            <input type="email"
                                   name="email"
                                   class="newsletter-form__input"
                                   placeholder="<?php esc_attr_e('Enter your email', 'flavor-starter'); ?>"
                                   required>
                            <button type="submit" class="btn btn-primary newsletter-form__submit">
                                <?php esc_html_e('Subscribe', 'flavor-starter'); ?>
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </button>
                        </div>
                        <p class="newsletter-form__hint">
                            <?php esc_html_e('By subscribing, you agree to our Privacy Policy and consent to receive updates.', 'flavor-starter'); ?>
                        </p>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Footer -->
        <div class="footer-main">
            <div class="container">
                <div class="footer-grid">
                    <!-- Footer Column 1 - About -->
                    <div class="footer-column footer-column--about">
                        <div class="footer-logo">
                            <?php if (has_custom_logo()): ?>
                                <?php the_custom_logo(); ?>
                            <?php else: ?>
                                <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-logo__text">
                                    <?php bloginfo('name'); ?>
                                </a>
                            <?php endif; ?>
                        </div>

                        <?php
                        $footer_text = flavor_get_option('footer_text', '');
                        if ($footer_text):
                        ?>
                        <p class="footer-description"><?php echo esc_html($footer_text); ?></p>
                        <?php else: ?>
                        <p class="footer-description">
                            <?php esc_html_e('We create beautiful digital experiences that help businesses grow and succeed in the modern world.', 'flavor-starter'); ?>
                        </p>
                        <?php endif; ?>

                        <?php
                        $social_links = flavor_get_social_links();
                        $has_social = array_filter($social_links);
                        if ($has_social):
                        ?>
                        <div class="footer-social">
                            <?php if ($social_links['facebook']): ?>
                            <a href="<?php echo esc_url($social_links['facebook']); ?>" class="footer-social__link" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                            </a>
                            <?php endif; ?>
                            <?php if ($social_links['twitter']): ?>
                            <a href="<?php echo esc_url($social_links['twitter']); ?>" class="footer-social__link" target="_blank" rel="noopener noreferrer" aria-label="Twitter">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
                            </a>
                            <?php endif; ?>
                            <?php if ($social_links['instagram']): ?>
                            <a href="<?php echo esc_url($social_links['instagram']); ?>" class="footer-social__link" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                            </a>
                            <?php endif; ?>
                            <?php if ($social_links['linkedin']): ?>
                            <a href="<?php echo esc_url($social_links['linkedin']); ?>" class="footer-social__link" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>
                            </a>
                            <?php endif; ?>
                            <?php if ($social_links['youtube']): ?>
                            <a href="<?php echo esc_url($social_links['youtube']); ?>" class="footer-social__link" target="_blank" rel="noopener noreferrer" aria-label="YouTube">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"></path><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02" fill="#fff"></polygon></svg>
                            </a>
                            <?php endif; ?>
                            <?php if ($social_links['telegram']): ?>
                            <a href="<?php echo esc_url($social_links['telegram']); ?>" class="footer-social__link" target="_blank" rel="noopener noreferrer" aria-label="Telegram">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"></path></svg>
                            </a>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- Footer Column 2 - Quick Links -->
                    <div class="footer-column">
                        <h4 class="footer-column__title"><?php esc_html_e('Quick Links', 'flavor-starter'); ?></h4>
                        <?php if (has_nav_menu('footer')): ?>
                            <?php
                            wp_nav_menu([
                                'theme_location' => 'footer',
                                'menu_class'     => 'footer-menu',
                                'container'      => false,
                                'depth'          => 1,
                            ]);
                            ?>
                        <?php else: ?>
                        <ul class="footer-menu">
                            <li><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'flavor-starter'); ?></a></li>
                            <li><a href="<?php echo esc_url(get_permalink(get_page_by_path('about'))); ?>"><?php esc_html_e('About', 'flavor-starter'); ?></a></li>
                            <li><a href="<?php echo esc_url(get_post_type_archive_link('service')); ?>"><?php esc_html_e('Services', 'flavor-starter'); ?></a></li>
                            <li><a href="<?php echo esc_url(get_post_type_archive_link('case')); ?>"><?php esc_html_e('Portfolio', 'flavor-starter'); ?></a></li>
                            <li><a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"><?php esc_html_e('Blog', 'flavor-starter'); ?></a></li>
                            <li><a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>"><?php esc_html_e('Contact', 'flavor-starter'); ?></a></li>
                        </ul>
                        <?php endif; ?>
                    </div>

                    <!-- Footer Column 3 - Services -->
                    <div class="footer-column">
                        <h4 class="footer-column__title"><?php esc_html_e('Services', 'flavor-starter'); ?></h4>
                        <?php if (has_nav_menu('footer-2')): ?>
                            <?php
                            wp_nav_menu([
                                'theme_location' => 'footer-2',
                                'menu_class'     => 'footer-menu',
                                'container'      => false,
                                'depth'          => 1,
                            ]);
                            ?>
                        <?php else: ?>
                        <ul class="footer-menu">
                            <li><a href="#"><?php esc_html_e('Web Development', 'flavor-starter'); ?></a></li>
                            <li><a href="#"><?php esc_html_e('UI/UX Design', 'flavor-starter'); ?></a></li>
                            <li><a href="#"><?php esc_html_e('E-Commerce', 'flavor-starter'); ?></a></li>
                            <li><a href="#"><?php esc_html_e('Mobile Apps', 'flavor-starter'); ?></a></li>
                            <li><a href="#"><?php esc_html_e('Branding', 'flavor-starter'); ?></a></li>
                        </ul>
                        <?php endif; ?>
                    </div>

                    <!-- Footer Column 4 - Contact -->
                    <div class="footer-column">
                        <h4 class="footer-column__title"><?php esc_html_e('Contact Us', 'flavor-starter'); ?></h4>

                        <?php $contact_info = flavor_get_contact_info(); ?>

                        <ul class="footer-contact">
                            <?php if ($contact_info['address']): ?>
                            <li class="footer-contact__item">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                <span><?php echo nl2br(esc_html($contact_info['address'])); ?></span>
                            </li>
                            <?php else: ?>
                            <li class="footer-contact__item">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                <span>123 Design Street<br>Creative City, 10001</span>
                            </li>
                            <?php endif; ?>

                            <?php if ($contact_info['phone']): ?>
                            <li class="footer-contact__item">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                </svg>
                                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $contact_info['phone'])); ?>">
                                    <?php echo esc_html($contact_info['phone']); ?>
                                </a>
                            </li>
                            <?php else: ?>
                            <li class="footer-contact__item">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                </svg>
                                <a href="tel:+11234567890">+1 (123) 456-7890</a>
                            </li>
                            <?php endif; ?>

                            <?php if ($contact_info['email']): ?>
                            <li class="footer-contact__item">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                                <a href="mailto:<?php echo esc_attr($contact_info['email']); ?>">
                                    <?php echo esc_html($contact_info['email']); ?>
                                </a>
                            </li>
                            <?php else: ?>
                            <li class="footer-contact__item">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                                <a href="mailto:hello@flavorstarter.com">hello@flavorstarter.com</a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="container">
                <div class="footer-bottom__inner">
                    <div class="footer-copyright">
                        <?php
                        $copyright = flavor_get_option('footer_copyright', '');
                        if ($copyright) {
                            echo wp_kses_post(str_replace('{year}', date('Y'), $copyright));
                        } else {
                            printf(
                                esc_html__('&copy; %1$s %2$s. All rights reserved.', 'flavor-starter'),
                                date('Y'),
                                get_bloginfo('name')
                            );
                        }
                        ?>
                    </div>
                    <div class="footer-legal">
                        <a href="<?php echo esc_url(get_permalink(get_page_by_path('privacy-policy'))); ?>">
                            <?php esc_html_e('Privacy Policy', 'flavor-starter'); ?>
                        </a>
                        <span class="footer-legal__separator">|</span>
                        <a href="<?php echo esc_url(get_permalink(get_page_by_path('terms-of-service'))); ?>">
                            <?php esc_html_e('Terms of Service', 'flavor-starter'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button type="button" class="back-to-top" id="back-to-top" aria-label="<?php esc_attr_e('Back to top', 'flavor-starter'); ?>">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="12" y1="19" x2="12" y2="5"></line>
            <polyline points="5 12 12 5 19 12"></polyline>
        </svg>
    </button>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
