<?php
/**
 * Template part for displaying service card
 *
 * @package Flavor_Starter
 */
?>

<article id="service-<?php the_ID(); ?>" <?php post_class('service-card'); ?>>
    <div class="service-card__icon">
        <?php
        $icon = function_exists('get_field') ? get_field('service_icon') : '';
        if ($icon) :
            echo wp_kses($icon, [
                'svg' => ['width' => [], 'height' => [], 'viewbox' => [], 'fill' => [], 'xmlns' => [], 'class' => []],
                'path' => ['d' => [], 'fill' => [], 'stroke' => [], 'stroke-width' => [], 'stroke-linecap' => [], 'stroke-linejoin' => []],
                'circle' => ['cx' => [], 'cy' => [], 'r' => [], 'fill' => [], 'stroke' => []],
                'rect' => ['x' => [], 'y' => [], 'width' => [], 'height' => [], 'rx' => [], 'fill' => []],
                'line' => ['x1' => [], 'y1' => [], 'x2' => [], 'y2' => [], 'stroke' => []],
                'polyline' => ['points' => [], 'fill' => [], 'stroke' => []],
                'polygon' => ['points' => [], 'fill' => [], 'stroke' => []],
            ]);
        else :
        ?>
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"/>
                <path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3"/>
                <line x1="12" y1="17" x2="12.01" y2="17"/>
            </svg>
        <?php endif; ?>
    </div>

    <h3 class="service-card__title">
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </h3>

    <p class="service-card__description">
        <?php echo esc_html(wp_trim_words(get_the_excerpt(), 15, '...')); ?>
    </p>

    <?php
    $features = function_exists('get_field') ? get_field('service_highlights') : [];
    if ($features && is_array($features)) :
    ?>
        <ul class="service-card__features">
            <?php foreach (array_slice($features, 0, 3) as $feature) : ?>
                <li>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="20,6 9,17 4,12"/>
                    </svg>
                    <?php echo esc_html($feature['text'] ?? $feature); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <a href="<?php the_permalink(); ?>" class="service-card__link">
        <?php esc_html_e('Learn More', 'flavor-starter'); ?>
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M5 12h14M12 5l7 7-7 7"/>
        </svg>
    </a>
</article>
