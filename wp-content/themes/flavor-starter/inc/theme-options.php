<?php
/**
 * Theme Options Page (Native WordPress Customizer + Options)
 *
 * @package Flavor_Starter
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Theme Options Page
 */
function flavor_add_theme_options_page(): void {
    add_menu_page(
        __('Theme Options', 'flavor-starter'),
        __('Theme Options', 'flavor-starter'),
        'manage_options',
        'flavor-theme-options',
        'flavor_theme_options_page',
        'dashicons-admin-generic',
        61
    );
}
add_action('admin_menu', 'flavor_add_theme_options_page');

/**
 * Theme Options Page HTML
 */
function flavor_theme_options_page(): void {
    if (!current_user_can('manage_options')) {
        return;
    }

    // Handle form submission
    if (isset($_POST['flavor_options_nonce']) && wp_verify_nonce($_POST['flavor_options_nonce'], 'flavor_save_options')) {
        $options = [
            // Contact Info
            'contact_phone'   => sanitize_text_field($_POST['contact_phone'] ?? ''),
            'contact_email'   => sanitize_email($_POST['contact_email'] ?? ''),
            'contact_address' => sanitize_textarea_field($_POST['contact_address'] ?? ''),

            // Social Links
            'social_facebook'  => esc_url_raw($_POST['social_facebook'] ?? ''),
            'social_twitter'   => esc_url_raw($_POST['social_twitter'] ?? ''),
            'social_instagram' => esc_url_raw($_POST['social_instagram'] ?? ''),
            'social_linkedin'  => esc_url_raw($_POST['social_linkedin'] ?? ''),
            'social_youtube'   => esc_url_raw($_POST['social_youtube'] ?? ''),
            'social_telegram'  => esc_url_raw($_POST['social_telegram'] ?? ''),

            // Footer
            'footer_copyright' => wp_kses_post($_POST['footer_copyright'] ?? ''),
            'footer_text'      => wp_kses_post($_POST['footer_text'] ?? ''),

            // Scripts
            'header_scripts' => $_POST['header_scripts'] ?? '',
            'footer_scripts' => $_POST['footer_scripts'] ?? '',

            // 404 Page
            '404_title'       => sanitize_text_field($_POST['404_title'] ?? ''),
            '404_description' => sanitize_textarea_field($_POST['404_description'] ?? ''),
        ];

        update_option('flavor_theme_options', $options);
        echo '<div class="notice notice-success"><p>' . esc_html__('Settings saved.', 'flavor-starter') . '</p></div>';
    }

    $options = get_option('flavor_theme_options', []);
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

        <form method="post" action="">
            <?php wp_nonce_field('flavor_save_options', 'flavor_options_nonce'); ?>

            <div class="nav-tab-wrapper">
                <a href="#contact" class="nav-tab nav-tab-active" data-tab="contact"><?php esc_html_e('Contact Info', 'flavor-starter'); ?></a>
                <a href="#social" class="nav-tab" data-tab="social"><?php esc_html_e('Social Links', 'flavor-starter'); ?></a>
                <a href="#footer" class="nav-tab" data-tab="footer"><?php esc_html_e('Footer', 'flavor-starter'); ?></a>
                <a href="#scripts" class="nav-tab" data-tab="scripts"><?php esc_html_e('Scripts', 'flavor-starter'); ?></a>
                <a href="#404" class="nav-tab" data-tab="404"><?php esc_html_e('404 Page', 'flavor-starter'); ?></a>
            </div>

            <!-- Contact Info Tab -->
            <div class="tab-content" id="tab-contact">
                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <label for="contact_phone"><?php esc_html_e('Phone Number', 'flavor-starter'); ?></label>
                        </th>
                        <td>
                            <input type="text" id="contact_phone" name="contact_phone"
                                   value="<?php echo esc_attr($options['contact_phone'] ?? ''); ?>"
                                   class="regular-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="contact_email"><?php esc_html_e('Email Address', 'flavor-starter'); ?></label>
                        </th>
                        <td>
                            <input type="email" id="contact_email" name="contact_email"
                                   value="<?php echo esc_attr($options['contact_email'] ?? ''); ?>"
                                   class="regular-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="contact_address"><?php esc_html_e('Address', 'flavor-starter'); ?></label>
                        </th>
                        <td>
                            <textarea id="contact_address" name="contact_address" rows="3" class="large-text"><?php echo esc_textarea($options['contact_address'] ?? ''); ?></textarea>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Social Links Tab -->
            <div class="tab-content" id="tab-social" style="display: none;">
                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <label for="social_facebook"><?php esc_html_e('Facebook URL', 'flavor-starter'); ?></label>
                        </th>
                        <td>
                            <input type="url" id="social_facebook" name="social_facebook"
                                   value="<?php echo esc_url($options['social_facebook'] ?? ''); ?>"
                                   class="regular-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="social_twitter"><?php esc_html_e('Twitter/X URL', 'flavor-starter'); ?></label>
                        </th>
                        <td>
                            <input type="url" id="social_twitter" name="social_twitter"
                                   value="<?php echo esc_url($options['social_twitter'] ?? ''); ?>"
                                   class="regular-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="social_instagram"><?php esc_html_e('Instagram URL', 'flavor-starter'); ?></label>
                        </th>
                        <td>
                            <input type="url" id="social_instagram" name="social_instagram"
                                   value="<?php echo esc_url($options['social_instagram'] ?? ''); ?>"
                                   class="regular-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="social_linkedin"><?php esc_html_e('LinkedIn URL', 'flavor-starter'); ?></label>
                        </th>
                        <td>
                            <input type="url" id="social_linkedin" name="social_linkedin"
                                   value="<?php echo esc_url($options['social_linkedin'] ?? ''); ?>"
                                   class="regular-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="social_youtube"><?php esc_html_e('YouTube URL', 'flavor-starter'); ?></label>
                        </th>
                        <td>
                            <input type="url" id="social_youtube" name="social_youtube"
                                   value="<?php echo esc_url($options['social_youtube'] ?? ''); ?>"
                                   class="regular-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="social_telegram"><?php esc_html_e('Telegram URL', 'flavor-starter'); ?></label>
                        </th>
                        <td>
                            <input type="url" id="social_telegram" name="social_telegram"
                                   value="<?php echo esc_url($options['social_telegram'] ?? ''); ?>"
                                   class="regular-text">
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Footer Tab -->
            <div class="tab-content" id="tab-footer" style="display: none;">
                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <label for="footer_copyright"><?php esc_html_e('Copyright Text', 'flavor-starter'); ?></label>
                        </th>
                        <td>
                            <input type="text" id="footer_copyright" name="footer_copyright"
                                   value="<?php echo esc_attr($options['footer_copyright'] ?? ''); ?>"
                                   class="large-text">
                            <p class="description"><?php esc_html_e('Use {year} for dynamic year', 'flavor-starter'); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="footer_text"><?php esc_html_e('Footer Text', 'flavor-starter'); ?></label>
                        </th>
                        <td>
                            <textarea id="footer_text" name="footer_text" rows="4" class="large-text"><?php echo esc_textarea($options['footer_text'] ?? ''); ?></textarea>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Scripts Tab -->
            <div class="tab-content" id="tab-scripts" style="display: none;">
                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <label for="header_scripts"><?php esc_html_e('Header Scripts', 'flavor-starter'); ?></label>
                        </th>
                        <td>
                            <textarea id="header_scripts" name="header_scripts" rows="6" class="large-text code"><?php echo esc_textarea($options['header_scripts'] ?? ''); ?></textarea>
                            <p class="description"><?php esc_html_e('Scripts to add before </head>. Include <script> tags.', 'flavor-starter'); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="footer_scripts"><?php esc_html_e('Footer Scripts', 'flavor-starter'); ?></label>
                        </th>
                        <td>
                            <textarea id="footer_scripts" name="footer_scripts" rows="6" class="large-text code"><?php echo esc_textarea($options['footer_scripts'] ?? ''); ?></textarea>
                            <p class="description"><?php esc_html_e('Scripts to add before </body>. Include <script> tags.', 'flavor-starter'); ?></p>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- 404 Page Tab -->
            <div class="tab-content" id="tab-404" style="display: none;">
                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <label for="404_title"><?php esc_html_e('404 Page Title', 'flavor-starter'); ?></label>
                        </th>
                        <td>
                            <input type="text" id="404_title" name="404_title"
                                   value="<?php echo esc_attr($options['404_title'] ?? 'Page Not Found'); ?>"
                                   class="regular-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="404_description"><?php esc_html_e('404 Page Description', 'flavor-starter'); ?></label>
                        </th>
                        <td>
                            <textarea id="404_description" name="404_description" rows="3" class="large-text"><?php echo esc_textarea($options['404_description'] ?? ''); ?></textarea>
                        </td>
                    </tr>
                </table>
            </div>

            <?php submit_button(); ?>
        </form>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('.nav-tab');
        const contents = document.querySelectorAll('.tab-content');

        tabs.forEach(function(tab) {
            tab.addEventListener('click', function(e) {
                e.preventDefault();

                tabs.forEach(function(t) {
                    t.classList.remove('nav-tab-active');
                });
                contents.forEach(function(c) {
                    c.style.display = 'none';
                });

                this.classList.add('nav-tab-active');
                document.getElementById('tab-' + this.dataset.tab).style.display = 'block';
            });
        });
    });
    </script>
    <?php
}

/**
 * Add custom scripts to header
 */
function flavor_header_scripts(): void {
    $options = get_option('flavor_theme_options', []);
    if (!empty($options['header_scripts'])) {
        echo $options['header_scripts'];
    }
}
add_action('wp_head', 'flavor_header_scripts', 999);

/**
 * Add custom scripts to footer
 */
function flavor_footer_scripts(): void {
    $options = get_option('flavor_theme_options', []);
    if (!empty($options['footer_scripts'])) {
        echo $options['footer_scripts'];
    }
}
add_action('wp_footer', 'flavor_footer_scripts', 999);

/**
 * Customizer Settings
 */
function flavor_customize_register(WP_Customize_Manager $wp_customize): void {
    // Primary Color
    $wp_customize->add_setting('flavor_primary_color', [
        'default'           => '#6366f1',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'flavor_primary_color', [
        'label'    => __('Primary Color', 'flavor-starter'),
        'section'  => 'colors',
        'settings' => 'flavor_primary_color',
    ]));

    // Secondary Color
    $wp_customize->add_setting('flavor_secondary_color', [
        'default'           => '#ec4899',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'flavor_secondary_color', [
        'label'    => __('Secondary Color', 'flavor-starter'),
        'section'  => 'colors',
        'settings' => 'flavor_secondary_color',
    ]));

    // Header Section
    $wp_customize->add_section('flavor_header', [
        'title'    => __('Header Settings', 'flavor-starter'),
        'priority' => 30,
    ]);

    // Sticky Header
    $wp_customize->add_setting('flavor_sticky_header', [
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ]);

    $wp_customize->add_control('flavor_sticky_header', [
        'label'    => __('Enable Sticky Header', 'flavor-starter'),
        'section'  => 'flavor_header',
        'type'     => 'checkbox',
    ]);

    // Transparent Header on Homepage
    $wp_customize->add_setting('flavor_transparent_header', [
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ]);

    $wp_customize->add_control('flavor_transparent_header', [
        'label'    => __('Transparent Header on Homepage', 'flavor-starter'),
        'section'  => 'flavor_header',
        'type'     => 'checkbox',
    ]);

    // Blog Section
    $wp_customize->add_section('flavor_blog', [
        'title'    => __('Blog Settings', 'flavor-starter'),
        'priority' => 40,
    ]);

    // Blog Layout
    $wp_customize->add_setting('flavor_blog_layout', [
        'default'           => 'grid',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('flavor_blog_layout', [
        'label'   => __('Blog Layout', 'flavor-starter'),
        'section' => 'flavor_blog',
        'type'    => 'select',
        'choices' => [
            'grid' => __('Grid', 'flavor-starter'),
            'list' => __('List', 'flavor-starter'),
        ],
    ]);

    // Posts per row
    $wp_customize->add_setting('flavor_posts_per_row', [
        'default'           => 3,
        'sanitize_callback' => 'absint',
    ]);

    $wp_customize->add_control('flavor_posts_per_row', [
        'label'   => __('Posts Per Row', 'flavor-starter'),
        'section' => 'flavor_blog',
        'type'    => 'select',
        'choices' => [
            2 => '2',
            3 => '3',
            4 => '4',
        ],
    ]);
}
add_action('customize_register', 'flavor_customize_register');

/**
 * Output custom colors CSS
 */
function flavor_customizer_css(): void {
    $primary_color = get_theme_mod('flavor_primary_color', '#6366f1');
    $secondary_color = get_theme_mod('flavor_secondary_color', '#ec4899');

    // Convert hex to RGB
    $primary_rgb = flavor_hex_to_rgb($primary_color);

    ?>
    <style type="text/css">
        :root {
            --color-primary: <?php echo esc_attr($primary_color); ?>;
            --color-secondary: <?php echo esc_attr($secondary_color); ?>;
            <?php if ($primary_rgb): ?>
            --color-primary-rgb: <?php echo esc_attr($primary_rgb); ?>;
            <?php endif; ?>
        }
    </style>
    <?php
}
add_action('wp_head', 'flavor_customizer_css');

/**
 * Convert hex color to RGB
 */
function flavor_hex_to_rgb(string $hex): string {
    $hex = str_replace('#', '', $hex);

    if (strlen($hex) === 3) {
        $r = hexdec(str_repeat(substr($hex, 0, 1), 2));
        $g = hexdec(str_repeat(substr($hex, 1, 1), 2));
        $b = hexdec(str_repeat(substr($hex, 2, 1), 2));
    } else {
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
    }

    return "{$r}, {$g}, {$b}";
}
