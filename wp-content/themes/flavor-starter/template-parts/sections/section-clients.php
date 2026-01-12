<?php
/**
 * Clients/Partners Logo Section
 *
 * @package Flavor_Starter
 * @since 1.0.0
 */
?>

<section class="clients-section section-sm bg-gray-50">
    <div class="container">
        <div class="clients-content">
            <p class="clients-label"><?php esc_html_e('Trusted by industry leaders', 'flavor-starter'); ?></p>
            <div class="clients-logos" data-clients-slider>
                <div class="clients-logos__track">
                    <?php
                    // Placeholder client logos (in real project, these would come from ACF or CPT)
                    $clients = [
                        'Google', 'Microsoft', 'Apple', 'Amazon', 'Meta', 'Netflix', 'Spotify', 'Airbnb'
                    ];

                    foreach ($clients as $client):
                    ?>
                    <div class="client-logo">
                        <div class="client-logo__placeholder">
                            <?php echo esc_html($client); ?>
                        </div>
                    </div>
                    <?php endforeach; ?>

                    <!-- Duplicate for infinite scroll effect -->
                    <?php foreach ($clients as $client): ?>
                    <div class="client-logo">
                        <div class="client-logo__placeholder">
                            <?php echo esc_html($client); ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
