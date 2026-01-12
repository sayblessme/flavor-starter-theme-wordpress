<?php
/**
 * FAQ Section Template
 *
 * @package Flavor_Starter
 * @since 1.0.0
 */

$faqs = new WP_Query([
    'post_type'      => 'faq',
    'posts_per_page' => 6,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
]);

// Default FAQs if none exist
$default_faqs = [
    [
        'question' => 'What services do you offer?',
        'answer'   => 'We offer a comprehensive range of digital services including web development, UI/UX design, e-commerce solutions, mobile app development, branding, and digital marketing. Each service is tailored to meet your specific business needs.',
    ],
    [
        'question' => 'How long does a typical project take?',
        'answer'   => 'Project timelines vary based on complexity and scope. A simple website typically takes 4-6 weeks, while more complex e-commerce or custom applications may take 8-12 weeks or more. We provide detailed timelines during the proposal phase.',
    ],
    [
        'question' => 'What is your pricing structure?',
        'answer'   => 'We offer both fixed-price and hourly billing options depending on the project type. Fixed pricing works well for defined projects, while hourly billing is suitable for ongoing work or projects with evolving requirements. Contact us for a custom quote.',
    ],
    [
        'question' => 'Do you provide ongoing support and maintenance?',
        'answer'   => 'Yes, we offer flexible maintenance and support packages to ensure your digital products remain secure, up-to-date, and performing optimally. Our support plans include regular updates, security monitoring, and priority assistance.',
    ],
    [
        'question' => 'Can you work with our existing team?',
        'answer'   => 'Absolutely! We frequently collaborate with in-house teams and other agencies. We can integrate seamlessly into your workflow, whether you need us to lead the project or support your existing efforts.',
    ],
    [
        'question' => 'What technologies do you work with?',
        'answer'   => 'We work with a wide range of modern technologies including WordPress, WooCommerce, React, Vue.js, Node.js, PHP, and various cloud platforms. We choose the best technology stack based on your project requirements.',
    ],
];
?>

<section class="faq-section section" id="faq">
    <div class="container container-lg">
        <div class="section-header fade-in">
            <span class="section-label"><?php esc_html_e('FAQ', 'flavor-starter'); ?></span>
            <h2 class="section-title"><?php esc_html_e('Frequently Asked Questions', 'flavor-starter'); ?></h2>
            <p class="section-description">
                <?php esc_html_e('Find answers to common questions about our services and process.', 'flavor-starter'); ?>
            </p>
        </div>

        <div class="faq-accordion fade-in" data-accordion>
            <?php if ($faqs->have_posts()): ?>
                <?php while ($faqs->have_posts()): $faqs->the_post(); ?>
                <div class="faq-item" data-accordion-item>
                    <button type="button" class="faq-item__header" data-accordion-trigger aria-expanded="false">
                        <span class="faq-item__question"><?php the_title(); ?></span>
                        <span class="faq-item__icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="12" y1="5" x2="12" y2="19" class="faq-item__icon-vertical"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                        </span>
                    </button>
                    <div class="faq-item__content" data-accordion-content>
                        <div class="faq-item__answer">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php else: ?>
                <?php foreach ($default_faqs as $faq): ?>
                <div class="faq-item" data-accordion-item>
                    <button type="button" class="faq-item__header" data-accordion-trigger aria-expanded="false">
                        <span class="faq-item__question"><?php echo esc_html($faq['question']); ?></span>
                        <span class="faq-item__icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="12" y1="5" x2="12" y2="19" class="faq-item__icon-vertical"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                        </span>
                    </button>
                    <div class="faq-item__content" data-accordion-content>
                        <div class="faq-item__answer">
                            <p><?php echo esc_html($faq['answer']); ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="faq-cta text-center fade-in">
            <p class="faq-cta__text"><?php esc_html_e('Still have questions?', 'flavor-starter'); ?></p>
            <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>" class="btn btn-primary">
                <?php esc_html_e('Contact Us', 'flavor-starter'); ?>
            </a>
        </div>
    </div>
</section>
