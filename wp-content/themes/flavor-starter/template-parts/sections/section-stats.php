<?php
/**
 * Stats Section Template
 *
 * @package Flavor_Starter
 * @since 1.0.0
 */

// Get ACF fields or use defaults
$stats = [];

if (function_exists('get_field')) {
    $stats = [
        [
            'number' => get_field('stat_1_number') ?: '150+',
            'label'  => get_field('stat_1_label') ?: 'Выполненных проектов',
        ],
        [
            'number' => get_field('stat_2_number') ?: '50+',
            'label'  => get_field('stat_2_label') ?: 'Довольных клиентов',
        ],
        [
            'number' => get_field('stat_3_number') ?: '10+',
            'label'  => get_field('stat_3_label') ?: 'Лет опыта',
        ],
        [
            'number' => get_field('stat_4_number') ?: '25+',
            'label'  => get_field('stat_4_label') ?: 'Наград',
        ],
    ];
} else {
    $stats = [
        ['number' => '150+', 'label' => 'Выполненных проектов'],
        ['number' => '50+', 'label' => 'Довольных клиентов'],
        ['number' => '10+', 'label' => 'Лет опыта'],
        ['number' => '25+', 'label' => 'Наград'],
    ];
}
?>

<section class="stats-section section-gradient section-dark">
    <div class="container">
        <div class="stats-grid">
            <?php foreach ($stats as $index => $stat): ?>
            <div class="stat-item fade-in stagger-<?php echo $index + 1; ?>" data-stat>
                <span class="stat-item__number" data-count="<?php echo esc_attr(preg_replace('/[^0-9]/', '', $stat['number'])); ?>">
                    <?php echo esc_html($stat['number']); ?>
                </span>
                <span class="stat-item__label"><?php echo esc_html($stat['label']); ?></span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Decorative Elements -->
    <div class="stats-decoration">
        <div class="stats-decoration__circle stats-decoration__circle--1"></div>
        <div class="stats-decoration__circle stats-decoration__circle--2"></div>
    </div>
</section>
