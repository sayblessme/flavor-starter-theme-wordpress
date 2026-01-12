<?php
/**
 * Custom Taxonomies Registration
 *
 * @package Flavor_Starter
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Custom Taxonomies
 */
function flavor_register_taxonomies(): void {
    /**
     * Case Category Taxonomy
     */
    $case_cat_labels = [
        'name'                       => _x('Case Categories', 'Taxonomy General Name', 'flavor-starter'),
        'singular_name'              => _x('Case Category', 'Taxonomy Singular Name', 'flavor-starter'),
        'menu_name'                  => __('Categories', 'flavor-starter'),
        'all_items'                  => __('All Categories', 'flavor-starter'),
        'parent_item'                => __('Parent Category', 'flavor-starter'),
        'parent_item_colon'          => __('Parent Category:', 'flavor-starter'),
        'new_item_name'              => __('New Category Name', 'flavor-starter'),
        'add_new_item'               => __('Add New Category', 'flavor-starter'),
        'edit_item'                  => __('Edit Category', 'flavor-starter'),
        'update_item'                => __('Update Category', 'flavor-starter'),
        'view_item'                  => __('View Category', 'flavor-starter'),
        'separate_items_with_commas' => __('Separate categories with commas', 'flavor-starter'),
        'add_or_remove_items'        => __('Add or remove categories', 'flavor-starter'),
        'choose_from_most_used'      => __('Choose from the most used', 'flavor-starter'),
        'popular_items'              => __('Popular Categories', 'flavor-starter'),
        'search_items'               => __('Search Categories', 'flavor-starter'),
        'not_found'                  => __('Not Found', 'flavor-starter'),
        'no_terms'                   => __('No categories', 'flavor-starter'),
        'items_list'                 => __('Categories list', 'flavor-starter'),
        'items_list_navigation'      => __('Categories list navigation', 'flavor-starter'),
    ];

    $case_cat_args = [
        'labels'            => $case_cat_labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud'     => true,
        'show_in_rest'      => true,
        'rewrite'           => ['slug' => 'case-category', 'with_front' => false],
    ];

    register_taxonomy('case_category', ['case'], $case_cat_args);

    /**
     * Case Tag Taxonomy
     */
    $case_tag_labels = [
        'name'                       => _x('Case Tags', 'Taxonomy General Name', 'flavor-starter'),
        'singular_name'              => _x('Case Tag', 'Taxonomy Singular Name', 'flavor-starter'),
        'menu_name'                  => __('Tags', 'flavor-starter'),
        'all_items'                  => __('All Tags', 'flavor-starter'),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'new_item_name'              => __('New Tag Name', 'flavor-starter'),
        'add_new_item'               => __('Add New Tag', 'flavor-starter'),
        'edit_item'                  => __('Edit Tag', 'flavor-starter'),
        'update_item'                => __('Update Tag', 'flavor-starter'),
        'view_item'                  => __('View Tag', 'flavor-starter'),
        'separate_items_with_commas' => __('Separate tags with commas', 'flavor-starter'),
        'add_or_remove_items'        => __('Add or remove tags', 'flavor-starter'),
        'choose_from_most_used'      => __('Choose from the most used', 'flavor-starter'),
        'popular_items'              => __('Popular Tags', 'flavor-starter'),
        'search_items'               => __('Search Tags', 'flavor-starter'),
        'not_found'                  => __('Not Found', 'flavor-starter'),
        'no_terms'                   => __('No tags', 'flavor-starter'),
        'items_list'                 => __('Tags list', 'flavor-starter'),
        'items_list_navigation'      => __('Tags list navigation', 'flavor-starter'),
    ];

    $case_tag_args = [
        'labels'            => $case_tag_labels,
        'hierarchical'      => false,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud'     => true,
        'show_in_rest'      => true,
        'rewrite'           => ['slug' => 'case-tag', 'with_front' => false],
    ];

    register_taxonomy('case_tag', ['case'], $case_tag_args);

    /**
     * Service Category Taxonomy
     */
    $service_cat_labels = [
        'name'                       => _x('Service Categories', 'Taxonomy General Name', 'flavor-starter'),
        'singular_name'              => _x('Service Category', 'Taxonomy Singular Name', 'flavor-starter'),
        'menu_name'                  => __('Categories', 'flavor-starter'),
        'all_items'                  => __('All Categories', 'flavor-starter'),
        'parent_item'                => __('Parent Category', 'flavor-starter'),
        'parent_item_colon'          => __('Parent Category:', 'flavor-starter'),
        'new_item_name'              => __('New Category Name', 'flavor-starter'),
        'add_new_item'               => __('Add New Category', 'flavor-starter'),
        'edit_item'                  => __('Edit Category', 'flavor-starter'),
        'update_item'                => __('Update Category', 'flavor-starter'),
        'view_item'                  => __('View Category', 'flavor-starter'),
        'separate_items_with_commas' => __('Separate categories with commas', 'flavor-starter'),
        'add_or_remove_items'        => __('Add or remove categories', 'flavor-starter'),
        'choose_from_most_used'      => __('Choose from the most used', 'flavor-starter'),
        'popular_items'              => __('Popular Categories', 'flavor-starter'),
        'search_items'               => __('Search Categories', 'flavor-starter'),
        'not_found'                  => __('Not Found', 'flavor-starter'),
        'no_terms'                   => __('No categories', 'flavor-starter'),
        'items_list'                 => __('Categories list', 'flavor-starter'),
        'items_list_navigation'      => __('Categories list navigation', 'flavor-starter'),
    ];

    $service_cat_args = [
        'labels'            => $service_cat_labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud'     => false,
        'show_in_rest'      => true,
        'rewrite'           => ['slug' => 'service-category', 'with_front' => false],
    ];

    register_taxonomy('service_category', ['service'], $service_cat_args);

    /**
     * FAQ Category Taxonomy
     */
    $faq_cat_labels = [
        'name'                       => _x('FAQ Categories', 'Taxonomy General Name', 'flavor-starter'),
        'singular_name'              => _x('FAQ Category', 'Taxonomy Singular Name', 'flavor-starter'),
        'menu_name'                  => __('Categories', 'flavor-starter'),
        'all_items'                  => __('All Categories', 'flavor-starter'),
        'parent_item'                => __('Parent Category', 'flavor-starter'),
        'parent_item_colon'          => __('Parent Category:', 'flavor-starter'),
        'new_item_name'              => __('New Category Name', 'flavor-starter'),
        'add_new_item'               => __('Add New Category', 'flavor-starter'),
        'edit_item'                  => __('Edit Category', 'flavor-starter'),
        'update_item'                => __('Update Category', 'flavor-starter'),
        'view_item'                  => __('View Category', 'flavor-starter'),
        'separate_items_with_commas' => __('Separate categories with commas', 'flavor-starter'),
        'add_or_remove_items'        => __('Add or remove categories', 'flavor-starter'),
        'choose_from_most_used'      => __('Choose from the most used', 'flavor-starter'),
        'popular_items'              => __('Popular Categories', 'flavor-starter'),
        'search_items'               => __('Search Categories', 'flavor-starter'),
        'not_found'                  => __('Not Found', 'flavor-starter'),
        'no_terms'                   => __('No categories', 'flavor-starter'),
        'items_list'                 => __('Categories list', 'flavor-starter'),
        'items_list_navigation'      => __('Categories list navigation', 'flavor-starter'),
    ];

    $faq_cat_args = [
        'labels'            => $faq_cat_labels,
        'hierarchical'      => true,
        'public'            => false,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => false,
        'show_tagcloud'     => false,
        'show_in_rest'      => true,
    ];

    register_taxonomy('faq_category', ['faq'], $faq_cat_args);
}
add_action('init', 'flavor_register_taxonomies', 0);
