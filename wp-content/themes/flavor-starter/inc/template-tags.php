<?php
/**
 * Template Tags
 *
 * @package Flavor_Starter
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Display post meta
 */
function flavor_post_meta(): void {
    ?>
    <div class="post-meta">
        <span class="post-meta__item post-meta__date">
            <?php echo flavor_icon('calendar', 16); ?>
            <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                <?php echo esc_html(get_the_date()); ?>
            </time>
        </span>

        <?php if (get_post_type() === 'post'): ?>
        <span class="post-meta__item post-meta__author">
            <?php echo flavor_icon('user', 16); ?>
            <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                <?php echo esc_html(get_the_author()); ?>
            </a>
        </span>

        <span class="post-meta__item post-meta__reading-time">
            <?php echo flavor_icon('clock', 16); ?>
            <?php echo esc_html(flavor_reading_time()); ?>
        </span>
        <?php endif; ?>
    </div>
    <?php
}

/**
 * Display post categories
 */
function flavor_post_categories(): void {
    $categories = get_the_category();

    if (empty($categories)) {
        return;
    }
    ?>
    <div class="post-categories">
        <?php foreach ($categories as $category): ?>
        <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="badge badge-primary">
            <?php echo esc_html($category->name); ?>
        </a>
        <?php endforeach; ?>
    </div>
    <?php
}

/**
 * Display post tags
 */
function flavor_post_tags(): void {
    $tags = get_the_tags();

    if (empty($tags)) {
        return;
    }
    ?>
    <div class="post-tags">
        <span class="post-tags__label"><?php esc_html_e('Tags:', 'flavor-starter'); ?></span>
        <div class="post-tags__list">
            <?php foreach ($tags as $tag): ?>
            <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="tag">
                <?php echo esc_html($tag->name); ?>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
}

/**
 * Display author box
 */
function flavor_author_box(): void {
    $author_id = get_the_author_meta('ID');
    $author_bio = get_the_author_meta('description');

    if (empty($author_bio)) {
        return;
    }
    ?>
    <div class="author-box card card-bordered">
        <div class="author-box__inner">
            <div class="author-box__avatar">
                <?php echo get_avatar($author_id, 100, '', '', ['class' => 'author-box__image']); ?>
            </div>
            <div class="author-box__content">
                <h4 class="author-box__name">
                    <a href="<?php echo esc_url(get_author_posts_url($author_id)); ?>">
                        <?php echo esc_html(get_the_author()); ?>
                    </a>
                </h4>
                <p class="author-box__bio"><?php echo esc_html($author_bio); ?></p>
                <div class="author-box__social">
                    <?php
                    $website = get_the_author_meta('url');
                    if ($website):
                    ?>
                    <a href="<?php echo esc_url($website); ?>" target="_blank" rel="noopener noreferrer" class="author-box__link">
                        <?php echo flavor_icon('external', 18); ?>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Display post navigation
 */
function flavor_post_navigation(): void {
    $prev_post = get_previous_post();
    $next_post = get_next_post();

    if (!$prev_post && !$next_post) {
        return;
    }
    ?>
    <nav class="post-navigation">
        <div class="post-navigation__inner">
            <?php if ($prev_post): ?>
            <a href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>" class="post-navigation__link post-navigation__link--prev">
                <span class="post-navigation__label">
                    <?php echo flavor_icon('arrow-left', 18); ?>
                    <?php esc_html_e('Previous', 'flavor-starter'); ?>
                </span>
                <span class="post-navigation__title"><?php echo esc_html($prev_post->post_title); ?></span>
            </a>
            <?php else: ?>
            <div class="post-navigation__link post-navigation__link--empty"></div>
            <?php endif; ?>

            <?php if ($next_post): ?>
            <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" class="post-navigation__link post-navigation__link--next">
                <span class="post-navigation__label">
                    <?php esc_html_e('Next', 'flavor-starter'); ?>
                    <?php echo flavor_icon('arrow-right', 18); ?>
                </span>
                <span class="post-navigation__title"><?php echo esc_html($next_post->post_title); ?></span>
            </a>
            <?php endif; ?>
        </div>
    </nav>
    <?php
}

/**
 * Display related posts
 */
function flavor_related_posts(): void {
    $related = flavor_get_related_posts(get_the_ID(), 3);

    if (!$related->have_posts()) {
        wp_reset_postdata();
        return;
    }
    ?>
    <section class="related-posts">
        <h3 class="related-posts__title"><?php esc_html_e('Related Posts', 'flavor-starter'); ?></h3>
        <div class="related-posts__grid grid grid-cols-3">
            <?php while ($related->have_posts()): $related->the_post(); ?>
            <article class="post-card card card-bordered hover-lift">
                <?php if (has_post_thumbnail()): ?>
                <a href="<?php the_permalink(); ?>" class="post-card__image-link">
                    <div class="post-card__image">
                        <?php the_post_thumbnail('flavor-card', ['class' => 'img-cover']); ?>
                    </div>
                </a>
                <?php endif; ?>
                <div class="card-body">
                    <?php flavor_post_categories(); ?>
                    <h4 class="post-card__title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h4>
                    <div class="post-card__meta">
                        <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                            <?php echo esc_html(get_the_date()); ?>
                        </time>
                    </div>
                </div>
            </article>
            <?php endwhile; ?>
        </div>
    </section>
    <?php
    wp_reset_postdata();
}

/**
 * Display comments
 */
function flavor_comments(WP_Comment $comment, array $args, int $depth): void {
    $tag = ($args['style'] === 'div') ? 'div' : 'li';
    ?>
    <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class('comment'); ?>>
        <article class="comment__body">
            <header class="comment__header">
                <div class="comment__avatar">
                    <?php echo get_avatar($comment, 50); ?>
                </div>
                <div class="comment__meta">
                    <span class="comment__author"><?php comment_author_link(); ?></span>
                    <time class="comment__date" datetime="<?php comment_time('c'); ?>">
                        <?php
                        printf(
                            esc_html__('%1$s at %2$s', 'flavor-starter'),
                            get_comment_date(),
                            get_comment_time()
                        );
                        ?>
                    </time>
                </div>
            </header>

            <div class="comment__content">
                <?php if ($comment->comment_approved === '0'): ?>
                <p class="comment__awaiting-moderation">
                    <?php esc_html_e('Your comment is awaiting moderation.', 'flavor-starter'); ?>
                </p>
                <?php endif; ?>

                <?php comment_text(); ?>
            </div>

            <footer class="comment__footer">
                <?php
                comment_reply_link(array_merge($args, [
                    'reply_text' => esc_html__('Reply', 'flavor-starter'),
                    'depth'      => $depth,
                    'max_depth'  => $args['max_depth'],
                    'before'     => '<span class="comment__reply">',
                    'after'      => '</span>',
                ]));
                ?>

                <?php
                edit_comment_link(
                    esc_html__('Edit', 'flavor-starter'),
                    '<span class="comment__edit">',
                    '</span>'
                );
                ?>
            </footer>
        </article>
    <?php
}

/**
 * Display services grid
 */
function flavor_services_grid(int $count = 6, array $args = []): void {
    $defaults = [
        'post_type'      => 'service',
        'posts_per_page' => $count,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    ];

    $query_args = wp_parse_args($args, $defaults);
    $services = new WP_Query($query_args);

    if (!$services->have_posts()) {
        wp_reset_postdata();
        return;
    }
    ?>
    <div class="services-grid grid grid-cols-3">
        <?php while ($services->have_posts()): $services->the_post(); ?>
        <article class="service-card card card-bordered hover-lift fade-in">
            <div class="card-body">
                <?php
                $icon = '';
                if (function_exists('get_field')) {
                    $icon = get_field('service_icon');
                }
                if ($icon):
                ?>
                <div class="service-card__icon">
                    <?php echo $icon; ?>
                </div>
                <?php endif; ?>

                <h3 class="service-card__title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h3>

                <?php
                $short_desc = '';
                if (function_exists('get_field')) {
                    $short_desc = get_field('service_short_desc');
                }
                if (!$short_desc) {
                    $short_desc = get_the_excerpt();
                }
                ?>
                <p class="service-card__description"><?php echo esc_html($short_desc); ?></p>

                <a href="<?php the_permalink(); ?>" class="service-card__link">
                    <?php esc_html_e('Learn More', 'flavor-starter'); ?>
                    <?php echo flavor_icon('arrow-right', 18); ?>
                </a>
            </div>
        </article>
        <?php endwhile; ?>
    </div>
    <?php
    wp_reset_postdata();
}

/**
 * Display cases/portfolio grid
 */
function flavor_cases_grid(int $count = 6, array $args = []): void {
    $defaults = [
        'post_type'      => 'case',
        'posts_per_page' => $count,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ];

    $query_args = wp_parse_args($args, $defaults);
    $cases = new WP_Query($query_args);

    if (!$cases->have_posts()) {
        wp_reset_postdata();
        return;
    }
    ?>
    <div class="cases-grid grid grid-cols-3">
        <?php while ($cases->have_posts()): $cases->the_post(); ?>
        <article class="case-card hover-lift fade-in">
            <a href="<?php the_permalink(); ?>" class="case-card__link">
                <div class="case-card__image">
                    <?php if (has_post_thumbnail()): ?>
                        <?php the_post_thumbnail('flavor-card-wide', ['class' => 'img-cover']); ?>
                    <?php else: ?>
                        <img src="<?php echo esc_url(flavor_placeholder_image(800, 500)); ?>" alt="" class="img-cover">
                    <?php endif; ?>
                    <div class="case-card__overlay">
                        <span class="case-card__view">
                            <?php echo flavor_icon('eye', 24); ?>
                            <?php esc_html_e('View Case', 'flavor-starter'); ?>
                        </span>
                    </div>
                </div>
                <div class="case-card__content">
                    <?php
                    $categories = get_the_terms(get_the_ID(), 'case_category');
                    if ($categories && !is_wp_error($categories)):
                    ?>
                    <span class="case-card__category">
                        <?php echo esc_html($categories[0]->name); ?>
                    </span>
                    <?php endif; ?>

                    <h3 class="case-card__title"><?php the_title(); ?></h3>

                    <?php
                    $client = '';
                    if (function_exists('get_field')) {
                        $client = get_field('case_client');
                    }
                    if ($client):
                    ?>
                    <span class="case-card__client"><?php echo esc_html($client); ?></span>
                    <?php endif; ?>
                </div>
            </a>
        </article>
        <?php endwhile; ?>
    </div>
    <?php
    wp_reset_postdata();
}

/**
 * Display testimonials slider
 */
function flavor_testimonials_slider(int $count = 5): void {
    $testimonials = new WP_Query([
        'post_type'      => 'testimonial',
        'posts_per_page' => $count,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ]);

    if (!$testimonials->have_posts()) {
        wp_reset_postdata();
        return;
    }
    ?>
    <div class="testimonials-slider" data-testimonials-slider>
        <div class="testimonials-slider__track">
            <?php while ($testimonials->have_posts()): $testimonials->the_post(); ?>
            <div class="testimonial-card">
                <div class="testimonial-card__quote">
                    <?php echo flavor_icon('quote', 40); ?>
                </div>
                <div class="testimonial-card__content">
                    <?php the_content(); ?>
                </div>

                <?php
                $rating = 5;
                if (function_exists('get_field')) {
                    $rating = get_field('testimonial_rating') ?: 5;
                }
                ?>
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
                    <?php endif; ?>
                    <div class="testimonial-card__info">
                        <span class="testimonial-card__name">
                            <?php
                            if (function_exists('get_field') && get_field('testimonial_author')) {
                                echo esc_html(get_field('testimonial_author'));
                            } else {
                                the_title();
                            }
                            ?>
                        </span>
                        <?php
                        $position = '';
                        if (function_exists('get_field')) {
                            $position = get_field('testimonial_position');
                        }
                        if ($position):
                        ?>
                        <span class="testimonial-card__position"><?php echo esc_html($position); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
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
    <?php
    wp_reset_postdata();
}

/**
 * Display team grid
 */
function flavor_team_grid(int $count = 4): void {
    $team = new WP_Query([
        'post_type'      => 'team',
        'posts_per_page' => $count,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    ]);

    if (!$team->have_posts()) {
        wp_reset_postdata();
        return;
    }
    ?>
    <div class="team-grid grid grid-cols-4">
        <?php while ($team->have_posts()): $team->the_post(); ?>
        <article class="team-card fade-in">
            <div class="team-card__image">
                <?php if (has_post_thumbnail()): ?>
                    <?php the_post_thumbnail('flavor-portrait', ['class' => 'img-cover']); ?>
                <?php else: ?>
                    <img src="<?php echo esc_url(flavor_placeholder_image(600, 800)); ?>" alt="" class="img-cover">
                <?php endif; ?>

                <?php
                $linkedin = '';
                $twitter = '';
                $email = '';
                if (function_exists('get_field')) {
                    $linkedin = get_field('team_linkedin');
                    $twitter = get_field('team_twitter');
                    $email = get_field('team_email');
                }
                if ($linkedin || $twitter || $email):
                ?>
                <div class="team-card__social">
                    <?php if ($linkedin): ?>
                    <a href="<?php echo esc_url($linkedin); ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>
                    </a>
                    <?php endif; ?>
                    <?php if ($twitter): ?>
                    <a href="<?php echo esc_url($twitter); ?>" target="_blank" rel="noopener noreferrer" aria-label="Twitter">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
                    </a>
                    <?php endif; ?>
                    <?php if ($email): ?>
                    <a href="mailto:<?php echo esc_attr($email); ?>" aria-label="Email">
                        <?php echo flavor_icon('mail', 20); ?>
                    </a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="team-card__content">
                <h3 class="team-card__name"><?php the_title(); ?></h3>
                <?php
                $position = '';
                if (function_exists('get_field')) {
                    $position = get_field('team_position');
                }
                if ($position):
                ?>
                <span class="team-card__position"><?php echo esc_html($position); ?></span>
                <?php endif; ?>
            </div>
        </article>
        <?php endwhile; ?>
    </div>
    <?php
    wp_reset_postdata();
}

/**
 * Display FAQ accordion
 */
function flavor_faq_accordion(string $category = ''): void {
    $args = [
        'post_type'      => 'faq',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    ];

    if ($category) {
        $args['tax_query'] = [
            [
                'taxonomy' => 'faq_category',
                'field'    => 'slug',
                'terms'    => $category,
            ],
        ];
    }

    $faqs = new WP_Query($args);

    if (!$faqs->have_posts()) {
        wp_reset_postdata();
        return;
    }
    ?>
    <div class="faq-accordion" data-accordion>
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
    </div>
    <?php
    wp_reset_postdata();
}
