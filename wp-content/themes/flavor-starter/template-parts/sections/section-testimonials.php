<?php
/**
 * Testimonials Section Template
 *
 * @package Flavor_Starter
 * @since 1.0.0
 */

$testimonials = new WP_Query([
    'post_type'      => 'testimonial',
    'posts_per_page' => 6,
    'orderby'        => 'date',
    'order'          => 'DESC',
]);

// Default testimonials if none exist
$default_testimonials = [
    [
        'content'  => 'Working with this team was an absolute pleasure. They delivered a stunning website that exceeded our expectations. The attention to detail and commitment to quality is unmatched.',
        'author'   => 'Sarah Johnson',
        'position' => 'CEO, TechStart Inc.',
        'rating'   => 5,
    ],
    [
        'content'  => 'The e-commerce solution they built for us has transformed our business. Sales have increased by 200% since launch. Highly recommend their services!',
        'author'   => 'Michael Chen',
        'position' => 'Founder, StyleShop',
        'rating'   => 5,
    ],
    [
        'content'  => 'Professional, creative, and incredibly responsive. They took our vague ideas and turned them into a beautiful, functional website. A truly talented team.',
        'author'   => 'Emily Rodriguez',
        'position' => 'Marketing Director, GlobalCorp',
        'rating'   => 5,
    ],
    [
        'content'  => 'From branding to web development, they handled everything seamlessly. Our new digital presence has significantly improved customer engagement.',
        'author'   => 'David Kim',
        'position' => 'COO, InnovateLabs',
        'rating'   => 5,
    ],
    [
        'content'  => 'The mobile app they developed is intuitive and performs flawlessly. Our users love it, and we ve seen a 50% increase in daily active users.',
        'author'   => 'Lisa Thompson',
        'position' => 'Product Manager, AppVenture',
        'rating'   => 5,
    ],
];
?>

<section class="testimonials-section section bg-gray-50" id="testimonials">
    <div class="container">
        <div class="section-header fade-in">
            <span class="section-label"><?php esc_html_e('Testimonials', 'flavor-starter'); ?></span>
            <h2 class="section-title"><?php esc_html_e('What Our Clients Say', 'flavor-starter'); ?></h2>
            <p class="section-description">
                <?php esc_html_e('Don\'t just take our word for it. Here\'s what our clients have to say about working with us.', 'flavor-starter'); ?>
            </p>
        </div>

        <div class="testimonials-slider fade-in" data-testimonials-slider>
            <div class="testimonials-slider__track">
                <?php if ($testimonials->have_posts()): ?>
                    <?php while ($testimonials->have_posts()): $testimonials->the_post();
                        $author = get_the_title();
                        $position = '';
                        $rating = 5;

                        if (function_exists('get_field')) {
                            $author = get_field('testimonial_author') ?: get_the_title();
                            $position = get_field('testimonial_position');
                            $rating = get_field('testimonial_rating') ?: 5;
                        }
                    ?>
                    <div class="testimonial-card">
                        <div class="testimonial-card__quote">
                            <?php echo flavor_icon('quote', 40); ?>
                        </div>
                        <div class="testimonial-card__content">
                            <?php the_content(); ?>
                        </div>
                        <div class="testimonial-card__rating">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <?php echo $i <= $rating ? flavor_icon('star', 18) : flavor_icon('star-empty', 18); ?>
                            <?php endfor; ?>
                        </div>
                        <div class="testimonial-card__author">
                            <?php if (has_post_thumbnail()): ?>
                            <div class="testimonial-card__avatar">
                                <?php the_post_thumbnail('thumbnail', ['class' => 'img-cover']); ?>
                            </div>
                            <?php else: ?>
                            <div class="testimonial-card__avatar testimonial-card__avatar--placeholder">
                                <?php echo strtoupper(substr($author, 0, 1)); ?>
                            </div>
                            <?php endif; ?>
                            <div class="testimonial-card__info">
                                <span class="testimonial-card__name"><?php echo esc_html($author); ?></span>
                                <?php if ($position): ?>
                                <span class="testimonial-card__position"><?php echo esc_html($position); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php else: ?>
                    <?php foreach ($default_testimonials as $testimonial): ?>
                    <div class="testimonial-card">
                        <div class="testimonial-card__quote">
                            <?php echo flavor_icon('quote', 40); ?>
                        </div>
                        <div class="testimonial-card__content">
                            <p><?php echo esc_html($testimonial['content']); ?></p>
                        </div>
                        <div class="testimonial-card__rating">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <?php echo $i <= $testimonial['rating'] ? flavor_icon('star', 18) : flavor_icon('star-empty', 18); ?>
                            <?php endfor; ?>
                        </div>
                        <div class="testimonial-card__author">
                            <div class="testimonial-card__avatar testimonial-card__avatar--placeholder">
                                <?php echo strtoupper(substr($testimonial['author'], 0, 1)); ?>
                            </div>
                            <div class="testimonial-card__info">
                                <span class="testimonial-card__name"><?php echo esc_html($testimonial['author']); ?></span>
                                <span class="testimonial-card__position"><?php echo esc_html($testimonial['position']); ?></span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="testimonials-slider__nav">
                <button type="button" class="testimonials-slider__btn testimonials-slider__btn--prev" aria-label="<?php esc_attr_e('Previous', 'flavor-starter'); ?>">
                    <?php echo flavor_icon('arrow-left', 24); ?>
                </button>
                <button type="button" class="testimonials-slider__btn testimonials-slider__btn--next" aria-label="<?php esc_attr_e('Next', 'flavor-starter'); ?>">
                    <?php echo flavor_icon('arrow-right', 24); ?>
                </button>
            </div>

            <div class="testimonials-slider__dots"></div>
        </div>
    </div>
</section>
