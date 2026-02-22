<?php
/**
 * CJC Kadence Child Theme — Functions
 * Stage 2: Constants + CSS enqueues (no recipe system, no perf optimizations)
 */

defined('ABSPATH') || exit;

if ( ! defined( 'CJC_CHILD_VERSION' ) ) {
    define('CJC_CHILD_VERSION', '1.0.0');
}
if ( ! defined( 'CJC_CHILD_DIR' ) ) {
    define('CJC_CHILD_DIR', get_stylesheet_directory());
}
if ( ! defined( 'CJC_CHILD_URI' ) ) {
    define('CJC_CHILD_URI', get_stylesheet_directory_uri());
}

add_action('wp_head', function () {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}, 1);

add_action('wp_enqueue_scripts', function () {
    $kadence_theme = wp_get_theme('kadence');
    $kadence_version = $kadence_theme->exists() ? $kadence_theme->get('Version') : null;

    wp_enqueue_style('kadence-parent', get_template_directory_uri() . '/style.css', [], $kadence_version);

    wp_enqueue_style('cjc-font-lora', 'https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,600;0,700;1,400&display=swap', [], null);
    wp_enqueue_style('cjc-font-source-sans', 'https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@400;600&display=swap', [], null);
    wp_enqueue_style('cjc-font-playfair', 'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap', [], null);

    wp_enqueue_style('cjc-tokens', CJC_CHILD_URI . '/assets/css/tokens.css', ['kadence-parent'], CJC_CHILD_VERSION);
    wp_enqueue_style('cjc-patterns', CJC_CHILD_URI . '/assets/css/patterns.css', ['cjc-tokens'], CJC_CHILD_VERSION);
    wp_enqueue_style('cjc-components', CJC_CHILD_URI . '/assets/css/components.css', ['cjc-tokens', 'cjc-patterns'], CJC_CHILD_VERSION);
    wp_enqueue_style('cjc-child', CJC_CHILD_URI . '/style.css', ['kadence-parent', 'cjc-tokens', 'cjc-patterns', 'cjc-components'], CJC_CHILD_VERSION);
});
