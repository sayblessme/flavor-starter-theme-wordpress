<?php
/**
 * WooCommerce Template
 *
 * This is the main WooCommerce template that handles all shop pages.
 * It overrides WooCommerce's default templates to ensure products display correctly.
 *
 * @package Flavor_Starter
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main woocommerce-main">
    <?php
    // Shop header with breadcrumb
    if (is_shop() || is_product_category() || is_product_tag()) :
    ?>
    <header class="page-header shop-page-header">
        <div class="container">
            <?php flavor_breadcrumb(); ?>

            <div class="page-header__content">
                <?php if (is_shop()) : ?>
                    <h1 class="page-header__title"><?php woocommerce_page_title(); ?></h1>
                    <p class="page-header__description">
                        <?php esc_html_e('Откройте для себя нашу коллекцию профессиональных услуг и цифровых продуктов.', 'flavor-starter'); ?>
                    </p>
                <?php elseif (is_product_category()) : ?>
                    <h1 class="page-header__title"><?php single_cat_title(); ?></h1>
                    <?php if (category_description()) : ?>
                        <div class="page-header__description">
                            <?php echo category_description(); ?>
                        </div>
                    <?php endif; ?>
                <?php elseif (is_product_tag()) : ?>
                    <h1 class="page-header__title"><?php single_tag_title(); ?></h1>
                <?php endif; ?>
            </div>
        </div>
    </header>
    <?php endif; ?>

    <div class="container">
        <div class="woocommerce-content">
            <?php woocommerce_content(); ?>
        </div>
    </div>
</main>

<?php
get_footer();
