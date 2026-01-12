# Flavor Starter Theme for WordPress

A professional, agency-quality WordPress theme designed for portfolios, showcases, and business websites with WooCommerce integration.

## Features

- **Custom Post Types**: Cases/Portfolio, Services, Testimonials, Team, FAQ
- **WooCommerce Ready**: Full e-commerce integration with custom styling
- **ACF Compatible**: Works with Advanced Custom Fields (free version)
- **Responsive Design**: Desktop, tablet, and mobile optimized
- **Modern CSS**: CSS Custom Properties, Flexbox, Grid
- **Accessibility**: WCAG compliant with proper ARIA attributes
- **SEO Friendly**: Semantic HTML, proper heading structure
- **Performance**: Optimized images, minimal JS dependencies

## Requirements

- WordPress 6.0+
- PHP 8.1+
- WooCommerce 8.0+ (optional, for shop functionality)
- Advanced Custom Fields 6.0+ (optional, for custom fields)

## Installation

1. Download or clone this repository
2. Upload the `flavor-starter` folder to `/wp-content/themes/`
3. Activate the theme through the WordPress admin panel
4. Install recommended plugins (ACF, WooCommerce)
5. Configure theme options in Appearance > Theme Options

### Quick Install via Git

```bash
cd /path/to/wordpress/wp-content/themes/
git clone https://github.com/yourusername/flavor-starter-theme-wordpress.git flavor-starter
```

## Theme Structure

```
flavor-starter/
├── assets/
│   ├── css/
│   │   ├── theme.css          # Main theme styles
│   │   ├── header.css         # Header & navigation
│   │   ├── footer.css         # Footer styles
│   │   ├── components.css     # Reusable components
│   │   ├── responsive.css     # Responsive breakpoints
│   │   └── woocommerce.css    # WooCommerce styles
│   └── js/
│       ├── main.js            # Core functionality
│       ├── animations.js      # Scroll animations
│       └── navigation.js      # Navigation & cart
├── inc/
│   ├── acf-fields.php         # ACF field definitions
│   ├── custom-post-types.php  # CPT registration
│   ├── custom-taxonomies.php  # Taxonomy registration
│   ├── template-functions.php # Helper functions
│   ├── template-tags.php      # Display functions
│   ├── theme-options.php      # Theme options page
│   ├── woocommerce.php        # WooCommerce customization
│   └── class-flavor-walker-nav-menu.php
├── template-parts/
│   ├── sections/              # Homepage sections
│   └── content-*.php          # Content templates
├── front-page.php             # Homepage template
├── page.php                   # Default page template
├── single.php                 # Single post template
├── single-case.php            # Portfolio single
├── single-service.php         # Service single
├── archive.php                # Archive template
├── archive-case.php           # Portfolio archive
├── archive-service.php        # Services archive
├── search.php                 # Search results
├── 404.php                    # Error page
├── header.php                 # Site header
├── footer.php                 # Site footer
├── sidebar.php                # Sidebar
├── comments.php               # Comments template
├── functions.php              # Theme setup
└── style.css                  # Theme info & base styles
```

## Custom Post Types

### Cases (Portfolio)
- Custom taxonomy: `case_category`, `case_tag`
- ACF fields: client, date, services, website, overview, challenge, solution, results, gallery, testimonial

### Services
- Custom taxonomy: `service_category`
- ACF fields: icon, subtitle, features, process steps, pricing plans, FAQs

### Testimonials
- ACF fields: quote, author name, position, company, rating, photo

### Team
- ACF fields: position, bio, social links (LinkedIn, Twitter, email)

### FAQ
- Custom taxonomy: `faq_category`
- Simple question/answer format

## Theme Options

Access via **Appearance > Theme Options** or **Customizer**:

### Contact Information
- Phone number
- Email address
- Physical address

### Social Links
- Facebook, Twitter/X, Instagram, LinkedIn, YouTube

### Footer Settings
- Footer text
- Copyright text
- Payment icons toggle

### Header Settings
- Sticky header toggle
- Transparent header on homepage
- Header style

### Blog Settings
- Featured post toggle
- Sidebar position
- Posts per page

## Customizer Settings

Access via **Appearance > Customize**:

- **Colors**: Primary color, accent colors
- **Typography**: Font family (via Google Fonts)
- **Header**: Logo, sticky behavior
- **Blog**: Layout options
- **WooCommerce**: Shop settings

## ACF Field Groups

If using ACF, import the field groups or let the theme register them programmatically:

1. **Homepage Sections** - Hero, About, Stats, CTA content
2. **Case Study Fields** - Project details, results, gallery
3. **Service Fields** - Features, process, pricing
4. **Team Member Fields** - Bio, social links
5. **Testimonial Fields** - Quote, rating, author info
6. **Contact Page Fields** - Map, contact info

## WooCommerce Integration

The theme includes comprehensive WooCommerce styling:

- Custom product cards
- Mini cart in header
- Styled cart and checkout
- Product quick view (AJAX)
- Custom single product layout
- Related products section
- Account pages styling

## JavaScript Features

- Sticky header with hide-on-scroll
- Mobile menu with submenus
- Search modal
- FAQ accordion
- Portfolio filtering
- Testimonials slider
- Scroll animations (IntersectionObserver)
- Smooth scrolling
- Back to top button
- Form validation
- Toast notifications
- Mini cart AJAX updates

## CSS Architecture

The theme uses a component-based CSS architecture with:

- **CSS Custom Properties** for theming
- **BEM naming** convention
- **Mobile-first** responsive design
- **Utility classes** for spacing and typography

### Key CSS Variables

```css
:root {
    --primary: #6366f1;
    --primary-dark: #4f46e5;
    --gray-900: #111827;
    --white: #ffffff;
    --space-4: 1rem;
    --radius-lg: 0.75rem;
    --transition-fast: 150ms ease;
}
```

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- iOS Safari (latest)
- Android Chrome (latest)

## Development

### Prerequisites

- Node.js 18+ (optional, for development)
- Local WordPress environment

### Getting Started

1. Clone the repository
2. Set up local WordPress installation
3. Activate the theme
4. Install ACF and WooCommerce plugins
5. Import demo content (if available)

### File Watchers

The theme uses vanilla CSS and JavaScript without build tools. For development, use your IDE's built-in file watching or a tool like Live Server.

## Hooks & Filters

### Actions

```php
// Before main content
do_action('flavor_before_content');

// After main content
do_action('flavor_after_content');

// Before footer
do_action('flavor_before_footer');
```

### Filters

```php
// Modify social links
add_filter('flavor_social_links', function($links) {
    return $links;
});

// Modify reading time
add_filter('flavor_reading_time_wpm', function($wpm) {
    return 250; // words per minute
});
```

## Translation

The theme is translation-ready with all strings using WordPress i18n functions:

- Text domain: `flavor-starter`
- POT file: `languages/flavor-starter.pot`

## Credits

- Icons: Custom SVG icons
- Fonts: System font stack (customizable via Customizer)
- CSS Reset: Modern CSS reset

## License

GPL v2 or later

## Support

For issues and feature requests, please use the GitHub Issues page.

## Changelog

### 1.0.0
- Initial release
- Custom post types for Cases, Services, Testimonials, Team, FAQ
- WooCommerce integration
- Responsive design
- ACF field definitions
- Theme options page
- Homepage sections
- Blog templates
- Portfolio templates
- Service templates
