<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 *
 * @package Flavor_Starter
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php if (have_posts()) : ?>

        <?php if (is_home() && !is_front_page()) : ?>
            <header class="page-header">
                <div class="container">
                    <?php flavor_breadcrumb(); ?>

                    <div class="page-header__content">
                        <h1 class="page-header__title"><?php single_post_title(); ?></h1>
                        <?php
                        $blog_description = get_theme_mod('flavor_blog_description', '');
                        if ($blog_description) :
                        ?>
                            <p class="page-header__description"><?php echo esc_html($blog_description); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </header>
        <?php endif; ?>

        <div class="blog-content section">
            <div class="container">
                <div class="content-area">
                    <div class="content-main">
                        <?php
                        // Featured post (first post on first page)
                        if (is_home() && !is_paged() && get_theme_mod('flavor_blog_featured', true)) :
                            the_post();
                            get_template_part('template-parts/content', 'featured');
                        endif;
                        ?>

                        <div class="posts-grid">
                            <?php
                            while (have_posts()) :
                                the_post();
                                get_template_part('template-parts/content', get_post_type());
                            endwhile;
                            ?>
                        </div>

                        <?php flavor_pagination(); ?>
                    </div>

                    <?php get_sidebar(); ?>
                </div>
            </div>
        </div>

    <?php else : ?>

        <div class="no-results section">
            <div class="container">
                <?php get_template_part('template-parts/content', 'none'); ?>
            </div>
        </div>

    <?php endif; ?>
</main>

<?php
get_footer();
