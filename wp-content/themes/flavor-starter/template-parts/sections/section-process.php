<?php
/**
 * Process Section Template
 *
 * @package Flavor_Starter
 * @since 1.0.0
 */

$process_steps = [
    [
        'number' => '01',
        'title'  => 'Discovery',
        'desc'   => 'We start by understanding your business, goals, target audience, and project requirements through detailed discussions.',
        'icon'   => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
    ],
    [
        'number' => '02',
        'title'  => 'Strategy',
        'desc'   => 'Based on our findings, we create a comprehensive strategy and roadmap that aligns with your objectives.',
        'icon'   => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>',
    ],
    [
        'number' => '03',
        'title'  => 'Design',
        'desc'   => 'Our designers create stunning visual concepts and prototypes that bring your vision to life.',
        'icon'   => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 19l7-7 3 3-7 7-3-3z"></path><path d="M18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5-5z"></path><path d="M2 2l7.586 7.586"></path><circle cx="11" cy="11" r="2"></circle></svg>',
    ],
    [
        'number' => '04',
        'title'  => 'Development',
        'desc'   => 'Our developers build your solution using cutting-edge technologies and best practices.',
        'icon'   => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg>',
    ],
    [
        'number' => '05',
        'title'  => 'Testing',
        'desc'   => 'Rigorous testing ensures your product works flawlessly across all devices and scenarios.',
        'icon'   => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>',
    ],
    [
        'number' => '06',
        'title'  => 'Launch',
        'desc'   => 'We deploy your project and provide ongoing support to ensure continued success.',
        'icon'   => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M22 2L11 13"></path><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>',
    ],
];
?>

<section class="process-section section" id="process">
    <div class="container">
        <div class="section-header fade-in">
            <span class="section-label"><?php esc_html_e('How We Work', 'flavor-starter'); ?></span>
            <h2 class="section-title"><?php esc_html_e('Our Process', 'flavor-starter'); ?></h2>
            <p class="section-description">
                <?php esc_html_e('A proven methodology that ensures successful project delivery every time.', 'flavor-starter'); ?>
            </p>
        </div>

        <div class="process-grid">
            <?php foreach ($process_steps as $index => $step): ?>
            <div class="process-step fade-in stagger-<?php echo ($index % 3) + 1; ?>">
                <div class="process-step__header">
                    <span class="process-step__number"><?php echo esc_html($step['number']); ?></span>
                    <div class="process-step__icon">
                        <?php echo $step['icon']; ?>
                    </div>
                </div>
                <h3 class="process-step__title"><?php echo esc_html($step['title']); ?></h3>
                <p class="process-step__description"><?php echo esc_html($step['desc']); ?></p>

                <?php if ($index < count($process_steps) - 1): ?>
                <div class="process-step__connector">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
