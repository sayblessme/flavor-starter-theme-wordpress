<?php
/**
 * Custom Post Types Registration
 *
 * @package Flavor_Starter
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Custom Post Types
 */
function flavor_register_post_types(): void {
    /**
     * Portfolio / Cases CPT
     */
    $case_labels = [
        'name'                  => _x('Cases', 'Post type general name', 'flavor-starter'),
        'singular_name'         => _x('Case', 'Post type singular name', 'flavor-starter'),
        'menu_name'             => _x('Cases', 'Admin Menu text', 'flavor-starter'),
        'name_admin_bar'        => _x('Case', 'Add New on Toolbar', 'flavor-starter'),
        'add_new'               => __('Add New', 'flavor-starter'),
        'add_new_item'          => __('Add New Case', 'flavor-starter'),
        'new_item'              => __('New Case', 'flavor-starter'),
        'edit_item'             => __('Edit Case', 'flavor-starter'),
        'view_item'             => __('View Case', 'flavor-starter'),
        'all_items'             => __('All Cases', 'flavor-starter'),
        'search_items'          => __('Search Cases', 'flavor-starter'),
        'parent_item_colon'     => __('Parent Cases:', 'flavor-starter'),
        'not_found'             => __('No cases found.', 'flavor-starter'),
        'not_found_in_trash'    => __('No cases found in Trash.', 'flavor-starter'),
        'featured_image'        => _x('Case Cover Image', 'Overrides the "Featured Image" phrase', 'flavor-starter'),
        'set_featured_image'    => _x('Set cover image', 'Overrides the "Set featured image" phrase', 'flavor-starter'),
        'remove_featured_image' => _x('Remove cover image', 'Overrides the "Remove featured image" phrase', 'flavor-starter'),
        'use_featured_image'    => _x('Use as cover image', 'Overrides the "Use as featured image" phrase', 'flavor-starter'),
        'archives'              => _x('Case archives', 'The post type archive label', 'flavor-starter'),
        'insert_into_item'      => _x('Insert into case', 'Overrides the "Insert into post" phrase', 'flavor-starter'),
        'uploaded_to_this_item' => _x('Uploaded to this case', 'Overrides the "Uploaded to this post" phrase', 'flavor-starter'),
        'filter_items_list'     => _x('Filter cases list', 'Screen reader text', 'flavor-starter'),
        'items_list_navigation' => _x('Cases list navigation', 'Screen reader text', 'flavor-starter'),
        'items_list'            => _x('Cases list', 'Screen reader text', 'flavor-starter'),
    ];

    $case_args = [
        'labels'             => $case_labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => ['slug' => 'cases', 'with_front' => false],
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-portfolio',
        'supports'           => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        'show_in_rest'       => true,
    ];

    register_post_type('case', $case_args);

    /**
     * Services CPT
     */
    $service_labels = [
        'name'                  => _x('Services', 'Post type general name', 'flavor-starter'),
        'singular_name'         => _x('Service', 'Post type singular name', 'flavor-starter'),
        'menu_name'             => _x('Services', 'Admin Menu text', 'flavor-starter'),
        'name_admin_bar'        => _x('Service', 'Add New on Toolbar', 'flavor-starter'),
        'add_new'               => __('Add New', 'flavor-starter'),
        'add_new_item'          => __('Add New Service', 'flavor-starter'),
        'new_item'              => __('New Service', 'flavor-starter'),
        'edit_item'             => __('Edit Service', 'flavor-starter'),
        'view_item'             => __('View Service', 'flavor-starter'),
        'all_items'             => __('All Services', 'flavor-starter'),
        'search_items'          => __('Search Services', 'flavor-starter'),
        'parent_item_colon'     => __('Parent Services:', 'flavor-starter'),
        'not_found'             => __('No services found.', 'flavor-starter'),
        'not_found_in_trash'    => __('No services found in Trash.', 'flavor-starter'),
        'featured_image'        => _x('Service Image', 'Overrides the "Featured Image" phrase', 'flavor-starter'),
        'set_featured_image'    => _x('Set service image', 'Overrides the "Set featured image" phrase', 'flavor-starter'),
        'remove_featured_image' => _x('Remove service image', 'Overrides the "Remove featured image" phrase', 'flavor-starter'),
        'use_featured_image'    => _x('Use as service image', 'Overrides the "Use as featured image" phrase', 'flavor-starter'),
        'archives'              => _x('Service archives', 'The post type archive label', 'flavor-starter'),
        'insert_into_item'      => _x('Insert into service', 'Overrides the "Insert into post" phrase', 'flavor-starter'),
        'uploaded_to_this_item' => _x('Uploaded to this service', 'Overrides the "Uploaded to this post" phrase', 'flavor-starter'),
        'filter_items_list'     => _x('Filter services list', 'Screen reader text', 'flavor-starter'),
        'items_list_navigation' => _x('Services list navigation', 'Screen reader text', 'flavor-starter'),
        'items_list'            => _x('Services list', 'Screen reader text', 'flavor-starter'),
    ];

    $service_args = [
        'labels'             => $service_labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => ['slug' => 'services', 'with_front' => false],
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-admin-tools',
        'supports'           => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'page-attributes'],
        'show_in_rest'       => true,
    ];

    register_post_type('service', $service_args);

    /**
     * Testimonials CPT
     */
    $testimonial_labels = [
        'name'                  => _x('Testimonials', 'Post type general name', 'flavor-starter'),
        'singular_name'         => _x('Testimonial', 'Post type singular name', 'flavor-starter'),
        'menu_name'             => _x('Testimonials', 'Admin Menu text', 'flavor-starter'),
        'name_admin_bar'        => _x('Testimonial', 'Add New on Toolbar', 'flavor-starter'),
        'add_new'               => __('Add New', 'flavor-starter'),
        'add_new_item'          => __('Add New Testimonial', 'flavor-starter'),
        'new_item'              => __('New Testimonial', 'flavor-starter'),
        'edit_item'             => __('Edit Testimonial', 'flavor-starter'),
        'view_item'             => __('View Testimonial', 'flavor-starter'),
        'all_items'             => __('All Testimonials', 'flavor-starter'),
        'search_items'          => __('Search Testimonials', 'flavor-starter'),
        'not_found'             => __('No testimonials found.', 'flavor-starter'),
        'not_found_in_trash'    => __('No testimonials found in Trash.', 'flavor-starter'),
    ];

    $testimonial_args = [
        'labels'             => $testimonial_labels,
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => false,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 7,
        'menu_icon'          => 'dashicons-format-quote',
        'supports'           => ['title', 'editor', 'thumbnail', 'custom-fields'],
        'show_in_rest'       => true,
    ];

    register_post_type('testimonial', $testimonial_args);

    /**
     * Team Members CPT
     */
    $team_labels = [
        'name'                  => _x('Team', 'Post type general name', 'flavor-starter'),
        'singular_name'         => _x('Team Member', 'Post type singular name', 'flavor-starter'),
        'menu_name'             => _x('Team', 'Admin Menu text', 'flavor-starter'),
        'name_admin_bar'        => _x('Team Member', 'Add New on Toolbar', 'flavor-starter'),
        'add_new'               => __('Add New', 'flavor-starter'),
        'add_new_item'          => __('Add New Team Member', 'flavor-starter'),
        'new_item'              => __('New Team Member', 'flavor-starter'),
        'edit_item'             => __('Edit Team Member', 'flavor-starter'),
        'view_item'             => __('View Team Member', 'flavor-starter'),
        'all_items'             => __('All Team Members', 'flavor-starter'),
        'search_items'          => __('Search Team Members', 'flavor-starter'),
        'not_found'             => __('No team members found.', 'flavor-starter'),
        'not_found_in_trash'    => __('No team members found in Trash.', 'flavor-starter'),
    ];

    $team_args = [
        'labels'             => $team_labels,
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => false,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 8,
        'menu_icon'          => 'dashicons-groups',
        'supports'           => ['title', 'thumbnail', 'custom-fields', 'page-attributes'],
        'show_in_rest'       => true,
    ];

    register_post_type('team', $team_args);

    /**
     * FAQ CPT
     */
    $faq_labels = [
        'name'                  => _x('FAQs', 'Post type general name', 'flavor-starter'),
        'singular_name'         => _x('FAQ', 'Post type singular name', 'flavor-starter'),
        'menu_name'             => _x('FAQs', 'Admin Menu text', 'flavor-starter'),
        'name_admin_bar'        => _x('FAQ', 'Add New on Toolbar', 'flavor-starter'),
        'add_new'               => __('Add New', 'flavor-starter'),
        'add_new_item'          => __('Add New FAQ', 'flavor-starter'),
        'new_item'              => __('New FAQ', 'flavor-starter'),
        'edit_item'             => __('Edit FAQ', 'flavor-starter'),
        'view_item'             => __('View FAQ', 'flavor-starter'),
        'all_items'             => __('All FAQs', 'flavor-starter'),
        'search_items'          => __('Search FAQs', 'flavor-starter'),
        'not_found'             => __('No FAQs found.', 'flavor-starter'),
        'not_found_in_trash'    => __('No FAQs found in Trash.', 'flavor-starter'),
    ];

    $faq_args = [
        'labels'             => $faq_labels,
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => false,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 9,
        'menu_icon'          => 'dashicons-editor-help',
        'supports'           => ['title', 'editor', 'page-attributes'],
        'show_in_rest'       => true,
    ];

    register_post_type('faq', $faq_args);
}
add_action('init', 'flavor_register_post_types');

/**
 * Update messages for custom post types
 */
function flavor_post_type_messages(array $messages): array {
    global $post, $post_ID;

    $messages['case'] = [
        0  => '',
        1  => sprintf(__('Case updated. <a href="%s">View case</a>', 'flavor-starter'), esc_url(get_permalink($post_ID))),
        2  => __('Custom field updated.', 'flavor-starter'),
        3  => __('Custom field deleted.', 'flavor-starter'),
        4  => __('Case updated.', 'flavor-starter'),
        5  => isset($_GET['revision']) ? sprintf(__('Case restored to revision from %s', 'flavor-starter'), wp_post_revision_title((int) $_GET['revision'], false)) : false,
        6  => sprintf(__('Case published. <a href="%s">View case</a>', 'flavor-starter'), esc_url(get_permalink($post_ID))),
        7  => __('Case saved.', 'flavor-starter'),
        8  => sprintf(__('Case submitted. <a target="_blank" href="%s">Preview case</a>', 'flavor-starter'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
        9  => sprintf(__('Case scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview case</a>', 'flavor-starter'), date_i18n(__('M j, Y @ G:i', 'flavor-starter'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
        10 => sprintf(__('Case draft updated. <a target="_blank" href="%s">Preview case</a>', 'flavor-starter'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
    ];

    $messages['service'] = [
        0  => '',
        1  => sprintf(__('Service updated. <a href="%s">View service</a>', 'flavor-starter'), esc_url(get_permalink($post_ID))),
        2  => __('Custom field updated.', 'flavor-starter'),
        3  => __('Custom field deleted.', 'flavor-starter'),
        4  => __('Service updated.', 'flavor-starter'),
        5  => isset($_GET['revision']) ? sprintf(__('Service restored to revision from %s', 'flavor-starter'), wp_post_revision_title((int) $_GET['revision'], false)) : false,
        6  => sprintf(__('Service published. <a href="%s">View service</a>', 'flavor-starter'), esc_url(get_permalink($post_ID))),
        7  => __('Service saved.', 'flavor-starter'),
        8  => sprintf(__('Service submitted. <a target="_blank" href="%s">Preview service</a>', 'flavor-starter'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
        9  => sprintf(__('Service scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview service</a>', 'flavor-starter'), date_i18n(__('M j, Y @ G:i', 'flavor-starter'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
        10 => sprintf(__('Service draft updated. <a target="_blank" href="%s">Preview service</a>', 'flavor-starter'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
    ];

    return $messages;
}
add_filter('post_updated_messages', 'flavor_post_type_messages');

/**
 * Flush rewrite rules on theme activation
 */
function flavor_rewrite_flush(): void {
    flavor_register_post_types();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'flavor_rewrite_flush');
