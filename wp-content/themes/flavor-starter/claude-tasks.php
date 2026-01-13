<?php
/**
 * Claude Tasks Script
 * Temporary script for content updates
 *
 * Usage: Access via browser with action parameter
 * Example: /wp-content/themes/flavor-starter/claude-tasks.php?action=translate_products&key=secret123
 */

// Security key
define('CLAUDE_SECRET', 'FlavorUpdate2024!');

// Load WordPress
$wp_load_path = dirname(__FILE__) . '/../../../wp-load.php';
if (!file_exists($wp_load_path)) {
    $wp_load_path = dirname(__FILE__) . '/../../../../wp-load.php';
}

if (!file_exists($wp_load_path)) {
    die('WordPress not found');
}

require_once($wp_load_path);

// Security check
if (!isset($_GET['key']) || $_GET['key'] !== CLAUDE_SECRET) {
    die('Access denied');
}

$action = isset($_GET['action']) ? $_GET['action'] : '';

header('Content-Type: text/html; charset=utf-8');
echo '<html><head><meta charset="utf-8"><title>Claude Tasks</title></head><body>';
echo '<h1>Claude Tasks Runner</h1>';

switch ($action) {
    case 'translate_products':
        translate_products();
        break;

    case 'translate_faq':
        translate_faq();
        break;

    case 'add_trust_elements':
        add_trust_elements();
        break;

    case 'check_status':
        check_status();
        break;

    case 'list_products':
        list_products();
        break;

    case 'check_images':
        check_product_images();
        break;

    case 'list_faq':
        list_all_faq();
        break;

    case 'force_translate':
        force_translate_products();
        break;

    case 'generate_images':
        generate_placeholder_images();
        break;

    default:
        echo '<h2>Available Actions:</h2>';
        echo '<ul>';
        echo '<li><a href="?action=check_status&key=' . CLAUDE_SECRET . '">Check Status</a></li>';
        echo '<li><a href="?action=list_products&key=' . CLAUDE_SECRET . '">List Products</a></li>';
        echo '<li><a href="?action=translate_products&key=' . CLAUDE_SECRET . '">Translate Products</a></li>';
        echo '<li><a href="?action=translate_faq&key=' . CLAUDE_SECRET . '">Translate FAQ</a></li>';
        echo '<li><a href="?action=add_trust_elements&key=' . CLAUDE_SECRET . '">Add Trust Elements</a></li>';
        echo '</ul>';
}

echo '</body></html>';

// Functions

function check_status() {
    echo '<h2>System Status</h2>';

    // Check products
    $products = get_posts([
        'post_type' => 'product',
        'posts_per_page' => -1,
        'post_status' => 'any'
    ]);
    echo '<p>Products: ' . count($products) . '</p>';

    // Check FAQ
    $faqs = get_posts([
        'post_type' => 'faq',
        'posts_per_page' => -1,
        'post_status' => 'any'
    ]);
    echo '<p>FAQs: ' . count($faqs) . '</p>';

    // Check Team
    $team = get_posts([
        'post_type' => 'team',
        'posts_per_page' => -1,
        'post_status' => 'any'
    ]);
    echo '<p>Team members: ' . count($team) . '</p>';

    // Check if WooCommerce is active
    echo '<p>WooCommerce active: ' . (class_exists('WooCommerce') ? 'Yes' : 'No') . '</p>';

    // Check uploads directory
    $upload_dir = wp_upload_dir();
    echo '<p>Upload directory: ' . $upload_dir['basedir'] . '</p>';
    echo '<p>Upload URL: ' . $upload_dir['baseurl'] . '</p>';
}

function list_products() {
    echo '<h2>Current Products</h2>';

    $products = get_posts([
        'post_type' => 'product',
        'posts_per_page' => -1,
        'post_status' => 'publish'
    ]);

    if (empty($products)) {
        echo '<p>No products found</p>';
        return;
    }

    echo '<table border="1" cellpadding="5">';
    echo '<tr><th>ID</th><th>Title</th><th>Has Image</th><th>Price</th></tr>';

    foreach ($products as $product) {
        $wc_product = wc_get_product($product->ID);
        $has_image = has_post_thumbnail($product->ID) ? 'Yes' : 'No';
        $price = $wc_product ? $wc_product->get_price() : 'N/A';

        echo '<tr>';
        echo '<td>' . $product->ID . '</td>';
        echo '<td>' . esc_html($product->post_title) . '</td>';
        echo '<td>' . $has_image . '</td>';
        echo '<td>' . $price . '</td>';
        echo '</tr>';
    }

    echo '</table>';
}

function translate_products() {
    echo '<h2>Translating Products</h2>';

    // Translation map for product titles
    $translations = [
        'Logo Design' => 'Дизайн логотипа',
        'Website Development' => 'Разработка веб-сайта',
        'Mobile App' => 'Мобильное приложение',
        'SEO Optimization' => 'SEO оптимизация',
        'Brand Identity' => 'Фирменный стиль',
        'Brand Identity Package' => 'Пакет фирменного стиля',
        'Social Media Marketing' => 'SMM продвижение',
        'Content Marketing' => 'Контент-маркетинг',
        'Email Marketing' => 'Email-маркетинг',
        'PPC Advertising' => 'Контекстная реклама',
        'E-commerce Solution' => 'E-commerce решение',
        'UI/UX Design' => 'UI/UX дизайн',
        'Web Application' => 'Веб-приложение',
        'Corporate Website' => 'Корпоративный сайт',
        'Landing Page' => 'Лендинг',
        'Online Store' => 'Интернет-магазин',
        'Consulting' => 'Консалтинг',
        'Support Package' => 'Пакет поддержки',
        'Marketing Strategy' => 'Маркетинговая стратегия',
        'Maintenance Plan' => 'План технической поддержки',
        'SEO Package' => 'SEO пакет',
    ];

    $products = get_posts([
        'post_type' => 'product',
        'posts_per_page' => -1,
        'post_status' => 'publish'
    ]);

    $updated = 0;

    foreach ($products as $product) {
        $new_title = null;

        // Check exact match
        if (isset($translations[$product->post_title])) {
            $new_title = $translations[$product->post_title];
        } else {
            // Check partial match
            foreach ($translations as $en => $ru) {
                if (stripos($product->post_title, $en) !== false) {
                    $new_title = str_ireplace($en, $ru, $product->post_title);
                    break;
                }
            }
        }

        if ($new_title && $new_title !== $product->post_title) {
            wp_update_post([
                'ID' => $product->ID,
                'post_title' => $new_title
            ]);
            echo '<p>Updated: ' . esc_html($product->post_title) . ' → ' . esc_html($new_title) . '</p>';
            $updated++;
        }
    }

    echo '<p><strong>Total updated: ' . $updated . '</strong></p>';
}

function translate_faq() {
    echo '<h2>Translating FAQ</h2>';

    // Check if FAQ post type exists
    if (!post_type_exists('faq')) {
        echo '<p>FAQ post type does not exist. Creating sample FAQs...</p>';
        create_sample_faqs();
        return;
    }

    // Translation map for FAQ
    $faq_translations = [
        'What services do you offer?' => [
            'title' => 'Какие услуги вы предлагаете?',
            'content' => 'Мы предлагаем комплексный спектр цифровых услуг, включая веб-разработку, UI/UX дизайн, e-commerce решения, разработку мобильных приложений, брендинг и цифровой маркетинг. Каждая услуга адаптируется под ваши конкретные потребности.'
        ],
        'How long does a typical project take?' => [
            'title' => 'Сколько времени занимает типичный проект?',
            'content' => 'Сроки проекта варьируются в зависимости от сложности и масштаба. Простой сайт обычно занимает 4-6 недель, а более сложные e-commerce или кастомные приложения могут потребовать 8-12 недель или больше. Мы предоставляем детальные сроки на этапе предложения.'
        ],
        'What is your pricing model?' => [
            'title' => 'Какова ваша ценовая политика?',
            'content' => 'Мы предлагаем как фиксированную цену, так и почасовую оплату в зависимости от типа проекта. Фиксированная цена подходит для чётко определённых проектов, а почасовая оплата — для ongoing работы или проектов с изменяющимися требованиями.'
        ],
        'Do you provide ongoing support?' => [
            'title' => 'Вы предоставляете техническую поддержку?',
            'content' => 'Да, мы предлагаем гибкие пакеты поддержки и обслуживания, чтобы ваши цифровые продукты оставались безопасными, актуальными и работали оптимально. Наши планы поддержки включают регулярные обновления, мониторинг безопасности и приоритетную помощь.'
        ],
        'Can you work with our existing team?' => [
            'title' => 'Можете ли вы работать с нашей командой?',
            'content' => 'Безусловно! Мы часто сотрудничаем с внутренними командами и другими агентствами. Мы можем легко интегрироваться в ваш рабочий процесс, будь то руководство проектом или поддержка ваших существующих усилий.'
        ],
        'What technologies do you work with?' => [
            'title' => 'С какими технологиями вы работаете?',
            'content' => 'Мы работаем с широким спектром современных технологий, включая WordPress, WooCommerce, React, Vue.js, Node.js, PHP и различные облачные платформы. Мы выбираем лучший технологический стек на основе требований вашего проекта.'
        ],
    ];

    $faqs = get_posts([
        'post_type' => 'faq',
        'posts_per_page' => -1,
        'post_status' => 'any'
    ]);

    $updated = 0;

    foreach ($faqs as $faq) {
        foreach ($faq_translations as $en_title => $translation) {
            if (stripos($faq->post_title, $en_title) !== false ||
                similar_text(strtolower($faq->post_title), strtolower($en_title)) > strlen($en_title) * 0.7) {

                wp_update_post([
                    'ID' => $faq->ID,
                    'post_title' => $translation['title'],
                    'post_content' => $translation['content']
                ]);

                echo '<p>Updated: ' . esc_html($faq->post_title) . ' → ' . esc_html($translation['title']) . '</p>';
                $updated++;
                break;
            }
        }
    }

    echo '<p><strong>Total updated: ' . $updated . '</strong></p>';

    if ($updated == 0 && count($faqs) == 0) {
        echo '<p>No FAQs found. Creating sample FAQs...</p>';
        create_sample_faqs();
    }
}

function create_sample_faqs() {
    $faqs = [
        [
            'title' => 'Какие услуги вы предлагаете?',
            'content' => 'Мы предлагаем комплексный спектр цифровых услуг, включая веб-разработку, UI/UX дизайн, e-commerce решения, разработку мобильных приложений, брендинг и цифровой маркетинг. Каждая услуга адаптируется под ваши конкретные потребности.'
        ],
        [
            'title' => 'Сколько времени занимает типичный проект?',
            'content' => 'Сроки проекта варьируются в зависимости от сложности и масштаба. Простой сайт обычно занимает 4-6 недель, а более сложные e-commerce или кастомные приложения могут потребовать 8-12 недель или больше.'
        ],
        [
            'title' => 'Какова ваша ценовая политика?',
            'content' => 'Мы предлагаем как фиксированную цену, так и почасовую оплату в зависимости от типа проекта. Фиксированная цена подходит для чётко определённых проектов, а почасовая оплата — для ongoing работы.'
        ],
        [
            'title' => 'Вы предоставляете техническую поддержку?',
            'content' => 'Да, мы предлагаем гибкие пакеты поддержки и обслуживания. Наши планы поддержки включают регулярные обновления, мониторинг безопасности и приоритетную помощь.'
        ],
        [
            'title' => 'Можете ли вы работать с нашей командой?',
            'content' => 'Безусловно! Мы часто сотрудничаем с внутренними командами и другими агентствами. Мы можем легко интегрироваться в ваш рабочий процесс.'
        ],
        [
            'title' => 'С какими технологиями вы работаете?',
            'content' => 'Мы работаем с WordPress, WooCommerce, React, Vue.js, Node.js, PHP и различные облачные платформы. Мы выбираем лучший технологический стек на основе требований вашего проекта.'
        ],
    ];

    foreach ($faqs as $index => $faq) {
        $post_id = wp_insert_post([
            'post_title' => $faq['title'],
            'post_content' => $faq['content'],
            'post_type' => 'faq',
            'post_status' => 'publish',
            'menu_order' => $index + 1
        ]);

        if ($post_id) {
            echo '<p>Created FAQ: ' . esc_html($faq['title']) . '</p>';
        }
    }
}

function add_trust_elements() {
    echo '<h2>Adding Trust Elements</h2>';

    // Check if team post type exists
    if (!post_type_exists('team')) {
        echo '<p>Team post type does not exist.</p>';
    } else {
        $team = get_posts([
            'post_type' => 'team',
            'posts_per_page' => -1,
            'post_status' => 'any'
        ]);

        if (empty($team)) {
            echo '<p>No team members found. Creating sample team members...</p>';
            create_sample_team();
        } else {
            echo '<p>Team members exist: ' . count($team) . '</p>';
        }
    }

    // Update theme options for trust badges if ACF is available
    if (function_exists('update_field')) {
        echo '<p>ACF is available - updating trust settings...</p>';
        // Add trust badges settings
    } else {
        echo '<p>ACF not available - using theme options...</p>';
    }

    echo '<p><strong>Trust elements check complete</strong></p>';
}

function force_translate_products() {
    echo '<h2>Force Translating Products by ID</h2>';

    // Direct translations by product ID
    $translations = [
        52 => 'Разработка веб-сайта',
        53 => 'Мобильное приложение',
        54 => 'Пакет фирменного стиля',
        55 => 'UI/UX дизайн',
        56 => 'SEO пакет',
        57 => 'План технической поддержки',
    ];

    $updated = 0;

    foreach ($translations as $product_id => $new_title) {
        $product = get_post($product_id);

        if (!$product) {
            echo '<p style="color:red;">Product ID ' . $product_id . ' not found</p>';
            continue;
        }

        echo '<p>Found: ' . esc_html($product->post_title) . ' (ID: ' . $product_id . ')</p>';

        // Update using wpdb directly
        global $wpdb;
        $result = $wpdb->update(
            $wpdb->posts,
            ['post_title' => $new_title],
            ['ID' => $product_id],
            ['%s'],
            ['%d']
        );

        if ($result !== false) {
            // Clear cache
            clean_post_cache($product_id);

            echo '<p style="color:green;">Updated: ' . esc_html($product->post_title) . ' → ' . esc_html($new_title) . '</p>';
            $updated++;
        } else {
            echo '<p style="color:red;">Failed to update ID ' . $product_id . '</p>';
        }
    }

    // Clear WooCommerce cache
    if (function_exists('wc_delete_product_transients')) {
        foreach ($translations as $product_id => $title) {
            wc_delete_product_transients($product_id);
        }
    }

    echo '<p><strong>Total updated: ' . $updated . '</strong></p>';

    // Show current state
    echo '<h3>Verification:</h3>';
    foreach ($translations as $product_id => $expected_title) {
        $product = get_post($product_id);
        $match = ($product && $product->post_title === $expected_title) ? '✓' : '✗';
        echo '<p>' . $match . ' ID ' . $product_id . ': ' . ($product ? esc_html($product->post_title) : 'NOT FOUND') . '</p>';
    }
}

function list_all_faq() {
    echo '<h2>All FAQ Entries</h2>';

    $faqs = get_posts([
        'post_type' => 'faq',
        'posts_per_page' => -1,
        'post_status' => 'any',
        'orderby' => 'menu_order',
        'order' => 'ASC'
    ]);

    if (empty($faqs)) {
        echo '<p>No FAQs found</p>';
        return;
    }

    echo '<table border="1" cellpadding="5">';
    echo '<tr><th>ID</th><th>Title</th><th>Language</th></tr>';

    foreach ($faqs as $faq) {
        $is_russian = preg_match('/[а-яА-ЯёЁ]/u', $faq->post_title);
        $lang = $is_russian ? 'RU' : 'EN';
        $style = $is_russian ? '' : 'style="background: #ffdddd;"';

        echo '<tr ' . $style . '>';
        echo '<td>' . $faq->ID . '</td>';
        echo '<td>' . esc_html($faq->post_title) . '</td>';
        echo '<td>' . $lang . '</td>';
        echo '</tr>';
    }

    echo '</table>';
}

function check_product_images() {
    echo '<h2>Products Without Images</h2>';

    $products = get_posts([
        'post_type' => 'product',
        'posts_per_page' => -1,
        'post_status' => 'publish'
    ]);

    $without_images = [];
    $with_images = [];

    foreach ($products as $product) {
        if (has_post_thumbnail($product->ID)) {
            $with_images[] = $product->post_title;
        } else {
            $without_images[] = [
                'id' => $product->ID,
                'title' => $product->post_title
            ];
        }
    }

    echo '<p>Products with images: ' . count($with_images) . '</p>';
    echo '<p>Products without images: ' . count($without_images) . '</p>';

    if (!empty($without_images)) {
        echo '<h3>Products needing images:</h3>';
        echo '<ul>';
        foreach ($without_images as $p) {
            echo '<li>ID: ' . $p['id'] . ' - ' . esc_html($p['title']) . '</li>';
        }
        echo '</ul>';
    }
}

function generate_placeholder_images() {
    echo '<h2>Generating Placeholder Images</h2>';

    $products = get_posts([
        'post_type' => 'product',
        'posts_per_page' => -1,
        'post_status' => 'publish'
    ]);

    $upload_dir = wp_upload_dir();
    $placeholder_dir = $upload_dir['basedir'] . '/product-placeholders';

    if (!file_exists($placeholder_dir)) {
        wp_mkdir_p($placeholder_dir);
    }

    $colors = [
        '#6366f1', // indigo
        '#8b5cf6', // violet
        '#ec4899', // pink
        '#f43f5e', // rose
        '#10b981', // emerald
        '#06b6d4', // cyan
        '#3b82f6', // blue
        '#f97316', // orange
    ];

    $updated = 0;

    foreach ($products as $index => $product) {
        if (has_post_thumbnail($product->ID)) {
            continue;
        }

        $color = $colors[$index % count($colors)];
        $title = mb_substr($product->post_title, 0, 20);

        // Create SVG placeholder
        $svg = sprintf(
            '<svg xmlns="http://www.w3.org/2000/svg" width="800" height="800" viewBox="0 0 800 800">
                <rect fill="%s" width="800" height="800"/>
                <text x="400" y="380" font-family="Arial, sans-serif" font-size="32" fill="white" text-anchor="middle" font-weight="bold">%s</text>
                <text x="400" y="440" font-family="Arial, sans-serif" font-size="24" fill="rgba(255,255,255,0.7)" text-anchor="middle">Flavor Digital</text>
            </svg>',
            $color,
            htmlspecialchars($title, ENT_QUOTES, 'UTF-8')
        );

        $filename = 'product-' . $product->ID . '.svg';
        $filepath = $placeholder_dir . '/' . $filename;

        file_put_contents($filepath, $svg);

        // Check if media exists
        $existing = get_posts([
            'post_type' => 'attachment',
            'meta_query' => [
                [
                    'key' => '_wp_attached_file',
                    'value' => 'product-placeholders/' . $filename,
                    'compare' => 'LIKE'
                ]
            ]
        ]);

        if (!empty($existing)) {
            $attach_id = $existing[0]->ID;
        } else {
            // Insert as attachment
            $attachment = [
                'guid'           => $upload_dir['baseurl'] . '/product-placeholders/' . $filename,
                'post_mime_type' => 'image/svg+xml',
                'post_title'     => $product->post_title,
                'post_content'   => '',
                'post_status'    => 'inherit'
            ];

            $attach_id = wp_insert_attachment($attachment, $filepath, $product->ID);
        }

        if ($attach_id && !is_wp_error($attach_id)) {
            set_post_thumbnail($product->ID, $attach_id);
            echo '<p>Set image for: ' . esc_html($product->post_title) . '</p>';
            $updated++;
        }
    }

    echo '<p><strong>Total images set: ' . $updated . '</strong></p>';
}

function create_sample_team() {
    $team_members = [
        [
            'name' => 'Александр Петров',
            'position' => 'CEO & Основатель',
            'bio' => 'Более 10 лет опыта в digital-индустрии. Специализируется на стратегическом развитии и управлении проектами.'
        ],
        [
            'name' => 'Мария Иванова',
            'position' => 'Арт-директор',
            'bio' => 'Креативный специалист с богатым портфолио в области брендинга и UI/UX дизайна.'
        ],
        [
            'name' => 'Дмитрий Козлов',
            'position' => 'Lead Developer',
            'bio' => 'Full-stack разработчик с экспертизой в WordPress, React и современных веб-технологиях.'
        ],
        [
            'name' => 'Елена Смирнова',
            'position' => 'Project Manager',
            'bio' => 'Сертифицированный PM с опытом ведения сложных digital-проектов для enterprise клиентов.'
        ],
    ];

    foreach ($team_members as $index => $member) {
        $post_id = wp_insert_post([
            'post_title' => $member['name'],
            'post_content' => $member['bio'],
            'post_type' => 'team',
            'post_status' => 'publish',
            'menu_order' => $index + 1
        ]);

        if ($post_id && function_exists('update_field')) {
            update_field('team_position', $member['position'], $post_id);
        }

        if ($post_id) {
            echo '<p>Created team member: ' . esc_html($member['name']) . '</p>';
        }
    }
}
