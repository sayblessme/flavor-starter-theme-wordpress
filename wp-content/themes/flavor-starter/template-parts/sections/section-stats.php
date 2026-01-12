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
            'label'  => get_field('stat_1_label') ?: 'Projects Completed',
        ],
        [
            'number' => get_field('stat_2_number') ?: '50+',
            'label'  => get_field('stat_2_label') ?: 'Happy Clients',
        ],
        [
            'number' => get_field('stat_3_number') ?: '10+',
            'label'  => get_field('stat_3_label') ?: 'Years Experience',
        ],
        [
            'number' => get_field('stat_4_number') ?: '25+',
            'label'  => get_field('stat_4_label') ?: 'Awards Won',
        ],
    ];
} else {
    $stats = [
        ['number' => '150+', 'label' => 'Projects Completed'],
        ['number' => '50+', 'label' => 'Happy Clients'],
        ['number' => '10+', 'label' => 'Years Experience'],
        ['number' => '25+', 'label' => 'Awards Won'],
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
