<?php
/**
 * Blog Section Template
 *
 * @package Flavor_Starter
 * @since 1.0.0
 */

$posts = new WP_Query([
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'post_status'    => 'publish',
]);

if (!$posts->have_posts()) {
    wp_reset_postdata();
    return;
}
?>

<section class="blog-section section bg-gray-50" id="blog">
    <div class="container">
        <div class="blog-header">
            <div class="section-header text-left fade-in">
                <span class="section-label"><?php esc_html_e('From the Blog', 'flavor-starter'); ?></span>
                <h2 class="section-title"><?php esc_html_e('Latest Articles', 'flavor-starter'); ?></h2>
                <p class="section-description">
                    <?php esc_html_e('Insights, tutorials, and industry news to help you stay ahead.', 'flavor-starter'); ?>
                </p>
            </div>
            <div class="blog-header__cta fade-in">
                <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="btn btn-outline">
                    <?php esc_html_e('View All Posts', 'flavor-starter'); ?>
                    <?php echo flavor_icon('arrow-right', 18); ?>
                </a>
            </div>
        </div>

        <div class="blog-grid grid grid-cols-3">
            <?php while ($posts->have_posts()): $posts->the_post(); ?>
            <article class="post-card card card-bordered hover-lift fade-in">
                <?php if (has_post_thumbnail()): ?>
                <a href="<?php the_permalink(); ?>" class="post-card__image-link">
                    <div class="post-card__image">
                        <?php the_post_thumbnail('flavor-card', ['class' => 'img-cover']); ?>
                    </div>
                </a>
                <?php endif; ?>

                <div class="card-body">
                    <?php
                    $categories = get_the_category();
                    if ($categories):
                    ?>
                    <div class="post-card__categories">
                        <?php foreach (array_slice($categories, 0, 2) as $category): ?>
                        <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="badge badge-primary">
                            <?php echo esc_html($category->name); ?>
                        </a>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>

                    <h3 class="post-card__title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>

                    <p class="post-card__excerpt">
                        <?php echo esc_html(flavor_excerpt(15)); ?>
                    </p>

                    <div class="post-card__footer">
                        <div class="post-card__meta">
                            <span class="post-card__date">
                                <?php echo flavor_icon('calendar', 14); ?>
                                <?php echo esc_html(get_the_date()); ?>
                            </span>
                            <span class="post-card__reading-time">
                                <?php echo flavor_icon('clock', 14); ?>
                                <?php echo esc_html(flavor_reading_time()); ?>
                            </span>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="post-card__link" aria-label="<?php esc_attr_e('Read more', 'flavor-starter'); ?>">
                            <?php echo flavor_icon('arrow-right', 18); ?>
                        </a>
                    </div>
                </div>
            </article>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    </div>
</section>
