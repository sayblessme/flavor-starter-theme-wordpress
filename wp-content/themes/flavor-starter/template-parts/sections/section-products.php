<?php
/**
 * Products Section Template (WooCommerce)
 *
 * @package Flavor_Starter
 * @since 1.0.0
 */

if (!class_exists('WooCommerce')) {
    return;
}

$products = new WP_Query([
    'post_type'      => 'product',
    'posts_per_page' => 8,
    'post_status'    => 'publish',
    'meta_query'     => [
        [
            'key'     => '_visibility',
            'value'   => ['catalog', 'visible'],
            'compare' => 'IN',
        ],
    ],
]);

// Alternative query if meta_query doesn't work
if (!$products->have_posts()) {
    $products = new WP_Query([
        'post_type'      => 'product',
        'posts_per_page' => 8,
        'post_status'    => 'publish',
    ]);
}

if (!$products->have_posts()) {
    wp_reset_postdata();
    return;
}
?>

<section class="products-section section bg-gray-50" id="shop">
    <div class="container">
        <div class="products-header">
            <div class="section-header text-left fade-in">
                <span class="section-label"><?php esc_html_e('Our Shop', 'flavor-starter'); ?></span>
                <h2 class="section-title"><?php esc_html_e('Featured Products', 'flavor-starter'); ?></h2>
                <p class="section-description">
                    <?php esc_html_e('Discover our curated collection of premium products designed with quality and style in mind.', 'flavor-starter'); ?>
                </p>
            </div>
            <div class="products-header__cta fade-in">
                <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="btn btn-outline">
                    <?php esc_html_e('View All Products', 'flavor-starter'); ?>
                    <?php echo flavor_icon('arrow-right', 18); ?>
                </a>
            </div>
        </div>

        <div class="products-grid" data-products-slider>
            <?php while ($products->have_posts()): $products->the_post();
                global $product;

                if (!$product) continue;

                $badge = '';
                if (function_exists('get_field')) {
                    $badge = get_field('product_badge', $product->get_id());
                }
            ?>
            <article class="product-card fade-in" data-product-id="<?php echo esc_attr($product->get_id()); ?>">
                <a href="<?php the_permalink(); ?>" class="product-card__link">
                    <div class="product-card__image-wrapper">
                        <?php if ($badge): ?>
                        <span class="product-card__badge"><?php echo esc_html($badge); ?></span>
                        <?php elseif ($product->is_on_sale()): ?>
                        <span class="product-card__badge product-card__badge--sale"><?php esc_html_e('Sale', 'flavor-starter'); ?></span>
                        <?php elseif ($product->is_featured()): ?>
                        <span class="product-card__badge product-card__badge--featured"><?php esc_html_e('Featured', 'flavor-starter'); ?></span>
                        <?php endif; ?>

                        <div class="product-card__image">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('flavor-product', ['class' => 'img-cover']); ?>
                            <?php else: ?>
                                <img src="<?php echo esc_url(wc_placeholder_img_src('flavor-product')); ?>" alt="<?php the_title_attribute(); ?>">
                            <?php endif; ?>
                        </div>

                        <?php
                        $gallery_ids = $product->get_gallery_image_ids();
                        if (!empty($gallery_ids)):
                        ?>
                        <div class="product-card__image product-card__image--hover">
                            <?php echo wp_get_attachment_image($gallery_ids[0], 'flavor-product', false, ['class' => 'img-cover']); ?>
                        </div>
                        <?php endif; ?>
                    </div>

                    <div class="product-card__content">
                        <?php
                        $categories = get_the_terms($product->get_id(), 'product_cat');
                        if ($categories && !is_wp_error($categories)):
                        ?>
                        <span class="product-card__category"><?php echo esc_html($categories[0]->name); ?></span>
                        <?php endif; ?>

                        <h3 class="product-card__title"><?php the_title(); ?></h3>

                        <?php if (wc_review_ratings_enabled()): ?>
                        <?php $rating = $product->get_average_rating(); ?>
                        <?php if ($rating > 0): ?>
                        <div class="product-card__rating">
                            <?php echo wc_get_rating_html($rating); ?>
                            <span class="product-card__rating-count">(<?php echo $product->get_review_count(); ?>)</span>
                        </div>
                        <?php endif; ?>
                        <?php endif; ?>

                        <div class="product-card__price">
                            <?php echo $product->get_price_html(); ?>
                        </div>
                    </div>
                </a>

                <div class="product-card__actions">
                    <?php if ($product->is_in_stock()): ?>
                        <?php if ($product->is_type('simple')): ?>
                        <button type="button"
                                class="btn btn-primary btn-sm product-card__add-to-cart"
                                data-product-id="<?php echo esc_attr($product->get_id()); ?>">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="9" cy="21" r="1"></circle>
                                <circle cx="20" cy="21" r="1"></circle>
                                <path d="m1 1 4 4 2 14h13l3-9H6"></path>
                            </svg>
                            <span><?php esc_html_e('Add to Cart', 'flavor-starter'); ?></span>
                        </button>
                        <?php else: ?>
                        <a href="<?php the_permalink(); ?>" class="btn btn-outline btn-sm">
                            <?php esc_html_e('Select Options', 'flavor-starter'); ?>
                        </a>
                        <?php endif; ?>
                    <?php else: ?>
                    <span class="product-card__out-of-stock"><?php esc_html_e('Out of Stock', 'flavor-starter'); ?></span>
                    <?php endif; ?>

                    <button type="button"
                            class="btn btn-ghost btn-icon btn-sm product-card__quick-view"
                            data-product-id="<?php echo esc_attr($product->get_id()); ?>"
                            title="<?php esc_attr_e('Quick View', 'flavor-starter'); ?>">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </button>
                </div>
            </article>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    </div>
</section>

<!-- Quick View Modal -->
<div class="quick-view-modal" id="quick-view-modal" data-quick-view-modal>
    <div class="quick-view-modal__overlay" data-quick-view-close></div>
    <div class="quick-view-modal__content">
        <button type="button" class="quick-view-modal__close" data-quick-view-close aria-label="<?php esc_attr_e('Close', 'flavor-starter'); ?>">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
        <div class="quick-view-modal__body" id="quick-view-content">
            <!-- Content loaded via AJAX -->
        </div>
    </div>
</div>
