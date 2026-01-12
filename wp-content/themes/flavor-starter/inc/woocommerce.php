<?php
/**
 * WooCommerce Custom Functions
 *
 * @package Flavor_Starter
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Disable WooCommerce Coming Soon / Launch Your Store mode
 * This ensures the shop is always accessible
 */
add_filter('woocommerce_coming_soon_exclude', '__return_true', 9999);
add_filter('woocommerce_is_coming_soon', '__return_false', 9999);

// Force disable coming soon via options
add_action('init', function() {
    if (get_option('woocommerce_coming_soon') !== 'no') {
        update_option('woocommerce_coming_soon', 'no');
    }
    if (get_option('woocommerce_store_pages_only') !== 'no') {
        update_option('woocommerce_store_pages_only', 'no');
    }
}, 1);

/**
 * Remove default WooCommerce styles
 */
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

/**
 * WooCommerce setup
 */
function flavor_woocommerce_setup(): void {
    add_theme_support('woocommerce', [
        'thumbnail_image_width' => 600,
        'single_image_width'    => 800,
        'product_grid'          => [
            'default_rows'    => 4,
            'min_rows'        => 2,
            'max_rows'        => 8,
            'default_columns' => 4,
            'min_columns'     => 2,
            'max_columns'     => 5,
        ],
    ]);
}
add_action('after_setup_theme', 'flavor_woocommerce_setup');

/**
 * Products per page
 */
function flavor_products_per_page(): int {
    return 12;
}
add_filter('loop_shop_per_page', 'flavor_products_per_page');

/**
 * Products per row
 */
function flavor_loop_columns(): int {
    return 4;
}
add_filter('loop_shop_columns', 'flavor_loop_columns');

/**
 * Related products count
 */
function flavor_related_products_args(array $args): array {
    $args['posts_per_page'] = 4;
    $args['columns'] = 4;
    return $args;
}
add_filter('woocommerce_output_related_products_args', 'flavor_related_products_args');

/**
 * Remove default WooCommerce wrappers
 */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

/**
 * Custom content wrapper start
 */
function flavor_woocommerce_wrapper_start(): void {
    echo '<main id="primary" class="site-main woocommerce-main">';
    echo '<div class="container">';
}
add_action('woocommerce_before_main_content', 'flavor_woocommerce_wrapper_start', 10);

/**
 * Custom content wrapper end
 */
function flavor_woocommerce_wrapper_end(): void {
    echo '</div>';
    echo '</main>';
}
add_action('woocommerce_after_main_content', 'flavor_woocommerce_wrapper_end', 10);

/**
 * Remove default sidebar
 */
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

/**
 * Custom sidebar for shop
 */
function flavor_woocommerce_sidebar(): void {
    if (is_active_sidebar('shop-sidebar')) {
        echo '<aside id="secondary" class="shop-sidebar widget-area">';
        dynamic_sidebar('shop-sidebar');
        echo '</aside>';
    }
}
add_action('woocommerce_sidebar', 'flavor_woocommerce_sidebar', 10);

/**
 * Custom shop page title
 */
function flavor_woocommerce_show_page_title(): bool {
    return false;
}
add_filter('woocommerce_show_page_title', 'flavor_woocommerce_show_page_title');

/**
 * Shop page header
 */
function flavor_shop_page_header(): void {
    if (is_shop() || is_product_category() || is_product_tag()) {
        ?>
        <div class="shop-header">
            <div class="shop-header__content">
                <?php if (is_shop()): ?>
                    <h1 class="shop-header__title"><?php woocommerce_page_title(); ?></h1>
                    <?php if (get_option('woocommerce_shop_page_id')): ?>
                        <?php $shop_page = get_post(get_option('woocommerce_shop_page_id')); ?>
                        <?php if ($shop_page && $shop_page->post_content): ?>
                            <div class="shop-header__description">
                                <?php echo wp_kses_post($shop_page->post_content); ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php elseif (is_product_category()): ?>
                    <h1 class="shop-header__title"><?php single_cat_title(); ?></h1>
                    <?php if (category_description()): ?>
                        <div class="shop-header__description">
                            <?php echo category_description(); ?>
                        </div>
                    <?php endif; ?>
                <?php elseif (is_product_tag()): ?>
                    <h1 class="shop-header__title"><?php single_tag_title(); ?></h1>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }
}
add_action('woocommerce_before_main_content', 'flavor_shop_page_header', 15);

/**
 * Remove breadcrumbs
 */
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

/**
 * Add custom breadcrumbs
 */
function flavor_woocommerce_breadcrumbs(): void {
    if (is_shop() || is_product_category() || is_product_tag() || is_product()) {
        woocommerce_breadcrumb([
            'delimiter'   => '<span class="breadcrumb-separator"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg></span>',
            'wrap_before' => '<nav class="woocommerce-breadcrumb breadcrumb"><div class="container">',
            'wrap_after'  => '</div></nav>',
            'before'      => '<span class="breadcrumb-item">',
            'after'       => '</span>',
        ]);
    }
}
add_action('flavor_after_header', 'flavor_woocommerce_breadcrumbs', 5);

/**
 * Product card customization - Remove link from title
 */
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);

/**
 * Custom product card wrapper start
 */
function flavor_product_card_start(): void {
    echo '<div class="product-card">';
    echo '<a href="' . esc_url(get_the_permalink()) . '" class="product-card__link">';
}
add_action('woocommerce_before_shop_loop_item', 'flavor_product_card_start', 10);

/**
 * Custom product card wrapper end
 */
function flavor_product_card_end(): void {
    echo '</a>';
    echo '</div>';
}
add_action('woocommerce_after_shop_loop_item', 'flavor_product_card_end', 20);

/**
 * Product thumbnail wrapper
 */
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

function flavor_product_thumbnail(): void {
    global $product;

    echo '<div class="product-card__image-wrapper">';

    // Product badge
    $badge = '';
    if (function_exists('get_field')) {
        $badge = get_field('product_badge', $product->get_id());
    }

    if ($badge) {
        echo '<span class="product-card__badge">' . esc_html($badge) . '</span>';
    } elseif ($product->is_on_sale()) {
        echo '<span class="product-card__badge product-card__badge--sale">' . esc_html__('Sale', 'flavor-starter') . '</span>';
    } elseif ($product->is_featured()) {
        echo '<span class="product-card__badge product-card__badge--featured">' . esc_html__('Featured', 'flavor-starter') . '</span>';
    }

    // Main image
    echo '<div class="product-card__image">';
    echo woocommerce_get_product_thumbnail('flavor-product');
    echo '</div>';

    // Hover image
    $gallery_ids = $product->get_gallery_image_ids();
    if (!empty($gallery_ids)) {
        echo '<div class="product-card__image product-card__image--hover">';
        echo wp_get_attachment_image($gallery_ids[0], 'flavor-product');
        echo '</div>';
    }

    echo '</div>';
}
add_action('woocommerce_before_shop_loop_item_title', 'flavor_product_thumbnail', 10);

/**
 * Product title wrapper
 */
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);

function flavor_product_title(): void {
    echo '<div class="product-card__content">';
    echo '<h3 class="product-card__title">' . get_the_title() . '</h3>';
}
add_action('woocommerce_shop_loop_item_title', 'flavor_product_title', 10);

/**
 * Product info wrapper
 */
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

function flavor_product_info(): void {
    global $product;

    // Rating
    if (wc_review_ratings_enabled()) {
        $rating = $product->get_average_rating();
        if ($rating > 0) {
            echo '<div class="product-card__rating">';
            echo wc_get_rating_html($rating);
            echo '<span class="product-card__rating-count">(' . $product->get_review_count() . ')</span>';
            echo '</div>';
        }
    }

    // Price
    echo '<div class="product-card__price">';
    echo $product->get_price_html();
    echo '</div>';

    echo '</div>'; // Close .product-card__content
}
add_action('woocommerce_after_shop_loop_item_title', 'flavor_product_info', 10);

/**
 * Add to cart button
 */
function flavor_product_add_to_cart(): void {
    global $product;

    echo '<div class="product-card__actions">';

    if ($product->is_in_stock()) {
        if ($product->is_type('simple')) {
            echo '<button type="button" class="btn btn-primary btn-sm product-card__add-to-cart" data-product-id="' . esc_attr($product->get_id()) . '">';
            echo '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="m1 1 4 4 2 14h13l3-9H6"></path></svg>';
            echo '<span>' . esc_html__('Add to Cart', 'flavor-starter') . '</span>';
            echo '</button>';
        } else {
            echo '<a href="' . esc_url($product->get_permalink()) . '" class="btn btn-outline btn-sm">';
            echo esc_html__('Select Options', 'flavor-starter');
            echo '</a>';
        }
    } else {
        echo '<span class="product-card__out-of-stock">' . esc_html__('Out of Stock', 'flavor-starter') . '</span>';
    }

    // Quick view button
    echo '<button type="button" class="btn btn-ghost btn-icon btn-sm product-card__quick-view" data-product-id="' . esc_attr($product->get_id()) . '" title="' . esc_attr__('Quick View', 'flavor-starter') . '">';
    echo '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>';
    echo '</button>';

    echo '</div>';
}
add_action('woocommerce_after_shop_loop_item', 'flavor_product_add_to_cart', 15);

/**
 * Single product - move price after excerpt
 */
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 25);

/**
 * Single product - gallery customization
 */
function flavor_single_product_gallery_classes(array $classes): array {
    $classes[] = 'flavor-gallery';
    return $classes;
}
add_filter('woocommerce_single_product_image_gallery_classes', 'flavor_single_product_gallery_classes');

/**
 * Mini cart customization
 */
function flavor_woocommerce_mini_cart(): void {
    ?>
    <div class="mini-cart" id="mini-cart">
        <div class="mini-cart__header">
            <h3 class="mini-cart__title"><?php esc_html_e('Shopping Cart', 'flavor-starter'); ?></h3>
            <button type="button" class="mini-cart__close" aria-label="<?php esc_attr_e('Close cart', 'flavor-starter'); ?>">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        <div class="mini-cart__content">
            <?php woocommerce_mini_cart(); ?>
        </div>
    </div>
    <div class="mini-cart__overlay" id="mini-cart-overlay"></div>
    <?php
}
add_action('wp_footer', 'flavor_woocommerce_mini_cart');

/**
 * Cart fragments
 */
function flavor_cart_fragments(array $fragments): array {
    ob_start();
    ?>
    <span class="header-cart__count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
    <?php
    $fragments['.header-cart__count'] = ob_get_clean();

    ob_start();
    ?>
    <span class="header-cart__total"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
    <?php
    $fragments['.header-cart__total'] = ob_get_clean();

    ob_start();
    woocommerce_mini_cart();
    $fragments['div.widget_shopping_cart_content'] = '<div class="widget_shopping_cart_content">' . ob_get_clean() . '</div>';

    return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'flavor_cart_fragments');

/**
 * Checkout customization
 */
function flavor_checkout_fields(array $fields): array {
    // Remove order comments
    // unset($fields['order']['order_comments']);

    // Add placeholders
    $fields['billing']['billing_first_name']['placeholder'] = __('First Name', 'flavor-starter');
    $fields['billing']['billing_last_name']['placeholder'] = __('Last Name', 'flavor-starter');
    $fields['billing']['billing_email']['placeholder'] = __('Email Address', 'flavor-starter');
    $fields['billing']['billing_phone']['placeholder'] = __('Phone Number', 'flavor-starter');

    return $fields;
}
add_filter('woocommerce_checkout_fields', 'flavor_checkout_fields');

/**
 * AJAX add to cart
 */
function flavor_ajax_add_to_cart(): void {
    check_ajax_referer('flavor_nonce', 'nonce');

    $product_id = isset($_POST['product_id']) ? absint($_POST['product_id']) : 0;
    $quantity = isset($_POST['quantity']) ? absint($_POST['quantity']) : 1;

    if (!$product_id) {
        wp_send_json_error(['message' => __('Invalid product.', 'flavor-starter')]);
    }

    $product = wc_get_product($product_id);

    if (!$product) {
        wp_send_json_error(['message' => __('Product not found.', 'flavor-starter')]);
    }

    $cart_item_key = WC()->cart->add_to_cart($product_id, $quantity);

    if ($cart_item_key) {
        WC_AJAX::get_refreshed_fragments();
    } else {
        wp_send_json_error(['message' => __('Could not add to cart.', 'flavor-starter')]);
    }
}
add_action('wp_ajax_flavor_add_to_cart', 'flavor_ajax_add_to_cart');
add_action('wp_ajax_nopriv_flavor_add_to_cart', 'flavor_ajax_add_to_cart');

/**
 * Change number of thumbnails per row in product gallery
 */
function flavor_product_thumbnails_columns(): int {
    return 4;
}
add_filter('woocommerce_product_thumbnails_columns', 'flavor_product_thumbnails_columns');

/**
 * Change number of upsells products to display
 */
function flavor_upsells_products(array $args): array {
    $args['posts_per_page'] = 4;
    $args['columns'] = 4;
    return $args;
}
add_filter('woocommerce_upsell_display_args', 'flavor_upsells_products');

/**
 * Cross sells on cart page
 */
function flavor_cross_sells_total(): int {
    return 4;
}
add_filter('woocommerce_cross_sells_total', 'flavor_cross_sells_total');

function flavor_cross_sells_columns(): int {
    return 4;
}
add_filter('woocommerce_cross_sells_columns', 'flavor_cross_sells_columns');

/**
 * Empty cart message
 */
function flavor_empty_cart_message(): void {
    ?>
    <div class="cart-empty-wrapper">
        <div class="cart-empty-icon">
            <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                <circle cx="9" cy="21" r="1"></circle>
                <circle cx="20" cy="21" r="1"></circle>
                <path d="m1 1 4 4 2 14h13l3-9H6"></path>
            </svg>
        </div>
        <p class="cart-empty-message"><?php esc_html_e('Your cart is currently empty.', 'flavor-starter'); ?></p>
        <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="btn btn-primary">
            <?php esc_html_e('Start Shopping', 'flavor-starter'); ?>
        </a>
    </div>
    <?php
}
remove_action('woocommerce_cart_is_empty', 'wc_empty_cart_message', 10);
add_action('woocommerce_cart_is_empty', 'flavor_empty_cart_message', 10);

/**
 * Product specifications on single product page
 */
function flavor_product_specifications(): void {
    global $product;

    if (!function_exists('get_field')) {
        return;
    }

    $specs = get_field('product_specs', $product->get_id());

    if (!$specs) {
        return;
    }

    $specs_array = array_filter(array_map('trim', explode("\n", $specs)));

    if (empty($specs_array)) {
        return;
    }
    ?>
    <div class="product-specifications">
        <h3><?php esc_html_e('Specifications', 'flavor-starter'); ?></h3>
        <table class="specifications-table">
            <?php foreach ($specs_array as $spec): ?>
                <?php
                $parts = explode(':', $spec, 2);
                if (count($parts) === 2):
                ?>
                <tr>
                    <th><?php echo esc_html(trim($parts[0])); ?></th>
                    <td><?php echo esc_html(trim($parts[1])); ?></td>
                </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </table>
    </div>
    <?php
}
add_action('woocommerce_single_product_summary', 'flavor_product_specifications', 35);

/**
 * Product video tab
 */
function flavor_product_video_tab(array $tabs): array {
    global $product;

    if (!function_exists('get_field')) {
        return $tabs;
    }

    $video = get_field('product_video', $product->get_id());

    if ($video) {
        $tabs['video'] = [
            'title'    => __('Video', 'flavor-starter'),
            'priority' => 25,
            'callback' => 'flavor_product_video_tab_content',
        ];
    }

    return $tabs;
}
add_filter('woocommerce_product_tabs', 'flavor_product_video_tab');

/**
 * Product video tab content
 */
function flavor_product_video_tab_content(): void {
    global $product;

    if (!function_exists('get_field')) {
        return;
    }

    $video = get_field('product_video', $product->get_id());

    if ($video) {
        echo '<div class="product-video">';
        echo wp_oembed_get($video);
        echo '</div>';
    }
}

/**
 * Remove product meta
 */
// remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

/**
 * Wrap product meta
 */
function flavor_product_meta_start(): void {
    echo '<div class="product-meta-wrapper">';
}
add_action('woocommerce_single_product_summary', 'flavor_product_meta_start', 39);

function flavor_product_meta_end(): void {
    echo '</div>';
}
add_action('woocommerce_single_product_summary', 'flavor_product_meta_end', 41);
