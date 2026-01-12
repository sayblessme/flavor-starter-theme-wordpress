<?php
/**
 * The template for displaying archive pages
 *
 * @package Flavor_Starter
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php if (have_posts()) : ?>

        <header class="page-header">
            <div class="container">
                <?php flavor_breadcrumb(); ?>

                <div class="page-header__content">
                    <?php
                    the_archive_title('<h1 class="page-header__title">', '</h1>');
                    the_archive_description('<div class="page-header__description">', '</div>');
                    ?>
                </div>
            </div>
        </header>

        <div class="archive-content section">
            <div class="container">
                <div class="content-area">
                    <div class="content-main">
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
