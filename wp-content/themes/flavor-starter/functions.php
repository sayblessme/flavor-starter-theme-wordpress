<?php
/**
 * Flavor Starter Theme Functions
 *
 * @package Flavor_Starter
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme Constants
 */
define('FLAVOR_VERSION', '1.0.0');
define('FLAVOR_DIR', get_template_directory());
define('FLAVOR_URI', get_template_directory_uri());
define('FLAVOR_ASSETS', FLAVOR_URI . '/assets');

/**
 * Theme Setup
 */
function flavor_setup(): void {
    // Text Domain for translations
    load_theme_textdomain('flavor-starter', FLAVOR_DIR . '/languages');

    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');

    // Custom image sizes
    add_image_size('flavor-hero', 1920, 1080, true);
    add_image_size('flavor-card', 600, 400, true);
    add_image_size('flavor-card-wide', 800, 500, true);
    add_image_size('flavor-square', 600, 600, true);
    add_image_size('flavor-portrait', 600, 800, true);
    add_image_size('flavor-product', 800, 800, true);
    add_image_size('flavor-product-thumb', 300, 300, true);

    // Register navigation menus
    register_nav_menus([
        'primary'   => esc_html__('Primary Menu', 'flavor-starter'),
        'footer'    => esc_html__('Footer Menu', 'flavor-starter'),
        'footer-2'  => esc_html__('Footer Menu 2', 'flavor-starter'),
        'mobile'    => esc_html__('Mobile Menu', 'flavor-starter'),
    ]);

    // HTML5 support
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ]);

    // Custom logo support
    add_theme_support('custom-logo', [
        'height'      => 60,
        'width'       => 200,
        'flex-width'  => true,
        'flex-height' => true,
    ]);

    // Custom background support
    add_theme_support('custom-background', [
        'default-color' => 'ffffff',
    ]);

    // Selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');

    // Wide alignment support for Gutenberg
    add_theme_support('align-wide');

    // Responsive embeds
    add_theme_support('responsive-embeds');

    // Editor styles
    add_theme_support('editor-styles');
    add_editor_style('assets/css/editor-style.css');

    // WooCommerce support
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');

    // Block editor color palette
    add_theme_support('editor-color-palette', [
        [
            'name'  => esc_html__('Primary', 'flavor-starter'),
            'slug'  => 'primary',
            'color' => '#6366f1',
        ],
        [
            'name'  => esc_html__('Secondary', 'flavor-starter'),
            'slug'  => 'secondary',
            'color' => '#ec4899',
        ],
        [
            'name'  => esc_html__('Accent', 'flavor-starter'),
            'slug'  => 'accent',
            'color' => '#14b8a6',
        ],
        [
            'name'  => esc_html__('Dark', 'flavor-starter'),
            'slug'  => 'dark',
            'color' => '#111827',
        ],
        [
            'name'  => esc_html__('Light', 'flavor-starter'),
            'slug'  => 'light',
            'color' => '#f9fafb',
        ],
    ]);
}
add_action('after_setup_theme', 'flavor_setup');

/**
 * Set content width
 */
function flavor_content_width(): void {
    $GLOBALS['content_width'] = apply_filters('flavor_content_width', 1280);
}
add_action('after_setup_theme', 'flavor_content_width', 0);

/**
 * Enqueue scripts and styles
 */
function flavor_scripts(): void {
    // Google Fonts
    wp_enqueue_style(
        'flavor-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700&display=swap',
        [],
        null
    );

    // Main stylesheet
    wp_enqueue_style(
        'flavor-style',
        get_stylesheet_uri(),
        [],
        FLAVOR_VERSION
    );

    // Theme CSS
    wp_enqueue_style(
        'flavor-theme',
        FLAVOR_ASSETS . '/css/theme.css',
        ['flavor-style'],
        FLAVOR_VERSION
    );

    // Header CSS
    wp_enqueue_style(
        'flavor-header',
        FLAVOR_ASSETS . '/css/header.css',
        ['flavor-theme'],
        FLAVOR_VERSION
    );

    // Footer CSS
    wp_enqueue_style(
        'flavor-footer',
        FLAVOR_ASSETS . '/css/footer.css',
        ['flavor-theme'],
        FLAVOR_VERSION
    );

    // Components CSS
    wp_enqueue_style(
        'flavor-components',
        FLAVOR_ASSETS . '/css/components.css',
        ['flavor-theme'],
        FLAVOR_VERSION
    );

    // Responsive CSS
    wp_enqueue_style(
        'flavor-responsive',
        FLAVOR_ASSETS . '/css/responsive.css',
        ['flavor-theme'],
        FLAVOR_VERSION
    );

    // WooCommerce CSS (if active)
    if (class_exists('WooCommerce')) {
        wp_enqueue_style(
            'flavor-woocommerce',
            FLAVOR_ASSETS . '/css/woocommerce.css',
            ['flavor-theme'],
            FLAVOR_VERSION
        );
    }

    // Main JS
    wp_enqueue_script(
        'flavor-main',
        FLAVOR_ASSETS . '/js/main.js',
        [],
        FLAVOR_VERSION,
        true
    );

    // Animations JS
    wp_enqueue_script(
        'flavor-animations',
        FLAVOR_ASSETS . '/js/animations.js',
        ['flavor-main'],
        FLAVOR_VERSION,
        true
    );

    // Navigation JS
    wp_enqueue_script(
        'flavor-navigation',
        FLAVOR_ASSETS . '/js/navigation.js',
        ['flavor-main'],
        FLAVOR_VERSION,
        true
    );

    // Localize script
    wp_localize_script('flavor-main', 'flavorData', [
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('flavor_nonce'),
        'homeUrl' => home_url('/'),
    ]);

    // Comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'flavor_scripts');

/**
 * Register widget areas
 */
function flavor_widgets_init(): void {
    // Footer Widget Area 1
    register_sidebar([
        'name'          => esc_html__('Footer 1', 'flavor-starter'),
        'id'            => 'footer-1',
        'description'   => esc_html__('Add widgets here to appear in footer column 1.', 'flavor-starter'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ]);

    // Footer Widget Area 2
    register_sidebar([
        'name'          => esc_html__('Footer 2', 'flavor-starter'),
        'id'            => 'footer-2',
        'description'   => esc_html__('Add widgets here to appear in footer column 2.', 'flavor-starter'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ]);

    // Footer Widget Area 3
    register_sidebar([
        'name'          => esc_html__('Footer 3', 'flavor-starter'),
        'id'            => 'footer-3',
        'description'   => esc_html__('Add widgets here to appear in footer column 3.', 'flavor-starter'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ]);

    // Footer Widget Area 4
    register_sidebar([
        'name'          => esc_html__('Footer 4', 'flavor-starter'),
        'id'            => 'footer-4',
        'description'   => esc_html__('Add widgets here to appear in footer column 4.', 'flavor-starter'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ]);

    // Sidebar
    register_sidebar([
        'name'          => esc_html__('Sidebar', 'flavor-starter'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here to appear in sidebar.', 'flavor-starter'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ]);

    // Shop Sidebar
    register_sidebar([
        'name'          => esc_html__('Shop Sidebar', 'flavor-starter'),
        'id'            => 'shop-sidebar',
        'description'   => esc_html__('Add widgets here to appear in shop sidebar.', 'flavor-starter'),
        'before_widget' => '<div id="%1$s" class="widget shop-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ]);
}
add_action('widgets_init', 'flavor_widgets_init');

/**
 * Include additional files
 */

// Custom Post Types
require_once FLAVOR_DIR . '/inc/custom-post-types.php';

// Custom Taxonomies
require_once FLAVOR_DIR . '/inc/custom-taxonomies.php';

// ACF Fields
require_once FLAVOR_DIR . '/inc/acf-fields.php';

// Theme Options
require_once FLAVOR_DIR . '/inc/theme-options.php';

// WooCommerce customizations
if (class_exists('WooCommerce')) {
    require_once FLAVOR_DIR . '/inc/woocommerce.php';
}

// Template functions
require_once FLAVOR_DIR . '/inc/template-functions.php';

// Template tags
require_once FLAVOR_DIR . '/inc/template-tags.php';

// Walker Nav Menu
require_once FLAVOR_DIR . '/inc/class-flavor-walker-nav-menu.php';

/**
 * Custom excerpt length
 */
function flavor_excerpt_length(int $length): int {
    return 25;
}
add_filter('excerpt_length', 'flavor_excerpt_length');

/**
 * Custom excerpt more
 */
function flavor_excerpt_more(string $more): string {
    return '...';
}
add_filter('excerpt_more', 'flavor_excerpt_more');

/**
 * Add custom classes to body
 */
function flavor_body_classes(array $classes): array {
    // Add page slug
    if (is_singular()) {
        global $post;
        $classes[] = 'page-' . $post->post_name;
    }

    // Add class if sidebar is active
    if (is_active_sidebar('sidebar-1') && !is_front_page()) {
        $classes[] = 'has-sidebar';
    }

    // Add WooCommerce specific class
    if (class_exists('WooCommerce')) {
        if (is_shop() || is_product_category() || is_product_tag()) {
            $classes[] = 'flavor-shop-page';
        }
        if (is_product()) {
            $classes[] = 'flavor-product-page';
        }
    }

    return $classes;
}
add_filter('body_class', 'flavor_body_classes');

/**
 * Modify archive title
 */
function flavor_archive_title(string $title): string {
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_author()) {
        $title = get_the_author();
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title('', false);
    }

    return $title;
}
add_filter('get_the_archive_title', 'flavor_archive_title');

/**
 * Disable default WordPress gallery styles
 */
add_filter('use_default_gallery_style', '__return_false');

/**
 * Add SVG support
 */
function flavor_mime_types(array $mimes): array {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'flavor_mime_types');

/**
 * Preload fonts
 */
function flavor_preload_fonts(): void {
    ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php
}
add_action('wp_head', 'flavor_preload_fonts', 1);

/**
 * Add async/defer to scripts
 */
function flavor_script_loader_tag(string $tag, string $handle, string $src): string {
    $async_handles = ['flavor-animations'];
    $defer_handles = ['flavor-navigation'];

    if (in_array($handle, $async_handles, true)) {
        return str_replace(' src', ' async src', $tag);
    }

    if (in_array($handle, $defer_handles, true)) {
        return str_replace(' src', ' defer src', $tag);
    }

    return $tag;
}
add_filter('script_loader_tag', 'flavor_script_loader_tag', 10, 3);

/**
 * Remove WordPress version from scripts/styles
 */
function flavor_remove_version(string $src): string {
    if (strpos($src, 'ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('style_loader_src', 'flavor_remove_version', 9999);
add_filter('script_loader_src', 'flavor_remove_version', 9999);

/**
 * Disable emojis
 */
function flavor_disable_emojis(): void {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}
add_action('init', 'flavor_disable_emojis');

/**
 * Clean up wp_head
 */
function flavor_cleanup_head(): void {
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'rest_output_link_wp_head');
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
}
add_action('init', 'flavor_cleanup_head');

/**
 * AJAX: Load more posts
 */
function flavor_load_more_posts(): void {
    check_ajax_referer('flavor_nonce', 'nonce');

    $paged = isset($_POST['page']) ? absint($_POST['page']) : 1;
    $post_type = isset($_POST['post_type']) ? sanitize_text_field($_POST['post_type']) : 'post';

    $args = [
        'post_type'      => $post_type,
        'posts_per_page' => 6,
        'paged'          => $paged,
        'post_status'    => 'publish',
    ];

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/content', get_post_type());
        }
    }

    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_flavor_load_more', 'flavor_load_more_posts');
add_action('wp_ajax_nopriv_flavor_load_more', 'flavor_load_more_posts');

/**
 * AJAX: Product quick view
 */
function flavor_product_quick_view(): void {
    check_ajax_referer('flavor_nonce', 'nonce');

    $product_id = isset($_POST['product_id']) ? absint($_POST['product_id']) : 0;

    if (!$product_id) {
        wp_send_json_error('Invalid product ID');
    }

    $product = wc_get_product($product_id);

    if (!$product) {
        wp_send_json_error('Product not found');
    }

    ob_start();
    get_template_part('template-parts/woocommerce/quick-view', null, ['product' => $product]);
    $html = ob_get_clean();

    wp_send_json_success(['html' => $html]);
}
add_action('wp_ajax_flavor_quick_view', 'flavor_product_quick_view');
add_action('wp_ajax_nopriv_flavor_quick_view', 'flavor_product_quick_view');

/**
 * Custom login logo
 */
function flavor_login_logo(): void {
    $custom_logo_id = get_theme_mod('custom_logo');

    if ($custom_logo_id) {
        $logo_url = wp_get_attachment_image_url($custom_logo_id, 'full');
        ?>
        <style>
            #login h1 a {
                background-image: url(<?php echo esc_url($logo_url); ?>);
                background-size: contain;
                width: 200px;
                height: 60px;
            }
        </style>
        <?php
    }
}
add_action('login_enqueue_scripts', 'flavor_login_logo');

/**
 * Custom login URL
 */
function flavor_login_url(): string {
    return home_url('/');
}
add_filter('login_headerurl', 'flavor_login_url');

/**
 * Get theme option helper
 */
function flavor_get_option(string $option, $default = '') {
    $options = get_option('flavor_theme_options', []);
    return isset($options[$option]) ? $options[$option] : $default;
}

/**
 * Social links helper
 */
function flavor_get_social_links(): array {
    return [
        'facebook'  => flavor_get_option('social_facebook', ''),
        'twitter'   => flavor_get_option('social_twitter', ''),
        'instagram' => flavor_get_option('social_instagram', ''),
        'linkedin'  => flavor_get_option('social_linkedin', ''),
        'youtube'   => flavor_get_option('social_youtube', ''),
        'telegram'  => flavor_get_option('social_telegram', ''),
    ];
}

/**
 * Contact info helper
 */
function flavor_get_contact_info(): array {
    return [
        'phone'   => flavor_get_option('contact_phone', ''),
        'email'   => flavor_get_option('contact_email', ''),
        'address' => flavor_get_option('contact_address', ''),
    ];
}
