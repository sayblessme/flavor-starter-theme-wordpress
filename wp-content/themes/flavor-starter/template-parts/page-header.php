<?php
/**
 * Template part for displaying page header
 *
 * @package Flavor_Starter
 */
?>

<header class="page-header">
    <div class="container">
        <?php flavor_breadcrumb(); ?>

        <div class="page-header__content">
            <h1 class="page-header__title"><?php the_title(); ?></h1>

            <?php if (has_excerpt()) : ?>
                <p class="page-header__description"><?php echo esc_html(get_the_excerpt()); ?></p>
            <?php endif; ?>
        </div>
    </div>
</header>
