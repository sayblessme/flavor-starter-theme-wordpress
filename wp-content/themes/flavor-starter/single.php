<?php
/**
 * The template for displaying all single posts
 *
 * @package Flavor_Starter
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php
    // Page Header with post info
    get_template_part('template-parts/post', 'header');
    ?>

    <div class="single-post section">
        <div class="container">
            <div class="content-area">
                <div class="content-main">
                    <?php
                    while (have_posts()) :
                        the_post();

                        get_template_part('template-parts/content', 'single');

                        // Post navigation
                        flavor_post_navigation();

                        // Author box
                        flavor_author_box();

                        // Related posts
                        flavor_related_posts();

                        // Comments
                        if (comments_open() || get_comments_number()) :
                            comments_template();
                        endif;

                    endwhile;
                    ?>
                </div>

                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();
