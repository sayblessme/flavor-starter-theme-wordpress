<?php
/**
 * Template part for displaying single post header
 *
 * @package Flavor_Starter
 */
?>

<header class="post-header">
    <div class="container">
        <?php flavor_breadcrumb(); ?>

        <div class="post-header__content">
            <?php
            $categories = get_the_category();
            if ($categories) :
            ?>
                <div class="post-header__categories">
                    <?php foreach ($categories as $category) : ?>
                        <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="post-header__category">
                            <?php echo esc_html($category->name); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <h1 class="post-header__title"><?php the_title(); ?></h1>

            <div class="post-header__meta">
                <div class="post-header__author">
                    <?php echo get_avatar(get_the_author_meta('ID'), 48, '', '', ['class' => 'post-header__avatar']); ?>
                    <div class="post-header__author-info">
                        <span class="post-header__author-name">
                            <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                                <?php the_author(); ?>
                            </a>
                        </span>
                        <span class="post-header__date">
                            <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                <?php echo get_the_date(); ?>
                            </time>
                        </span>
                    </div>
                </div>

                <div class="post-header__info">
                    <span class="post-header__reading-time">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12,6 12,12 16,14"/>
                        </svg>
                        <?php echo esc_html(flavor_reading_time()); ?>
                    </span>

                    <?php
                    $views = get_post_meta(get_the_ID(), 'post_views_count', true);
                    if ($views) :
                    ?>
                        <span class="post-header__views">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                            <?php echo esc_html(number_format_i18n($views)); ?>
                        </span>
                    <?php endif; ?>

                    <?php if (comments_open()) : ?>
                        <span class="post-header__comments">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>
                            </svg>
                            <?php comments_number('0', '1', '%'); ?>
                        </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</header>
