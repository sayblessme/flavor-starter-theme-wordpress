<?php
/**
 * Custom Walker Nav Menu
 *
 * @package Flavor_Starter
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Custom Walker class for navigation menus
 */
class Flavor_Walker_Nav_Menu extends Walker_Nav_Menu {

    /**
     * Starts the list before the elements are added.
     */
    public function start_lvl(&$output, $depth = 0, $args = null): void {
        $indent = str_repeat("\t", $depth);
        $classes = ['sub-menu'];

        if ($depth === 0) {
            $classes[] = 'sub-menu--level-1';
        } else {
            $classes[] = 'sub-menu--level-' . ($depth + 1);
        }

        $class_names = implode(' ', apply_filters('nav_menu_submenu_css_class', $classes, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $output .= "\n$indent<ul$class_names>\n";
    }

    /**
     * Ends the list after the elements are added.
     */
    public function end_lvl(&$output, $depth = 0, $args = null): void {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    /**
     * Starts the element output.
     */
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0): void {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $classes = empty($item->classes) ? [] : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        // Add depth class
        $classes[] = 'menu-item--depth-' . $depth;

        // Check if has children
        if (in_array('menu-item-has-children', $classes, true)) {
            $classes[] = 'has-dropdown';
        }

        // Current item
        if (in_array('current-menu-item', $classes, true)) {
            $classes[] = 'is-active';
        }

        $class_names = implode(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names . '>';

        // Link attributes
        $atts = [];
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel']    = !empty($item->xfn) ? $item->xfn : '';
        $atts['href']   = !empty($item->url) ? $item->url : '';

        // Add noopener to external links
        if (!empty($item->target) && $item->target === '_blank') {
            $atts['rel'] = trim($atts['rel'] . ' noopener noreferrer');
        }

        // Link class
        $link_classes = ['menu-link'];
        if ($depth === 0) {
            $link_classes[] = 'menu-link--primary';
        } else {
            $link_classes[] = 'menu-link--submenu';
        }
        $atts['class'] = implode(' ', $link_classes);

        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $title = apply_filters('the_title', $item->title, $item->ID);
        $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);

        $item_output = isset($args->before) ? $args->before : '';
        $item_output .= '<a' . $attributes . '>';
        $item_output .= (isset($args->link_before) ? $args->link_before : '') . '<span class="menu-text">' . $title . '</span>' . (isset($args->link_after) ? $args->link_after : '');

        // Add dropdown arrow for items with children
        if (in_array('menu-item-has-children', (array) $item->classes, true)) {
            $item_output .= '<span class="menu-arrow"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg></span>';
        }

        $item_output .= '</a>';
        $item_output .= isset($args->after) ? $args->after : '';

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    /**
     * Ends the element output.
     */
    public function end_el(&$output, $item, $depth = 0, $args = null): void {
        $output .= "</li>\n";
    }
}

/**
 * Fallback menu when no menu is set
 */
function flavor_fallback_menu(): void {
    ?>
    <ul class="menu menu--fallback">
        <li class="menu-item">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="menu-link">
                <?php esc_html_e('Home', 'flavor-starter'); ?>
            </a>
        </li>
        <?php if (current_user_can('edit_theme_options')): ?>
        <li class="menu-item">
            <a href="<?php echo esc_url(admin_url('nav-menus.php')); ?>" class="menu-link">
                <?php esc_html_e('Add Menu', 'flavor-starter'); ?>
            </a>
        </li>
        <?php endif; ?>
    </ul>
    <?php
}

/**
 * Mobile menu walker
 */
class Flavor_Walker_Mobile_Menu extends Walker_Nav_Menu {

    /**
     * Starts the list before the elements are added.
     */
    public function start_lvl(&$output, $depth = 0, $args = null): void {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"mobile-submenu mobile-submenu--level-" . ($depth + 1) . "\">\n";
    }

    /**
     * Ends the list after the elements are added.
     */
    public function end_lvl(&$output, $depth = 0, $args = null): void {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    /**
     * Starts the element output.
     */
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0): void {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $classes = empty($item->classes) ? [] : (array) $item->classes;
        $classes[] = 'mobile-menu-item';

        // Check if has children
        $has_children = in_array('menu-item-has-children', $classes, true);
        if ($has_children) {
            $classes[] = 'has-children';
        }

        // Current item
        if (in_array('current-menu-item', $classes, true)) {
            $classes[] = 'is-active';
        }

        $class_names = implode(' ', array_filter($classes));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $output .= $indent . '<li' . $class_names . '>';

        // Link wrapper for items with children
        if ($has_children) {
            $output .= '<div class="mobile-menu-item__wrapper">';
        }

        // Link attributes
        $atts = [];
        $atts['href'] = !empty($item->url) ? $item->url : '';
        $atts['class'] = 'mobile-menu-link';

        if (!empty($item->target)) {
            $atts['target'] = $item->target;
            $atts['rel'] = 'noopener noreferrer';
        }

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $title = apply_filters('the_title', $item->title, $item->ID);

        $item_output = '<a' . $attributes . '>' . $title . '</a>';

        // Add toggle button for items with children
        if ($has_children) {
            $item_output .= '<button type="button" class="mobile-submenu-toggle" aria-expanded="false" aria-label="' . esc_attr__('Toggle submenu', 'flavor-starter') . '">';
            $item_output .= '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>';
            $item_output .= '</button>';
            $item_output .= '</div>';
        }

        $output .= $item_output;
    }

    /**
     * Ends the element output.
     */
    public function end_el(&$output, $item, $depth = 0, $args = null): void {
        $output .= "</li>\n";
    }
}
