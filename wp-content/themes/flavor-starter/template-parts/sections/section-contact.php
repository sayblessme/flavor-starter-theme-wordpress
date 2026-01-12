<?php
/**
 * Contact Section Template
 *
 * @package Flavor_Starter
 * @since 1.0.0
 */

$contact_info = flavor_get_contact_info();
?>

<section class="contact-section section bg-gray-50" id="contact">
    <div class="container">
        <div class="section-header fade-in">
            <span class="section-label"><?php esc_html_e('Contact Us', 'flavor-starter'); ?></span>
            <h2 class="section-title"><?php esc_html_e('Get In Touch', 'flavor-starter'); ?></h2>
            <p class="section-description">
                <?php esc_html_e('Have a project in mind? We\'d love to hear from you. Send us a message and we\'ll respond as soon as possible.', 'flavor-starter'); ?>
            </p>
        </div>

        <div class="contact-grid">
            <!-- Contact Info -->
            <div class="contact-info slide-left">
                <div class="contact-info__card">
                    <h3 class="contact-info__title"><?php esc_html_e('Contact Information', 'flavor-starter'); ?></h3>
                    <p class="contact-info__subtitle"><?php esc_html_e('Fill out the form and our team will get back to you within 24 hours.', 'flavor-starter'); ?></p>

                    <ul class="contact-info__list">
                        <li class="contact-info__item">
                            <div class="contact-info__icon">
                                <?php echo flavor_icon('phone', 24); ?>
                            </div>
                            <div class="contact-info__content">
                                <span class="contact-info__label"><?php esc_html_e('Phone', 'flavor-starter'); ?></span>
                                <?php if ($contact_info['phone']): ?>
                                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $contact_info['phone'])); ?>">
                                    <?php echo esc_html($contact_info['phone']); ?>
                                </a>
                                <?php else: ?>
                                <a href="tel:+11234567890">+1 (123) 456-7890</a>
                                <?php endif; ?>
                            </div>
                        </li>
                        <li class="contact-info__item">
                            <div class="contact-info__icon">
                                <?php echo flavor_icon('mail', 24); ?>
                            </div>
                            <div class="contact-info__content">
                                <span class="contact-info__label"><?php esc_html_e('Email', 'flavor-starter'); ?></span>
                                <?php if ($contact_info['email']): ?>
                                <a href="mailto:<?php echo esc_attr($contact_info['email']); ?>">
                                    <?php echo esc_html($contact_info['email']); ?>
                                </a>
                                <?php else: ?>
                                <a href="mailto:hello@flavorstarter.com">hello@flavorstarter.com</a>
                                <?php endif; ?>
                            </div>
                        </li>
                        <li class="contact-info__item">
                            <div class="contact-info__icon">
                                <?php echo flavor_icon('map-pin', 24); ?>
                            </div>
                            <div class="contact-info__content">
                                <span class="contact-info__label"><?php esc_html_e('Address', 'flavor-starter'); ?></span>
                                <?php if ($contact_info['address']): ?>
                                <span><?php echo nl2br(esc_html($contact_info['address'])); ?></span>
                                <?php else: ?>
                                <span>123 Design Street<br>Creative City, 10001</span>
                                <?php endif; ?>
                            </div>
                        </li>
                    </ul>

                    <?php
                    $social_links = flavor_get_social_links();
                    $has_social = array_filter($social_links);
                    if ($has_social):
                    ?>
                    <div class="contact-info__social">
                        <?php if ($social_links['facebook']): ?>
                        <a href="<?php echo esc_url($social_links['facebook']); ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                        </a>
                        <?php endif; ?>
                        <?php if ($social_links['twitter']): ?>
                        <a href="<?php echo esc_url($social_links['twitter']); ?>" target="_blank" rel="noopener noreferrer" aria-label="Twitter">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
                        </a>
                        <?php endif; ?>
                        <?php if ($social_links['instagram']): ?>
                        <a href="<?php echo esc_url($social_links['instagram']); ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                        </a>
                        <?php endif; ?>
                        <?php if ($social_links['linkedin']): ?>
                        <a href="<?php echo esc_url($social_links['linkedin']); ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>
                        </a>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>

                    <!-- Decorative shapes -->
                    <div class="contact-info__decoration">
                        <div class="contact-info__circle contact-info__circle--1"></div>
                        <div class="contact-info__circle contact-info__circle--2"></div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="contact-form-wrapper slide-right">
                <form class="contact-form" id="contact-form" action="#" method="post">
                    <?php wp_nonce_field('flavor_contact_form', 'contact_nonce'); ?>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="contact-name" class="form-label"><?php esc_html_e('Full Name', 'flavor-starter'); ?> *</label>
                            <input type="text" id="contact-name" name="name" class="form-input" placeholder="<?php esc_attr_e('John Doe', 'flavor-starter'); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="contact-email" class="form-label"><?php esc_html_e('Email Address', 'flavor-starter'); ?> *</label>
                            <input type="email" id="contact-email" name="email" class="form-input" placeholder="<?php esc_attr_e('john@example.com', 'flavor-starter'); ?>" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="contact-phone" class="form-label"><?php esc_html_e('Phone Number', 'flavor-starter'); ?></label>
                            <input type="tel" id="contact-phone" name="phone" class="form-input" placeholder="<?php esc_attr_e('+1 (123) 456-7890', 'flavor-starter'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="contact-subject" class="form-label"><?php esc_html_e('Subject', 'flavor-starter'); ?> *</label>
                            <select id="contact-subject" name="subject" class="form-select" required>
                                <option value=""><?php esc_html_e('Select a subject', 'flavor-starter'); ?></option>
                                <option value="general"><?php esc_html_e('General Inquiry', 'flavor-starter'); ?></option>
                                <option value="project"><?php esc_html_e('New Project', 'flavor-starter'); ?></option>
                                <option value="support"><?php esc_html_e('Support', 'flavor-starter'); ?></option>
                                <option value="partnership"><?php esc_html_e('Partnership', 'flavor-starter'); ?></option>
                                <option value="other"><?php esc_html_e('Other', 'flavor-starter'); ?></option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="contact-message" class="form-label"><?php esc_html_e('Message', 'flavor-starter'); ?> *</label>
                        <textarea id="contact-message" name="message" class="form-textarea" rows="5" placeholder="<?php esc_attr_e('Tell us about your project...', 'flavor-starter'); ?>" required></textarea>
                    </div>

                    <div class="form-group form-group--checkbox">
                        <label class="checkbox-label">
                            <input type="checkbox" name="privacy" required>
                            <span class="checkbox-custom"></span>
                            <span class="checkbox-text">
                                <?php
                                printf(
                                    esc_html__('I agree to the %s and %s', 'flavor-starter'),
                                    '<a href="' . esc_url(get_permalink(get_page_by_path('privacy-policy'))) . '">' . esc_html__('Privacy Policy', 'flavor-starter') . '</a>',
                                    '<a href="' . esc_url(get_permalink(get_page_by_path('terms-of-service'))) . '">' . esc_html__('Terms of Service', 'flavor-starter') . '</a>'
                                );
                                ?>
                            </span>
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-full">
                        <span class="btn-text"><?php esc_html_e('Send Message', 'flavor-starter'); ?></span>
                        <span class="btn-loading">
                            <svg class="spinner" width="20" height="20" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3" fill="none" stroke-dasharray="60" stroke-dashoffset="20"/>
                            </svg>
                        </span>
                        <?php echo flavor_icon('arrow-right', 20); ?>
                    </button>

                    <div class="form-message" id="form-message"></div>
                </form>
            </div>
        </div>
    </div>
</section>
