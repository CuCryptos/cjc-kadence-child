<?php
/**
 * CJC Kadence Child Theme — Functions (minimal for deployment testing)
 */

defined('ABSPATH') || exit;

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'kadence-parent',
        get_template_directory_uri() . '/style.css',
        [],
        null
    );

    wp_enqueue_style(
        'cjc-child',
        get_stylesheet_directory_uri() . '/style.css',
        ['kadence-parent'],
        '1.0.0'
    );
});
