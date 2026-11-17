<?php
/** Plugin Name: Green Pack Feedback v3 */
if (!defined('ABSPATH')) exit;

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('greenpack-feedback-v3', plugin_dir_url(__FILE__) . 'greenpack-feedback-v3/style.css', [], '20261117-1');
}, 100);

add_filter('wp_get_attachment_image_attributes', function ($attributes, $attachment) {
    global $TRP_LANGUAGE;
    if ($TRP_LANGUAGE === 'en_US') {
        $english = get_post_meta($attachment->ID, '_greenpack_reference_alt_en', true);
        if ($english !== '') $attributes['alt'] = $english;
    }
    return $attributes;
}, 20, 2);

add_action('template_redirect', function () {
    $path = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);
    if (in_array($path, ['/flota-auto-electrice', '/flota-auto-electrice/', '/en/flota-auto-electrice', '/en/flota-auto-electrice/'], true)) {
        $target = 'https://greenpack.neksoftconsultancy.in' . (strpos($path, '/en/') === 0 ? '/en' : '') . '/flota-auto/';
        wp_safe_redirect($target, 301);
        exit;
    }
}, 1);
