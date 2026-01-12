<?php
/**
 * Custom search form template
 *
 * @package Flavor_Starter
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label class="screen-reader-text" for="search-field-<?php echo esc_attr(wp_unique_id()); ?>">
        <?php esc_html_e('Search for:', 'flavor-starter'); ?>
    </label>
    <input
        type="search"
        id="search-field-<?php echo esc_attr(wp_unique_id()); ?>"
        class="search-field"
        placeholder="<?php esc_attr_e('Search...', 'flavor-starter'); ?>"
        value="<?php echo get_search_query(); ?>"
        name="s"
    >
    <button type="submit" class="search-submit">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="8"/>
            <path d="M21 21l-4.35-4.35"/>
        </svg>
        <span class="screen-reader-text"><?php esc_html_e('Search', 'flavor-starter'); ?></span>
    </button>
</form>
