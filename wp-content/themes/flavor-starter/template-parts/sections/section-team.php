<?php
/**
 * Team Section Template
 *
 * @package Flavor_Starter
 * @since 1.0.0
 */

$team = new WP_Query([
    'post_type'      => 'team',
    'posts_per_page' => 4,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
]);

// Default team members if none exist
$default_team = [
    [
        'name'     => 'Алексей Морозов',
        'position' => 'Креативный директор',
        'linkedin' => '#',
        'twitter'  => '#',
    ],
    [
        'name'     => 'Мария Иванова',
        'position' => 'Ведущий разработчик',
        'linkedin' => '#',
        'twitter'  => '#',
    ],
    [
        'name'     => 'Дмитрий Козлов',
        'position' => 'UX дизайнер',
        'linkedin' => '#',
        'twitter'  => '#',
    ],
    [
        'name'     => 'Анна Петрова',
        'position' => 'Менеджер проектов',
        'linkedin' => '#',
        'twitter'  => '#',
    ],
];
?>

<section class="team-section section" id="team">
    <div class="container">
        <div class="section-header fade-in">
            <span class="section-label"><?php esc_html_e('Наша команда', 'flavor-starter'); ?></span>
            <h2 class="section-title"><?php esc_html_e('Познакомьтесь с экспертами', 'flavor-starter'); ?></h2>
            <p class="section-description">
                <?php esc_html_e('Наша талантливая команда профессионалов стремится к исключительным результатам в каждом проекте.', 'flavor-starter'); ?>
            </p>
        </div>

        <?php if ($team->have_posts()): ?>
        <div class="team-grid grid grid-cols-4">
            <?php while ($team->have_posts()): $team->the_post();
                $position = '';
                $linkedin = '';
                $twitter = '';
                $email = '';

                if (function_exists('get_field')) {
                    $position = get_field('team_position');
                    $linkedin = get_field('team_linkedin');
                    $twitter = get_field('team_twitter');
                    $email = get_field('team_email');
                } else {
                    // Fallback to post meta
                    $position = get_post_meta(get_the_ID(), 'team_position', true);
                    $linkedin = get_post_meta(get_the_ID(), 'team_linkedin', true);
                    $twitter = get_post_meta(get_the_ID(), 'team_twitter', true);
                    $email = get_post_meta(get_the_ID(), 'team_email', true);
                }
            ?>
            <article class="team-card fade-in">
                <div class="team-card__image">
                    <?php if (has_post_thumbnail()): ?>
                        <?php the_post_thumbnail('flavor-portrait', ['class' => 'img-cover']); ?>
                    <?php else: ?>
                        <div class="team-card__placeholder">
                            <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </div>
                    <?php endif; ?>

                    <?php if ($linkedin || $twitter || $email): ?>
                    <div class="team-card__social">
                        <?php if ($linkedin): ?>
                        <a href="<?php echo esc_url($linkedin); ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>
                        </a>
                        <?php endif; ?>
                        <?php if ($twitter): ?>
                        <a href="<?php echo esc_url($twitter); ?>" target="_blank" rel="noopener noreferrer" aria-label="Twitter">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
                        </a>
                        <?php endif; ?>
                        <?php if ($email): ?>
                        <a href="mailto:<?php echo esc_attr($email); ?>" aria-label="Email">
                            <?php echo flavor_icon('mail', 20); ?>
                        </a>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="team-card__content">
                    <h3 class="team-card__name"><?php the_title(); ?></h3>
                    <?php if ($position): ?>
                    <span class="team-card__position"><?php echo esc_html($position); ?></span>
                    <?php endif; ?>
                </div>
            </article>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </div>
        <?php else: ?>
        <!-- Default Team Members -->
        <div class="team-grid grid grid-cols-4">
            <?php foreach ($default_team as $index => $member): ?>
            <article class="team-card fade-in stagger-<?php echo $index + 1; ?>">
                <div class="team-card__image">
                    <div class="team-card__placeholder" style="background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%);">
                        <span class="team-card__initial"><?php echo esc_html(strtoupper(substr($member['name'], 0, 1))); ?></span>
                    </div>

                    <div class="team-card__social">
                        <a href="<?php echo esc_url($member['linkedin']); ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>
                        </a>
                        <a href="<?php echo esc_url($member['twitter']); ?>" target="_blank" rel="noopener noreferrer" aria-label="Twitter">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
                        </a>
                    </div>
                </div>
                <div class="team-card__content">
                    <h3 class="team-card__name"><?php echo esc_html($member['name']); ?></h3>
                    <span class="team-card__position"><?php echo esc_html($member['position']); ?></span>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>
