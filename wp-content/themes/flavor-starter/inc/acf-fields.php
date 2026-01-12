<?php
/**
 * ACF Fields Registration (Free Version Compatible)
 *
 * @package Flavor_Starter
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Check if ACF is active
 */
function flavor_is_acf_active(): bool {
    return class_exists('ACF');
}

/**
 * Register ACF Fields Programmatically
 */
function flavor_register_acf_fields(): void {
    if (!flavor_is_acf_active()) {
        return;
    }

    /**
     * Homepage Fields
     */
    acf_add_local_field_group([
        'key' => 'group_homepage',
        'title' => 'Homepage Settings',
        'fields' => [
            // Hero Section
            [
                'key' => 'field_hero_title',
                'label' => 'Hero Title',
                'name' => 'hero_title',
                'type' => 'text',
                'default_value' => 'We Create Digital Experiences',
            ],
            [
                'key' => 'field_hero_subtitle',
                'label' => 'Hero Subtitle',
                'name' => 'hero_subtitle',
                'type' => 'textarea',
                'rows' => 3,
                'default_value' => 'Award-winning design studio crafting beautiful digital products and experiences.',
            ],
            [
                'key' => 'field_hero_image',
                'label' => 'Hero Image',
                'name' => 'hero_image',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ],
            [
                'key' => 'field_hero_video_url',
                'label' => 'Hero Video URL (optional)',
                'name' => 'hero_video_url',
                'type' => 'url',
            ],
            [
                'key' => 'field_hero_cta_text',
                'label' => 'CTA Button Text',
                'name' => 'hero_cta_text',
                'type' => 'text',
                'default_value' => 'View Our Work',
            ],
            [
                'key' => 'field_hero_cta_url',
                'label' => 'CTA Button URL',
                'name' => 'hero_cta_url',
                'type' => 'url',
            ],
            // About Section
            [
                'key' => 'field_about_label',
                'label' => 'About Section Label',
                'name' => 'about_label',
                'type' => 'text',
                'default_value' => 'About Us',
            ],
            [
                'key' => 'field_about_title',
                'label' => 'About Section Title',
                'name' => 'about_title',
                'type' => 'text',
                'default_value' => 'Digital Studio with Soul',
            ],
            [
                'key' => 'field_about_description',
                'label' => 'About Description',
                'name' => 'about_description',
                'type' => 'wysiwyg',
                'toolbar' => 'basic',
                'media_upload' => 0,
            ],
            [
                'key' => 'field_about_image',
                'label' => 'About Image',
                'name' => 'about_image',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ],
            // Stats
            [
                'key' => 'field_stat_1_number',
                'label' => 'Stat 1 Number',
                'name' => 'stat_1_number',
                'type' => 'text',
                'default_value' => '150+',
            ],
            [
                'key' => 'field_stat_1_label',
                'label' => 'Stat 1 Label',
                'name' => 'stat_1_label',
                'type' => 'text',
                'default_value' => 'Projects Completed',
            ],
            [
                'key' => 'field_stat_2_number',
                'label' => 'Stat 2 Number',
                'name' => 'stat_2_number',
                'type' => 'text',
                'default_value' => '50+',
            ],
            [
                'key' => 'field_stat_2_label',
                'label' => 'Stat 2 Label',
                'name' => 'stat_2_label',
                'type' => 'text',
                'default_value' => 'Happy Clients',
            ],
            [
                'key' => 'field_stat_3_number',
                'label' => 'Stat 3 Number',
                'name' => 'stat_3_number',
                'type' => 'text',
                'default_value' => '10+',
            ],
            [
                'key' => 'field_stat_3_label',
                'label' => 'Stat 3 Label',
                'name' => 'stat_3_label',
                'type' => 'text',
                'default_value' => 'Years Experience',
            ],
            [
                'key' => 'field_stat_4_number',
                'label' => 'Stat 4 Number',
                'name' => 'stat_4_number',
                'type' => 'text',
                'default_value' => '25+',
            ],
            [
                'key' => 'field_stat_4_label',
                'label' => 'Stat 4 Label',
                'name' => 'stat_4_label',
                'type' => 'text',
                'default_value' => 'Awards Won',
            ],
            // CTA Section
            [
                'key' => 'field_cta_title',
                'label' => 'CTA Section Title',
                'name' => 'cta_title',
                'type' => 'text',
                'default_value' => 'Ready to Start Your Project?',
            ],
            [
                'key' => 'field_cta_description',
                'label' => 'CTA Description',
                'name' => 'cta_description',
                'type' => 'textarea',
                'rows' => 3,
            ],
            [
                'key' => 'field_cta_button_text',
                'label' => 'CTA Button Text',
                'name' => 'cta_button_text',
                'type' => 'text',
                'default_value' => 'Get in Touch',
            ],
            [
                'key' => 'field_cta_button_url',
                'label' => 'CTA Button URL',
                'name' => 'cta_button_url',
                'type' => 'url',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'page_type',
                    'operator' => '==',
                    'value' => 'front_page',
                ],
            ],
        ],
    ]);

    /**
     * Case Study Fields
     */
    acf_add_local_field_group([
        'key' => 'group_case',
        'title' => 'Case Study Details',
        'fields' => [
            [
                'key' => 'field_case_client',
                'label' => 'Client Name',
                'name' => 'case_client',
                'type' => 'text',
            ],
            [
                'key' => 'field_case_year',
                'label' => 'Year',
                'name' => 'case_year',
                'type' => 'text',
            ],
            [
                'key' => 'field_case_services',
                'label' => 'Services Provided',
                'name' => 'case_services',
                'type' => 'text',
                'instructions' => 'Comma-separated list of services',
            ],
            [
                'key' => 'field_case_website',
                'label' => 'Project Website',
                'name' => 'case_website',
                'type' => 'url',
            ],
            [
                'key' => 'field_case_challenge',
                'label' => 'Challenge',
                'name' => 'case_challenge',
                'type' => 'wysiwyg',
                'toolbar' => 'basic',
                'media_upload' => 0,
            ],
            [
                'key' => 'field_case_solution',
                'label' => 'Solution',
                'name' => 'case_solution',
                'type' => 'wysiwyg',
                'toolbar' => 'basic',
                'media_upload' => 0,
            ],
            [
                'key' => 'field_case_results',
                'label' => 'Results',
                'name' => 'case_results',
                'type' => 'wysiwyg',
                'toolbar' => 'basic',
                'media_upload' => 0,
            ],
            [
                'key' => 'field_case_gallery',
                'label' => 'Gallery Images',
                'name' => 'case_gallery',
                'type' => 'gallery',
                'return_format' => 'array',
                'preview_size' => 'medium',
                'min' => 0,
                'max' => 10,
            ],
            [
                'key' => 'field_case_testimonial',
                'label' => 'Client Testimonial',
                'name' => 'case_testimonial',
                'type' => 'textarea',
                'rows' => 4,
            ],
            [
                'key' => 'field_case_testimonial_author',
                'label' => 'Testimonial Author',
                'name' => 'case_testimonial_author',
                'type' => 'text',
            ],
            [
                'key' => 'field_case_testimonial_position',
                'label' => 'Author Position',
                'name' => 'case_testimonial_position',
                'type' => 'text',
            ],
            [
                'key' => 'field_case_color',
                'label' => 'Accent Color',
                'name' => 'case_color',
                'type' => 'color_picker',
                'default_value' => '#6366f1',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'case',
                ],
            ],
        ],
    ]);

    /**
     * Service Fields
     */
    acf_add_local_field_group([
        'key' => 'group_service',
        'title' => 'Service Details',
        'fields' => [
            [
                'key' => 'field_service_icon',
                'label' => 'Service Icon (SVG)',
                'name' => 'service_icon',
                'type' => 'textarea',
                'rows' => 4,
                'instructions' => 'Paste SVG code here',
            ],
            [
                'key' => 'field_service_short_desc',
                'label' => 'Short Description',
                'name' => 'service_short_desc',
                'type' => 'textarea',
                'rows' => 3,
            ],
            [
                'key' => 'field_service_features',
                'label' => 'Features (one per line)',
                'name' => 'service_features',
                'type' => 'textarea',
                'rows' => 6,
                'instructions' => 'Enter one feature per line',
            ],
            [
                'key' => 'field_service_price_from',
                'label' => 'Price From',
                'name' => 'service_price_from',
                'type' => 'text',
                'instructions' => 'e.g., "$500" or "Contact us"',
            ],
            [
                'key' => 'field_service_cta_text',
                'label' => 'CTA Button Text',
                'name' => 'service_cta_text',
                'type' => 'text',
                'default_value' => 'Learn More',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'service',
                ],
            ],
        ],
    ]);

    /**
     * Testimonial Fields
     */
    acf_add_local_field_group([
        'key' => 'group_testimonial',
        'title' => 'Testimonial Details',
        'fields' => [
            [
                'key' => 'field_testimonial_author',
                'label' => 'Author Name',
                'name' => 'testimonial_author',
                'type' => 'text',
            ],
            [
                'key' => 'field_testimonial_position',
                'label' => 'Position/Company',
                'name' => 'testimonial_position',
                'type' => 'text',
            ],
            [
                'key' => 'field_testimonial_rating',
                'label' => 'Rating (1-5)',
                'name' => 'testimonial_rating',
                'type' => 'number',
                'min' => 1,
                'max' => 5,
                'default_value' => 5,
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'testimonial',
                ],
            ],
        ],
    ]);

    /**
     * Team Member Fields
     */
    acf_add_local_field_group([
        'key' => 'group_team',
        'title' => 'Team Member Details',
        'fields' => [
            [
                'key' => 'field_team_position',
                'label' => 'Position',
                'name' => 'team_position',
                'type' => 'text',
            ],
            [
                'key' => 'field_team_bio',
                'label' => 'Short Bio',
                'name' => 'team_bio',
                'type' => 'textarea',
                'rows' => 4,
            ],
            [
                'key' => 'field_team_linkedin',
                'label' => 'LinkedIn URL',
                'name' => 'team_linkedin',
                'type' => 'url',
            ],
            [
                'key' => 'field_team_twitter',
                'label' => 'Twitter URL',
                'name' => 'team_twitter',
                'type' => 'url',
            ],
            [
                'key' => 'field_team_email',
                'label' => 'Email',
                'name' => 'team_email',
                'type' => 'email',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'team',
                ],
            ],
        ],
    ]);

    /**
     * Contact Page Fields
     */
    acf_add_local_field_group([
        'key' => 'group_contact_page',
        'title' => 'Contact Page Settings',
        'fields' => [
            [
                'key' => 'field_contact_subtitle',
                'label' => 'Subtitle',
                'name' => 'contact_subtitle',
                'type' => 'text',
            ],
            [
                'key' => 'field_contact_map_embed',
                'label' => 'Google Maps Embed Code',
                'name' => 'contact_map_embed',
                'type' => 'textarea',
                'rows' => 4,
            ],
            [
                'key' => 'field_contact_form_shortcode',
                'label' => 'Contact Form Shortcode',
                'name' => 'contact_form_shortcode',
                'type' => 'text',
                'instructions' => 'Paste Contact Form 7 or WPForms shortcode here',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-contact.php',
                ],
            ],
        ],
    ]);

    /**
     * About Page Fields
     */
    acf_add_local_field_group([
        'key' => 'group_about_page',
        'title' => 'About Page Settings',
        'fields' => [
            [
                'key' => 'field_about_hero_image',
                'label' => 'Hero Image',
                'name' => 'about_hero_image',
                'type' => 'image',
                'return_format' => 'array',
            ],
            [
                'key' => 'field_about_mission_title',
                'label' => 'Mission Title',
                'name' => 'about_mission_title',
                'type' => 'text',
            ],
            [
                'key' => 'field_about_mission_text',
                'label' => 'Mission Text',
                'name' => 'about_mission_text',
                'type' => 'wysiwyg',
                'toolbar' => 'basic',
            ],
            [
                'key' => 'field_about_vision_title',
                'label' => 'Vision Title',
                'name' => 'about_vision_title',
                'type' => 'text',
            ],
            [
                'key' => 'field_about_vision_text',
                'label' => 'Vision Text',
                'name' => 'about_vision_text',
                'type' => 'wysiwyg',
                'toolbar' => 'basic',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-about.php',
                ],
            ],
        ],
    ]);

    /**
     * WooCommerce Product Extra Fields
     */
    if (class_exists('WooCommerce')) {
        acf_add_local_field_group([
            'key' => 'group_product',
            'title' => 'Product Extra Details',
            'fields' => [
                [
                    'key' => 'field_product_badge',
                    'label' => 'Product Badge',
                    'name' => 'product_badge',
                    'type' => 'text',
                    'instructions' => 'e.g., "New", "Hot", "Bestseller"',
                ],
                [
                    'key' => 'field_product_video',
                    'label' => 'Product Video URL',
                    'name' => 'product_video',
                    'type' => 'url',
                ],
                [
                    'key' => 'field_product_specs',
                    'label' => 'Specifications',
                    'name' => 'product_specs',
                    'type' => 'textarea',
                    'rows' => 6,
                    'instructions' => 'One specification per line, format: Label: Value',
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'product',
                    ],
                ],
            ],
        ]);
    }
}
add_action('acf/init', 'flavor_register_acf_fields');

/**
 * ACF Options Page
 */
function flavor_acf_options_page(): void {
    if (!flavor_is_acf_active()) {
        return;
    }

    if (function_exists('acf_add_options_page')) {
        acf_add_options_page([
            'page_title'    => __('Theme Settings', 'flavor-starter'),
            'menu_title'    => __('Theme Settings', 'flavor-starter'),
            'menu_slug'     => 'theme-settings',
            'capability'    => 'edit_posts',
            'redirect'      => false,
            'icon_url'      => 'dashicons-admin-generic',
            'position'      => 59,
        ]);

        acf_add_options_sub_page([
            'page_title'    => __('Header Settings', 'flavor-starter'),
            'menu_title'    => __('Header', 'flavor-starter'),
            'parent_slug'   => 'theme-settings',
        ]);

        acf_add_options_sub_page([
            'page_title'    => __('Footer Settings', 'flavor-starter'),
            'menu_title'    => __('Footer', 'flavor-starter'),
            'parent_slug'   => 'theme-settings',
        ]);

        acf_add_options_sub_page([
            'page_title'    => __('Social Links', 'flavor-starter'),
            'menu_title'    => __('Social Links', 'flavor-starter'),
            'parent_slug'   => 'theme-settings',
        ]);
    }
}
add_action('acf/init', 'flavor_acf_options_page');

/**
 * Get ACF field with fallback
 */
function flavor_get_field(string $field, $post_id = false, $default = '') {
    if (!flavor_is_acf_active()) {
        return $default;
    }

    $value = get_field($field, $post_id);
    return $value ?: $default;
}

/**
 * Display ACF field
 */
function flavor_the_field(string $field, $post_id = false, string $default = ''): void {
    echo esc_html(flavor_get_field($field, $post_id, $default));
}
