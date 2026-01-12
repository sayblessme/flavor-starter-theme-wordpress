<?php
/**
 * Template Name: Front Page
 * Description: Homepage template with multiple sections
 *
 * @package Flavor_Starter
 * @since 1.0.0
 */

get_header();

// ACF fields helper
$get_field = function_exists('get_field') ? 'get_field' : function() { return ''; };
?>

<main id="primary" class="site-main front-page">

    <!-- Hero Section -->
    <?php get_template_part('template-parts/sections/section', 'hero'); ?>

    <!-- Clients/Partners Logo Section -->
    <?php get_template_part('template-parts/sections/section', 'clients'); ?>

    <!-- About Section -->
    <?php get_template_part('template-parts/sections/section', 'about'); ?>

    <!-- Services Section -->
    <?php get_template_part('template-parts/sections/section', 'services'); ?>

    <!-- Stats Section -->
    <?php get_template_part('template-parts/sections/section', 'stats'); ?>

    <!-- Portfolio/Cases Section -->
    <?php get_template_part('template-parts/sections/section', 'portfolio'); ?>

    <!-- Products Section (WooCommerce) -->
    <?php if (class_exists('WooCommerce')): ?>
        <?php get_template_part('template-parts/sections/section', 'products'); ?>
    <?php endif; ?>

    <!-- Process Section -->
    <?php get_template_part('template-parts/sections/section', 'process'); ?>

    <!-- Testimonials Section -->
    <?php get_template_part('template-parts/sections/section', 'testimonials'); ?>

    <!-- Team Section -->
    <?php get_template_part('template-parts/sections/section', 'team'); ?>

    <!-- Blog Section -->
    <?php get_template_part('template-parts/sections/section', 'blog'); ?>

    <!-- FAQ Section -->
    <?php get_template_part('template-parts/sections/section', 'faq'); ?>

    <!-- CTA Section -->
    <?php get_template_part('template-parts/sections/section', 'cta'); ?>

    <!-- Contact Section -->
    <?php get_template_part('template-parts/sections/section', 'contact'); ?>

</main>

<?php
get_footer();
